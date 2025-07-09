<?php
// submit_content.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['editor1'];
    // Process and store content as needed
    echo "Content received: " . htmlspecialchars($content);
}
