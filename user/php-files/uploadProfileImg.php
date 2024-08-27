<?php

include_once '../connection.php';
include_once "../../config.php";

session_start();
$AcNo = $_SESSION['AccountNo'];

$username = $_SESSION['username'];
if (!isset($_FILES['profile']['error'])) {
    header('Location: ../error.php?error=Invalid Operation -4470');
}


if ($_FILES['profile']['error'] === 0) {
    // Get the uploaded file name
    $filename = $_FILES['profile']['name'];
    $file_extention = pathinfo($filename, PATHINFO_EXTENSION);

      // Specify the directory where you want to store uploaded files
    $uploadDirectory = '../../user/customer_data/Profile_Img/';
    $Valid_Extention = array('png', 'jpg', 'jpeg');


    // Create a unique filename to avoid overwriting existing files
    $uniqueFilename = uniqid() . '_' . $filename;


    if (!in_array($file_extention, $Valid_Extention)) {
        $response = array('status' => 'error', 'message' => 'Invalid File Type');
        echo json_encode($response);
    }

    // Move the uploaded file to the server
    if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadDirectory . $uniqueFilename)) {
        
       
        $query = "UPDATE customer_detail SET ProfileImage= '$uploadDirectory$uniqueFilename' WHERE Account_No = '$AcNo'";

        mysqli_query($conn, $query) or mysqli_error($conn);
        mysqli_close($conn);


        $response = array('status' => 'success', 'message' => 'Profile image is uploaded successfully. Refresh the page to see changes ');
        echo json_encode($response);
    } else {
        // Handle the case where the file couldn't be moved
        $response = array('status' => 'error', 'message' => 'Error uploading your profile image .');
        echo json_encode($response);
    }
} else {
    // Handle the case where there was an error with the file upload
    $response = array('status' => 'error', 'message' => 'Error with file upload: ' . $_FILES['profile']['error']);
    echo json_encode($response);
}
?>