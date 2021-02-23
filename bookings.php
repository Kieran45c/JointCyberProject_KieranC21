<?php
require_once "config.php";

session_start();

if(!isset($_SESSION["email"]))
{
	header("location:index.php?action=login");
}

?>

<html>
<div>
<style>
div { 
	max-width:420px;
	margin:50px auto; 
	color:black;
	text-align: 
	center;
}

input {
 width: 375px;
 height: 25px;
}

a:link, a:visited {
  background-color: black;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 8px;
  font-size: 30px;
}

a:hover {
  background-color: red;
}
 </style>
<br>
<body>

<?php
echo '<h2>Welcome: '.$_SESSION["email"].'</h2>';
?>

<h2>Book a test</h2>
<form action="bookings.php" method="POST">
   <input type="text" id="bookApp" name="bookApp" required="required" placeholder= "Book A Test Date & Time" onfocus="(this.type='datetime-local')" /> <br> <br/>
   <input type="submit" value="Book Appointment" name= "book"/> 
</form>
<br>

<h2>Book a vaccination</h2>
<form action="bookings.php" method="POST">
   <input type="text" id="bookApp" name="bookApp" required="required" placeholder= "Book A Vaccine Date & Time" onfocus="(this.type='datetime-local')" /> <br> <br/>
   <input type="submit" value="Book Appointment" name= "book"/> 
</form>
<br>

<h2>View Booking</h2>

<h2>View Test Results</h2>

<label><a href="logout.php">Logout</label>

</div>
</body>
</html>
