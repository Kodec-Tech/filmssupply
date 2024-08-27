<?php
include "../connection.php";

if(isset($_GET['id'])){

    $id = ($_GET['id']);


    $sql = "DELETE FROM products WHERE product_id= '$id';" ;
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    
    header("location: ../Dashboard.php?msg=deleted");

}

