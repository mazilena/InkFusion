<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .library-row {
            display: flex;
            justify-content: center;
            gap: 20px; /* Adjusts spacing between book items */
            flex-wrap: wrap; /* Allows books to wrap into multiple rows */
            margin-bottom: 20px; /* Adds space between rows */
        }

        .new-picks .book {
            border: 1px solid #ddd; /* Add border to each book */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Crop images and text */
            width: 300px; /* Fixed width to fit into multiple rows */
            text-align: center; /* Center text */
            margin-bottom: 20px; /* Adds spacing between rows */
        }

        .new-picks .book img {
            width: 100%; /* Make image full width */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="img/F.jpg" alt="InkFusion Logo" class="logo">
                <h1 class="h3 ml-2 mb-0">InkFusion</h1>
            </div>
            <nav class="nav">
                <a class="nav-link text-white" href="index.php">Home</a>
                <a class="nav-link text-white" href="about.php">About</a>
                <a class="nav-link text-white" href="register.php"><i class="fas fa-user"></i></a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- New Picks Section -->
        <h1 class="text-center">Our New Picks</h1>

        <?php
        // New Picks Data (for example)
        $books = [
            ["img" => "img/TLOK.jpg", "link" => "https://notionpress.com/read/the-love-of-kaleidoscope", "title" => "The Love Of Kaleidoscope", "subtitle" => "The Illusion Of Love", "author" => "Shekh Mazida Khatun"],
            ["img" => "img/glms.jpg", "link" => "https://notionpress.com/read/the-glimmer-s-of-hope", "title" => "The Glimmer's Of Hope", "subtitle" => "From Struggle to Strength", "author" => "Shekh Mazida Khatun"],
            ["img" => "img/lfe.jpg", "link" => "https://notionpress.com/read/life-s-mosaic", "title" => "Life's Mosaic", "subtitle" => "A Collection of Poetic Musings", "author" => "Shekh Mazida Khatun"],
            ["img" => "img/Tpa.jpg", "link" => "#", "title" => "Honoring the Brave", "subtitle" => "The Pulwama Attack", "author" => "Shekh Mazida Khatun"],
            ["img" => "img/Love.jpg", "link" => "#", "title" => "I'm With You", "author" => "Shekh Mazida Khatun"],
            ["img" => "img/Realfz.jpg", "link" => "#", "title" => "Rooh-E-Alfaz", "author" => "Shekh Mazida Khatun"]
        ];

        // Displaying Books in Two Rows
        echo '<div class="library-row new-picks">';
        foreach ($books as $book) {
            echo '<div class="book">';
            echo '<a href="' . $book['link'] . '">';
            echo '<img src="' . $book['img'] . '" alt="Book Cover">';
            echo '</a>';
            echo '<h3>' . $book['title'] . '<br>' . (isset($book['subtitle']) ? $book['subtitle'] : '') . '</h3>';
            echo '<p>Author: <br>' . $book['author'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
        ?>

        <!-- NWC Section (Unchanged) -->
        <h1 class="text-center">National Writing Contest</h1>
        <div class="library">
            <div class="book">
                <img src="img/mmrs.webp" alt="Book 1 Cover">
            </div>
            <div class="book">
                <img src="img/cictx.jpeg" alt="Book 2 Cover">
            </div>
            <div class="book">
                <img src="img/unwnd.webp" alt="Book 3 Cover">
            </div>
            <div class="book">
                <img src="img/lf.webp" alt="Book 4 Cover">
            </div>
        </div>
    </main>

    <div>
        <a href="#top">
            <img src="bck.jpg" alt=""></a>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 InkFusion. All rights reserved.</p>
            <p>
                <a href="about.php" class="text-white">About</a> |
                <a href="contact-us.php" class="text-white">Contact</a> |
                <a href="privacy-policy.php" class="text-white">Privacy Policy</a> |
                <a href="t&s.php" class="text-white">Terms of Service</a>
            </p>
            <p>
                <a href="#" class="text-white">Facebook</a> |
                <a href="#" class="text-white">Twitter</a> |
                <a href="#" class="text-white">LinkedIn</a>
            </p>
        </div>
    </footer>
</body>

</html>
