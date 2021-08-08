
<?php

$connect = new PDO("mysql:host=localhost;dbname=ceylon_teahouse;charset=utf8mb4", "root", "");

session_start();

$message = '';



if(isset($_POST["login_company"]))
{
 $query = "
   SELECT * FROM company_seller_signup 
    WHERE name = :username AND confirm='1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':username' => $_POST["username"]
     )
  );
  $count = $statement->rowCount();
  if($count > 0)
 {
  $result = $statement->fetchAll();
    foreach($result as $row)
    {
		if(password_verify($_POST["password"], $row["password"]))
      {
        $_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['type'] = $row['type'];
      
        header("location:company_seller_homepage.php");
      }
      else
      {
       $message = "<label>Wrong Password</label>";
      }
    }
 }
 else
 {
	header('location: error.html ');
 }
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" href="css/teabuyers_login.css">
	
	
</head>

<body>
	<form  method="POST">
	<div class="container">
	<div class="login-form">
	<div class="login">
			<p class="text-danger"><?php echo $message; ?></p>
		<h3>Company and Seller login</h3>
		</div>
		<input type="text"  placeholder="username" name="username" required >
		<input type="password" placeholder="password" name="password" required >
		<button type="submit" name="login_company" class="btn" style="color: #EDEDED;">Login </button>
				<br/>
		<div style="font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace';">Dont have and account? <a href="company_seller_signup.php" style="color: #F5F5F5;">Sign Up</a></div>
		
			<div style="font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace';">Forgot password? <a href="company_forgot_passwd.php" style="color: #F5F5F5;">Password</a></div>
		</div>
	</div>	
	<video autoplay muted loop>
	<source src="videos/Pexels Videos 2675515.mp4">
	</video>
	</form>
	
	
</body>

</html>
	
