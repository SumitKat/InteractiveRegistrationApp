<?php
session_start();
$last_id=0;

//including all the required files
require_once('../config/ini_config.php');
require_once('../config/config.php');
require_once('../config/email_config.php');
require_once('../api/dbquery.php');
if ($_SESSION['csrf'] != $_POST['csrf']) {
    header("Location: ../index.php");
}
//Generating a random token
$token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@';
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$usr = new DbQuery();
$array=[];
$array['email'] = testInput($_POST['loginEmail']);
$array['password'] = hash('sha256', testInput($_POST['loginPassword']));
$array['phone'] = testInput($_POST['phone']);
$array['name'] = testInput($_POST['name']);
$array['dob'] = testInput($_POST['dob']);
$array['gender'] = testInput($_POST['gender']);
$array['token'] = $token;
$usr->insert('user', $array);
$last_id = $usr->exec();

$add=new DbQuery();
 
$address = [];
$address['user_id'] = $last_id;
$address['street'] = testInput($_POST['street']);
$address['state'] = testInput($_POST['state']);
$address['city'] = testInput($_POST['city']);
$address['country'] = testInput($_POST['country']);

//call to insert function of DbQuery Class
$add -> insert('address', $address);
$add -> exec();

$interestLength = count($_POST[ 'interests' ]);
$i = 0;
$interest = '';

while ($i < $interestLength) {
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

    // Check connection
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    $interest = $_POST[ 'interests' ][$i] ;
    $sql = "SELECT id FROM  interest WHERE interest = '$interest'  LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $interest_id = $row['id'];

    $intrst = [];
    $intrst['user_id'] = $last_id;

    $intrst['interest_id'] = $interest_id;
    
    $int = new DbQuery();
    //call to insert function of DbQuery Class
    $int -> insert('user_interest', $intrst);
    $int -> exec();
    $i++;
}

session_unset($_SESSION['csrf']);
$email = $_POST['loginEmail'];
require_once('email_body.php');

//Prevention from XSS
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();
