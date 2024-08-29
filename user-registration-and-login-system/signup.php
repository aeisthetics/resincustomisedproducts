<?php include ('./conn/conn.php') ?>

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
            <form action="#">

        <!-- Registration Area -->
        <h1>Sign up</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<input type="text" placeholder="Name" />
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<a href="index.html"><button>Sign Up</button></a>
		</form>
	</div>

        <!-- Login Area -->
        
	<div class="overlay-container">
		<div class="overlay">
			
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<a href="signin.php"><button class="ghost" id="signUp">Sign in</button></a>
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

			 <p style="padding-left: 58px; " >aeisthetics          © Copyright 2023. </p>
	  </div>
  </footer>

</body>
</html>