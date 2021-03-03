<?php
$host = 'localhost';
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

$sql = 'CREATE TABLE IF NOT EXISTS accounts (
accountID int NOT NULL AUTO_INCREMENT,
firstName  varchar(256) NOT NULL,
lastName  varchar(256) NOT NULL,
dateOfBirth varchar(256) NOT NULL,
email varchar(256) NOT NULL,
password varchar(256) NOT NULL,
address  varchar(256) NOT NULL,
phoneNumber  varchar(256) NOT NULL,
iv varchar(32) NOT NULL,
PRIMARY KEY (accountID));'; 

if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';
?>
