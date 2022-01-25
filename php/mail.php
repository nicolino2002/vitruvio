<?php

$subject = trim($_POST['subject']);
$to = trim($_POST['to']);
$cc = trim($_POST['cc']);
$message = trim($_POST['message']);
$sender = "assistenza@bintobit.com";

error_reporting(E_ALL);

// Generates boundary
$mail_boundary = "=_NextPart_" . md5(uniqid(time()));
//$to = "gdepalo71@gmail.com";
//$subject = "testing e-mail";

$headers = "From: $sender\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
//$headers .= "Reply-To: " .  $mail_mittente . "\r\n";
$headers .= "Cc: " .  $cc . "\n";
$headers .= "X-Mailer: PHP " . phpversion();

// Messaage bodies: TXT and HTML
$text_msg = "messaggio in formato testo";
$html_msg = "<b>messaggio</b> in formato <p><a href='http://www.aruba.it'>html</a><br><img src=\"http://hosting.aruba.it/image_top/top_01.gif\" border=\"0\"></p>";

// Build up the message's body to be sent
$msg = "This is a multi-part message in MIME format.\n\n";
$msg .= "--$mail_boundary\n";
$msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= $message;  // text format message

$msg .= "\n--$mail_boundary\n";
$msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= $message;;  // HTML format text

// Ending Boundary multipart/alternative
$msg .= "\n--$mail_boundary--\n";

// Return-Path setup (to be used only on windows servers)
ini_set("sendmail_from", $sender);

// Send the message, the fifth paramter set the Return-Path "-f$sender" on Linux Hosting
if (mail($to, $subject, $msg, $headers, "-f$sender")) { 
    echo "Mail sent successfully!";
} else { 
    echo "<br><br>Mail delivery failed!";
}
?>