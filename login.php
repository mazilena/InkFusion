<?php
// Debugging - Enable Error Reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session

$host = "localhost"; // your host
$username = "root"; // database username
$password = ""; // database password
$dbname = "inkfusion_db"; // database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch user from the database based on email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['uname'] = $user['uname']; // Change to match 'uname'
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Fetching role from the database

            // Redirect based on role
            if ($user['role'] === 'admin') {
                // Redirect to admin dashboard if the role is 'admin'
                header("Location: admin.php");
                exit();
            } else {
                // Redirect to user dashboard if the role is not 'admin'
                header("Location: userp.php");
                exit();
            }
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No account found with that email!";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - InkFusion</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            background-color: #f8f9fa;
        }
        .login-box {
            background-color: white;
            padding: 0;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            height: 644.5px;
            width: 100%;
            max-width: 900px;
        }
        .login-image {
            max-width: 50%;
            object-fit: cover;
        }
        .login-form {
            padding: 2rem;
            flex: 1;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <!-- Login Form -->
    <div class="login-container">
        <div class="login-box">
            <img src="img/lbnnr1.jpg" alt="Login" class="login-image" />
            <div class="login-form">
                <h2>Login to Your Account</h2>

                <!-- Display error if it exists -->
                <?php if (!empty($error)): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="login.php" method="post" id="login-form">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                    <p class="text-center mt-3">Don't have an account? <a href="register.php">Sign up</a>.</p>
                    <p class="text-center mt-3"><a href="index.php">Back To Home</a>.</p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
