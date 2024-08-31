<!DOCTYPE html>
<html lang="en">
  <head>
   

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
    <footer>
      <div class="container footer">
        <!-- static footer navigations -->
        <ul class="navigations">
          <li class="each_nav">
            <a id="DashboardIcon" href="Dashboard.php">
            <img src="../images/real_icons/home.png" alt="" srcset="" class="option_image">
              <p>Home</p>
            </a>
          </li>
          <!-- this nav is invisible -->
          <li class="each_nav invisible">
            <a href="#">
            <img src="../images/real_icons/start.png" alt="" srcset="" class="option_image">
              <p>Start</p>
            </a>
          </li>
          <li class="each_nav">
            <a id="profileIcon" href="profile.php">
            <img src="../images/real_icons/profile.png" alt="" srcset="" class="option_image">
              <p>Profile</p>
            </a>
          </li>
        </ul>
        <!-- task button for positioning -->
        <div class="tasks_btn">
          <a id="tasksIcon" href="tasks.php">
          <img src="../images/real_icons/start.png" alt="" srcset="" class="start_image">
            <p>Start</p>
          </a>
        </div>
      </div>
    </footer>

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
    <script src="../scripts/preloadtabs.js"></script>




    <script>
    // Get the current page URL
var currentPage = window.location.href;

// Extract the filename from the URL
var filename = currentPage.substring(currentPage.lastIndexOf('/') + 1);

// Remove the file extension
filename = filename.split('.php')[0];

// Get the icon corresponding to the current page and add a class to it
var currentIcon = document.getElementById(filename + 'Icon');
if (currentIcon) {
    currentIcon.style.color = '#f2a51f';
    
}

// Special handling for the "More" link
if (filename === 'profile') {
    var moreIcon = document.getElementById('profileIcon');
    if (moreIcon) {
        moreIcon.style.color = '#f2a51f';
    }
}

</script>


  </body>
</html>
