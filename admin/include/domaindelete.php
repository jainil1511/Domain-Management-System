<?php
        session_start();
   
   include('../../includes/connect.php');
   require('../../includes/assets.php');

   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }



$id = $_POST['id'];

$sql = "DELETE FROM domain WHERE id ='$id'";
 $result = mysqli_query($con,$sql);

if($result) {
   echo "YES";
} else {
   echo "NO";
}
?>