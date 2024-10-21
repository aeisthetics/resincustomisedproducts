<?php

// Initialize error messages
$errors = ['name' => '', 'email' => '', 'password' => ''];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'aeisthetics');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values and trim extra spaces
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate required fields
    if (empty($name)) {
        $errors['name'] = 'Name is required!';
    }
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
        // Check if email already exists
        $emailCheckQuery = "SELECT email FROM login WHERE email = ?";
        $stmt = $conn->prepare($emailCheckQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists. Please use a different email.');</script>";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO login (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Failed to register user. Please try again.');</script>";
            }
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
            <h1>Sign Up</h1>
          

            <!-- Name Input -->
            <input type="text" placeholder="Name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            <div style="color:red;"><?= $errors['name'] ?></div>

            <!-- Email Input -->
            <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <div style="color:red;"><?= $errors['email'] ?></div>

            <!-- Password Input -->
            <input type="password" placeholder="Password" name="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required>
            <div style="color:red;"><?= $errors['password'] ?></div>

            <!-- Submit Button -->
            <button name="signup" type="submit">Sign Up</button>
        </form>
    </div>

    <!-- Login Area -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <a href="login.php"><button class="ghost">Sign In</button></a>
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
