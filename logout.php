<?php include "header.php"?>
<?php
    // print_r($_SESSION['UserData']);exit;
   if(isset($_SESSION['UserData'])){
        
        // print_r($_SESSION['UserData']);

       session_destroy();
      
       header('location: index.php');
   }
   else{
       header('location: index.php');
   }
?>