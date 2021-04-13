<?php
        session_start();
   
   include('../../../includes/connect.php');
   

   
   require('../../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
   
    if(isset($_SESSION['email'])){
     
   $email  =$_SESSION['email'];
   
   $query="SELECT * FROM `users` WHERE `email`= '$email' ";
   $user_data= mysqli_query($con,$query); 
                             
   while($row=mysqli_fetch_assoc($user_data))
   {  
   $id = $row['id'];
   } 
   }
   
    
    if(isset($_POST['action']) == 'domain_data'){ 
    
              $pattern = '/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/';
          $dname = trim($_POST['domainName']);
          $dpname = trim($_POST['domainProName']);
          $dpid = trim($_POST['domainProId']);
          $dppass = trim($_POST['domainProPass']);
        // $starting_date = date('y-m-d',strtotime($_POST['startingdate']));  
        // $expiry_date = date('y-m-d',strtotime($_POST['expirydate']));  
          $demail = trim($_POST["domainEmail"]);
          $dpass = trim($_POST["domainPass"]);
     
                       
                             if(empty($dname)) {
                                  echo "Please Enter Domain Name !";
                             }
                                elseif(!preg_match ( $pattern,$dname)){
                                 
                                   echo "please enter valid domain name";
                            
                             } 
                            
                             elseif(empty($dpid)) {
                                        echo "Please Enter Domain Provider Id !";
                             }
                             elseif(empty($dppass))
                             {
                                echo "Please Enter Domain Provider password !";
                             }
                             elseif(empty($_POST['startingdate'])){
                                echo "Please Enter Starting Date !";
                             }
                            elseif(empty($_POST['expirydate'])){
                                 echo "Please Enter Expiry Date !";
                            }
                            else{
                                         $starting_date = date('y-m-d',strtotime($_POST['startingdate']));  
                                         $expiry_date = date('y-m-d',strtotime($_POST['expirydate'])); 
                                
                                        $dname = mysqli_real_escape_string($con, $dname);
                                        $dpname = mysqli_real_escape_string($con, $dpname);
                                        $dpid = mysqli_real_escape_string($con,$dpid);
                                        $dppass = mysqli_real_escape_string($con,$dppass);
                                        $starting_date  = mysqli_real_escape_string($con,$starting_date);
                                        $expiry_date  = mysqli_real_escape_string($con,$expiry_date);
                                        $car_bin = '';
            
            
                              if (isset($_POST["checkbox"])) {
                                  
                                  $demail = mysqli_real_escape_string($con,$demail);
                                  $dpass = mysqli_real_escape_string($con, $dpass);

                           $query = "INSERT INTO `domain`(`user_id`,`domain_name`, `domain_provider_name`, `domain_provider_id`, `domain_provider_pass`,`starting_date`,`expiry_date`,`cf_email`,`cf_pass`)
                           VALUES ('$id','$dname','$dpname','$dpid','$dppass','$starting_date','$expiry_date','$demail','$dpass')";
                           
                           $domain_query = mysqli_query($con,$query);
                            
                                 if($domain_query){  ?>
                           <script> 
                     //    $('#form')[0].reset();
                         $('.alert').hide();
                        
                         Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "User Added Successfully",
                           type: "success"
                      
                       });
                         </script>
                            <?php     } else{
                                     echo("Error description: " . mysqli_error($con));
                                 }
                              }
                              else { 
                           $query2 = "INSERT INTO `domain`(`user_id`,`domain_name`, `domain_provider_name`, `domain_provider_id`, `domain_provider_pass`,`starting_date`,`expiry_date`)
                           VALUES ('$id','$dname','$dpname','$dpid','$dppass','$starting_date','$expiry_date' )";
                           
                                         $domain_query1 = mysqli_query($con,$query2);
                                         if($domain_query1){ ?>
                                                
                        <script> 
                       //  $('#form')[0].reset();
                         $('.alert').hide();
                                 
                         Swal.fire({
                           title: "User",
                           icon: "success",
                           text: "Domain Added Succesfully",
                           type: "success"
                      
                       });
                         </script>
                                                
                                <?php         }else{ 
                        echo("Error description: " . mysqli_error($con));
                                       }
                                 }
                            }
                  }
    
   ?>