<?php include("header.php")?>
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
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

$results_per_page = 6;
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM blog where username='{$_SESSION['username'] }' ");
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
$sql="SELECT * FROM blog where username='{$_SESSION['username']} ' LIMIT " . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($mysqli, $sql);
 // using mysqli_query instead
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
	.pagination {
  display: inline-block;
}

.pagination a {
  color:#FF0004;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
	
</style>
</head>

<body>
	<div id="example1">
	

		
</div>
	<br>
	 <section class="ftco-section">
    	<div class="container">
      <div class="container">
		<div class="row justify-content-center mb-3 pb-3">
  			<div class="col-md-12 heading-section text-center ftco-animate" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
	 			 <span class="subheading" style="font-size: 20px;" >Ceylon Teahouse</span>
				 <h2 class="mb-4"> <b>Blog Post</b></h2>
	
 			 </div>
		</div>   		
	</div>
      
            <?php
        echo'<div style="color:Black;">';echo '<div class="row">';
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {         
      
    	
           
    		echo'<div class="col-md-6 col-lg-4 ftco-animate">';
    			echo'	<div class="product">';
                echo'	<div class="text py-3 pb-4 px-4 text-center">';
                echo'	<h3><a href="#">'; echo '<p><b>'; echo ""   .$res['name']."</b></p>";echo'</a></h3>';
                echo'</div> '; 
          $s=$res['image'];
          echo '<img src="images/'.$s.'" class="img-fluid" style="width:405px;height:220px;">'; 
    				
    					
          echo '	<div class="overlay"></div>
    					</a>  ';
                    echo'	<div class="text">';
                    echo '<p>'; echo "Written By : "   .$res['username']."</p>";
                    echo "<p>"  .$res['timestamp']."</p><br>";
                    echo '<p>'; echo " <t>"   .substr($res['post'],0,160)."</p>";
                    echo "<a href=\"blog_single.php?id=$res[id]\">Read more....</a> <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"></a><br>";    echo "</h4></p>";    
                    echo "<a href=\"update_blog.php?id=$res[id]\">Update</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a><br>";    echo "</h4></p>";     
           
                    echo'</div> ';    
                    
                    
                echo'</div>';
            echo'</div>';
        
       }  echo'</div>'; 
        echo '</div>';
        ?>
			<br>
       <div class="pagination" style="padding-left: 500px;">
       
		 <a href="#">&laquo;</a>
        <?php for ($page=1;$page<=$number_of_pages;$page++) {
       
          echo '<a class=""  href="blog.php?page=' . $page . '">' . $page . '</a> ';
          
        }
        ?>
		<a href="#">&raquo;</a>
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