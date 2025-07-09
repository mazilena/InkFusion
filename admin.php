<?php
session_start();
if (!isset($_SESSION['uname']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION['uname'];
$admin_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Baskervville SC', serif;
        }
        .admin-header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-header h1 {
            font-size: 2rem;
            margin: 0;
        }
        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
        }
        .navbar {
            background-color: #495057;
            padding: 10px;
        }
        .navbar a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
            font-size: 18px;
        }
        .navbar a:hover {
            color: #ffc107;
        }
        .navbar .logout {
            margin-left: auto;
            color: white;
        }
        .main-content {
            margin-top: 20px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1 style="color: whitesmoke"><?php echo strtoupper($admin_name); ?></h1>
        <div class="profile">
            <?php
            $profile_pic = "upload/" . htmlspecialchars($admin_email) . ".jpg";
            ?>
            <img src="<?php echo $profile_pic; ?>" alt="Admin Profile Picture">
        </div>
    </div>
    <div class="navbar">
        <a href="books.php">Manage Books</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="main-content container">
        <div class="card" id="manage-books">
            <div class="card-header">
                <h3>List Of Books</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('db.php');
                        $query = "SELECT * FROM books";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['subtitle']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                                echo "<td><button class='btn btn-danger btn-sm' onclick='deleteBook(" . $row['id'] . ")'>Delete</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No books found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

                <!-- New Section for Queries -->
                <div class="card" id="view-queries">
            <div class="card-header">
                <h3>User Queries</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date Submitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch queries from the database
                        $query = "SELECT * FROM queries ORDER BY submitted_at DESC";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['submitted_at']) . "</td>";
                                echo "<td><button class='btn btn-danger btn-sm' onclick='deleteQuery(" . $row['id'] . ")'>Delete</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No queries found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Function to delete a query
        function deleteQuery(id) {
            if (confirm('Are you sure you want to delete this query?')) {
                window.location.href = 'delete_query.php?id=' + id;
            }
        }
    </script>
</body>
</html>
