<?php
require_once "config.php";

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
<form action="index.php" method="POST">
   <input type="text" name="username" required="required" placeholder= "Email Address" /> <br/> <br>
   <input type="password" name="password" required="required" placeholder= "Password" /> <br/> <br>
   <input type="submit" value="Login"/> 
</form>
 
</p><a href="register.php"> Click here to register </p>
</div>
</body>
</html>
