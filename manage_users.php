<?php
session_start();
require 'db.php'; // Database connection

// Check if 'uname' is set in the session (to ensure user is logged in)
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch non-admin users with search functionality
$sql = "SELECT * FROM users WHERE role != 'admin'";

if ($search != '') {
    $sql .= " AND (uname LIKE ? OR email LIKE ?)";
}

$stmt_users = $conn->prepare($sql);
if ($search != '') {
    $stmt_users->bind_param('ss', $search_param, $search_param);
    $search_param = "%$search%";
}

$stmt_users->execute();
$result_users = $stmt_users->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic styling */
        body {
            font-family: 'Baskervville SC', serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #35424a;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .restrict-btn {
            background-color: #e67e22; /* Orange for restrict */
        }

        .delete-btn {
            background-color: #c0392b; /* Red for delete */
        }

        .search-filter {
            font-family: 'Baskervville SC', serif;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center; /* Center items vertically */
        }

        .search-filter input {
            font-family: 'Baskervville SC', serif;
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-filter button {
            font-family: 'Baskervville SC', serif;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px; /* Adjust the size of the icon */
            color: #35424a;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            background: #35424a;
            padding: 10px 20px;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
        }

        .navbar a:hover {
            background: #444;
            border-radius: 5px;
        }

        .add-user {
            text-align: right;
        }

        .add-user a {
            padding: 8px 15px;
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div>
        <a href="index.html">Home</a>
        <a href="admin.php">Admin Profile</a>
    </div>
    <div>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['uname']); ?></span>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="container">
    <h2>Manage Users</h2>

    <!-- Search Form -->
    <div class="search-filter">
        <form method="GET" action="manage_users.php">
            <input type="text" name="search" placeholder="Search users..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" title="Search">
                🔍
            </button>
        </form>
    </div>

    <!-- Users Table -->
    <?php if ($result_users->num_rows > 0): ?>
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($user = $result_users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['uname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="confirmRestrict(<?php echo $user['id']; ?>)" class="action-btn restrict-btn">Restrict User</a>
                        <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $user['id']; ?>)" class="action-btn delete-btn">Delete User</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<script>
// Confirm restrict user
function confirmRestrict(userId) {
    if (confirm("Are you sure you want to restrict this user?")) {
        window.location.href = "restrict_user.php?id=" + userId;
    }
}

// Confirm delete user
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = "delete_user.php?id=" + userId;
    }
}
</script>

<?php
// Close the statement and connection
$stmt_users->close();
$conn->close();
?>

</body>
</html>
