<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

require_once('../config/config.php');
require_once('../api/dbquery.php');

$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$id =$_SESSION['login']['id'];

//data from  users is extracted
$userInfo = "SELECT email FROM  user WHERE id = '$id'  LIMIT 1";
$result = $conn->query($userInfo);

// check if query returns no result
if ($result->num_rows == 0) {
    header("Location: login.php");
}
$users =new DbQuery();
$user = [];
$user[0] = 'name';
$user[1] = 'email';
$user[2] = 'phone';
$user[3] = 'dob';
$user[4] = 'gender';

$row = $users->select('user', $user, 'id', $id);
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$dob = $row['dob'];
$gender = $row['gender'];


//data from interest table is fetched
$intrst = new DbQuery();
$rowInterest = $intrst->join($id);
$interest = implode(", ", $rowInterest);

//data about permanent address from address table is fetched
$address = new DbQuery();

$add = [];
$add[0] = 'street';
$add[1] = 'state';
$add[2] = 'city';
$add[3] = 'country';

$rowAddress = $address->select('address', $add, 'user_id', $id);
$city = $rowAddress['city'];
$street = $rowAddress['street'];
$state = $rowAddress['state'];
$country = $rowAddress['country'];

//extracting user info to fill in the table
$tables =new DbQuery();
$table = [];
$table[0] = 'name';
$table[1] = 'email';
$table[2] = 'phone';
$table[3] = 'dob';
$table[4] = 'gender';

$tableRow[][] = $tables->select('user', $table, '', '');

var_dump($tableRow);
// $name = $tableRow['name'];
// $email = $tableRow['email'];
// $phone = $tableRow['phone'];
// $dob = $tableRow['dob'];
// $gender = $tableRow['gender'];


require_once('../view/dashboard.php');
