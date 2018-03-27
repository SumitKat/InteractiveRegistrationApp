<?php
session_start();
$last_id=0;

//including all the required files
require_once('../config/ini_config.php');
require_once('../config/ini_config.php');
require_once('../config/config.php');
require_once('../api/dbquery.php');
require_once('../controller/create_email.php');

//Generating a random token
$token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@';
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$usr = new DbQuery();
$array=[];
$array['email'] = $_POST['loginEmail'];
$array['password'] = hash('sha256', $_POST['loginPassword']);
$array['phone'] = $_POST['phone'];
$array['name'] = $_POST['name'];
$array['dob'] = $_POST['dob'];
$array['gender'] = $_POST['gender'];
$array['token'] = $token;
$usr->insert('user', $array);
$last_id = $usr->exec();

$add=new DbQuery();
 
$address = [];
$address['user_id'] = $last_id;
$address['street'] = $_POST['street'];
$address['state'] = $_POST['state'];
$address['city'] = $_POST['city'];
$address['country'] = $_POST['country'];

//call to insert function of DbQuery Class
$add -> insert('address', $address);
$add -> exec();

$interestLength = count($_POST[ 'interests' ]);
$i = 0;
$interest = '';

while ($i < $interestLength-1) {
    $interest .= $_POST[ 'interests' ][$i].',' ;
    $i++;
}

$interest .= $_POST[ 'interests' ][$interestLength-1];
$email = $_POST['loginEmail'];
$int = new DbQuery();
$intrst = [];
$intrst['user_id'] = $last_id;
$intrst['interest'] = $interest;

require_once('email_send.php');

//call to insert function of DbQuery Class
$int -> insert('interest', $intrst);
$int -> exec();
$conn->close();
