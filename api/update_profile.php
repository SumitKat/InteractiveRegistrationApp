<?php
require_once("../config/ini_config.php");
require_once("dbquery.php");
$sql = new DbQuery();
$user = [];
$email = $_GET['email'];
$user['name'] = $_GET['name'];
$user['phone'] = $_GET['phone'];
$sql->update('user', $user, 'email', $email);

$sql2 =new DbQuery();
$address = [];
$address['street'] = $_GET['street'];
$address['state'] = $_GET['state'];
$address['city'] = $_GET['city'];
$address['country'] = $_GET['country'];
$sql2->update('addres', $address, 'email', $email);

header("Location: ../model/dashboard.php");
