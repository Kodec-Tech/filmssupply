<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: /user/login.php");
}
unset($_SESSION['EditAccountNo']);
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
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        >

        <title>Kyc Verification Requests</title>

        <!-- Favicons -->
        <link
            href="../../assets/img/favicon-32x32.ico"
            rel="icon"
        >
        <link
            href="../../assets/img/apple-icon-180x180.ico"
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
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
        >
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap"
            rel="stylesheet"
        >
        <link
            href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'
            rel='stylesheet'
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
            href="../css/accounts/OpenAccount.css"
        >

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

        .table>:not(caption)>*>* {
            /* padding: .5rem .5rem !important; */
            color: white !important;
            background-color: transparent !important;
            border-bottom-width: 0 !important;
            box-shadow: none !important;

        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #616161 !important;
        }
        </style>



        <!-- Javascrip -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css"
        >
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #616161 !important;
        }

        /* Customize SweetAlert background color */
        .swal2-popup {
            background-color: #333;
            color: #fff;
        }

        .swal2-title {
            color: #fff;
        }

        #swal2-content {
            color: #fff;
        }

        .active {
            background: transparent !important;
        }
        </style>

    </head>

    <body class="dark_bg">
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
                            text: 'Kyc Information approved successfully',
                            confirmButtonText: 'OK'
                        }).then(function() {
                           
                        });
                      </script>";

            }elseif($msg == 'rejected'){
                // Trigger SweetAlert on successful approval
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Rejected!',
                            text: 'Kyc Information Was Rejected',
                            confirmButtonText: 'OK'
                        }).then(function() {
                             
                        });
                      </script>";

            }

            elseif($msg == 'deleted'){
                // Trigger SweetAlert on successful approval
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Deleted!',
                            text: 'Kyc Information Deleted',
                            confirmButtonText: 'OK'
                        }).then(function() {
                           
                        });
                      </script>";

            }
        }
    ?>
        <div id="wrapper">
            <div class="overlay"></div>

            <!-- Sidebar -->
            <?php include_once('nav.php')?>


            <!-- Page Content -->
            <div id="page-content-wrapper">


                <div id="content">

                    <div class="container-fluid p-0 px-lg-0 px-md-0">
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




                                <!-- Nav Item - User Information -->
                                <li class="nav-item">
                                    <a
                                        class="nav-link "
                                        href="#"
                                        role="button"
                                    >
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                        <img
                                            id="AdminDropdown"
                                            class="img-profile rounded-circle"
                                            src="<?php echo  $AdminProfileInner ?>"
                                        >
                                    </a>
                                </li>

                            </ul>

                        </nav>

                        <div class="container-fluid px-0  py-5 px-lg-4 dark_bg light ">
                            <!-- <div class="row border-bottom">
                         <div class="col">
                            <p>Active Investments</p>
                         </div>
                        
                        </div> -->


                            <div class="col px-0">
                                <div class=" ">
                                    <div class="col">
                                        <h1 class="fs-4">Kyc validation Requests</h1>

                                    </div>



                                </div>



                                <!-- ======== bootstrap tabs starts here ========== -->
                                <!-- Tab Navigation -->
                                <ul
                                    class="nav nav-tabs justify-content-center justify-content-md-end mt-4"
                                    id="myTabs"
                                    role="tablist"
                                >
                                    <li
                                        class="nav-item"
                                        role="presentation"
                                    >
                                        <a
                                            class="nav-link active"
                                            id="tab1-tab"
                                            data-bs-toggle="tab"
                                            href="#tab1"
                                            role="tab"
                                            aria-controls="tab1"
                                            aria-selected="true"
                                        >Pending</a>
                                    </li>
                                    <li
                                        class="nav-item"
                                        role="presentation"
                                    >
                                        <a
                                            class="nav-link"
                                            id="tab2-tab"
                                            data-bs-toggle="tab"
                                            href="#tab2"
                                            role="tab"
                                            aria-controls="tab2"
                                            aria-selected="false"
                                        >Approved</a>
                                    </li>
                                    <li
                                        class="nav-item"
                                        role="presentation"
                                    >
                                        <a
                                            class="nav-link"
                                            id="tab3-tab"
                                            data-bs-toggle="tab"
                                            href="#tab3"
                                            role="tab"
                                            aria-controls="tab3"
                                            aria-selected="false"
                                        >Rejected</a>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div
                                    class="tab-content"
                                    id="myTabContent"
                                >

                                    <!-- Tab 1 Content -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="tab1"
                                        role="tabpanel"
                                        aria-labelledby="tab1-tab"
                                    >


                                        <!-- ================ Table for deposits starts here ================= -->
                                        <?php
        $sql = "SELECT * FROM customer_detail WHERE kyc_approval=''   ORDER BY C_No  DESC LIMIT 15";
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
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending kyc approval </p>
            </div>
        </div>';

        }else {
           $count = 1;

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
                <thead style="background-color:#6c757d !important">
                    <tr>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">No</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Username</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Country</th>
                        
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Selfie</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4" style="white-space:nowrap">Valid Id</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    if(!empty($row["C_Pan_Doc"]) && !empty($row['C_Adhar_Doc'])){
                    $id = $row['C_No'];
                    $userEmail=$row['C_Email'];
                    $account_No = $row['Account_No'];
                    $username = $row["C_First_Name"].' '.$row['C_Last_Name'] ;
                    $Country = $row["Country"];
                    $selfie = $row["C_Adhar_Doc"];
                    $nationalId = $row["C_Pan_Doc"];
                    // $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $count++ . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$Country  .'</td>
                        
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/' . $selfie .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.  $nationalId .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3">

                        <form action="../includes/kyc.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="Country" value="'.$Country.'">
                        
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
                                    <div
                                        class="tab-pane fade"
                                        id="tab2"
                                        role="tabpanel"
                                        aria-labelledby="tab2-tab"
                                    >

                                        <!-- ================ Table for deposits starts here ================= -->
                                        <?php
        $sql = "SELECT * FROM customer_detail WHERE kyc_approval='approve'   ORDER BY C_No  DESC LIMIT 15";
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
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending kyc approval </p>
            </div>
        </div>';

        }else {
           $count = 1;

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
            <thead style="background-color:#6c757d !important">
            <tr>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">No</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Username</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Country</th>
                
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Selfie</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4" style="white-space:nowrap">Valid Id</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Action</th>
            </tr>
        </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    if(!empty($row["C_Pan_Doc"]) && !empty($row['C_Adhar_Doc'])){
                    $id = $row['C_No'];
                    $userEmail=$row['C_Email'];
                    $account_No = $row['Account_No'];
                    $username = $row["C_First_Name"].' '.$row['C_Last_Name'] ;
                    $Country = $row["Country"];
                    $selfie = $row["C_Adhar_Doc"];
                    $nationalId = $row["C_Pan_Doc"];
                    // $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $count++ . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$Country  .'</td>
                        
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/' . $selfie .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.  $nationalId .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3">

                        <form action="../includes/kyc.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="Country" value="'.$Country.'">
                        
                        <span style="display: flex; justify-content: center; gap: 12px;">
                        
                 
                        
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
                                    <div
                                        class="tab-pane fade"
                                        id="tab3"
                                        role="tabpanel"
                                        aria-labelledby="tab3-tab"
                                    >


                                        <!-- ================ Table for deposits starts here ================= -->
                                        <?php
        $sql = "SELECT * FROM customer_detail WHERE kyc_approval='reject'   ORDER BY C_No  DESC LIMIT 15";
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
                <p class="mt-5" style="color:#616161">This space is empty, there is no pending kyc approval </p>
            </div>
        </div>';

        }else {
           $count = 1;

            echo '<div class="table-responsive mt-4">
            <table
                class="table table-striped border-top-0  w-100"
                style="display:inline-tabl; text-align: center"
            >
            <thead style="background-color:#6c757d !important">
            <tr>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">No</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Username</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Country</th>
                
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Selfie</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4" style="white-space:nowrap">Valid Id</th>
                <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Action</th>
            </tr>
        </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    if(!empty($row["C_Pan_Doc"]) && !empty($row['C_Adhar_Doc'])){
                    $id = $row['C_No'];
                    $userEmail=$row['C_Email'];
                    $account_No = $row['Account_No'];
                    $username = $row["C_First_Name"].' '.$row['C_Last_Name'] ;
                    $Country = $row["Country"];
                    $selfie = $row["C_Adhar_Doc"];
                    $nationalId = $row["C_Pan_Doc"];
                    // $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $count++ . '</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">'.$username  .'</td>
                        <td class="p-md-3">'.$Country  .'</td>
                        
                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/' . $selfie .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3"> <span style="background-color: #fff;  padding: 2px 5px; cursor: pointer;"> <a href="../user/'.  $nationalId .'" target="_blank"><i class="fas fa-info-circle"></i></a>  </span>  </td>

                        <td class="p-md-3">

                        <form action="../includes/kyc.inc.php" method="POST">

                        <input type="hidden" name="num" value="'.$id.'">

                        <input type="hidden" name="Country" value="'.$Country.'">
                        
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




                            <footer class="footer gray_bg">
                                <div class="container-fluid">
                                    <div class="row text-muted">
                                        <div class="col-6 text-left">
                                            <p class="mb-0">
                                                <a
                                                    href="../../index.php"
                                                    class="text-muted light"
                                                ><strong><?php echo BANKNAME ?>
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
                                                    <a
                                                        class="text-muted light"
                                                        href="../../pages/privacypolicy.php"
                                                    >Privacy</a>
                                                </li>
                                                <li class="footer-item">
                                                    <a
                                                        class="text-muted light"
                                                        href="../../pages/terms.php"
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





                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script
                    src="https://code.jquery.com/jquery-3.5.1.js"
                    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
                    crossorigin="anonymous"
                ></script>
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                    crossorigin="anonymous"
                ></script>
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
                <!-- Bootstrap JS  -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    </body>

</html>