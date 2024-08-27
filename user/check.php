<?php

session_start();
require "Authenticator.php";
include 'connection.php';

if(isset($_POST['registerSkip'])){
    echo "2 Step OTP skipped";
    $AccountNo = $_SESSION['twostep'];
    // echo $AccountNo;
    $query = "UPDATE login SET AuthKey='{$_SESSION['auth_key']}' WHERE AccountNo='{$AccountNo}'";
    $result = mysqli_query($conn, $query) or die("query fail!") and exit();
    return header('Location: ../user/logout.php');
}

if(isset($_POST['verifyBtn'])){
    echo "login success";
    $_SESSION['username'] = $_SESSION['verifyCode'];
    return header('Location: ../user/UserData/Dashboard.php');
}

$authenticator = new Authenticator();
if (isset($_POST['registerVerify'])) {
    if ($_SERVER['REQUEST_METHOD'] != "POST") {

        header('Location: ../user/CreateAccount.php');
        die();
    }

    $check = $authenticator->verifyCode($_SESSION['auth_key'], $_POST['code'], 0);
    $_SESSION['check'] = $check;
    echo $check." -> check result";

    if ($check) {
        // echo "Matched";
        $AccountNo = $_SESSION['twostep'];
        echo "<h3>Two Step Verification: <h3>".$AccountNo;
        $query = "UPDATE login SET AuthKey='{$_SESSION['auth_key']}' WHERE AccountNo='{$AccountNo}'";
        $result = mysqli_query($conn, $query) or die("query fail!") and exit();
        header('Location: ../user/logout.php');
    } else {
        // die("fail");
        header('Location: ../user/logout.php'); //comment out

        // header('Location: ../user/twostepsetup.php?error=Invalid Code Entered');
    }
}
// echo $_SESSION['userKey']; // comment out
if (isset($_POST['verifyBtn'])) {

    $check = $authenticator->verifyCode($_SESSION['userKey'], $_POST['Scode'], 0);

    $_SESSION['check'] = $check;
    echo $check." -> check result";
    if ($check) {
        echo "Matched";
        $_SESSION['username'] = $_SESSION['verifyCode'];
        header('Location: ../user/UserData/Dashboard.php');
    } else {
        // die("fail");
        header('Location: ../user/UserData/Dashboard.php'); // Comment out
        // header('Location: ../user/twostepverify.php?error=Invalid Code Entered');
    }
}
