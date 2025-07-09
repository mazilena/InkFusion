<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inkfusion_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for error and success messages
$error_message = "";
$success_message = "";
$title = '';
$content = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim(isset($_POST['content']) ? $_POST['content'] : ''); // Fallback for content
    $username = $_SESSION['uname']; // Get the username from session
    $status = (isset($_POST['form_action']) && $_POST['form_action'] === 'save_as_draft') ? 'draft' : 'published';

    // Validate title and content
    if (empty($title) || empty($content)) {
        $error_message = "Title and content cannot be empty.";
    } else {
        // Prepare and execute insert statement
        $stmt = $conn->prepare("INSERT INTO documents (uname, title, content, status) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssss', $username, $title, $content, $status);
            if ($stmt->execute()) {
                $success_message = "Document processed successfully!";
                $title = ''; // Clear title
                $content = ''; // Clear content
            } else {
                $error_message = "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close(); // Close database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InkFusion Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://apis.google.com/js/api.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    body {
        font-family: 'Baskervville SC', serif;
        background-color: #000;
        padding: 20px;
        color: #9ca59df5;
    }

    h1 {
        text-align: center;
        color: #9ca59df5;
    }

    #editor {
        width: 100%;
        height: 300px;
        border: 1px solid #9ca59df5;
        padding: 15px;
        background-color: #1a1a1a;
        font-family: 'Baskervville SC', serif;
        color: #9ca59df5;
        margin-bottom: 20px;
        border-radius: 5px;
        overflow-y: auto;
    }

    .toolbar {
        margin-bottom: 15px;
        text-align: center;
        border-bottom: 1px solid #9ca59df5;
        padding-bottom: 10px;
    }

    .toolbar button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        margin-right: 10px;
        font-size: 18px;
        color: #9ca59df5;
        transition: color 0.3s ease;
        display: inline-block; /* Align buttons inline */
        vertical-align: middle; /* Align vertically */
        height: 40px; /* Set a fixed height */
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #9ca59df5;
        border-radius: 5px;
        font-family: 'Baskervville SC', serif;
        font-size: 16px;
        margin-bottom: 10px;
        background-color: #000;
        color: #9ca59df5;
    }

    .action-buttons {
        text-align: center;
        margin-top: 20px;
    }

    .action-buttons button {
        background-color: #000;
        color: rgb(255, 252, 252);
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-family: 'Baskervville SC', serif;
        margin: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .action-buttons button:hover {
        background-color: #9ca59df5;
    }

    .action-buttons a {
        color: white;
        text-decoration: none;
    }

    .alert {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }

    .success {
        color: green;
        text-align: center;
        margin-bottom: 10px;
    }

    /* Navbar Styles */
    header {
        background-color: black;
        padding: 10px 20px;
    }

    .navbar {
        display: flex;
        justify-content: flex-end; /* Align to right */
    }

    .nav-link {
        color: #9ca59df5;
        text-decoration: none;
        padding: 10px;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #fff; /* Change color on hover */
    }
</style>

</head>

<body>
    <!-- Header -->
    <header>
        <div class="navbar">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="books.html">Books</a>
            <a class="nav-link" href="userp.php"><i class="fas fa-user"></i></a>
        </div>
        <h1>InkFusion Editor</h1>
    </header>

    <?php if ($error_message): ?>
        <div class="alert"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="toolbar">
        <button onclick="createNewDocument()" title="New Document"><i class="material-icons">note_add</i></button>
            <button type="button" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
            <button type="button" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
            <button type="button" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
        </div>

        <input type="text" name="title" placeholder="Enter Title" value="<?php echo htmlspecialchars($title); ?>" required>

        <div id="editor" contenteditable="true"><?php echo htmlspecialchars($content); ?></div>

        <input type="hidden" name="form_action" value="">
        <input type="hidden" name="content" id="content" value=""> <!-- Hidden input to store content -->

        <div class="action-buttons">
            <button type="button" onclick="submitForm('save_as_draft')">Save as Draft</button>
            <button type="button" onclick="submitForm('publish_document')">Publish Document</button>
            <a href="admin.php">Back</a>
        </div>
    </form>

    <script>
        function submitForm(action) {
            document.querySelector('input[name="form_action"]').value = action;
            const contentDiv = document.getElementById('editor');
            const hiddenContent = document.getElementById('content'); // Get the hidden input
            hiddenContent.value = contentDiv.innerHTML; // Set the content from the editor
            document.forms[0].submit();
        }

        function formatText(command) {
            document.execCommand(command, false, null);
        }
    </script>
</body>

</html>
