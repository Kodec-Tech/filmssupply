<!doctype html>
<html lang="en">
    <head>
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

    <body class="dashboard_body">

    <?php
    include"header.php";
    ?>

        <main style="margin-top:30px!important">
        <h1 class="container" style="font-size: 14px; color: #fff; border-bottom: none!important;"><?php echo  getGreeting().", ".ucfirst($username) ?> </h1>
            
            <!-- this is a notice -->
            <div class="container moving-text-container">
                <i class="bi bi-bell-fill bell"></i>
                <div class="moving-text">Welcome to FILMSUPPLY, if you need more information, please contact online customer service. Thank you</div>
            </div>


            <div class="container contents_body zoom_dash">
                <!-- this is hero GIF -->
                <!-- <img src="../images/gif/index-movie.gif" alt=""class="hero-gif"> -->
                 <!-- <img src="../images/img/levels.jpeg" alt="" class="levels_img"> -->

                <div class="movie_contents">
                    <!-- these are tabs -->
                    <div class="tab-container">
                        <div class="tab active" id="tab1" onclick="showContent('content1')">Showing Now</div>
                        <!-- <div class="tab" id="tab2" onclick="showContent('content2')">Best Rated</div> -->
                        <div class="tab" id="tab3" onclick="showContent('content3')">Coming Soon</div>
                    </div>

                    <!-- these are the tab contents -->
                    <div class="dropdown-content active" id="content1">
                        <!-- grid these men -->
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon1.jfif" alt="movie1" class="rounded">
                            <p>Suerja 42</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>5</h5>
                            </div>
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon2.jfif" alt="movie1" class="rounded">
                            <p>Imaginary</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>5</h5>
                            </div>
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon3.jfif" alt="movie1" class="rounded">
                            <p>Up FIles</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>5</h5>
                            </div>
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon4.jfif" alt="movie1" class="rounded">
                            <p>Bad Boys</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>4</h5>
                            </div>
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon5.png" alt="movie1" class="rounded">
                            <p>Kraven</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>4</h5>
                            </div>
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon6.jpg" alt="movie1" class="rounded">
                            <p>Kanguva</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <h5>5</h5>
                            </div>
                        </div>
                       
                        
                    </div>

                    <!-- content 2 items -->
                    <div class="dropdown-content" id="content2">
                        <!-- grid these men -->
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/movie2.jpeg" alt="movie1" class="rounded">
                            <p>Movie Name</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                        
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/movie1.jpeg" alt="movie1" class="rounded">
                            <p>Movie Name</p>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <!-- content 3 items -->
                    <div class="dropdown-content" id="content3">
                        <!-- grid these men -->
                        
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/comin_soon7.jfif" alt="movie1" class="rounded">
                            <p>Lies</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/comin_soon8.jpg" alt="movie1" class="rounded">
                            <p>Borderlands</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/coming_soon9.jpg" alt="movie1" class="rounded">
                            <p>Yodha</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>



                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/soon4.jpg" alt="movie1" class="rounded">
                            <p>Kalki</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/soon5.jpg" alt="movie1" class="rounded">
                            <p>RebelMoon</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>
                        <div class="movie">
                            <!-- flex each movie -->
                            <img src="../images/img/soon6.jpg" alt="movie1" class="rounded">
                            <p>Darkness</p>
                            <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- call the footer -->
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
         <script src="../scripts/preloader.js"></script>
    </body>
</html>
