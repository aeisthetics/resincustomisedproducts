<?php
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connect.php');

if (isset($_POST['add'])) {
    $productname = $_POST['productname'];

    // Check if product name is empty
    if ($productname == '') {
        echo "<script>alert('FILL ALL FIELDS')</script>";
        exit();
    }

    // Check if a file was uploaded
    if (isset($_FILES['productimage'])) {
        $productimage = $_FILES['productimage']['name'];
        $tmpimage = $_FILES['productimage']['tmp_name'];
        
        // Check for upload errors
        if ($_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
            // Move the uploaded file
            if (move_uploaded_file($tmpimage, "./productimages/$productimage")) {
                // Insert product into the database
                $insert_products = "INSERT INTO categories (productname, image) VALUES ('$productname', '$productimage')";
                $res = mysqli_query($con, $insert_products);
                
                if ($res) {
                    echo "<script>alert('Product inserted')</script>";
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
    <title>Aeisthetics</title>
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
        <h2>Add a new category</h2>
        <form action="" method="post" enctype="multipart/form-data" class="creditly-card-form agileinfo_form">
            <section class="creditly-wrapper wrapper">
                <div class="information-wrapper">
                    <div class="first-row form-group">
                        <div class="controls">
                            <label class="control-label">Product name</label>
                            <input class="billing-address-name form-control" type="text" name="productname" placeholder="Product name" required>
                        </div>
                    </div>
                    <div class="first-row form-group">
                        <div class="controls">
                            <label for="productimage" class="control-label">Product Image</label>
                            <input class="form-control" type="file" name="productimage" required>
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
