<!DOCTYPE html>
<html lang="en">
  <head>
    <title>VIP Levels</title>
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
        <div class="container levels">

            <h2 class="text-uppercase text-center text-light">Levels</h2>
            
            <div class="rank">
                    
                    <?php if( $level === 'vip') {
                    ?>
                    <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">VIP</h3>
                    <img src="../images/img/vip1.png" alt="">
                   
                   <?php } elseif($level === 'vvip'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">VVIP</h3>
                   <img src="../images/img/vip2.png" alt="">
   
                   <?php } elseif($level === 'vvvip'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">VVVIP</h3>
                   <img src="../images/img/vip3.png" alt="">
   
                   <?php } elseif($level === 'gold'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">GOLD</h3>
                   <img src="../images/img/vip4.png" alt="">

                   <?php } elseif($level === 'diamond'){
                   ?>
                   
                   <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">DIAMOND</h3>
                   <img src="../images/img/vip5.png" alt="">

                   <?php } elseif($level === 'normal'){
                   ?>
                   
                   <!-- <h3 style="font-size: 14px; margin-bottom: -2px; color: #fff;">VIP 0</h3> -->
                   <img src="../images/img/vip0.png" alt="">
                   <?php } ?>

                </div>

            <!-- all levels are here -->
            <div class="level_table zoom_dash">
                <div class="level_card">
                    <div class="level_head">
                        <h2>NORMAL</h2>
                        <img src="../images/img/vip0.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 0.7% per 33 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 7% per premium package</li>
                            <li>No access to other stage.</li>
                        </ul>
                    </div>
                </div>

                <div class="level_card">
                    <div class="level_head">
                        <h2>VIP</h2>
                        <img src="../images/img/vip1.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 0.9% per 35 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 7% per premium package</li>
                        </ul>
                    </div>
                </div>

                <div class="level_card">
                    <div class="level_head">
                        <h2>VVIP</h2>
                        <img src="../images/img/vip2.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 1.5% per 38 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 9% per premium package</li>
                        </ul>
                    </div>
                </div>

                <div class="level_card">
                    <div class="level_head">
                        <h2>VVVIP</h2>
                        <img src="../images/img/vip3.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 2% per 40 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 12% per premium package</li>
                        </ul>
                    </div>
                </div>

                <div class="level_card">
                    <div class="level_head">
                        <h2>GOLD</h2>
                        <img src="../images/img/vip4.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 2.2% per 43 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 12% per premium package</li>
                        </ul>
                    </div>
                </div>

                <div class="level_card">
                    <div class="level_head">
                        <h2>DIAMOND</h2>
                        <img src="../images/img/vip5.png" alt="">
                    </div>
                    <div class="level_body">
                        <ul>
                            <li>Deposit in accordance with our renewal event.</li>
                            <li>Profit of 2.4% per 45 orders per set</li>
                            <li>Better profit and commission</li>
                            <li>Profit of 12% per premium package</li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="all_levels">
                    
                    <h2>VIP 1</h2>
                    <h2>VIP 2</h2>
                    <h2>VIP 3</h2>
                    <h2>VIP 4</h2>
                    <h2>VIP 5</h2>
                </div>
                <div class="level_icon">
                    <img src="../images/img/vip0.png" alt="">
                    <img src="../images/img/vip1.png" alt="">
                    <img src="../images/img/vip2.png" alt="">
                    <img src="../images/img/vip3.png" alt="">
                    <img src="../images/img/vip4.png" alt="">
                    <img src="../images/img/vip5.png" alt="">
                </div> -->

                <div class="level_card">    
                <img src="../images/img/levels.jpeg" alt="levels">
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
        $('.alert').alert()
        </script>
  </body>
</html>
