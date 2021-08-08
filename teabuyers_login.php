<?php
$connect = new PDO("mysql:host=localhost;dbname=ceylon_teahouse;charset=utf8mb4", "root", "");


date_default_timezone_set('Asia/Colombo');

function fetch_user_last_activity($user_id, $connect)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  $dynamic_background = '';
  $chat_message = '';
  if($row["from_user_id"] == $from_user_id)
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been deleted</em>';
    $user_name = '<b class="text-success">You</b>';
   }
   else
   {
    $chat_message = $row['chat_message'];
    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
   }
   

   //$dynamic_background = 'background-color:#ffe6e6;';
  }
  else
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been deleted</em>';
   }
   else
   {
    $chat_message = $row["chat_message"];
   }
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
   //$dynamic_background = 'background-color:#ffffe6;';
  }
  $output .= '

   <p>'.$user_name.' - '.$chat_message.'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 $query = "
 UPDATE chat_message 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT username FROM teabuyers_signup WHERE user_id = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['username'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

function fetch_is_type_status($user_id, $connect)
{
 $query = "
 SELECT is_type FROM login_details 
 WHERE user_id = '".$user_id."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 "; 
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}
function fetch_group_chat_history($connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '0'  
 ORDER BY timestamp DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  $chat_message = '';
 // $dynamic_background = '';

  if($row['from_user_id'] == $_SESSION['user_id'])
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been deleted</em>';
    $user_name = '<b class="text-success">You</b>';
   }
   else
   {
    $chat_message = $row['chat_message'];
    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
   }
   //$dynamic_background = 'background-color:#ffe6e6;';
  }
  else
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been deleted</em>';
   }
   else
   {
    $chat_message = $row['chat_message'];
   }
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
   //$dynamic_background = 'background-color:#ffffe6;';
  }
  $output .= '
  <li>
   <p>'.$user_name.' - '.$chat_message.' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
   
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}







session_start();


$message = '';

if(isset($_SESSION['user_id']))
{
 header('location:homepage.php');
}

if(isset($_POST["login"]))
{
 $query = "
   SELECT * FROM teabuyers_signup 
    WHERE username = :username AND confirm='1'
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
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        header("location:homepage.php");
      }
      else
      {
       $message = "<label>Wrong Password</label>";
      }
    }
 }
 else
 {
	header('location:error.html ');
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
		<h3>Tea Buyers login</h3>
		</div>
		<input type="text"  placeholder="username" name="username" required >
		<input type="password" placeholder="password" name="password" required >
		<button type="submit" name="login" class="btn" style="color: #EDEDED;">Login </button>
				<br/>
		<div style="font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace';">Dont have and account? <a href="teabuyers_signup.php" style="color: #F5F5F5;">Sign Up</a></div>
		
			<div style="font-family:Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace';">Forgot password? <a href="teabuyer_forgot_passwd.php" style="color: #F5F5F5;">Password</a></div>
		</div>
	</div>	
	<video autoplay muted loop>
	<source src="videos/Pexels Videos 2675515.mp4">
	</video>
	</form>
	
	
</body>

</html>
	
