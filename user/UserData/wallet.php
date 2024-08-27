<!DOCTYPE html>
<html lang="en">
  <head>
    <title>wallet binding</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="">
        <meta name="theme-color" content="#C70039">
        <meta name="description" content="Films Supply">

    <head>
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        >
        
    </head>


  <body>

  <?php
        include "header.php";
    ?>

    <main style="margin-top:20px!important;">
        <div class="container withdrawal">

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
            
        
        }
        
        elseif($validator == 'insertedSuccess'){
            echo '<div class="alert bg-success text-white alert-dismissible fade show role="alert">  
            Wallet binded successful
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';

        }

        elseif($validator == 'updatedSuccess'){
          echo '<div class="alert bg-success text-white alert-dismissible fade show role="alert">  
          Wallet binded successful
          <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
           </div>';

      }
        
        
         }
    ?>

            <h2 class="text-uppercase text-center text-light mb-5">Wallet</h2>
            <!-- flex the withdrawal head -->
             <!-- <div class="w_head">
                <h3 class="text-light">Withdrawal method information</h3>
             </div> -->
             <!-- withdrawal form -->

             <?php
                        $check_query = "SELECT * FROM bind_wallet WHERE acctNo = ?";
                        $stmt = mysqli_prepare($conn, $check_query);
                        mysqli_stmt_bind_param($stmt, 's', $AccountNo);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        ?>


             <form action="includes/bindwallet.inc.php" method="POST">
              <div class="mt-1 mb-4 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label">Wallet Type</label>
                <input type="text" class="form-control" id="" name="coin_type" value="<?php echo $row['coin_type'] ?? '' ?>" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text text-light"><sub><em>e.g: Bitcoin, Litecoin, Ethereum, BNB, Solana, XRP, Toncoin, Dogecoin, USDT.</em></sub></div>
            </div>
            <!-- <div class="mt-1 mb-4 text-light withdraw_form">
              <label for="exampleInputEmail1" class="form-label">Wallet Type</label>
              <select name="" id="" class="form-control">
                <option value="">Select wallet type</option>
                <option value="">Bitcoin</option>
                <option value="">Litecoin</option>
                <option value="">USDT</option>
                <option value="">Ethereum</option>
                <option value="">XRP</option>
                <option value="">BNB</option>
                <option value="">Solana</option>
                <option value="">Toncoin</option>
                <option value="">Dogecoin</option>
              </select>
          </div> -->
                <div class="mt-5 mb-4 text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">Wallet Network</label>
                    <input type="text" class="form-control" id="" name="wallet_network" value="<?php echo $row['wallet_network'] ?? '' ?>" aria-describedby="emailHelp" required>
                    <!-- <div id="emailHelp" class="form-text text-light">Input the network of your wallet.</div> -->
                </div>
                <div class="mt-5 mb-4 text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">Wallet Address</label>
                    <input type="text" class="form-control" id="" name="wallet_address" value="<?php echo $row['wallet_address'] ?? ''?>" aria-describedby="emailHelp" required>
                    <!-- <div id="emailHelp" class="form-text text-light">Input your wallet address.</div> -->
                </div>
                <div class="mt-5 mb-4 text-light withdraw_form">
                  <label for="exampleInputEmail1" class="form-label">Withdrawal Pin</label>
                  <input type="password" class="form-control" name="withdrawal_pin" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  <!-- <div id="emailHelp" class="form-text text-light">Enter your withdrawal pin</div> -->
              </div>
                <div class="mt-5 mb-3 text-light text-center fs-5 withdraw_form">
                  <div id="emailHelp" class="form-text text-light">Please, carefully fill this form correctly.</div>
                </div>
                <button type="submit" class="btn request_button mt-5 text-light p-2">Confirm</button>
              </form>
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
        $('.alert').alert()
        </script>
  </body>
</html>
