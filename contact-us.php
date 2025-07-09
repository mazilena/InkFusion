<?php
// Database connection details
$servername = "localhost";  // Host name
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "inkfusion_db";   // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a variable for errors
$errorMsg = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['user_email']);
    $message = htmlspecialchars($_POST['message']);

    // Check if message length is within limit
    if (strlen($message) > 1000) {
        $errorMsg = 'Message must not exceed 1000 characters.';
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO queries (name, user_email, message) VALUES (?, ?, ?)");

        // Check if the prepare() failed and capture the error
        if (!$stmt) {
            $errorMsg = "Error preparing SQL: " . $conn->error;
        } else {
            // Bind parameters and execute the statement
            $stmt->bind_param("sss", $name, $email, $message);
            if ($stmt->execute()) {
                // Redirect back to contact page with a success message
                header("Location: contact-us.php?status=success");
                exit();
            } else {
                $errorMsg = "Error executing SQL: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - InkFusion</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #343a40;
            color: #333;
            font-family: 'Bacasime Antique', 'serif';
            margin: 0;
            padding: 0;
            font-size: 20px;
        }

        h1{
            color:#5c6f85
        }
        header {
            background-color: #343a40;
            color: #ddd;
            padding: 20px;
            text-align: center;
        }

        .contact-info {
            margin: 20px;
            padding: 20px;
            background-color: #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
        }

        .contact-info li {
            margin-bottom: 10px;
        }

        .contact-info strong {
            font-weight: bold;
        }

        .contact-info a {
            color: #3475be;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .contact-form {
            margin: 20px;
            padding: 20px;
            background-color: #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            font-family: 'Bacasime Antique', 'serif';
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .contact-form button {
            padding: 10px 20px;
            background-color: #243b55;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #5c6f85;
        }

        .alert {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 20px;
            display: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #243b55;
            color: #fff;
            text-decoration: none;
            font-size: medium;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5c6f85;
        }
    </style>
</head>

<body>
    <header>
        <h1>Contact Us</h1>
        <p>Thank You For Your Interest In InkFusion, Where We Empower Writers From Around The World To Share Their Stories And Ideas With The World.</p>
    </header>

    <!-- Display success message -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert" style="display: block;">Your message has been sent successfully!</div>
    <?php endif; ?>

    <!-- Display error message -->
    <?php if (!empty($errorMsg)): ?>
        <div class="alert" style="background-color: red; display: block;"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <section class="contact-info">
        <h2>Contact Information</h2>
        <ul>
            <li>
                <strong>Address:</strong> InkFusion Publication House, <br>1234 Book Avenue, <br>City, <br>State, <br>Postal Code, <br>Country
            </li>
            <li>
                <strong>Phone:</strong> Customer Support: +1-123-456-7890
            </li>
            <br>
            <li>
                <strong>Email:</strong>
                <ul>
                    <br>
                    <li>General Inquiries: <a href="mailto:info@inkfusion.com">info@inkfusion.com</a></li>
                    <li>Customer Support: <a href="mailto:support@inkfusion.com">support@inkfusion.com</a></li>
                </ul>
            </li>
            <br>
            <li>
                <strong>Social Media:</strong>
                <ul>
                    <br>
                    <li><a href="https://www.facebook.com/inkfusion" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com/inkfusion" target="_blank">Twitter</a></li>
                    <li><a href="https://www.instagram.com/thedarkvalleythought" target="_blank">Instagram</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <section class="contact-form">
        <h2>Contact Form</h2>
        <form action="contact-us.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="user_email" name="user_email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            <br>
            <button type="submit" style="font-family: 'Baskervville SC', serif;">Submit</button>
            <a href="index.php" class="btn back-to-home">Back to Home</a>
        </form>
    </section>
</body>
</html>
