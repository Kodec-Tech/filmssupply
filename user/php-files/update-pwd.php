<?php 

include "../connection.php";
session_start();
$AcNo = $_SESSION['AccountNo'];


// When the button is clicked
if (isset($_POST['submitPassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $cPassword = $_POST['cPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if any of the fields are empty
    if (empty($oldPassword) || empty($newPassword) || empty($cPassword)) {
        $response = array('status' => 'error', 'message' => "Input data cannot be empty");
        echo json_encode($response);
        die;
    }


    if($newPassword != $cPassword){
        
        header("location: ../UserData/security.php?msg=wrongPass");
        exit();

    }


    // Password validation rules
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number = preg_match('@[0-9]@', $newPassword);
    $specialChar = preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $newPassword);
    $minLength = strlen($newPassword) >= 6;

    if (!$uppercase || !$lowercase || !$number || !$specialChar || !$minLength) {
        // $response = array('status' => 'error', 'message' => "New password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 6 characters long.");
        // echo json_encode($response);
        // die;

        header("location: ../UserData/security.php?msg=poorPass");
        exit();
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
        // $response = array('status' => 'success', 'message' => "Password updated successfully");
        // echo json_encode($response);
        header("location: ../UserData/security.php?msg=successPass");
    } else {
        $response = array('status' => 'error', 'message' => "Error updating password");
        echo json_encode($response);
    }

    mysqli_close($conn);
}








elseif(isset($_POST['submit-pin'])){

    $oldPin = $_POST['oldPin'];
    $newPin = $_POST['newPin'];
    $cPin = $_POST['cPin'];




    //fetch the withdrawal pin 
    $check_query = "SELECT withdrawal_pin FROM customer_detail WHERE Account_No = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, 's', $AcNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $dbPin = $row['withdrawal_pin'];


    if($dbPin !== $oldPin){
        header("location: ../UserData/security.php?msg=pinNotMatch");
        exit();
    }
    if($newPin !== $cPin){
        header("location: ../UserData/security.php?msg=pinNotMatch");
        exit();

    }

    if(empty($oldPin) || empty($newPin) || empty($cPin)){
        header("location: ../UserData/security.php?msg=empty");
        exit();
    }
    if (!preg_match('/^\d{6}$/', $newPin)) {
        header('location: ../UserData/security.php?msg=pinNotUptoSix');
        exit();
    }



    // Update the withdrawal pin in the database
    $updateQuery = "UPDATE customer_detail SET withdrawal_pin = '$newPin' WHERE Account_No = '$AcNo'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // $response = array('status' => 'success', 'message' => "Password updated successfully");
        // echo json_encode($response);
        header("location: ../UserData/security.php?msg=successPin");
    } else {
        $response = array('status' => 'error', 'message' => "Error updating password");
        echo json_encode($response);
    }

    mysqli_close($conn);






}

elseif(isset($_POST['submit-delete'])){

    // Start a transaction
mysqli_begin_transaction($conn);

try {
    // Delete from accounts table
    $sql_accounts = "DELETE FROM accounts WHERE AccountNo = ?";
    $stmt_accounts = mysqli_prepare($conn, $sql_accounts);
    mysqli_stmt_bind_param($stmt_accounts, 's', $AcNo);
    mysqli_stmt_execute($stmt_accounts);
    mysqli_stmt_close($stmt_accounts);

    // Delete from customer_detail table
    $sql_customer_detail = "DELETE FROM customer_detail WHERE Account_No = ?";
    $stmt_customer_detail = mysqli_prepare($conn, $sql_customer_detail);
    mysqli_stmt_bind_param($stmt_customer_detail, 's', $AcNo);
    mysqli_stmt_execute($stmt_customer_detail);
    mysqli_stmt_close($stmt_customer_detail);

    // Delete from login table
    $sql_login = "DELETE FROM login WHERE AccountNo = ?";
    $stmt_login = mysqli_prepare($conn, $sql_login);
    mysqli_stmt_bind_param($stmt_login, 's', $AcNo);
    mysqli_stmt_execute($stmt_login);
    mysqli_stmt_close($stmt_login);


    //Delete from mymembership table
    $sql_mymembership = "DELETE FROM mymembership WHERE AcctNo = ?";
    $stmt_mymembership = mysqli_prepare($conn, $sql_mymembership);
    mysqli_stmt_bind_param($stmt_mymembership, 's', $AcNo);
    mysqli_stmt_execute($stmt_mymembership);
    mysqli_stmt_close($stmt_mymembership);





    // Commit the transaction
    mysqli_commit($conn);

    header("location: ../logout.php?msg=UserAcctDeleted");
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($conn);
    echo "Failed to delete user: " . $e->getMessage();
}

// Close the connection
mysqli_close($conn);


}















else{
    $response = array('status' => 'error', 'message' => "Invalid request");
    echo json_encode($response);
    die;
}
