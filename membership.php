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

 $sesion=$_SESSION['username'];
?>
//---------------------------------------------------------------------------------------

<?php

$errors = array(); 

$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if(isset($_POST['submit'])) {   
    $cname = mysqli_real_escape_string($mysqli, $_POST['cname']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $iname = mysqli_real_escape_string($mysqli, $_POST['iname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  
      
        $result1 = mysqli_query($mysqli, "SELECT * FROM membership WHERE member_name='$cname' LIMIT 1" );
        $user = mysqli_fetch_assoc($result1);
         if ($user) { // if user exists
          if ($user['member_name'] === $cname) {
            array_push($errors, "Username already exists");
            echo"<script>alert('Your Allreaady Assign In A Company');
            window.location.href='membership.php';</script>";
          }
      
        
        }
        if (count($errors) == 0) {
        // if all the fields are filled (not empty) 
            
        //insert data to database   
        $result = mysqli_query($mysqli, "INSERT INTO membership(user_id,member_name,email,industry_name,confirmation) VALUES('$address','$cname','$email','$iname','Pending')");
    
        header('location: membership.php');}
       
    }

?>
<?php 
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);


$sql='SELECT * FROM company_profile where selling_type="company" ';
$result = mysqli_query($mysqli, $sql);

 $query = "SELECT company_name FROM company_profile where selling_type='company'";
 $result2 = mysqli_query($mysqli, $query);



$options = "";
while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[0]</option>";
}



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="css/tea_industry.css">
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/blog-home.css" rel="stylesheet">
</head>

<body>
	<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic30.jpg");
padding-left: 750px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
	
	
<body>
<div id="example1">
	<p>Get Your Factory Membership</p>

</div>
	    <?php
$sesion=$_SESSION['user_id'];
$sesion1=$_SESSION['username'];
?>
	
	

	<br><br><br>
	<section class="ftco-section ftco-degree-bg bg-light"  >
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
						<div class="row">
						
		          <div class="col-md-12 d-flex ftco-animate">
		            <div class="blog-entry align-self-stretch d-md-flex">
		            
		              <div class="text d-block pl-md-4">
		              	
                      <form action="membership.php" method="post" >
                            <?php include('errors.php'); ?>
					    <h3 class="mb-4 billing-heading">Get Your membership</h3><br>
	          	        <div class="row align-items-end">
	          		        <div class="col-md-12">
	                            <div class="form-group">
                                     <label for="firstname">Username </label>
                                     <b>  <input type="text" class="form-control" style="color: black;" placeholder="" name="cname" value="<?php echo $sesion1;?>"   Readonly>
	                          </b>  </div>
	                        </div>
	                       
                            <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            
	                                    <input type="hidden" class="form-control" name="address"   value="<?php echo $sesion;?>">
	                            </div>
		                    </div>
                            <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            <label for="streetaddress">Email</label>
                                    <input type="text" class="form-control" placeholder="" name="email" value=""  required>
	                            </div>
		                    </div>
		                    <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            <label for="streetaddress"> Industry Name</label>
                                <select name="iname" style="width: 150px;">
                                <?php echo $options;?>
                              </select> </div>
		                    </div>
		                    <div class="w-100"></div>
		                    
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
	          			           
                                        <div class="col-lg-6 mb-5 ftco-animate">
                                            <input type="submit" class="btn btn-primary py-3 px-4" name="submit"  value="Request" style="background-color:#4C8357; border: medium; width: 250px;">
									    </div>
                                </div>
                            </div>
	                    </div>
	                </form>
       
    
		              </div>
		            </div>
		          </div>
						</div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
             
          <div class="sidebar-box" style="padding-left: 100px;">
            <form action="tea_search.php" method="get" >
                <input type="text" placeholder="Search.." name="search">
                  <button type="submit" style="height: 25px;"><i class="fa fa-search"></i></button>
            </form>
			  <br><br><br>
          </div>
            <div class="sidebar-box ftco-animate" style="background-color:#94CBAB; >
            <div class="container">
             <h3 class="heading"> Registered Tea Factories </h3>
             <?php

                    
            echo'<div style="color:Black;">';
            //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
            while($res = mysqli_fetch_array($result)) { 
             echo ""  .$res['company_name']."<br></h3>"; 
            }
            ?>
				</div>
				</div>
			  </div>
			<br>
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