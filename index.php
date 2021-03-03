<?php
require_once "config.php";

session_start();

?>

<html>
<div>
<style>
div { 	
	background-color: grey;
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

h2 {
	color: white;	
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
 
<h2>Login</h2>
<body>

<?php

if(isset($_SESSION["email"]))
{
	header("location:bookings.php");
}
if (isset($_POST['Login'])) {

$sql = "SELECT email, password, iv FROM accounts";
$result = $conn->query($sql);

$escaped_email = $conn -> real_escape_string($_POST['email']);
$escaped_password = $conn -> real_escape_string($_POST['password']);

$count = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $email = hex2bin($row['email']);
	$passwordHashed = $row['password'];
	$iv = hex2bin($row['iv']);
    $unencrypted_email = openssl_decrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
 	
    if($escaped_email === $unencrypted_email)
    {
		if(password_verify($escaped_password, $passwordHashed))
		{
			$_SESSION["email"] =  $unencrypted_email;
			header("location:bookings.php");	
		}
		else
		{
			echo '<p>Wrong Password!</p>';
			break;
		}
	}
	else
	{
		$count++;
	}
	
	if($escaped_email != $unencrypted_email && $count < 2)
	{
		echo '<p>Wrong Email!</p>';
	}
		
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


<p><a href="register.php">Click Here To Sign Up</p>
</div>
</body>
</html>
