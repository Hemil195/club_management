<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL user
$password = "";      // Default XAMPP MySQL password is empty
$dbname = "clubs_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
