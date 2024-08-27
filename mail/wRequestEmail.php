<?php

include_once "../../config.php";


/**
 * sendWithdrawalOTPRequestEmail
 * sends otp when the user is trying to withdraw 
 * @param mixed $customerMail
 * @param mixed $name
 * @param mixed $otp
 * @return bool
 */
function sendWithdrawalOTPRequestEmail($customerMail, $name, $otp)
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



    $content = file_get_contents('../../mail/wRequestTemp.php');
    $mail->setFrom(EMAIL, BANKNAME);
    $mail->addAddress($customerMail);
    $mail->addReplyTo(EMAIL);

    $mail->isHTML(true);
    $mail->Subject = "Transaction Otp Verification ";

    // generate reset password link
   

    // update email content with reset password link
    $swap_var = array(
        "{Name}" => "$name",
        "{Address}" => ADDRESS,

        "{OTP}" => "$otp",
        "{BankName}" => BANKNAME
    );

    foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($key) != "") {
            $content = str_replace($key, $swap_var[$key], $content);

        }
    }



    $mail->Body = "$content";

    if ($mail->send()) {
        return true;
    } else {
        return false;

    }


}