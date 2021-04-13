<?php
   session_start();
   
   include('../../includes/connect.php');
   
   require('../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
    
        $status = $_POST['value'];
        $the_id = $_POST['id'];
        echo $status;
        echo $the_id;
        
         if($_POST["action"] == 'change_status'){
          
             $query = "UPDATE users SET user_status = '$status' WHERE id = '$the_id' ";
             
             $res=mysqli_query($con,$query);
              if($res){
                  echo "Status Changed";
              }else{
                  echo "error";
              }
         }
   ?>