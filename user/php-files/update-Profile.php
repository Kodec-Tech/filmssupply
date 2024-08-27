<?php

include_once '../connection.php';
include_once '../../config.php';
session_start();
$AcNo = $_SESSION[ 'AccountNo' ];

// Check if the form has been submitted
if (isset($_POST['submitProfile'])) {
    // Retrieve form data
    $country = $_POST['country'] ?? '';
    $phone_num = $_POST['phone'] ?? '';

    // Validate phone number format
    if (!preg_match("/^\+?[0-9]+$/", $phone_num)) {
        header('Location: ../error.php?error=Please enter a valid phone number');
        exit; // Terminate script execution after redirect
    }
    elseif (strpos($phone_num, '+') === false) {
        header('Location: ../error.php?error=Enter phone number with country code');
        exit; // Make sure to exit after redirecting
    }

    // Update user profile in the database
    $query = "UPDATE customer_detail SET Country = '$country', C_Mobile_No = '$phone_num' WHERE Account_No = '$AcNo' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to user profile page upon successful update
        header('Location: ../userData/user.php');
        exit;
    } else {
        // Handle database update failure
        $error_message = mysqli_error($conn);
        header("Location: ../error.php?error=Database Error: $error_message");
        exit;
    }
}