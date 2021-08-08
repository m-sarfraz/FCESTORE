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
 
$databaseHost = 'localhost';
$databaseName = 'ceylon_teahouse';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if(isset($_GET["search"])){
    $search=$mysqli->escape_string($_GET["search"]);
    
    $results_per_page = 5;
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM blog where name Like '%$search%'");
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
$sql="SELECT * FROM blog where name Like '%$search%'";
    $result = mysqli_query($mysqli, $sql);

}
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
	<br><br>
	
	  <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
						<div class="row">
						
		          <div class="col-md-12 d-flex ftco-animate">
		            <div class="blog-entry align-self-stretch d-md-flex">
		            
		              <div class="text d-block pl-md-4">
		              	
                    <?php
                    if($number_of_results==0){echo ' <div class="container"> <div class="notice notice-warning">
                      <strong>SORRY</strong> No Resluts  <span class="pull-right text-warning readMore">Read</span>
                        <div class="desc">
                          
                          <p>
                          We couldn’t find any repositories matching <b>';echo $search; echo'</b>
                          </p>        
                      </div>
                  </div></div>';}else{

                    
        echo'<div style="color:Black;">';
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {   
        echo' </div>';
        $s=$res['image'];
        echo '<img src="images/'.$s.'" class="block-20" style="width:350px;height:170px;">';      
          echo '<h4><p><h3 class="heading">';
          echo "Name <t>"  .$res['name']."<br></h3>";  
          echo'<div class="meta mb-3">';
          echo'   <div><a href="#">';echo ""  .$res['timestamp']."";echo'</a></div>';
          echo'    <div><a href="#">';echo "<b>"  .$res['username']."";echo'</b></a></div>';
          echo'   <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>';
          echo '<p>'; echo " <t>"   .substr($res['post'],0,300)."</br></p>";
          echo "<a href=\"blog-single.php?id=$res[id]\">Read more....</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"></a><br>";    echo "</h4></p>";    
        }  
        echo '<br><br></div>';}?>
        
    
		              </div>
		            </div>
		          </div>
						</div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
             
            </div>
            <div class="sidebar-box ftco-animate">
            	<h3 style="padding-left: 85px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';" class="heading">ADD POSTS</h3>
              <ul class="categories">
              <form name="form1" method="post" action="insert_blog.php" class="p-5 bg-light">
              <div class="form-group">
                    
                    <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $sesion;?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Post Title*</label>
                    <input type="text" class="form-control" id="name" name="name" require>
                  </div>
                  <div class="form-group">
                    <label for="message">Post</label>
                    <textarea  id="message" cols="30" name="age" rows="10" class="form-control"require></textarea>
                  </div>

                  <div class="form-group">
                    <label for="website">Image</label>
                    <input type="file" name="image" accept="image/*" require>
                  </div>

                  <div class="form-group">
                 <input type="hidden" name="id" >
                    <input type="submit" name="submit" value="Post Blog Post" class="btn py-3 px-4 btn-success">
                  </div>

                </form>
              
              </ul>
            </div>
            <div class="sidebar-box ftco-animate">
               
           <div class="sidebar-box ftco-animate" style="padding-left: 70px;">
            <div class="container">
             <h3 class="heading"> Your blog post </h3>
             <p> You can edit , delete your uploaded blog posts</p> 
             <div class="col-lg-6 mb-5 ftco-animate" style="padding-left: 5px;">
               <a href="user-blog.php" >    <Button class="btn btn-success py-3 px-4" style="width: 150px;"  >Blog Posts</button></a>
									</div>
             </div>
             </div>
          </div>
             </div>
   
            
          </div>

        </div>
        
      </div>
      <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
        <ul><h4>More Posts</h4>
        <?php for ($page=1;$page<=$number_of_pages;$page++) {
        echo'<li class="active">';
          echo '<a class=""  href="blog.php?page=' . $page . '">' . $page . '</a> ';
          echo'</li>&nbsp';
        }
        ?>
        </ul>
        </div>
          </div>
        </div>
    </section> <!-- .section -->
</body>
</html>