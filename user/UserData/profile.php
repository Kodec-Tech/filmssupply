<!doctype html>
<html lang="en">
    <head>
        <title>Profile settings</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    href="../../node_modules/alerthub/dist/css/Alerthub.min.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"
></script>


</head>


 <body class="profile_body">

    
<?php
include("header.php");
?>

        <main class="zoom_profile">
            <div class="container  text-center  text-light">
                
                <div class="profile">
                    <div class="profile-content">
                <img 
                onclick="document.getElementById('profile').click()"
                src="<?php echo $profile; ?>"
                alt="user"
                id="uploadImage"
                accept="image/*" 
                style="width: 56px; height: 60px; border-radius:50px; cursor:pointer"
                class="rounded-circle">



                <input
                type="file"
                name="profile"
                id="profile"
                style="display: none;"
                onchange="updateImage(this)">

                <script>
                    function updateImage(input) {
                    const uploadImage = document.getElementById('uploadImage');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                        uploadImage.src = e.target.result;
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>


                <div class="name">
                    <p><?= $username ?></p>
                    <img src="../images/img/check.png" alt="">
                </div>
                
                <h4><span class="keywords">UID:</span> <?php
                               $account_number = ($AccountNo);
                               echo $account_number;
                               
                    ?></h4>
                <h4><span class="keywords">Referral code:</span> <?= $invite_code ?? '' ?></h4>

                <div class="rank">
                    
                    <?php if( $level === 'vip') {
                    ?>
                    <h3 style="font-size: 14px; margin-bottom: -2px">VIP</h3>
                    <img src="../images/img/vip1.png" alt="">
                   
                   <?php } elseif($level === 'vvip'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px">VVIP</h3>
                   <img src="../images/img/vip2.png" alt="">
   
                   <?php } elseif($level === 'vvvip'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px">VVVIP</h3>
                   <img src="../images/img/vip3.png" alt="">
   
                   <?php } elseif($level === 'gold'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px">GOLD</h3>
                   <img src="../images/img/vip4.png" alt="">

                   <?php } elseif($level === 'diamond'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px">DIAMOND</h3>
                   <img src="../images/img/vip5.png" alt="">

                   <?php } elseif($level === 'normal'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px">Normal</h3>
                   <img src="../images/img/vip0.png" alt="">
                   <?php } ?>

                </div>

                <!-- flex this items -->
                <div class="earn_wallet">
                    <div class="income">
                        <h5><?php echo $currency . ($today_earning  ?? 0); ?></h5>
                        <h4 class="keywords">Today's Profit</h4>
                    </div>
                    <div class="v-line"></div>
                    <div class="income">
                        <h5><?php echo $currency . number_format($balance, 2); ?></h5>
                        <h4 class="keywords">Total Amount</h4>
                    </div>
                </div>
                <!-- assessment -->
                 
                <div class="assessment">
                <p>Credit Assessment</p>
                <div class="score-container">
                    <div class="credit-bar-wrapper">
                        <div class="credit-bar" id="creditBar"></div>
                    </div>
                    <h5 class="d_level" id="creditScore"><?php echo $credit_score ?></h5>
                </div>
                </div>


            </div>
            </div>
                <!-- major profiles here -->
                 <div class="major_profiles" style="margin-top: -20px!important; ">
                    <div class="single_major_profiles">
                        <h2>Transactions</h2>
                        <div class="profile_option">
                            <a href="deposit.php">
                                <p>
                                <img src="../images/real_icons/deposit.png" alt="" srcset="" class="option_image"> <span>Deposit</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="withdraw.php">
                                <p>
                                <img src="../images/real_icons/withdraw.png" alt="" srcset="" class="option_image"> <span>Withdraw</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            
                            <a href="transactions.php">
                                <p>
                                <img src="../images/real_icons/records.png" alt="" srcset="" class="option_image">
                                    <span>Records</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="levels.php">
                                <p>
                                <img src="../images/real_icons/levels.png" alt="" srcset="" class="option_image">
                                    <span>VIP Level</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="filmfaqs.php">
                                <p>
                                <img src="../images/real_icons/faqs.png" alt="" srcset="" class="option_image">
                                    <span>FAQs</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <!-- <a href="history.php">
                                <p>
                                    <img src="../../images/history.png" alt="" srcset="" class="option_image">
                                    <span>Tasks History</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="security.php">
                                <p>
                                    <img src="../../images/security.png" alt="" srcset="" class="option_image">
                                    <span>Security</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">


                                class="no_underline"
                            </a> -->
                            
                        </div>
                        <h2>Profile</h2>
                        <div class="profile_option">
                        <a href="user.php">
                                <p>
                                <img src="../images/real_icons/profile.png" alt="" srcset="" class="option_image">
                                    <span>Edit Profile</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="wallet.php">
                                <p>
                                <img src="../images/real_icons/update-withdraw.png" alt="" srcset="" class="option_image">
                                    <span>Update Withdrawal Details</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <a href="security.php">
                                <p>
                                <img src="../images/real_icons/update-withdraw.png" alt="" srcset="" class="option_image">
                                    <span>Settings</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                        </div>

                        <h2>Contact Us</h2>
                        <div class="profile_option">
                        <a href="support.php">
                                <p>
                                <img src="../images/real_icons/support.png" alt="" srcset="" class="option_image">
                                    <span>Customer Support</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a>
                            <!-- <a href="notice.php">
                                <p>
                                <img src="../images/real_icons/notice.png" alt="" srcset="" class="option_image">
                                    <span>Notifications</span>
                                </p>
                                <img src="../images/real_icons/arrow.png" alt="" srcset="" class="arrow_image">
                            </a> -->
                        </div>







                    </div>
                    <!-- logout here -->
                    <div class="logout_alone">
                        <a href="../logout.php" class="">
                            <h4>Logout</h4>
                        </a>
                    </div>
                    <div class="copyright">
                        <h3>Copyright &copy;<?php echo date('Y'); ?></h3>
                        <h3>FilmSupply Pictures All Rights Reserved</h3>
                    </div>
                 </div>
            </div>
        </main>

 
<script src="../../node_modules/alerthub/dist/js/alerthub.min.js"></script>

<script src="../UserData/js/profile.js"></script>

        
<?php
include("footer.php");
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





      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
document.addEventListener("DOMContentLoaded", function() {
    // Example: Fetch the credit score value from the server or admin setting
    var creditScore = <?php echo $credit_score ?>; // This would be fetched from the PHP backend

    // Update the bar width and the percentage display
    var creditBar = document.getElementById('creditBar');
    var creditScoreText = document.getElementById('creditScore');

    // Calculate the width of the bar based on the credit score
    var newWidth = creditScore + "%";

    creditBar.style.width = newWidth; // Set the new width of the bar
    creditScoreText.textContent = creditScore + "%"; // Update the percentage text

    // Set the color based on the score
    if (creditScore < 50) {
        creditScoreText.style.backgroundColor = "#dc3545"; // Red for low scores
        creditBar.style.backgroundColor = "#dc3545";
    } else if (creditScore < 80) {
        creditScoreText.style.backgroundColor = "#dc3545"; // Yellow for medium scores
        creditBar.style.backgroundColor = "#dc3545";
    } else {
        creditScoreText.style.backgroundColor = "#dc3545"; // Green for high scores
        creditBar.style.backgroundColor = "#dc3545";
    }
});

</script>


 </body>
</html>
