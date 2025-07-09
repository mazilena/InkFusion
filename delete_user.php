<?php
require 'db.php';

// Check if user is admin
session_start();
if (!isset($_SESSION['uname']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Get user ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_users.php?success=User deleted");
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
} else {
    header("Location: manage_users.php?error=Invalid request");
}
$conn->close();
?>
