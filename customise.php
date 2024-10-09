<?php
// Database connection
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connect.php');

if (isset($_POST['add'])) {
    $productid = $_POST['productname']; // Holds the selected product's category id
    $productdescription = $_POST['description'];
    $productkeyword = $_POST['keywords'];
    $productprice = $_POST['price'];

    // Check if a file was uploaded
    if (isset($_FILES['productimage'])) {
        $productimage = $_FILES['productimage']['name'];
        $tmpimage = $_FILES['productimage']['tmp_name'];

        // Check for upload errors
        if ($_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($tmpimage, "./productimages/$productimage")) {
                // Insert product into the database
                $add_products = "INSERT INTO products (productname, description,keywords, image, price) VALUES ('$productid', '$productdescription', '$productkeyword','$productimage', '$productprice')";
                $res = mysqli_query($con, $add_products);

                if ($res) {
                    echo "<script>alert('Product inserted successfully')</script>";
                } else {
                    echo "<script>alert('Database error: " . mysqli_error($con) . "')</script>";
                }
            } else {
                echo "<script>alert('Error moving the uploaded file.')</script>";
            }
        } else {
            echo "<script>alert('File upload error: " . $_FILES['productimage']['error'] . "')</script>";
        }
    } else {
        echo "<script>alert('No file uploaded.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aesthetics</title>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16" style="border-radius:700px;">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="js/modernizr.js"></script>
</head>
<body class="bg-body">
    <div class="col-md-8 address_form m-auto" style="padding-left: 20px; padding-top:30px">
        <h2>Add item</h2>
        <form action="" method="post" enctype="multipart/form-data" class="creditly-card-form agileinfo_form">
            <section class="creditly-wrapper wrapper">
                <div class="information-wrapper">
                    <div class="first-row form-group">
                        <div class="controls">
                            <select name="productname" id="" class="form-select">
                                <option value="">Select Product Name</option>
                                <?php
                                    // Fetching categories from the database
                                    $select_query = "SELECT * FROM categories";
                                    $result_query = mysqli_query($con, $select_query);
                                    while($row = mysqli_fetch_assoc($result_query)) {
                                        $productname = $row['productname'];
                                        $productid = $row['productid'];
                                        echo "<option value='$productname'>$productname</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="first-row form-group">
                        <div class="controls">
                            <label class="control-label">Product description</label>
                            <input class="billing-address-name form-control" type="text" name="description" placeholder="Product description" required>
                        </div>
                    </div>
                    <div class="first-row form-group">
                        <div class="controls">
                            <label class="control-label">Product keywords</label>
                            <input class="billing-address-name form-control" type="text" name="keywords" placeholder="Productkeywords" required>
                        </div>
                    </div>
                    <div class="first-row form-group">
                        <div class="controls">
                            <label for="productimage" class="control-label">Product Image</label>
                            <input class="form-control" type="file" name="productimage" required>
                        </div>
                    </div>
                    <div class="first-row form-group">
                        <div class="controls">
                            <label class="control-label">Product price</label>
                            <input class="billing-address-name form-control" type="text" name="price" placeholder="Product price" required>
                        </div>
                    </div>
                    <input type="submit" class="submit check_out p-1 my-3" name="add" value="Add item">
                </div>
            </section>
        </form>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
