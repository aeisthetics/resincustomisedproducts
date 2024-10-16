<?php
include('C:\Users\apurv\resincustomisedproducts\includes\connect.php');
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
        $productkeywords= $row['keywords'];
        $productimage = $row['image'];

        echo " 
        <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-men women_two'>
            <div class='product-card image-zoom-effect link-effect d-flex flex-wrap'>
                <div class='image-holder'>
                    <div class='product-image img-fluid'>
                        <a href=''>
                            <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
                        </a>
                    </div>
                    <div class='cart-concern'>
                        <h3 class='card-title text-uppercase pt-3 text-primary'>
                            <a href='single-product.html' class='text-primary'>$productname</a>
                        </h3>
                        <div class='cart-info'>
                         <a href='single-product.php?productid= $productid'>KNOW MORE</a>

                            
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
            
    $select_query = "SELECT * FROM `products` ";
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
          <a href='single-product.php?productid=$productid' >  <h1 class='product-name'>$productname</h1></a>
           
         <a href='single-product.php?productid=$productid' >  <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'></a>
                 
            <div class='cart-info'>
            
                       
                        <a href='single-product.php?productid=$productid' >KNOW MORE</a>
                            
                        </div>
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
                $productkeywords = $row['keywords'];
                $productimage = $row['image'];

                // Product card inside Bootstrap grid
                echo "
                <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-men m-auto'>
                    <div class='product-card link-effect d-flex flex-wrap'>
                        <div class='product-details'>
                            <h1 class='product-name'>$productname</h1>
                            <a href='single-product.php?productid=<?php echo $productid; ?>'>
                            <img src='./productimages/$productimage' alt='$productname' style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
                     
                            </a>
                            <div class='cart-info'>
                             
                            <a href='single-product.php?productid= $productid'>KNOW MORE</a>
                            

                        </div>
                           
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


// Function to display product details

function viewdetails()
{
    global $con;
    if(isset($_GET['productid'])){
    if(!isset($_GET['categories'])){
        if(!isset($_GET['products'])){
            $productid=$_GET['productid'];
    $select_query = "SELECT * FROM `products` where productid=$productid";
    $result_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_assoc($result_query)) {
        $productid = $row['productid'];
        $productname = $row['productname'];
        $productdescription = isset($row['description']) ? $row['description'] : 'No description available';
        $productprice = isset($row['price']) ? $row['price'] : 'Price not available';
        $productimage = $row['image'];

        echo " <div class='flexslider' style='display: flex; align-items: center;'>
        <ul class='slides' style='flex: 1; margin-right:-166px; margin-left:66px; margin-top:36px; margin-bottom:36px;'>
            <li >
                <div class=''>
                    <img src='./productimages/$productimage' 
                         alt='$productname' 
                         style='width: 100%; height: auto; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease-in-out;'>
                </div>
            </li>
        </ul>

        <div style='flex: 1; padding-left: 10px;'>
            <h3 class='display-2 text-dark text-uppercase'>$productname</h3>
            <p class='product-description'>$productdescription</p>
            <h2 class='product-price'>Price: $productprice /-</h2>
        </div>
         
    </div>
   
   
         <a href='single-product.php?addtocart=$productid' ><button class='btn btn-primary submit' style='width:100%;  font-family: FontAwesome; border-radius: 14px;   font-size: 22px; height:50px;' >ADD TO CART</button></a>

            
    ";
    }
        
}
    }
}
}


//get ip adress function

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  


//cartfunction
function cart()
{
if(isset($_GET['addtocart'])){
    global $con;
    $ip = getIPAddress();  
    $getproductid=$_GET['addtocart'];
    $select_query="select * from `cartdetails` where ipaddress='$ip'and productid=$getproductid";
    $result_query=mysqli_query($con,$select_query);
    $numofrows=mysqli_num_rows($result_query);
    if($numofrows>0){
        echo "<script>alert('this item is present in db')</script>";
        echo "<script>window.open('shop.php','_self')</script>";
    }
    else{
    $insert_query="Insert into `cartdetails` (productid,ipaddress,quantity) values ($getproductid,'$ip',0)";
    $result_query=mysqli_query($con,$insert_query);
    echo "<script>alert('item is added to cart')</script>";
    echo "<script>window.open('shop.php','_self')</script>";
    }
}
}


//function to get cart item no.
function cartitem()
{
    if(isset($_GET['addtocart'])){
        global $con;
        $ip = getIPAddress();  
        $select_query="select * from `cartdetails` where ipaddress='$ip'";
        $result_query=mysqli_query($con,$select_query);
        $countcartitems=mysqli_num_rows($result_query);
    }
        else{
            global $con;
            $ip = getIPAddress();  
            $select_query="select * from `cartdetails` where ipaddress='$ip'";
            $result_query=mysqli_query($con,$select_query);
            $countcartitems=mysqli_num_rows($result_query);
        }
        echo $countcartitems;
    }
    
    //total cart price

    function totalcartprice()
    {
        global $con;
        $ip = getIPAddress(); 
        $total=0; 
       $cart_query="select * from `cartdetails` where ipaddress='$ip'";
       $result=mysqli_query($con,$cart_query);
       while($row=mysqli_fetch_array($result)){
        $productid=$row['productid'];
        $selectproducts="select * from `products` where productid='$productid'";
        $resultproducts=mysqli_query($con,$selectproducts);
        while($rowproductprice=mysqli_fetch_array($resultproducts))
        {
        $productprice=array($rowproductprice['price']);
        $productvalues=array_sum($productprice);
        $total+=$productvalues;
        }

       }
       echo $total;
    }




?>




