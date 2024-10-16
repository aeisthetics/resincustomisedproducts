<?php
// Enable error reporting for debugging (Remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the MySQL database
$host = 'localhost';
$user = 'root'; // Update with your MySQL username
$pass = ''; // Update with your MySQL password
$dbname = 'aeisthetics';

// Create a connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $order_amount = filter_var($_POST['order_amount'], FILTER_VALIDATE_FLOAT);
    $payment_method = htmlspecialchars($_POST['payment_method'], ENT_QUOTES, 'UTF-8');

    if ($order_amount === false) {
        echo "<p>Error: Invalid order amount.</p>";
        exit;
    }

    // Prepare default values for optional fields
    $bank_name = $card_number = $exp_date = $upi_id = NULL;
    $errors = [];

    // Process based on selected payment method
    switch ($payment_method) {
        case 'cod':
            $payment_status = 'pending'; // Payment is done upon delivery
            break;

        case 'net_banking':
            $bank_name = htmlspecialchars($_POST['bank_name'] ?? '', ENT_QUOTES, 'UTF-8');
            if (empty($bank_name)) {
                $errors[] = "Bank name is required for Net Banking.";
            }
            $payment_status = 'completed';
            break;

        case 'card':
            $card_number = htmlspecialchars($_POST['card_number'] ?? '', ENT_QUOTES, 'UTF-8');
            $exp_date = htmlspecialchars($_POST['exp_date'] ?? '', ENT_QUOTES, 'UTF-8');
            if (empty($card_number) || empty($exp_date)) {
                $errors[] = "Card number and expiry date are required for Card payment.";
            }
            $payment_status = 'completed';
            break;

        case 'upi':
            $upi_id = htmlspecialchars($_POST['upi_id'] ?? '', ENT_QUOTES, 'UTF-8');
            if (empty($upi_id)) {
                $errors[] = "UPI ID is required for UPI payment.";
            }
            $payment_status = 'completed';
            break;

        default:
            $errors[] = "Invalid payment method selected.";
    }

    // If there are errors, display them and exit
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        exit;
    }

    // Encrypt card number if needed (for demonstration purposes only, use a secure method in production)
    if (!empty($card_number)) {
        $card_number = password_hash($card_number, PASSWORD_DEFAULT);
    }

    // Insert the payment data into the database
    $stmt = $conn->prepare("INSERT INTO adminpayment (payment_method, bank_name, card_number, exp_date, upi_id, order_amount, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssds", $payment_method, $bank_name, $card_number, $exp_date, $upi_id, $order_amount, $payment_status);

    // Execute and check for success
    if ($stmt->execute()) {
        header("Location: adminindex.php");
        
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} 



