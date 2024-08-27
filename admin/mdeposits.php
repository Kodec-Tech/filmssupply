<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}


include '../user/connection.php';
include "../admin/Notification.php";
include "../admin/adminData.php";
include "../config.php";


$TotalCustomer = mysqli_query($conn, " SELECT * FROM customer_detail");
$TotalCustomer = mysqli_num_rows($TotalCustomer);

$ActiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'Active' ");
$ActiveAccount = mysqli_num_rows($ActiveAccount);

$InactiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'inactive' ");
$InactiveAccount = mysqli_num_rows($InactiveAccount);

$DeactiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'Deactivated' ");
$DeactiveAccount = mysqli_num_rows($DeactiveAccount);

$query = "SELECT
DATE(Create_Date) AS DATE,
COUNT(C_No)
FROM
customer_detail
GROUP BY
DATE(Create_Date)
";

$result = mysqli_query($conn, $query);
$date = array();
$data = array();

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $date[] = $row['DATE'];
        $data[] = (int) $row['COUNT(C_No)'];
    }
}


// echo json_encode($data);
// echo json_encode($date); 
// mysqli_close($conn);


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
        <link
            href="../assets/img/favicon-32x32.ico"
            rel="icon"
        >
        <link
            href="../assets/img/apple-icon-180x180.ico"
            rel="apple-touch-icon"
        >

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        >
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap"
            rel="stylesheet"
        >
        <link
            rel="stylesheet"
            href="../assets/vendor/boxicons/css/boxicons.css"
        >
        <link
            rel="stylesheet"
            href="../assets/vendor/boxicons/css/boxicons.min.css"
        >
        <link
            rel="stylesheet"
            href="../assets/vendor/boxicons/css/animations.css"
        >
        <link
            rel="stylesheet"
            href="../assets/vendor/boxicons/css/transformations.css"
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
            href="../admin/css/AdminDash.css"
        >


        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>



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

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            background-color: #616161 !important;
        }

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


        </style>


    </head>

    <body
        class="dark_bg"
        ..
    />

    <?php
        if(!isset($_GET['msg'])){

        }else{
            $msg = $_GET['msg'];
            if ($msg == 'success') {
                // Trigger SweetAlert on successful approval
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'User deposit approved successfully',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'mdeposits.php'; 
                        });
                      </script>";

            }elseif($msg == 'rejected'){
                // Trigger SweetAlert on successful approval
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Rejected!',
                            text: 'User Deposit Was Rejected',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'mdeposits.php'; 
                        });
                      </script>";

            }

            elseif($msg == 'deleted'){
                // Trigger SweetAlert on successful approval
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Deleted!',
                            text: 'User Deposit Deleted',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'mdeposits.php'; 
                        });
                      </script>";

            }
        }
    ?>

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include_once('navbar.php'); ?>
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
                                        src="<?php echo $AdminProfile; ?>"
                                    >
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-0  py-5 px-lg-4 dark_bg light ">
                        <!-- <div class="row border-bottom">
                         <div class="col">
                            <p>Active Investments</p>
                         </div>
                        
                        </div> -->


                        <div class="col px-0">
                            <div class=" ">
                                <div class="col">
                                    <h1 class="fs-4">Manage all users deposit</h1>

                                </div>


                                
                            </div>



<!-- ======== bootstrap tabs starts here ========== -->
<!-- Tab Navigation -->
<ul class="nav nav-tabs justify-content-center justify-content-md-end mt-4" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Pending</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Approved</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Rejected</a>
        </li>
    </ul>
    
    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">

     <!-- Tab 1 Content -->
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
        
        
 <!-- ================ Table for deposits starts here ================= -->
 <?php
        $sql = "SELECT * FROM deposit WHERE status = 'Pending' ORDER BY id DESC LIMIT 15";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        //checking for errors
        $resultcheck = mysqli_num_rows($result);

        if(!$resultcheck > 0){
            echo '<div class="text-center  d-flex align-items-center justify-content-center" style="min-height:70vh">
            <div class="col">
                <img
                    src="img/empty.svg"
                    class="img-fluid"
                    style="height:200px"
                    alt=""
                >
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending deposits </p>
            </div>
        </div>';

        }else {
           

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
                <thead>
                    <tr>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Username</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Method</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Proof</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Date</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $account_No = $row['account_No'];
                    $username = $row["username"];
                    $amount = $row["amount"];
                    $method = $row["method"];
                    $proof = $row["proof"];
                    $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $id  . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$amount  .'</td>
                        <td class="p-md-3">'.$method  .'</td>
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.BANKNAME . $proof .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>
                        <td class="p-md-3">'.$date  .'</td>

                        <td class="p-md-3">

                        <form action="includes/mdeposits.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="amount" value="'.$amount.'">
                        
                        <span style="display: flex; justify-content: center; gap: 12px;">
                        
                        <button 
                        style="background-color: #1877f2; border: none; color: #fff; padding: 7px"
                        name="approve"
                        value="'.$account_No.'"
                        >Approve</button> 
                        
                        <button 
                        style="background: #FF3333; border: none; color: #fff; padding: 7px"
                        name="reject"
                        value="'.$account_No.'"
                        >Reject</button>

                        <button 
                        style="background: #CC0000; border: none; color: #fff; padding: 7px"
                        name="delete"
                        value="'.$account_No.'"
                        >Delete</button>
                        
                        </span>
                        </form>
                        
                        </td>
                    </tr>';
                    
                }

                echo'
            
                </tbody>
            
            </table>
            
            
            <!-- ============== Table for deposits stops here ============== -->
            
             </div>';
                
            
        }
        
        ?>


 
