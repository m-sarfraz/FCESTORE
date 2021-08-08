<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: company_seller_login.php');
  }
 if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: company_seller_login.php");
  }
  
?>
<?php
$sesion=$_SESSION['name'];
$sesion2=$_SESSION['type'];
?>
<?php
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//getting id from url

 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM company_profile WHERE company_name='{$_SESSION['name']}'");
$rows4 = mysqli_num_rows($result);
while($res = mysqli_fetch_array($result))
{
    $name = $res['company_name'];
    $age = $res['selling_type'];
    $dis= $res['discription'];
    $email= $res['email'];
    $address= $res['address'];
    $tell= $res['tell'];
    $pri= $res['price_rate'];
    $con= $res['quality'];
    $pos= $res['post_code'];
    $to= $res['town'];
    $s=$res['image'];
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>CEYLON TEAHOUSE</title>
<link rel="stylesheet" href="css/company_seller_homepage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	

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
        <a class="nav-link" href="company_seller_homepage.php">CompanyHome <span class="sr-only">(current)</span></a>
      </li> 
		
      <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="company_map.php">Map</a>
      </li>
      <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			 <a class="dropdown-item" href="add_product.php">shop</a>
          <a class="dropdown-item" href="user_product.php">Manage products</a>
		
		
        </div>
      </li>
		<?php if($sesion2!=="Individual") { echo'
		 <li class="nav-item dropdown"style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Members
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="membership_approve.php">Request</a>
		 <a class="dropdown-item" href="join_members.php">Customers</a>
		
        </div>
      </li>
';}?>
    
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="company_aboutus.php">Aboutus</a>
      </li>
       <li class="nav-item" style="padding-left:30px;">
        <a class="nav-link" href="company_contact.php">Contact</a>
      </li>
      <li class="nav-item dropdown" style="padding-left:30px;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $sesion;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			
          <a class="dropdown-item" href="industry_profile.php">My Account</a>
       
          <a class="dropdown-item" href="company_seller_homepage.php?logout='1'">Logout</a>
        </div>
      </li>
				 <li class="nav-item" style="padding-left:30px;">
    <a href="https://www.facebook.com/campaign/landing.php?campaign_id=1635645263&extra_1=s%7Cc%7C313667601286%7Ce%7Cfacebook%20signup%7C&placement=&creative=313667601286&keyword=facebook%20signup&partner_id=googlesem&extra_2=campaignid%3D1635645263%26adgroupid%3D67924241012%26matchtype%3De%26network%3Dg%26source%3Dnotmobile%26search_or_content%3Ds%26device%3Dc%26devicemodel%3D%26adposition%3D%26target%3D%26targetid%3Dkwd-321689134300%26loc_physical_ms%3D1009919%26loc_interest_ms%3D%26feeditemid%3D%26param1%3D%26param2%3D&gclid=Cj0KCQjwoub3BRC6ARIsABGhnya55DnnKpIX7isD_yL0pUtOSinBCLGPRHQrvuK1SpKxfQBnsvj5FdoaAvbIEALw_wcB" class="fa fa-facebook"></a>
<a href="https://help.twitter.com/en/using-twitter/create-twitter-account" class="fa fa-twitter"></a>
<a href="https://accounts.google.com/signup/v2/webcreateaccount?hl=en&flowName=GlifWebSignIn&flowEntry=SignUp" class="fa fa-google"></a>
      </li>
    </ul>
  </div>
</nav>


	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CEYLON TEAHOUSE</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	
	
	
	
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
          <h5 id="h5">SELL TEA PRODUCTS</h5>
         
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/teapic77.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style="height:750px;">
          <h5 id="h5">BEST WEBSITE FOR TEA SELLERS</h5>
       
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
	
	

<style>
#imgone{  vertical-align: middle;
max-width:100%;
}
#h5{ 
	
    font-size:80px;
	}
	
