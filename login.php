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
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords"
         content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
      <meta name="description"
         content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
      <meta name="robots" content="noindex,nofollow">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
   
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
        background-color:	#6A5ACD;
         font-family: 'Ubuntu', sans-serif;
        width:100px;
    }
        .error {
      color:#B22222;
        }
</style>
</head>
<body>
   <!-- <div class="text-center">
      <img src="images/home.png" height="150px" width="200px" alt="homepage" />
      </span> -->
   </div>
   <div class="container">
   <br>
   <div class="col-lg-6 m-auto d-block">
   <h1 >Log In</h1>
   <hr>
   </hr>         <?php

      include('includes/connect.php');

      $login = false;
      $message;
   
       
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $email = trim($_POST['email']);
        $password = trim($_POST['password']);

            
    if(empty($email)){
     $error = "enter your email !";
    
 }
  else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
          {
             $error = "not valid email !";
             
            }
            
   elseif(empty($password)){
     $error = "Enter Your Password!";
    
 }
  elseif((strlen($password)< 3) || (strlen($password) > 20)){
             $error = "password length must be between 3 to 20 ";
             
}
else
    {
          $password = mysqli_real_escape_string($con,$password); 
          $email =  mysqli_real_escape_string($con, $email);   
      ////    $sql = "select * from users where email = '$email' AND user_status NOT IN ('disable')";
          $sql  = "select * from users where email = '$email' AND NOT user_status = 'disable' ";
          $result = mysqli_query($con,$sql);
          $num = mysqli_num_rows($result);
                     if($num == 1){
                                      while($row = mysqli_fetch_assoc($result)){
                                           $_SESSION['user_type'] = $row['user_type'];
                                             if(password_verify($password, $row['password'])){
                                                $login = true;
                                            
                                                       if($row['user_type']=="1"){
                                                              $_SESSION['user_type'];
                                                               $_SESSION["email"] = $email; 
                                                                $_SESSION["loggedin"] = true;
                                                             
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
                                                            }else if($row['user_type']=="0"){
                                                            $_SESSION['user_type'];
                                                             $_SESSION["id"] = $id;
                                                            $_SESSION["email"] = $email; 
                                                             $_SESSION["loggedin"] = true;
                                                          ?>
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
                                                
                                                   
                                             }else{
                                                  
                                                       $error = "Please Enter Valid Password"; 
                                             }
                                                      
           
          }
       }
       else{
           
              $error = "Email Not Registered"; 
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

            
        <form method="post" id="form" name="frm1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
   <center><input type="submit" name="submit" id="submit" value="Log In" class="btn btn-primary"></center>
</form>
</div>
</div>
<script type="text/javascript">
                     
$(function() {
              
jQuery.validator.addMethod("validate_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email Address.");


  $("form[name='frm1']").validate({
  
  
  
   
    rules: {
        
       	email: {
			  required: true,
			validate_email: true
		  },
        password:{
           required: true,
           minlength: 3,
           maxlength:20
      },
      
    },
       messages: {
                  email: {
				    required: "This field is required",
	},
        password: {
          required: "This field is required",
          minlength: "Your password must be at least 3 characters long",
          maxlength:"Your Password must be only 20 character long",
      },
     },
    submitHandler: function(form) {
      form.submit();
     }
  });
});      

    </script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
</body>
</html>




