<?php
    session_start();

    if($_SESSION){
        var_dump($_SESSION);
        // echo $_SESSION['otp'];
    }else{
        echo "no Session yet";
    }
echo '<pre>';
   print_r( $_SERVER);
   echo "</pre>";
?>