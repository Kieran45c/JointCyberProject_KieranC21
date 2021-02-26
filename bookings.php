<?php
require_once "config.php";
require_once "navBar.php";

session_start();

if(!isset($_SESSION["email"]))
{
	header("location:index.php?action=login");
}

$sql = 'CREATE TABLE IF NOT EXISTS bookings (
bookingID int NOT NULL AUTO_INCREMENT,
testDateTime varchar(256) NOT NULL,
iv varchar(32) NOT NULL,
accountID INT NOT NULL REFERENCES accounts(accountID),
PRIMARY KEY (bookingID));'; 

if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

$sql = "SELECT * FROM accounts JOIN bookings ON accounts.accountID = bookings.accountID";

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

 </style>
<br>
<body>

<?php
echo '<h2>Welcome: '.$_SESSION["email"].'</h2>';

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


		$sql = "INSERT INTO bookings (testDateTime, iv, accountID) VALUES ('$testDateTime_hex', '$iv_hex', '$accountID')";

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


</div>
</body>
</html>
