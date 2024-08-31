<?php
session_start();

include "../connection.php";
include "../adminData.php";
include "../../config.php";
include "../Notification.php";
//  Error Variables

$First_Name_error =  $Last_Name_error = $Father_Name_error = $Mother_Name_error = null;
$Birth_Date_error = $Mobile_Number_error =  $Pan_Number_error = $Adhar_Number_error = null;
$Email_error = $Pincode_error = null;

//  User varible


if (isset($_POST['EditTable_Edit_btn']) || isset($_POST['Update1'])) {
    $EditAccountNo = $_POST['edit_id'] ?? $_POST['AccountNo'] ?? '';
  
$query = "SELECT * FROM customer_detail 
JOIN accounts ON customer_detail.Account_No = accounts.AccountNo
JOIN login ON accounts.AccountNo = login.AccountNo
WHERE accounts.AccountNo = '$EditAccountNo'";;

    $result = mysqli_query($conn, $query) or die("Error");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $EditFname = $row['C_First_Name'];
            $EditLname = $row['C_Last_Name'];
            $EditFaname = $row['C_Father_Name'];
            $EditManame = $row['C_Mother_Name'];
            $EditBDate = $row['C_Birth_Date'];
            $EditMobileNo = $row['C_Mobile_No'];
            $EditEmail = $row['C_Email'];
            $EditPincode = $row['C_Pincode'];
            $EditAdharDoc = $row['C_Adhar_Doc'];
            $EditPanDoc = $row['C_Pan_Doc'];
            $EditAccountNo = $row['Account_No'];
            $EditProfileImage = $row['ProfileImage'] ? : '../../user/images/img/user1.jpg';
            $kycVerification =$row['kyc_approval'];
            if(empty($kycVerification)){
                $kycBackground = " bg-warning ";
                $kycVerification="No kyc provided";
            }elseif($kycVerification=='approve'){
                $kycBackground = " bg-success ";

                $kycVerification="Approved";
            }else{
                $kycBackground = " bg-danger ";

                $kycVerification="Rejected";
            }
            $WalletBalance = $row['Balance'];
            $amount_processing = $row['amount_processing'] ?? '';
            $createDate =$row['Create_Date'];
            $currency = $row['currency'];


            //catch some pass
            $password = $row['Password'];
            $withdrawal_pin = $row['withdrawal_pin'];
            
        }
    }

  

}




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

        <title>Edit Account</title>

        <!-- Favicons -->
        <link
            href="../../assets/img/favicon-32x32.ico"
            rel="icon"
        >
        <link
            href="../../assets/img/apple-icon-180x180.png"
            rel="apple-touch-icon"
        >

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        >
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
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

        <link rel="stylesheet" href="../css/AdminDash.css">
        

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

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background: #616161 !important;
        }

       
        </style>

        <!-- Javascrip -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
        ::-webkit-scrollbar {
            height: 1px !important;
            /* Remove scrollbar space */
            background: transparent !important;
            /* Optional: make scrollbar invisible */
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .rounded-3 {
            border-radius: 1rem !important;
        }

        .property-details-thumb {
            position: relative;
            /* border-radius: 10px;
    */
            overflow: hidden;

        }

        .property-details-thumb img {

            object-fit: cover;
            -o-object-fit: cover;
            transition: all 0.3s;
        }

        .property-details-thumb:hover img {
            transform: scale(1.1, 1.1);
        }

        .dark-border-hover:hover {
            border: 1.5px solid black !important;
        }

        .dark-border-hover-closed:hover {
            outline: 2px solid #dc3545 !important;
        }

        /* globale variable */

        :root {
            --bg-body: #fff;
            --p-text-color: #7e8186;
            --icon-info-color: #808080;
            --icon-image-color: white;
            --h2-text-color: #1a1a1a;

            --backgound-imgage: #0d6efd;
            --border-view-color: #a4d2c3;
        }

        /* all element */

        /* reset element */

        /* comman style */

        .overlay,
        .img-overlay img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: white;
        }


        /* container style */

        /* cards style */

        .cards {
            grid-column: 2 / span 12;
            display: grid;
            grid-template-columns: repeat(12, minmax(auto, 60px));
            grid-gap: 40px;
            position: relative;
        }

        /* card style */

        .card {
            grid-column-end: span 4;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            /* transition: all 0.3s ease; */

        }

        /* .card:hover {
    transform: translateY(-7px);
} */

        /* img-overlya style */

        .img-overlay {
            width: 100%;
            padding-top: 56.25%;

            position: relative;
            overflow: hidden;
        }

        .img-overlay img {
            width: 100%;
            z-index: 1;
            height: 100%;
        }

        .img-overlay img:hover+div {
            width: 100%;
        }

        figcaption {
            padding: 30px 0 10px 30px;
            font-weight: 600;
            text-transform: capitalize;
            color: white;
            font-size: 1.2rem;
        }

        .overlay {
            width: 100%;
            height: 100%;
            display: none;
            place-content: center;
            background-color: #000000d9;
            opacity: 0;
            z-index: 2;
            /* transition: all 0.5s ease 0.1s; */
        }

        /* .overlay:hover {
    width: 100%;
    opacity: 0.8;
} */

        .overlay:hover>a {
            display: block;
            text-align: center;
            /* border-color: var( --border-view-color );
    */
        }

        .overlay a {
            display: none;
            width: 140px;
            padding: 15px 0;
            text-transform: capitalize;
            /* border: 2px solid transparent;
    */
            transition: border 10s ease;
        }
        </style>
    </head>

    <body class="dark_bg">


        <div id="wrapper">
            <!-- <div class="overlay"></div> -->

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
                                <li class="nav-item ">
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
                                            src="../<?php echo  $AdminProfileInner ?>"
                                        >
                                    </a>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <?php
                    if (isset($_POST['Update1'])) {


                        $EditFname = $_POST['FirstName'];

                        $EditLname = $_POST['LastName'];
                       
                        $EditMobileNo = $_POST['MobileNumber'];
                        $EditEmail = $_POST['email'];
                    
                        $EditAccountNo = $_POST['AccountNo'];

                        //grab for security
                        $EditPassword = $_POST['password'] ?? '';
                        $EditWithdrawal_pin = $_POST['withdrawal_pin'];


                        $hashedPassword = password_hash($EditPassword, PASSWORD_DEFAULT);


                        

                        // ************************************************** Email Validation *********************************************

                        if (!empty($EditEmail)) {
                            if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $EditEmail)) {
                                $Email_error = "* Invalid Email ID";
                            } else {
                                $EditEmail = mysqli_real_escape_string($conn, $_POST['email']);
                                $query2 = "SELECT * FROM customer_detail WHERE C_Email = '" . $EditEmail . "'";

                                $result2 =  mysqli_query($conn, $query2);

                                if (mysqli_num_rows($result2) > 1) {
                                    echo $Email_error = "* Email Already Exist";
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <strong>Email Already Exist!</strong> This Email Already Exist try another one.
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>';
                                }
                            }
                        } else {
                            $Email_error = "* Enter Your Email";
                        }

                       


                            $query3 = "UPDATE customer_detail SET C_First_Name='$EditFname',C_Last_Name='$EditLname',C_Mobile_No='$EditMobileNo',C_Email='$EditEmail', withdrawal_pin = '$EditWithdrawal_pin' WHERE Account_No= '$EditAccountNo'";

                            $result = mysqli_query($conn, $query3) or  die(mysqli_error($conn));

                            if(!empty($EditPassword)){

                                $query4 = "UPDATE login SET Password = '$hashedPassword' WHERE Account_No = '$EditAccountNo')";

                                $result4 = mysqli_query($conn, $query4) or  die(mysqli_error($conn));

                            }

                           


                            if ($result || $result4) {

                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                           <strong>Your Account Updated!</strong> You should check in on some of those fields below.
                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button>
                                         </div>';
                            }
                        
                    }
                    ?>

                        <!-- Begin Page Content -->
                        <div class="container-fluid px-lg-4 dark_bg light">
                            <div class="row">
                                <div class="col-md-12 mt-lg-4 mt-4">
                                    <!-- Page Heading -->
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 light">Edit Account #<?php echo $EditAccountNo ?></h1>

                                        <a href="../accounts/EditAccount.php"><button
                                                name="Edit_another"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm light btn-custo "
                                            ><i class="bx bxs-pencil ico"></i> Edit Another</button></a>

                                    </div>
                                </div>


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
                                
    /* Style the tabs */
    .tab {
      display: none;
    }

    /* Style the tab content */
    .tab-content {
      display: none;
    }
