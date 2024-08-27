<?php
include "../connection.php";


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_product_submit'])){

    //grab data
    $product_title = htmlspecialchars($_POST['product_title']) ?? '';
    $product_amount = htmlspecialchars($_POST['product_amount']) ?? 0;
    $commission = htmlspecialchars($_POST['commission']) ?? 0;
    $level = htmlspecialchars($_POST['level']) ?? '';
   








    //Generate order number
    function generateOrderNumber() {
        $prefix = 'ORD-';
        $randomNumber = mt_rand(1000000000, 9999999999); //Generate a random 10-digit number
        $orderNumber = $prefix . $randomNumber; // Concatenate timestamp and random number
        return $orderNumber;
    }
    
    // usage
    $orderNumber = generateOrderNumber();
    


    //Product image upload
    if(!empty($_FILES['product_img']['name'])){
        $productImg_fileName = $_FILES['product_img']['name'];
        $productImg_fileName = preg_replace('/\s/', '_', $productImg_fileName); // replacing space with underscore
    
        $productImg_fileTmpName = $_FILES['product_img']['tmp_name'];
        $productImg_fileError = $_FILES['product_img']['error'];
        $productImg_fileSize = $_FILES['product_img']['size'];
    
        $productImg_fileExt = explode('.', $productImg_fileName);
        $productImg_fileActualExt = strtolower(end($productImg_fileExt));
    
        $allowedExt = array('jpeg', 'jpg', 'png', 'jfif');

        //checking for allowed string
        if(in_array($productImg_fileActualExt, $allowedExt)){

        if($productImg_fileError === 0){

            if($productImg_fileSize < 10000000){

                //Generating a random names for it
                $productImg_newname = $productImg_fileName. date('mjYHis'). '.'.$productImg_fileActualExt;

                // Product Image Destination Variable
                $productImg_destinationFile = '../movies-img/' . $productImg_newname;

                //moving this images to server
                move_uploaded_file($productImg_fileTmpName, $productImg_destinationFile);









            }else{
                header("location: ../diamond/addMovies.php?msg=ImgSizeTooLarge");
            }



        }else{
            header("location: ../diamond/addMovies.php?msg=ImgErrorOccured");
        }



    }else{
        header("location: ../diamond/addMovies.php?msg=notSupportedImg");
    }





    }else{
        header("location: ../diamond/addMovies.php?msg=uploadImg");
    }




    //checks
    if(empty($product_title) || empty($product_amount) || empty($commission) || empty($level) ){
        header("location: ../diamond/addMovies.php?msg=fillAllFields");
    }
    else{

    //Run insertion into database
    $product_query = "INSERT INTO products (product_title, product_amount, order_number, commission, level, product_img) VALUES (?, ?, ?, ?, ?, ?);";
    $stmtProduct = mysqli_prepare($conn, $product_query);

    mysqli_stmt_bind_param($stmtProduct, "ssssss", $product_title, $product_amount, $orderNumber, $commission, $level, $productImg_destinationFile);

    $productResult = mysqli_stmt_execute($stmtProduct);

    if (!$productResult) {
        echo "Error: " . $product_query . "<br>" . mysqli_error($conn);
    }
    header("location: ../diamond/movies.php?msg=success");


    }

















}elseif(isset($_POST['update_product_submit'])){
    
    //grab data
    $product_title = htmlspecialchars($_POST['product_title']) ?? '';
    $product_amount = htmlspecialchars($_POST['product_amount']) ?? 0;
    $commission = htmlspecialchars($_POST['commission']) ?? 0;
    $level = htmlspecialchars($_POST['level']) ?? '';

    $id = $_POST['numb'];


    

    //Product image upload
    if(!empty($_FILES['product_img']['name'])){
        $productImg_fileName = $_FILES['product_img']['name'];
        $productImg_fileName = preg_replace('/\s/', '_', $productImg_fileName); // replacing space with underscore
    
        $productImg_fileTmpName = $_FILES['product_img']['tmp_name'];
        $productImg_fileError = $_FILES['product_img']['error'];
        $productImg_fileSize = $_FILES['product_img']['size'];
    
        $productImg_fileExt = explode('.', $productImg_fileName);
        $productImg_fileActualExt = strtolower(end($productImg_fileExt));
    
        $allowedExt = array('jpeg', 'jpg', 'png', 'jfif');

        //checking for allowed string
        if(in_array($productImg_fileActualExt, $allowedExt)){

        if($productImg_fileError === 0){

            if($productImg_fileSize < 10000000){

                //Generating a random names for it
                $productImg_newname = $productImg_fileName. date('mjYHis'). '.'.$productImg_fileActualExt;

                // Product Image Destination Variable
                $productImg_destinationFile = '../movies-img/' . $productImg_newname;

                //moving this images to server
                move_uploaded_file($productImg_fileTmpName, $productImg_destinationFile);









            }else{
                header("location: ../diamond/addMovies.php?msg=ImgSizeTooLarge");
            }



        }else{
            header("location: ../diamond/addMovies.php?msg=ImgErrorOccured");
        }



    }else{
        header("location: ../diamond/addMovies.php?msg=notSupportedImg");
    }





    }else{
        header("location: ../diamond/addMovies.php?msg=uploadImg");
    }






    //checks
    if(empty($product_title) || empty($product_amount) || empty($commission) || empty($level) ){
        header("location: ../diamond/addMovies.php?msg=fillAllFields");
    }
    else{

    
        //update the product
    
        $sql = "UPDATE products SET product_title = ?, product_amount = ?, commission = ?,  product_img = ?, level = ? WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
    
        mysqli_stmt_bind_param($stmt, "ssssss", $product_title, $product_amount, $commission, $productImg_destinationFile, $level, $id);
        mysqli_stmt_execute($stmt);
    
        header("location: ../diamond/movies.php?msg=success&page=update&id=$id");



    }
    
       
    
  
}