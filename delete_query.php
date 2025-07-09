<?php
// Database connection details
$servername = "localhost";  // Hostname
$username = "root";  // MySQL username
$password = "";  // MySQL password
$dbname = "inkfusion_db";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set and is a valid number
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    // Get the ID from the form
    $id = intval($_POST['id']);  // Sanitize the input

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM queries WHERE id = ?");
    
    // Bind the parameter (the ID) to the prepared statement
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!');</script>";
        header("Location: admin.php?status=deleted"); // Redirect with a status message
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<script>alert('Invalid ID or no ID provided.');</script>";
}

// Close the connection
$conn->close();
?>
