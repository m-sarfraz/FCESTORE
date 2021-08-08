<?php
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

$results_per_page = 5;
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM blog ");
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
$sql='SELECT * FROM blog LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($mysqli, $sql);
$result2 = mysqli_query($mysqli, "SELECT * FROM blog limit 3  "); // using mysqli_query instead

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

<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:17px;">
  <img src="images/logocelonhousetwo.jpg"  style="height:130px; width:150px;"/>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" id="div1" style="height:100px;">
    <ul class="navbar-nav">
  
      <li class="nav-item" style="padding-left:500px;">
        <a class="nav-link" href="main_ui.php">Home <span class="sr-only">(current)</span></a>
      </li> 
      <li class="nav-item" style="padding-left:60px;">
        <a class="nav-link" href="main_blog.php">Blog</a>
      </li>
       
       <li class="nav-item" style="padding-left:60px;">
        <a class="nav-link" href="main_aboutus.php">About us</a>
      </li>
       <li class="nav-item" style="padding-left:60px;">
        <a class="nav-link" href="main_contact.php">Contact</a>
      </li>
    
      
      <li class="nav-item dropdown" style="padding-left:60px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Sign Up
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="teabuyers_signup.php">Tea Buyer</a>
          <a class="dropdown-item" href="company_seller_signup.php">Tea seller and company</a>
          <a class="dropdown-item" href="adminlogin.php">Admin</a>
          
        </div>
      </li>
    </ul>
  </div>
</nav>
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
	
<body>
	<div id="example1">


</div>
	<br><br>	<br><br>
	
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
						<div class="row">
						
		          <div class="col-md-12 d-flex ftco-animate">
		            <div class="blog-entry align-self-stretch d-md-flex">
		            
		              <div class="text d-block pl-md-4">
		              	
		                <?php

                    
        echo'<div style="color:Black;">';
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {   
        echo' </div>';
        $s=$res['image'];
        echo '<img src="images/'.$s.'" class="block-20" style="width:350px;height:170px;">';      
          echo '<h4><p><h3 class="heading">';
          echo "Title: <t>"  .$res['name']."<br></h3>";  
          echo'<div class="meta mb-3">';
          echo'   <div>';echo ""  .$res['timestamp']."";echo'</div>';
          echo'    <div>';echo "<b>"  .$res['username']."";echo'</b></div>';
          
          echo '<p>'; echo " <t>"   .substr($res['post'],0,300)."</br></p>";
          echo "<a href=\"main_blogreadmore.php?id=$res[id]\">Read more....</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"></a><br>";    echo "</h4></p>";    
        }  
        echo '<br><br></div>';?>
        
    
		              </div>
		            </div>
		          </div>
						</div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
           
            </div>
            
            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Recent Blog</h3>
              <?php
         //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
          while($res = mysqli_fetch_array($result2)) {  
            $s=$res['image'];
             echo' <div class="block-21 mb-4 d-flex">';
             echo '<img src="images/'.$s.'" class="block-20" style="width:100px;height:80px;"> &nbsp&nbsp&nbsp';   
             echo' <div class="text">';
             echo'   <h5 class="heading-1">'; echo ""   .substr($res['post'],0,50).""; echo' </h5>';
             echo'<div class="meta">';
             echo'   <div><span class="icon-calendar"></span> ';echo ""  .$res['timestamp']."";echo'</div>';
             echo'   <div><span class="icon-person"></span> ';echo ""  .$res['name']."";echo'</div>';
            
             echo'  </div>';
             echo' </div>';
             echo'</div>';
          }
          ?>   
          
          </div>
             </div>
   
            
          </div>

        </div>
        
      </div>
   <div class="pagination" style="padding-left: 900px;">
 
		 <a href="#">&laquo;</a>
        <?php for ($page=1;$page<=$number_of_pages;$page++) {
       
          echo '<a class=""  href="blog.php?page=' . $page . '">' . $page . '</a> ';
          
        }
        ?>
		<a href="#">&raquo;</a>
	</div>
    </section> <!-- .section -->
	
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