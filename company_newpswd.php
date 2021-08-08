
<?php
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if(isset($_GET["search"])){
    $search=$mysqli->escape_string($_GET["search"]);
   
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$user_scheck_query =  "SELECT * FROM company_seller_signup where email='$search'";
$result = mysqli_query($mysqli, $user_scheck_query);
	$user = mysqli_fetch_assoc($result);
	if($user['email']=== $search){
		$name = $user['name'];
	}else{
		$message = "Email address is not valid";
		echo "<script type='text/javascript '> alert('$message');window.location='company_forgot_passwd.php'</script>";
	}
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
     
    $name1=$_POST['email'];
    
    $password=$_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE company_seller_signup SET password='$password' WHERE name='$name1'");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: company_seller_login.php");
    
}
?>
<body background="images/teapic25.jpg"; style="background-position: center; background-size: cover;">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.form-gap {
    padding-top: 70px;
}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>Add Your New Password</p>
                  <div class="panel-body">
    
                    <form id="register-form" action="company_newpswd.php" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email"  value="<?php echo $name; ?>" class="form-control" type="text" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="password" type="password" name="password" placeholder="New Password" class="form-control"  >
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="update" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="id" > 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div> 
</body>

