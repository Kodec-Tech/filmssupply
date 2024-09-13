<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tasks</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Film Supply, Cinema, Movie Rating, marketing, SEO, B2BCommerce">
        <meta name="author" content="">
        <meta name="theme-color" content="#C70039">
        <meta name="description" content="Films Supply">

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <!-- Bootstrap icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/media.css" />
    <link rel="stylesheet" href="../css/general.css" />
    <!-- Icon -->
    <link rel="shortcut icon" href="../images/img/icon.png" type="image/x-icon" />



    <style>
        .notification {
    display: none;
    position: fixed;
    top: 20px;
    right: 5px;
    padding: 8px 20px 8px 15px; /* Added padding-right to give more space for the close button */
    color: white;
    border-radius: 5px;
    z-index: 1000;
    font-size: 14px;
    opacity: 0.9;
}

.notification.success {
    background-color: #4CAF50; /* Green for success */
}

.notification.error {
    background-color: #f44336; /* Red for error */
}

.close-btn {
    position: absolute;
    top: 8px; /* Adjust this value to position it higher or lower */
    right: 10px; /* Adjust this value to position it further from the edge */
    font-size: 24px; /* Adjusted font size */
    cursor: pointer;
    background: transparent; /* Remove any background color */
    border: none; /* Remove default border */
    padding: 0; /* Remove default padding */
    margin-left: 10px; /* Adjust spacing to the left of the button */
}
    </style>
  </head>

  <body class="tasks_body">
  <?php
        include "header.php";
        ?>

    <main class="zoom_tasks">
        <div class="container tasks mt-3">


        <?php
    /// Determine the message and type
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    $messageType = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success'; // Default to 'success'
    
    // Clear the session variables
    unset($_SESSION['message'], $_SESSION['message_type']);
?>

<?php if ($message): ?>
    <div class="notification <?php echo htmlspecialchars($messageType); ?>" id="notification">
        <?php echo htmlspecialchars($message); ?>
        <span class="close-btn">&times;</span>
    </div>
<?php endif; ?>


<?php

// Merge will go here
//check if there is a Merge product and fetch
// Initialize the variable
$mergeProductData = array();
$mergequery = "SELECT * FROM merge_product WHERE acctNo = ?";
$mergestmt = mysqli_prepare($conn, $mergequery);
mysqli_stmt_bind_param($mergestmt, "s", $AccountNo);
mysqli_stmt_execute($mergestmt);
$mergeresult = mysqli_stmt_get_result($mergestmt);
$mergeProduct = mysqli_fetch_assoc($mergeresult);
if($mergeProduct){

    // Pass product data to JavaScript
$mergeProductData = [
    
    'product_title' => $mergeProduct['product_title'],
    'product_img' => $mergeProduct['product_img'],
    'product_amount' => $mergeProduct['product_amount'],
    'commission' => $mergeProduct['commission'],
    'created_date' => $mergeProduct['created_time'],
    
    'level' => $mergeProduct['level'],
    'order_number' => $mergeProduct['order_number'],

    'grand_order' => $mergeProduct['grand_order'] ?? ''
];

//check the commision for users for seamless
$newCommissionMerge = $mergeProduct['commission'] / 100 * $mergeProduct['product_amount'];


}








   // Get count of tasks performed by the user
$reset = 'false';
$sql_tasks = "SELECT COUNT(*) AS task_count FROM user_task WHERE acctNo = ? AND level = ? AND reset = ? ";
$stmt_tasks = mysqli_prepare($conn, $sql_tasks);
mysqli_stmt_bind_param($stmt_tasks, "sss", $AccountNo, $level, $reset);
mysqli_stmt_execute($stmt_tasks);
$result_tasks = mysqli_stmt_get_result($stmt_tasks);
$row_tasks = mysqli_fetch_assoc($result_tasks);
$task_count = $row_tasks['task_count'];


if($level == 'normal'){
  $products_list = 33;
}
elseif($level == 'vip'){
  $products_list = 35;
}
elseif($level == 'vvip'){
  $products_list = 5; 
}
elseif($level == 'vvvip'){
  $products_list = 43;
}
elseif($level == 'gold'){
  $products_list = 45;
}
elseif($level == 'diamond'){
  $products_list = 50;
}

// Get count of available products
$sql_products = "SELECT COUNT(*) AS product_count FROM products WHERE level = ?";

// Prepare the statement
$stmt_products = mysqli_prepare($conn, $sql_products);

// Bind the parameter
mysqli_stmt_bind_param($stmt_products, "s", $level);

// Execute the statement
mysqli_stmt_execute($stmt_products);

// Get the result
$result_products = mysqli_stmt_get_result($stmt_products);

// Fetch the row
$row_products = mysqli_fetch_assoc($result_products);

// Get the product count
$product_count = $row_products['product_count'];
if($product_count > $products_list || $product_count > 0){
  $Newproduct_count = $products_list;
}

// Construct the string
$count_string = "$task_count/$Newproduct_count";



?>








          


            <!-- flex-column the task section -->
            <img src="../images/gif/start_movies.gif" alt="" class="task_gif">
            <div class="">
                <div class="movie_contents tasks_contents">
                    <!-- these are tabs -->
                    <div class="tab-container tasks_tab">                     
                      <!-- start modal starts -->
                      <!-- Button trigger modal -->



<!-- All botton Conditions Goes here -->
<?php


if(mysqli_num_rows($mergeresult) > 0){
  if($task_count == ($mergeProductData['grand_order'] ?? '') && $balance >=0){

?>
<button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#TaskMergeMovies">
  Rate
</button>

<?php
}}


