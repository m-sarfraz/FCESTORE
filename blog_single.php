<?php include("header.php") ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: teabuyers_login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: teabuyers_login.php");
  }

?>
<?php
$sesion=$_SESSION['username'];
?>
<?php
// including the database connection file
//including the database connection file
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM blog ");
$result2 = mysqli_query($mysqli, "SELECT * FROM blog where username='{$_SESSION['username']}'  ");  
$id=$_GET['id'];// using mysqli_query instead
$result3 = mysqli_query($mysqli, "SELECT * FROM blog_comment where post_id='$id' ");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<style>
	#example1 {
 
 padding: 320px;
background:url("images/teapic45.jpg");
padding-left: 820px;
font-size: 32px;	
color: aliceblue;
font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";

background-repeat: no-repeat;
background-position:center;
background-size: cover;
height: 600px;
}
	
</style>
</head>

<body>
	<div id="example1">


		
</div>
	<br>
	
	 <section class="ftco-section ftco-degree-bg" style="background-color:wheat;">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
          <?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM blog WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $name = $res['name'];
    $timestamp = $res['timestamp'];
    $age = $res['post'];
    $image = $res['image'];
}
?>

   
    
    <form name="form1" method="post" action="blog-single.php">
        <table border="0">
            <tr>
           
                <td><input type="hidden" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="age" value="<?php echo $age;?>"></td>
            </tr>
            <tr>
               
                <td><input type="hidden" name="image" value="<?php echo $image;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="hidden" name="update" value="Update"></td>
            </tr>
        </table>
    </form>

						<h2 class="mb-3"><?php echo $name;?></h2>
            <p><?php echo $timestamp;?></p>
            <p><?php echo $age;?></p>
            <p>
            <img src="images/<?php echo $image;?>" class="block-20" style="width:700px;height:400px;">
             
            </p>
            
            <h3 class="mb-5" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';"> Comments</h3><div class="pt-5 mt-5">
            <?php
         //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
          
          while($res = mysqli_fetch_array($result3)) {  


         
    
         echo'   <ul class="comment-list">';
         echo'     <li class="comment">';
         echo'     <div class="vcard bio">';
         echo'       <img src="images/teapic46.png" alt="Image placeholder">';
         echo'    </div>';
         echo'     <div class="comment-body">';
         echo'       <h3>';echo ""  .$res['name']."";echo'</h3>';
         echo'       <div class="meta">';echo ""  .$res['timestamp']."";echo'</div>';
         echo ""  .$res['comment']."";     
         
         echo'     </div>
                </li>';

          }?>

                
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">Leave a comment</h3>
                <form action="blog_comment.php" class="p-5 bg-light" method="post">
                  <div class="form-group">
                  
                    <input type="hidden" class="form-control" name="name"  value=<?php echo $sesion;?> id="name">
                  </div>
                  <div class="form-group">
                    
                    <input type="hidden" name="id" class="form-control" id="name" value=<?php echo $_GET['id'];?> >
                  </div>
                  
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="Post Comment" class="btn py-3 px-4 btn-success" >
                  </div>

                </form>
              </div>
            </div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
           
            <div class="sidebar-box ftco-animate" style="background-color:#38BDA2;">
            	<h3 class="heading" style="padding-left: 100px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">ADD POSTS</h3>
              <ul class="categories">
              <form name="form1" method="post" action="bloginsert.php" class="p-5 bg-light">
              <div class="form-group">
                    
                    <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $sesion;?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Post Title*</label>
                    <input type="text" class="form-control" id="name" name="name" required/>
                  </div>
                  <div class="form-group">
                    <label for="message">Post</label>
                    <textarea  id="message" cols="30" name="age" rows="10" class="form-control"></textarea >
                  </div>

                  <div class="form-group">
                    <label for="website">Image</label>
                    <input type="file" name="image" accept="image/*" required/>
                  </div>

                  <div class="form-group">
                 <input type="hidden" name="id" >
                    <input type="submit" name="submit" value="Post Blog Post" class="btn py-3 px-4 btn-success" style="font-family: ">
                  </div>

                </form>
              
              </ul>
            </div>
           
          </div>

        </div>
      </div>
    </section> 

<!-- Footer -->
<footer class="page-footer font-small unique-color-dark" style="background-color:#FFF;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content --><br />
        <h6 class="text-uppercase font-weight-bold">Ceylon Teahouse</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Main purpose of this system is providing communication system to plantation industry. Incresing the productivity, make good products and Easily day to day works are othe benfits of this system</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
<br />
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Products</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">TEA PLANTS</a>
        </p>
        <p>
          <a href="#!">TEA EQUIPMENTS</a>
        </p>
        <p>
          <a href="#!">TEA FERTILIZERS</a>
        </p>
        <p>
          <a href="#!">TEA BAGS</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links --><br />
        <h6 class="text-uppercase font-weight-bold">Useful links</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">Your Account</a>
        </p>
        <p>
          <a href="#!">Become an Affiliate</a>
        </p>
        <p>
          <a href="#!">Shipping Rates</a>
        </p>
        <p>
          <a href="#!">Help</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links --><br />
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> SRI LANKA, KELANIYA</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> CEYLONTEAHOUSE99@gmail.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
        <p>
          <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <li style="padding-left:680px;"><img src="images/payment-footer-update.png"; /></li>
 
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> ceylonteahouse99@gmail.com</a>
  </div>
  <!-- Copyright -->

</footer>
</body>
</html>