<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
}

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Prepare the SQL statement to restrict the user
    // Assuming 'is_restricted' is a field in your 'users' table
    $stmt = $conn->prepare("UPDATE users SET is_restricted = 1 WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect to manage_users.php with a success message
        header("Location: manage_users.php?message=User restricted successfully.");
    } else {
        // Redirect with an error message
        header("Location: manage_users.php?message=Error restricting user.");
    }

    // Close statement
    $stmt->close();
} else {
    // Redirect back if no ID is set
    header("Location: manage_users.php");
}

// Close the connection
$conn->close();
?>
