<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Baskervville SC', serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Upload a New Book</h2>
        <form action="upload_book.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image:</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Book</button>
            <a href="admin.php" class="btn btn-primary">Back</a>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "inkfusion_db");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieving form data
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];

        // Handling file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a real image
        $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["cover_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Try to upload file
            if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
                // Insert into database
                $stmt = $conn->prepare("INSERT INTO books (title, subtitle, author, genre, description, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $title, $subtitle, $author, $genre, $description, $target_file);

                if ($stmt->execute()) {
                    echo "The book has been uploaded successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $conn->close();
    }
    ?>
</body>

</html>
