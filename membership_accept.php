<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: company_seller_login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: company_seller_login.php");
  }
?>
<?php
$sesion=$_SESSION['name'];

?>
<?php
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//getting id from url
$id = $_GET['id'];

 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM teabuyers_signup JOIN membership ON teabuyers_signup.user_id = membership.user_id WHERE member_id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['member_name'];
    $email= $res['email'];
    $address= $res['address'];
    $tell= $res['phone'];
    $ind= $res['industry_name'];
    $con= $res['confirmation'];
	$s=$res['image'];
  
}
?>
<?php


 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    
   
    // checking empty fields
    if(empty($id) || empty($email)) {            
        if(empty($id)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        
               
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE membership SET status='1',confirmation='confirmed' WHERE member_id=$id");
        
       
        header("Location: membership_approve.php");
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" href="css/company_seller_homepage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/profile.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:17px;">
  <img src="images/logocelonhousetwo.jpg"  style="height:130px; width:150px;"/>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" id="div1" style="height:100px;">
    <ul class="navbar-nav">
  
      <li class="nav-item" style="padding-left:400px;">
        <a class="nav-link" href="#">CompanyHome <span class="sr-only">(current)</span></a>
      </li> 
		<li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">News</a>
      </li>
      <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">shop</a>
		 <a class="dropdown-item" href="#">user added products</a>
		<a class="dropdown-item" href="#">sellers products</a>
        
        </div>
      </li>
		 <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Members
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="membership_approve.php">Request</a>
		 <a class="dropdown-item" href="#">Customers</a>
		
        </div>
      </li>
    
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Aboutus</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			
          <a class="dropdown-item" href="#">My Account</a>
          <a class="dropdown-item" href="#">Monthly Sales</a>
          <a class="dropdown-item" href="#">Assign Company</a>
            <a class="dropdown-item" href="#">Chat Box</a>
          <a class="dropdown-item" href="company_seller_homepage.php?logout='1'">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
	
	
	<div class="container register" style="width: 100%;">
		<form  method="post" >
				 <div class="file btn btn-small btn-primary" style="width: 200px; height: 150px;">
                       <?php  
                        echo '<img src="images/'.$s.'" class="img-fluid" >'; ?>
                            </div>
                            
						
                <div class="row">
					
					
                    <div class="col-md-3 register-left" >
						
					
						
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Join the TEA test!</p>
                
                    </div>
                    <div class="col-md-9 register-right" >
						<form action="membership_accept.php" method="post">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
								<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
								
                               <input type="submit" name="update" value="Confirm" >
									
                            </li>
                         
                        </ul>
						</form>
						
                        <div class="tab-content" id="myTabContent">
							
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								
                
                                <div class="row register-form">
                                    <div class="col-md-6">
										 <div class="form-group" style="font-size: 16px;">
											
										
                                        </div>
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
										  <div class="form-group" style="font-size: 16px;">
											<label>Request Industry:</label>
                                          <b> <?php echo $ind;?></b> 
                                        </div>
										  <div class="form-group" style="font-size: 16px;">
											<label>Confirm:</label>
                                          <b> <?php echo $con;?></b> 
                                        </div>
                                        
                                    </div>
                               
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
</form>
            </div>
</body>
</html>