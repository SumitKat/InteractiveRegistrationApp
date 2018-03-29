<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">   
  <title>Update Profile</title>
</head>
<body>
<div id="id01" class="container-fluid">
  <form class="modal-content animate" action="../api/update_profile.php">

    <h3 style="text-align: center;"><strong>Update Profile</strong></h3>      
    <div class="container container-fluid">
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Name" name="name">

      <label for="phone"><b>Phone</b></label>
      <input type="text" placeholder="Phone" name="phone">
       
       <label for="street"><b>Street Address</b></label>
      <input type="text" placeholder="Street Address" name="street"> 

      <label for="city"><b>City</b></label>
      <input type="text" placeholder="City" name="city"> 

      <label for="state"><b>State</b></label>
      <input type="text" placeholder="State" name="state"> 

      <input type="hidden" name = "email" value = <?php echo $_SESSION['email'];?>>

      <label for="country"><b>Country</b></label>
      <input type="text" placeholder="Country" name="country"> 
      <button type="submit">Update</button>
    </div>
  </form>
</div>
</body>
</html>
