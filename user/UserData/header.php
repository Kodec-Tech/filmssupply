<?php

// include "../connection.php";
include_once('auth.php');
// session_start();

//check maintenance mode
include_once('../script.php');
maintenanceMode($maintenance_mode);

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
$username = $_SESSION['username'];

if($isAdmin == 'Super'){
  header("Location: ../../admin/Dashboard.php");
}

//this file since is included here, will check for all the urls to see if access is denied
include_once ("../threat_response.php");

$query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE login.Username = '$username'";
$result = mysqli_query($conn, $query) or mysqli_error($conn);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $AccountNo = $row['AccountNo'];
        $Fname = $row['C_First_Name'];
        $Lname = $row['C_Last_Name'];
        $color = $row['ProfileColor'];
        $email = $row['C_Email'];
        $balance = $row['Balance'];
        $bonus = $row['bonus'];
        $amount_processing = $row['amount_processing'];
        $phone_num = $row['C_Mobile_No'];

        $profile = $row['ProfileImage'] && !empty($row['ProfileImage']) ? $row['ProfileImage'] : "../images/img/user1.jpg";
        $firstname = $row['C_First_Name'] ?? '';
        $lastname = $row['C_Last_Name'] ?? '';
        $gender = $row['Gender'] ?? '';
        $Account_No = $row['Account_No'] ?? '';
        $country = $row['Country'] ?? '';
        $email = $row['C_Email'] ?? 'no email';
        $phone = $row['C_Mobile_No'] ?? '';

        $currency = $row['currency'] ?? '';

        $credit_score = $row['credit_score'] ?? '';

    }
    $ProfileText = substr($Fname, 0, 1);
    $_SESSION['AccountNo'] = $AccountNo;
    $_SESSION['ProfileText'] = $ProfileText;
    $_SESSION['ProfileColor'] = $color;
    $_SESSION['email'] = $email;
    $_SESSION['C_First_Name'] = $Fname;
    $_SESSION['C_Last_Name'] = $Lname;
    $_SESSION['profilecolor'] = $color;
    $_SESSION['phone'] = $phone_num;
}



// ============ MEMBERSHIP STUFF STARTS HERE ============
//give level empty to avoid errors
$level = '';

$member_sql = "SELECT level FROM mymembership WHERE username = ? AND AcctNo = ?;";
$memberStmt = mysqli_prepare($conn, $member_sql);
mysqli_stmt_bind_param($memberStmt, 'ss', $username, $Account_No);
mysqli_stmt_execute($memberStmt);

// Fetch the result
$memberResult = mysqli_stmt_get_result($memberStmt);

// Check if the user exists and fetch the level
if (mysqli_num_rows($memberResult) > 0) {
    $row = mysqli_fetch_assoc($memberResult);

    $level = $row['level'];

} else {
    $msgErr = "Invalid username or account number.";
}








// SELECT Date, SUM(Credit), SUM(Debit) FROM transaction WHERE AccountNo = '412211317400' GROUP BY Date
$creditChart = "SELECT Date, SUM(Credit) AS credit, SUM(Debit) AS debit FROM transaction WHERE AccountNo = '$AccountNo' GROUP BY Date";


$result = mysqli_query($conn, $creditChart);
$date = array();
$credit = array();
$debit = array();

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $date[] = $row['Date'];
        $credit[] = $row['credit'];
        $debit[] = $row['debit'];
    }
}





$TotalCreditResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND Status = 'Credited'") or mysqli_error($conn);
$CreditTotal = '0';
if (mysqli_num_rows($TotalCreditResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalCreditResult)) {

        $CreditAmount = $row['Amount'];

        $CreditTotal = $CreditTotal + $CreditAmount;
    }
    $CreditTotal;
}

$TotalDebitResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND Status = 'Debited'") or mysqli_error($conn);
$DebitTotal = '0';
if (mysqli_num_rows($TotalDebitResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalDebitResult)) {

        $DebitAmount = $row['Amount'];

        $DebitTotal = $DebitTotal + $DebitAmount;
    }
    $DebitTotal;
}






// Function to get the greeting based on the time
function getGreeting() {
    $currentTime = date('H:i:s'); // Get current time in 24-hour format

    if ($currentTime >= '05:00:00' && $currentTime < '12:00:00') {
        return 'Good Morning';
    } elseif ($currentTime >= '12:00:00' && $currentTime < '17:00:00') {
        return 'Good Afternoon';
    } elseif ($currentTime >= '17:00:00' && $currentTime < '20:00:00') {
        return 'Good Evening';
    } else {
        return 'Good Night';
    }
}





