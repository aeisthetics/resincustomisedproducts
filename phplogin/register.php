<?php
// Initialize error messages
$nameError = '';
$emailError = '';
$passwordError = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values and trim any extra spaces
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate if any field is left empty
    if (empty($name)) {
        $nameError = 'Name is required!';
    }
    if (empty($email)) {
        $emailError = 'Email is required!';
    }
    if (empty($password)) {
        $passwordError = 'Password is required!';
    }

    // If no errors, proceed with registration logic
    if (empty($nameError) && empty($emailError) && empty($passwordError)) {
        // Add your registration logic here (e.g., saving to a database)
        echo "<script>alert('Registration successful!');</script>";
        header("Location: ../index.html");
        exit(); // Ensure no further code is executed after redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aeisthetics</title>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16" style="border-radius:700px;">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="js/login.js"></script>   
</head>
<body class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="" method="post"> <!-- Action set to the same page for processing -->
            <h1>Sign up</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <input type="text" placeholder="Name" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" /><br>
            <?php if (!empty($nameError)): ?>
                <div class="error-message" style="color:red;"><?php echo $nameError; ?></div>
            <?php endif; ?>
            <input type="email" placeholder="Email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" /><br>
            <?php if (!empty($emailError)): ?>
                <div class="error-message" style="color:red;"><?php echo $emailError; ?></div>
            <?php endif; ?>
            <input type="password" placeholder="Password" id="password" name="password" />
            <?php if (!empty($passwordError)): ?>
                <div class="error-message" style="color:red;"><?php echo $passwordError; ?></div>
            <?php endif; ?>
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <!-- Login Area -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <a href="login.php"><button class="ghost" id="signIn">Sign in</button></a>
            </div>
        </div>
    </div>
</div>

<script>
    // Constant variables
    const loginForm = document.getElementById('loginForm');
    const registrationForm = document.getElementById('registrationForm');

    // Hide registration form
    registrationForm.style.display = "none";

    function showRegistrationForm() {
        registrationForm.style.display = "";
        loginForm.style.display = "none";
    }

    function showLoginForm() {
        registrationForm.style.display = "none";
        loginForm.style.display = "";
    }
</script>

<!-- Bootstrap Js -->
<script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<footer id="footer" class="overflow-hidden padding-large">
    <div style="margin-left: -4%;">
        <p style="padding-left: 58px;">aeisthetics © Copyright 2023.</p>
    </div>
</footer>

</body>
</html>
