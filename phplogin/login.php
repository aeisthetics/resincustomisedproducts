<?php
// Initialize the error messages
$emailError = '';
$passwordError = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values and trim any extra spaces
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate if any field is left empty
    if (empty($email)) {
        $emailError ='Email is required!';
    }
    if (empty($password)) {
        $passwordError ='Password is required!';
    }

    // If no error, proceed with login logic
    if (empty($emailError) && empty($passwordError)) {
        // Add your login authentication logic here
        echo "<script>alert('Login successful!');</script>";
        header("Location: ../index.php");
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
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">    <!-- Form action will point to the same page -->
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <input required  type="email" placeholder="Email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />

            <?php if (!empty($emailError)): ?>
                <div class="error-message" style="color:red;"><?php echo $emailError; ?></div>
            <?php endif; ?>
            
            <input required  type="password" placeholder="Password" id="password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" /><br>
            <?php if (!empty($passwordError)): ?>
                <div class="error-message" style="color:red;"><?php echo $passwordError; ?></div>
            <?php endif; ?>

            <button name="signin" type="submit">Sign In</button>
        </form>
    </div>

    <!-- Registration Area -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <a href="register.php"><button class="ghost" id="signUp">Sign Up</button></a>
            </div>
        </div>
    </div>
</div>

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
