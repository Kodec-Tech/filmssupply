<?php
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




// SELECT Date, SUM(Credit), SUM(Debit) FROM transaction WHERE AccountNo = '412211317400' GROUP BY Date
$creditChart = "SELECT Date, SUM(Credit) AS credit, SUM(Debit) AS debit FROM transaction WHERE AccountNo = '$AccountNo' GROUP BY Date";


$result = mysqli_query($conn, $creditChart);
$date = array();
$credit = array();
$debit = array();

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $date[] = $row['Date'];
        $credit[] = $row['credit'];
        $debit[] = $row['debit'];
    }
}





$TotalCreditResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND Status = 'Credited'") or mysqli_error($conn);
$CreditTotal = '0';
if (mysqli_num_rows($TotalCreditResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalCreditResult)) {

        $CreditAmount = $row['Amount'];

        $CreditTotal = $CreditTotal + $CreditAmount;
    }
    $CreditTotal;
}

$TotalDebitResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' AND Status = 'Debited'") or mysqli_error($conn);
$DebitTotal = '0';
if (mysqli_num_rows($TotalDebitResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalDebitResult)) {

        $DebitAmount = $row['Amount'];

        $DebitTotal = $DebitTotal + $DebitAmount;
    }
    $DebitTotal;
}


?>



<?php
include "../../config.php";
include_once "../../mail/wRequestEmail.php";

// Function to generate a random OTP
function generateOTP($length = 6) {
    return rand(pow(10, $length-1), pow(10, $length)-1);
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

// Check if the form is submitted
if (isset($_POST['submit-sendotp'])) {
    // Generate OTP
    $otp = generateOTP();

    // Send OTP via email
    $to = $_POST['email']; // Assuming 'email' is the email field
    $subject = 'Your OTP Code';
    $message = 'Your One Time Password (OTP) is: ' . $otp;
    $headers = 'From: your_email@example.com'; // Replace with your email

    mail($to, $subject, $message, $headers);
    sendWithdrawalOTPRequestEmail($to, $fullname, $otp);
    // Store the OTP in the session for verification
    $_SESSION['otp'] = $otp;

    // Redirect to a page where the user can enter the OTP for verification
    header("Location: wvalidateotp.php"); // Create verify_otp.php for OTP verification
    exit();
}
?>


<?php
$sql = "Select * from customer_detail where Account_No = '$AccountNo'";
$result = mysqli_query( $conn, $sql ) or die( 'query fail' );

if ( mysqli_num_rows( $result ) > 0 ) {
  while ($row = mysqli_fetch_assoc($result)) {
    if(empty($row["C_Pan_Doc"]) || empty($row['C_Adhar_Doc']) ||empty($row['kyc_approval']) ||$row['kyc_approval']=='reject'){
      header('Location: profile.php?error=kyc&message=You are yet to verify your kyc Information.  ');
    }
  }
}
?>






<?php include "header.php" ?>

<main
    id="content"
    role="main"
    class="main bg-white mt-5 pt-5"
>



    <div class="container d-flex align-items-center  h-100">



        <div
            class="col col-md-6 col-lg-4 py-md-auto mx-auto"
            style="margin-top: 50px;"
        >

            <h4 style="font-size:24px">Step 1/2 : <span style=" text-align: center;">Enter Your Email</span></h4>
            <br>

            <p style="color:red; font-weight:900"> <span> <?php echo $error ?? '' ?></span></p>
            <form
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                method="POST"
            >






                <label
                    for="email"
                    class="w-100 fw-bold"
                >Email Address: </label>
                <p style="font-size: 14px;">Please enter your email to receive a one time password to withdraw your
                    funds.</p>

                <input
                    type="text"
                    name="email"
                    value="<?php echo $_SESSION['email'] ?? '';?>"
                    placeholder="<?php echo $_SESSION['email'] ?? '';?>"
                    class="form-control"
                    require
                >



                <br>
                <input
                    type="submit"
                    name="submit-sendotp"
                    value="Send OTP"
                    style="background: #1877f2; padding: 10px; width: 100%; outline: none; border: none; color: #fff; cursor: pointer; border-radius: 8px; margin-bottom: 20px"
                >


            </form>

            <br>

        </div>
    </div>

    </div>




</main>