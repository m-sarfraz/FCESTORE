
<?php


session_start();
$errors = array(); 
$message = '';
$db = mysqli_connect('localhost', 'root', '', 'ceylon_teahouse');



if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
       
        $query = "SELECT * FROM admin_login WHERE name='$username' AND password='$password' ";
        $results = mysqli_query($db, $query);
        
        if (mysqli_num_rows($results) == 1) {
		  $_SESSION['user'] = $username;
		 
          $_SESSION['success'] = "You are now logged in";
          header('location: dashboard.php');
        }else {
            header('location: admin_login_error.php ');
        }
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
		<h3>Admin login</h3>
		</div>
		<input type="text"  placeholder="username" name="username" required >
		<input type="password" placeholder="password" name="password" required >
		<button type="submit" name="login_user" class="btn" style="color: #EDEDED;">Login </button>
				<br/>
		
		</div>
	</div>	
	<video autoplay muted loop>
	<source src="videos/Pexels Videos 2675515.mp4">
	</video>
	</form>
	
	
</body>

</html>
	
