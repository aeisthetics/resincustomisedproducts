<?php
include('./includes/connect.php');
include('./commonfunctions.php');

// Create 'uploads' directory if it doesn't exist
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- //custom-theme -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/shop.css" type="text/css" media="screen" property="" />
    <link href="css/style7.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <title>Aeisthetics</title>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16" style="border-radius:700px;">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="js/modernizr.js"></script>
</head>
<body class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">

<div class="product-swiper col-md-12">
    <table class='table'>
        <thead>
            <tr style='padding-right: 30px;'>
                <th></th>
                <th>CUSTOMER ID</th>
                <th>PRODUCT ID</th>
                <th>QUANTITY</th>
                <th>CUSTOMISE</th>
                <th>REFERENCE IMAGE</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_GET['userid'])) {
            $userid = $_GET['userid'];
            echo $userid;
        }

        $ip = getIPAddress();
        $total = 0;
        $cart_query_price = "SELECT * FROM `cartdetails` WHERE ipaddress='$ip'";
        $result = mysqli_query($con, $cart_query_price);
        $invoice = mt_rand();
        $status = 'pending';
        $count = mysqli_num_rows($result);
        
        $customization_details = []; // Array to hold customization details
        $product_images = []; // Array to hold product images paths
        $quantity_details = []; // Initialize as array for quantities
        
        while ($rowprice = mysqli_fetch_array($result)) {
            $productid = $rowprice['productid'];
            $select_query = "SELECT * FROM `products` WHERE productid=$productid";
            $resultprice = mysqli_query($con, $select_query);
            
            while ($row_product_price = mysqli_fetch_array($resultprice)) {
                $productprice = $row_product_price['price'];
                $ipaddress=$rowprice['ipaddress']; 
                $qty = $rowprice['quantity']; 
                $qty1 = $rowprice['quantity1'];  // Get quantity1 (customization details)
                $product_image = $rowprice['productimage'];  // Assuming 'image' is the column name for product images

                // File handling: Store image in uploads folder
                if (!empty($product_image)) {
                    $new_image_path = 'uploads/' . basename($product_image);
                    // Move the image to the uploads directory
                    if (!file_exists($new_image_path)) { // Check if the file already exists
                        copy($product_image, $new_image_path); // Copy the file
                    }
                   
                    $product_images[] = "Product ID: $productid - Image: " . basename($new_image_path);

                }

                // Calculate total price for this product
                $total += $productprice;  // Assuming a single product's price, can be adjusted as needed
                if (!empty($qty1)) {
                    $customization_details[] = "Product ID: $productid - Customization: $qty1";  // Store customizations
                }
                if (!empty($qty)) {
                    $quantity_details[] = "Product ID: $productid - quantity: $qty";  // Store quantities
                }
            }
        }

        // Check if there are items in the cart
        if ($count == 0) {
            $subtotal = 0;
        } else {
            $subtotal = $total*$qty; // Total cost for the order
        }

        // Convert arrays to strings only if they have items
        $customization_string = !empty($customization_details) ? implode("; ", $customization_details) : '';
        $qty_string = !empty($quantity_details) ? implode("; ", $quantity_details) : '';
        $images_string = !empty($product_images) ? implode("; ", $product_images) : '';

        // Inserting the order details into userorders
        $insertorders = "INSERT INTO `userorders` (ipaddress,amount, invoice, totalproducts, orderdate, orderstatus, customization_details, product_images, quantity) 
                         VALUES ('$ipaddress',$subtotal, $invoice, $count, NOW(), '$status', '$customization_string', '$images_string', '$qty_string')";
        $resultquery = mysqli_query($con, $insertorders);

        if ($resultquery) {
            echo "<script>alert('Orders are submitted successfully')</script>";
            echo "<script>window.open('paymentsuccess.html', '_self')</script>";
        }

        // Deleting items from cart
        $emptycart = "DELETE FROM `cartdetails` WHERE ipaddress='$ip'";
        $resultdelete = mysqli_query($con, $emptycart);
        ?>
        </tbody>
    </table>
</div>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
