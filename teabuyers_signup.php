<!DOCTYPE html>
<?php
session_start();

// initializing variables
$username = "";
$address = "";
$phone = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'ceylon_teahouse');

// REGISTER USER
if (isset($_POST['btnsubmit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error into $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM teabuyers_signup WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
      $confirmcode = rand();
  	$query = "INSERT INTO teabuyers_signup (username, address, phone,  email, password, confirm, confirmcode) 
  			  VALUES('$username', '$address','$phone'	,'$email', '$password' , '0', '$confirmcode')";
      mysqli_query($db, $query);
      $message =
"
Confirm Your Email
Click the link below to verify your account
http://localhost/finalproject/emailconfirm.php?username=$username&code=$confirmcode
";

mail($email,"hello",$message,"From: ceylonteahouse99@gmail.com");
  
  	header('location:teabuyers_signup.php');
  }
}

// LOGIN USER
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM teabuyers_signup WHERE username='$username' AND password='$password' AND confirm='1'";
        $results = mysqli_query($db, $query);
        
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: homepage.php');
        }else {
            header('location: teabuyers_loginerror.php ');
        }
    }
  }
  
  ?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="css/teabuyers_signup.css">
	</head>
	<body>
		
		              <form class="sign-up" style="width: 80%;" method="post" action="teabuyers_signup.php">
						  <?php  if (count($errors) > 0) : ?>
							   <div class="error">
								<?php foreach ($errors as $error) : ?>
								  <p><?php echo $error ?></p>
								<?php endforeach ?>
							  </div>
							<?php  endif ?>

							<div class="container">
							<h1>Ceylon Teahouse</h1>
							<h2>Tea Buyers Sign Up</h2>
								<div class="row100">
									<div class="col">
										<div class="inputBox">
											<input type="text" name="username" value="" required="required">
											<span class="text">Username</span>
											<span class="line"></span>

										</div>

									</div>

									<div class="col">
										<div class="inputBox">
											<input type="text" name="address" value="" required="required">
											<span class="text">Address</span>
											<span class="line"></span>

										</div>

									</div>
									
										<div class="col">
										<div class="inputBox">
											<input type="number" name="phone" value="" required="required">
											<span class="text">Phone No</span>
											<span class="line"></span>

										</div>

									</div>

									<div class="col">
										<div class="inputBox">
											<input type="email" name="email" value="" required="required">
											<span class="text">Email</span>
											<span class="line"></span>

										</div>

									</div>

									<div class="col">
										<div class="inputBox">
											<input type="password" name="password_1" value="" required="required">
											<span class="text">Password</span>
											<span class="line"></span>

										</div>

									</div>

									<div class="col">
										<div class="inputBox">
											<input type="password" name="password_2" value="" required="required">
											<span class="text">Confirm Password</span>
											<span class="line"></span>

										</div>

									</div>

									<div class="row100">
										<div class="col">
												<input type="submit" onClick="myFunction()" name="btnsubmit" value="Sign Up" id="sd">
									</div>
								</div>
								</div>
								 <p class="loginhere">
                        Have already an account ? <a href="teabuyers_login.php" class="loginhere-link">Login here</a>
                    </p>

						</div>
						  </form>
		<script>
function myFunction() {
  alert("Welcome\nConfirm your varification code that we send to your gmail");
}
</script>

	</body>
</html>
