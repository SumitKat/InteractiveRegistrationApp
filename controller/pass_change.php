<?php
session_start();
require_once('../config/ini_config.php');
require_once("../config/config.php");
require_once('../api/dbquery.php');

$pass = $_POST['pass_change1'];
$repass = $_POST['pass_change2'];

if ($pass === $repass) {
    $sql = new DbQuery();
    $update = [];
    $pass =hash('sha256', $pass);
    $update['password'] = $pass;
    $update['token'] = null;
    $sql->update('user', $update, 'email', $_SESSION['email']);
    var_dump($sql);
    header("Location: ../model/dashboard.php");
} else {
    echo "Something went wrong, Please try again!!";
    $myfile = fopen("../logs/error_log.txt", "a+") or die("Unable to open file!");
    $txt = "error in updating password to the database\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
