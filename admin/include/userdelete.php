<?php
        session_start();
   
   include('../../includes/connect.php');
   require('../../includes/assets.php');

   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }



$user_id = $_POST['user_id'];
//echo $music_number;
$sql = "DELETE FROM users WHERE id ='$user_id'";
 $result = mysqli_query($con,$sql);

if($result) {
   echo "YES";
} else {
   echo "NO";
}
?>