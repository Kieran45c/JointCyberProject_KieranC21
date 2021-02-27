<?php
require_once "config.php";
require_once "navBar.php";

?>

<html>
<div>
<style>
div { 
	
	background-image: url("https://picsum.photos/id/450/800/800");
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


<h2>You can view your test results here when they become available or by text</h2>

<form action="viewTestResults.php">
    <input type="text" id="Not Available" name="Not Available" value="Not Available" readonly><br><br>
</form>



</div>
</body>
</html>