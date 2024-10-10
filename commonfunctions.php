<?php
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connect.php');

// Function to get and display products
function getproducts()
{
    global $con;
    if(!isset($_GET['categories'])){
        if(!isset($_GET['products'])){
            
    $select_query = "SELECT * FROM `categories`";
    $result_query = mysqli_query($con, $select_query);
    
    while ($row = mysqli_fetch_assoc($result_query)) {
        $productid = $row['productid'];
        $productname = $row['productname'];
        $productimage = $row['image'];

        echo " 
        <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-men women_two'>
            <div class='product-card image-zoom-effect link-effect d-flex flex-wrap'>
                <div class='image-holder'>
                    <div class='product-image img-fluid'>
                        <a href='single-product.php'>
                            <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
                        </a>
                    </div>
                    <div class='cart-concern'>
                        <h3 class='card-title text-uppercase pt-3 text-primary'>
                            <a href='single-product.html' class='text-primary'>$productname</a>
                        </h3>
                        <div class='cart-info'>
                            <a><span>KNOW MORE</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    
}
}
}

// Function to get and display product details
function getdetails()
{
    global $con;
    if(!isset($_GET['categories'])){
        if(!isset($_GET['products'])){
            
    $select_query = "SELECT * FROM `products`";
    $result_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_assoc($result_query)) {
        $productid = $row['productid'];
        $productname = $row['productname'];
        $productdescription = isset($row['description']) ? $row['description'] : 'No description available';
        $productprice = isset($row['price']) ? $row['price'] : 'Price not available';
        $productimage = $row['image'];

        echo "   <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-men women_two'>
            <div class='product-card  link-effect d-flex flex-wrap'>
        <div class='product-details'>
            <h1 class='product-name'>$productname</h1>
           
          <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
            <p class='product-description'>$productdescription</p>
            <h2 class='product-price'>Price: $$productprice</h2>
            <a href='add=$productid' class='btn btn-success'>Add to Cart</a>
        </div>
        </div>
        </div>";
    }
        
}
    }
}

//searching products

// Searching products
function searchproducts()
{
    global $con;
    
    if (isset($_GET['searchdataproduct'])) {
        $searchdatavalue = $_GET['searchdata'];
        $search_query = "SELECT * FROM `products` WHERE keywords LIKE '%$searchdatavalue%'";
        $result_query = mysqli_query($con, $search_query);

        // Begin row div for Bootstrap grid system
        echo "<div class='row'>";

        if (mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $productid = $row['productid'];
                $productname = $row['productname'];
                $productdescription = isset($row['description']) ? $row['description'] : 'No description available';
                $productprice = isset($row['price']) ? $row['price'] : 'Price not available';
                $productimage = $row['image'];

                // Product card inside Bootstrap grid
                echo "
                <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-men m-auto'>
                    <div class='product-card link-effect d-flex flex-wrap'>
                        <div class='product-details'>
                            <h1 class='product-name'>$productname</h1>
                            <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
                            <p class='product-description'>$productdescription</p>
                            <h2 class='product-price'>Price: $$productprice</h2>
                            <a href='add=$productid' class='btn btn-success'>Add to Cart</a>
                        </div>
                    </div>
                </div>";
            }
        } else {
            // If no products found, show a message
            echo "<div class='col-12'><p>No products found matching your search criteria.</p></div>";
        }

        // End row div
        echo "</div>";
    }
}

?>
