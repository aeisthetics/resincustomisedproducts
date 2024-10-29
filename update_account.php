<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: /phplogin/login.php');
    exit();
}

$email = $_SESSION['email'];
$conn = new mysqli('localhost', 'root', '', 'aeisthetics');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $new_address = $_POST['new_address'];
    $new_phone = $_POST['new_phone'];

    // Update password
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_password = $conn->prepare("UPDATE login SET password = ? WHERE email = ?");
        $update_password->bind_param("ss", $hashed_password, $email);
        $update_password->execute();
        $update_password->close();
    }

    // Update address and phone
    $update_payment = $conn->prepare("UPDATE contact SET address = ?, phone = ? WHERE email = ?");
    $update_payment->bind_param("sss", $new_address, $new_phone, $email);
    $update_payment->execute();
    $update_payment->close();
    
    header('Location: my_account.php');
    exit();
}
?>
