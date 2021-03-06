<?php
require_once "config.php";
require_once "navBar.php";


$sql = 'CREATE TABLE IF NOT EXISTS testBookings (
bookingID int NOT NULL AUTO_INCREMENT,
testDateTime varchar(256) NOT NULL,
iv varchar(32) NOT NULL,
accountID int NOT NULL,
PRIMARY KEY (bookingID));'; 


if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}


$sql = 'CREATE TABLE IF NOT EXISTS vacBookings (
vaccinationID int NOT NULL AUTO_INCREMENT,
testDateTime varchar(256) NOT NULL,
iv varchar(32) NOT NULL,
accountID int NOT NULL,
PRIMARY KEY (vaccinationID));'; 

if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

$sql = "SELECT * FROM accounts JOIN testBookings ON accounts.accountID = testBookings.accountID";


?>

<html>
<div>
<style>
div { 
	
	background-image: url("https://picsum.photos/id/200/800/800");
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

 </style>
<br>
<body>

<?php


if (isset($_POST['Book'])) {	
$sql = "SELECT accountID, email, iv FROM accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $iv = hex2bin($row['iv']);
    $email = hex2bin($row['email']);
	$accountID = $row['accountID'];
    $unencrypted_email = openssl_decrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	
	if($_SESSION["email"] ===  $unencrypted_email)
	{
		$iv = random_bytes(16);
		$escaped_testDateTime = $conn -> real_escape_string($_POST['testDateTime']);
		$encrypted_testDateTime = openssl_encrypt($escaped_testDateTime, $cipher, $key, OPENSSL_RAW_DATA, $iv);
		$testDateTime_hex = bin2hex($encrypted_testDateTime);
		$iv_hex = bin2hex($iv);


		$sql = "INSERT INTO testBookings (testDateTime, iv, accountID) VALUES ('$testDateTime_hex', '$iv_hex', '$accountID')";

		  if ($conn->query($sql) === TRUE) {
			echo '<p><i>Test Booked For: </i></p>'; echo "$escaped_testDateTime";
			echo "<br>";
			echo "<br>";
			echo '<p><b><i>To stop the spread of COVID19 please self isolate as you wait for your test</i></b></p>';  
		  } else {
			die('Error booking test: ' . $conn->error);
		  }
		
	}
	
  }

} else {
  echo '<p>An issue as occured!</p>';
}

}
?>

<h2>Book a test</h2>
<form action="bookings.php" method="POST">
   <input type="text" id="testDateTime" name="testDateTime" required="required" placeholder= "Book A Test Date & Time" onfocus="(this.type='datetime-local')" /> <br> <br/>
   <input type="submit" value="Book" name= "Book"/> 
</form>
<br>


<?php


if (isset($_POST['Delete'])) {	
$sql = "SELECT accountID, email, iv FROM accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $iv = hex2bin($row['iv']);
    $email = hex2bin($row['email']);
	$accountID = $row['accountID'];
    $unencrypted_email = openssl_decrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	
	
	if($_SESSION["email"] ===  $unencrypted_email)
	{
		$sql = "DELETE FROM accounts WHERE accountID = '$accountID'";
		
		if ($conn->query($sql) === TRUE) {
		 header("location:logout.php");	
		}
		else if (!$conn->query($sql) === TRUE) {
		  die('Error Deleting Account!' . $conn->error);
		}
	}
	
	
  }

} else {
  echo '<p>An issue as occured!</p>';
}

}
?>

<h2>Delete Your Account</h2>
<form action="bookings.php" method="POST">
   <input type="submit" value="Delete" name= "Delete"/> 
</form>
<br>


</div>
</body>
</html>
