<?php
include 'connection.php';
include "script.php";
include "../config.php";

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ../user/UserData/Dashboard.php");
} else {



    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $hashPassword = md5($password);
        $password_err = $username_err = "";

        if (empty(trim($_POST['password'])) && empty(trim($_POST['username']))) {

            header("Location: ../user/login.php?error=Username and Password required");
            exit();
        } elseif (empty(trim($_POST['username']))) {

            $username_err = "Username cannot be blank";
            header("Location: ../user/login.php?error=Username required");
            exit();
        } elseif (empty(trim($_POST['password']))) {

            header("Location: ../user/login.php?error=Password required");
            exit();
        } else {

            $query = "SELECT ID, Username, Password, AccountNo, Status, State FROM login WHERE Username= '{$username}' AND Password= '{$hashPassword}'";

            $result = mysqli_query($conn, $query) or die("Query Fail.");

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $status = $row['Status'];
                    $state = $row['State'];

                    if ($state == 0) {
                        if ($status == "Active") {

                            session_start();
                            $_SESSION['username'] = $row['Username'];
                            $_SESSION['verifyCode'] = $row['Username'];
                            // $_SESSION['id'] = $row['ID'];
                            $_SESSION['accountNo'] = $row['AccountNo'];
                            //For 2factor authentication 
                            //header("Location: ../user/twostepverify.php");
                            //header to dashboard directly

                            header("location: ../user/UserData/Dashboard.php");
                            mysqli_close($conn);
                        } else {
                            header("Location: ../user/login.php?erroractivate=Account not Activated, Kindly Check Your Email For Activation");
                            exit();
                        }
                    } else if ($state == 1) {

                        if ($status == "Super") {


                            $_SESSION['username'] = $row['Username'];
                            // $_SESSION['id'] = $row['ID'];
                            session_start();
                            $_SESSION['accountNo'] = $row['AccountNo'];
                            header("Location: ../admin/Dashboard.php");
                            mysqli_close($conn);
                        } else {
                            header("Location: ../user/login.php?error=Account not Activated");
                            exit();
                        }
                    }
                }
            } else {
                header("Location: ../user/login.php?error=Invalid Credential");
                exit();
            }
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Film Supply - Create a Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="Kodec Technology">
        <meta name="theme-color" content="#C70039">
        <meta name="description" content="Films Supply">

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        >

    <!-- Bootstrap icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/media.css" />
    <link rel="stylesheet" href="css/general.css" />
    <!-- Icon -->
    <link rel="shortcut icon" href="images/img/icon.png" type="image/x-icon" />

    <style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
</style>




<style>
    .fa, .fas{
            margin-top: -10px;
        }
