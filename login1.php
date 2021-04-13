


<?php
    session_start(); 
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title>log in</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500;700&display=swap" rel="stylesheet">
<style>
    body{
        margin:20px;
    }
    h1{
        font-family: 'Ubuntu', sans-serif;
        color:	#6A5ACD;
    }
    label{
         font-family: 'Ubuntu', sans-serif;
    
    }
    #submit{
        
         font-family: 'Ubuntu', sans-serif;
        width:100px;
    }
    
    
  
</style>
</head>
<body>
   
            <div class="text-center">
 
          <img src="images/home.png" height="150px" width="200px" alt="homepage" />
              </span>
            </div>
           
<div class="container"><br>
            
         
          
         <div class="col-lg-6 m-auto d-block">
            <h1 >Log In</h1>
            <hr></hr>
            
                             <?php
  $email = '';
    $password ='';
    $confirmpassword = '';
 
      include('includes/connect.php');

      $login = false;
      $message;
   
       
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmpassword = trim($_POST['confirmpassword']);
            
      if(empty($email) || empty($password) || empty($confirmpassword)){
 $error = "please provide email and password";   
} 
     
   else if(empty($email)){
     $error = "enter your email !";
    
 }
  else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
          {
             $error = "not valid email !";
             
            }
            
   elseif(empty($password)){
     $error = "Enter Your Password!";
    
 }
  elseif((strlen($password)<=5) || (strlen($password) >=20)){
             $error = "password length must be between 5 to 20 ";
             
         }
  elseif(empty($confirmpassword)){
     $error = "Enter Your confirm Password!";
    
 }
 elseif($password != $confirmpassword){
    $error = "password not matching";
    
 }

else
    {
          $password = mysqli_real_escape_string($con,$password); 
          $email =  mysqli_real_escape_string($con, $email);   
          $sql = "select * from users where email = '$email'";
          $result = mysqli_query($con,$sql);
          $num = mysqli_num_rows($result);
          if($num == 1){
            while($row = mysqli_fetch_assoc($result)){
               if(password_verify($password, $row['password'])){
                        $login = true;

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $password; 
                         if($row['user_type']=="1"){
                             ?>
                                  	<script>
			$(document).ready(function() {
				Swal.fire({
					title: "Admin Login",
					text: "LogIn successfully",
					type: "success"
				}).then(function() {
					window.location = "admin/dashboard.php";
				});
			});
		</script>
		<?php
             }else if($row['user_type']=="0"){?>
                          
            <script>
			$(document).ready(function() {
				Swal.fire({
					title: "User Login",
					text: "LogIn successfully",
					type: "success"
				}).then(function() {
					window.location = "admin/dashboard.php";
				});
			});
		</script>
		<?php
                          }
            }
          }
       }
       else{?>
       
        	<script>
			$(document).ready(function() {
				Swal.fire({
					title: "Login",
					text: "Something Went Wrong",
					type: "error"
				}).then(function() {
					window.location = "login.php";
				});
			});
		</script>
	
	<?php
       } 
}           
 }
                    
?>
 
            
            
            
            
            
            
            
            <?php
if(isset($error))
{
 ?>
    <div class="alert alert-danger" role="alert">
    <strong id="error"><?php echo $error; ?></strong>
    </div>
   
    <?php
}
?>


            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">   
            <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" id="email"autocomplete="off" placeholder="xxxxx@xxxxx.com">
                  <span id="emailid" class="text-danger font-weight-bold"></span>
               </div>

               <div class="form-group ">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" id="password"autocomplete="off" placeholder="*******">
                  <span id="passwords" class="text-danger font-weight-bold"></span>
               </div>
               <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="confirmpassword" class="form-control" id="confirmpassword"autocomplete="off" placeholder="*******">
                  <span id="conpassword" class="text-danger font-weight-bold"></span>
               </div>
               <center><input type="submit" name="login" id="submit" value="login" class="btn btn-primary"></center>


            </form>
         </div>
      </div>
      <script type="text/javascript">
         function validation(){

            var email1 = document.getElementById('email').value;
            var pass = document.getElementById('password').value;
            var conpass = document.getElementById('confirmpassword').value;
         
            if(email1 == ""){
               document.getElementById('emailid').innerHTML ="* please fill the emails ";
               return false;
            }
            if(email1.indexOf('@') <= 0){
               document.getElementById('emailid').innerHTML ="* @ Invalid Position ";
               return false;
            }
            if(pass == ""){
               document.getElementById('passwords').innerHTML ="* Plaese fill the password ";
               return false;
            }
            if((pass.length <= 5) || (pass.length > 20)){
               document.getElementById('passwords').innerHTML = "* Password length must be between 5 and 20 ";
               return false;
            }

            if(conpass == ""){
               document.getElementById('conpassword').innerHTML = "* please fill the confirm password"
               return false;
            }

            if(pass != conpass){ 
               document.getElementById('passwords').innerHTML ="* password are not matching"
               return false;
            }



         
         }
      </script>
      <?php

      include('includes/connect.php');

      $login = false;
      $message;
   
       if(isset($_POST['login']))
         {
      
         $email = trim($_POST['email']);
         $password = trim($_POST['password']);

          $email = stripcslashes($email);        
          $password = stripcslashes($password);
     
          if(!empty($password) && !empty($email)){
 
          $password = mysqli_real_escape_string($con,$password); 
          $email =  mysqli_real_escape_string($con, $email);   
          $sql = "select * from users where email = '$email'";
          $result = mysqli_query($con,$sql);
          $num = mysqli_num_rows($result);
          if($num == 1){
            while($row = mysqli_fetch_assoc($result)){
               if(password_verify($password, $row['password'])){
                        $login = true;

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $password; 
                         if($row['user_type']=="1"){
                             ?>
                                  	<script>
			$(document).ready(function() {
				Swal.fire({
					title: "Admin Login",
					text: "LogIn successfully",
					type: "success"
				}).then(function() {
					window.location = "admin/dashboard.php";
				});
			});
		</script>
		<?php
                          }else if($row['user_type']=="0"){?>
                          
            <script>
			$(document).ready(function() {
				Swal.fire({
					title: "User Login",
					text: "LogIn successfully",
					type: "success"
				}).then(function() {
					window.location = "admin/dashboard.php";
				});
			});
		</script>
		<?php
                          }
            }
          }
       }
       else{?>
       
        	<script>
			$(document).ready(function() {
				Swal.fire({
					title: "Login",
					text: "Something Went Wrong",
					type: "error"
				}).then(function() {
					window.location = "login.php";
				});
			});
		</script>
	
	<?php
       } 
}           
 }
                    
?>
 
</body>
</html>