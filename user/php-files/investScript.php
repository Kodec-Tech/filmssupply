<?php

/**
* Fetching details from auth page
*
*
*/
include '../connection.php';

session_start();

if ( !isset( $_SESSION[ 'username' ] ) ) {
    header( 'Location: ../login.php' );
}
$username = $_SESSION[ 'username' ];

$query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE login.Username = '$username'";
$result = mysqli_query( $conn, $query ) or mysqli_error( $conn );

if ( mysqli_num_rows( $result ) > 0 ) {
    while ( $row = mysqli_fetch_assoc( $result ) ) {

        $AccountNo = $row[ 'AccountNo' ];
        $Fname = $row[ 'C_First_Name' ];
        $Lname = $row[ 'C_Last_Name' ];
        $color = $row[ 'ProfileColor' ];
        $email = $row[ 'C_Email' ];
        $balance = $row[ 'Balance' ];
        $phone_num = $row[ 'C_Mobile_No' ];

        // for us to know if the user is admin or not
        if ( strtolower( $row[ 'Status' ] ) == 'super' ) {
            $_SESSION[ 'isAdmin' ] = true;
            $isAdmin = true;

        }
    }
    $ProfileText = substr( $Fname, 0, 1 );
    $_SESSION[ 'AccountNo' ] = $AccountNo;
    $_SESSION[ 'ProfileText' ] = $ProfileText;
    $_SESSION[ 'ProfileColor' ] = $color;
    $_SESSION[ 'email' ] = $email;
    $_SESSION[ 'C_First_Name' ] = $Fname;
    $_SESSION[ 'C_Last_Name' ] = $Lname;
    $_SESSION[ 'profilecolor' ] = $color;
    $_SESSION[ 'phone' ] = $phone_num;

}

include_once( '../userdata/fetchBalance.php' );

include_once( '../../mail/ReferalScipt.php' );

// initialise empty referrer detaiils
$referrerDetails = Array();

// initialize the referral
$referre = '';

