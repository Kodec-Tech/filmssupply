<?php
include '../connection.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the account number from the POST request
    $acctNo = $_POST['acctNo'];

    // Check if account number is provided
    if (empty($acctNo)) {
        die(json_encode(['success' => false, 'message' => 'Account number is required']));
    }

    // Prepare the SQL statement to update the user tasks status
    $sql = "UPDATE user_task SET reset = 'true' WHERE acctNo = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 's', $acctNo);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'User tasks have been reset successfully.']);

            

        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reset user tasks. Please try again later.']);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the reset statement.']);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
