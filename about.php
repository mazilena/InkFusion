<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | InkFusion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Bacasime Antique', 'serif';
            background-color: #f4f4f4; /* Light background */
            color: #333; /* Dark text */
            font-family: 'Arial', sans-serif; /* Consistent font */
        }
        header {
            font-family: 'Bacasime Antique', 'serif';
            background-color: #343a40; /* Dark header */
            padding: 20px 0;
        }
        .logo {
            width: 50px; /* Logo size */
            height: auto;
        }
        .header {
            text-align: center;
            padding: 50px;
            background-color: #343a40; /* Brand color */
            color: white; /* White text for header */
            border-radius: 8px; /* Rounded corners */
            margin-bottom: 40px; /* Space below header */
        }
        .section {
            font-family: 'Bacasime Antique', 'serif';
            background-color: #ffffff; /* White section background */
            border-radius: 8px; /* Rounded corners */
            padding: 30px; /* Padding */
            margin-bottom: 30px; /* Space between sections */
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        h1, h2 {
            font-family: 'Bacasime Antique', 'serif';
            color: #343a40; /* Accent color for headings */
        }
        p {
            font-family: 'Bacasime Antique', 'serif';
            line-height: 1.6; /* Better readability */
            font-size: 1.1em; /* Slightly larger font */
        }
        footer {
            font-family: 'Bacasime Antique', 'serif';
            text-align: center;
            padding: 20px;
            background-color: #343a40; /* Dark footer */
            color: white; /* White text */
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 30px; /* Space above footer */
        }
        .btn-custom {
            font-family: 'Bacasime Antique', 'serif';
            background-color: #343a40; /* Button color */
            color: white; /* Button text color */
            transition: background-color 0.3s; /* Smooth transition */
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        /* Responsive design */
        @media (max-width: 768px) {
            .header {
                padding: 30px; /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="img/F.jpg" alt="InkFusion Logo" class="logo">
                <h1 class="h3 ml-2 mb-0" style="color:white;">InkFusion</h1>
            </div>
            <nav class="nav">
                <a class="nav-link text-white" href="index.php">Home</a>
                <a class="nav-link text-white" href="contact-us.php">Contact</a>
                <a class="nav-link text-white" href="register.php"><i class="fas fa-user"></i></a>
            </nav>
        </div>
    </header>
    
    <div class="container mt-5">
        <div class="header">
            <h1>Welcome to InkFusion</h1>
            <p>A DYNAMIC and EMPOWERING Platform Dedicated To NURTURING And AMPLIFYING The VOICES OF WRITERS From Around The GLOBE.</p>
        </div>

        <div class="section">
            <h2>Our Mission</h2>
            <p>At InkFusion, our mission is to empower writers from all corners of the world, regardless of background, experience, or genre. We strive to create a diverse and inclusive community where every voice matters and every story finds a place to be heard. We believe in the transformative power of words and are committed to providing a platform that fosters growth, inspires innovation, and sparks meaningful conversations.</p>
        </div>

        <div class="section">
            <h2>Our Commitment to Writers</h2>
            <p>We are dedicated to fostering a nurturing environment where writers can thrive and reach their full potential. InkFusion offers a range of opportunities, from showcasing individual works to providing valuable resources and fostering a supportive community. Our commitment is to assist writers in honing their craft, finding their unique voice, and sharing their stories with the world.</p>
        </div>

        <div class="section">
            <h2>Join Our Community</h2>
            <p>Whether you're a seasoned author, a budding wordsmith, or simply a lover of great storytelling, InkFusion welcomes you to be part of our vibrant community. Together, let's celebrate the power of the written word and work towards a world where every story, every thought, and every voice finds its rightful place in the literary landscape.</p>
        </div>
    </div>

    <footer>
        <div class="container">
        <p>&copy; 2024 InkFusion. All rights reserved.</p>
        <p>
                <a href="about.php" class="text-white">About</a> |
                <a href="contact-us.html" class="text-white">Contact</a> |
                <a href="privacy-policy.html" class="text-white">Privacy Policy</a> |
                <a href="t&s.html" class="text-white">Terms of Service</a>
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
