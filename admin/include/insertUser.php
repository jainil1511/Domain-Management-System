<?php
        session_start();
   
   include('../../includes/connect.php');
   

   
   require('../../includes/assets.php');
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
                     $firstname = '';
                     $lastname ='';
                     $email = '';
                     $password ='';
                     $confirmpassword = '';
                     $user_pin = '';
                     
                     if(isset($_POST['action']) == 'insert_data'){
                         
                     $firstname = trim($_POST['firstname']);
                     $lastname = trim($_POST['lastname']);
                     $email = trim($_POST['email']);
                     $password = trim($_POST['password']);
                     $confirmpassword = trim($_POST['confirmpassword']);
                     $user_pin = trim($_POST['pin']);
                     ///$sql_e = "SELECT * FROM users WHERE email='$email'";
                ///	$res_e = mysqli_query($con, $sql_e);
                    if(empty($email)){
                      echo "enter your email !";
                      exit;
                     }
                     else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
                     {
                     echo "not valid email !";
                    
                     }
                      elseif(empty($user_pin)){
                      echo "enter your Pin !";
                    
                     } 
                    else if(empty($firstname))
                     {
                     echo "enter your firstname !";
                   
                     }
                    else if(empty($lastname)){
                      echo  "enter your lastname !";
                    
                     }
                      else if(empty($password)){
                    echo "Enter Your Password!";
                     
                     }
                     else if((strlen($password) < 3) || (strlen($password) > 20)){
                     echo  "password length must be between 3 to 20 ";

                    }
                     else if($password != $confirmpassword){
                     echo  "password not matching";
                     
                     }
                     /*else if(mysqli_num_rows($res_u) > 0){
                        echo  "Sorry... email already taken";
                     }*/
                     
                     else{
                                
                      $firstname = mysqli_real_escape_string($con, $firstname);
                     $lastname = mysqli_real_escape_string($con, $lastname);
                     $password = mysqli_real_escape_string($con,$password);
                     $password1 = password_hash($password, PASSWORD_ARGON2I);  
                     $email =  mysqli_real_escape_string($con, $email);
                     $user_pin = mysqli_real_escape_string($con,$user_pin);
       $query = "INSERT INTO users(`firstname`, `lastname`, `password`,`password1`, `email`,`user_pin`) VALUES ('$firstname','$lastname','$password1','$password','$email','$user_pin')";
                     
                     $register_user_query = mysqli_query($con,$query);
                     if(!$register_user_query){
                         echo "Error";
                        
                     }else{
                         ?>
                         <script>
                        $(document).ready(function() {
                         $('#form')[0].reset();
                         $('.alert').hide();
                         Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "User Added Successfully",
                           type: "success"
                         })
                        });
                         </script>
                     <?php  }
                     } 
                     }

?>