<?php 

 // Include configuration file 

 include_once 'config2.php'; 


 // Include database connection file 

$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

 // If transaction data is available in the URL 

 if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 

     // Get transaction information from URL 

     $item_number = $_GET['item_number'];  

     $txn_id = $_GET['tx']; 

     $payment_gross = $_GET['amt']; 

     $currency_code = $_GET['cc']; 

     $payment_status = $_GET['st']; 

     // Get product info from the database 

     $productResult = $db->query("SELECT * FROM products WHERE id = ".$item_number); 

     $productRow = $productResult->fetch_assoc(); 

     // Check if transaction data exists with the same TXN ID. 

     $prevPaymentResult = $db->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'"); 


     if($prevPaymentResult->num_rows > 0){ 

         $paymentRow = $prevPaymentResult->fetch_assoc(); 

         $payment_id = $paymentRow['payment_id']; 

         $payment_gross = $paymentRow['payment_gross']; 

         $payment_status = $paymentRow['payment_status']; 

}else{ 

         // Insert transaction data into the database 

         $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 

         $payment_id = $db->insert_id; 
} 
} 

 ?>

 <body background="images/teapic88.jpg" style="background-position:center">

<div class="container" >

    <div class="status">

        <?php if(!empty($payment_id)){ ?>

            <h1 class="success"><center>Your Payment has been Successful</center></h1>

            <h4>Payment Information</h4>

            <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>

            <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>

            <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>

            <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

            <h4>Product Information</h4>

            <p><b>Name:</b> <?php echo $productRow['name']; ?></p>

            <p><b>Price:</b> <?php echo $productRow['price']; ?></p>

        <?php }else{ ?>
<br>
            <h1 class="error" style="font-size: 52px;"><center>Your Payment has been Successful</center></h1>

        <?php } ?>

    </div>

    <a href="shop.php" class="btn-link" style="font-size: 52px;"><center>Back to Products</center></a>

</div>
	 </body>