
 <?php
 ob_start();
 
  session_start();
   
   include('../../includes/connect.php');
   
   require('../../includes/assets.php');
   
    
 $query = "SELECT * FROM domain"; 
    $result=mysqli_query($con,$query);

    $ResultSet = array();

    while ($row = mysqli_fetch_assoc($result)) {
       $ResultSet[] = $row;
    }
//print_r($ResultSet);
echo json_encode($ResultSet);
?>


