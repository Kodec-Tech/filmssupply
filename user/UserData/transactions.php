<!DOCTYPE html>
<html lang="en">
  <head>
    <title>transactions</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="">
        <meta name="theme-color" content="#C70039">
        <meta name="description" content="Films Supply">

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

  <?php
        include "header.php";
        ?>

    <main style="margin-top:20px!important;">
        <div class="container transactions">
            <h2 class="text-uppercase text-center text-light mb-5">All Transactions</h2>
            <!-- using triple tabs -->
            <div class="trans_tabs">
                <div class="tab active" data-tab="tab1">Commission</div>
                <div class="tab" data-tab="tab2">Withdrawal</div>
                <div class="tab" data-tab="tab3">Deposit</div>
            </div>


   
<!-- commission tabs information -->
<div class="tab-content active" id="tab1">

<div class="withdraw_history"></div>
<?php
$tranSql = "SELECT * FROM user_task WHERE acctNo = '$AccountNo' ";
$result = mysqli_query($conn, $tranSql) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
 ?>
<div class="withdraw_history_card">
<div class="history_card_left">
  <h5><?php echo ' ' . $row['created_date'] ?></h5>
  <h3>Commission</h3>
  <h2><?php echo $currency . $row['commission_earned'] ?></h2>
  <h3>Level</h3>
  <h2><?php echo ' ' . $row['level'] ?></h2>
 
</div>
<div class="history_card_right">
  <h2><?php
                  if($row['status'] == 'completed'){
                      echo '<span style="border: solid 1px #7be889;
                      color: #7be889;
                      font-weight: bold;
                      padding: 10px 15px;
                      border-radius: 30px;""> successful </span>';
                  }
                  
                  ?></h2>
</div>


</div>
       
     <?php
            }}else{echo '
        
        <div class=" no_trans">
                    <img src="../images/img/no_transaction.svg" alt="No transactions">
                    <p>There is no transaction till now</p>
                </div>
        
        ';}
        ?>
            </div>
  





            <!-- Withdraw tab information -->
            <div class="tab-content" id="tab2">

            <div class="withdraw_history">
                <!-- <div class="withdraw_notice">
                  <p>You will receive your withdrawal within an hour.</p>
                </div> -->


                <?php
 $withdrawal = 'withdrawal';
$DepSql = "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND type = '$withdrawal' ";
$result = mysqli_query($conn, $DepSql) or die(mysqli_error($conn));



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $wamount = $row['Amount'];
        $wdate = $row['Date'];
        $wstatus = $row['Status'];
     
    

?>

 <!-- preloader starts -->
 <div id="preloader2" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
                <!-- preloader ends -->

                <div class="withdraw_history_card">

                  <div class="history_card_left">
                    <h5><?php echo $wdate  ?></h5>
                    <h3>Withdraw Amount</h3>
                    <h2><?php echo $currency . ($wamount) ?></h2>
                  </div>
                  <div class="history_card_right">
                    <h2><?php
                                    if($wstatus == 'approve'){
                                        echo '<span style="border: solid 1px #7be889;
    color: #7be889;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 30px;""> Approved </span>';
                                    }elseif($wstatus == 'Pending'){
                                        echo '<span style="border: solid 1px #DAF7A6;
    color: #DAF7A6;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 30px;"> Pending </span>';
                                    }
                                    else{
                                        echo '<span style="border: solid 1px #C70039;
    color: #C70039;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 30px;"> Rejected </span>';
                                    }
                                    ?></h2>
                  </div>


                </div>



                <?php
            }}else{echo '
                <!-- preloader starts -->
                <div id="preloader2" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
        
        <div class=" no_trans">
                    <img src="../images/img/no_transaction.svg" alt="No transactions">
                    <p>There is no transaction till now</p>
                </div>
        
        ';}
        ?>

              </div>

 

            </div>




            
            <!-- Deposit tab information -->
            <div class="tab-content" id="tab3">

            <div class="withdraw_history"></div>

<?php
 $deposit = 'deposit';
$DepSql = "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND type = '$deposit' ";
$result = mysqli_query($conn, $DepSql) or die(mysqli_error($conn));



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ramount = $row['Credit'];
        $rdate = $row['Date'];
        $rstatus = $row['Status'];
     
    

?>


                <!-- preloader starts -->
                <div id="preloader3" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
                <!-- preloader ends -->


              <div class="withdraw_history_card">

                  <div class="history_card_left">
                    <h5><?php echo $rdate  ?></h5>
                    <h3>Deposit Amount</h3>
                    <h2><?php echo $currency .($ramount) ?></h2>
                  </div>
                  <div class="history_card_right">
                    <h2><?php
                                    if($rstatus == 'Credited'){
                                        echo '<span style="border: solid 1px #7be889;
    color: #7be889;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 30px;""> Credit </span>';
                                    }
                                    else{
                                        echo '<span style="border: solid 1px #C70039;
    color: #C70039;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 30px;"> Debit </span>';
                                    }
                                    ?></h2>
                  </div>


                </div>
            
            <?php
            }}else{echo '
                <!-- preloader starts -->
                <div id="preloader3" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
        
        <div class=" no_trans">
                    <img src="../images/img/no_transaction.svg" alt="No transactions">
                    <p>There is no transaction till now</p>
                </div>
        
        ';}
        ?>

        </div>
        </div>

        </div>
    </main>

    <?php
        include "footer.php";
        ?>

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
    <script src="../scripts/preloadtabs.js"></script>
  </body>
</html>
