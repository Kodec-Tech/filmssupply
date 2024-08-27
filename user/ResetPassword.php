<?php
include 'connection.php';
include "../config.php"; ?>

<?php
function checkTokenNotExpired($token, $conn)
{
    // $pattern = "/^[0-9a-f]{50}$/i"; // a regex pattern for hex string of 50 charsu

   
    if (strlen(trim($token))<50) {

        header("Location: error.php?error=" . urlencode("Invalid Credentials  "));
    } else {
        $sql = "SELECT * FROM forgot_password where token = ? ";


        $current_date = date('Y-m-d H:i:s', strtotime('+30 minutes'));
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $token);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);


        if (!$result) {
            header("Location: error.php?error=" . urlencode("An internal error Occured !"));
            exit();
        }

        if (mysqli_num_rows($result) == 1) {

            if (!$current_date > $result->fetch_assoc()['expiry_time']) {
                header("Location: error.php?error=" . urlencode("Token expired!"));
                exit();
            }

        } else {
            header("Location: error.php?error=" . urlencode("Invalid Credentials11"));
            exit();
        }

    }

}
if($_GET['token']){
    header("Location: error.php?error=" . urlencode("Invalid Credentials  "));
}

checkTokenNotExpired($_GET['token'], $conn);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >
        <meta
            http-equiv="X-UA-Compatible"
            content="ie=edge"
        >
        <title>Reset Password</title>

        <!-- Favicons -->
        <link
            href="../assets/img/favicon-32x32.ico"
            rel="icon"
        >
        <link
            href="../assets/img/apple-icon-180x180.png"
            rel="apple-touch-icon"
        >

        <link
            href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap"
            rel="stylesheet"
        >
        <link
            rel="stylesheet"
            href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css"
        >
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        >

        <!-- fontawesome -->

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../assets/js/resetPass.js"></script>


        <!-- Extra CSS for external module -->
        <style>
        body {
            font-family: "Karla", sans-serif;
            /* background: linear-gradient(to right, #8e2de2, #4a00e0); */
            /* background: linear-gradient(45deg, rgba(86, 58, 250, 0.4) 0%, rgba(116, 15, 214, 0.4) 100%), url("../img/back-img.jpg") center center no-repeat; */
            background-color: #1e2022;
            background-size: cover;
            min-height: 100vh;
        }

        .swal-button {
            max-width: 300px;
            min-width: 250px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            margin-bottom: 12px;
        }

        .swal-footer {
            text-align: center;
        }
        .swal-text {
            text-align: center;}
        .brand-wrapper {
            margin-bottom: 19px;
            display: flex;

        }

        .brand-wrapper .logo {
            height: 37px;
        }

        .brand-wrapper p {
            padding-left: 10px;
            font-size: 24px;
        }

        .login-card {
            border: 0;
            border-radius: 27.5px;
            box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
            overflow: hidden;
        }

        .login-card-img {
            border-radius: 0;
            position: absolute;
            width: 95%;
            height: 95%;
            margin: 0px 80px;
            object-fit: contain;
        }

        .login-card .card-body {
            padding: 85px 60px 60px;
            /* margin: 0px 85px; */
        }

        @media (max-width: 422px) {
            .login-card .card-body {
                padding: 35px 24px;
            }
        }

        .login-card-description {
            font-size: 20px;
            color: #000;
            font-weight: normal;
            margin-bottom: 23px;
        }

        .login-card form {
            max-width: 326px;
        }

        .login-card .form-control {
            border: 1px solid #3d1dea;
            padding: 15px 25px;
            margin-bottom: 20px;
            min-height: 45px;
            font-size: 13px;
            line-height: 15;
            font-weight: normal;
            box-shadow: #8e2de2;
        }

        .login-card .form-control::-webkit-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::-moz-placeholder {
            color: #919aa3;
        }

        .login-card .form-control:-ms-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::-ms-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::placeholder {
            color: #919aa3;
        }

        .login-card .login-btn {
            padding: 13px 20px 12px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            border-radius: 4px;
            font-size: 17px;
            font-weight: bold;
            line-height: 20px;
            color: #fff;
            margin-bottom: 24px;
        }

        .login-card .login-btn:hover {
            opacity: 0.8;
            background-color: transparent;

        }

        .login-card .forgot-password-link {
            font-size: 14px;
            color: #919aa3;
            margin-bottom: 12px;
        }

        .login-card-footer-text {
            font-size: 16px;
            color: #0d2366;
            margin-bottom: 60px;
        }

        @media (max-width: 767px) {
            .login-card-footer-text {
                margin-bottom: 24px;
            }
        }

        .login-card-footer-nav a {
            font-size: 14px;
            color: #919aa3;
        }

        #partitioned {
            outline: none;
            padding-left: 15px;
            letter-spacing: 42px;
            border: 0;
            background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
            background-position: bottom;
            background-size: 50px 1px;
            background-repeat: repeat-x;
            background-position-x: 37px;
            width: 286px;
        }
        </style>



    </head>

    <body>

        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card" style="background-color: #25282a !important;">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img
                                src="../assets/img/PageImage/ResetPass.svg"
                                alt="login"
                                class="login-card-img"
                            >
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="brand-wrapper">
                                <img src="../assets/svg/logos/main-logo.png" alt="" height="60">
                                    
                                </div>
                                <p class="login-card-description text-muted">Create New Password</p>

                                <!-- Login Form -->
                                <form
                                    action="#"
                                    method="POST"
                                    id="form"
                                >


                                    <p
                                        style="color: red;"
                                        id="PasswordError"
                                    ></p>



                                    <p
                                        style="color: red;"
                                        id="error-view"
                                    > </p>




                                    <label
                                        for="username"
                                        class="sr-only"
                                    >New Password</label>
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            name="Password"
                                            id="password"
                                            class="form-control textDesign "
                                            placeholder="Password"
                                            required
                                        >

                                    </div>



                                    <div class="form-group mb-4 ">
                                        <label
                                            for="password"
                                            class="sr-only"
                                        >Password</label>
                                        <input
                                            type="password"
                                            name="ConfirmPass"
                                            id="confirm_password"
                                            class="form-control textDesign"
                                            placeholder="Confirm Password"
                                            required
                                        >
                                    </div>
                                    <input
                                        name="done"
                                        id="done"
                                        class="btn btn-block login-btn mb-4"
                                        type="submit"
                                        value="Reset Password"
                                    >
                                </form>
                                <p class="login-card-footer-text text-muted"> <a
                                        href="login.php"
                                        class="text-reset"
                                    > To Go Back Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Today:

        1 Validate Password with Ajax
        2 Validate Password with php
        3 update Password
        4 clear all session cookie

 -->




        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="../assets/js/sweetalert.min.js"></script>
        <script src="../assets/js/showHidePass.js"></script>


        <script>
        $.urlParam = function(name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
            return results !== null ? decodeURIComponent(results[1]) : null;
        };




        $('form').on('submit', function(event) {
            event.preventDefault(); // prevent the default form submission behavior

            $.ajax({
                url: 'http://localhost/decastlesampatti/user/verifyResettoken.php',
                type: 'POST',
                dataType: 'json', // Expect JSON response from the server
                data: {
                    password: $('#password').val(),
                    confirm_password: $('#confirm_password').val(),
                    token: $.urlParam('token')
                },
                success: function(data) {

                    console.log(data)
                    if (data.success != undefined) {
                        // do something here 

                        swal({
                            title: "Success!",
                            text: data.success,
                            icon: "success",
                            buttons: {
                                cancel: false, // Hide the cancel button
                                confirm: {
                                    text: 'Login',
                                    value: true,
                                    visible: true
                                }
                            },
                            closeOnClickOutside: false, // Prevent closing by clicking outside the dialog
                        }).then((result) => {
                            if (result) {
                                window.location.href = "login.php"
                            }
                        });
                    }

                    if (data.error != undefined && data.code != undefined) {

                        if (data.code == 102) {
                            // 102 is the error code for token expired 
                            window.location.href = "error.php";
                        } else {
                            $('#error-view').html(data.error)
                            swal({
                                title: "Error",
                                text: data.error,
                                icon: "error",
                            });
                        }
                        console.log(data.error)
                    }
                },
                error: function(xhr, status, error) {

                    console.log(error)
                }
            });
        });
        </script>

    </body>

</html>