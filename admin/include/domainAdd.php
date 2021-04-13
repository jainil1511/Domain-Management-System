<?php
        session_start();
   
   include('../../includes/connect.php');
   

   
   require('../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
    
  
    
        $userid  = '';
         $dname = '';
         $dpname = '';
        $dpid = '';
        $dppass = '';
        $starting_date = '';
        $expiry_date  = '';
        $demail = '';
        $dpass = '';
    
    $pattern = '/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/';
    
    if(isset($_POST['action']) == 'domain_data'){ 
    
          $userid = trim($_POST['userid']);
          $dname = trim($_POST['domainName']);
          $dpname = trim($_POST['domainProName']);
          $dpid = trim($_POST['domainProId']);
          $dppass = trim($_POST['domainProPass']);
         //$starting_date = date('y-m-d',strtotime($_POST['startingdate']));  
        //$expiry_date = date('y-m-d',strtotime($_POST['expirydate']));  
          $demail = trim($_POST["domainEmail"]);
          $dpass = trim($_POST["domainPass"]);
                                    
                           if(empty($userid)){
                                  echo "Please select user!";
                                  
                             }
                             elseif(empty($dname)) {
                                  echo "Please Enter Domain Name !";
                             }
                           
                             elseif(!preg_match ( $pattern,$dname)){
                                 
                                   echo "please enter valid domain name";
                             
                                 //^(\.)+[A-Za-z]{2,6}$  regex checked valid but in this not valid
                                 ///^(\.(com|net))?$/  valid
                             }   
                             elseif(empty($dpname)) {
                                        echo "Please Enter Domain Provider Name !";
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
                                
                                    $s1 = date('y-m-d',strtotime($_POST['startingdate']));  
                                    $s2 = date('y-m-d',strtotime($_POST['expirydate']));  
                                             
                                        $userid = mysqli_real_escape_string($con, $userid);
                                        $dname = mysqli_real_escape_string($con, $dname);
                                        $dpname = mysqli_real_escape_string($con, $dpname);
                                        $dpid = mysqli_real_escape_string($con,$dpid);
                                        $dppass = mysqli_real_escape_string($con,$dppass);
                                        $starting_date  = mysqli_real_escape_string($con,$s1);
                                        $expiry_date  = mysqli_real_escape_string($con,$s2);
                                        $car_bin = '';
            
            
                              if (isset($_POST["checkbox"])) {
                                         
                                             
                                  $demail = mysqli_real_escape_string($con,$demail);
                                  $dpass = mysqli_real_escape_string($con, $dpass);

                           $query = "INSERT INTO `domain`(`user_id`,`domain_name`, `domain_provider_name`, `domain_provider_id`, `domain_provider_pass`,`starting_date`,`expiry_date`,`cf_email`,`cf_pass`)
                           VALUES ('$userid','$dname','$dpname','$dpid','$dppass','$starting_date','$expiry_date','$demail','$dpass' )";
                           
                           $domain_query = mysqli_query($con,$query);
                            
                                 if($domain_query){
                                 
                                 ?>
                           <script> 
                    //     $('#form')[0].reset();
                         $('.alert').hide();
                                 
                         Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "Domain Added Successfully",
                           type: "success"
                      
                       });
                         </script>
                         
                            <?php   
                                                          
                                                    } else{
                                     echo("Error description: " . mysqli_error($con));
                                 }
                              }
                              else { 
                                  
                           $query2 = "INSERT INTO `domain`(`user_id`,`domain_name`, `domain_provider_name`, `domain_provider_id`, `domain_provider_pass`,`starting_date`,`expiry_date`)
                           VALUES ('$userid','$dname','$dpname','$dpid','$dppass','$starting_date','$expiry_date' )";
                           
                                         $domain_query1 = mysqli_query($con,$query2);
                                         if($domain_query1){ 
                                         

                                         ?>
                                                
                                                                <script> 
                         
                         $('.alert').hide();
                         
                         Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "Domain Added Successfully",
                           type: "success"
                      
                       });
                         </script>
                                                
                                <?php  
  
                                         }else{ 
                        echo("Error description: " . mysqli_error($con));
                                       }
                                 }
                            }
                  }
    
   ?>