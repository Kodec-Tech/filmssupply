<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the Whatsapp link from the POST request
    $whatsapp_link = $_POST['whatsapp_link'] ?? '';
    $telegram_link = $_POST['telegram_link'] ?? '';


    // Check if the Whatsapp link already exists
    $sql = "SELECT COUNT(*) FROM admin_settings WHERE setting_name = 'social_links'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = $row[0];

    if ($count > 0) {
        // Update the existing Whatsapp link
        $sql = "UPDATE admin_settings SET setting_value = ?, setting_value2 = ? WHERE setting_name = 'social_links'";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ss', $whatsapp_link, $telegram_link);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['success' => true, 'message' => 'link has been updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update link. Please try again later.']);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the update statement.']);
        }
    } else {
        // Insert the new Whatsapp link
        $sql = "INSERT INTO admin_settings (setting_name, setting_value, setting_value2) VALUES ('social_links', ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ss', $whatsapp_link, $telegram_link);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['success' => true, 'message' => 'link has been inserted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert link. Please try again later.']);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the insert statement.']);
        }
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
