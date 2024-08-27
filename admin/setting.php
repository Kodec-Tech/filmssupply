<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}

include "connection.php";
include "Notification.php";
include "adminData.php";
include "../config.php";





?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Settings</title>

    <!-- Favicons -->
    <!-- <link href="../assets/img/favicon-32x32.ico" rel="icon"> -->
    <link href="../assets/img/apple-icon-180x180.ico" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/accounts/OpenAccount.css">
    <link rel="stylesheet" href="../user/UserData/assets-refined/css/theme-dark.min.css">


    <link rel="stylesheet" href="../admin/css/AdminDash.css">




    <style>
        .table-bordered>tbody>td>tr,
        .table-bordered>thead>td>tr,
        .table-bordered {
            border-bottom: 0;
            border-top: 0;
        }

        .close {
            float: right;
            font-size: 21px;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity=20);
            opacity: .2;
        }

        .close {
            color: #fff;
            opacity: 1;
        }

        /* Style the Image Used to Trigger the Modal */
        .kycImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .kycImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .customodal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .customodal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .customodal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .closebtn {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .closebtn:hover,
        .closebtn:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        .loadingModal {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20%;
        }

        .footer {
            position: relative !important;
        }
    </style>

    <!-- Javascrip -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Enable horizontal scrolling on medium screens and upwards */
        @media (min-width: 992px) {

            /* ul {
    overflow-x: scroll;
  }
   */
            /* Hide the scrollbar */
            ul::-webkit-scrollbar {
                width: 0rem !important;
                height: 0 !important;
            }

            ul::-webkit-scrollbar-thumb {
                height: 0 !important;
                background-color: transparent;
            }

            .nav-link:hover {
                background-color: transparent !important;
            }

            ul::-webkit-scrollbar-thumb {
                height: 1 !important;
                background-color: transparent;
            }
        }
    </style>

</head>

<body class="dark_bg">

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include_once('navbar.php') ?>
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

                            <!-- Nav Item - User Information -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo $AdminProfileInner; ?>">
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->




                    <!-- Tabs -->
                    <div class="col col-md-6 col-xl-8 mx-auto border-bottom border-dark">
                        <ul class="list-unstyled g-3 d-flex nav nav-tabs border-0" style="flex-wrap:nowrap; overflow-x:scroll">

                            <li class="my-3 mx-2 nav-item border-start px-4 border-end px-4 " style=" width: max-content !important;  white-space: nowrap; cursor:pointer" onclick="ShowPage('general')" >
                                <p onclick="ShowPage('general')" class="text-white my-0 p-0" >
                                  
                                    General 
    </p>
                            </li>
                          
                            
                        </ul>
                    </div>
                    <!-- end of tabs  -->




                    <!-- Begin Page Content -->


                    <?php include_once('settingsTabs/general.php') ?>
                    

                    <!--page content stop here -->

                </div>

            </div>


        </div>




       



        <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog loadingModal modal-lg">
                <div class="modal-content" style="width: 50px; height:50px; background: transparent;">
                    <span class="fas fa-spinner fa-pulse fa-3x" style="color:white"></span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <footer class="footer gray_bg">
        <div class="container-fluid">
            <div class="row text-muted">
                <div class="col-6 text-left">
                    <p class="mb-0">
                        <a href="../index.php" class="text-muted light"><strong><?php echo BANKNAME ?>
                            </strong></a> &copy
                    </p>
                </div>
                <div class="col-6 text-right">
                    <ul class="list-inline">
                        <!-- <li class="footer-item">
                                        <a class="text-muted light" href="#">Support</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="#">Help Center</a>
                                    </li> -->
                        <li class="footer-item">
                            <a class="text-muted light" href="../pages/privacypolicy.php">Privacy</a>
                        </li>
                        <li class="footer-item">
                            <a class="text-muted light" href="../pages/terms.php">Terms</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



    <!-- sweet alert cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    <script src="js/depositMoney.js"></script>

    <!-- MDB JS File -->
    <!-- MDB -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script> -->

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
                content: ` <a href="../admin/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

            })


        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>




    <script>
        $(window).on('load', function() {
            $('#purchaseCode').modal('show');
        });
    </script>




    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>

</html>