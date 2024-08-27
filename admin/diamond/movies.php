<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}


include '../../user/connection.php';
include "../../admin/Notification.php";
include "../../admin/adminData.php";
include "../../config.php";






?>


<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        >

        <title>Dashboard</title>

        <!-- Favicons -->
        <!-- <link
            href="../../assets/img/favicon-32x32.ico"
            rel="icon"
        >
        <link
            href="../../assets/img/apple-icon-180x180.ico"
            rel="apple-touch-icon"
        > -->


        <!-- css for the datatable -->
        <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">


        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        >

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap"
            rel="stylesheet"
        >
        <link
            rel="stylesheet"
            href="../../assets/vendor/boxicons/css/boxicons.css"
        >
        <link
            rel="stylesheet"
            href="../../assets/vendor/boxicons/css/boxicons.min.css"
        >
        <link
            rel="stylesheet"
            href="../../assets/vendor/boxicons/css/animations.css"
        >
        <link
            rel="stylesheet"
            href="../../assets/vendor/boxicons/css/transformations.css"
        >


        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap"
            rel="stylesheet"
        >
        <!--fontawesome-->
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous"
        >

        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
        >
        <link
            rel="stylesheet"
            href="../../admin/css/AdminDash.css"
        >
        <link
                rel="stylesheet"
                href="../../node_modules/alerthub/dist/css/alerthub.min.css"
            >
            <script src="../../node_modules/alerthub/dist/js/alerthub.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>

        <style>
        .btn-circle.btn-md {
            width: 65px;
            height: 65px;
            padding: 7px 10px;
            border-radius: 45px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;


        }

        @media (max-width: 768px) {
            .ShowHide {
                display: none;
            }
        }

        td {
            color: white !important;
            vertical-align: middle !important;
        }

        .dropdown-toggle::after {

            display: none;
            ;

        }
        </style>


    </head>

    <body class="dark_bg">

        <div id="wrapper">
            <div class="overlay"></div>

            <!-- Sidebar -->
            <?php include_once('nav.php'); ?>
            <!-- /#sidebar-wrapper -->


            <!-- Page Content -->
            <div id="page-content-wrapper">


                <div id="content">

                    <div class="container-fluid  px-lg-5  px-md-0">
                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light gray_bg my-navbar">

                            <!-- Sidebar Toggle (Topbar) -->
                            <div
                                type="button"
                                id="bar"
                                class="nav-icon1 hamburger animated fadeInLeft is-closed"
                                data-toggle="offcanvas"
                            >
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
                                                <input
                                                    type="text"
                                                    class="form-control bg-light border-0 small"
                                                    placeholder="Search for..."
                                                >
                                                <div class="input-group-append">
                                                    <button
                                                        class="btn btn-primary"
                                                        type="button"
                                                    >
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>


                                <li>
                                <a
                                    class="nav-link"
                                    href="#"
                                    role="button"
                                >
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img
                                        id="AdminDropdown"
                                        class="img-profile rounded-circle"
                                        src="../<?php echo $AdminProfile; ?>"
                                    >
                                </a>
                            </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid  py-5 px-lg-4 dark_bg light ">
                            <!-- <div class="row border-bottom">
                         <div class="col">
                            <p>Active Investments</p>
                         </div>
                        
                        </div> -->


                            <div class="col">
                                <div class="row align-items-center justify-content-between" style="margin-bottom: 18px;">
                                    <div class="col">
                                        <h3 class="fs-3">Manage Movies in Diamond Level</h3>

                                    </div>

                                    <div class="col text-right">
                                        <button class="btn btn-primary px-3"><a
                                                href="addMovies.php"
                                                style="text-decoration:none; color:white;"
                                            >
                                               <i class="fa fa-plus"></i> Add Movies
                                            </a></button>
                                    </div>


                                    
                                </div>
                                <div class="table-responsive">


                                    <table
                                    id="Upgrade"
                                        class="table table-striped border-top-0  w-100"
                                        style="display:inline-tabl"
                                    >
                                        <thead>
                                            <tr class="text-center">
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4">S/N</th>
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Title</th>
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4 text-center">
                                                    Image</th>
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Commission
                                                </th>
                                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Level
                                                </th>
                                                
                                                

                                                <th class="border-top-0 bg-secondary text-white py-3 px-4 text-center ">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                    <?php
                                    $count=1;
                                    $sql = "SELECT * FROM products WHERE level = 'diamond' ORDER BY `product_id` DESC";
                                    $result = $conn->query($sql);

                                    if ($result) { ?> <tbody>

                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($rows = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td class="text-center"><?=$count++ ?></td>
                                                <td class="text-center">
                                                     <?php echo $rows['product_title']; ?>
                                                </td>
                                               
                                                
                                                <td class="text-center ">
                                                    <img src="<?= $rows['product_img'] ?>" alt="" 
                                                    style="width: 80px; height: 75px; border-radius:30px">
                                                
                                                </td>
                                                
                                                <td class="text-center"><?= $rows['product_amount'] ?></td>

                                                <td class="text-center"><?= $rows['commission'] ?></td>

                                                <td class="text-center"><?= $rows['level'] ?></td>

                                                

                                                
                                                
                                                <td class="text-center dropdown show ">


                                                    <a
                                                        class=" dropdown-toggle"
                                                        href="#"
                                                        role="button"
                                                        id="dropdownMenuLink"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class='custom-dropdown-icon bx bx-menu bx-sm'></i>

                                                    </a>

                                                    <div
                                                        class="dropdown-menu bg-dark text-white"
                                                        aria-labelledby="dropdownMenuLink"
                                                    >
                                                        <a
                                                            class="dropdown-item text-white"
                                                            href="addMovies.php?page=update&id=<?php echo $rows['product_id']?>"
                                                        >Update</a>
                                                        <a
                                                            class="dropdown-item text-white mb-0 "
                                                            style="cursor:pointer"
                                                            href="../includes/deleteMovies.inc.php?id=<?php echo $rows['product_id']?>"
                                                        >Delete</a>

                                                    </div>

                                                </td>


                                            </tr>
                                            <?php
                                                }
                                            }
                                    }


                                    ?>


                                        </tbody>

                                    </table>




                                    <?php
                                if (mysqli_num_rows($result) < 1) { ?>
                                    <div
                                        class="text-center  d-flex align-items-center justify-content-center"
                                        style="min-height:70vh"
                                    >
                                        <div class="col">
                                            <img
                                                src="../img/empty.svg"
                                                class="img-fluid"
                                                style="height:200px"
                                                alt=""
                                            >
                                            <p
                                                class="mt-5"
                                                style="color:#999"
                                            >This space is empty, enjoy the silence or upload movies </p>
                                        </div>
                                    </div>

                                    <?php
                                }

                                ?>
                                </div>

                            </div>
                            <script>
                            const alertInstance = new AlertHub();

                            function deleteItem(id) {

                                console.log(id)
                                $.ajax({
                                    url: "../includes/deleteEstateInv.php", // Replace with the actual URL
                                    type: "POST",
                                    data: {
                                     
                                        'id':id
                                     
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        console.log(response);
                                        if (response.status != "error") {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Deleted!',
                                                text: response.message + '',
                                                confirmButtonText: 'Continue ',
                                                customClass: {
                                                    popup: 'dark-mode-popup',
                                                    header: 'dark-mode-header',
                                                    title: 'dark-mode-title',
                                                    content: 'dark-mode-content',
                                                    confirmButton: 'dark-mode-confirm-button'
                                                }
                                            }).then(function() {
                                                window.location.href =
                                                    '../realestate/estateInvestment.php';
                                            });
                                        } else {
                                            alertInstance.showAlert({
                                                title: "",
                                                description: response.message + "",
                                                type: "danger",
                                                timeout: 6,
                                                animation: "fade-in",
                                            });
                                        }
                                    }
                                });

                            }
                            </script>
                            <footer class="footer bg-transparent mt-auto">
                                <div class="container-fluid">
                                    <div class="row text-muted">
                                        <div class="col-6 text-left">
                                            <p class="mb-0">
                                                <a
                                                    href="../index.php"
                                                    class="text-muted light"
                                                ><strong><?php echo BANKNAME ?>
                                                    </strong></a> &copy
                                            </p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <ul class="list-inline">

                                                <li class="footer-item">
                                                    <a
                                                        class="text-muted light"
                                                        href="../pages/privacypolicy.php"
                                                    >Privacy</a>
                                                </li>
                                                <li class="footer-item">
                                                    <a
                                                        class="text-muted light"
                                                        href="../pages/terms.php"
                                                    >Terms</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </footer>


                        </div>
                    </div>

                </div>

            </div>


            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css"
            >
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script
                src="https://code.jquery.com/jquery-3.5.1.js"
                integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
                crossorigin="anonymous"
            ></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>


            <script>
            $('#bar').click(function() {
                $(this).toggleClass('open');
                $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

            });

            // logout popover on profile 




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
            $(window).on('load', function() {
                $('#purchaseCode').modal('show');
            });
            </script>



            <!-- script for the datatable -->
            <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

            <script>
                new DataTable('#Upgrade');
            </script>


    </body>

</html>