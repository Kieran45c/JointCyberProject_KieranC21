<?php
require_once "config.php";

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

?>

<html>
<div>
<style>
div { 
	max-width:420px;
	margin:50px auto; 
	border-style: solid;
	border-width: 4px;
	color:black;
	text-align: 
	center;
}

input {
 width: 375px;
 height: 25px;
}

 </style>
 
<h2>Login Page</h2>
<body>

<?php

if (isset($_POST['Login'])) {

$sql = "SELECT email, password, iv FROM accounts";
$result = $conn->query($sql);

$escaped_email = $conn -> real_escape_string($_POST['email']);
$escaped_password = $conn -> real_escape_string($_POST['password']);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $email = hex2bin($row['email']);
	$passwordHashed = $row['password'];
	$iv = hex2bin($row['iv']);
    $unencrypted_email = openssl_decrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);

  }
  
  	
    if(password_verify($escaped_password, $passwordHashed)){
		
		echo "Password correct";
	}
	else
	{
		echo "Password incorrect";
	}

	
	
	if($escaped_email === $unencrypted_email)
    {
		echo "Correct Email";
	}
	else
	{
	    echo "Wrong Email";
	}
	
	
} else {
  echo '<p>There are no Accounts!</p>';
}

}
?>

<form action="index.php" method="POST">
   <input type="email" id="email" name="email" required="required" placeholder= "Email Address" /> <br> <br>
   <input type="password" id="password" name="password" required="required" placeholder= "Password" /> <br> <br/>
   <input type="submit" value="Login" name= "Login"/> 
</form>


</p><a href="register.php"> Click here to register </p>

</p><a href="bookings.php"> Click here to go to booking</p>
</div>
</body>
</html>
