<?php 
// Database connection
$host = "localhost"; // your host
$username = "root"; // database username
$password = ""; // database password
$dbname = "inkfusion_db"; // database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}