</style>
	
	
<br><br>
<?php include"homepage_animation.php" ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha256-lPE3wjN2a7ABWHbGz7+MKBJaykyzqCbU96BJWjio86U=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js" integrity="sha256-fIkQKQryItPqpaWZbtwG25Jp2p5ujqo/NwJrfqAB+Qk=" crossorigin="anonymous"></script>
	<script src="css/homepage_animation.js"></script>
	
	
	<br><br>
	<?php
 
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
	
	if(isset($_POST['submit'])) {   
    $cname = mysqli_real_escape_string($mysqli, $_POST['cname']);
    $stype = mysqli_real_escape_string($mysqli, $_POST['stype']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $dis = mysqli_real_escape_string($mysqli, $_POST['dis']);
    $image = mysqli_real_escape_string($mysqli, $_POST['image']);
    $price = mysqli_real_escape_string($mysqli, $_POST['price']);
    $qulity = mysqli_real_escape_string($mysqli, $_POST['qulity']);
    $pcode = mysqli_real_escape_string($mysqli, $_POST['pcode']);
    $tell = mysqli_real_escape_string($mysqli, $_POST['tell']);
    $city= mysqli_real_escape_string($mysqli, $_POST['city']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        
    // checking empty fields
    if(empty($cname) || empty($stype) || empty($address)|| empty($dis) || empty($image) || empty($price) || empty($qulity)  || empty($pcode) || empty($tell) || empty($city) || empty($email) ) {
                
        if(empty($cname)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($stype)) {
            echo "<font color='red'>last name field is empty.</font><br/>";
        }
        if(empty($address)) {
            echo "<font color='red'>Address field is empty.</font><br/>";
        }
        if(empty($dis)) {
            echo "<font color='red'>Discription field is empty.</font><br/>";
        }

        if(empty($image)) {
            echo "<font color='red'>Image field is empty.</font><br/>";
        }
		  if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }

        if(empty($qulity)) {
            echo "<font color='red'>Qulity field is empty.</font><br/>";
        }
		 if(empty($pcode)) {
            echo "<font color='red'>postal code field is empty.</font><br/>";
        }
		
        if(empty($tell)) {
            echo "<font color='red'>Phone number field is empty.</font><br/>";
        }

        if(empty($city)) {
            echo "<font color='red'>city field is empty.</font><br/>";
        }
        if(empty($email)) {
            echo "<font color='red'>email field is empty.</font><br/>";
		}
        
    } else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database   
        $result = mysqli_query($mysqli, "INSERT INTO company_profile(company_name,selling_type,address,discription,image,price_rate,quality,post_code,tell,town,email) VALUES('$cname','$stype','$address','$dis','$image','$price','$qulity','$pcode','$tell','$city','$email')");
        
		
    
       
    }
}
?>
	
	

	
	
				<div id="divform">
					<?php if($rows4==0){ echo '
				<form action="company_seller_homepage.php"  id="formone" method="post" style="width:80%; padding-left: 400px;">
					    <h3 class="mb-4 billing-heading" style="padding-left: 400px;" >Create Your Company Profile</h3><br>
	          	        <div class="row align-items-end">
	          		        <div class="col-md-6">
	                            <div class="form-group">
                                     <label for="firstname">Company Name</label>
                                        <input type="text" class="form-control" placeholder="" name="cname" value=""<?php echo $sesion ?>   
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                            <div class="form-group">
                              <label for="streetaddress"> Selling Type</label>
                              <select name="stype">
                              <option class="form-control"  required > Company </option>
                              <option class="form-control"  required > Individual Seller </option>
                           
	                	           </select>
	                            </div>
                            </div>
                            <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            <label for="streetaddress"> Address</label>
	                                    <input type="text" class="form-control" name="address"   value="" required>
	                            </div>
		                    </div>
                            <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            <label for="streetaddress">Discription</label>
                                    <textarea  id="message" cols="30" name="dis" rows="10" class="form-control"require></textarea>
	                            </div>
		                    </div>
		                    <div class="w-100"></div>
		                    <div class="col-md-12">
		            	        <div class="form-group">
	                	            <label for="streetaddress"> Image</label>
                                    <input type="file" name="image" accept="image/*" require>
	                            </div>
		                    </div>
		                    <div class="w-100"></div>
		                    <div class="col-md-6">
		            	        <div class="form-group">
	                	            <label for="towncity">Price rate</label>
	                                    <input type="text" class="form-control" name="price"  placeholder=""required>
                                </div>
                            </div>
                            <div class="col-md-6">
		            	        <div class="form-group">
	                	            <label for="towncity">Quality of product</label>
	                                    <input type="text" class="form-control"name="qulity"  placeholder=""required value=""  >
	                            </div>
		                    </div>
		                    <div class="w-100"></div>
		                    <div class="col-md-6">
		            	        <div class="form-group">
	                	            <label for="towncity">Town / City</label>
	                                    <input type="text" class="form-control"name="city" required placeholder="">
	                            </div>
		                    </div>
                            <div class="col-md-6">
		            	        <div class="form-group">
		            		        <label for="postcodezip">Postcode / ZIP *</label>
	                                    <input type="text" class="form-control"name="pcode"  placeholder=""required>
	                            </div>
		                    </div>
		                    <div class="w-100"></div>
		                    <div class="col-md-6">
	                            <div class="form-group">
	                	            <label for="phone">Phone</label>
	                                    <input type="text" class="form-control" name="tell"required placeholder="">
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                             <div class="form-group">
	                	            <label for="emailaddress">Email Address</label>
	                                    <input type="text" class="form-control" name="email" required placeholder="">
	                            </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
	          			           
                                        <div class="col-lg-6 mb-5 ftco-animate" style="padding-left: 300px;">
                                            <input type="submit" id="btncreate"   class="btn btn-primary py-3 px-4" name="submit"  value="Create">
									    </div>
                                </div>
                            </div>
	                    </div>
						';} ?>
	                </form>
					
					</div>
		
				
				<!-- END -->	
	
		    <br><br><br><br><br><br><br><br><br><br><br><br>         
	<?php include "footer.php" ?>		
</body>
</html>