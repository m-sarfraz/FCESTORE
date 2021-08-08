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
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated

$results_per_page = 8;
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM shop where product_type='fertilizer' "); 
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
$sql='SELECT * FROM shop where product_type="fertilizer" LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($mysqli, $sql);// using mysqli_query instead
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
background:url("images/teapic90.jpg");
padding-left: 750px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:top;
background-size: cover;
height: 600px;
}
	
</style>
	<div id="example1">
	<p>Tea Industry Factory Details</p>

</div><br><br>
	
 <section class="ftco-section"  style="background-color: beige;">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
						<table>
							<tr>
								
    				<td style="padding-left: 50px; font-size: 24px;">	<a href="shop.php" class="active">All</a> </td>
    				<td style="padding-left: 120px; font-size: 24px;">	<a href="shop-fertilizer.php">Fertilizer</a></td>
    					<td style="padding-left: 120px; font-size: 24px;"><a href="shop_equipment.php">Equipment</a></td>
    					<td style="padding-left: 120px; font-size: 24px;"> <a href="shop_plants.php">Plants</a></td>
								<td style="padding-left: 140px; font-size: 24px;"> <a href="shop_teabags.php">TeaBags</a></td>
    				 <form action="shop-search.php" method="get">
              
           
              </form>
    				</ul>
            
    			</div>
            </div>
				
				</tr>
      </table>
            <?php
        echo'<div style="color:Black;">';echo '<div class="row">';
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {         
      
    	
           
    		echo'<div class="col-md-6 col-lg-3 ftco-animate">';
    			echo' <br><br>	<div class="product">';
          
          $s=$res['image'];
          echo '<img src="images/'.$s.'" class="img-fluid" style="width:255px;height:170px;">'; 
    				
    					
          echo '	<div class="overlay"></div>
    					</a>  ';
      
    				echo'	<div class="text py-3 pb-4 px-3 text-center">';
                         echo'	<h3><a href="#">'; echo '<p>'; echo ""   .$res['product_name']."</br></p>";echo'</a></h3>';
                         echo'<div class="d-flex">';
                  
                        echo'		<div class="pricing">';
                        echo'		<p class="price" style="padding-left: 45px;"><span class="mr-2 ">';echo " lkr &nbsp<t>"  .$res['price']."<br></h3>";echo'</p>'; echo'</span></p>';
                        echo'		</div>';
                        echo'</div>';
                        echo "<a href=\"product_single.php?id=$res[id]\" class=\"btn btn-success py-2 px-3\">More Info</a> ";    echo "</h4></p>";    
                    echo'</div> ';
                echo'</div>';
            echo'</div>';
        
       }  echo'</div>'; 
        echo '</div>';
        ?>

<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
        <ul><h4>More Posts</h4>
        <?php for ($page=1;$page<=$number_of_pages;$page++) {
        echo'<li class="active">';
          echo '<a class=""  href="shop.php?page=' . $page . '">' . $page . '</a> ';
          echo'</li>&nbsp';
        }
        ?>
        </ul>
        </div>
          </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">

<div class="row justify-content-center mb-3 pb-3">
    <div class="col-md-12 heading-section text-center ftco-animate">
      <span class="subheading">Plantation industry</span>
     <h3 class="mb-4">Product and Equipment Shops Locations</h3>

    </div>        

    <div id="mapCanvas"></div>


<?php
$result = $mysqli->query("SELECT * FROM marker where type='Shop'");
$result2 = $mysqli->query("SELECT * FROM marker where type='Shop'");
?>
   
        
   <script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
var b_icon="https://www.google.com/mapfiles/marker_green.png";
var blue_icon="http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"),{  
      center: new google.maps.LatLng(6.927417, 79.861071),
                zoom: 15,});

        
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '["'.$row['name'].'", '.$row['lat'].', '.$row['lng'].'],';
            }
        }
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){
            while($row = $result2->fetch_assoc()){  ?>
                ['<div class="info_content">' +
                '<img src="images/<?php echo $row['image'];?>" style="width:255px;height:170px;">'+
                '<h5><?php echo $row['name']; ?></h5>' +
                '<p><?php echo $row['type']; ?></p>' +
                '<p><?php echo $row['description']; ?></p>' + 
                '<a href="http://localhost/vegefoods/Tea-industry.php">Visit More Details!</a>' +'</div>'],
        <?php }
        }
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
    },
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);

</script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBASl0AXJrqLuHm_negrmEYrBnGntLhIoM&callback=initMap">
    </script>
                </section>
<?php include("footer.php") ?>
</body>
</html>