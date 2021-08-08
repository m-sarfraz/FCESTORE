<?php include("header.php") ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: teabuyers_login.php");
  }
 

$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//getting id from url

 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM teabuyers_signup  WHERE username='{$_SESSION['username']}'");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['username'];
	$address= $res['address'];
	$tell = $res['phone'];
    $email= $res['email'];
    $s=$res['image'];
  
}
$result9 = mysqli_query($mysqli, "SELECT * FROM membership  WHERE user_id='{$_SESSION['user_id']}'");
$rows = mysqli_num_rows($result9);
while($res1 = mysqli_fetch_array($result9))
{
    $con = $res1['confirmation'];
    $ind = $res1['industry_name'];
   
  
}

?>
 <?php
 
if(isset($_POST['update']))
{    
 
  $s=$_POST['file'];
    
  // checking empty fields
  if(empty($s)) 
          echo "<font color='red'>Image is empty.</font><br/>";
            
     else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE teabuyers_signup SET image='$s' WHERE user_id={$_SESSION['user_id']}");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: profile.php");
    }
}

// including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
 
if(isset($_POST['submit']))
{    


  $address=$_POST['address'];
  $tell=$_POST['phone'];
    
  // Profile Page update
  if(empty($name) || empty($email)) {            
    if(empty($name)) {
        echo "<font color='red'>Name field is empty.</font><br/>";
    }
    
    if(empty($address)) {
        echo "<font color='red'>Address field is empty.</font><br/>";
    }
    if(empty($tell)) {
      echo "<font color='red'>tell field is empty.</font><br/>";
  }
  }
     else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE teabuyers_signup SET  address='$address',phone='$tell' WHERE user_id={$_SESSION['user_id']}");
        
        //redirectig to the display page. 
        header("Location: profile.php");
    }
}
?>
<!doctype html>
<html>
<link rel="stylesheet" href="css/profile.css">
	
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<title>Untitled Document</title>	
<head>
<meta charset="utf-8">




	

<body> 

	
	
	<div class="container register" style="width: 100%;">
		<form  method="post" action="profile.php">
				 <div class="file btn btn-small btn-primary" style="width: 200px; height: 170px;">
                       <?php  
                        echo '<img src="images/'.$s.'" class="img-fluid" >'; ?>
                            </div>
						<input type="file" style="width: 250px;" name="file"/>
			<button class="profile-edit-btn" name ="update">Update Profile Image </button></form>
		
                <div class="row">
					
					
                    <div class="col-md-3 register-left" >
						
					
						
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Join the TEA test!</p>
                
                    </div>
					
                    <div class="col-md-9 register-right" >
						
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update</a>
                            </li>
                        </ul>
						
						
                        <div class="tab-content" id="myTabContent">
							
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								
                
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group" style="font-size: 16px;">
											
											<label>UserName:</label>
                                          <b><?php echo $name;?> </b> 
                                        </div>
                                        <div class="form-group" style="font-size: 16px;">
											<label>Email:</label>
                                            <b><?php echo $email;?></b> 
                                        </div>
                                        <div class="form-group" style="font-size: 16px;">
											<label>Address:</label>
                                       <b> <?php echo $address;?></b> 
                                        </div>
                                        <div class="form-group" style="font-size: 16px;">
											<label>phone:</label>
                                          <b> <?php echo $tell;?></b> 
                                        </div>
                                        <?php if($rows==1){echo'
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Request industry:</label>
                                            </div>
                                            
                                                <b><p>';echo $ind; echo'</p></b>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Confirmation:</label>
                                            </div>
                                            
                                                <b><p>'; echo $con; echo'</p></b>
                                            
                                        </div>
                                        ';}?>
                                    </div>
                               
                                </div>
                            </div>
						
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                   <form  method="post" action="profile.php">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
											<b><label>User name</label></b>	
                                            <input type="text" class="form-control" name="username" placeholder="" value="<?php echo $name;?>" READONLY/>
                                        </div>
                                        <div class="form-group">
											<b><label>Address</label></b>
                                            <input type="text" class="form-control" name="address" placeholder="" value="<?php echo $address;?>" />
                                        </div>
                                        <div class="form-group">
											<b><label>Phone no</label></b>
                                            <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $tell;?>" />
                                        </div>
                                      


                                    </div>
                                    <div class="col-md-6">
                                        
                                        <input type="submit" name="submit" class="btnRegister"  value="Update Profile"/>
                                    </div>
                                </div></form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
	<!-- Footer -->
<footer class="page-footer font-small unique-color-dark" style="background-color:#FFF;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content --><br />
        <h6 class="text-uppercase font-weight-bold">Company name</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
          consectetur
          adipisicing elit.</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
<br />
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Products</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">MDBootstrap</a>
        </p>
        <p>
          <a href="#!">MDWordPress</a>
        </p>
        <p>
          <a href="#!">BrandFlow</a>
        </p>
        <p>
          <a href="#!">Bootstrap Angular</a>
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
          <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> info@example.com</p>
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
    <a href="https://mdbootstrap.com/"> CreativeJ.com</a>
  </div>
  <!-- Copyright -->

</footer>
</body>
</html>