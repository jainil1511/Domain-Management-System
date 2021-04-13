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
    1 => 'firstname',
    2 =>'lastname',
    3 => 'email',
    );
    
    $sql ="SELECT *  FROM users";
    $query = mysqli_query($con,$sql);
    $totalData = mysqli_num_rows($query);
    
    $totalFilter = $totalData;
    
   //$sql ="SELECT * FROM users WHERE 1=1";
 $sql = "SELECT *  FROM users WHERE user_type NOT IN (1)  AND 1 = 1";
if(!empty($request['search']['value'])){
    $sql.=" AND (id Like '".$request['search']['value']."%' ";
    $sql.=" OR firstname Like '".$request['search']['value']."%' ";
    $sql.=" OR lastname Like '".$request['search']['value']."%' ";
    $sql.=" OR email Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

    $query=mysqli_query($con,$sql);
    
    $data = array();
    
     
    
    while($row = mysqli_fetch_array($query)){
        $subdata = array();
        $subdata[] = $row['id'];
        $subdata[] = $row['firstname']." ".$row['lastname'];
        
        $subdata[] = $row["email"];
         
     if($row["user_status"] == 'Enable'){
      $subdata[] = " <input type='hidden' name='value'  id='value' class='value' value='Enable'>
      <input type = 'checkbox'  data-id= $row[0]  checked    data-size='small' data-style='slow' data-toggle='toggle' data-on='Enable' data-off='Disable' data-onstyle='success' data-offstyle='danger' class ='status'>";
      }
    else{
                                      
       $subdata[]  = " <input type='hidden' name='value'  id='value' class='value' value='Enable'>
       <input type = 'checkbox'  data-id= $row[0]   data-size='small' data-style='slow' data-toggle='toggle' data-on='Enable' data-off='Disable' data-onstyle='success' data-offstyle='danger' class ='status'>";
        } 
                                   
   
        $subdata[] = "<button type='button' data-id=$row[0] href='javascript:void(0)' style='float: right;'  class='btn btn-danger btn-sm btn1'><i class='fas fa-key'></i></button>";
          $subdata[] = "<button class='btn btn-sm btn-info updateUser' style='margin-left:10px;' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal'>Update</button><button type='button' data-id=$row[0] style='float: right;'  class='btn btn-danger btn-sm btn2' ><i class='fas fa-trash'></i></button>";
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
       $record = mysqli_query($con,"SELECT * FROM users WHERE id=".$id);

    $response1 = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response1 = array(
         "id" => $row['id'],
         "firstname" => $row['firstname'],
         "lastname"  => $row['lastname'],
         "email"  => $row['email'],
         "password1"  => $row['password1'],
         "password"  => $row['password'],
         "user_pin"  => $row['user_pin']
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
     $record = mysqli_query($con,"SELECT * FROM users WHERE id=".$id);

    if(mysqli_num_rows($record) > 0){
            
                   $firstname = mysqli_escape_string($con,$_POST['firstname']);
                   $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
                     $email = mysqli_real_escape_string($con,$_POST['email']);
                     $password = mysqli_real_escape_string($con,$_POST['password']);
                      $password1 = password_hash($password, PASSWORD_ARGON2I);
                        $pin = mysqli_real_escape_string($con,$_POST['pin']);
            
            
             if(empty($email)){
                     echo json_encode(array("status" => 0,"message" => "Please Fill email") );
                      exit;
                     }
                     else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
                     {
                     echo json_encode(array("status" => 0,"message" => "Please Enter Valid") );
                      exit;
                    
                     }
                      elseif(empty($pin)){
                       echo json_encode(array("status" => 0,"message" => "Please Enter Pin") );
                    
                     } 
                    else if(empty($firstname))
                     {
                    echo json_encode(array("status" => 0,"message" => "Please Enter First Name") );
                    
                   
                     }
                    else if(empty($lastname)){
                     echo json_encode(array("status" => 0,"message" => "Please Enter Last Name") );
                    
                    
                     }
                      else if(empty($password)){
                    echo json_encode(array("status" => 0,"message" => "Please Enter password") );
                    
                    
                     
                     }
                     else if((strlen($password) < 3) || (strlen($password) > 20)){
                     echo  "password length must be between 3 to 20 ";

                    }else{
                        
    $query1 = "UPDATE users SET firstname ='".$firstname."', lastname='".$lastname."',password1 = '".$password."' ,password = '".$password1."',
user_pin = '".$pin."', email = '".$email."' WHERE id=".$id;
     $done_query = mysqli_query($con,$query1);
     if($done_query){
          echo json_encode(array("status" => 1,"message" => "Data updated") );
                  exit;
     }else{
          echo json_encode(array("status" => 0,"message" => "Erorr") );
                  exit;
     }
        
                    }
    }
    }
    
?>