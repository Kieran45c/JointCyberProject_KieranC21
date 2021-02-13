<?php
require_once "config.php";

$sql = 'CREATE DATABASE IF NOT EXISTS Covid19TestBooking;';
if (!$conn->query($sql) === TRUE) {
  die('Error creating database: ' . $conn->error);
}

$sql = 'USE Covid19TestBooking;';
if (!$conn->query($sql) === TRUE) {
  die('Error using database: ' . $conn->error);
}


?>

<html>
<h2>Login Page</h2>
<body>
<form action="index.php" method="POST">
   Enter Your First Name: <input type="text" 
   name="username" required="required" /> <br/> <br>
   Enter password: <input type="password" 
   name="password" required="required" /> <br/> <br>
   <input type="submit" value="Login"/>
   
</form>
<a href="register.php"> Click here to register 

</body>
</html>
