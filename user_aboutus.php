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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic59.jpg");
padding-left: 890px;
font-size: 52px;	
color:hsla(0,0%,0%,1.00);
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	.
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #2B8B66;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>

	
</style>
</head>

<body>
	<div id="example1">
	<p>About us</p>

</div>
	<br>
	
	
<div class="about-section">
  <h1>About Ceylon Teahouse</h1>
  <p>Main purpose of this system is providing communication system to plantation industry. Incresing the productivity, make good products and Easily day to day works are othe benfits of this system</p>
  <p>In This system user and company can registr. Registered members can sell products, buy products, chat with other users, assign company, post blog, news and new technology, find solution for their questions, find location and computerrized the account details</p>
</div>

	<div style="background-color:thistle;">
		<h1 style="padding-left: 780px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">Our Mission & Vision</h1>
	<table>
		<tr>
		<td>
			<img src="images/teapic85.jpg">
			</td>
			<td style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 18px;">
			Our mission is to provide our customers with the best tasting, all natural, USDA Organic teas for their everyday lives. At Truly Teas, we stay true to our word by always providing the best quality experience, customer service, and tea. <br><br>
				
				Our goal is to provide the best quality tea experience for our customers.  Truly Teas wants to continue the trend of providing healthy beverage options and by combining drinking excellent teas with their daily lifestyle.  We want to change the way people see and think about tea, one cup at a time.
			</td>
			
			
	
		
		</tr>
		
		
		</table>
	
	
	</div>
<div style="background-color: wheat;">
<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="images/teapic86.jpg" alt="Jane" style="width:100%">
      <div class="container">
        <h2>Madura Perera</h2>
        <p class="title">Designer</p>
      
       <a class="btn btn-success" href="contact.php" role="button">Contact</a>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="images/teapic87.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Mahela Salgado</h2>
        <p class="title"> Director</p>
   <a class="btn btn-success" href="contact.php" role="button">Contact</a>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="images/teapic78.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>Kaveesha Lakdinu</h2>
        <p class="title">CEO & Founder</p>
        
<a class="btn btn-success" href="contact.php" role="button">Contact</a>
      </div>
    </div>
  </div>
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