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
$sesion=$_SESSION['username'];

$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

 
//getting id from url

$errors = array(); 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM company_profile c join membership m on c.company_name=m.industry_name WHERE member_name='{$_SESSION['username']}'");





if ($result) { // if user exists
 if ($result->num_rows==0) {
   array_push($errors, "Username already exists");
   echo"<script>alert('Your not assign any company');
   window.location.href='homepage.php';</script>";
 }
}
if (count($errors) == 0) {
while($res = mysqli_fetch_array($result))
{
    $id = $res['member_id'];
    $name = $res['company_name'];
   $age = $res['selling_type'];
    $dis= $res['discription'];
    $email= $res['email'];
    $address= $res['address'];
    $tell= $res['tell'];
    $pri= $res['price_rate'];
    $con= $res['quality'];
    $pos= $res['post_code'];
    $to= $res['town'];
    $s=$res['image'];
    $con=$res['confirmation'];
}}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body style="background-color:#93C0D0;">
	<br><br>	<br><br>	<br><br>	<br><br>		<br><br>	
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">  
                      <?php  
                        echo '<img src="images/'.$s.'" class="img-fluid" >'; ?>
                        
                            <div></div>
                           
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-head">
                                    <h5 style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">
                                    <?php echo $name;?>
										Factory
                                    </h5>
                                  
                                   
                                    
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                             
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                <?php
                    echo " <a class='btn btn-danger' href=\"resign_company.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete?')\">Remove Membership</a><br>";         
     ?>
                </div></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Website Activities</p>
                            <a href="homepage.php">Home page</a><br/>
                            <a href="blog.php">Blog </a><br/>
                      
                         
                            <a href="index1.php">Online Chat</a><br/>
                            <a href="shop.php">Shop</a><br/>
                            <a href="teabuyers_map.php">Map</a><br/>
                           
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                            <div class="col-md-6">
                                                <label>User Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $name;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $email;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Postal Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $address;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $tell;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Postal Code</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $pos;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Town</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $to;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>confirmation</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="color:#0100A4;"><?php echo $con;?></p>
                                            </div>
                                        </div>
                            </div><div class="tab-pane fade" id="dis" role="tabpanel" aria-labelledby="dis-tab">
                            
                             </div></form>  
                           
                            

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