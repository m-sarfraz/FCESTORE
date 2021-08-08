<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$address = "";
$type = "";
$tell = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'ceylon_teahouse');

// REGISTER USER
if (isset($_POST['reg_company'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $tell = mysqli_real_escape_string($db, $_POST['tell']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM company_seller_signup WHERE name='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['name'] === $username) {
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
  	$query = "INSERT INTO company_seller_signup (name, address, type, tell,  email, password, confirm, confirmcode) 
  			  VALUES('$username', '$address','$type','$tell','$email', '$password' , '0', '$confirmcode')";
      mysqli_query($db, $query);
      $message =
      "
      Confirm Your Email
      Click the link below to verify your account
     http://localhost/finalproject/company_seller_emailconfirm.php?username=$username&code=$confirmcode
      ";
      
mail($email,"hello",$message,"From: ceylonteahouse99@gmail.com");
        
  	header('location: company_seller_signup.php');
  }
}

// LOGIN USER
if (isset($_POST['login_company'])) {
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
        $query = mysqli_query($db,"SELECT * FROM company_seller_signup WHERE password='$password' AND name='$username'");
      
        
        if (mysqli_num_rows($query) == 1)  {
          $_SESSION['name'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: company_seller_homepage.php');
        }else {
            header('location: teabuyers_loginerror.php  ');
        }
    }
  
}
  ?>
<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="css/teabuyers_signup.css">
	</head>
	<body>
		
		              <form class="sign-up" style="width: 80%;" method="post" action="company_seller_signup.php">
						  <?php include('errors.php'); ?>

							<div class="container">
							<h1>Ceylon Teahouse</h1>
							<h2>Company and Seller Sign Up</h2>
								<div class="row100">
									<div class="col">
										<div class="inputBox">
											<input type="text" name="username" value="" required="required">
											<span class="text">Username</span>
											<span class="line"></span>

										</div>

									</div>
									<br>
									
									  <div class="form-group" style="padding-left: 20px; font-size: 18px;">
                        <label for="validationCustom05">Selling Type</label>
                        <select name="type">
                            
                              <option class="form-control"  required  style="font-family: Constantia, 'Lucida Bright', 'DejaVu Serif', Georgia, 'serif'; font-size: 16px;"> Company </option>
                              <option class="form-control"  required  style="font-family: Constantia, 'Lucida Bright', 'DejaVu Serif', Georgia, 'serif'; font-size: 16px;"> Individual Seller </option>
                             
                                   </select>
                            
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
											<input type="number" name="tell" value="" required="required">
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
												<input type="submit"  onClick="myFunction()" name="reg_company" value="Sign Up" id="sd">
									</div>
								</div>
								</div>
								 <p class="loginhere">
                        Have already an account ? <a href="company_seller_login.php" class="loginhere-link">Login here</a>
                    </p>

						</div>
						  </form>
						  </form>
		<script>
function myFunction() {
  alert("Welcome\nConfirm your varification code that we send to your gmail");
}
</script>

	</body>
</html>
