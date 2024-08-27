<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}
include '../../user/connection.php';
include "../Notification.php";
include "../adminData.php";
include "../../config.php";









?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon-32x32.ico" rel="icon">
    <link href="../../assets/img/apple-icon-180x180.ico" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/boxicons.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/animations.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/transformations.css">


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../admin/css/AdminDash.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
    


    <link rel="stylesheet" href="../../node_modules/alerthub/dist/css/alerthub.min.css">
    <script src="../../node_modules/alerthub/dist/js/alerthub.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>

    <style>

        /* Customize SweetAlert background color */
        .swal2-popup {
        background-color: #333;
        color: #fff;
        }
        .swal2-title{
            color: #fff;
        }
        #swal2-content{
            color: #fff;
        }


        .btn-circle.btn-md {
            width: 65px;
            height: 65px;
            padding: 7px 10px;
            border-radius: 45px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;


        }

        input:focus-visible {
            outline: -webkit-focus-ring-color auto 0px;
        }

        @media(max-width:768px) {
            .ShowHide {
                display: none;
            }
        }


        td {
            color: white !important;
            vertical-align: middle !important;
        }
    </style>


</head>

<body class="dark_bg">   

<?php
if(isset($_GET['page'])){
    $validator = isset($_GET['page']);
    if($validator == 'update'){
        $numb = $_GET['id'];



    $id = isset($_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = '$numb';" ;
    $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        //checking for errors
        $resultcheck = mysqli_num_rows($result);

        if($resultcheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                
                $product_title = $row['product_title'] ;
                $product_amount = $row['product_amount'];
                                
                $product_img = $row['product_img'];
                $membership_level = $row['level'];
                
            }

        }
    }

    $msg = isset($_GET['msg']);
if ($msg == 'success') {
    // Trigger SweetAlert on successful approval
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Updated successfully',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'cryptoinvestment.php'; 
            });
          </script>";

}

}




        
?>

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include_once('nav.php'); ?>
        <!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


            <div id="content">

                <div class="container-fluid px-2  px-lg-5  px-md-0">
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


                            <li>
                                <a class="nav-link" href="#" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img id="AdminDropdown" class="img-profile rounded-circle" src="../<?php echo $AdminProfile; ?>">
                                </a>
                            </li>

                        </ul>

                    </nav>



                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-0  pt-2 px-lg-4 dark_bg light ">

                        <div class="col col-md-10 col-lg-8 col-xl- px-0  mx-auto py-4 my-5">
                            <div class="col mb-5">
                                <h2>Movie Editor Settings</h2>
                                <p class="text-white">Here you can easily add movies for users.
                                </p>
                            </div>



                            <form action="../includes/addMovie3.inc.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $numb ?>" name="numb">
                                <div class="col my-3">
                                    <div class="col px-0 mb-3 fw-bold text-decoration-underline">
                                       
                                    </div>



                                    <label>Movie Title:</label>

                                    <input class="form-control bg-transparent text-white  " style="border:2px solid #616161 !important; border-radius:7px !important" type="text" value="<?php if(isset($_GET['id'])){
                                        echo $product_title;
                                    } 
                                    ?>" name="product_title" id="title" require>
                                </div>



                               

                                <div class="col my-3">
                                    
                                    <div class="d-block d-md-flex align-items-center  gx-md-2 mb-3 bg-transparent text-white">
                                        <div class="col px-0 mt-2 pr-md-2">

                                            <label for="min_value">Movie Amount (USDT):</label>

                                            <input class="form-control bg-transparent text-white" type="number" 
                                            name="product_amount" 
                                            value="<?php if(isset($_GET['id'])){
                                        echo $product_amount;
                                    } 
                                    ?>"  style="border:2px solid #616161 !important; border-radius:7px !important" step="0.001" required>
                                        </div>

                                        <div class="col px-0 mt-2 pr-md-2">
                                            <label for="max_value">Commission (%):</label>

                                            <input class="form-control bg-transparent text-white" type="number" 
                                            name="commission" 
                                            step="0.001"
                                            readonly
                                            value="1.8" id="max_value" style="border:2px solid #616161 !important; border-radius:7px !important" >

                                        </div>
                                    </div>
                                </div>





                                <div class="col my-3">
                                    
                                    <div class="d-block d-md-flex align-items-center  gx-md-2 mb-3 bg-transparent text-white">
                                        <div class="col px-0 mt-2 pr-md-2">

                                            <label for="min_value">Movie Level:</label>

                                            
                                        <input type="text" class="form-control bg-transparent text-white" name="level" value="vvvip" readonly>

                                    

                                            
                                        </div>

                                        <div class="col my-3">
                                    
                                    <label for="product_img">Movie Thumbnail:</label>

                                    <input type="file" 
                                        class="form-control  mb-3  bg-transparent  " style=" height:max-content; border:2px solid #616161 !important; border-radius:7px
                                                !important" aria-label=".form-select-lg example"
                                        name="product_img"
                                        
                                        required
                                        
                                        id="">

                                </div>

                                        
                                    </div>


                                    


                                </div>



                                
                                
                                
                            
                                

                                

                                                                  


                                  

                  <?php if(isset($_GET['id'])){
                    
                    echo '<input type="submit" id="submit" class="btn text-white py-3 bg-success w-100  mt-5" value="Update Movie" name="update_product_submit">';
                  }
                  else{
                  ?>

                
                         <input type="submit" id="submit" class="btn text-white py-3 bg-primary w-100  mt-5" value="Upload Movie" name="upload_product_submit" >

                  <?php
                  }
                  ?>

                            </form>
                        </div>



                        <footer class="footer text-white bg-transparent text-white  mt-auto">
                            <div class="container-fluid px-2">
                                <div class="row text-muted">
                                    <div class="col-6 text-left">
                                        <p class="mb-0">
                                            <a href="../index.php" class="text-muted light"><strong><?php echo BANKNAME ?>
                                                </strong></a> &copy
                                        </p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <ul class="list-inline">

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


                    </div>
                </div>
                <!-- /#page-content-wrapper -->

            </div>
            <!-- /#wrapper -->



        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
                    content: ` <a href="../../admin/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

                })


            });
        </script>







</body>

</html>