<?php
   session_start();
   ob_start();
   include('../includes/connect.php');
   
   require('../includes/assets.php');
   
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] == 0){
       header("location: login.php");
       exit;
   }
   ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA--Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords"
         content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
      <meta name="description"
         content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
      <meta name="robots" content="noindex,nofollow">
      <title>Domain managment system</title>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.6/dist/sweetalert2.all.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.6/dist/sweetalert2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <?=$header_links ?>
      
         <link rel="preconnect" href="https://fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300&family=Rubik:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    
      <style>
         #submit{
         font-family: 'Ubuntu', sans-serif;
         width:100px;
         }
         hr{
         color:red;
         }
         h3{
         font-family: 'Ubuntu', sans-serif;
         }
         input::-webkit-outer-spin-button,
         input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
         }
         input[type=number] {
         -moz-appearance: textfield;
         }
         .error {
         color:#B22222;
         }
         .alert{
             display:none;
         }
         .slow .toggle-group { transition: left 0.5s; -webkit-transition: left 0.5s; }
      </style>
   </head>
   <body>
      <div class="preloader">
         <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
         </div>
      </div>
      <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
         data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
      <?php  include("../includes/header1.php"); ?>
      <aside class="left-sidebar" data-sidebarbg="skin6">
         <!-- Sidebar scroll-->
         <div class="scroll-sidebar">
            <?= $aside ?>
         </div>
      </aside>
         <div class="page-wrapper">
         <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
               <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                  <h4 class="page-title text-uppercase font-medium font-14">Add User</h4>
               </div>
               <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                  <div class="d-md-flex">
                     <ol class="breadcrumb ml-auto">
                        <li><a href="#">Add User</a></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
      <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                 
               
                  <div class="alert alert-danger" role="alert">
                     <strong id="error"></strong>
                  </div>
               
                  <form class="form-horizontal form-material" name="adduser" id="form"  method="post">
                     <h3 class="text-center" style="font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;">Add User</h3>
                     <div class="form-group mb-4">
                        <div class="row">
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">Email</label>
                              <input type="email" name="email" class="form-control  p-0 border-1" id="email" autocomplete="off" placeholder="Enter email ID">
                              <span id="emailid" class="text-danger font-weight-bold"></span>
                           </div>
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">Enter Your Pin</label>
                              <input type="number" name="user_pin" class="form-control  p-0 border-1" id="user_pin" autocomplete="off" placeholder="Enter a Specific  Pin">
                              <span id="user_pin1" class="text-danger font-weight-bold"></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-4">
                        <div class="row">
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">First Name</label>
                              <input type="text" name="firstname" id="firstname" style="display:block" id="firstname"  class="form-control p-0 border-1" autocomplete="off" placeholder="Enter first Name">
                              <span id="first" class="text-danger font-weight-bold"></span>
                           </div>
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">Last Name</label>
                              <input type="text" name="lastname" style="display:block" class="form-control  p-0 border-1" id="lastname"autocomplete="off" placeholder="Enter last name">
                              <span id="last" class="text-danger font-weight-bold"></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-4">
                        <div class="row">
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">Password</label>
                              <input type="password" class="form-control p-0 border-1" name="password" id="password"  placeholder="Enter Password">
                              <span id="passwords" class="text-danger font-weight-bold"></span>
                           </div>
                           <div class="input-field col s6">
                              <label class="col-md-6 p-0">Confirm Password</label>
                              <input type="password" name="confirmpassword" class="form-control p-0 border-1"  id="confirmpassword" autocomplete="off" placeholder="Enter Confirm Password">
                              <span id="conpassword" class="text-danger font-weight-bold"></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-12">
                        <div class="input-field col s6">
                           <center>  <input type="submit"  name="submit" id="submit" value="Submit" class="btn btn-success submit"></center>
                        </div>
                     </div>
                  </form>
                  <hr>
                  <h3 align="center">All User</h3>
                  <br />           
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="table-responsive">
                           <table id="user_data" class="table table-striped table-bordered" style=" font-family: 'Roboto', sans-serif; width:100%">
                              <thead>
                                 <tr>
                                    <td>Id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Action</td>
                                    <td>Password</td>
                                 </tr>
                              </thead>
                              <?php  
                                 $query ="SELECT *
                                 FROM users WHERE user_type
                                 NOT IN (1) ORDER BY id DESC";  
                                   $result = mysqli_query($con, $query);  
                                 while($row = mysqli_fetch_array($result))  
                                 { 
                                  $id1 =$row['id'];
                                  ?>
                              <tr>
                                 <td><?php  echo $row['id'] ?></td>
                                 <td><?php echo $row['firstname'] ," " ,$row['lastname'] ?> </td>
                                 <td><?php echo  $row['email'] ?></td>
                                 <td>
                                    <input type="hidden" name="value"  id="value" class="value" value="Enable" >
                                    <?php
                                       if($row['user_status'] == 'Enable'){
                                           
                                           ?>
                                    <input type = "checkbox"  data-id="<?php echo $row['id'];?>"  checked    data-size="small" data-style="slow" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" class ="status">
                                    <?php   }else{
                                       ?>
                                    <input type = "checkbox"  data-id="<?php echo $row['id'];?>"   data-size="small" data-style="slow" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" class ="status">
                                    <?php    }
                                       ?>
                                 </td>
                                 <td>
                                    <button type="button" data-id="<?php echo $row['id']; ?>" href="javascript:void(0)" class="btn btn-danger btn-sm btn1">show Password</button>
                                 </td>
                              </tr>
                              <?php 
                                 }  
                                 ?>  
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?=  $footer ?>
         </div>
      </div>
      <?= $footer_links; ?>
      <script>
         $("document").ready(function(){
            
            $(".status").change(function(){
                 if($(this).prop("checked")){
                   $("#value").val("Enable");
               }else{
                    $("#value").val("Disable");
               }
            
         var id = $(this).attr("data-id")
         var value = $("#value").val();
               console.log(id);
               console.log(value);
               var action = 'change_status';
           
              $.ajax({
               url:'include/userstatus.php',
               type: 'POST',
               data: { 
                   'id':id,
                   'value':value,
                   'action':action
                   },
               dataType: "text"
                   
             })
               .done(function(response){
                     Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "User Status Changed",
                           type: "success"
                       }).then(function() {
                           
                       });
           
               })
               .fail(function(){
                    swal.fire(response);
                });
                allowOutsideClick: false 
           
           
         });
          
         });      
             
         
      </script>
      <script>
         $(".btn1").click(function(e){
         var id = $(this).data('id');
            console.log(id);
         showPass(id);
         e.preventDefault();
         });
         function showPass(id){
         swal.fire({
         title: 'Admin',
        
         html:
          '<label style="font-size:20px; font-weight:bold">Please Enter Your Specific Pin</label>' +
         '<input id="swal-input1" class="swal2-input" placeholder="Enter a pin">',
         type: 'success',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Show Password',
         showLoaderOnConfirm: true,
         
         preConfirm: function() {
            return new Promise(function(resolve) {
             var pin = $('#swal-input1').val();
         $.ajax({
           url: 'include/passverfiy.php',
           type: 'POST',
           data: {'id': id , 'pin':pin},
           dataType: "text"
         })
         
         .done(function(response){
           swal.fire('User Password is:',response);
          })
         .fail(function(){
           swal.fire('Oops...', 'Something went wrong !', 'error');
         });
            });
         },
         allowOutsideClick: false     
         }); 
         }
      </script>
      <script>
      $("document").ready(function(){
          
           $("form[name='adduser']").validate({
            rules: {
                 email: {
                     required: true,
                      email: true
                 },
                 user_pin: {
                 required: true,
                 minlength: 4,
                 maxlength:4
               },
               firstname: "required",
               lastname:"required",
               password: {
                 required: true,
                 minlength: 3,
                 maxlength:20
               },
               confirmpassword:{
               required: true, equalTo: "#password", minlength: 3
               },
             },
             messages: {
                   email: {
                         required: "This field is required",
                         email: "please enter valid email "
               },
               user_pin: {
                 required: "This field is required",
                 minlength: "Your pin must be at least 4 number long",
                 maxlength:"only required 4 number"
                 
               },
                 firstname:"This field is required",
                 firstname:"This field is required",
                 password: {
                 required: "This field is required",
                 minlength:"Your password must be at least 3 characters long",
                 maxlength:"only require 20 character"
                 
               },
             
             },
             submitHandler: function(form) {
             // $("#form").load("click", function (e){
              //$("#form").click(function(e){
               // $("#form").on("click", function(e) {
                //    e.preventDefault();
                 var  email = $("#email").val();
                 var pin  = $("#user_pin").val();
                 var firstname = $('#firstname').val();
                 var lastname = $('#lastname').val();
                 var password = $('#password').val();
                 var confirmpassword = $('#confirmpassword').val();
                 var action = 'insert_data';
                  $.ajax({
                  url: "include/insertUser.php",
                  type: "POST",
                  dataType: "text",
                  data: { email: email, pin: pin, firstname: firstname, lastname: lastname,password:password, confirmpassword:confirmpassword ,action:action}
                 })
               .done(function(response){
                   $('.alert').show();
                   $('#error').html(response);
                   console.log(response);
                    
               })
               .fail(function(response){
                     console.log(response);
               });
             //});
                 return false;
              }
           });
     });
      </script>
      <script type="text/javascript"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
      <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
      <script>  
         $(document).ready(function(){  
              $('#user_data').DataTable();  
              
         });  
         
        
      </script> 
   </body>
</html>