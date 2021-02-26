<?php
require_once "config.php";

session_start();

?>

<html>
<div>
<h2>Sign Up</h2>
<style>
div{ 	
	background-color: grey;
	max-width:420px;
	margin:50px auto;
	border-style:
	solid;
	border-width: 
	4px; color:black;
	text-align: 
	center;
}

h2 {
	color: white;	
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
}

a:hover {
  background-color: red;
}
 </style>
<body>

<?php
if (isset($_POST['Register'])) {

  $escaped_password = $conn -> real_escape_string($_POST['password']);
  $hash = password_hash($escaped_password, PASSWORD_DEFAULT);
  
  $iv = random_bytes(16);
  $escaped_firstName = $conn -> real_escape_string($_POST['firstName']);
  $escaped_lastName = $conn -> real_escape_string($_POST['lastName']);
  $escaped_dateOfBirth = $conn -> real_escape_string($_POST['dateOfBirth']);
  $escaped_email = $conn -> real_escape_string($_POST['email']);
  $escaped_address = $conn -> real_escape_string($_POST['address']);
  $escaped_phoneNumber = $conn -> real_escape_string($_POST['phoneNumber']);
  
  $encrypted_firstName = openssl_encrypt($escaped_firstName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_lastName = openssl_encrypt($escaped_lastName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_dateOfBirth = openssl_encrypt($escaped_dateOfBirth, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_email = openssl_encrypt($escaped_email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_address = openssl_encrypt($escaped_address, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  $encrypted_phoneNumber = openssl_encrypt($escaped_phoneNumber, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  
  $firstName_hex = bin2hex($encrypted_firstName);
  $lastName_hex = bin2hex($encrypted_lastName);
  $dateOfBirth_hex = bin2hex($encrypted_dateOfBirth);
  $email_hex = bin2hex($encrypted_email);
  $address_hex = bin2hex($encrypted_address);
  $phoneNumber_hex = bin2hex($encrypted_phoneNumber);
  $iv_hex = bin2hex($iv);
  
  $sql = "INSERT INTO accounts (firstName, lastName, dateOfBirth, email, password, address, phoneNumber, iv)
  VALUES ('$firstName_hex', '$lastName_hex', '$dateOfBirth_hex', '$email_hex', '$hash', '$address_hex', '$phoneNumber_hex', '$iv_hex')";
  
  if ($conn->query($sql) === TRUE) {
    echo '<p><i>Account Created!</i></p>';
  } else {
    die('Error creating Account: ' . $conn->error);
  }
}
?>

<form action="register.php" method="POST">
   <input type="text" id="firstName" name="firstName" required="required" placeholder= "First Name" /> <br> <br/>
   <input type="text" id="lastName" name="lastName" required="required" placeholder= "Last Name" /> <br> <br/>
   <input type="text" id="dateOfBirth" name="dateOfBirth" required="required" placeholder= "Date Of Birth" onfocus="(this.type='date')" /> <br> <br/>
   <input type="email" id="email" name="email" required="required" placeholder= "Email Address" /> <br> <br/>
   <input type="password" id="password" name="password" required="required" placeholder= "Password" /> <br> <br/>
   <input type="text" id="lastName" name="address" required="required"  placeholder= "Address" /> <br> <br/>
   <input type="tel" id="phoneNumber" name="phoneNumber" required="required" placeholder= "Phone Number" /> <br> <br/>
   <input type="submit" value="Register" name= "Register"/>
</form>



<p><a href="index.php">Click Here To Login</a> </p>
</div>

</div>
</body>
</html>