<?php
session_start();
include '../../connection.php';

header('Content-Type: application/json');



$acctNo = $_POST['acctNo'];

$product_title = $_POST['product_title'];
$product_img = $_POST['product_img'];
$product_amount = $_POST['product_amount'];
$commission = $_POST['commission'];
$balance = $_POST['balance'];
$username = $_POST['username'];





//checks
//lets work merge product that will freeze user account
    $NewBalance = 0 - ($product_amount + $balance);
    $amount_processing = $product_amount + $balance;

    // Prepare the SQL update statement
    $sql = "UPDATE accounts SET Balance = ?, amount_processing = ? WHERE AccountNo = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sss", $NewBalance, $amount_processing, $acctNo);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {

            $_SESSION['message'] = "Movie Rated Successfully!  ";

            // Redirect to tasks.php
            header("Location: ../tasks.php");
            exit();

        } else {
            $_SESSION['message'] = "Failed to submit rating. Please try again.";
             // Redirect to tasks.php
             header("Location: ../tasks.php?msg=error");
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the update statement.']);
    }