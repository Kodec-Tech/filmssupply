<?php
session_start();


// Validating Otp
if(isset($_POST['submit-otp'])){

    $userOtp = trim($_POST['otp']);
    $SessionOtp = trim($_SESSION['otp']);

    if($SessionOtp == $userOtp){
      
        //send mail
        require '../mail/congraMail.php';
        sendMessage($_SESSION['email'], $_SESSION['firstname']);

        

        header("location: login.php");



      echo "Valid";
    }
    else{
      echo "Invalid";
    }

}
else{
  header("location: login.php");
}