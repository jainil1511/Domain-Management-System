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
         $sql="SELECT * FROM `users` WHERE `id`= '$id' ";
            $result = mysqli_query($con, $sql);  
         while($row = mysqli_fetch_array($result))  
         {
            $pin1 = $row['pin'];
          
         }  
  }
  if($pin == $pin1)
  {
      echo "same";
   }
    if($pin != $pin1)     
    {
            echo "Notequal";
    }
?>