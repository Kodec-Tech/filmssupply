<?php
include "../connection.php";

if(isset($_POST['user_membership_submit'])){
    
    //grab the id
    $membership = htmlspecialchars($_POST['membership']);
    
    $id = $_POST['numb'];


    $sql = "UPDATE mymembership SET level = ? WHERE level_id = ?;";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $membership, $id);
    mysqli_stmt_execute($stmt);

    header("location: ../upgrade/user.php?msg=success&page=update&id=$id");

   


}
