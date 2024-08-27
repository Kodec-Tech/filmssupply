<?php
session_start();


// Validating Otp
if (isset($_POST['submit-otp'])) {

  $userOtp = trim($_POST['otp']);
  $SessionOtp = trim($_SESSION['wotp']);

  if ($SessionOtp == $userOtp) {

    if (!isset($_SESSION['expiry_time'])) {
      header("Location: ../error.php?error=" . urlencode('Internal server error'));
    }
    if (date('Y-m-d H:i:s') > $_SESSION['expiry_time']){
      header("Location: ../error.php?error=" . urlencode('Otp Expired'));
    }



      header("Location: withdraw.php");
  } else {
    header("Location: ../error.php?error=" . urlencode('Invalid Otp'));
  }
} else {
  header("location: ../login.php");
}
