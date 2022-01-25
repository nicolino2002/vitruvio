<?php
$subject = trim($POST['subject']);
$to = trim($POST['to']);
$cc = trim($POST['cc']);
$message = trim($_POST['message']);
$sender = "assistenza@bintobit.com";

error_reporting(E_ALL);

// Generates boundary
$mail_boundary = "=_NextPart_" . md5(uniqid(time()));

$headers = "From: $sender\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
$headers .= "X-Mailer: PHP " . phpversion();

// Messaage bodies: TXT and HTML
$text_msg = "messaggio in formato testo";
$html_msg = "<b>messaggio</b> in formato <p><a href='http://www.aruba.it'>html</a><br><img src=\"http://hosting.aruba.it/image_top/top_01.gif\" border=\"0\"></p>";

// Build up the message's body to be sent
$msg = "This is a multi-part message in MIME format.\n\n";
$msg .= "--$mail_boundary\n";
$msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= "This is a testing e-mail sent by FORPSI Webhosting user for PHP mail()function testing purposes. FORPSI";  // text format message

$msg .= "\n--$mail_boundary\n";
$msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= "This is a testing e-mail sent by FORPSI Webhosting user for PHP mail()function testing purposes.

FORPSI";  // HTML format text

// Ending Boundary multipart/alternative
$msg .= "\n--$mail_boundary--\n";

// Return-Path setup (to be used only on windows servers)
ini_set("sendmail_from", $sender);

// Send the message, the fifth paramter set the Return-Path "-f$sender" on Linux Hosting
if (mail($to, $subject, $msg, $headers, "-f$sender")) { 
    echo "Mail sent successfully !<br><br>This is the source code used for sending the e-mail:<br><br>";
    highlight_file($_SERVER["SCRIPT_FILENAME"]);
    unlink($_SERVER["SCRIPT_FILENAME"]);
} else { 
    echo "<br><br>Mail delivery failed!";
}

?>
