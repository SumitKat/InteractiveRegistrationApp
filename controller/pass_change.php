<?php
session_start();
require_once('../config/ini_config.php');
require_once("../config/config.php");
require_once('../api/dbquery.php');

$pass = $_POST['pass_change1'];
$repass = $_POST['pass_change2'];

$sql = new DbQuery();
$details =[];
$details[0] = 'token';
$details[1] = 'valid';
$row = $sql->select('user', $details, 'email', $_SESSION['email']);
var_dump($_SESSION['token']);
//check if the both the password matched
if ($pass === $repass && $_SESSION['token'] == $row['token'] && $row['valid'] == 'F') {
    $sql = new DbQuery();
    $update = [];
    $pass =hash('sha256', $pass);
    $update['password'] = $pass;
    $update['token'] = null;
    $update['valid'] = 'T';
    $sql->update('user', $update, 'email', $_SESSION['email']);
    //unset session variable for email
    unset($_SESSION['email']);
    unset($_SESSION['token']);
    header("Location: ../model/dashboard.php");
} else {
    echo "Something went wrong, Please try again!!";
    $myfile = fopen("../logs/error_log.txt", "a+") or die("Unable to open file!");
    $txt = "error in updating password to the database\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
