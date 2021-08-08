<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
	
if(isset($_POST['submit'])) {   
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
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
    $total = $qunty*$price;
        
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
        $result = mysqli_query($mysqli, "INSERT INTO biling(product_name,date,p_id,fname,sname,p_name,seller_name,price,quntity,town,postecode,email,tell,address,payment) VALUES('$proname','$date','$id','$fname','$lname','$pname','$saller','$total','$qunty','$city','$pcode','$email','$tell','$address','Cash On Dilivery')");
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

             Full Bill Total : $total 

             Diliver Address : $address
             
             Payment Method : Cash On Delivery
             
        please send email to us to report any issu of the order.
        
              Your order will be deliver withing 7/8 days.

        .......................................................

                     Thank for shoping with us

        ......................Welcome..........................
        
        ";
        
        mail($email,"Agro web",$message,"From: ceylonteahouse99@gmail.com");
          
             
        header('location: shop.php');
    }
}
?>
</body>
</html>