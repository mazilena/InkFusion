<?php
// Database connection
$host = "localhost"; // your host
$username = "root"; // database username
$password = ""; // database password
$dbname = "inkfusion_db"; // database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $uname = $_POST["uname"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $cpass = $_POST["cpass"];

   // Check if passwords match
   if ($password !== $cpass) {
      echo "Passwords do not match!";
      exit();
   }

   // Initialize an array to hold error messages
   $response = [];

   // Handle the profile image upload (optional)
   if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] != UPLOAD_ERR_NO_FILE) {
      $file = $_FILES['profile_image'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      // Allowed file extensions and size limit
      $allowed = ['jpg', 'jpeg', 'png'];
      $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      if (!in_array($fileExt, $allowed)) {
         echo "Invalid file type! Only .jpg, .jpeg, and .png are allowed.";
         exit;
      }

      if ($fileSize > 2097152) { // 2MB limit
         echo "File size exceeds 2MB!";
         exit;
      }

      // Save the image
      $newFileName = uniqid('', true) . "." . $fileExt;
      $fileDestination = 'uploads/' . $newFileName;

      if (!move_uploaded_file($fileTmpName, $fileDestination)) {
         echo "Error uploading the file!";
         exit;
      }
   }

   // Hash the password
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   // Check if email or username already exists
   $checkQuery = "SELECT * FROM users WHERE email = ? OR uname = ?";
   $stmt = $conn->prepare($checkQuery);
   $stmt->bind_param("ss", $email, $uname);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      echo "Email or Username already exists!";
   } else {
      // Insert new user into the database
      $insertQuery = "INSERT INTO users (uname, email, password) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($insertQuery);
      $stmt->bind_param("sss", $uname, $email, $hashed_password);
      if ($stmt->execute()) {
         // Redirect to login on successful registration
         header("Location: login.php");
         exit();
      } else {
         echo "Error: " . $conn->error;
      }
   }

   $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Signup - InkFusion</title>
   <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="bootstrap/all.min.css" />
   <link rel="stylesheet" href="style.css" />
   <style>
      /* Registration */
      .signup-container {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 90vh;
         background-color: #f8f9fa;
      }

      .signup-box {
         background-color: white;
         padding: 0;
         border-radius: 15px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         display: flex;
         overflow: hidden;
         height: 700px;
         width: 100%;
         max-width: 900px;
      }

      .signup-image {
         max-width: 50%;
         object-fit: cover;
      }

      .signup-form {
         padding: 2rem;
         flex: 1;
      }
   </style>
</head>

<body>
   <div class="signup-container">
      <div class="signup-box">
         <img src="img/signbnr.jpg" alt="Registration" class="signup-image" />
         <div class="signup-form">
            <center>
               <h2>Create Your Account</h2>
            </center><br>
            <form id="signupForm" method="POST" action="" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="uname">Username</label>
                  <input type="text" name="uname" class="form-control" id="uname" placeholder="Enter username" required />
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required />
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
               </div>
               <div class="form-group">
                  <label for="cpass">Confirm Password</label>
                  <input type="password" name="cpass" class="form-control" id="cpass" placeholder="Confirm password" required />
               </div>
               <div class="form-group">
                  <label for="profile_image">Profile Image (Optional, Only .jpg, .jpeg, .png | Max: 2MB)</label>
                  <input type="file" class="form-control" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png" />
               </div>
               <div class="form-group">
                  <input type="checkbox" id="terms" name="terms" required>
                  <label for="terms">I agree to the <a href="t&s.php" target="_blank">Terms and Conditions</a></label>
               </div>
               <center><button type="button" class="btn btn-primary" onclick="validateForm()">Sign Up</button></center>
               <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
               <p class="text-center mt-3"><a href="index.php">Back To Home</a>.</p>
               <div id="error-message" style="display:none; color: red; text-align: center; margin-bottom: 1rem;"></div>
            </form>
            <script>
               function validateForm() {
                  const password = document.getElementById("password").value;
                  const confirmPassword = document.getElementById("cpass").value;
                  const terms = document.getElementById("terms").checked;
                  // Check if passwords match
                  if (password !== confirmPassword) {
                     alert("Passwords do not match!");
                     return; // Prevent form submission
                  }
                  // Check if terms and conditions checkbox is checked
                  if (!terms) {
                     alert("Fill out All The Fields, Including Please accept the Terms and Conditions As Well.");
                     return; // Prevent form submission
                  }
                  // If everything is valid, submit the form
                  document.getElementById("signupForm").submit();
               }
            </script>
         </div>
      </div>
   </div>
</body>

</html>