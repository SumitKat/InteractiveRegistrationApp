<?php
session_start();
require_once('../config/email_config.php');
require_once("../api/dbquery.php");
require_once("../config/config.php");
require_once('create_email.php');
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;

$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@";
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$email = $_POST['forgotEmail'];
$_SESSION['email'] = $email;

$mail->addAddress($email);
$mail->Subject = "Password Reset";
$mail->isHTML(true);
$mail->Body = "
Forgot Your Password?? Let's get you a new one:<br></br>

<a href = 'http://172.16.8.221/interactive/view/pass_change.php?email=$email&token=$token'>Click Here</a>
";
if ($mail->send()) {
    echo "Password reset mail sent. Please check your email";
} else {
    echo "We are facing some problem. Our engineers are working on it!!";
    $myfile = fopen("../logs/error_log.txt", "a+") or die("Unable to open file!");
    $txt = "error in sending password verification email\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
