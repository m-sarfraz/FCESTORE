<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: company_seller_login.php');
  }
  if (isset($_GET['logoutnew'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: company_seller_login.php");
  }
?>
<?php
$sesion=$_SESSION['name'];
?>
   <?php
$sesion12=$_SESSION['id'];
?>
			  <?php $id = $_GET['id'];
 $databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 //selecting data associated with this particular id
 $result1 = mysqli_query($mysqli, "SELECT * FROM shop WHERE id=$id");
  
 while($res = mysqli_fetch_array($result1))
 {
     $name = $res['product_name'];
     $type = $res['product_type'];
     $price = $res['price'];
     $dis = $res['discription'];
     $seller = $res['seller_name'];
     $tell = $res['tell'];
     $adress = $res['adress'];
     $qun =$res['quantity'];
     $disc= $res['discount'];
     $warenty = $res['warranty_period'];
     $dilivery = $res['diliverry'];
 }?>
 <?php

$sesion3=$_SESSION['type'];
?>
<?php
// including the database connection file
 $databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name = $_POST['product_name'];
    $type = $_POST['product_type'];
    $price = $_POST['price'];
    $dis = $_POST['discription'];
    $image = $_POST['image'];
    $tell = $_POST['tell'];
    $adress = $_POST['adress'];
    $qun =$_POST['quantity'];
    $disc= $_POST['discount'];
    $warenty = $_POST['warranty_period'];
    $dilivery = $_POST['diliverry'];
    
    // checking empty fields
    if(empty($tell) || empty($qun)) {            
        if(empty($tell)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($qun)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
               
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE shop SET diliverry='$dilivery',warranty_period='$warenty',discount='$disc',quantity='$qun',adress='$adress',tell='$tell',image='$image',product_name='$name',product_type='$type',price='$price' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: user_product.php");
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="css/company_seller_homepage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:17px;">
  <img src="images/logocelonhousetwo.jpg"  style="height:130px; width:150px;"/>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" id="div1" style="height:100px;">
    <ul class="navbar-nav">
  
      <li class="nav-item" style="padding-left:400px;">
        <a class="nav-link" href="company_seller_homepage.php">CompanyHome <span class="sr-only">(current)</span></a>
      </li> 
		<li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">News</a>
      </li>
      <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="company_map.php">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			 <a class="dropdown-item" href="shop.php">shop</a>
          <a class="dropdown-item" href="">Manage products</a>
		 <a class="dropdown-item" href="">Customers</a>
		
        </div>
      </li>
		 <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Members
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="membership_approve.php">Request</a>
		 <a class="dropdown-item" href="join_members.php">Customers</a>
		
        </div>
      </li>
    
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Aboutus</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $sesion;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			
          <a class="dropdown-item" href="industry_profile.php">My Account</a>
          <a class="dropdown-item" href="#">Monthly Sales</a>
          <a class="dropdown-item" href="#">Assign Company</a>
            <a class="dropdown-item" href="#">Chat Box</a>
          <a class="dropdown-item" href="company_seller_homepage.php?logout='1'">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
	
	<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic60.jpg");
padding-left: 730px;
font-size: 52px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	.pagination {
  display: inline-block;
}
		.pagination a {
  color:#FF1418;
  float: left;
  padding: 8px 16px;
  text-decoration: none;

}


	
</style>
</head>


	<div id="example1">
	<p>Update products</p>

</div>

	
	<section class="ftco-section "  style="background-image: url('images/teapic27.jpg'); background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover; ">
    	<div class="container">
    		<div class="row">
    
    
<div class="col-lg-4 mb-8 ftco-animate">
   
    
    		</div>';
    	<div class="col-lg-12 product-details pl-md-2 ftco-animate">
              


 <div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Update product</h4>
          <p class="card-category">You Can update your products details</p>
        </div>
        <div class="card-body">
          <form action="update_seller.php" method="post" style="background-color:beige">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating"> Product Name</label>
                  <input type="text" name="product_name" class="form-control" value="<?php echo $name;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Type</label>
                  <input type="text" name="product_type" class="form-control"value="<?php echo $type;?>">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Address</label>
                  <input type="text" name="adress" class="form-control"value="<?php echo $adress;?>"> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating"> tell</label>
                  <input type="text" name="tell" class="form-control"value="<?php echo $tell;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">quantity</label>
                  <input type="text" name="quantity" class="form-control"value="<?php echo $qun;?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating"> price</label>
                  <input type="text" name="price" class="form-control"value="<?php echo $price;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">warrenty_period</label>
                  <input type="text" name="warranty_period" class="form-control"value="<?php echo $warenty;?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating"> dillivery free</label>
                  <input type="text" name="diliverry" class="form-control"value="<?php echo $dilivery;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">discount free</label>
                  <input type="text" name="discount" class="form-control"value="<?php echo $disc;?>">
                </div>
              </div>
            </div>
            
                  <label class="bmd-label-floating">Image</label>
                  <input type="file" name="image" accept="/image/*" require/>
                
            <br><br>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
            <input type="submit" name="update"  class=" btn btn-success py-3 px-4" value="Update">
         
         
          </form>
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>
</div>
    		</div>
    	</div>

       
    </section>
	
	<!-- Footer -->
<footer class="page-footer font-small unique-color-dark" style="background-color:#FFF;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content --><br />
        <h6 class="text-uppercase font-weight-bold">Ceylon Teahouse</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Main purpose of this system is providing communication system to plantation industry. Incresing the productivity, make good products and Easily day to day works are othe benfits of this system</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
<br />
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Products</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">TEA PLANTS</a>
        </p>
        <p>
          <a href="#!">TEA EQUIPMENTS</a>
        </p>
        <p>
          <a href="#!">TEA FERTILIZERS</a>
        </p>
        <p>
          <a href="#!">TEA BAGS</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links --><br />
        <h6 class="text-uppercase font-weight-bold">Useful links</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">Your Account</a>
        </p>
        <p>
          <a href="#!">Become an Affiliate</a>
        </p>
        <p>
          <a href="#!">Shipping Rates</a>
        </p>
        <p>
          <a href="#!">Help</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links --><br />
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> SRI LANKA, KELANIYA</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> CEYLONTEAHOUSE99@gmail.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
        <p>
          <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <li style="padding-left:680px;"><img src="images/payment-footer-update.png"; /></li>
 
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> ceylonteahouse99@gmail.com</a>
  </div>
  <!-- Copyright -->

</footer>
</body>
</html>