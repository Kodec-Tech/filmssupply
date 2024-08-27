<?php

// including files
include 'connection.php';
include "script.php";
include "../config.php";


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
        <title>Forgot Password</title>
        <!-- Favicons -->
        <link
            href="UserData/images/icon.png"
            rel="icon"
        >
        <link
            href="../assets/img/apple-icon-180x180.png"
            rel="apple-touch-icon"
        >


        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
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
        <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/media.css" />
    <link rel="stylesheet" href="css/general.css" />

        <!-- Extra CSS for external module -->
        <style>
        .swal-button {
            max-width: 300px;
            min-width: 250px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
        }

        .swal-footer {
            text-align: center;
        }

        .cover-register{
            background-color: rgba(37, 41, 88, 0.3);
            
            padding: 30px; 
            
        }

        .imgback {
            filter: brightness(90%);
        }

        input:focus-visible {
    outline: -webkit-focus-ring-color auto 0;
    outline-color: -webkit-focus-ring-color;
    outline-style: auto;
    outline-width: 0px;
}
        </style>


    </head>

    <body>

       

        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 position-relative">
            <div class="container login_data">
                <div class=" col col-md-6 mx-auto  text-center border-0">
                    <div class="row ">


                        <div class="col">
                            <div class="">
                            <div class="login_data">
        <img src="images/img/logo.png" alt="">
        <h2 class="text-light text-center mt-3">Forgot Password</h2>
        <h4 class="text-light text-center mt-3">Please enter the email associated with your account</h4>
        </div>

                                <div >

                               



                                <!-- Login Form -->
                                <form
                                    action="forgot.php"
                                    method="POST"
                                >

                                    <?php if (isset($_GET['error'])) { ?>

                                    <p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

                                    <?php } ?>

                                    <div class="form-group  ">
                                        <label
                                            for="email"
                                            class="sr-only text-white"
                                        >Email</label>
                                        <div class=" h-auto">
                                            <input
                                                type="text"
                                                name="email"
                                                id="email"
                                                class="form-control" 
                                                placeholder="Enter email..."
                                                required
                                            >
                                        </div>
                                        <p
                                            id="alert1"
                                            style="color: red;"
                                        ></p>
                                    </div>

                                    <input
                                        name="forgot"
                                        id="forgot"
                                        class=" w-100 text-white  py-2 mb-4 request_button "
                                        type="submit"
                                        value="Forgot Password "
                                    >




                                    <div class="col text-center">
                                        <p class="login-card-footer-text text-white">Already have an account?
                                            <a
                                                href="../user/login.php"
                                                class=" text-blue fw-bold "
                                            >Login here</a>
                                        </p>

                                       

                                    </div>

                                </form>
                                    </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="../assets/js/sweetalert.min.js"></script>
        <script src="../assets/js/showHidePass.js"></script>

        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

        <?php
        // Error Alert for Wrong credential
        if (isset($_GET['error'])) { ?>
        <script>
        swal({
            title: "Error",
            text: "<?php echo $_GET['error'] ?>",
            icon: "error",


        });
        </script>

        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
        <script>
        swal({
            title: "<?php echo $_GET['success'] ?>",
            text: "We have e-mailed your password reset link!",
            icon: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRs85xxUUnTSAYgZ5TiugsxDYMWFLNqsoNkK1SCY2XzZoei6h09pi6HwRc27jaSHB6oJjU&usqp=CAU",
            buttons: {
                cancel: false, // Hide the cancel button
                confirm: {
                    text: "I'm On It",
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
        </script>

        <?php } ?>
        
    </body>

</html>