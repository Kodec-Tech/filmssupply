<?php
session_start();
include '../../connection.php';

include_once( '../../../mail/ReferalScipt.php' );

$username = $_SESSION[ 'username' ];
$AccountNo = $_SESSION[ 'AccountNo' ];

// initialise empty referrer detaiils
$referrerDetails = Array();

// initialize the referral
$referre = '';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    //Grab information with the help of ajax from the form field
    $capital = $_POST[ 'amount' ] ?? '';
    $package_id = $_POST[ 'package_id' ] ?? '';

    //put package_id in session
    $_SESSION[ 'package_id' ] = $package_id;

    //lets minus investment capital from wallet
    $queryBalance = "SELECT * FROM accounts WHERE AccountNo='$AccountNo'";
    $result1 = mysqli_query( $conn, $queryBalance ) or mysqli_error( $conn );

    if ( mysqli_num_rows( $result1 ) > 0 ) {
        while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
            $balance = $row1[ 'Balance' ];
        }

        $newBalance = $balance - $capital;

        $sqlUpdate = 'UPDATE accounts SET Balance = ? WHERE AccountNo = ?';
        $stmt = mysqli_prepare( $conn, $sqlUpdate );

        mysqli_stmt_bind_param( $stmt, 'ss', $newBalance, $AccountNo );
        mysqli_stmt_execute( $stmt );
    }

    //fetch other informations needed for the package from db
    $query = "SELECT * FROM crypto_package WHERE id='$package_id'";
    $result = mysqli_query( $conn, $query ) or mysqli_error( $conn );

    if ( mysqli_num_rows( $result ) > 0 ) {
        while ( $row = mysqli_fetch_assoc( $result ) ) {
            //some infor needed
            $package_name = $row[ 'package_name' ];
            $daily_interest = $row[ 'daily_interest' ];
            $period = $row[ 'period' ];
        }
    }

    //extra information needed
    $investmentStartDate = date( 'Y-m-d H:i:s' );
    // Current date and time
    $investmentEndDate = date( 'Y-m-d H:i:s', strtotime( '+' . $period . ' days' ) );

    $status = 'Running';
    $last_wd = 0;
    $today_earning = 0;
    $total_earning = 0;
    $email_sent = 0;

    $sqlInvest = 'INSERT INTO crypto_investment (acctNo, username, package_id, package_name, capital, period, daily_interest, today_earning, total_earning, start_date, end_date, last_wd, status, email_sent) VALUES (?, ?, ?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?);';
    $stmt2 = mysqli_prepare( $conn, $sqlInvest );
    mysqli_stmt_bind_param( $stmt2, 'ssssssssssssss', $AccountNo, $username, $package_id, $package_name, $capital, $period, $daily_interest, $today_earning, $total_earning, $investmentStartDate, $investmentEndDate, $last_wd, $status, $email_sent );

    mysqli_stmt_execute( $stmt2 );

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
            if ( !empty( $referrer ) && $referrer != null ) {
                $referrerDetails = fetchUserDetails( $referrer, $conn );

            }

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
        $bonus_amount = $capital * $refPercent;
        // 10% referrer bonus
        $has_been_paid = TRUE;

        //this sql statment will insert the data and generate levels
        $refsql = 'INSERT INTO ref (username, referrer, package_id, capital, bonus_amount, has_been_paid, level) SELECT ?, ?, ?, ?, ?, ?, COALESCE(MAX(level), 0) + 1 FROM ref WHERE username = ?';
        $stmtref = mysqli_prepare( $conn, $refsql );

        // Check if the preparation of the statement was successful
        if ( $stmtref ) {
            mysqli_stmt_bind_param( $stmtref, 'sssssss', $username, $referrer, $package_id, $capital, $bonus_amount, $has_been_paid, $username );

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

                //send the referral an email about his earning form this user
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

    $response = [ 'status' => 'success', 'message' =>'Congratulations! Your investment has been successfully processed. Thank you for choosing to invest with us.' ];

    echo json_encode( $response );
} else {
    $response = [ 'status' => 'error', 'message' => 'Your investment was not successful!' ];

    echo json_encode( $response );
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

function processReferralEmail( $referrerDetails, $bonus_amount, $username ) {
    if ( !is_array( $referrerDetails ) ) {
        return;
    }

    if ( count( $referrerDetails ) > 0 || !empty( $referrer ) && $referrer != null ) {
        $message = 'Guess what? You have just earned a referral bonus of $' . $bonus_amount . ' from one of your referees (' . $username . ')';
        $customer_email = $referrerDetails[ 'C_Email' ];
        $customer_name = $referrerDetails[ 'C_First_Name' ] . ' ' . $referrerDetails[ 'C_Last_Name' ];
        $content = file_get_contents( '../../../mail/ReferalTemp.php' );

        $customer_accountNumber = $referrerDetails[ 'AccountNo' ];

        if ( sendReferalPaymentEmail( $message, $customer_email, $customer_name, $bonus_amount, $customer_accountNumber, 'Credited', $content, $customer_name ) ) {
            return 'Email sent';
        } else {
            return 'Unable to send email';
        }
    }

    return 'Invalid referral details';
}