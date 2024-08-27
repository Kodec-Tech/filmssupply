<?php
include_once "../config.php";

//The parameter will serve as reference in the function
function verifyUserMail ($Caccountnumber, $Cfirstname, $Cemail, $Caccountname){

$to = $Cemail;
$subject = 'Account Activation Successful';

$html = file_get_contents("activatedTemplate.html");
$html = str_replace(["{{firstname}}", "{{accountname}}", "{{accountnumber}}", "{BankName}", "{Address}"], [$Cfirstname, strtoupper($Caccountname), $Caccountnumber, BANKNAME, ADDRESS], $html);

$message = $html;
         
$header = "From:DecastleSampatti" . "contact@DecastleSampatti.com"  . "\r\n";
//If i want another email to receive a copy (Carbon copy)
//$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
         
$send = mail ($to, $subject, $message, $header);
         
if( $send == true ) {

    //echo  "Message sent successfully...";

 }else {
    //$msg = "Message could not be sent...";
 }






}