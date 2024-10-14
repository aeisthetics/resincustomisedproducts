<?php
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connect.php');



if (isset($_POST['add'])) {
    // Accessing the correct POST keys based on your form's input names
    $productname = mysqli_real_escape_string($con, $_POST['name']);
    $productdescription = mysqli_real_escape_string($con, $_POST['description']);
    $productkeyword = mysqli_real_escape_string($con, $_POST['keywords']);
    $productprice = mysqli_real_escape_string($con, $_POST['price']);
    $custom1 = mysqli_real_escape_string($con, $_POST['custom1']);
    $custom2 = mysqli_real_escape_string($con, $_POST['custom2']);
    $custom3 = mysqli_real_escape_string($con, $_POST['custom3']);
    $custom4 = mysqli_real_escape_string($con, $_POST['custom4']);
    $custom5 = mysqli_real_escape_string($con, $_POST['custom5']);
    // Check if a file was uploaded
    if (isset($_FILES['productimage']) && $_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
        $productimage = $_FILES['productimage']['name'];
        $tmpimage = $_FILES['productimage']['tmp_name'];

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($tmpimage, "./productimages/$productimage")) {
            // Insert product into the database
            $add_products = "INSERT INTO products (productname, description, keywords, image, price,custom1,custom2,custom3,custom4,custom5) VALUES ('$productname', '$productdescription', '$productkeyword', '$productimage', '$productprice','$custom1','$custom2','$custom3','$custom4','$custom5')";

            if (mysqli_query($con, $add_products)) {
                echo "<script>alert('Product inserted successfully')</script>";
            } else {
                echo "<script>alert('Database error: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Error moving the uploaded file.')</script>";
        }
    } else {
        echo "<script>alert('File upload error: " . ($_FILES['productimage']['error'] ?? 'No file uploaded.') . "')</script>";
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
                            <label class="control-label">Product name</label>
                            <input class="billing-address-name form-control" type="text" name="name" placeholder="Product name" required>
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
                            <input class="billing-address-name form-control" type="text" name="keywords" placeholder="Product keywords" required>
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
                    <div class="first-row form-group">
                        <div class="controls">
                            <label class="control-label">Customization options</label>
                            <input class="billing-address-name form-control" type="text" name="custom1" placeholder="Customization option 1" required>
                            <input class="billing-address-name form-control" type="text" name="custom2" placeholder="Customization option 2">
                            <input class="billing-address-name form-control" type="text" name="custom3" placeholder="Customization option 3" >
                            <input class="billing-address-name form-control" type="text" name="custom4" placeholder="Customization option 4" >
                            <input class="billing-address-name form-control" type="text" name="custom5" placeholder="Customization option 5">
                           
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
