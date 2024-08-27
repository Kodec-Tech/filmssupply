<?php
session_start();
include '../../connection.php';

$username = $_SESSION['username'];
$AccountNo = $_SESSION['AccountNo'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $coin_type = $_POST['coin_type'];
    $wallet_network = $_POST['wallet_network'];
    $wallet_address = $_POST['wallet_address'];
    $withdrawal_pin = $_POST['withdrawal_pin'];





    //check if withdrawal pin matches
    $pin_check_query = "SELECT withdrawal_pin FROM customer_detail WHERE Account_No = ?";
    $stmt = mysqli_prepare($conn, $pin_check_query);
    mysqli_stmt_bind_param($stmt, 's', $AccountNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $db_withdrawal_pin = $row['withdrawal_pin'];


    //run a check to see it it matches
    if ($withdrawal_pin != $db_withdrawal_pin) {
        header("location: ../wallet.php?msg=incorrectPin");
        exit();
        
    }else{








    // Validate and sanitize form data (you should add more validation as needed)

    // Check if the record already exists in the database
    $check_query = "SELECT * FROM bind_wallet WHERE acctNo = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, 's', $AccountNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        // Update existing record
        $update_query = "UPDATE bind_wallet SET wallet_network = ?, wallet_address = ?, coin_type = ? WHERE acctNo = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 'ssss', $wallet_network, $wallet_address, $coin_type, $AccountNo);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn) > 0) {

            header("location: ../wallet.php?msg=updatedSuccess");
            

        } else {
            echo "Failed to update record";
        }
    } else {
        // Insert new record
        $insert_query = "INSERT INTO bind_wallet (acctNo, username, coin_type, wallet_network, wallet_address) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, 'sssss', $AccountNo, $username, $coin_type, $wallet_network, $wallet_address);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn) > 0) {


            header("location: ../wallet.php?msg=insertedSuccess");

        } else {
            echo "Failed to insert record";
        }
    }

    mysqli_close($conn); // Close database connection
} 

}


else {
    echo "Invalid request method";
}


