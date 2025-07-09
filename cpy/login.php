<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change this if your MySQL username is different
$password = ""; // Change this if your MySQL password is different
$dbname = "inkfusion_db"; // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

    // Validate input
    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                echo "Login successful!";
                // Start a session, set session variables, or redirect the user here
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "No user found with this email.";
        }

        $stmt->close();
    }
}

$conn->close();
