<?php
include "../connection.php";

//when the button is clicked
if(isset($_POST['submit-newUser'])){


    
    $newUsername = $_POST['newUsername'];
    $userPassword = $_POST['userPassword'];

    $hashPass = md5($userPassword);



 



    //work things if not empty
    if(!empty($newUsername) || !empty($userPassword)){

        $sql = "UPDATE login set Username='$newUsername' WHERE Password='$hashPass'";
        mysqli_query($conn, $sql);

        session_start();
        session_unset();
        session_destroy();

        header("Location: ../login.php");
    }
    else{
        echo 'emptyfields';
        header("location: secureAccount.php");
    }

}