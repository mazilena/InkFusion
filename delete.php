<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "inkfusion_db";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['uname'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM documents WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        echo "success"; // Send success response
    } else {
        echo "error";
    }

    $stmt_delete->close();
    $conn->close();
}

?>
