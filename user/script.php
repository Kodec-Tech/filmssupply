<!-- Sweet Alert Script -->

<script src="../assets/js/sweetalert.min.js"></script>





<?php

// Fetch the maintenance_mode setting value
$setting_name = 'maintenance_mode';
$query = "SELECT setting_value FROM admin_settings WHERE setting_name = ?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt === false) {
    die('Prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 's', $setting_name);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $maintenance_mode);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Function to check maintenance mode
function maintenanceMode($mode) {
    if ($mode === 'ON') {
        // Redirect to maintenance page
        header('Location: http://localhost/filmssupply/user/maintenance.php');
        exit(); 
    }
}

?>