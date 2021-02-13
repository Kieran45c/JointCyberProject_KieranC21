<?php
$host = 'localhost:3308';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}
?>