</style>



  </head>

  <body>
    <main>
        <div class="login register">
            <!-- flex these men -->
     <!-- item 1 -->
      <div class="login_img register_img">
        <img src="images/img/login_bg.jpg" alt="">
      </div>
    
    <!-- item 2 -->
    <div class="login_data register">
        <img src="images/img/logo.png" alt="">
        <h4 class="text-light text-center">Create an account so you can explore all the existing jobs</h4>




        <?php
    
    if (!isset($_GET['signup'])){

    }else{
        $validator = $_GET['signup'];

        if($validator == 'empty'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            You did not fill all fields!
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';
            
            }
            elseif($validator == 'invalidmail'){
            echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert">  
            Provide your correct email address.
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>';
            
            }
            elseif($validator == 'char'){
            echo '<div class="alert bg-danger alert-dismissible fade show text-white  role="alert">  
            You used an invalid username (eg. +-^%*&)
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>';
            }

            elseif($validator == 'lowpwd'){
            echo '<div class="alert bg-danger alert-dismissible fade show text-white role="alert">
            Password should be min of 6 max of 8
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
             </div>';
            }
            elseif($validator == 'wrongpwd'){
            echo '<div class="alert bg-danger alert-dismissible text-white fade show role="alert"> 
            You have entered a wrong password.
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
             </div>';
                
            }

            elseif($validator == 'userExist'){
                echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert"> 
                Username already exists!
                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                 </div>';
                    
                }

            elseif($validator == 'wrongInvite'){
                echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert"> 
                Invalid Invitation Code!
                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                 </div>';
                    
                }

                elseif($validator == 'wrongpin'){
                    echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert"> 
                    Enter a 6 digit withdrawal pin
                    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                     </div>';
                        
                    }
                    elseif($validator == 'emailexits'){
                        echo '<div class="alert bg-danger text-white alert-dismissible fade show role="alert"> 
                        Enter a 6 digit withdrawal pin
                        <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                         </div>';
                            
                        }
            
            
        //     elseif($validator == 'success'){
        //     echo '<div class="alert alert-warning alert-dismissible fade show role="alert">  
        //     You have successfully signed up.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button>
        //     </div>';
        //     }
    }

    ?>



        <!-- login form -->
        <form action="validateinfo.php" method="POST">
        <?php if (isset($_GET['error'])) { ?>

<p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

<?php } ?>

            
            <div class="mt-4 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-10 log">Username</label>
                <?php
                if(isset($_GET['username'])){
                    $username = $_GET['username'];
                    echo '
                      <input type="text" 
                      class="form-control" 
                      name="username"
                      id="Username"
                      value="'.$username.'"
                      aria-describedby="emailHelp" 
                      required>';

                }else{
                  echo '<input type="text" 
                  class="form-control" 
                  name="username"
                  id="Username"
                  aria-describedby="emailHelp" 
                  required>';
                }
                ?>

            </div>

            <div class="mt-2 mb-3 text-light withdraw_form">
              <label for="exampleInputEmail1" class="form-label fs-9 log">Firstname</label>
              <?php
              if(isset($_GET['firstname'])){
                  $firstname = $_GET['firstname'];
                  echo '
              <input type="text" 
              class="form-control" 
              autocapitalize="off"
              autocomplete="off"
              autocorrect="off"
              maxlength="32"
              spellcheck="false"
              type="text"
              value="'.$firstname.'" 
              name="firstname"
              aria-describedby="emailHelp" 
              required>';

              }else{
                echo '<input type="text" 
                class="form-control" 
                autocapitalize="off"
                autocomplete="off"
                autocorrect="off"
                maxlength="32"
                spellcheck="false"
                type="text"
                name="firstname"
                aria-describedby="emailHelp" 
                required>';
              }
              ?>
            </div>


            <div class="mt-2 mb-3 text-light withdraw_form">
              <label for="exampleInputEmail1" class="form-label fs-9 log">Lastname</label>
              <?php
              if(isset($_GET['lastname'])){
                  $lastname = $_GET['lastname'];
                  echo '
              <input type="text" 
              class="form-control" 
              autocapitalize="off"
               autocomplete="off"
               autocorrect="off"
               maxlength="32"
               spellcheck="false"
               name="lastname"
               type="text"
               value="'.$lastname.'"
              aria-describedby="emailHelp" 
              required>';

              }else{
                echo '<input type="text" 
                class="form-control" 
                autocapitalize="off"
                 autocomplete="off"
                 autocorrect="off"
                 maxlength="32"
                 spellcheck="false"
                 name="lastname"
                 type="text"
                aria-describedby="emailHelp" 
                required>';
              }
              ?>
              
              </div>

            <div class="mt-2 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Email Address <sub>(optional)</sub></label>
                <?php
                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                    echo '
                <input type="email" 
                class="form-control" 
                name="email"
                value="'.$email.'"
                id="email" 
                aria-describedby="emailHelp" 
                >';

                }else {
                  echo '<input type="email" 
                class="form-control" 
                name="email"
                id="email" 
                aria-describedby="emailHelp" 
                >';
                }
                ?>
                </div>



                <!-- Phone number goes here -->

                <div class="mt-2 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Phone number </label>
                <input type="number" 
                class="form-control" 
                name="phone"
                id="email" 
                aria-describedby="emailHelp" 
                required>
                </div>



            <div class="mt-2 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Withdrawal Pin <sub>(6 digit Pin)</sub></label>
                <?php
                 if(isset($_GET['wrongpin'])){
                   $wrongpin = $_GET['wrongpin'];
                   echo '
                <input type="number" 
                class="form-control" 
                name="withdrawal_pin"
                id="withdrawal"
                value="'.$wrongpin.'"
                aria-describedby="emailHelp" 
                required>';

                 }else{
                  echo '<input type="number" 
                  class="form-control" 
                  name="withdrawal_pin"
                  id="withdrawal"
                  aria-describedby="emailHelp" 
                  required>';
                 }
                 ?>
            </div>

            <div class="mt-2 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Invite Code</label>
                <?php
                 if(isset($_GET['invitecode'])){
                     $invite = $_GET['invitecode'];
                     echo '
                <input type="text" 
                class="form-control" 
                name="invite-code"
                id="referral" 
                value="'.$invite.'"
                aria-describedby="emailHelp" 
                required>';

                
              }else{
                echo '<input type="text" 
                class="form-control" 
                name="invite-code"
                id="referral" 
                aria-describedby="emailHelp" 
                required>';
                 }
                 ?>
            </div>



            <div class="mt-2 mb-3 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Currency</label>

                <select name="currency" id="" class="form-control text-secondary">
                    <option value="$">Dollar ($)</option>
                    <option value="£">Pounds (£)</option>
                </select>
               
            </div>







            <div class="mt-5 mb-5 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Password</label>
                <input type="password" 
                class="form-control" 
                name="password"
                id="password" 
                aria-describedby="emailHelp" 
                required>
            </div>


            <div class="mt-5 mb-5 text-light withdraw_form">
                <label for="exampleInputEmail1" class="form-label fs-9 log">Confirm Password</label>
                <input type="password" 
                class="form-control" 
                name="retype-password"
                id="password" 
                aria-describedby="emailHelp" 
                required>
            </div>
            
           
            
            <button 
            type="submit" 
            name="submit-register"
            id="signup"
            class="btn request_button mt-4 text-light p-2 fs-9">Sign Up</button>

            <div class="mt-1 mb-3 text-light text-center fs-9 withdraw_form log_text">
            <div id="emailHelp" class="form-text text-light">Already have an account? <a href="login.php" class="log_register fs-9">Login</a></div>
              </div>
          </form>
    </div>
        </div>
    </main>




    




    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <script src="../assets/js/showHidePass.js"></script>
        
        <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();

        });
        </script>



        <script>
        $('.alert').alert()
        </script>
    
  </body>
</html>
