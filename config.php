<?php

$host = "localhost";
$database = "blogging";
$username = "root";
$password = "";

// Correct order: host, username, password, database
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection properly
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
