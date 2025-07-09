<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
    /* styles.css */
body {
    font-family: 'Baskervville SC', serif;
    background-color: #f8f9fa; /* Light background color */
    color: #333; /* Dark text for readability */
}

.container {
    max-width: 800px; /* Limit container width for better layout */
    margin: 20px auto; /* Center the container */
    padding: 20px;
    background-color: #fff; /* White background for the content */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

h2 {
    text-align: center; /* Center the heading */
    margin-bottom: 20px;
}

.library {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px; /* Space between book items */
}

.book {
    border: 1px solid #ddd; /* Add border to each book */
    border-radius: 8px; /* Rounded corners */
    overflow: hidden; /* Crop images and text */
    width: 200px; /* Fixed width for book items */
    text-align: center; /* Center text */
    transition: transform 0.3s; /* Smooth transition for hover effect */
}

.book:hover {
    transform: scale(1.05); /* Slight zoom effect on hover */
}

.book img {
    width: 100%; /* Full width for images */
    height: auto; /* Maintain aspect ratio */
}

.btn {
    margin: 5px; /* Space around buttons */
}

    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Manage Books</h2>
        <div class="text-center mb-4">
            <a href="upload_book.php" class="btn btn-success">Upload New Book</a>
            <a href="delete_book.php" class="btn btn-danger">Delete Book</a>
            <a href="admin.php" class="btn btn-primary">Back</a>
        </div>
        <div class="library">
            <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "inkfusion_db");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch books from the database
                $sql = "SELECT title, author, cover_image FROM books";
                $result = $conn->query($sql);

                // Check if records were fetched
                if ($result && $result->num_rows > 0) {
                    $books = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $books = [];
                }

                $conn->close();
            ?>

            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book">
                        <img src="<?php echo $book['cover_image']; ?>" alt="<?php echo $book['title']; ?> Cover" class="img-fluid">
                        <h3><?php echo $book['title']; ?></h3>
                        <p>Author: <?php echo $book['author']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
