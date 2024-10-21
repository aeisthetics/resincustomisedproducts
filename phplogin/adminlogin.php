<?php

// Initialize error messages
$errors = ['email' => '', 'password' => ''];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'aeisthetics');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values and trim extra spaces
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate required fields
    if (empty($email)) {
        $errors['email'] = 'Email is required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format!';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required!';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long!';
    }

    // Check if no errors are present
    if (!array_filter($errors)) {
        // Check if the email exists in the database
        $sql = "SELECT password FROM adminlogin WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email exists, now verify the password
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Verify the entered password with the hashed password in the database
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, proceed to login
                echo "<script>alert('Login successful!');</script>";
                header("Location: ../adminindex.php");  // Redirect to the dashboard or homepage
                exit();
            } else {
                // Password does not match
                $errors['password'] = 'Incorrect password!';
            }
        } else {
            // Email does not exist in the database
            $errors['email'] = 'Email not found. Please register first!';
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aeisthetics</title>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="login.css">
    <script src="js/login.js"></script>
</head>
<body class="bg-body">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="" method="post">  <!-- Form action is set to the current page -->
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>

            <!-- Email Input -->
            <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <div style="color:red; font-size:13px;"><?= $errors['email'] ?></div>

            <!-- Password Input -->
            <input type="password" placeholder="Password" name="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required>
            <div style="color:red;font-size:13px;"><?= $errors['password'] ?></div><br>

            <!-- Submit Button -->
            <button name="signin" type="submit">Sign In</button>
            <!-- Add a "Forgot Password?" link below the Sign In button -->

        </form>
    </div>

    <!-- Registration Area -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <a href="adminregister.php"><button class="ghost">Sign Up</button></a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Js -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/script.js"></script>

<footer id="footer" class="padding-large">
    <p>aeisthetics © Copyright 2023.</p>
</footer>

</body>
</html>
