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
  	header("location:  teabuyers_login.php");
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

$results_per_page = 5;
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM teabuyers_signup ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM blog ORDER BY id DESC ");
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
$sql='SELECT * FROM blog ORDER BY id DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($mysqli, $sql);
$result2 = mysqli_query($mysqli, "SELECT * FROM blog where username='{$_SESSION['username']}'  limit 3  "); // using mysqli_query instead

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
  color:#FF1418;
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
          $sa=$res['id'];
          $result5 = mysqli_query($mysqli,"SELECT * FROM blog_comment where post_id='$sa'");
$rows5 = mysqli_num_rows($result5);
        echo' </div>';
        $s=$res['image'];
        echo '<img src="images/'.$s.'" class="block-20" style="width:350px;height:170px;">';      
          echo '<h4><p><h3 class="heading">';
          echo " <t>"  .$res['name']."<br></h3>";  
          echo'<div class="meta mb-3">';
          echo'   <div><span class="icon-calendar"></span> ';echo ""  .$res['timestamp']."";echo'</div>';
          echo'    <div><span class="icon-person"></span>';echo "<b>"  .$res['username']."";echo'</b></div>';
          echo'   <div> <span class="icon-chat"></span> Comments';  echo " $rows5 "; echo'</div>';
          echo '<p>'; echo " <t>"   .substr($res['post'],0,300)."</br></p>";
          echo "<a href=\"blog_single.php?id=$res[id]\">Read more....</a> <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"></a><br>";    echo "</h4></p>";    
        }  
        echo '<br><br></div>';?>
        
    
		              </div>
		            </div>
		          </div>
						</div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
			  
            <div class="sidebar-box" style="padding-left: 80px;">
            <form action="blog_search.php" method="get">
              <input type="text" placeholder="Search blog title" name="search">
              <button type="submit" style="height: 20px; width: 20px;"><i class="fa fa-search"></i></button>
              </form>
            </div>
			  <br>
            <div class="sidebar-box ftco-animate" style="background-color:#38BDA2;">
            	<h3 class="heading" style="padding-left: 80px; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">ADD YOUR BLOG</h3>
              <ul class="categories">
              <form name="form1" method="post" action="insert_blog.php" class="p-5 bg-light">
              <div class="form-group">
                    
                    <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $sesion;?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Post Title*</label>
                    <input type="text" class="form-control" id="name" name="name" require>
                  </div>
                  <div class="form-group">
                    <label for="message">Post</label>
                    <textarea  id="message" cols="30" name="age" rows="10" class="form-control"require></textarea>
                  </div>

                  <div class="form-group">
                    <label for="website">Image</label>
                    <input type="file" name="image" accept="image/*" require>
                  </div>

                  <div class="form-group">
                 <input type="hidden" name="id" >
                    <input type="submit" name="submit" value="Post Your Blog" class="btn py-3 px-4 btn-success">
                  </div>

                </form>
              
              </ul>
            </div>
            <div class="sidebar-box ftco-animate" style="padding-left: 80px;">
       
              <?php
         //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
          while($res = mysqli_fetch_array($result2)) {  
            $s=$res['image'];
             echo' <div class="block-21 mb-4 d-flex">';
             echo' <a class="blog-img mr-4" style="background-image: url(images/'.$s.');"></a>';
             echo' <div class="text">';
             echo'   <h3 class="heading-1">'; echo ""   .substr($res['post'],0,80).""; echo' </h3>';
             echo'<div class="meta">';
             echo'   <div><span class="icon-calendar"></span> ';echo ""  .$res['timestamp']."";echo'</div>';
             echo'   <div><span class="icon-person"></span> ';echo ""  .$res['name']."";echo'</div>';

             echo'  </div>';
             echo' </div>';
             echo'</div>';
          }
          ?>   
           <div class="sidebar-box ftco-animate" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
            <div class="container">
             <h3 class="heading"> Your blog post </h3>
            
             <div class="col-lg-6 mb-5 ftco-animate" style="padding-left: 1px;">
               <a href="user_blog.php" >    <Button class="btn btn-success py-3 px-4" style="width: 155px;" > Edit Your Blog</button></a>
									</div>
             </div>
             </div>
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