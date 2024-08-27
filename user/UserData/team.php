<!doctype html>
<html lang="en">
    <head>
        
    </head>

    <body>
    <?php
        include "header.php";
        ?>

        <!-- EVERY OTHER SECTION STARTS HERE -->
        <main class="body-layer">
            <div class="container"> 
                <!-- NEW SECTION STARTS HERE -->
                <section class="de-chart">
                    <h1 style="font-size: 18px;">MARKETING TEAM</h1>


                    <div class="overrall">
                        <div class="charts">
                            <!-- GRID THESE CHILDREN -->
                            <?php
$RefSql = "SELECT * FROM accounts WHERE  referral = '$username' ";
$result = mysqli_query($conn, $RefSql) or die(mysqli_error($conn));
$downlineCount = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $referral = $row['username'];
        
        
    

?>
                            <div class="chart-items">
                                <!-- FLEX THESE ONES -->
                                <div class="chart-topics">
                                    
                                    <h2 style="font-size: 14px;"><?php echo 'Downline ' . $downlineCount++ ?></h2>
                                    <h2 style="font-size: 14px;"><?php echo $referral ?></h2>
                                </div>
                               
                            </div>

                            <?php }}else{
                                echo '
                                <p style="background: #124; color: #fff; padding: 20px; font-size: 14px"> No Downlines
                                </p>
                                ';
                            } ?>

                            

                           

                            
                        </div>
                        <!-- <div class="update">
                            <h3>Complete 3 sets of tasks daily and claim mystery bonus</h3>
                            <h1><em>200 USDT</em></h1>
                        </div> -->
                    </div>
                </section>
            </div>
        </main>

        <!-- THE NAVIGATION IS THE FOOTER -->
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
    </body>
</html>
