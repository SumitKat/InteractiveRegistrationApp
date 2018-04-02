<?php
session_start();
require_once("../config/ini_config.php");
require_once("dbquery.php");

$id = new DbQuery();
$select = ['id'];
$email = $_POST['email'];
$result = $id->select('user', $select, 'email', $email);
if ($_SESSION['csrf'] == $_POST['csrf']) {
    $sql = new DbQuery();
    $user = [];
    empty(!$_POST['name']) ? $user['name'] = $_POST['name'] : '';
    empty(!$_POST['phone']) ? $user['phone'] = $_POST['phone'] : '';
    empty(!$user) ? $sql->update('user', $user, 'id', $result['id']) : '';

    $sql2 = new DbQuery();
    $address = [];
    empty(!$_POST['street']) ? $address['street'] = $_POST['street'] : '';
    empty(!$_POST['state']) ? $address['state'] = $_POST['state'] : '';
    empty(!$_POST['city']) ? $address['city'] = $_POST['city'] : '';
    empty(!$_POST['country']) ? $address['country'] = $_POST['country'] : '';
    empty(!$address) ? $sql2->update('address', $address, 'user_id', $result['id']) : '';
    
    $sql3 = new DbQuery();
    header("Location: ../view/dashboard.php");
} else {
    header("Location:../model/logout.php");
}
