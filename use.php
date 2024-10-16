<?php
$ip = getIPAddress();  // Fetch the IP address of the user
$total = 0;  // Initialize the total cost of the cart

// Fetch cart details for the specific user based on IP address
$cart_query = "SELECT * FROM `cartdetails` WHERE ipaddress='$ip'";
$result = mysqli_query($con, $cart_query);
$result_count = mysqli_num_rows($result);

// Loop through the cart items
while ($row = mysqli_fetch_array($result)) {
    $productid = $row['productid'];
    $quantity = $row['quantity'];
    // Assuming quantity1 is not needed for the total calculation

    // Fetch product details for each product in the cart
    $selectproducts = "SELECT * FROM `products` WHERE productid='$productid'";
    $resultproducts = mysqli_query($con, $selectproducts);

    while ($rowproductprice = mysqli_fetch_array($resultproducts)) {
        $productprice = $rowproductprice['price'];
        // Assuming you might want to use these values later
        $producttitle = $rowproductprice['productname'];
        $productimage = $rowproductprice['image'];

        // Calculate the total price of the cart
        $total += $productprice * $quantity;
    }
}

// Display the total price
echo "<div class='form-group'>
        <p style='font-family:Cinzel, sans-serif; font-size: 27px;'>total amount: <strong>{$total}/-</strong></p>
      </div>";
?>