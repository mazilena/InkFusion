<?php
$servername = "localhost";
$username = "root"; // Default user_name for WAMP is usually 'root'
$password = ""; // Default password for WAMP is usually empty
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, $dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    U_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password_hash VARCHAR(225),
    U_img Blob(255)
)";
if (mysqli_query($conn, $sql)) {
    echo "Table users created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Insert data from the form
$U_id = $_POST['U_id'];
$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password_hash = $_POST['password_hash'];
$U_img = $_POST['U_img'];

$sql = "INSERT INTO users (U_id, user_name, email, password_hash, U_img) VALUES ('$U_id', '$user_name', '$email', '$password_hash, '$U_img')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
