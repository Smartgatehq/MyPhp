<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myPhp_work_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// // Create database
// $sql = "CREATE DATABASE myPhp_work_db";
// if ($conn->query($sql) === TRUE) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . $conn->error;
// }

// $conn->close();



// Creating table

// $sql = 'CREATE TABLE regform1(
//     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     first_name VARCHAR(50) NOT NULL,
//     lastname_name VARCHAR(50) NOT NULL,
//     email VARCHAR(50) NOT NULL,
//     phone_number INT(11) NOT NULL,
//     gender VARCHAR(10) NOT NULL,
//     username VARCHAR(20) NOT NULL,
//     password VARCHAR(50) NOT NULL,
//     confirm_password VARCHAR(50) NOT NULL
// )';

// if ($conn->query($sql) === TRUE) {
//     echo 'Table for regform1 created successfully';
// } else {
//     echo 'Error creating table: ' . $conn->error;
// }

// $conn->close();

?>