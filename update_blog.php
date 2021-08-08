
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
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated

$result2 = mysqli_query($mysqli, "SELECT * FROM blog where username='{$_SESSION['username']}' limit 3 "); // using mysqli_query instead

?>

    <?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM blog WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['name'];
    $age = $res['post'];
    
  
}
?>
<?php

 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name=$_POST['name'];
    $age=$_POST['age'];
    
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
        $result = mysqli_query($mysqli, "UPDATE blog SET name='$name',post='$age' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: blog.php");
    }
}
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

<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic45.jpg");
padding-left: 820px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
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
        <a class="nav-link" href="teabuyers_map.php">Map</a>
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
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Facilities
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">News</a>
          <a class="dropdown-item" href="#">New Technology</a>
          <a class="dropdown-item" href="#">Solutions</a>
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
         Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php">My Account</a>
          <a class="dropdown-item" href="#">Monthly Sales</a>
          <a class="dropdown-item" href="#">Assign Company</a>
            <a class="dropdown-item" href="#">Chat Box</a>
          <a class="dropdown-item" href="homepage.php?teabuyers_logout='1'">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
	<div id="example1">
	<p>Company Map</p>	
</div>
	<br><br>
	
	 <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">

 
    <form name="form1" method="post" action="update_blog.php" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="name">Title*</label>
                    <input type="text" class="form-control" id="name"value="<?php echo $name;?>" name="name" require>
                  </div>
                  <div class="form-group">
                    <label for="message">Post</label>
                    <input type="text"  id="message" cols="30"value="<?php echo $age;?>" name="age" rows="10" class="form-control"require></textarea>
                  </div>

                

                  <div class="form-group">
                  <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                    <input type="submit" name="update" value="Update" class="btn py-3 px-4 btn-success">
                  </div>

                </form>      

            
          


            <div class="pt-5 mt-5">
            
              

              <!-- END comment-list -->
              
              
            </div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
               
              </form>
            </div>
          
            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Recent Blog</h3>
              <?php
         //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
          while($res = mysqli_fetch_array($result2)) {  
            $s=$res['image'];
             echo' <div class="block-21 mb-4 d-flex">';
             echo' <a class="blog-img mr-4" style="background-image: url(images/'.$s.');"></a>';
             echo' <div class="text">';
             echo'   <h3 class="heading-1"><a href="#">'; echo ""   .substr($res['post'],0,80).""; echo' </a></h3>';
             echo'<div class="meta">';
             echo'   <div><span class="icon-calendar"></span> ';echo ""  .$res['timestamp']."";echo'</div>';
             echo'   <div><span class="icon-person"></span> ';echo ""  .$res['name']."";echo'</div>';
             echo'   <div><span class="icon-chat"></span> 19</div>';
             echo'  </div>';
             echo' </div>';
             echo'</div>';
          }
          ?>   
          
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