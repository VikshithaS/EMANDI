<?php
$servername = 'localhost';
$database   = 'fsms';
$username   = 'root';
$password   = ''; // Use password if set in XAMPP

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Connection established successfully";
}
?>
