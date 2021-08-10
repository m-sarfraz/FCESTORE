<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: teabuyers_login.php');
}
if (isset($_GET['teabuyers_logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: teabuyers_login.php");
}

?>
<?php include "header.php"?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>CEYLON TEAHOUSE</title>

	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="stylenew.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
 <div class="bd-example" id="divone">
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel" style="height:800px;">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" id="divx" style="height:820px;">
      <div class="carousel-item active">
        <img src="images/teapic13.jpg" id="imgone" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style="height:750px;">
          <h5 id="h5">TEA PLANTATION</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/teapic76.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style="height:750px;">
          <h5 id="h5">BUY TEA PRODUCTS </h5>

        </div>
      </div>
      <div class="carousel-item">
        <img src="images/teapic77.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style="height:750px;">
          <h5 id="h5">BEST WEBSITE FOR TEA BUYERS</h5>

        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<style>
#imgone{  vertical-align: middle;
max-width:100%;
}
#h5{

    font-size:80px;
	}

</style>
<br><br>
<?php include "homepage_animation.php"?>

	<table>
		<tr>
			<td style="padding-left: 600px;">
			 <a href="teabuyers_map.php">
<img border="0" alt="" src="images/teapic62 (2).png" width="100" height="100">
</a>
		</td>
					<td style="padding-left: 100px;">
			 <a href="tea_industry.php">
<img border="0" alt="" src="images/teapic63.png" width="100" height="100">
</a>
		</td>
					<td style="padding-left: 100px;">
			 <a href="index1.php">
<img border="0" alt="" src="images/teapic65.png" width="100" height="100">
</a>
		</td>
					<td style="padding-left: 100px;">
			 <a href="shop.php">
<img border="0" alt="" src="images/teapic64.png"width="100" height="100">
</a>
		</td>
		</tr>
		<tr>
		<td style="padding-left: 580px;">
			Industry Locations
			</td>
			<td style="padding-left: 100px;">
			Industry details
			</td>
			<td style="padding-left: 110px;">
			Online Chat
			</td>
			<td style="padding-left: 140px;">
			Shop
			</td>
		</tr>
	</table>

  
	<style>
.fa {
  padding: 12px;
  font-size: 13px;
  width: 39px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}
	</style>

	<br><br><br>

<div class="w3-content w3-section" style="max-width:500px">


  <img class="mySlides w3-animate-fading" src="images/teapic1.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic3.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapick4.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic84.jpg" style="width:100%">

  <img class="mySlides w3-animate-fading" src="images/teapic60.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic13.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic14.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic15.jpg" style="width:100%">

  <img class="mySlides w3-animate-fading" src="images/teapic16.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic17.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic18.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/teapic19.jpg" style="width:100%">
</div>

<div class="container">

<div class="row border">
    <h1 style="color: blue;" class="align-items-center">Recommended  Products</h1>
  </div>
  <?php
  //including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated

$results_per_page = 8;
//fetching data in descending order (lastest entry first)
$user_id= $_SESSION['user_id'];
// $abc = mysqli_query($mysqli, "SELECT recommended_type FROM recommendcontroller WHERE Similarity_id='$user_id"); 
// $row = mysqli_fetch_array($mysqli_result,$abc);
//  var_dump($row);
//  die;
// echo $user_id;
// $sql="SELECT recommended_type FROM recommendcontroller WHERE Similarity_id='$user_id'";
// $result = mysqli_query($mysqli, $sql);
// $result = $mysqli -> query("SELECT recommended_type FROM recommendcontroller WHERE Similarity_id='$user_id'");
// echo $result;

$tourquery = "SELECT recommended_type FROM recommendcontroller WHERE Similarity_id='$user_id'";

$result = $mysqli->query($tourquery);  // or mysqli_query($con, $tourquery);

$p_typ = $result->fetch_array()[0] ?? '';
// var_dump($p_typ);
// die;
$result = mysqli_query($mysqli, "SELECT * FROM shop where product_type='$p_typ'  "); 
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
$sql="SELECT * FROM shop where product_type='$p_typ'" ;
$result = mysqli_query($mysqli, $sql);// using mysqli_query instead
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
        echo '</div>';
        ?>
</div>
<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 9000);
}
</script>
</body>



<?php include "footer.php"?>
</html>