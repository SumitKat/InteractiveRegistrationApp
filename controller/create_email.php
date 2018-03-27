<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once("../PHPMailer/src/PHPMailer.php");
require_once("../PHPMailer/src/Exception.php");
require_once("../PHPMailer/src/SMTP.php");
//Setting up mail, it's propeties and it's methods
$mail = new PHPMailer(true);
$mail->IsSMTP(); // enable SMTP
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->Username = "kathayat.sumit123@gmail.com";
$mail->Password = "Hello@1234";
$mail->setFrom("kathayat.sumit123@gmail.com", "MindFire Solutions", 0);
