<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: /user/login.php");
}
unset($_SESSION['EditAccountNo']);
include "../connection.php";
include "../Notification.php";
include "../adminData.php";
include "../../config.php"
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

    <title>Activate Account</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon-32x32.ico" rel="icon">
    <link href="../../assets/img/apple-icon-180x180.ico" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/accounts/OpenAccount.css">

     <!-- css for the datatable -->
     <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">


    <!-- Javascrip -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../css/AdminDash.css">


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

                            <!-- Nav Item - User Information -->
                            <li class="nav-item">
                                <a class="nav-link " href="#" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img id="AdminDropdown" class="img-profile rounded-circle" src="../<?php echo  $AdminProfileInner; ?>">
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
                                    <h1 class="h3 mb-0 light">Customer Accounts</h1>
                                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm light btn-custo "><i class="bx bx-log-out-circle ico"></i>
                                        Logout</a> -->
                                </div>


                                <?php
                                if (isset($_POST['verify_btn'])) {
                                    $DAccountNo = $_POST['verify_id'];
                                    $Dquery = "UPDATE login SET Status = 'Active' WHERE AccountNo = '$DAccountNo'";
                                    $result = mysqli_query($conn, $Dquery) or die('Query Fail');
                                    if ($result) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Your Account Activated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Your Account not Not Activated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    }
                                }

                                if (isset($_POST['Activate_btn'])) {
                                    $DAccountNo = $_POST['Activate_ac'];
                                    $Dquery = "UPDATE login SET Status = 'Deactivated' WHERE AccountNo = '$DAccountNo'";
                                    $result = mysqli_query($conn, $Dquery) or die('Query Fail');
                                    if ($result) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Your Account Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Your Account not Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    }
                                }
                                ?>





                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card gray_bg">
                                            <div class="card-body ">
                                                <h5 class="card-title light mb-4 ">Activate Account</h5>

                                                <form action="ActivateAccount.php" method="POST" class="d-none d-sm-inline-block form-inline navbar-search">
                                                    <div class="input-group">

                                                        <input id="SearchText" name="SearchText" style="margin: bottom 30px;" type="text" class="form-control lightGray_bg light border-bg" placeholder="Search for Account ..." aria-label="Search">

                                                        <div class="input-group-append">
                                                            <button id="search" name="search" class="btn btn-custo" type="button">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Refresh Button -->
                                                        <button style="margin-left: 10px;" id="refresh" class="btn btn-primary" type="button" onclick="reload();">
                                                            Refresh <i class="bx bx-refresh bx-10 ico" style="font-size: 18px;"></i>
                                                        </button>
                                                    </div>

                                                </form>

                                                <div class="table-responsive">

                                                    <table id="EditTable" class="table v-middle" style="margin-top: 30px;">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">#ID</th>
                                                                <th scope="col">Account No</th>
                                                                <th scope="col">Username</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Activate</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="dark_bg">

                                                            <?php

                                                            $query = "SELECT * FROM login WHERE Status='Deactivated'";
                                                            $result = mysqli_query($conn, $query) or die("query fail");

                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {



                                                            ?>
                                                                    <tr>
                                                                        <th class="light" scope="row"><?php echo $row['ID']; ?></th>

                                                                        <td class="light"><?php echo $row['AccountNo']; ?></td>

                                                                        <td class="light"><?php echo $row['Username']; ?></td>

                                                                        <td class="light"><?php echo $row['Status']; ?></td>

                                                                        <td class="light">
                                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                                <input type="hidden" name="verify_id" id="verify_id" value="<?php echo $row['AccountNo']; ?>">
                                                                                <button name="verify_btn" id="verify_btn" type="submit" data-toggle="modal" data-target="#Verify" class="btn btn-success"><i class='bx bx-power-off bx-flip-horizontal'></i>Activate</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <!-- Search Table -->
                                                <div class="table-responsive">

                                                    <table hidden id="SearchTable" class="table v-middle" style="margin-top: 30px;">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">#ID</th>
                                                                <th scope="col">Account No</th>
                                                                <th scope="col">Username</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Activate</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="dark_bg">

                                                            <tr>
                                                                <th id="id" class="light" scope="row"></th>

                                                                <td id="AccountNo" class="light"></td>

                                                                <td id="Fname" class="light"></td>

                                                                <td id="Lname" class="light"></td>

                                                                <td class="light">



                                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                                       

                                                                        <input id="Activate_ac" type="hidden" name="Activate_ac" value="<?php echo $AccountNo ?>">
                                                                        <button name="Activate_btn" type="submit" class="btn btn-success"><i class='bx bx-power-off bx-flip-horizontal'></i> Activate</button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>



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
                                    <a href="../../index.php" class="text-muted light"><strong><?php echo BANKNAME ?>
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

    <script src="../js/activateAc.js"></script>
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


<!-- Modal Here -->
    <!-- <div class="modal fade" id="purchaseCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    </div> -->

    <script>
        $(window).on('load', function() {
            $('#purchaseCode').modal('show');
        });
    </script>


<!-- script for the datatable -->
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

<script>
    new DataTable('#EditTable');
</script>


</body>

</html>