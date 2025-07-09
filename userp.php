<?php
session_start();
require 'db.php'; // Ensure you have a valid connection

// Check if 'uname' is set in the session
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
}

$uname = $_SESSION['uname'];

// Prepare the statement to fetch user data based on uname
$stmt_user = $conn->prepare("SELECT * FROM users WHERE uname = ?");
if ($stmt_user === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt_user->bind_param("s", $uname);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

// Fetch published documents
$stmt_published = $conn->prepare("SELECT * FROM documents WHERE uname = ? AND status = 'published'");
if ($stmt_published === false) {
    die("Error preparing statement for published documents: " . $conn->error);
}

$stmt_published->bind_param("s", $uname);
$stmt_published->execute();
$result_published = $stmt_published->get_result();

// Fetch drafts
$stmt_drafts = $conn->prepare("SELECT * FROM documents WHERE uname = ? AND status = 'draft'");
if ($stmt_drafts === false) {
    die("Error preparing statement for drafts: " . $conn->error);
}

$stmt_drafts->bind_param("s", $uname);
$stmt_drafts->execute();
$result_drafts = $stmt_drafts->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
body {
    font-family: 'Baskervville SC', serif;
    margin: 0;
    padding: 0;
    background-color: #35424a;
}

header {
    background: #35424a;
    color: #ffffff;
    padding: 20px 0;
}

.admin-header h1 {
    text-align: center;
    margin: 0;
}

.navbar {
    display: flex;
    justify-content: flex-end; /* Aligns items to the right */
    gap: 20px;
    padding-right: 20px; /* Optional: Add some padding to the right */
}

.navbar a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
}

.navbar a:hover {
    text-decoration: underline;
}


.main-content {
    max-width: 800px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.welcome-message {
    font-size: 24px;
    margin-bottom: 20px;
}

.profile-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #35424a;
}

h3 {
    color: #35424a;
    border-bottom: 2px solid #35424a;
    padding-bottom: 10px;
}

.table-container {
    display: flex;
    justify-content: space-between; /* Space between the two tables */
    margin-top: 20px; /* Add some space above the tables */
}

.table-section {
    flex: 1; /* Make both tables take equal space */
    margin-right: 20px; /* Optional: Space between the tables */
}

.table-section:last-child {
    margin-right: 0; /* Remove right margin for the last table */
}

table {
    width: 100%; /* Full width for the tables */
    border-collapse: collapse; /* Merge borders */
}

th, td {
    border: 1px solid #ccc; /* Table cell border */
    padding: 10px; /* Padding inside cells */
    text-align: left; /* Align text to the left */
    text-decoration: none;
}

th {
    background-color: #f2f2f2; /* Header background color */
}

.no-documents {
    text-align: center;
    color: #888;
}

.button-container {
    text-align: center;
}

.create-doc-btn {
    background-color: #35424a;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.create-doc-btn:hover {
    background-color: #444;
}

.logout-btn {
    background-color: #e74c3c;
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
}

.logout-btn:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>
<!-- Header -->
<header>
    <div class="admin-header">
        <div class="navbar">
            <a href="index.php">Home</a>
            <a href="editor.php">Create Post</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="main-content">
    <div class="welcome-message">Welcome, <?php echo htmlspecialchars($user['uname']); ?>!</div>
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user['img']); ?>" alt="Profile Picture" class="profile-picture">
    </div>

    <!-- Container for the tables -->
    <div class="table-container">
        <!-- Published documents Table -->
        <div class="table-section">
            <h3>Published documents</h3>
            <?php if ($result_published->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($document = $result_published->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($document['title']); ?></td>
                                <td><a href="editor.php?id=<?php echo htmlspecialchars($document['id']); ?>">Edit</a></td>
                                <td><a href="delete.php" onclick="confirmDelete(<?php echo htmlspecialchars($document['id']); ?>)">Delete</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-documents">No published documents available.</p>
            <?php endif; ?>
        </div>

        <!-- Draft documents Table -->
        <div class="table-section">
            <h3>Drafts</h3>
            <?php if ($result_drafts->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($document = $result_drafts->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($document['title']); ?></td>
                                <td><a href="editor.php?id=<?php echo htmlspecialchars($document['id']); ?>">Edit</a></td>
                                <td><a href="#" onclick="confirmDelete(<?php echo htmlspecialchars($document['id']); ?>)">Delete</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-documents">No drafts available.</p>
                <div class="button-container">
                    <a href="editor.php" class="create-doc-btn">Create Your Post Now</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- JavaScript for Delete Confirmation -->
<script>
function confirmDelete(documentId) {
    if (confirm("Are you sure you want to delete this post?")) {
        window.location.href = "delete.php?id=" + documentId;
    }
}
</script>

<?php
$stmt_user->close();
$stmt_published->close();
$stmt_drafts->close();
$conn->close();
?>
</body>
</html>
