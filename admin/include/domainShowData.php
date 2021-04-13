 <?php
        session_start();
   
   include('../../includes/connect.php');
   require('../../includes/assets.php');

   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }

    $request = 1;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}
if($request == 1){
$request = $_REQUEST;
$col  = array(
    0 => 'id',
    1 => 'domain_name',
    2 =>'domain_provider_name',
    3 => 'domain_provider_id',
    );
    
    $sql ="SELECT *  FROM domain";
    $query = mysqli_query($con,$sql);
    $totalData = mysqli_num_rows($query);
    
    $totalFilter = $totalData;
    
   //$sql ="SELECT * FROM users WHERE 1=1";
 $sql = "SELECT *  FROM domain  WHERE 1 = 1";
if(!empty($request['search']['value'])){
    $sql.=" AND (id Like '".$request['search']['value']."%' ";
    $sql.=" OR domain_name Like '".$request['search']['value']."%' ";
    $sql.=" OR domain_provider_name Like '".$request['search']['value']."%' ";
    $sql.=" OR domain_provider_id Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

    $query=mysqli_query($con,$sql);
    
    $data = array();
    
    while($row = mysqli_fetch_array($query)){
         $user_id  = $row['user_id'];
         
          $query2  = "SELECT * FROM users WHERE id = $user_id";
          $result2 = mysqli_query($con,$query2);
          while($row2 = mysqli_fetch_array($result2))
          $email = $row2['email'];    
          $s1 = $row['starting_date'];
          $s2 = date(strtotime($row['expiry_date']));
     
         
        $subdata = array();
        $subdata[] = $row['id'];
        $subdata[] = $email;
        $subdata[] = $row['domain_name']."<br><b>Cloudfare</b><br><b>Email</b><br>".$row['cf_email']."<b> Password</b><br>".$row['cf_pass'];
        $subdata[] = "<b>Provider Name:</b><br> ".$row['domain_provider_name']."<br><b> ID:</b><br>".$row['domain_provider_id']."<br><b>Password</b> <button type='button' style='margin-top:10px;' data-id=$row[0] href='javascript:void(0)' style='float: right;' class='btn btn-danger btn-sm btn1'><i class='fas fa-key'></i></button>";
      
        $subdata[] =  "<b>StartDate:</b><br>".$row['starting_date']."<br><b>ExpiryDate:</b><br>".$row['expiry_date'];      
           /* $timestamp = strtotime('today midnight');*/
       $timestamp = strtotime('today midnight');
            $diff = abs($s2 - $timestamp);
            $diff /= 60 * 60 * 24;
 

          /*  $days_between = (abs($s2 - $timestamp) / 86400);*/
            $subdata[] = ceil($diff);
            
           
            
            
        if($row["domain_status"] == 'Enable'){
      $subdata[] = " <input type='hidden' name='value'  id='value' class='value' value='Enable'>
      <input type = 'checkbox'  data-id= $row[0]  checked    data-size='small' data-style='slow' data-toggle='toggle' data-on='Enable' data-off='Disable' data-onstyle='success' data-offstyle='danger' class ='status'>";
      }
    else{
                                      
       $subdata[]  = " <input type='hidden' name='value'  id='value' class='value' value='Enable'>
       <input type = 'checkbox'  data-id= $row[0]   data-size='small' data-style='slow' data-toggle='toggle' data-on='Enable' data-off='Disable' data-onstyle='success' data-offstyle='danger' class ='status'>";
        } 
        
        
        if($row["flag"] == 'on'){
      $subdata[] = " <input type='hidden' name='value1'  id='value1' class='value' value='on'>
      <input type = 'checkbox'  data-id= $row[0]  checked  data-size='small' data-style='slow' data-toggle='toggle' data-on='on' data-off='off' id='toggle-demo' data-offstyle='danger' class ='flag'>";
      }
    else{
                                      
       $subdata[]  = " <input type='hidden' name='value1'  id='value1' class='value' value='on'>
       <input type = 'checkbox'  data-id= $row[0]   data-size='small' data-style='slow' data-toggle='toggle' data-on='on' data-off='off' id='toggle-demo'data-offstyle='danger'  class ='flag'>";
        } 
           
       $subdata[] =  "<button class='btn btn-sm btn-info updateUser' style='margin-left:10px;' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal'>Update</button><button type='button' style='margin-bottom:30px; float:right; margin-top:10px;' data-id=$row[0] style='float: right;'  class='btn btn-danger btn-sm btn2' ><i class='fas fa-trash'></i></button>";      
        $data[] = $subdata;
    }
        
        $json_data = array(
        "draw" => intval($request['draw']),
        "recordsTotal"    => intval( $totalData ),
        "recordsFiltered" => intval( $totalFilter ),
        "data" => $data
            
    );
    echo json_encode($json_data);
    exit;
}

    if($request == 2){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }
        $record = mysqli_query($con,"SELECT * FROM domain WHERE id=".$id);

    $response1 = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response1 = array(
         "userid" => $row['user_id'],
         "domainName" => $row['domain_name'],
         "domainProviderName"  => $row['domain_provider_name'],
         "domainid"  => $row['domain_provider_id'],
         "domainpass"  => $row['domain_provider_pass'],
         "startdate"  => $row['starting_date'],
         "expirydate"  => $row['expiry_date'],
         "cemail"  => $row['cf_email'],
         "cpass"  => $row['cf_pass']
        );

        echo json_encode( array("status" => 1,"data" => $response1) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
    }
    
     
    if($request == 3){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }  
     $record = mysqli_query($con,"SELECT * FROM domain WHERE id=".$id);
    $starting_date = '';
   $expiry_date  = '';
    if(mysqli_num_rows($record) > 0){
                  $uid  = mysqli_escape_string($con,$_POST['uid']);
                   $dname = mysqli_escape_string($con,$_POST['dname']);
                   
                   $dopname = mysqli_real_escape_string($con,$_POST['dopname']);
                     $dpid = mysqli_real_escape_string($con,$_POST['dpid']);
                     $dppass = mysqli_real_escape_string($con,$_POST['dppass']);
        
                 $sdate = date('y-m-d',strtotime($_POST['s1']));  
                 $edate = date('y-m-d',strtotime($_POST['s2']));  
                 $s11 = mysqli_real_escape_string($con,$sdate);
                 $s12 = mysqli_real_escape_string($con,$edate);   
                 $clemail =mysqli_real_escape_string($con,$_POST['clemail']);
                 $clpass =mysqli_real_escape_string($con,$_POST['clpass']);
                  $pattern = '/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/';
    
                             if(empty($uid)){
                                     echo json_encode(array("status" => 0,"message" => "Please Select User"));
                              exit;
                             
                             }
                             elseif(empty($dname)) {
                                      echo json_encode(array("status" => 0,"message" => "Please Enter Domain Name!"));
                              exit;
                             
                             }
                           
                             elseif(!preg_match ( $pattern,$dname)){
                                 
                                          echo json_encode(array("status" => 0,"message" => "Please Enter valid  Domain Name!"));
                              exit;
                             
                                 //^(\.)+[A-Za-z]{2,6}$  regex checked valid but in this not valid
                                 ///^(\.(com|net))?$/  valid
                             }   
                             elseif(empty($dopname)) {
                                            echo json_encode(array("status" => 0,"message" => "Please Enter Domain Provider Name!"));
                              exit;
                                      
                             }
                             elseif(empty($dpid)) {
                                 echo json_encode(array("status" => 0,"message" => "Please Enter Domain Provider Id !"));
                              exit;
                                      
                             }
                             elseif(empty($dppass))
                             {
                                     echo json_encode(array("status" => 0,"message" => "Please Enter Domain Provider password !") );
                              exit;
                              
                             }
                             elseif(empty($s11)){
                                                     echo json_encode(array("status" => 0,"message" => "Please Fill Starting Date") );
                              exit;
                             }
                            elseif(empty($s12)){
                                  echo json_encode(array("status" => 0,"message" => "Please Fill Expiry Date") );
                  exit;
                            }else{
                         
     
  if (isset($_POST["checkbox1"])) {
    
    $query1 = "UPDATE domain SET user_id ='".$uid."', domain_name='".$dname."',domain_provider_name = '".$dopname."' ,domain_provider_id = '".$dpid."',
domain_provider_pass = '".$dppass."',starting_date = '".$s11."',expiry_date = '".$s12."',cf_email ='".$clemail."',cf_pass ='".$clpass."' WHERE id=".$id;
     $domain_query = mysqli_query($con,$query1);
      }
      else{                                  
                                             
$query2 = "UPDATE domain SET user_id ='".$uid."', domain_name='".$dname."',domain_provider_name = '".$dopname."' ,domain_provider_id = '".$dpid."',
domain_provider_pass = '".$dppass."',starting_date = '".$s11."',expiry_date = '".$s12."' WHERE id=".$id;
     $domain_query = mysqli_query($con,$query2);
        }
       if(!$domain_query){
                echo json_encode(array("status" => 0,"message" => "Erorr") );
                  exit;
      }else{
              echo json_encode(array("status" => 1,"message" => "Data updated") );
                  exit;
          }
    }
    }
    }
    ?>