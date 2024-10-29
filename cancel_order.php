<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
$user_email = $_SESSION['user_email'];

$conn = new mysqli('localhost', 'root', '', 'aeisthetics');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if productid is passed
if (isset($_GET['productid'])) {
    $productid = urldecode($_GET['productid']);

    // Delete the product from the user's cart (cancel order)
    $cancel_sql = "DELETE FROM cartdetails WHERE productid = ? AND ipaddress = ?";
    $stmt = $conn->prepare($cancel_sql);
    $user_ip = $_SERVER['REMOTE_ADDR'];  // Use the user's IP address or user ID
    $stmt->bind_param("is", $productid, $user_ip);
    
    if ($stmt->execute()) {
        echo "Order cancelled successfully!";
        header("Location: my_account.php");  // Redirect back to account page after cancellation
        exit();
    } else {
        echo "Error cancelling order!";
    }

    $stmt->close();
} else {
    echo "No product selected to cancel.";
}

$conn->close();
?>
