<?php
   session_start();
   
   include('../../includes/connect.php');
   
   require('../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
  if(isset($_SESSION['email'])){
            
         $email  =$_SESSION['email'];
      
         $sql="SELECT * FROM `users` WHERE `email`= '$email' ";
            $result1 = mysqli_query($con, $sql);  
         while($row1 = mysqli_fetch_array($result1))  
         {
            $pin1 = $row1['pin'];
          
         }  
  }     
    
             $id = $_POST['id'];
             $pin  = $_POST['pin'];
            $query = "SELECT * FROM `users` WHERE `id` = '$id' ";
             $result = mysqli_query($con, $query);  
         while($row = mysqli_fetch_array($result))  
         {
            $password = $row['password1'];
           // $pin1 = $row['pin'];
         }  
         if($pin == $pin1){
            
         echo "<h4>".$password."</h4>";
         }
         else{
             echo "Pin is Wrong";
         }
         
?>         