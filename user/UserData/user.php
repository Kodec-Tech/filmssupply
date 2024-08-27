<?php

// Specify the path to your JSON file
$countriesFilePath = 'countries.json';

// Check if the file exists
if (file_exists($countriesFilePath)) {
    // Read the JSON content from the file
    $jsonContent = file_get_contents($countriesFilePath);

    // Parse the JSON content into a PHP array

    $countries = json_decode($jsonContent, true); // Use true to get an associative array

} else {
    // File not found
    echo 'JSON file not found.';
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile details</title>
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

    <main style="margin-top:20px!important;">
        <div class="container userprofile">
            <h2 class="text-uppercase text-center text-light mb-5">User Profile</h2>
            <!-- user profile form -->
            <form class="user_profile_form" action="../php-files/update-Profile.php" method="post">
                <div class="mb-5 form_unit">
                  <label for="disabledTextInput" class="form-label text-light">First name</label>
                  <input type="text" id="disabledTextInput" class="p-2 rounded text-light" value="<?= $firstname ?>" readonly>
              </div>
              <div class="mb-5 form_unit">
                <label for="disabledTextInput" class="form-label text-light">Last name</label>
                <input type="text" id="disabledTextInput" class="p-2 rounded text-light" value="<?= $lastname ?>" readonly>
            </div>
            <div class="mb-5 form_unit">
              <label for="disabledTextInput" class="form-label text-light">Username</label>
              <input type="text" id="disabledTextInput" class="p-2 rounded text-light" value="<?= $username ?>" readonly>
          </div>
                <div class="mb-5 form_unit">
                    <label for="disabledTextInput" class="form-label text-light">Email Address</label>
                    <input type="text" id="disabledTextInput" class="p-2 rounded text-light" value="<?= $email ?>" readonly>
                </div>

                <div class="mb-5 form_unit">
                    <label for="disabledTextInput" class="form-label text-light">Country</label>
                    
                    <select
                    style="background-color: black; color: #fff; padding: 10px 0; border-bottom: 2px solid white; margin-bottom: 7px"
                    aria-label="Default select example"
                    name="country"
                    <?php foreach ($countries as $countryName) { ?>
                       <option
                           value="<?php echo $countryName; ?>"
                           <?php if ($countryName == $country)
                                 echo "selected" ?>
                       >
                           <?php echo $countryName ?>
                     </option>

                    <?php } ?>


                    </select>
                    
                </div>

                <div class="mb-5 form_unit">
                    <label for="disabledTextInput" class="form-label text-light">Phone Number</label>
                    <input type="text" 
                    id="disabledTextInput" 
                    class="p-2 rounded text-light"  
                    value="<?= $phone ?>"
                    name="phone"
                    placeholder="+1(82)....">
                </div>

                <div class="mb-5">
                <input
                  class= "logout"    
                  type="submit"       
                  name="submitProfile"
                  >
                  </div>
                
            </form>
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
