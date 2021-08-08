
<?php 
    session_start();
   
   
        session_destroy();
        
        header("location: teabuyers_logout.php");
    
?>