if ( !isset( $Usersbalance ) || !isset( $AccountNo ) ) {
    $response = [ 'status' => 'error', 'message' => 'Unknown Internal error , Kindly try again after sometime ' ];
    echo json_encode( $response );
    exit();
}

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    $investId = $_POST[ 'investmentId' ] ?? '';
    $amount = $_POST[ 'amount' ] ?? '';

    if ( empty( $investId ) ) {
        $response = [ 'status' => 'error', 'message' => 'Invalid parameter provided. Kindly refresh the page and try again ' ];
        echo json_encode( $response );
        exit();
    }

    // Check if user has already Invested
    // returns false if user has not
    // else it redirects to the dashboard page
    CheckIfUserHasInvested( $investId, $conn, $UsersaccountNo );

    // Checks if the invest amout is a number
    if ( !is_numeric( $amount ) ) {

        $response = [ 'status' => 'error', 'message' => 'Invalid price provided. Please enter a valid amount ' . $amount ];
        echo json_encode( $response );
        exit();
    }

    // Check if user balnce is less than what he is trying to invest
    if ( $amount > $Usersbalance ) {
        $response = [ 'status' => 'error', 'message' => 'Your Account balance is too low For this investment, please fund your account and try again ' ];
        echo json_encode( $response );
        exit();
    }

    $fetchData = fetchInvestmentDetails( $conn, $investId )[ 0 ];
    if ( $fetchData == false ) {
        $response = [ 'status' => 'error', 'message' => 'Internal Error. Kindly refresh the page and try again' ];
        echo json_encode( $response );
        exit();
    } else {

        if ( is_array( $fetchData ) ) {
            if ( $amount < $fetchData[ 'min_invest' ] ) {
                $response = [ 'status' => 'error', 'message' => 'Minimum Investment is' . $fetchData[ 'min_invest' ] ];
                echo json_encode( $response );
                exit();
            } else if ( $amount > $fetchData[ 'max_invest' ] ) {
                $response = [ 'status' => 'error', 'message' => 'Maximum  Investment is $' . $fetchData[ 'max_invest' ] ];
                echo json_encode( $response );
                exit();
            }
        }
    }
    // check if the information actually exists
    $sql = 'SELECT id FROM real_estate_package WHERE id = ?';
    $stmt = mysqli_prepare( $conn, $sql );

    if ( $stmt ) {
        mysqli_stmt_bind_param( $stmt, 'i', $investId );

        if ( mysqli_stmt_execute( $stmt ) ) {
            mysqli_stmt_store_result( $stmt );

            if ( mysqli_stmt_num_rows( $stmt ) < 1 ) {
                $response = [ 'status' => 'error', 'message' => 'Invalid parameter/Provided Investment Package does not exist . Kindly refresh the page and try again ' ];
                echo json_encode( $response );
                exit();
            }
            $type = 'real estate';
            $sql1  = 'INSERT Into re_investment (AccountNo, real_estate_package_id, amount, type)Values(?,?,?,?)';

            if ( $stmt = $conn->prepare( $sql1 ) ) {

                //deducts the current investment amout from account balance
                if ( !DeductAccountBal( $amount, $Usersbalance, $conn, $UsersaccountNo ) ) {
                    $response  = [ 'status' => 'error', 'message' => 'An Internal Error occured, Kindly refresh the page and try again, or contact admins for assistance .' ];

                    echo json_encode( $response );
                    exit();
                }

                $stmt->bind_param( 'ssss', $AccountNo, $investId, $amount, $type );

                if ( $stmt->execute() ) {

                    //giving out referer commisions start here
                    //Note that we, pay referrer ( once an investment )
                    //check if referrer has gain a commission for this package.

                    //first we get the referrer
                    $sql = 'SELECT * FROM customer_detail WHERE Account_No = ?';
                    $stmt = mysqli_prepare( $conn, $sql );
                    mysqli_stmt_bind_param( $stmt, 's', $AccountNo );
                    mysqli_stmt_execute( $stmt );
                    $result = mysqli_stmt_get_result( $stmt );

                    if ( mysqli_num_rows( $result ) ) {
                        while ( $row = mysqli_fetch_assoc( $result ) ) {
                            $referrer = $row[ 'downline' ];
                            $referrerDetails = fetchUserDetails( $referrer, $conn );

                        }
                    }

                    //grab the admin inserted referral settings values
                    $ref_id = 1;

                    $sql = 'SELECT * FROM referral_setting WHERE id = ? ';

                    // Create a prepared statement
                    $stmt = mysqli_prepare( $conn, $sql );

                    // Bind parameter with the prepared statement
                    mysqli_stmt_bind_param( $stmt, 'i', $ref_id );

                    mysqli_stmt_execute( $stmt );
                    $result = mysqli_stmt_get_result( $stmt );

                    while ( $row = mysqli_fetch_assoc( $result ) ) {
                        $ref_commission = $row[ 'ref_commission' ];
                        $ref_level = $row[ 'ref_level' ];
                    }

                    //calculate the referral commission in %
                    $refPercent = $ref_commission / 100;

                    //chck if this referrer has been paid for this investment
                    $sql = 'SELECT * FROM ref WHERE referrer = ? AND username= ?';
                    $stmt = mysqli_prepare( $conn, $sql );
                    mysqli_stmt_bind_param( $stmt, 'ss', $referrer, $username );
                    mysqli_stmt_execute( $stmt );
                    $resultReferrer = mysqli_stmt_get_result( $stmt );

                    if ( mysqli_num_rows( $resultReferrer ) >= $ref_level ) {
                        // Your code for the condition where the number of rows is greater than what value admin sets
                    } else {
                        $bonus_amount = $amount * $refPercent;
                        // 10% referrer bonus
                        $has_been_paid = TRUE;

                        //this sql statment will insert the data and generate levels
                        $refsql = 'INSERT INTO ref (username, referrer, package_id, capital, bonus_amount, has_been_paid, level) SELECT ?, ?, ?, ?, ?, ?, COALESCE(MAX(level), 0) + 1 FROM ref WHERE username = ?';
                        $stmtref = mysqli_prepare( $conn, $refsql );

                        // Check if the preparation of the statement was successful
                        if ( $stmtref ) {
                            mysqli_stmt_bind_param( $stmtref, 'sssssss', $username, $referrer, $investId, $amount, $bonus_amount, $has_been_paid, $username );

                            // Check if the execution of the statement was successful
                            if ( mysqli_stmt_execute( $stmtref ) ) {
                                // Insertion was successful

                                //Grab the total referrer bonus
                                $sql = 'SELECT IFNULL(SUM(bonus_amount), 0) AS total_bonus FROM ref WHERE username = ?';
                                $stmt = mysqli_prepare( $conn, $sql );
                                mysqli_stmt_bind_param( $stmt, 's', $username );
                                mysqli_stmt_execute( $stmt );
                                $result = mysqli_stmt_get_result( $stmt );

                                if ( mysqli_num_rows( $result ) ) {
                                    while ( $row = mysqli_fetch_assoc( $result ) ) {
                                        $totalBonus = $row[ 'total_bonus' ];
                                    }
                                }

                                $UpdateRefBonus = 'UPDATE accounts SET ref_bonus = ref_bonus + ? WHERE username = ?';

                                $stmt = mysqli_prepare( $conn, $UpdateRefBonus );
                                mysqli_stmt_bind_param( $stmt, 'ss', $bonus_amount, $referrer );

                                if ( mysqli_stmt_execute( $stmt ) ) {
                                    $affectedRows = mysqli_affected_rows( $conn );
                                    $totalBonus = $totalBonus + $affectedRows;
                                    // inserted successful
                                } else {
                                    echo 'Error updating earnings: ' . mysqli_error( $conn );
                                }

                                mysqli_stmt_close( $stmt );

                                //send the referral an email about his earning from this user

                                processReferralEmail( $referrerDetails, $bonus_amount, $username );

                            } else {
                                echo 'Error executing statement: ' . mysqli_stmt_error( $stmtref );
                                // Handle the error as needed
                            }

                            // Close the statement
                            mysqli_stmt_close( $stmtref );
                        } else {
                            echo 'Error preparing statement: ' . mysqli_error( $conn );
                            // Handle the error as needed
                        }
                    }

                    $response = [ 'status' => 'success', 'message' => 'Congratulations! Your investment has been successfully processed. Thank you for choosing to invest with us.' ];

                    echo json_encode( $response );
                    exit();
                } else {
                    $response = array( 'status' => 'error', 'message' => 'Internal error' . $stmt->error );
                    echo json_encode( $response );
                    exit();
                }
            }
        } else {
            $response = array( 'status' => 'error', 'message' => 'Internal error' . $stmt->error );
            echo json_encode( $response );
            exit();
        }
    } else {
        $response = [ 'status' => 'error', 'message' => 'not successfull ' ];
        echo json_encode( $response );
        exit();
    }
} else {
    $response = [ 'status' => 'error', 'message' => 'Invalid Reqest, Kindly refresh the page and try again or contact admins for assistance ' ];
    echo json_encode( $response );
    exit();
}

