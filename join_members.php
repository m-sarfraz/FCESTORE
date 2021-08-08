
<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: companylogin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: companylogin.php");
  }
?>
<?php

$sesion3=$_SESSION['type'];
?>
<?php
$sesion=$_SESSION['name'];
?>
<?php

$errors = array(); 

//including the database connection file

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

$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

$sql="SELECT * FROM teabuyers_signup JOIN membership ON teabuyers_signup.user_id = membership.user_id WHERE status=1 AND industry_name='{$_SESSION['name']}'";
$result = mysqli_query($mysqli, $sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<title>Untitled Document</title>
</head>
	
<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic43.jpg");
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
        <a class="nav-link" href="company_map.php">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			 <a class="dropdown-item" href="add_product.php">shop</a>
          <a class="dropdown-item" href="user_product.php        ">Manage products</a>

		
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
        <a class="nav-link" href="company_aboutus.php">Aboutus</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="company_contact.php">Contact</a>
      </li>
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $sesion;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			
          <a class="dropdown-item" href="industry_profile.php">My Account</a>

          <a class="dropdown-item" href="company_seller_homepage.php?logout='1'">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div id="example1">
	<p>Add Products Details</p>

</div>
	 <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>Product List</th>
						        <th>Member Name</th>
						        <th>Email</th>
                    <th>Address</th>
                    <th>Tell no</th>        
                    <th>Details</th>
                    <th>Remove</th>
						      </tr>
						    </thead>
						  <tbody>
 <?php
echo'<div style="color:Black;">';
//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
while($res = mysqli_fetch_array($result)) { 
    echo '<tr class="text-center">';
    $s=$res['image'];
    echo '    <td class="image-prod"><img src="images/'.$s.'" class="block-20" style="width:150px;height:100px;"></td>';				        
    echo '     <td class="product-name">';
    echo '      	<h3>'; echo ""  .$res['member_name']."<br></h3>"; echo '</h3>';
    echo ' </td>';
    echo '<td class="price">'; echo ""  .$res['email']."<br></h3>"; echo ' </td>';
    echo '<td class="price">'; echo ""  .$res['address']."<br></h3>"; echo ' </td>';
    echo '<td class="price">'; echo ""  .$res['phone']."<br></h3>"; echo ' </td>';					        
    echo '  <td class="total">'; echo "<a href=\"industry_profile_view.php?id=$res[member_id]\">View More detalis</a><br>";    echo "</h4></p>"; 
    echo '  <td class="total">'; echo "<a href=\"reject_member.php?id=$res[member_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Remove membership</a>
    </div><br>";    echo "</h4></p>"; 
    echo ' </tr>'; }
?>
            </tbody>
						  </table>
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