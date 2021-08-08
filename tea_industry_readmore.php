
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
 

$sesion=$_SESSION['username'];
?>
<?php
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM company_profile  ");
?>
//---------------------------------------------------------------------------------
<?php
function get_all_locations(){
  
    $con=mysqli_connect ("localhost", 'root', '','ceylon_teahouse');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"
select *
from marker where type='Factory'
  ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
  $indexed = array_map('array_values', $rows);
  //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}
function array_flatten($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        }
        else {
            $result[$key] = $value;
        }
    }
    return $result;
}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" href="css/tea_industry.css">
	  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  
  <link href="css/blog-home.css" rel="stylesheet">
</head>

<body>
	<style>
	#example1 {
 
 padding: 350px;
background:url("images/teapic27.jpg");
padding-left: 750px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
	
	
<body>
<div id="example1">
	<p>Tea Industry Factory Details</p>

</div>
	<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM company_profile  WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['ind_name'];
    $timestamp = $res['product_type'];
    $age = $res['address'];
    $image = $res['image'];
    $dis = $res['discription'];
  
    $tell = $res['telll'];
   
    $email = $res['email'];
}

$result2 = mysqli_query($mysqli, "SELECT * FROM company_profile join membership on company_profile.ind_name=membership.industry_name WHERE id=$id and member_name='{$_SESSION['username']}' and status='1'");
 
$result3= mysqli_query($mysqli, "SELECT * FROM  company_profile c inner join collection_points f on c.ind_name=f.company_name WHERE c.id=$id");

?>

   

</body>
</html>