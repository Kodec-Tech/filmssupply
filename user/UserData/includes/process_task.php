<?php
session_start(); 
include '../../connection.php';

header('Content-Type: application/json');



$acctNo = $_POST['acctNo'];
$product_id = $_POST['product_id'];
$product_title = $_POST['product_title'];
$product_img = $_POST['product_img'];
$product_amount = $_POST['product_amount'];
$commission = $_POST['commission'];
$level = $_POST['level'];
$order_number = $_POST['order_number'];

$balance = $_POST['balance'];
$username = $_POST['username'];


$status = 'completed';





if(!empty($acctNo) || !empty($balance)){

//calculate user commission which will serve as today's earning
$commission_earned = $commission / 100 * $product_amount;

$today_earning = $commission_earned;




//add commission to user balance
$newBalance = $balance + $commission_earned;
$sql_newBalance = "UPDATE accounts SET Balance = ? WHERE AccountNo = ?";
$stmt_newBalance = mysqli_prepare($conn, $sql_newBalance);
mysqli_stmt_bind_param($stmt_newBalance, 'ss', $newBalance, $acctNo);
mysqli_stmt_execute($stmt_newBalance);







// Insert User task
$sql_insert = "INSERT INTO user_task (acctNo, username, product_id, product_title, product_img, product_amount, today_earning, commission_earned, status, level, order_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = mysqli_prepare($conn, $sql_insert);

// Bind parameters
mysqli_stmt_bind_param($stmt_insert, "sssssssssss", $acctNo, $username, $product_id, $product_title, $product_img, $product_amount, $today_earning, $commission_earned, $status, $level, $order_number);
$success = mysqli_stmt_execute($stmt_insert);

if ($success) {
    // Set a session variable for the success message
    $_SESSION['message'] = "Successfully!  ";
    
} else {
    // Set a session variable for the error message
    $_SESSION['message'] = "Failed to submit rating. Please try again.";
}

// Redirect to tasks.php
header("Location: ../tasks.php");
exit();





        


}
















