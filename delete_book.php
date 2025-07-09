<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
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
        <h2 class="text-center mt-4">Delete a Book</h2>
        <form action="delete_book.php" method="POST">
            <div class="form-group">
                <label for="book_id">Select Book to Delete:</label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="">Select a book</option>
                    
                    <?php
                    // Database connection
                    $conn = new mysqli("localhost", "root", "", "inkfusion_db");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all books to populate the dropdown
                    $sql = "SELECT id, title FROM books";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No books available</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Delete Book</button>
            <a href="admin.php" class="btn btn-primary">Back</a>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = new mysqli("localhost", "root", "", "inkfusion_db");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $book_id = $_POST['book_id'];

        // Delete book from the database
        $sql = "DELETE FROM books WHERE id = $book_id";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='text-success text-center'>Book deleted successfully!</p>";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>

</html>