// Fetch today's earnings
$today = date('Y-m-d');
$sql_earnings = "SELECT SUM(commission_earned) as today_earning FROM user_task WHERE acctNo = ? AND DATE(created_date) = CURDATE()";
$stmt_earnings = mysqli_prepare($conn, $sql_earnings);
if ($stmt_earnings === false) {
    die('mysqli error: ' . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt_earnings, "s", $AccountNo);
mysqli_stmt_execute($stmt_earnings);
$result_earnings = mysqli_stmt_get_result($stmt_earnings);
$earnings = mysqli_fetch_assoc($result_earnings);

if ($earnings) {
    $today_earning = $earnings['today_earning'];
    
} else {
    $msg = "No earnings recorded for today.";
}





//fetching the telegram link
$linksql = "SELECT * FROM admin_settings WHERE setting_name = 'social_links'";
$linkresult = mysqli_query($conn, $linksql);

if ($linkresult) {
    $row = mysqli_fetch_assoc($linkresult);
    if ($row) {
        $telegramLink =  $row['setting_value2'];
        $whatsapp_link =  $row['setting_value'];
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to execute query']);
}



// invitation code
$invSql = "SELECT invite_code FROM accounts WHERE AccountNo = '$AccountNo' ";
$result = mysqli_query($conn, $invSql) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $invite_code = $row['invite_code'];

    }

} 







?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Film Supply - Welcome To Your Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="">
        <meta name="theme-color" content="#1C1C1C">
        <meta name="description" content="Film Supply">

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <!-- Bootstrap icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/media.css" />
    <link rel="stylesheet" href="../css/general.css" />
    <!-- Icon -->
    <link rel="shortcut icon" href="../images/img/icon.png" type="image/x-icon" />

    


  </head>

  <body>
    <header>
      <div class="container">
      <!-- <?php
      $query = "SELECT * FROM customer_detail WHERE Account_No = '$AccountNo'";
      $result = mysqli_query($conn, $query) or die("query fail");

      if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_assoc($result)) {
      ?> -->
        <!-- this is the main header -->
        <div class="header_img pt-2">
          <img 
          src="../images/img/logo.png" alt="logo"/>

          

          <!-- this is the event dropdown icon -->
          <div class="dropdown event_dropdown">
            <button class="btn dropdown-toggle event_drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images/real_icons/events.png" alt="" srcset="" class="event_image">
            </button>
            <ul class="dropdown-menu all_tasks_menu">
            <li><a class="dropdown-item" href="levels.php"><p>VIP</p> <i class="bi bi-star"></i></a></li>
              <li><a class="dropdown-item" href="certificate.php"><p>Certificate</p> <i class="bi bi-award"></i></a></li>
              <li><a class="dropdown-item" href="terms.php"><p>Rules</p> <i class="bi bi-info"></i></a></li>
              <li><a class="dropdown-item" href="events.php"><p>Events</p> <i class="bi bi-calendar-event"></i></a></li>
              <li><a class="dropdown-item" href="filmfaqs.php"><p>FAQs</p> <i class="bi bi-question-circle"></i></a></li>
              <li><a class="dropdown-item" href="aboutfilms.php"><p>About Us</p> <i class="bi bi-info-circle"></i></a></li>
            </ul>
          </div>
          



          <!-- <?php
          if (empty($row['ProfileImage']) ||$row['ProfileImage']=="") {
              $ProfileimageLink = "../images/img/user1.jpg";
              ?>
          <img
          style="height: 45px; width: 45px; border-radius:50px"
           src="<?php echo $ProfileimageLink ?>" alt="user" class="rounded-circle"
          />

          <?php
            } else {

            ?>

          <img 
          style="height: 60px; width: 60px; border-radius:50px"
          src="<?php $ProfileimageLink = $row['ProfileImage'];echo $row['ProfileImage'] ?>" alt="user" class="rounded-circle">

          <?php
              }}}
          ?>

        <div class="dropdown-contentDash">
        <a href="profile.php">Profile</a>
        <a href="security.php">Settings</a>
        <a href="../logout.php">Sign out</a> -->
      
        </div>


        </div>
      </div>
    </header>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>

    <!-- custom JavaScript -->
    <script src="../scripts/tabs.js"></script>
    <script src="../scripts/tripletabs.js"></script>
    <!-- <script src="../scripts/preloader.js"></script> -->
  </body>
</html>
