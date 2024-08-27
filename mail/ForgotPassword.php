<?php

include_once "../config.php";
function sendresetemail($customerMail, $token, $name)
{

    require 'PHPMailerAutoload.php';
    require 'class.smtp.php';
    $mail  = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';


    $mail->Username = EMAIL;
    $mail->Password = PASSWORD;


    $content = file_get_contents('../mail/ForgotTemp.php');
    $mail->setFrom(EMAIL, BANKNAME);
    $mail->addAddress($customerMail);
    $mail->addReplyTo(EMAIL);

    $mail->isHTML(true);
    $mail->Subject = "Reset Password";
    
    
    
    // generate reset password link
    $resetLink =  "finboostermarketing.com/user/ResetPassword.php?token=" . $token;
    
    

    $swap_var = array(

        "{Name}" => "$name",
        "{ResetLink}" => "$resetLink",
        "{BankName}" => BANKNAME,
        "{Address}" => ADDRESS,

    );

    foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($key) != "") {
            $content = str_replace($key, $swap_var[$key], $content);
        }
    }

    $mail->Body = "$content";


    // if (!$mail->send()) {
    //     echo "mail not sent";
    // }


    if($mail->send()){
        $msg = 'Message has been sent';

    }else{
        $msg = 'Message could not be sent.';


    }
}
