<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Username
$password = ""; // No password
$dbname = "selangorsportclub"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>