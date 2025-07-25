<?php
// Sample PHP code for dynamic data (if needed)
$books = [
    [
        'title' => 'The Love Of Kaleidoscope',
        'image' => 'img/TLOK.jpg',
        'link' => 'https://notionpress.com/read/the-love-of-kaleidoscope',
        'description' => 'Beautifully examining the complexity of human emotions, the fragility of relationships, and the deep effects of misunderstandings, "The Love Of Kaleidoscope" is a work of art. "The Love Of Kaleidoscope" delivers a thought-provoking examination of love, sorrow, and the resiliency of the human spirit via its moving tale and expertly rendered emotions.'
    ],
    [
        'title' => 'The Glimmer\'s of Hope',
        'image' => 'img/glms.jpg',
        'link' => 'https://notionpress.com/read/the-glimmer-s-of-hope',
        'description' => '"The Glimmer\'s of Hope: From Struggle to Strength" is a collection of powerful and inspiring quotes that will help you find hope and strength in the face of adversity.'
    ],
    [
        'title' => 'Life\'s Mosaic',
        'image' => 'img/lfe.jpg',
        'link' => 'https://notionpress.com/read/life-s-mosaic',
        'description' => '"Life\'s Mosaic: A Collection of Poetic Musings" is a collection of poetry that explores human emotions and experiences through evocative language and imagery.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InkFusion</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="img/F.jpg" alt="InkFusion Logo" class="logo">
                <h1 class="h3 ml-2 mb-0" style="font-weight: bold; color: whitesmoke">InkFusion</h1>
            </div>
            <nav class="nav">
                <a class="nav-link text-white" href="index.php">Home</a>
                <a class="nav-link text-white" href="about.php">About</a>
                <div class="dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="editor.php">Create Post</a>
                        <a class="dropdown-item" href="library.php">Library</a>
                    </div>
                </div>
                <a class="nav-link text-white" href="contact-us.php">Contact</a>
                <a class="nav-link text-white" href="register.php">Register</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero text-black text-center py-3">
        <div class="container">
            <div class="d-flex justify-content-between">
                <img src="img/bn1.jpg" alt="If Not NOW, Then WHEN?" style="height: 450px; width: 700px; margin-left: -120px; margin-top: -16px;">
                <div class="hero-img-with-button">
                    <img src="img/IF.png" alt="If Not NOW, Then WHEN?" style="height: 450px;width: 716.5px;margin-top: -16px;">
                    <a href="register.php" class="btn btn-warning mt-3 action-button">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5">
        <h2 style="font-weight:bolder; text-align: center;font-size: 50pt;">Our Best Of Last Published</h2>
        <div class="container">
            <br>
            <div class="row">
                <?php foreach ($books as $book): ?>
                <div class="col-md-4">
                    <a href="<?php echo $book['link']; ?>" class="card-link">
                        <div class="card book-card">
                            <img src="<?php echo $book['image']; ?>" class="card-img-top" alt="Book">
                            <div class="overlay">
                                <p class="card-text"><?php echo $book['description']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Quotes Carousel -->
        <br><section class="carousel slide" id="quotesCarousel" data-ride="carousel">
            <div class="container">
                <h2 class="text-center mb-4" style="text-align: center;font-size: 30pt;">What Writers Say's</h2> <br>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p style="font-style: italic; font-size: 16pt; font-weight: bold; text-align: center;">“You can’t cross the sea merely by standing and staring at the water.” <br>~Rabindranath Thakur</p>
                    </div>
                    <div class="carousel-item">
                        <p style="font-style: italic; font-size: 16pt; font-weight: bold; text-align: center;">“The truth is that the art of writing is the art of discovering what you believe.” <br>~Salman Rushdie</p>
                    </div>
                    <div class="carousel-item">
                        <p style="font-style: italic; font-size: 16pt; font-weight: bold; text-align: center;">“The adage that ‘writers write’ is not true. It should be ‘writers rewrite.” <br>~Stephen King</p>
                    </div>
                    <div class="carousel-item">
                        <p style="font-style: italic; font-size: 16pt; font-weight: bold; text-align: center;">“The beauty of the world has a certain kind of magic to it that I try to convey through my writing.” <br>~Jhumpa Lahiri</p>
                    </div>
                    <div class="carousel-item">
                        <p style="font-style: italic; font-size: 16pt; font-weight: bold; text-align: center;">“Dream, dream, dream. Dreams transform into thoughts and thoughts result in action.” <br>~A.P.J Abdul Kalam</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#quotesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#quotesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
    </section>

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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
