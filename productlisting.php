<?php
include('includes/connect.php'); // Database connection

// Fetch products
$query = "SELECT * FROM products"; // Adjust to your database structure
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Product Listing</title>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text">$<?php echo $row['price']; ?></p>
                        <!-- Link to the product details page, passing the product's ID in the URL -->
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
