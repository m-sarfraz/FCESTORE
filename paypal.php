<?php include("header.php") ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
      header('location: teabuyers_login.php');
      
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: teabuyers_login.php");
  }
?>

<?php
// including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
include_once 'config2.php'; 

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name=$_POST['name'];
    $age=$_POST['age'];
 
    // checking empty fields
    if(empty($name) || empty($age) ) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
               
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE shop SET name='$name',post='$age' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: shop.php");
    }
}
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
    
    $name=$_POST['lt'];
    $age=$_POST['lg'];
    
    // checking empty fields
    if(empty($name) || empty($age)) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
               
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE biling SET lat='$name',lng='$age' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: shop.php");
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body style="background-color:whitesmoke;">
	<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic51.jpg");
padding-left: 750px;
font-size: 62px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}

.pagination a {
  color:#FF1418;
  float: left;
  padding: 8px 16px;
  text-decoration: none;

}
	
</style>
	<div id="example1">
	<p>Buy You Products</p>

</div><br><br>
			
	<?php
$sesion=$_SESSION['username'];
?>
 
   
		  <?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM shop WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
	$id=$res['id'];
    $name = $res['product_type'];
    $type = $res['product_name'];
    $price = $res['price'];
    $dis = $res['discription'];
    $seller = $res['seller_name'];
    $tell = $res['tell'];
    $adress = $res['adress'];
	$id = $res['id'];
	$disc=$res['discount'];
  $dilivery=$res['diliverry'];
  $avalability=$res['quantity'];
	$newprice = $price-$disc+$dilivery;
}
?>
	
          <div class="col-md-6 d-flex">
          
                   
          <?php 
if(isset($_POST['cal'])){
    $a=mysqli_real_escape_string($mysqli, $_POST['qunty']);
    $b=mysqli_real_escape_string($mysqli, $_POST['price']);
    $c=$a*$b;
    if($avalability<=$a){
      
      echo"<script>alert('Sory.! Your selected quantity not available right now. Please check the avalability.');
      window.location.href='product-single.php?id=$id';</script>";
       }
}?>
			  

                	<form action="paypalinsert.php?id=<?php echo $id; ?>" method="post" style="padding-left: 300px; width: 100%" >
							<h3 class="mb-4 billing-heading" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Billing Details</h3>
							<input type="hidden" class="form-control" color="black" placeholder="" name="id" value="<?php echo $id;?>" readonly>
	          	<div class="row align-items-end" style="width: 1200px;">
	          		<div class="col-md-6">
	                <div class="form-group">
                        <label for="firstname" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Firt Name</label>
                        
	                  <input type="text" class="form-control" color="black" placeholder="" name="fname" value="<?php echo $sesion;?>" readonly>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Last Name</label>
	                  <input type="text" class="form-control" placeholder="" name="lname" required >
	                </div>
                </div>
				<div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'"> Product Name</label>
	                  <input type="text" class="form-control" name="proname"   value="<?php echo $name;?>" readonly required>
	                </div>
		            </div>
                <div class="w-100"></div>
				<div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Product Type</label>
	                  <input type="text" class="form-control" name="pname"  value="<?php echo $type;?>" readonlyrequired>
                    </div>
                    </div>
                    <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Date</label>
	                  <input type="date" style="color:black;"class="form-control" name="date">
	                </div>
		            </div>
                    <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Seller Name</label>
	                  <input type="text" class="form-control" placeholder="" name="seller"required  value="<?php echo $seller;?>" readonly>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'"> Address</label>
	                  <input type="text" class="form-control" name="address" placeholder="Address of the customer" required>
	                </div>
		            </div>
                    <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Quntitty</label>
	                  <input type="text" class="form-control" name="qunty" value="<?php echo $a;?>"required>
                    </div>
                    </div>
                    <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Final Amount</label>
	                  <input type="text" style="color:black;"class="form-control" name="price"  placeholder=""required value="<?php echo $c;?>"  readonly>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Town / City</label>
	                  <input type="text" class="form-control"name="city" required placeholder="">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Postcode / ZIP *</label>
	                  <input type="text" class="form-control"name="pcode"  placeholder=""required>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Phone</label>
	                  <input type="text" class="form-control" name="tell"required placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress"style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Email Address</label>
	                  <input type="text" class="form-control" name="email" required placeholder="">
	                </div>
				</div>
				<div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id;?> "readonly>
                    <input type="hidden" class="form-control" name="pay" value="Done"readonly>
	                </div>
		            </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                <div class="cart-detail p-3 p-md-4">
	          			
                          <div class="col-lg-6 mb-5 ftco-animate" >
                    <input type="submit" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'" class="btn btn-success py-3 px-4" name="submit"  value="Place an order">
									
									</div></div>
                </div>
	            </div>
	          </form><!-- END -->
			 

            
          </div>
        
      </div>
     
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