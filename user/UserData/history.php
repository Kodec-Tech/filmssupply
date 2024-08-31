<!DOCTYPE html>
<html lang="en">
    <head>
        <title>History</title>
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

    <main>
        <div class="container transactions">
            <h2 class="text-uppercase text-center text-light mt-5"></h2>
            <!-- using triple tabs -->
            <div class="trans_tabs">
                <div class="tab active" data-tab="tab1">Completed</div>
                <div class="tab" data-tab="tab2">Pending</div>
                <div class="tab" data-tab="tab3">Cancelled</div>
            </div>




            <!-- Completed tabs information -->
            <div class="tab-content active" id="tab1">
    
                <!-- grid this man -->
                <div class="overrall_history_card">


 <?php
$status = 'completed';
$taskSql = "SELECT * FROM user_task WHERE acctNo = '$AccountNo' AND status='$status'";
$result = mysqli_query($conn, $taskSql) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    while ($user_task = mysqli_fetch_assoc($result)) {
        
    

?>

                    <!-- flex-column this man -->
                <div class="history_card">
                    <div class="history_card1">
                        <!-- flex this boy -->
                         <div class="card_boy">
                            <h5><span>Order Time: </span><?php echo date('Y-m-d', strtotime($user_task['created_date'])); ?></h5>
                            <h5><span>Order Number: </span><?php echo $user_task['order_number'] ?? ''; ?></h5>
                         </div>
                         <h2><?php
                                    if($user_task['status'] == 'completed'){
                                        echo '<span style="border: solid 1px #7be889;
                                        color: #7be889;
                                        font-weight: bold;
                                        padding: 10px 15px;
                                        border-radius: 30px;""> Completed </span>';
                                    }
                                    ?></h2>
                    </div>
                    <div class="history_card2">
                    <div class="img-container">
                        <img src="../../admin/movies-img/<?php echo $user_task['product_img'] ?? ''; ?>" alt="">
                    </div>
                        <div class="hist_card">
                            <p class="text-center movie_title"><?php echo $user_task['product_title'] ?? ''; ?></p>
                            
                        </div>
                        <!-- grid this boy -->
                        <div class="hcard_stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    <div class="history_card3">
                        <!-- flex this boy -->
                        <div class="card_boy">
                            <h5><span>Total order amount</span></h5>
                            <h5><span>Commission</span></h5>
                            <h5><span>Level</span></h5>
                         </div>
                         <div class="card_boy2">
                            <h5><?php echo $currency . $user_task['product_amount']; ?></h5>
                            <h5><?php echo $user_task['commission_earned']; ?>%</h5>
                            <h5><?php echo $user_task['level']; ?></h5>
                         </div>
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

               
        
            </div>














            

            <!-- Pending tab information -->
            <div class="tab-content" id="tab2">
                <!-- preloader starts -->
                <div id="preloader2" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
                <!-- preloader ends -->
                <!-- grid this man -->
                <div class="overrall_history_card_none">
                  <!-- flex-column this man -->
                  <div class="trans_table no_trans">
                    <img src="../images/img/no_transaction.svg" alt="No transactions">
                    <p>There is no task pending</p>
                </div>
              </div>
            </div>



            

            <!-- Cancelled tab information -->
            <div class="tab-content" id="tab3">
                <!-- preloader starts -->
                <div id="preloader3" class="preloader_tabs">
                    <div class="loader"></div>
                </div>
                <!-- preloader ends -->
                <!-- grid this man -->
                <div class="overrall_history_card">

                <div class="trans_table no_trans">
                    <img src="../images/img/no_transaction.svg" alt="No transactions">
                    <p>There is no task cancelled</p>
                </div>
          

       
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
