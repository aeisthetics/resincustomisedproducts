<?php
// Include your database connection script
require_once 'paymentprocess.php'; // This should contain your DB connection logic

// Query to fetch payment details from your database

$sql = "SELECT  ip_address, payment_method, order_amount, payment_status from payment";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Payment Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .completed {
            color: green;
            font-weight: bold;
        }

        .pending {
            color: red;
            font-weight: bold;
        }

        .failed {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Payment Details</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>IP address</th>
                    <th>Payment Method</th>
                    <th>Order Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($row['order_amount']); ?></td>
                        <td class="<?php echo strtolower($row['payment_status']); ?>">
                            <?php echo htmlspecialchars($row['payment_status']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No payment records found.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
