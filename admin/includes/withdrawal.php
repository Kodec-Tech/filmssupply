<?php
include '../connection.php';
// include '../../mail/AdminwithdrawalEmailScript.php';

$type = 'withdrawal';

if ( isset( $_POST[ 'approve' ] ) ) {
    $Amount = $_POST[ 'Amount' ];
    $id = $_POST['num'];

    //hidden user account number
    $account_No = $_POST[ 'approve' ];
    $walletAddress = $_POST['walletAddress'];


    $userdata = getUserData( $account_No, $conn );

    $username =  $userdata[ 'C_First_Name' ].' '.$userdata[ 'C_Last_Name' ] ;
    $userEmail = $userdata[ 'C_Email' ];
    $status = 'approve';
    $sql = 'UPDATE transaction SET Status = ?, type=? WHERE AccountNo =? and Amount=? and id=?';
    $stmt = mysqli_prepare( $conn, $sql );
    // $Amount  = str_replace( '-', '', $Amount );
    mysqli_stmt_bind_param( $stmt, 'sssds', $status, $type, $account_No, $Amount, $id);
    mysqli_stmt_execute( $stmt );

    header( 'location: ../wallet/mwithdraw.php?msg=success' );
    
    // $message = ' We are pleased to inform you that your recent withdrawal request has been successfully approved.';
    // if ( sendWithdrawalApprovalEmail( $message, $userEmail, $username, $Amount, $account_No, 'Approved',$walletAddress ) ) {

        
    // }

} elseif ( isset( $_POST[ 'reject' ] ) ) {
    //hidden user account number
    $Amount = $_POST[ 'Amount' ];
    $account_No = $_POST[ 'reject'];
    $walletAddress = $_POST['walletAddress'];
    $userdata = getUserData( $account_No, $conn);
    $userEmail = $userdata[ 'C_Email' ];
    $username =  $userdata[ 'C_First_Name' ].' '.$userdata[ 'C_Last_Name' ] ;

    $status = 'reject';
    $sql = 'UPDATE transaction SET status = ?, type=? WHERE AccountNo =? and Amount=?';
    $stmt = mysqli_prepare( $conn, $sql );
    // $Amount  = str_replace( '-', '', $Amount );
    mysqli_stmt_bind_param( $stmt, 'ssss', $status, $type, $account_No, $Amount );
    mysqli_stmt_execute( $stmt );


    //fetch balance 
    // Fetch account details
$query = "SELECT * FROM accounts WHERE AccountNo='$account_No'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $balance = $row['Balance'];
} else {
    die('No account found for AccountNo: ' . $AccountNo);
}

$updateBalance = $balance + $Amount;

    // //update the balance
    $sql = "UPDATE accounts SET Balance = ? WHERE AccountNo =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $updateBalance, $account_No);
    mysqli_stmt_execute($stmt);

    header( 'location: ../wallet/mwithdraw.php?msg=rejected' );

  
    // $message = ' We sorry to inform you that your recent withdrawal request has been Rejected.';
    // if ( sendWithdrawalApprovalEmail( $message, $userEmail, $username, $Amount, $account_No, 'Rejected',$walletAddress ) ) {
    //     header( 'location: ../wallet/mwithdraw.php?msg=rejected' );
    // }

} elseif ( isset( $_POST[ 'delete' ] ) ) {

    //hidden user account number
    $account_No = $_POST[ 'delete' ];
    $empty = '';
    $Amount = $_POST[ 'Amount' ];
    $sql = 'DELETE From  transaction WHERE AccountNo =? AND Amount=?';
    $stmt = mysqli_prepare( $conn, $sql );
    // $Amount  = str_replace( '-', '', $Amount );
    mysqli_stmt_bind_param( $stmt, 'ss', $account_No, $Amount );
    mysqli_stmt_execute( $stmt );


    header( 'location: ../wallet/mwithdraw.php?msg=deleted' );
}




function getUserData( $account_No, $conn ) {

    $sql = "SELECT * FROM customer_detail where Account_No = $account_No   ORDER BY C_No  DESC LIMIT 15";
    $result = mysqli_query( $conn, $sql );

    if ( !$result ) {
        die( 'Query failed: ' . mysqli_error( $conn ) );
    }

    $row = mysqli_fetch_assoc( $result );

    return $row;

}