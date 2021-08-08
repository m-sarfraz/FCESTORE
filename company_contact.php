<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: company_seller_login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: company_seller_login.php");
  }
?>
<?php
$sesion=$_SESSION['name'];
$sesion2=$_SESSION['type'];

?>
<?php
//including the database connection file
 
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

?>

<?php
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$to="ceylonteahouse99@gmail.com";
$subject="";
$msg="";
$uemail="";
if(isset($_POST['submit'])){
	
	
try{
	$mail = new PHPMailer(true);
	
	 //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'ceylonteahouse99@gmail.com';                     
    $mail->Password   = 'ceylontea123';                               
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587; 
	$mail->Mailer     ='smtp'; 
	
	//-------------------------------------                                 
	
	
	$subject = $_POST['sub'];
	$msg = $_POST['mazg'];
	$uemail= $_POST['email'];
	
	
	
	 //Recipients
    $mail->setFrom('ceylonteahouse99@gmail.com');
    $mail->addAddress($to);    
      /*  $mail->addAddress('ellen@example.com');               
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/
	
	// Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = "Cus Email : ".$uemail."<br>"."Cus Message : ".$msg;
	
   $mail->send();
   echo 'We Received Your Message!';
	
	}catch(Exception $ex){
		echo "Error :" . $mail->ErrorInfo;
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
        <a class="nav-link" href="company_map.php">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			 <a class="dropdown-item" href="add_product.php">shop</a>
          <a class="dropdown-item" href="user_product.php">Manage products</a>
		 <a class="dropdown-item" href="">Customers</a>
		
        </div>
      </li>
		 <?php if($sesion2!=="Individual") { echo'
		 <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Members
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="membership_approve.php">Request</a>
		 <a class="dropdown-item" href="join_members.php">Customers</a>
		
        </div>
      </li>
';}?>
    
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
			
<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic48.jpg");
padding-left: 750px;
font-size: 62px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
	<div id="example1">
	<p>Contact Us</p>

</div>
		<div class="row d-flex mb-5 contact-info">
        
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span>NO 55/10, Kelaniya</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://1234567920">+94 077 770 2569</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:info@yoursite.com">ceylonteahouse99@gmail.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="#">ceylonteahouse.com</a></p>
	          </div>
          </div>
        </div>
	
	
	    <div style="padding-left: 500px; width: 1400px; ">
            <form action="contact.php" class="bg-white p-5 contact-form" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="sub" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea  id="" cols="30" rows="7" name="mazg" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message"name="submit" class="btn btn-success py-3 px-5">
              </div>
            </form>
          
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