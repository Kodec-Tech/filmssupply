<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Customer support</title>
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
    include("header.php");
    ?>

    <main>
        <div class="container support">
            <!-- <h2 class="text-uppercase text-center text-light mb-5">Customer Support</h2> -->
            <div class="w_head">
                <h3 class="text-light text-center">Contact us for questions and further clarifications.</h3>
             </div>
             <!-- flex this man -->
             <div class="support_persons">
                <div class="card rounded chat_person">
                    <img src="../images/img/attendant1.jpeg" class="" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-head">Adnes Nepal</h5>
                      <p class="card-text text-light support_text">Howdy! Got questions you need answers to? Reach out to me today. I am here to serve you to the best of my abilities.<br> Get the best viewing experience with us.</p>
                    </div>
                      <a href="<?php echo $telegramLink ?? '' ?>" target="_blank" class="card-link card_button text-center py-2"><i class="bi bi-telegram"></i> Chat on Telegram</a>
                </div>
                <div class="card rounded chat_person">
                    <img src="../images/img/attendant2.jpg" class="" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-head">Kate Tyler</h5>
                      <p class="card-text text-light support_text">Good day to you. Do you need further clarifications and guidiance? Do not hesitate to contact me. I am available to satisfy you.<br> Get the best viewing experience with us.</p>
                    </div>
                      <a href="<?php echo $whatsapp_link ?? '' ?>" target="_blank" class="card-link card_button text-center py-2"><i class="bi bi-whatsapp"></i> Chat on Whatsapp</a>
                </div>
             </div>
        </div>
    </main>

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
  </body>
</html>
