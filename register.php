<?php
require_once "config.php";

$sql = 'CREATE TABLE IF NOT EXISTS accounts (
id int NOT NULL AUTO_INCREMENT,
iv varchar(32) NOT NULL,
username varchar(30) NOT NULL ,
password varchar(30) NOT NULL ,
firstName  varchar(30) NOT NULL,
lastName  varchar(30) NOT NULL,
address  varchar(30) NOT NULL,
email varchar(30) NOT NULL,
phoneNumber  varchar(10) NOT NULL,
PRIMARY KEY (id));'; 

if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';
?>

<html>
<div>
<h2>Registration Page</h2>
<style>
div{ 
	max-width:420px;
	margin:50px auto;
	border-style:
	solid;
	border-width: 
	4px; color:black;
	text-align: 
	center;
}
 </style>
<body>

<?php
if (isset($_POST['Register'])) {
  $iv = random_bytes(16);
  $escaped_content1 = $conn -> real_escape_string($_POST['username']);
  $escaped_content2 = $conn -> real_escape_string($_POST['password']);
  $escaped_content3 = $conn -> real_escape_string($_POST['firstName']);
  $escaped_content4 = $conn -> real_escape_string($_POST['lastName']);
  $escaped_content5 = $conn -> real_escape_string($_POST['address']);
  $escaped_content6 = $conn -> real_escape_string($_POST['email']);
  $escaped_content7 = $conn -> real_escape_string($_POST['phoneNumber']);
  $encrypted_content1 = openssl_encrypt($escaped_content1, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content2 = openssl_encrypt($escaped_content2, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content3 = openssl_encrypt($escaped_content3, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content4 = openssl_encrypt($escaped_content4, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content5 = openssl_encrypt($escaped_content5, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content6 = openssl_encrypt($escaped_content6, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_content7 = openssl_encrypt($escaped_content7, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $iv_hex = bin2hex($iv);
  $username_hex = bin2hex($encrypted_content1);
  $password_hex = bin2hex($encrypted_content2);
  $firstName_hex = bin2hex($encrypted_content3);
  $lastName_hex = bin2hex($encrypted_content4);
  $address_hex = bin2hex($encrypted_content5);
  $email_hex = bin2hex($encrypted_content6);
  $phoneNumber_hex = bin2hex($encrypted_content7);
  $sql = "INSERT INTO accounts (iv, username, password, firstName, lastName, address, email, phoneNumber)
  VALUES ('$iv_hex', '$username_hex', '$password_hex', '$firstName_hex', '$lastName_hex', '$address_hex', '$email_hex', '$phoneNumber_hex')";
  if ($conn->query($sql) === TRUE) {
    echo '<p><i>Account Created!</i></p>';
  } else {
    die('Error creating Account: ' . $conn->error);
  }
}
?>

<form action="register.php" method="POST">
   Username: <input type="text" id="username"
   name="username" required="required" /> <br> <br/>
   Password: <input type="password" id="password"
   name="password" required="required" /> <br> <br/>
   First Name: <input type="text" id="firstName"
   name="firstName" required="required" /> <br> <br/>
   Last Name: <input type="text" id="firstName"
   name="lastName" required="required" /> <br> <br/>
   Address: <input type="text" id="lastName"
   name="address" required="required" /> <br> <br/>
   Email Address: <input type="text" id="email"
   name="email" required="required" /> <br> <br/>
   Phone Number: <input type="text" id="phoneNumber"
   name="phoneNumber" required="required" /> <br> <br/>
   <input type="submit" value="Register" name= "Register"/>
</form>


<p><a href="index.php">Click here to go back</a> </p>
</div>

</div>
</body>
</html>