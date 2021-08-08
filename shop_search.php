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
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
if(isset($_GET["search"])){
    $search=$mysqli->escape_string($_GET["search"]);
    $results_per_page = 5;
    //fetching data in descending order (lastest entry first)
    //$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
    $result = mysqli_query($mysqli, "SELECT * FROM shop where product_name Like '%$search%'");
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
    $sql="SELECT * FROM shop where product_name Like '%$search%'";
        $result = mysqli_query($mysqli, $sql);
    
}
?>
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
<title>Untitled Document</title>
</head>

<body>
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
	
 <section class="ftco-section" style="background-color:beige;">
	  <form action="shop_search.php" method="get" style="padding-top: 20px; padding-left: 50px;">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" style="height: 25px; width: 30px;"><i class="fa fa-search"></i></button>
    </form>
	 
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
						<table>
							<tr>
								
    				<td style="padding-left: 50px; font-size: 24px;">	<a href="#" class="active">All</a> </td>
    				<td style="padding-left: 140px; font-size: 24px;">	<a href="shop_fertilizer.php">Fertilizer</a></td>
    					<td style="padding-left: 140px; font-size: 24px;"><a href="shop_equipment.php">Equipment</a></td>
    					<td style="padding-left: 140px; font-size: 24px;"> <a href="shop_plants.php">Plants</a></td>
						<td style="padding-left: 140px; font-size: 24px;"> <a href="shop_teabags.php">TeaBags</a></td>
    			
    				</ul>
            
    			</div>
            </div>
				
				</tr>
      </table>
            <?php
	     if($number_of_results==0){echo ' <div class="container"> <div class="notice notice-warning">
                <strong>SORRY</strong> No Resluts  <span class="pull-right text-warning readMore">Read</span>
                  <div class="desc">
                    
                    <p>
                    We couldn’t find any repositories matching <b>';echo $search; echo'</b>
                    </p>        
                </div>
            </div></div>';}else{
        echo'<div style="color:Black;">';echo '<div class="row">';
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {         
      
    	
           
    		echo'<div class="col-md-6 col-lg-3 ftco-animate">';
    			echo' <br><br>	<div class="product">';
          
          $s=$res['image'];
          echo '<img src="images/'.$s.'" class="img-fluid" style="width:320px;height:220px;">'; 
    				
    					
          echo '	<div class="overlay"></div>
    					</a>  ';
      
    				echo'	<div class="text py-3 pb-4 px-3 text-center" >';
                         echo'	<h3>'; echo '<p>'; echo ""   .$res['product_name']."</br></p>";echo'</h3>';
                         echo'<div class="d-flex" >';
                  
                        echo'		<div class="pricing">';
                        echo'		<p class="price" style="padding-left: 45px;"><span class="mr-2 ">';echo " lkr <t>"  .$res['price']."<br></h3>";echo'</p>'; echo'</span></p>';
                        echo'		</div>';
                        echo'</div>';
                        echo "<a href=\"product_single.php?id=$res[id]\" class=\"btn btn-success  py-2 px-3\" >More Info</a> ";    echo "</h4></p>";    
                    echo'</div> ';
                echo'</div>';
            echo'</div>';
        
       }  echo'</div>'; 
        echo '</div>';}
        ?>

 <div class="pagination" style="padding-left: 400px;">
 
		 <a href="#">&laquo;</a>
        <?php for ($page=1;$page<=$number_of_pages;$page++) {
   
          echo '<a class=""  href="shop.php?page=' . $page . '">' . $page . '</a> ';
         
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