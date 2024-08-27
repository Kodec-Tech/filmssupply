<?php

include_once __DIR__ . '/../config.php';
/**
* Sends a withdrawal confirmation/Approval email to the user when they try to withdraw.
*
* @param mixed $customerMail The customer's email address.
 * @param mixed $name The customer's name.
* @param mixed $amount The withdrawal amount.
* @param mixed $accountNumber The account number.
* @return bool True if the email is sent successfully, false otherwise.
*/

function sendFundApprovalEmail( $message, $customerMail, $name, $amount, $accountNumber, $status,  $walletName="" )
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

    $content = file_get_contents( __DIR__ . '/../mail/AdminWithdrawalTemp.php' );
    $mail->setFrom( EMAIL, BANKNAME );
    $mail->addAddress( $customerMail );
    $mail->addReplyTo( EMAIL );

    $mail->isHTML( true );
    $mail->Subject = 'Fund Account Request - DecastleSampatti';

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