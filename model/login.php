<?php
ini_set('display_erros', 1);
session_start();
$email = $pass = "";
require_once('../config/config.php');

// check if a user is already logged in
if (!empty($_SESSION['login'])) {
    header("Location: ../view/dashboard.php");
} else {
    $emailErr = $passErr = "";
    $flag = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["loginEmail"])) {
            $emailErr = "Email can't be empty";
            $flag = true;
        } else {
            $email =testInput($_POST["loginEmail"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Enter a valid Email";
                $flag = true;
            }
        }
        if (empty($_POST["loginPassword"])) {
            $passErr="Password can't be empty";
            $flag = true;
        } else {
            $pass = testInput($_POST["loginPassword"]);
            if (strlen($pass)<6 || (!preg_match("/[a-z]/", $pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))) {
                    $passErr = "Enter a Valid Password";
                    $flag = true;
            }
        }
    }


    // Create connection
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

    // Check connection
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    $random = hash('sha256', $pass);
    $sql = "SELECT id, valid, password FROM  user WHERE email = '$email'AND password = '$random' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows == 0) {
        $passErr = "Invalid email id or Password";
        if ($email=="") {
            $passErr = "";
        }
    } else if ($row['valid'] == 'F') {
        $passErr = "Please check your email!!";
        if ($email=="") {
            $passErr = "";
        }
    } else if ($_POST['csrf'] != $_SESSION['csrf']) {
        $passErr = "You need to enter your credentials again";
    } else {
            $_SESSION['login']['id'] = $row['id'];
            header("Location: ../view/dashboard.php");
    }
}

//function to prevent from css
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
require ('../view/login.php');
