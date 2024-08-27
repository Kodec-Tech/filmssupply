<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'enable') {
        $setting_value = 'ON';
    } elseif ($action === 'disable') {
        $setting_value = 'OFF';
    } else {
        echo "Invalid action";
        exit;
    }

    $setting_name = 'maintenance_mode';

    // Check if the setting already exists
    $stmt = $conn->prepare("SELECT id FROM admin_settings WHERE setting_name = ?");
    $stmt->bind_param('s', $setting_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Update existing setting
        $stmt = $conn->prepare("UPDATE admin_settings SET setting_value = ? WHERE setting_name = ?");
        $stmt->bind_param('ss', $setting_value, $setting_name);
    } else {
        // Insert new setting
        $stmt = $conn->prepare("INSERT INTO admin_settings (setting_name, setting_value) VALUES (?, ?)");
        $stmt->bind_param('ss', $setting_name, $setting_value);
    }

    if ($stmt->execute()) {
        // echo "Maintenance mode " . strtolower($setting_value);


    } else {
        // echo "Error updating maintenance mode: " . $conn->error;
    }

    $stmt->close();


} else {
    echo "Invalid request method";
}
