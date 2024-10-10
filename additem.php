<?php
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connect.php');

if (isset($_POST['add'])) {
    $productname = $_POST['productname'];
    $productkeywords = $_POST['keywords'];

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
                // Corrected SQL query
                $insert_products = "INSERT INTO categories (productname, keywords, image) VALUES ('$productname', '$productkeywords', '$productimage')";
                
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
