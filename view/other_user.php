<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location: ../view/login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Other Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/other_user.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="../js/other_user.js"></script>
</head>

<body>
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
                    <li class="active"><a href="../view/dashboard.php">DashBoard</a></li>
                    <li><a href="../view/update_profile.php">Edit Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../model/logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                </ul>
            </div>
        </div>    
    </nav>
    <footer class = "text-nowrap navbar-fixed-bottom"> Copyright &copy; MindfireSolutions.com</footer>
</body>

</html>

<?php
require_once '../model/other_user.php';