<?php
session_start();
$_SESSION['csrf'] = hash('sha256', time());
if (empty($_SESSION['login'])) {
    header("Location: ../view/login.php");
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/update_profile.css">
        <title>Update Profile</title>
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
                    <li><a href="../view/other_user.php">Other Users</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../model/logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                </ul>
            </div>
        </div>    
    </nav>

        <form action="../api/update_profile.php" method="POST">           
            <div class="container container-fluid text-center bg-1">
                <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                    <div class = "row"><label style="color: #000"><h4><strong>Edit Profile</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                    <input type="text" class = "form-control" placeholder="Name" name="name"><br>

                    <input type="text" class="form-control" placeholder="Phone" name="phone"><br>

                    <input type="text" class="form-control" placeholder="Street Address" name="street"><br>

                    <input type="text" placeholder="City" class="form-control" name="city"><br>

                    <input type="text" class = "form-control" placeholder="State" name="state"><br>

                    <input type="hidden" name="email" class = "form-control" value="<?php echo $_SESSION['email'];?>">

                    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

                    <input type="text" class= "form-control " placeholder="Country" name="country"><br>
                    
                    <label for = "sel1">Personal Interests:</label>
                    <select multiple class = "form-control" id = "sel1" name = "interests[]">
                        <option>Sports</option>
                        <option>Books</option>
                        <option>Computer and Software</option>
                        <option>Fashion</option>
                        <option>Photography</option>
                    </select><br>

                    <button class = "btn btn-primary btn-block" type="submit">Update</button><br>

                </div>
                    </div>
                </div>
            </div>
        </form>
    <footer class = "text-nowrap navbar-fixed-bottom"> Copyright &copy; MindfireSolutions.com</footer>

    </body>

    </html>