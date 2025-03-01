<?php
$host = "localhost";
$user = "root";  // Default for XAMPP
$pass = "";      // Default is empty
$dbname = "user_db";  // Change this if your actual database name is different

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
