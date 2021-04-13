<?php
   session_start();
   
   include('../../includes/connect.php');
   
   require('../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }

    
             $id = $_POST['id'];
             $pin  = $_POST['pin'];
         
        
             if(isset($_SESSION['email'])){
            
         $email  =$_SESSION['email'];
      
         $sql="SELECT * FROM `users` WHERE `email`= '$email' ";
            $result1 = mysqli_query($con, $sql);  
         while($row1 = mysqli_fetch_array($result1))  
         {
            $pin1 = $row1['user_pin'];
          
         }  
  }  
            $query1 = "SELECT * FROM `domain` WHERE `id` = '$id' ";
             $result1 = mysqli_query($con, $query1);  
               while($row1 = mysqli_fetch_array($result1))  
                  {
                     $password = $row1['domain_provider_pass'];
           
                 }  
                 if($pin == $pin1){
        echo "<h4>".$password."</h4>";
         }
         else{
             echo "Pin is Wrong";
         }
        
?>