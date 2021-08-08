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
// including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name=$_POST['name'];
    $age=$_POST['age'];
 
    // checking empty fields
    if(empty($name) || empty($age) ) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
               
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE shop SET name='$name',post='$age' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: shop.php");
    }
}
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

<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic89.jpg");
padding-left: 750px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
	
	
<body>
<div id="example1">
	<p>Tea Industry Factory Details</p>

</div>
	<?php
$sesion=$_SESSION['username'];
?>
 
   
		  <?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM shop WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
	$id=$res['id'];
    $name = $res['product_type'];
    $type = $res['product_name'];
    $price = $res['price'];
    $dis = $res['discription'];
    $seller = $res['seller_name'];
    $tell = $res['tell'];
    $adress = $res['adress'];
	$id = $res['id'];
	$disc=$res['discount'];
  $dilivery=$res['diliverry'];
  $avalability=$res['quantity'];
	$newprice = $price+$dilivery-$disc;
}
?>
	<div>
		         <?php 
if(isset($_POST['cal2'])){
    $a=mysqli_real_escape_string($mysqli, $_POST['qunty1']);
    $b=mysqli_real_escape_string($mysqli, $_POST['price']);
    $c=$a*$b;
    if($avalability<=$a){
      
   echo"<script>alert('Sory.! Your selected quantity not available right now. Please check the avalability.');
   window.location.href='product-single.php?id=$id';</script>";
    }
}?>
	<form style="height: 800px; width: 1400px; padding-left: 500px;" action="shopinsert.php" method="post">
			<h3 class="mb-4 billing-heading">Billing Details</h3>
							<input type="hidden" class="form-control" color="black" placeholder="" name="id" value="<?php echo $id;?>" readonly>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fname">First Name</label>
      <input type="text" class="form-control" color="black" placeholder="" name="fname" value="<?php echo $sesion;?>" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="lname">Last Name</label>
      <input type="text" class="form-control" placeholder="" name="lname" required >
    </div>
  </div>
  <div class="form-group">
    <label for="pname">Product Name</label>
     <input type="text" class="form-control" name="proname"   value="<?php echo $type;?>" readonly required>
  </div>
		 <div class="form-row">
    <div class="form-group col-md-6">
      <label for="ptype">Product Type</label>
     <input type="text" class="form-control" name="pname"  value="<?php echo $name;?>" readonly required>
    </div>
    <div class="form-group col-md-6">
      <label for="date">Date</label>
      <input type="date" style="color:black;"class="form-control" name="date">
    </div>
  </div>
  <div class="form-group">
    <label for="sellername"> Seller Name</label>
    <input type="text" class="form-control" placeholder="" name="seller"required  value="<?php echo $seller;?>" readonly>
  </div>
		<div class="form-group">
    <label for="address"> Address</label>
    <input type="text" class="form-control" name="address" placeholder="Address of the customer" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="quan">Quantity</label>
       <input type="text" class="form-control" name="qunty" value="<?php echo $a;?>" readonly required>
    </div>
   
    <div class="form-group col-md-2">
      <label for="totalamount">Total Amount (LKR)</label>
     <input type="text" style="color:black; width: 450px;"class="form-control"  name="price"  placeholder="" required value="<?php echo $c;?>"  readonly>
    </div>
  </div>
	 <div class="form-row">
    <div class="form-group col-md-6">
      <label for="town">Town/City</label>
      <input type="text" class="form-control"name="city" required placeholder="">
    </div>
   
    <div class="form-group col-md-2">
      <label for="postecode">Postcode/Zip</label>
      <input type="text" style="color:black; width: 450px;" class="form-control"name="pcode"  placeholder=""required>
    </div>
  </div>
		 <div class="form-row">
    <div class="form-group col-md-6">
      <label for="phone">Phone</label>
     <input type="text" class="form-control" name="tell"required placeholder="">
    </div>
   
    <div class="form-group col-md-2">
      <label for="email">Email Address</label>
     <input type="text" style="color:black; width: 450px;" class="form-control" name="email" required placeholder="">
    </div>
  </div>
<div class="col-md-12">
<div class="form-group">
	                	
	<input type="hidden" class="form-control" name="id" value="<?php echo $id;?> "readonly>
	      </div>
		  </div>

  <button type="submit" name="submit" class="btn btn-success">Place Order</button>
</form>
		</div>
	<?php include("footer.php") ?>

</body>
</html>