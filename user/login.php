<?php
include 'connection.php';
include "script.php"; //sweetalert and maintenance mode here
include "../config.php";

require __DIR__ . "/threat_response.php";

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ../user/UserData/Dashboard.php");
} else {



    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $hashPassword = md5($password);
        $password_err = $username_err = "";

        if (empty(trim($_POST['password'])) && empty(trim($_POST['username']))) {

            header("Location: ../user/login.php?error=Username and Password required");
            exit();
        } elseif (empty(trim($_POST['username']))) {

            $username_err = "Username cannot be blank";
            header("Location: ../user/login.php?error=Username required");
            exit();
        } elseif (empty(trim($_POST['password']))) {

            header("Location: ../user/login.php?error=Password required");
            exit();
        } else {

            $query = "SELECT ID, Username, Password, AccountNo, Status, State FROM login WHERE Username= '{$username}' AND Password= '{$hashPassword}'";

            $result = mysqli_query($conn, $query) or die("Query Fail.");

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $status = $row['Status'];
                    $state = $row['State'];

                    if ($state == 0) {
                        if ($status == "Active") {

                            //check for maintenance mode
                            maintenanceMode($maintenance_mode);

                            session_start();
                            $_SESSION['username'] = $row['Username'];
                            $_SESSION['verifyCode'] = $row['Username'];
                            // $_SESSION['id'] = $row['ID'];
                            $_SESSION['accountNo'] = $row['AccountNo'];
                            //For 2factor authentication 
                            //header("Location: ../user/twostepverify.php");
                            //header to dashboard directly



                            check_if_banned(true, true, $conn);
                            header("location: ../user/UserData/Dashboard.php");
                            mysqli_close($conn);
                        } else {


                            header("Location: ../user/login.php?Account=deactivated");
                            exit();
                        }
                    } else if ($state == 1) {

                        if ($status == "Super") {


                            $_SESSION['username'] = $row['Username'];
                            // $_SESSION['id'] = $row['ID'];
                            session_start();
                            $_SESSION['accountNo'] = $row['AccountNo'];
                            header("Location: ../admin/Dashboard.php");
                            mysqli_close($conn);
                        } else {
                            header("Location: ../user/login.php?error=Account not Activated");
                            exit();
                        }
                    }
                }
            } else {
                //failure login
                // echo "failed";
                check_if_banned(true, false, $conn);
                header("Location: ../user/login.php?error=Invalid Credential");
                exit();
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Film Supply - Login To Your Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
    <meta name="author" content="Kodec Technology">
    <meta name="theme-color" content="#C70039">
    <meta name="description" content="Films Supply">

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <!-- Bootstrap icons -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/media.css" />
    <link rel="stylesheet" href="css/general.css" />
    <!-- Icon -->
    <link rel="shortcut icon" href="images/img/icon.png" type="image/x-icon" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
    </style>

    <style>
        .fa,
        .fas {
            margin-top: -10px;
        }
    </style>


</head>

<body>
    <main>
        <div class="login">
            <!-- flex these men -->
            <!-- item 1 -->
            <div class="login_img">
                <img src="images/img/login_bg.jpg" alt="">
            </div>

            <!-- item 2 -->
            <div class="login_data">
                <img src="images/img/logo.png" alt="">
                <h2 class="text-light text-center">Welcome Back</h2>
                <h4 class="text-light text-center">You have been missed for a long time</h4>

                <!-- login form -->
                <form
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    method="POST">

                    <?php if (isset($_GET['error'])) { ?>

                        <p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

                    <?php } ?>


                    <div class="mt-4 mb-3 text-light withdraw_form">
                        <label for="exampleInputEmail1" class="form-label fs-9 log">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            id="Username"
                            aria-describedby="emailHelp"
                            required>
                        <div id="emailHelp" class="form-text text-light">Input your username.</div>
                        <p
                            id="alert1"
                            style="color: red;"></p>
                    </div>
                    <div class="mt-5 mb-3 text-light withdraw_form">
                        <label for="exampleInputEmail1" class="form-label fs-9 log">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            id="password"
                            aria-describedby="emailHelp"
                            required>
                        <div id="emailHelp" class="form-text text-light">Input your password.</div>
                    </div>
                    <button type="submit"
                        name="login"
                        id="login"
                        class="btn request_button log_btn mt-5 text-light p-2 fs-9">Sign In</button>
                    <div class="mt-1 mb-3 text-light text-center fs-9 withdraw_form log_text">
                        <div id="emailHelp" class="form-text text-light">Yet to have an account? <a href="CreateAccount.php" class="log_register ">Register now</a></div>
                        <div class="mt-2 form-text"><a class="log_register" href="forgotPassword.php">Forgot Password?</a></div>
                    </div>
                </form>
            </div>
        </div>
    </main>




    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- particle js lib -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <!-- stats.js lib -->
    <script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/showHidePass.js"></script>
    <script>
        // Valid Alert for Login
        <?php if (isset($_GET['Account'])) { ?>
            swal({
  title: "Account Deactivated",
  text: "Your account has been deactivated. Please contact support to resolve the issue and regain access.",
//   icon: "https://cdn-icons-png.flaticon.com/512/15498/15498359.png",

  buttons: {
    cancel: {
      text: "Okay",
      value: null,
      visible: true,
      className: "swal-button--cancel",
      closeModal: true,
    },
  
  },

  className: "swal-custom",  // Optional custom class for further styling
  dangerMode: true, // Adds a red button style for 'confirm' button, suitable for warnings
  closeOnClickOutside: false,  // Prevents closing the alert when clicking outside
  closeOnEsc: false,           // Prevents closing the alert on pressing 'Esc' key
});



        <?php  } ?>

        // Error Alert for Wrong credential
        <?php if (isset($_GET['error'])) { ?>
            swal({
                title: "Check Your Credentials",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",


            });


        <?php } ?>
    </script>

    <script src="../assets/js/showHidePass.js"></script>

    <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();

        });
    </script>











</body>

</html>