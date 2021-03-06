<?php
session_start();
require_once('../model/dashboard.php');
if (empty($_SESSION['login'])) {
    header("Location: ../view/login.php");
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Dashboard Page -->
        <title>DashBoard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
        <script src="../js/dashboard.js"></script>
    </head>

    <body>
        <!-- Navigation bar -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Mindfire Solutions</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../view/other_user.php">Other Users</a></li>
                        <li><a href="../view/update_profile.php">Edit Profile</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../model/logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Container  -->
        <div class="container-fluid bg-1 text-center">
            <h3 class="margin">Hi, <?php echo $name?></h3>
            <img src="../img/user.png"  style="width: 200px" alt="user" >
            <h3> <?php echo $phone." / ".$email ?></h3>
        </div>

        <div class="container-fluid bg-2 text-center">
            <h3 class="margin">What Am I?</h3>
            <p> I was born on
                <?php echo $dob?>
            </p>
            <p>
                <?php echo isset($interest)? "I have interests in ".$interest : ''?>
            </p>
        </div>
        <!-- Sub Contaner -->
        <div class="container-fluid bg-3 text-center">
            <h3 class="margin">Where To Find Me?</h3>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="margin">Address:</h4>
                    <p>
                        <?php echo $street.",".$city.",".$state.",".$country?>
                    </p>
                </div>
            </div>
        </div>
        <footer class="text-nowrap"> Copyright &copy; MindfireSolutions.com</footer>

    </body>

    </html>