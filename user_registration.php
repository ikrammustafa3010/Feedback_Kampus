<?php
$servername = "localhost"; // Change to your database server
$username_db = "root";     // Your database username
$password_db = "";         // Your database password (if any)
$dbname = "user_registration"; // Your database name

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>