
 <?php
 ob_start();
 
  session_start();
   
   include('../../includes/connect.php');
   
   require('../../includes/assets.php');
   
    
 $query = "SELECT id,firstname,lastname,email,password1,user_pin,user_status  FROM users WHERE user_type != 1"; 
    $result=mysqli_query($con,$query);

    $ResultSet = array();

    while ($row = mysqli_fetch_assoc($result)) {
       $ResultSet[] = $row;
    }
//print_r($ResultSet);
echo json_encode($ResultSet);
?>