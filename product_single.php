<?php include("header.php")  ?>

<?php
// including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

 define('PAYPAL_ID', 'yasirucooray122@gmail.com'); 

 define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

 define('PAYPAL_RETURN_URL', 'http://localhost/vegefoods/success.php'); 
 define('PAYPAL_CANCEL_URL', 'http://localhost/vegefoods/cancel.php'); 

 define('PAYPAL_NOTIFY_URL', 'http://localhost/ipn.php'); 

 define('PAYPAL_CURRENCY', 'USD'); 

 // Database configuration 

 define('DB_HOST', 'localhost'); 

 define('DB_USERNAME', 'root'); 

 define('DB_PASSWORD', ''); 

 define('DB_NAME', 'login'); 

 // Change not required 

 define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");



$result1 = mysqli_query($mysqli, "SELECT * FROM shop ORDER BY id DESC limit 4 "); 

?>
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
 
 padding: 380px;
background:url("images/teapic81.jpg");
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
	

</div>
	  <section class="ftco-section">
    	<div class="container">
    		<div class="row">
        
    			  <?php $id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM shop WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['product_type'];
    $type = $res['product_name'];
    $price = $res['price'];
    $dis = $res['discription'];
    $seller = $res['seller_name'];
    $tell = $res['tell'];
    $adress = $res['adress'];
    $avalabale =$res['quantity'];
    $disc= $res['discount'];
   
    $warenty = $res['warranty_period'];
    $dilivery = $res['diliverry'];
	 $newprice = $price+$dilivery-$disc;
	echo '<br><br><br><br><br>';
    
 echo' <div class="col-lg-6 mb-5 ftco-animate">';$s=$res['image'];
	echo '<br><br><br><br><br>';
 echo '<img src="images/'.$s.'" class="img-fluid" style="width:500px;height:470px;">';      
    
    		echo'	</div>';
    		echo'	<div class="col-lg-6 product-details pl-md-5 ftco-animate">' ;
              
//getting id from url
	echo '<br><br><br>';

    echo ' <br><br><br><br><br> <h2>'; echo $name; echo '</h2>';
    echo '	<h4>'; echo $type; echo '</h4>';
    				
    echo '<p class="price"><span> Price Rs.'; echo $price;echo '</span></p>';
    echo ' <p class="text-dark">Seller name :-'; echo $seller;echo '<p>';
    echo ' <p class="text-dark"><span>Discription :-'; echo $dis;echo '</p>';
    echo '  <p class="text-dark"><span>Address :-'; echo $adress;echo '</p>';
    echo '  <p class="text-dark"><span>Warrenty Period :-'; echo $warenty;echo '</p>';
    echo '  <p class="text-dark"><span>Dilivery Free :-'; echo $dilivery;echo '</p>';
    echo '  <p class="text-dark"><span>Discount :-'; echo $disc;echo '</p>';
    echo '  <p class="text-warning"><span>Final Amount :-'; echo $newprice;echo '</p>';
    echo ' <p class="text-dark"><span>Telephone no :-'; echo $tell; echo '</p>';
    echo ' <p class="text-dark"><span>Avalability :- '; echo $avalabale; echo '</p>';    
     if($avalabale!=0){
 echo " <form action=\"bill.php?id=$res[id]\" method=\"post\">";
      echo'<div class="row align-items-end">
      <br>
      <div class="w-100"></div>
      <div class="input-group col-md-6 d-flex mb-3">
          <input type="text" id="quantity" class="form-control input-number" placeholder="add quantity" color="black" placeholder="" name="qunty1"  required>
      </div>
            <div class="col-md-6">
              <div class="form-group">';  echo' <input type="hidden" class="form-control" placeholder="" name="price" required value="';echo $newprice;echo'"  readonly >';
                 echo' </div>
               </div> 
               <div class="col-md-6">';
		 
                  echo '<input type="submit" name="cal2" value="Cash On Dilivery" class="btn py-2 px-4 btn-success">
               </div></div>';    
            echo' </form>';
          echo " <form action=\"paypal.php?id=$res[id]\" method=\"post\">";
					    echo'<div class="row align-items-end">
	          		<br>
              <div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             
	             	 <input type="text" id="quantity" class="form-control input-number" placeholder="add quantity" color="black" placeholder="" name="qunty"  required>
                      
	          	</div>
	              <div class="col-md-6">
	                <div class="form-group">';
	                 echo' <input type="hidden" class="form-control" placeholder="" name="price" required value="';echo $newprice;echo'"  readonly >';
	                 echo' </div>
                </div> <div class="col-md-6">';
                   echo '<input type="submit" name="cal" value="Pay by PAYPAL" class="btn py-2 px-4 btn-success">
               
                </div>' ;    
                echo' </form>';
              }
              else{
                echo'<h5> <p class="text-danger">Iteam not avalable right now</p></h5>';
              }
               
         }
?>
 
   
    </section>

	<?php include("footer.php")?>
</body>
</html>