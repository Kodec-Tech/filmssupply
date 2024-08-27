<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: /user/login.php");
}
include "../connection.php";
include "../Notification.php";
include "../adminData.php";
include "../../config.php";

/* 

set id from 1 in sql

SET @autoid := 0;
UPDATE login SET ID = @autoid := (@autoid+1);
ALTER TABLE login AUTO_INCREMENT = 1; 

127.0.0.1/skybank/customer_detail/		http://localhost/phpmyadmin/tbl_sql.php?db=skybank&table=customer_detail
 Showing rows 0 -  4 (5 total, Query took 0.0030 seconds.)

SELECT
    DATE(Create_Date) AS DATE,
    COUNT(C_No)
FROM
    customer_detail
GROUP BY
    DATE(Create_Date)



*/

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <title>Open Account</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/accounts/OpenAccount.css">

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            border-radius: 4px;
            margin-right: 2px;
            opacity: 0.6;
            filter: invert(0.8);
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1
        }
    </style>

    <!-- Javascrip -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body class="dark_bg">

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include_once('nav.php')?>
        <!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


            <div id="content">

                <div class="container-fluid p-0 px-lg-0 px-md-0">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light gray_bg my-navbar">

                        <!-- Sidebar Toggle (Topbar) -->
                        <div type="button" id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                        </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown  d-sm-none">

                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>




                            <!-- Nav Item - User Information -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo  $AdminProfileInner ?>">
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4 dark_bg light">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 light">Open Account</h1>
                                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm light btn-custo "><i class="bx bx-log-out-circle ico"></i>
                                        Logout</a> -->
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card gray_bg">
                                            <div class="card-body ">
                                                <h5 class="card-title light mb-4 ">Create Account</h5>
                                                <form id="regForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">


                                                    <!-- Tab 1 -->

                                                    <div class="tab mb-3">

                                                        <p class="SubAction" style="margin-top: 30px; margin: bottom 10px;">Personal Detail:</p>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input type="text" name="FirstName" class="form-control dark_bg light" id="FirstName" placeholder="First Name">

                                                                    <span id="FnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $First_Name_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">


                                                                    <input type="text" name="LastName" class="form-control dark_bg light" id="Lname" placeholder="Last Name">


                                                                    <span id="LnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Last_Name_error;
                                                                                                                } ?></span>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">


                                                                    <input type="text" name="FatherName" class="form-control dark_bg light" id="FAname" placeholder="Father's Name">

                                                                    <span id="FAnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Father_Name_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">


                                                                    <input type="text" name="MotherName" class="form-control dark_bg light" id="MAname" placeholder="Mother's Name">

                                                                    <span id="MAnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Mother_Name_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input type="date" name="BirthDate" class="form-control dark_bg light" id="BirthDate" placeholder="Birth Date">

                                                                    <span id="AgeError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                echo $Birth_Date_error;
                                                                                                            } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input name="MobileNumber" class="form-control dark_bg light" type="tel" id="MobileNo" pattern="[0-9]{10}" placeholder="Mobile Number" onkeypress="return isNumber(event)">

                                                                    <span id="MobileNoError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                        echo $Mobile_Number_error;
                                                                                                                    } ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input type="text" name="PanNumber" class="form-control dark_bg light" id="PanNo" placeholder="Pan Number">

                                                                    <span id="PanError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                echo $Pan_Number_error;
                                                                                                            } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input name="AdharNumber" class="form-control dark_bg light" type="tel" id="AdharNo" pattern="[0-9]{12}" placeholder="Adhar Number" onkeypress="return isNumber(event)">

                                                                    <span id="AdharError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Adhar_Number_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input type="email" name="email" class="form-control dark_bg light" id="email" placeholder="Email Address">

                                                                    <span id="EmailError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Email_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="col-md mb-3">

                                                                    <input name="pincode" class="form-control dark_bg light" type="tel" id="pincode" pattern="[0-9]{6}" placeholder="Pin Code" onkeypress="return isNumber(event)">

                                                                    <span id="PincodeError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                                    echo $Pincode_error;
                                                                                                                } ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr style="background-color: white; margin-top:60px">

                                                    <!-- Tab 2 -->

                                                    <div class="tab mb-3" id="KycTab">

                                                        <p class="SubAction" style="text-align: center;">Upload SSN Document</p>

                                                        <div class="form-group mb-3">
                                                            <label for="exampleFormControlFile1">Passport Photograph</label>
                                                            <input type="file" name="PanCardUp" class="form-control-file" id="PANCardUp" size="30" accept="image/jpg,image/png,image/jpeg,image/gif">
                                                            <span id="PanUPError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                            echo $Pan_Up_error;
                                                                                                        } ?></span>
                                                        </div>
                                                        <div class="form-groupmb-3" style="align-items: center; justify-content:center;">
                                                            <label for="exampleFormControlFile1">Upload Adhar Card</label>
                                                            <input type="file" name="AdharCardUp" class="form-control-file" id="AdharCardUp" size="30" accept="image/jpg,image/png,image/jpeg,image/gif">
                                                            <span id="AdharUpError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                                            echo $Adhar_Up_error;
                                                                                                        } ?></span>
                                                        </div>
                                                        <span id="mailsendError"></span>
                                                    </div>
                                                    <hr style="background-color: white; margin-top:60px">
                                                    <!-- Tab 3 -->

                                                    <div class="tab">

                                                        <p class="SubAction" style="margin-top: 30px;">Validate Email Account: </p>

                                                        <div class="col-md mb-3">
                                                            <div class="col-md">

                                                                <div class="OtpMobile">
                                                                    <input type="tel" class="form-control dark_bg light" name="Otp" id="Otp" placeholder="Enter 6 Digit OTP" pattern="[0-9]{6}">

                                                                    <span style="color: red;" id="OtpError"></span>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <hr style="background-color: white; margin-top:60px">
                                                        <!-- Tab 4 -->

                                                        <div class="tab">
                                                            <p class="SubAction">Create Username and Password</p>

                                                            <div class="col-md mb-3">
                                                                <div class="col-md">

                                                                    <input type="text" class="form-control dark_bg light" name="Username" id="Username" placeholder="Create Username">


                                                                    <span style="color: red;" id="UsernameError" name="UsernameError"><?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $UsernameError;
                                                                                                                                        } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md mb-3">
                                                                <div class="col-md">

                                                                    <input class="form-control dark_bg light" type="password" name="Password" id="Password" placeholder="Enter Password" data-toggle="tooltip" data-placement="top" title="Enter Password with atleast 8 charater long with 1 Capital 1 small 1 number and 1 special charater">


                                                                    <span style="color: red;" id="PasswordError" name="PasswordError"><?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $PasswordError;
                                                                                                                                        } ?></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md mb-3">
                                                                <div class="col-md">

                                                                    <input class="form-control dark_bg light" type="password" name="ConfirmPass" id="ConfirmPass" placeholder="Confirm Password">


                                                                    <span style="color: red;" id="ConfirmPassError" name="ConfirmPassError"><?php if (isset($_POST['submit'])) {
                                                                                                                                                echo $ConfirmPassError;
                                                                                                                                            } ?></span>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Circles which indicates the steps of the form: -->
                                                    <div class="mb-4" style="margin-top:40px; display:flex; align-items: center; justify-content:center;">
                                                        <input type="submit" class="btn btn-sm btn-primary shadow-sm light btn-custo" style="font-size:20px; width: 200px; height:40px;">

                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>


                </div>






                <footer class="footer gray_bg">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-left">
                                <p class="mb-0">
                                    <a href="index.html" class="text-muted light"><strong><?php echo BANKNAME ?>
                                        </strong></a> &copy
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <ul class="list-inline">
                                    <li class="footer-item">
                                        <a class="text-muted light" href="#">Support</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="#">Help Center</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../../pages/privacypolicy.php">Privacy</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../../pages/terms.php">Terms</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });

        $("#AdminDropdown").click(function() {
            $(this).popover({

                title: 'Profile Detail',
                html: true,
                container: "body",
                placement: 'bottom',
                content: ` <a href="../../admin/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

            })


        });
    </script>

<div class="modal fade" id="purchaseCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Attention!!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger"><strong>As a measure to prevent your account from being hacked, we strongly advise that you do not share your login details with anyone. Knowing that we will never ask you for any of your personal Information.</strong></p>
                    <h5>Contact Developer</h5>
                    <p> <strong> Telegram Id: </strong> @******</p>
                    <p><strong>Email: </strong> email@example.com</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" role="button" type="button" class="btn btn-danger">Report an Issue</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).on('load', function() {
            $('#purchaseCode').modal('show');
        });
    </script>

</body>

</html>