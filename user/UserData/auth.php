<?php
include "../../config.php";
include "../connection.php";

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
$username = $_SESSION['username'];

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
        $isAdmin = $row['Status'];
        
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



include_once('fetchBalance.php');