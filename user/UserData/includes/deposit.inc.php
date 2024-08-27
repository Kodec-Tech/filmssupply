<?php
session_start();
include "../../connection.php";
include "../../../mail/fundAccEmailScript.php";

$username = $_SESSION['username'];
$AccountNo = $_SESSION['AccountNo'];


//this will only store the deposit amount and payment method on session
if(isset($_POST['deposit-submit'])){

        //grab information
        $damount = $_POST['amount'];
        $dwallet = $_POST['method'];
    
        //store them
        
        $_SESSION['damount'] = $damount;
        $_SESSION['dwallet'] = $dwallet;
    
        //error handling
        if(empty($damount) || empty($dwallet)){
            header('location: ../deposit.php?error=empty');
            exit();
        }
        elseif($damount < 50){
            header('location: ../deposit.php?error=lessamount');
            exit();
        }
    
        
        else{
            header("location: ../main-deposit.php");
            
        }

}
    


    





//this will insert the deposits to database with proof of payment
if(isset($_POST['deposit-submit2'])){

    //grab some data
    $deposit_amount = $_SESSION['damount'];
    $dwallet = $_SESSION['dwallet'];
    

    //proof of payment upload
    if(!empty($_FILES['proof']['name'])){
    $proof_fileName = $_FILES['proof']['name'];
    $proof_fileName = preg_replace('/\s/', '_', $proof_fileName); // replacing space with underscore

    $proof_fileTmpName = $_FILES['proof']['tmp_name'];
    $proof_fileError = $_FILES['proof']['error'];
    $proof_fileSize = $_FILES['proof']['size'];

    $proof_fileExt = explode('.', $proof_fileName);
    $proof_fileActualExt = strtolower(end($proof_fileExt));

    $allowedExt = array('jpeg', 'jpg', 'png', 'gif');
    
    //checking for allowed string
    if(in_array($proof_fileActualExt, $allowedExt)){

        if($proof_fileError === 0){

            if($proof_fileSize < 10000000){

                //Generating a random names for it
                $proof_newname = $proof_fileName. date('mjYHis'). '.'.$proof_fileActualExt;

                // Idcard Destination Variable
                $proof_destinationFile = '../../customer_data/payment_proof/' . $proof_newname;

                //moving this images to server
                move_uploaded_file($proof_fileTmpName, $proof_destinationFile);

                

                //inserting files to database
                $status = "Pending";
                $sql = "INSERT INTO deposit (account_No, username, amount, method, proof, status) VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssss", $AccountNo, $username, $deposit_amount, $dwallet, $proof_destinationFile, $status);
                if(mysqli_stmt_execute($stmt)){

                    header("location: ../main-deposit.php?error=success");
                    
                    

                } 
                else {
                    echo "Error: " . mysqli_error($conn);
                }
                

                



                //send email to user about deposit
                $userData = getUserData( $AccountNo, $conn );
                $email = $userData[ 'C_Email' ];
                $username = $userData[ 'C_First_Name' ]. ' '. $userData[ 'C_Last_Name' ];
        
                $message = 'Thank you for submitting your fund request. We want to inform you that your request is currently undergoing review. We appreciate your patience during this process. If there are any updates, we will notify you promptly';
        
                sendFundApprovalEmail( $message, $email, $username,$deposit_amount, $AccountNo,"In Review",$dwallet );





                

            }else{
                header("location: ../main-deposit.php?error=fileistoolarge&amount=$deposit_amount&method=$dwallet");
            }

        }else{
            header("location: ../main-deposit.php?error=erroroccured&amount=$deposit_amount&method=$dwallet");
        }
        
    }else{
        header("location: ../main-deposit.php?error=notsupported&amount=$deposit_amount&method=$dwallet");
    }

    


    }else{
        header("location: ../main-deposit.php?error=uploadproof&amount=$deposit_amount&method=$dwallet");
    }

    
  
    
    
}

function getUserData( $accountNo, $conn ) {
    $sql = "SELECT * from customer_detail where Account_NO ='$accountNo'";

    $result = mysqli_query( $conn, $sql ) or mysqli_error( $conn );
    if ( $result ) {
        if ( mysqli_num_rows( $result ) > 0 ) {
            $row = mysqli_fetch_assoc( $result );
            return $row;
        }
    }
}

    










// =======   Function to convert USD to bitcoin using CoinGecko API Starts ====
function usdTobitcoin ($usdAmount) {
    //setting our api's
  $bitcoinapi = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";
  

  $bitcoinData = json_decode(file_get_contents($bitcoinapi), true);

  // Check if API response is successful
  if(isset($bitcoinData['bitcoin']['usd'])) {

    //checking price for bitcoin
    global $bitcoinAmount;
    $bitcoinPriceInUsd = $bitcoinData['bitcoin']['usd'];
    $bitcoinAmount = $usdAmount / $bitcoinPriceInUsd;
    return $bitcoinAmount;

  } 


  else {
    return "<b>Error fetching data from API. (Check your Network)</b>";
  }
  }

// ==== Function to convert USD to bitcoin using CoinGecko API ENDS ==========



//function to convert USD to ethereum
function usdToethereum($usdAmount){

    $ethereumapi = "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd";

    $ethereumData = json_decode(file_get_contents($ethereumapi), true);

    if(isset($ethereumData['ethereum']['usd'])){
    
        //checking price for ethereum
        global $ethereumAmount;
        $ethereumPrice = $ethereumData['ethereum']['usd'];
        $ethereumAmount = $usdAmount / $ethereumPrice;
        return $ethereumAmount;
      }

      else {
        return "<b>Error fetching data from API. (Check your Network)</b>";
      }

}

//function to convert USD to ethereum ENDS HERE