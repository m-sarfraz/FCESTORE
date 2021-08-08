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

include_once 'config2.php';
if(isset($_POST['submit'])) {   
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $pay = mysqli_real_escape_string($mysqli, $_POST['pay']);
    $proname = mysqli_real_escape_string($mysqli, $_POST['proname']);
    $date = mysqli_real_escape_string($mysqli, $_POST['date']);
    $fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
    $lname = mysqli_real_escape_string($mysqli, $_POST['lname']);
    $pname = mysqli_real_escape_string($mysqli, $_POST['pname']);
    $saller = mysqli_real_escape_string($mysqli, $_POST['seller']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $qunty = mysqli_real_escape_string($mysqli, $_POST['qunty']);
    $price = mysqli_real_escape_string($mysqli, $_POST['price']);
    $city= mysqli_real_escape_string($mysqli, $_POST['city']);
    $pcode = mysqli_real_escape_string($mysqli, $_POST['pcode']);
    $tell = mysqli_real_escape_string($mysqli, $_POST['tell']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    
        
    // checking empty fields
    if(empty($fname) || empty($lname) || empty($pname)|| empty($saller) || empty($address) || empty($qunty) || empty($price) || empty($city) || empty($pcode) || empty($tell) || empty($email) ) {
                
        if(empty($fname)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($lname)) {
            echo "<font color='red'>last name field is empty.</font><br/>";
        }
        if(empty($pname)) {
            echo "<font color='red'>last name field is empty.</font><br/>";
        }
        if(empty($saller)) {
            echo "<font color='red'>saller field is empty.</font><br/>";
        }

        if(empty($address)) {
            echo "<font color='red'>Address field is empty.</font><br/>";
        }

        if(empty($qunty)) {
            echo "<font color='red'>Quntity field is empty.</font><br/>";
        }

        if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }

        if(empty($city)) {
            echo "<font color='red'>city field is empty.</font><br/>";
        }

        if(empty($pcode)) {
            echo "<font color='red'>postal code field is empty.</font><br/>";
        }

        if(empty($tell)) {
            echo "<font color='red'>tell nofield is empty.</font><br/>";
        }

        if(empty($email)) {
            echo "<font color='red'>email field is empty.</font><br/>";
        }


        
        
    } else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database   
        $result = mysqli_query($mysqli, "INSERT INTO biling(product_name,date,p_id,fname,sname,p_name,seller_name,price,quntity,town,postecode,email,tell,address,payment) VALUES('$proname','$date','$id','$fname','$lname','$pname','$saller','$price','$qunty','$city','$pcode','$email','$tell','$address','$pay')");
        $result1 = mysqli_query($mysqli, "UPDATE shop SET quantity=quantity-$qunty WHERE id=$id");
        $message =
        "
        Dear Sir/Madam,

        Your order is successfully done.

        .....................Order details.....................
 

             Iteam Type   : $pname 
             Ithem Name   : $proname
             Iteam Price  : $price
             Order Date   : $date
             Quantity     : $qunty 
             Seller name  : $saller

             Full Bill Total : $price
             Diliver Address : $address
             Payment Method : PayPal
             
        please send email to us to report any issu of the order.
        
              Your order will be deliver withing 7/8 days.

        .......................................................

                     Thank for shoping with us

        ......................Welcome..........................
        
        ";
        
        mail($email,"ceylon_teahouse ",$message,"From: ceylonteahouse99@gmail.com");
             
    }
}
?>
   <?php 

    $a=mysqli_real_escape_string($mysqli, $_POST['qunty']);
    $b=mysqli_real_escape_string($mysqli, $_POST['price']);
    $c=$a*$b;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body	>
	<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic56.jpg");
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
	<p>Paypal Page </p>

</div><br><br>
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
	$newprice = $price-$disc+$dilivery;
}
?>
						<section style="background-color: hsla(170,80%,46%,1.00)" >
                        <div class="container" >
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 24px;">Ceylon Teahouse</span>
            <h2 class="mb-4">Order confirmed</h2>
            <p>please pay RS: <?php echo $b ?> </p>
          </div>
        </div>   		
    	</div>
   <div class="container">
   <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
          
          
          </div>

          <div class="col-md-6 d-flex">
          
                   
          <?php 
if(isset($_POST['submit'])){
    
    $b=mysqli_real_escape_string($mysqli, $_POST['price']);
   

    
}?>
   

            
          </div>
        </div> <form action="<?php echo PAYPAL_URL; ?>" method="post">

<!-- Identify your business so that you can collect the payments. -->

<input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">                                                                                                

<!-- Specify a Buy Now button. -->

<input type="hidden" name="cmd" value="_xclick">                                                                                        

<!-- Specify details about the item that buyers will purchase. -->

<input type="hidden" name="item_name" value="<?php echo $type; ?>">

<input type="hidden" name="item_number" value="<?php echo $id ?>">

<input type="hidden" name="amount" value="<?php echo $b ?>">

<input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

<!-- Specify URLs -->

<input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">

<input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">                                                                                                

<!-- Display the payment button. -->

                <div class="cart-detail p-3 p-md-4" align="center">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
                          <div class="col-lg-6 mb-5 ftco-animate">

<input type="submit" name="submit" class="btn btn-success" border="0" Value="Pay From Paypal">
</div>
</div>
                </form> 
      </div>
     

    </section><!-- .section -->
	<?php include ("footer.php")?>
</body>
</html>