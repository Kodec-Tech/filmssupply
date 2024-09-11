<!DOCTYPE html>
<html lang="en">
  <head>
    <title>withdrawal</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="">
        <meta name="theme-color" content="#C70039">
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
    <link rel="stylesheet" href="../css/general.css" />
    <link rel="stylesheet" href="../css/media.css" />
    <!-- Icon -->
    <link rel="shortcut icon" href="../images/img/icon.png" type="image/x-icon" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

  <?php
        include "header.php";
        ?>

<main style="margin-top:20px!important;">
        <div class="container transactions">


         <!-- checking for php errors when issues is encountered with withdrawal -->
         <?php
    
    if (!isset($_GET['msg'])){

    }else{
        $validator = $_GET['msg']; 

        if($validator == 'incorrectPin'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Incorrect withdrawal Pin
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>'; 
            
        }elseif($validator == 'invalidAmount'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            invalid amount provided
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';

        }
        elseif($validator == 'insufficient'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Insufficient funds
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';

        }

        elseif($validator == 'noBindWallet'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            No bind wallet found. please bind your wallet
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';

        }

        elseif($validator == 'success'){
            echo '<div class="alert bg-success text-white alert-dismissible fade show role="alert">  
            Withdrawal request successful
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';

        } 



         }
    ?>

            <h2 class="text-uppercase text-center text-light mb-5">withdrawals</h2>
            <!-- using triple tabs -->
            <div class="trans_tabs">
                <div class="tab active" data-tab="tab1">Withdraw Now</div>
                <div class="tab" data-tab="tab2">Withdrawal History</div>
            </div>


            <!-- commission tabs information -->
            <div class="tab-content active" id="tab1">
            <div class="w_head">
                <h3 class="text-light">Available Balance: <?php echo $currency . number_format($balance, 1); ?></h3>
                
             </div>
             <!-- withdrawal form -->
             <form action="includes/withdrawalscript.inc.php" method="POST">
                <div class="mt-4 mb-3 text-light withdraw_form">
                  <label for="exampleInputEmail1" class="form-label">Amount to withdraw</label>
                  <input type="number" class="form-control" name="withdrawal_amount" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  <!-- <div id="emailHelp" class="form-text text-light">Withdrawal amount must not go beyond the available balance</div> -->
                </div>
                <div class="mt-5 mb-3 text-light">
                  <label for="exampleInputPassword1" class="form-label">Input Withdrawal Pin</label>
                  <input type="password" class="form-control" name="withdrawal_pin" id="exampleInputPassword1" required>
                  <!-- <div id="emailHelp" class="form-text text-light">Input and confirm your login password</div> -->
                </div>
                <button type="submit" class="btn request_button mt-4 text-light p-2" name="submit-withdrawal">Confirm withdrawal</button>
              </form>

              <!-- rules description -->
              <div class="description text-light mt-5">
                <h3 class="mb-3">Rules Description</h3>
                <ol>
                
                  <li>The payment shall be made within 24 hours after withdrawal application is requested</li>
                  <li>Incomplete daily order submission is subjected to no withdrawal, all products must be submitted for withdrawal</li>
                </ol>
              </div>
            </div> 
            
            

            <!-- Withdraw tab information -->
            <div class="tab-content" id="tab2">
              <!-- preloader starts -->
              <!-- <div id="preloader2" class="preloader_tabs">
                <div class="loader"></div>
              </div> -->
                <!-- preloader ends -->
              <div class="withdraw_history">
                <div class="withdraw_notice">
                  <p>You will receive your withdrawal within an hour.</p>
                </div>


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




        </div>
    </main>

    <?php
        include "footer.php";
        ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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



        <script>
        $('.alert').alert()
        </script>
  </body>
</html>