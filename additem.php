<?php
include('C:\xampp\htdocs\aeisthetics\includes\connect.php');
if(isset($_POST['add']))
{
  $productname=$_POST['productname'];

  //accessing image
$productimage=$_POST['productimage']['name'];

//acc img temp name
$tmpimage=$_POST['productimage']['tmp_name'];

//

if($productname=='')
{
  echo"<script>alert('please fill all fields')</script>";
  exit();
}
else{
  move_uploaded_file($tmpimage,"./productimages/$productimage");
}

$insert_products="insert into `categories` (productname,image) values ('$productname','$productimage')";
$result_query=mysqli_query($con,$insert_products);
if($result_query)
{
  echo"<script>alert('successfully category added')</script>";
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
    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
  </head>
  <body class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
  

   

    <div class="search-box position-relative overflow-hidden w-100">
      <div class="search-wrap">
        <div class="close-button position-absolute">
          <svg class="close" width="22" height="22">
            <use xlink:href="#close"></use>
          </svg>
        </div>
        <form id="search-form" class="text-center pt-3" action="" method="">
          <input type="text" class="search-input fs-5 p-4 bg-transparent" placeholder="Search...">
          <svg class="search" width="22" height="22">
            <use xlink:href="#search"></use>
          </svg>
        </form>
      </div>
    </div> 

   
    <div class="col-md-8 address_form m-auto" style="padding-left: 20px; padding-top:30px">
		<h2>Add a new category</h2>
		<form action="" method="post"  entype="multipart/form-data" class="creditly-card-form agileinfo_form">
			<section class="creditly-wrapper wrapper">
				<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
							<label class="control-label">Product name </label>
							<input class="billing-address-name form-control" type="text" name="productname" placeholder="Product name">
						</div>
				
					</div>
					<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
							<label for="productimage" class="control-label"> Product Image </label>
							<input class=" form-control" type="file" name="productimage" id= "productimage" required=""required>
						</div>
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