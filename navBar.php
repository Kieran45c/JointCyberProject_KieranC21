<?php
session_start();

if(!isset($_SESSION["email"]))
{
	header("location:index.php?action=login");
}

?>

<html>
<style>
.navBar {
    overflow: hidden;
   	background-color: grey;
	max-width:520px;
	border-style: groove;
	border-width: 4px;
}

.navBar a {
 
  background-color: Grey;
  float: left;
  color: black;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;

}

a:hover {
  background-color: green;
}
</style>
<body>

<div class="navBar">

<?php

echo '<h3> Welcome: '.$_SESSION["email"].'</h3>';

?>
  <a  href="bookings.php">Book A Test</a> 
  <a  href="vacBookings.php">Book A Vaccination</a>
  <a  href="viewTestResults.php">View Test Results</a>
  <a  href="logout.php">Logout</a>
</div>


</body>
</html>