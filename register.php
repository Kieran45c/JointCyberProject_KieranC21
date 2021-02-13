<?php
require_once "config.php";

?>


<html>
<h2>Registration Page</h2>
<body>
<form action="register.php" method="POST">
   Enter Your First Name: <input type="text" 
   name="username" required="required" /> <br> <br/>
   Enter Your Last Name: <input type="text" 
   name="username" required="required" /> <br> <br/>
   Enter Your Address Name: <input type="text" 
   name="username" required="required" /> <br> <br/>
   Enter Your Phone Number: <input type="text" 
   name="username" required="required" /> <br> <br/>
   Enter password: <input type="password" 
   name="password" required="required" /> <br> <br/>
   <input type="submit" value="Register"/>
</form>
<a href="index.php">Click here to go back</a>
</body>
</html>