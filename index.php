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
 </style>
<h2>Login Page</h2>
<body>
<form action="index.php" method="POST">
   Enter your username: <input type="text" 
   name="username" required="required" /> <br/> <br>
   Enter password: <input type="password" 
   name="password" required="required" /> <br/> <br>
   <input type="submit" value="Login"/> 
   
</form>
</p><a href="register.php"> Click here to register </p>
</div>
</body>
</html>