</div>


       
        
        <!-- Tab 2 Content -->
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        
        <!-- ================ Table for deposits starts here ================= -->
 <?php
        $sql = "SELECT * FROM deposit WHERE status = 'Approved' ORDER BY id DESC LIMIT 15";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        //checking for errors
        $resultcheck = mysqli_num_rows($result);

        if(!$resultcheck > 0){
            echo '<div class="text-center  d-flex align-items-center justify-content-center" style="min-height:70vh">
            <div class="col">
                <img
                    src="img/empty.svg"
                    class="img-fluid"
                    style="height:200px"
                    alt=""
                >
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending deposits </p>
            </div>
        </div>';

        }else {
           

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
                <thead>
                    <tr>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Username</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Method</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Proof</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Date</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $account_No = $row['account_No'];
                    $username = $row["username"];
                    $amount = $row["amount"];
                    $method = $row["method"];
                    $proof = $row["proof"];
                    $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $id  . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$amount  .'</td>
                        <td class="p-md-3">'.$method  .'</td>
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.BANKNAME . $proof .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>
                        <td class="p-md-3">'.$date  .'</td>

                        <td class="p-md-3">

                        <form action="includes/mdeposits.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="amount" value="'.$amount.'">
                        
                        <span style="display: flex; justify-content: center; gap: 12px;">
                        
                        
                        <button 
                        style="background: #FF3333; border: none; color: #fff; padding: 7px"
                        name="reject-approved"
                        value="'.$account_No.'"
                        >Reject</button>

                        <button 
                        style="background: #CC0000; border: none; color: #fff; padding: 7px"
                        name="delete"
                        value="'.$account_No.'"
                        >Delete</button>
                        
                        </span>
                        </form>
                        
                        </td>
                    </tr>';
                    
                }

                echo'
            
                </tbody>
            
            </table>
            
            
            <!-- ============== Table for deposits stops here ============== -->
            
             </div>';
                
            
        }
        
        ?>


        </div>



        <!-- Tab 3 Content -->
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">


        <!-- ================ Table for deposits starts here ================= -->
 <?php
        $sql = "SELECT * FROM deposit WHERE status = 'Rejected' ORDER BY id DESC LIMIT 15";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        //checking for errors
        $resultcheck = mysqli_num_rows($result);

        if(!$resultcheck > 0){
            echo '<div class="text-center  d-flex align-items-center justify-content-center" style="min-height:70vh">
            <div class="col">
                <img
                    src="img/empty.svg"
                    class="img-fluid"
                    style="height:200px"
                    alt=""
                >
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending deposits </p>
            </div>
        </div>';

        }else {
           

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
                <thead>
                    <tr>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Username</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Method</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Proof</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Date</th>
                        <th class="border-top-0 bg-secondary text-white py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $account_No = $row['account_No'];
                    $username = $row["username"];
                    $amount = $row["amount"];
                    $method = $row["method"];
                    $proof = $row["proof"];
                    $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $id  . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$amount  .'</td>
                        <td class="p-md-3">'.$method  .'</td>
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.BANKNAME . $proof .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>
                        <td class="p-md-3">'.$date  .'</td>

                        <td class="p-md-3">

                        <form action="includes/mdeposits.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="amount" value="'.$amount.'">
                        
                        <span style="display: flex; justify-content: center; gap: 12px;">
                        
                        <button 
                        style="background-color: #1877f2; border: none; color: #fff; padding: 7px"
                        name="approve"
                        value="'.$account_No.'"
                        >Approve</button> 
                        
                        
                        <button 
                        style="background: #CC0000; border: none; color: #fff; padding: 7px"
                        name="delete"
                        value="'.$account_No.'"
                        >Delete</button>
                        
                        </span>
                        </form>
                        
                        </td>
                    </tr>';
                    
                }

                echo'
            
                </tbody>
            
            </table>
            
            
            <!-- ============== Table for deposits stops here ============== -->
            
             </div>';
                
            
        }
        
        ?>
            


        </div>
    </div>









                        </div>

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
                <!-- /#page-content-wrapper -->

            </div>
            <!-- /#wrapper -->



        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"
        ></script>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous"
        >
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"
        ></script>


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

<!-- Bootstrap JS  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        </body>

</html>