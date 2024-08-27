<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Security Settings</title>
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


    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        >
        
  </head>

  <body>

  <?php
        include "header.php";
        ?>

    <main>
        <div class="container withdrawal">

        <?php
    
    if (!isset($_GET['msg'])){

    }else{
        $validator = $_GET['msg'];

        if($validator == 'successPass'){
            echo '<div class="alert bg-success text-white alert-dismissible fade show role="alert">  
            password updated successfully
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }
        elseif($validator == 'pinNotMatch'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Your pin did not match
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }

        elseif($validator == 'pinNotUptoSix'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Your pin is not upto six numbers
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }

        elseif($validator == 'poorPass'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            New password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 6 characters long.
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }

        elseif($validator == 'wrongPass'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Password did not match retype password.
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }

        elseif($validator == 'successPin'){
            echo '<div class="alert bg-success text-white alert-dismissible fade show role="alert">  
            Withdrawal pin updated successfully
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';


        }


    }
    ?>



            <!-- <h2 class="text-uppercase text-center text-light mb-5">Password</h2> -->
            <!-- flex the withdrawal head -->
             <div class="w_head" style="border-bottom: none!important;">
                <h3 class="text-light pin_option">Change Password</h3>
             </div>
             <!-- withdrawal form -->
             
              <!-- <div class="mb-5 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label">Create Withdrawal Pin</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div> -->
              <form action="../php-files/update-pwd.php" method="POST">
                <div class="mb-5 text-light withdraw_form">
                  <label for="exampleInputEmail1" class="form-label">Input Old Password</label>
                  <input type="password" class="form-control" name="oldPassword" id="" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-5 text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">Input New Password</label>
                    <input type="password" class="form-control" name="newPassword" id="" aria-describedby="emailHelp" required>
                </div>
                <div class="text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="cPassword" id="" aria-describedby="emailHelp" required>
                </div>
                <div class="mt-5 mb-3 text-light text-center withdraw_form">
                  
                </div>
                <button type="submit" class="btn request_button mt-5 text-light p-2" name="submitPassword">Change Password</button>

                </form>







                <div class="w_head" style="border-bottom: none!important;">
                  <h3 class="text-light mt-5 pin_option">Change Withdrawal Pin</h3>
                </div>

                <form action="../php-files/update-pwd.php" method="POST">                
                <div class="mb-5 text-light withdraw_form">
                  <label for="exampleInputEmail1" class="form-label">Old Pin</label>
                  <input type="password" class="form-control" name="oldPin" id="" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-5 text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">New Pin</label>
                    <input type="password" class="form-control" name="newPin" id="" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-5 text-light withdraw_form">
                    <label for="exampleInputEmail1" class="form-label">Confirm New Pin</label>
                    <input type="password" class="form-control" name="cPin" id="" aria-describedby="emailHelp" required>
                </div>

                <button type="submit" class="btn request_button mt-5 text-light p-2" name="submit-pin">Change Pin</button>
                
              </form>




              <div class="w_head" style="border-bottom: none!important;">
                  <h3 class="text-light mt-5 pin_option">Delete Account</h3>
                </div>

                <form action="../php-files/update-pwd.php" method="POST"">
                   <p class=" text-secondary small ">Permanently remove your Personal
                            Account and all of its contents from the FinBooster platform. This action
                            is not reversible, so please </p>
                <button type="submit" class="btn request_button mt-5 text-light p-2" name="submit-delete">Delete Account</button>

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