.nav-tabs li.active {
      background-color: #4CAF50;
      color: #fff;
    }
    /* Style the active tab */
    .active {
      display: block;
    }

    /* Optional: Style for better appearance */
    .nav-tabs {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    .nav-tabs li {
      margin-right: 10px;
      cursor: pointer;
    }
  </style>

                                <!-- Tab Navigation -->
                                
                   
<div class="container mt-5 ">
  <ul class="nav-tabs overflow-x-auto border-0 " id="tabs">
    <li onclick="showTab('profile')" style="background: #000000 !important;" id="profiletab"class=" border px-5 py-2  m-0 active">Profile</li>
    
    <li onclick="showTab('investment')" id="investmenttab"class=" border px-5 py-2  m-0" >Task</li>

    <li onclick="showTab('merge')" id="mergetab"class=" border px-5 py-2  m-0" >Grand Order</li>

    <li onclick="showTab('withdrawal')" id="withdrawaltab"class=" border px-5 py-2  m-0" >Withdrawal</li>
    <li onclick="showTab('referral')" id="referraltab"class=" border px-5 py-2  m-0" >Referral</li>
    <!-- <li onclick="showTab('account')" id="accounttab"class=" border px-5 py-2  m-0" >Account</li> -->
    
    <!-- <li onclick="showTab('security')" class=" border px-5 py-2  m-0" >Security</li> -->
  </ul>

  <div class="tab-content" id="profile">
   <!-- Tab 1 Content -->
   <?php include_once('Edit-Tabs/profile.php') ?>
  </div>
  <div class="tab-content" id="investment">
  <?php include_once('Edit-Tabs/taskTab.php') ?>
  </div>

  <div class="tab-content" id="merge">
  <?php include_once('Edit-Tabs/mergeTab.php') ?>
  </div>

  <div class="tab-content" id="withdrawal">
  <?php include_once('Edit-Tabs/WithdrawalTab.php') ?>

  </div>
 <div class="tab-content" id="referral">
  <?php include_once('Edit-Tabs/ReferralTable.php') ?>

  </div>
   <div class="tab-content" id="account">
  </div>
  
 
</div>

<script>
   var profiletab= document.getElementById('profiletab');
 profiletab.click()


  function showTab(tabId) {
    // Hide all tabs
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.style.display = 'none');


      // Remove active class and reset background for all tabs
      const tabLinks = document.querySelectorAll('#tabs li');
    // Remove active class from all tabs
    tabLinks.forEach(link => {
        const element = document.getElementById(link.id);
console.log(tabId)
        if (link.id == tabId+"tab") {
            // Set the background for the active tab
            element.style.background = "#212121";
        } else {
            // Remove active class and reset background for non-active tabs
            element.classList.remove('active');
            element.style.background = "transparent";
        }
    });
  
 



  
    // Show the selected tab
    const selectedTab = document.getElementById(tabId);
    selectedTab.style.display = 'block';

    // Add active class to the selected tab link
    const selectedTabLink = document.querySelector(`.nav-tabs li:contains('${tabId}')`);
    selectedTabLink.classList.add('active');
  

  
  }

  // Custom contains function for selecting elements by text content
  HTMLElement.prototype.containsText = function (text) {
    return this.innerText.includes(text);
  };
  
</script>

                                 

                                </div>



                            </div>

                        </div>




                                <div class="text-white">



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


    </body>

</html>