if(!empty($product_count)  && $task_count != $Newproduct_count && $balance >=0 ){
  if($task_count != ($mergeProductData['grand_order'] ?? '')){

?>
<!-- Button to trigger Movie Tasks modal -->
<button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#TaskMovies">
  Rate
</button>


<?php
}}
if(empty($product_count) ){
?>



<button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#NoTaskToPerform">
  Rate
</button>


<?php
}

//if task is all performed
if($task_count > 0 && $task_count === $Newproduct_count){
  //Update the Trial Bonus and set it to Zero
$NewBonus = "0.0";
$sql_bonus = "UPDATE accounts SET bonus = ? WHERE AccountNo = ?";
$stmt_bonus = mysqli_prepare($conn, $sql_bonus);
mysqli_stmt_bind_param($stmt_bonus, 'ss', $NewBonus, $AccountNo);
mysqli_stmt_execute($stmt_bonus);

// Fetch the updated row
$sql_fetch_bonus = "SELECT * FROM accounts WHERE AccountNo = ?";
$stmt_fetch_bonus = mysqli_prepare($conn, $sql_fetch_bonus);
mysqli_stmt_bind_param($stmt_fetch_bonus, 's', $AccountNo);
mysqli_stmt_execute($stmt_fetch_bonus);
$result = mysqli_stmt_get_result($stmt_fetch_bonus);

if ($row = mysqli_fetch_assoc($result)) {
    // Now $row contains the entire updated row
    $bonus = $row['bonus'];
    
}

?>
<button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#TaskCompleted">
  Rate
</button>
<?php } ?>




<?php 
//when account got freezed meaning balance is negative
if($balance < 0 ){

?>
<button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#" disabled>
  Rate
</button>

<?php } 




// if($balance < 100 && $balance >= 0 && $bonus < 0){
//     echo '
//     <button type="button" class="btn btn-primary tab active" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  
//     ❌ Insuff balance
// </button>
                   
//     ';
// }
?>


























<!-- Lets fetch all necessary informations for us to utilize in the modal -->
<?php
// Fetch a product with the same level as the user and that the user hasn't seen yet

$reset = 'false';
$sql = "SELECT * FROM products 
        WHERE level = ?
        AND product_id NOT IN (SELECT product_id FROM user_task WHERE acctNo = ? AND reset = ?)
        ORDER BY RAND() LIMIT ?";



//This display product info for user to perform order
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $level, $AccountNo, $reset, $Newproduct_count); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
if($product){

    // Pass product data to JavaScript
$productData = [
    'product_id' => $product['product_id'],
    'product_title' => $product['product_title'],
    'product_img' => $product['product_img'],
    'product_amount' => $product['product_amount'],
    'commission' => $product['commission'],
    'created_date' => $product['created_time'],
    
    'level' => $product['level'],
    'order_number' => $product['order_number']
];

//check the commision for users for seamless
$newCommission = $product['commission'] / 100 * $product['product_amount'];



}


?>






<?php
include("tasksModals.php");
?>














                       
                      




                       <a href="history.php" class="tab">Orders</a>
                    </div>

                    <!-- these are the tab contents -->
                    <div  class="dropdown-content active tasks_dropdown" id="content1">
                        <!-- flex-column these men -->
                         <!-- first info -->
                         <a href="terms.php"><h6>Reservation Rules</h6></a>
                         
                         <!-- second info -->
                         <div class="tasks_info alone_info">
                            <h4>Trial Bonus: <?php echo $currency . number_format($bonus, 2); ?></h4>
                            
                         </div>
                         <div class="tasks_info info2">
                            <h4>Balance: <?php echo $currency . number_format($balance, 2); ?></h4>
                            <h4><?php echo $count_string ?></h4>
                         </div>
                         
                         <!-- third info -->
                         <div class="trans_table tasks_table rounded">
                            <div class="trans_col tasks_col">
                                <h5>Order Received Today</h5>
                                <p><?php echo $task_count ?></p>
                            </div>
                            <div class="trans_col tasks_col">
                              <h5>Today Earnings</h5>
                              <p><?php echo $currency . ($today_earning  ?? 0); ?></p>
                            </div>
                            <div class="trans_col tasks_col">
                                <h5>Amount Processing</h5>
                                <p><?php 
                                if($balance < 0){
                                  echo $currency . ($amount_processing  ?? 0);
                                }else{
                                  echo $currency . number_format($balance, 2);
                                }
                                 ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- important hints -->
                    <div class="description hints text-light">
                      <h3>Important Hints</h3>
                      <ol>
                        <li>Working hours: 10:00 - 23:00</li>
                        <li>For enquiries about applicants, please consult customer support agents.</li>
                      </ol>
                    </div>

                    <!-- <div class="dropdown-content" id="content2">
                         <h1>GRACIAS</h1>
                    </div> -->
                </div>
            </div>
        </div>
    </main>

    <?php
        include "footer.php";
        ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>

    <!-- custom JavaScript -->
    <script src="../scripts/tabs.js"></script>
    <script src="../scripts/tripletabs.js"></script>
    <script src="../scripts/stars.js"></script>




    <!-- script to give us a message notice of task -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'block';

            var closeBtn = notification.querySelector('.close-btn');
            closeBtn.onclick = function() {
                notification.style.display = 'none';
            };

            // Hide the notification after 20 seconds
            setTimeout(function () {
                notification.style.display = 'none';
            }, 20000); // 20 seconds
        }
    });
</script>

  </body>
</html>
