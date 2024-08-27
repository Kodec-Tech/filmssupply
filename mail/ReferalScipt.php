<?php


// Names
//Gmail app password; lawhkqiqjwxapbos
define("BANKNAME", "DecastleSampatti");
define("SENDER", "DecastleSampatti");
define("EMAIL", "DecastleSampatti@gmail.com");  
define("PASSWORD", "otynqcnucfitdhed");   
define("ADDRESS", "545 Mavis Island Chicago, IL 99191");
define("MOBILENO", "+15552345678");
define("LOCATION_CORDINATE", "https://www.google.com/maps/place/United+Bank+For+Africa+-+ATM/@9.0512931,7.4589204,14z/data=!3m1!5s0x104e0ba51d5787b7:0xc76bee273c6ce205!4m10!1m3!2m2!1sATMs!6e2!3m5!1s0x104e0ba4fe6aaaab:0xdaa12809e87c98f1!8m2!3d9.0550646!4d7.4895426!15sCgRBVE1zkgEDYXRt4AEA");

define('WebsitePath',    __DIR__);

 
//custom mail 
define("CUSTOM_EMAIL", "contact@decastlesampatti.com");
/**
* Sends a withdrawal confirmation/Approval email to the user when they try to withdraw.
*
* @param mixed $customerMail The customer's email address.
 * @param mixed $name The customer's name.
* @param mixed $amount The withdrawal amount.
* @param mixed $accountNumber The account number.
* @return bool True if the email is sent successfully, false otherwise.
*/


function sendReferalPaymentEmail( $message, $customerMail, $name, $amount, $accountNumber, $status, $content, $walletName="", )
 {
    require 'PHPMailerAutoload.php';
    require 'class.smtp.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = EMAIL;
    $mail->Password = PASSWORD;

    //---------------- FOR TESTING PURPOSE ONLY
    // $mail->isSMTP();
    // $mail->Host = 'sandbox.smtp.mailtrap.io';
    // $mail->SMTPAuth = true;
    // $mail->Port = 465;
    // $mail->Username = '0110e828e3b6b4';
    // $mail->Password = '12d0ca8819b840';

 
    // ------------End OF TESTING SECTION
   
   
    $mail->setFrom( EMAIL, BANKNAME );
    $mail->addAddress( $customerMail );
    $mail->addReplyTo( EMAIL );

    $mail->isHTML( true );
    $mail->Subject = 'Withdrawal Request';

    // generate reset password link

    // update email content with reset password link
    $swap_var = [
        '{Name}' => "$name",
        '{Address}' => ADDRESS,
        '{message}'=> $message,
        '{status}'=>$status,
        '{Amount}' => "$amount",
        '{AccountNumber}' => "$accountNumber",
        '{BankName}' => BANKNAME,
        '{walletName}'=>$walletName,
        '{email}'=>$customerMail
    ];

    foreach ( array_keys( $swap_var ) as $key ) {
        if ( strlen( $key ) > 2 && trim( $key ) != '' ) {
            $content = str_replace( $key, $swap_var[ $key ], $content );

        }
    }

    $mail->Body = "$content";

    if ( $mail->send() ) {
       
        return true;
    } else {
       

        return false;

    }

}