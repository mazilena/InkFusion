<?php
require 'db.php'; // Ensure you have a valid connection

// Check if the user ID is provided
if (!isset($_GET['id'])) {
    die("Error: User ID not provided.");
}

$user_id = $_GET['id'];

// Fetch the user's current details from the database
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    die("Error: User not found.");
}

// If form is submitted, update the user's details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_uname = $_POST['uname'];
    $new_email = $_POST['email'];

    $update_stmt = $conn->prepare("UPDATE users SET uname = ?, email = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $new_uname, $new_email, $user_id);
    
    if ($update_stmt->execute()) {
        echo "User updated successfully.";
        header("Location: manage_users.php"); // Redirect to the users management page
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit User: <?php echo htmlspecialchars($user['uname']); ?></h2>

    <!-- Edit Form -->
    <form action="edit_user.php?id=<?php echo htmlspecialchars($user_id); ?>" method="POST">
        <label for="uname">Username:</label>
        <input type="text" name="uname" id="uname" value="<?php echo htmlspecialchars($user['uname']); ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br>

        <button type="submit">Save Changes</button>
    </form>

</body>
</html>
