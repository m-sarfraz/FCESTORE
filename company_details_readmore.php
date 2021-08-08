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
?>
<?php
// including the database connection file
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM company_profile  ");

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
        <a class="nav-link" href="homepage.php">Home <span class="sr-only">(current)</span></a>
      </li> 
      <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="tea_industry.php">Tea</a>
        
        </div>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="blog.php">Blog</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="shop.php">Shop</a>
      </li>
     
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="user_aboutus.php">Aboutus</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php">My Account</a>
          <a class="dropdown-item" href="#">Monthly Sales</a>
          <a class="dropdown-item" href="asign_industry_profile.php">Assign Company</a>
            <a class="dropdown-item" href="index1.php">Chat Box</a>
          <a class="dropdown-item" href="homepage.php?teabuyers_logout='1'">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
	
	<br><br><br><br><br><br><br>
	
	<section class="ftco-section ftco-degree-bg" style="background-color:darkcyan;">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
          <?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM company_profile  WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['company_name'];
   
    $address = $res['address'];
    $image = $res['image'];
    $dis = $res['discription'];
  
    $tell = $res['tell'];
   
    $email = $res['email'];
}

$result2 = mysqli_query($mysqli, "SELECT * FROM company_profile join membership on company_profile.company_name=membership.industry_name WHERE id=$id and member_name='{$_SESSION['username']}' and status='1'");
 
//$result3= mysqli_query($mysqli, "SELECT * FROM  company_profile c inner join collection_points f on c.ind_name=f.company_name WHERE c.id=$id");

?>

   
    

<div class="container">
			<h1 class="mb-3"><?php echo $name;?></h1>
            <img src="images/<?php echo $image;?>" class="block-20" style="width:700px;height:400px;">
         
            
            <p><?php echo $dis;?></p>
          
            <p>Address :- <?php echo $address;?></p>
            <p>Tellphone No :- <?php echo $tell;?></p>
            
          
            
            
           </div>
           <?php
           while($res1 = mysqli_fetch_array($result2))
{

    $price = $res1['price_rate'];
    $quality= $res1['quality'];
    $post = $res1['post_code'];
    $town = $res1['town'];
    


    echo'<div class="container">';
           echo'	<div class="row d-flex mb-5 contact-info">';
        echo' <div class="w-100"></div>';
          echo' <div class="col-md-3 d-flex">';
          echo'	<div class="info bg-success p-3">';
	          echo'   <p><span>Price for per Kg:</span>';echo"$price"; echo'</p>';
              echo'  </div>';
            echo' </div>';
          echo' <div class="col-md-3 d-flex">';
          echo'	<div class="info bg-success p-3">';
            echo'<p><span>Quality :</span> ';echo"$quality"; echo'</p>';
              echo'  </div>';
            echo'  </div>';
          echo'  <div class="col-md-3 d-flex">';
          echo'	<div class="info bg-success p-3">';
	          echo'   <p><span>Town :</span> ';echo"$town"; echo'</p>';
              echo'  </div>';
            echo' </div>';
          echo' <div class="col-md-3 d-flex">';
          echo'	<div class="info bg-success p-3">';
	          echo'   <p><span>Postal code:</span> ';echo"$post"; echo'<br></p>';
              echo' </div>';
            echo' </div>';
          echo'  </div>';
      echo'</div>';
      }
      ?>
 
      <div class="pt-5 mt-5">
       </div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
			  <br><br><br>
       
            <div class="col-lg-6 mb-5 ftco-animate">
               <a href="membership.php" >    <Button class="btn btn-success py-3 px-4" >Get Membership</button></a>
									</div>
           
          </div>

        </div>
      </div>
   </section> <!-- .section -->
    <!-- .section -->
   
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