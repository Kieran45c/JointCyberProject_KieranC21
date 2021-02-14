<?php
$host = 'localhost:3308';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sql = 'CREATE DATABASE IF NOT EXISTS Covid19TestBooking;';
if (!$conn->query($sql) === TRUE) {
  die('Error creating database: ' . $conn->error);
}

$sql = 'USE Covid19TestBooking;';
if (!$conn->query($sql) === TRUE) {
  die('Error using database: ' . $conn->error);
}

?>