function fetchInvestmentDetails( $conn, $id )
 {

    $arr  = array();
    $sql = ' SELECT * from real_estate_package RIGHT JOIN package_custom_details on real_estate_package.id = package_custom_details.package_id where real_estate_package.id = ?';
    $stmt = mysqli_prepare( $conn, $sql );

    if ( $stmt ) {
        mysqli_stmt_bind_param( $stmt, 'i', $id );

        $result = mysqli_stmt_execute( $stmt );

        if ( $result ) {

            $result_set = mysqli_stmt_get_result( $stmt );
            $numRows = mysqli_stmt_num_rows( $stmt );

            while ( $row = mysqli_fetch_assoc( $result_set ) ) {
                $arr[] = $row;
            }

            return $arr;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// DEDUCTS Users account balance upon investment

function DeductAccountBal( $amount, $currentBalance, $conn, $accountNumber )
 {
    $balance = $currentBalance - $amount;
    $sql2 = 'UPDATE accounts set Balance = ? where AccountNo =?';
    $stmt = mysqli_prepare( $conn, $sql2 );
    if ( $stmt ) {
        mysqli_stmt_bind_param( $stmt, 'ss', $balance, $accountNumber );
        $result = mysqli_stmt_execute( $stmt );
        if ( $result ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// CHecks if user has already invested in this investment

function CheckIfUserHasInvested( $id, $conn, $accountNumber )
 {
    $sql = 'SELECT * from re_investment where real_estate_package_id=? and AccountNo = ?';
    $stmt = mysqli_prepare( $conn, $sql );

    if ( $stmt ) {
        mysqli_stmt_bind_param( $stmt, 'ss', $id, $accountNumber );
        $result = mysqli_stmt_execute( $stmt );

        if ( $result ) {
            $result_set = mysqli_stmt_get_result( $stmt );
            $rows = mysqli_num_rows( $result_set );
            // Correct way to count rows

            if ( $rows > 0 ) {
                header( 'Location: realestate.php' );
                exit();
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        $response = [ 'status' => 'error', 'message' => 'user has not invested  ' ];
        echo json_encode( $response );
        exit();
    }
}

function processReferralEmail( $referrerDetails, $bonus_amount, $username ) {
    if ( !is_array( $referrerDetails ) ) {
        return;

    }

    if ( count( $referrerDetails ) > 0 || !empty( $referrer ) && $referrer != null ) {
        $message = 'Guess what? You have just earned a referral bonus of $' . $bonus_amount . ' from one of your referees (' . $username . ')';
        $customer_email = $referrerDetails[ 'C_Email' ];
        $customer_name = $referrerDetails[ 'C_First_Name' ] . ' ' . $referrerDetails[ 'C_Last_Name' ];
        $content = file_get_contents( '../../mail/ReferalTemp.php' );

        $customer_accountNumber = $referrerDetails[ 'AccountNo' ];

        if ( sendReferalPaymentEmail( $message, $customer_email, $customer_name, $bonus_amount, $customer_accountNumber, 'Credited', $content, $customer_name ) ) {
            return 'Email sent';
        } else {
            return 'Unable to send email';
        }
    }

    return 'Invalid referral details';
}

function fetchUserDetails( $refeer, $conn ) {
    // Prevent SQL injection by using prepared statements
    $stmt = $conn->prepare( 'SELECT * FROM accounts JOIN customer_detail ON accounts.AccountNo = customer_detail.Account_No WHERE accounts.username = ?' );

    // Bind the parameter
    $stmt->bind_param( 's', $refeer );

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch user details as an associative array
    $userDetails = $result->fetch_assoc();
    // Return the user details
    return $userDetails;
}

mysqli_close( $conn );