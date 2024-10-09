<?php
include('C:\xampp\htdocs\aeisthetics\includes\connect.php');
if(isset($_POST['customise']))
{
  $custom=$_POST['custom'];
 

  //select data from database
  $select_query="Select * from customise where custom= '$custom'";

  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows( $result_select);
if($number>0)
{
  echo"<script>alert('this is present in the database')</script>";
}
else{



  $insert_query="Insert into `customise`(custom) values ('$custom')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo"<script>alert('customisation has been added successfully')</script>";
  }
}}
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
		<h2>Add item </h2>
		<form action="" method="post" entype="multipart/form-data" class="creditly-card-form agileinfo_form">
			<section class="creditly-wrapper wrapper">
                <!--title-->
				<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
                   
							<select name="productname" id="" class="form-select">
                                <option value="" >Product name</option>
							<?php
                            $select_query="Select * from`products`";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_assoc($result_query)){
                                $productname=$row['productname'];
                                $productid=$row['productid'];
                                echo "<option value='$productid'>$productname</option>";
                            }
                            ?>
						</div>
                    </div>
				
 <!--product description-->
 <div class="information-wrapper " style="padding-top: 20px;">
					<div class="first-row form-group">
						<div class="controls">
							<label for="description" class="control-label">Product Description </label>
							<input class=" form-control" type="text" name="description" id= "description"placeholder="Enter Product description" autocomplete="off" required=""required>
						</div>
                    </div>
					
				</div>

                 <!--product keyword-->
				<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
							<label for=" keyword" class="control-label">Product keyword </label>
							<input class=" form-control" type="text" name=" keyword" id= " keyword"placeholder="Enter Product  keyword" autocomplete="off" required=""required>
						</div>
                    </div>
					
				</div>

                <!--image-->
				<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
							<label for="productimage" class="control-label"> Product Image </label>
							<input class=" form-control" type="file" name="productimage" id= "productimage" required=""required>
						</div>
                    </div>
					
				</div>

                <!--price-->
				<div class="information-wrapper">
					<div class="first-row form-group">
						<div class="controls">
							<label for="productprice" class="control-label"> Product price </label>
							<input class=" form-control" type="text" name="productprice" id= "productprice" required="required" placeholder="Enter Product price" autocomplete="off">
						</div>
                    </div>
					
				</div>

                <input type="submit" class="submit check_out p-1 my-3" name="insert_product" value="Add item">
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