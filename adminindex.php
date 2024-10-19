


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

    <header id="header" class="site-header text-black">
      <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
          <a class="" href="index.html">
            <img src="img/logo1.jpg" style="height: 45px; width: 45px; border-radius: 58px; float: left;">
            <h1 style="font-family: Poppins, sans-serif;font-weight:bolder;font-size: 40px; padding-left: 2px; float: left;">aeisthetics</h1>
          </a>
          <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="navbar-icon" width="50" height="50">
              <use xlink:href="#navbar-icon"></use>
            </svg>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
            <div class="offcanvas-header px-4 pb-0">
              <a class="navbar-brand" href="index.html">
                <img src="img/logo2.jpg" style="height: 47px;width: 47px;border-radius: 50px; float: left;" class="logo" >
                <h1 style="font-family: Poppins, sans-serif;font-weight:bolder; padding-left: 2px;">aeisthetics</h1>
              </a>
              <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
            </div>
          
          </div>
        </div>
      </nav>    
    </header>
    <section  class="product-store position-relative ">
      <div class="container-fluid">
        <div id="featured-products" class="row" style="padding-left: 20px;" >
        <h1 style="font-family: Cinzel, sans-serif;">ADMIN PANEL</h1> 
          <div class="display-header pb-3 d-flex justify-content-between flex-wrap col-md-12">
          
           
            
             </div>
        </div>
         <div class="" style="padding-left:20px" >
       
       <button style="font-family: Cinzel, sans-serif;"><a href="adminindex.php?customise">ADD ITEM</a></button>
       <button style="font-family: Cinzel, sans-serif;"><a href="adminindex.php?viewdetails">VIEW ITEM</a></button>
       <button style="font-family: Cinzel, sans-serif;"><a href="adminindex.php?allorder">ALL ORDERS</a></button>
       <button style="font-family: Cinzel, sans-serif;"><a href="adminindex.php?payment">ALL PAYMENTS</a></button>
       <button style="font-family: Cinzel, sans-serif;"><a href="adminindex.php?users">LIST USERS</a></button>
       <button style="font-family: Cinzel, sans-serif;"><a href="">LOG OUT</a></button>
        </div>
      </div>      
    </section>

   <div class="container">
    <?php
    
    if(isset($_GET['customise'])){
      include('customise.php');
    }
  
    if(isset($_GET['viewdetails'])){
      include('display.php');
      
    }
    if(isset($_GET['allorder'])){
      include('allorders.php');
      
    }
    if(isset($_GET['users'])){
      include('users.php');
      
    }
    if(isset($_GET['payment'])){
      include('allpayments.php');
      
    }
    
    ?>
   </div>
   
   

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>