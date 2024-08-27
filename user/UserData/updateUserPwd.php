<?php 

include "../connection.php";
session_start();
$AcNo = $_SESSION['AccountNo'];

// When the button is clicked
if (isset($_POST['submit-password'])) {
    $oldPassword = $_POST['oldPassword'];
    $cPassword = $_POST['cPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if any of the fields are empty
    if (empty($oldPassword) || empty($newPassword) || empty($cPassword)) {
        $response = array('status' => 'error', 'message' => "Input data cannot be empty");
        echo json_encode($response);
        die;
    }

    // Password validation rules
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number = preg_match('@[0-9]@', $newPassword);
    $specialChar = preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $newPassword);
    $minLength = strlen($newPassword) >= 6;

    if (!$uppercase || !$lowercase || !$number || !$specialChar || !$minLength) {
        $response = array('status' => 'error', 'message' => "New password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 6 characters long.");
        echo json_encode($response);
        die;
    }

    // Hash the old and new passwords
    $hashOldPassword = md5($oldPassword);
    $hashNewPassword = md5($newPassword);

    // Check if the old password matches the password in the database
    $query = "SELECT Password FROM login WHERE AccountNo = '$AcNo'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $response = array('status' => 'error', 'message' => "Error fetching old password");
        echo json_encode($response);
        die;
    }

    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['Password'];

    if ($hashOldPassword !== $storedPassword) {
        $response = array('status' => 'error', 'message' => "Old password is incorrect");
        echo json_encode($response);
        die;
    }

    // Update the password in the database
    $updateQuery = "UPDATE login SET Password = '$hashNewPassword' WHERE AccountNo = '$AcNo'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $response = array('status' => 'success', 'message' => "Password updated successfully");
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => "Error updating password");
        echo json_encode($response);
    }

    mysqli_close($conn);
}
