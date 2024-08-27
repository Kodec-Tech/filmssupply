<?php
session_start();
if (!isset ($_SESSION['otp'])){
    echo "You are not suppose to be here";

    header("location: CreateAccount.php");
}
else{



?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >
        <title>Email OTP Validation</title>
        <link
            rel="stylesheet"
            href="../assets/css/myregister.css"
        >
    </head>

    <body style="height: 100vh;">
        <div class="container">
            <div class="title" style="text-align:center">Email OTP Verification</div>
            <br>
            <h2 style="text-align:center">Step 3/3</h2>
            <br>
            <div class="user_details">
                <p style="text-align:center">A Verification Code has been Sent to Your email, Please check your email
                </p>
                <br>
                <form
                    action="validateotp.php"
                    method="POST"
                >

                    <div
                        class="otp-input-wrapper"
                        style="background:white!important"
                    >
                        <input
                            name="otp"
                            type="text"
                            maxlength="6"
                            pattern="[0-9]*"
                            autocomplete="off"
                        >
                        <svg
                            viewBox="0 0 240 1"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <line
                                x1="0"
                                y1="0"
                                x2="240"
                                y2="0"
                                stroke="#4f4949"
                                stroke-width="3"
                                stroke-dasharray="22,22"
                            />
                        </svg>
                    </div>

                    <div class="button">
                        <button
                            class="btn-register "
                            style="background:#1877f2"
                            name="submit-otp"
                        >Validate OTP</button>
                    </div>

            </div>

        </div>

        </form>



    </body>

</html>

<?php
}
?>