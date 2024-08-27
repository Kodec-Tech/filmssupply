<?php
include '../../config.php';
include '../connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

$username = $_SESSION['username'];


try{

    $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE login.Username = '$username'";
$result = mysqli_query($conn, $query) or mysqli_error($conn);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $AccountNo = $row['AccountNo'];
        $Fname = $row['C_First_Name'];
        $Lname = $row['C_Last_Name'];
        $color = $row['ProfileColor'];
        $email = $row['C_Email'];
        $balance = $row['Balance'];
        $phone_num = $row['C_Mobile_No'];


        // for us to know if the user is admin or not 
        if(strtolower($row['Status'])== "super"){
            $_SESSION["isAdmin"] = true;
            $isAdmin = true;
    

        }
    }
    $ProfileText = substr($Fname, 0, 1);
    $_SESSION['AccountNo'] = $AccountNo;
    $_SESSION['ProfileText'] = $ProfileText;
    $_SESSION['ProfileColor'] = $color;
    $_SESSION['email'] = $email;
    $_SESSION['C_First_Name'] = $Fname;
    $_SESSION['C_Last_Name'] = $Lname;
    $_SESSION['profilecolor'] = $color;
    $_SESSION['phone'] = $phone_num;


    
}

}catch(Exception $e){
    $response = array('status' => 'error', 'message' => 'Invalid Data Submission');
    echo json_encode($response);
    exit;
}







if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'])) {
        // Handle the case when 'id' is not provided in the POST data.
        $response = array('status' => 'error', 'message' => 'Invalid Data Submissionasdfghjkl');
        echo json_encode($response);
        exit;
    }

    $id = $_POST['id'];

    // Check if the item is already in the user's favorites
    $checkSql = 'SELECT * FROM favourite WHERE package_id = ? AND AccountNo = ?';
    $checkStmt = mysqli_prepare($conn, $checkSql);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, 'is', $id, $AccountNo);
        $checkResult = mysqli_stmt_execute($checkStmt);
    
        if ($checkResult) {
            $checkRows = mysqli_stmt_num_rows($checkStmt);

            if ($checkRows > 0) {
                // The item is already in the user's favorites, so we should remove it (unfavorite).

                mysqli_stmt_close($checkStmt);
                $deleteSql = 'DELETE FROM favourite WHERE package_id = ? AND AccountNo = ?';
                $deleteStmt = mysqli_prepare($conn, $deleteSql);

                if ($deleteStmt) {
                    mysqli_stmt_bind_param($deleteStmt, 'is', $id, $AccountNo);
                    $deleteResult = mysqli_stmt_execute($deleteStmt);

                    if ($deleteResult) {
                        $response = array('status' => 'success', 'message' => 'Item removed from favorites');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Failed to remove item from favorites');
                    }
                }
            } else {
                // The item is not in the user's favorites, so we should add it (favorite).
                
                $insertSql = 'INSERT INTO favourite (package_id, AccountNo) VALUES (?, ?)';
                $insertStmt = mysqli_prepare($conn, $insertSql);


              

                if ($insertStmt) {
                    mysqli_stmt_bind_param($insertStmt, 'is', $id, $AccountNo);
                    $insertResult = mysqli_stmt_execute($insertStmt);

                    if ($insertResult) {
                        $response = array('status' => 'success', 'message' => 'Item added to favorites');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Failed to add item to favorites');
                    }
                }
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Database error while checking favorites');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Database error while preparing check statement');
    }

    echo json_encode($response);
} else {
    header('Location: ../error.php?error=Invalid Data Submission');
    exit;
}

mysqli_close($conn);