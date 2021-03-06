<?php
session_start();
// check if a user is already logged in
if (!empty($_SESSION['login'])) {
    header("Location: ../view/dashboard.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta charset = "utf-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src = "../js/forgot_pass.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
    <body>
        <nav class = "navbar navbar-inverse">
            <div class = "container-fluid">
                <div class = "navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class = "icon-bar"></span>
                        <span class = "icon-bar"></span>
                        <span class = "icon-bar"></span>
                    </button>
                    <a class = "navbar-brand" href= "#" >Mindfire Solutions</a>
                </div>
                <div class = "collapse navbar-collapse" id="myNavbar">
                    <ul class = "nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href = "#">Contact Us</a></li>
                        <li><a href = "#">Our Products</a></li>
                        <li><a href = "#">About Us</a></li>
                    </ul>
                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href = "../index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <form class = "center-block" id = "forgotForm" action = "<?php echo htmlspecialchars("../controller/forgot_pass.php");?>" method = "POST">
            <div class = "container-fluid text-center bg-1 ">
                <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                    <div class = "row">
                        <div class = "col-lg-12 col-md-12   col-sm-12 form">
                            <div class = "form-group bg-2">
                                <br>
                                <label> Forgot Password!!</label><br>
                                <p><i>Let's get yoy a new one!!</i></p>
                                <input class = "form-control" placeholder="Email" type = "email" name="forgotEmail" id = "forgotEmail" autofocus>
                                <p></p>
                               <span class="error" id ="ema"><?php echo isset($passErr) ? $passErr : '';?></span>
                                <input type = "submit" name = "login" class="btn btn-primary btn-block" value = "Submit" id ="next">
                                <p></p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <footer class = "text-nowrap navbar-fixed-bottom"> Copyright &copy; MindfireSolutions.com</footer>
    </body>

</html>
