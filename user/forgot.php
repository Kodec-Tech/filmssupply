<?php
include_once 'connection.php';
include_once "../config.php";
include_once('../mail/ForgotPassword.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: forgotPassword.php?error=" . urlencode("Invalid email parameters"));
        exit();
    }

    $check_email_query = "SELECT C_Email FROM customer_detail WHERE C_Email= ?";

    $stmt = mysqli_prepare($conn, $check_email_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $token = bin2hex(random_bytes(25));
            date_default_timezone_set(date_default_timezone_get());


            $expiry_time = date('Y-m-d H:i:s', strtotime('+30 minutes'));

            $username = GetUsername($email, $conn);

            if (!checkIfEmailExistInForgotPasswordTable($email, $conn)) {
                $query = "INSERT INTO forgot_password (token, expiry_time,email) VALUES (?, ?, ?)";

            } else {
                $query = "UPDATE forgot_password SET token = ?, expiry_time = ? WHERE email = ?";

            }


            //send mail first ---  before chcking if true
            sendresetemail($email, $token, $username);

            // check if the email has been sent 
          
                // if email has been sent, push the data to the databse 
                $stmt = mysqli_prepare($conn, $query);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $token, $expiry_time, $email);

                    mysqli_stmt_execute($stmt);

                    header("Location: forgotPassword.php?success=" . urlencode("Check Your inbox"));

                } else {
                    header("Location: Login.php?error=" . urlencode("Internal error occured...."));
                }

           



            exit();
        } else {
            header("Location: forgotPassword.php?error=" . urlencode("Email does not exist"));
            exit();
        }
    } else {
        die("Database error: " . mysqli_error($conn));
    }

} else {
    die("Invalid request");
}

function GetUsername($email, $conn)
{
    $get_username_query = "SELECT C_First_Name FROM customer_detail WHERE C_Email = ?";

    $stmt = mysqli_prepare($conn, $get_username_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            return $result->fetch_assoc()['C_First_Name'];
        } else {
            return "User";
        }
    } else {
        die("Database error: " . mysqli_error($conn));
    }
}

function checkIfEmailExistInForgotPasswordTable($email, $conn)
{
    $check_email_query = "SELECT email FROM forgot_password WHERE email = ?";

    $stmt = mysqli_prepare($conn, $check_email_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        die("Database error: " . mysqli_error($conn));
    }
}
?>