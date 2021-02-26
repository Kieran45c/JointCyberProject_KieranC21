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
  float: left;
  color: white;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;

}

.navBar a.active {
  background-color: black;
  color: white;
}
</style>
<body>

<div class="navBar">
  <a class="active" href="bookings.php">Book A Test</a> 
  <a href="viewBookings.php">Book A Vaccination</a>
  <a href="viewTestResults.php">View Test Results</a>
  <a href="logout.php">Logout</a>
</div>


</body>
</html>