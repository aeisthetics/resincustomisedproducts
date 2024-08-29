<?php
include ('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT `password` FROM `tbl_user` WHERE `email` = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            echo "
            <script>
                alert('Login Successfully!');
                window.location.href = 'http://localhost/user-registration-and-login-system/home.php';
            </script>
            "; 
        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = 'http://localhost/user-registration-and-login-system/login.php';
            </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Login Failed, User Not Found!');
                window.location.href = 'http://localhost/user-registration-and-login-system/login.php';
            </script>
            ";
    }
}

?>