<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >
        <title>Withdrawal OTP Validation</title>
        <link
            rel="stylesheet"
            href="../../assets/css/myregister.css"
        >


    </head>
<?php 
session_start();

// Check if the OTP is set in the session
if (!isset($_SESSION['otp'])) {
    header("Location: ../login.php");
}


$_SESSION['otp'];
if (isset($_POST['submit-otp'])) {
    $user_entered_otp = $_POST['otp'];

    // Compare the entered OTP with the one stored in the session
    if ($user_entered_otp == $_SESSION['otp']) {
        // OTP is correct, perform further actions
        // Clear the OTP from the session
       
        unset($_SESSION['otp']);
        // Redirect to success page or perform other actions
      header("Location: withdraw.php");
        exit();
    } else {
        // Incorrect OTP, you can redirect to the same page with an error message
        $error_message = "Incorrect OTP. Please try again.";
    }
}
?>

    <body style="height: 100vh;">
        <div
            class="container"
            style="margin-top: 50px; border-radius:10px ;border:1px solid #cccccc"
        ><br>

            <h2 style="text-align: center;">Withdrawal Code Verification</h2>
            <br>

            <div class="user_details" >
                <p style="font-size: 16px; text-align:center">For better Security, please enter the 6-digit pin sent to your email</p>
                <br>
                <br>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <?php if (isset($error_message)) { ?>
                    <p style="color: red; text-align:center"><?php echo $error_message; ?></p>
                <?php } ?>
                <div class="otp-input-wrapper " style="background:transparent !important">
                    <input name="otp" type="text" maxlength="6" pattern="[0-9]*" autocomplete="off">
                    <svg viewBox="0 0 240 1" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="0" x2="240" y2="0" stroke="#4f4949" stroke-width="3" stroke-dasharray="22,22" />
                    </svg>
                </div>
                
                <div class="button">
                    <button class="btn-register " style="background:#1877f2; font-size:medium;" name="submit-otp">Validate OTP</button>
                </div>
            </form>






    </body>

</html>