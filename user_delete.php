
<?php
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
//getting id of the data from url
$id = $_GET['id'];
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM teabuyers_signup  WHERE user_id=$id");
//redirecting to the display page (index.php in our case)
header("Location:tables.php");
?>