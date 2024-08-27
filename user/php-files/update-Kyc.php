<?php
include_once '../connection.php';
include_once "../../config.php";
session_start();
$AcNo = $_SESSION['AccountNo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'nationalIdFile' and 'selfieIdFile' files were uploaded
    if (isset($_FILES["nationalIdFile"]) && isset($_FILES["selfieIdFile"])) {
        // Process the uploaded files

        // Example of processing the 'nationalIdFile'
        $nationalIdFile = $_FILES["nationalIdFile"];
        $nationalIdFileName = $nationalIdFile["name"];
        $nationalIdFileType = $nationalIdFile["type"];
        $nationalIdFileSize = $nationalIdFile["size"];
        $nationalIdFileTmpName = $nationalIdFile["tmp_name"];

        // processing the 'selfieIdFile'
        $selfieIdFile = $_FILES["selfieIdFile"];
        $selfieIdFileName = $selfieIdFile["name"];
        $selfieIdFileTmpName = $selfieIdFile["tmp_name"];

        // Move the uploaded files to a desired directory
        $nationaltargetDirectory = "../../user/customer_data/SSN_doc/";
        $nationalIduniqueFilename = uniqid() . '_' . $nationalIdFileName;
        $nationaltargetFilePath = $nationaltargetDirectory . $nationalIduniqueFilename;

        $selfietargetDirectory = "../../user/customer_data/Pan_doc/";
        $selfieuniqueFilename = uniqid() . '_' . $selfieIdFileName;
        $selfietargetFilePath = $selfietargetDirectory . $selfieuniqueFilename;

        $nationalIdFileMoved = move_uploaded_file($nationalIdFileTmpName, $nationaltargetFilePath);
        $selfieIdFileMoved = move_uploaded_file($selfieIdFileTmpName, $selfietargetFilePath);

        if ($nationalIdFileMoved && $selfieIdFileMoved) {
            // Files have been successfully uploaded and moved

            // Update the database with the file paths
            $query = "UPDATE customer_detail SET C_Pan_Doc = '$nationaltargetFilePath', kyc_approval = '',
            C_Adhar_Doc = '$selfietargetFilePath' WHERE Account_No = '$AcNo'";

            if (mysqli_query($conn, $query)) {
                // Database update successful
                $response = array('status' => 'success', 'message' => "National ID and selfie file have been uploaded successfully.");
            } else {
                // Error handling if the database update fails
                $response = array('status' => 'error', 'message' => "Database update failed.");
            }
        } else {
            // Error handling if the files couldn't be moved
            $response = array('status' => 'error', 'message' => "Error uploading files.");
        }
    } else {
        // The required file(s) were not uploaded
        $response = array('status' => 'error', 'message' => "Please upload both a National ID and a Selfie.");
    }

    // Send the JSON response
    echo json_encode($response);
}

// Close the database connection and exit
mysqli_close($conn);
exit();



// Send user email for the kyc
