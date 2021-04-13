<?php
   session_start();
   ob_start();
   include('../includes/connect.php');
   
   require('../includes/assets.php');
   
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] == 0){
       header("location: ../login.php");
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
        .error1 {
         color:#B22222;
         }
         
         .alert1{
             display:none;
         }
         .slow .toggle-group { transition: left 0.5s; -webkit-transition: left 0.5s; }
         .dataTables_wrapper .dataTables_paginate .paginate_button
             {
             padding:0;
             }
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
                              <input type="text" name="user_pin" class="form-control  p-0 border-1"  max="9999" maxlength="4" id="user_pin" autocomplete="off" placeholder="Enter a Specific  Pin">
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
                       <?php
                      if(isset($_SESSION['email'])){
                           $email  =$_SESSION['email'];
                                                     $query="SELECT * FROM `users` WHERE `email`= '$email' ";
                            $user_data= mysqli_query($con,$query); 
                          while($row=mysqli_fetch_assoc($user_data)){
                          $id  = $row['id'];
                          }
                        
                      }
                     ?>  
                  
                          <a  href='javascript:void(0)'  data-id="<?php  echo $id; ?>" name="ecsv" id="ecsv" style="margin-bottom:10px; color:white;" class="btn btn-success pull-right">Export CSV</a>
                        
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="table-responsive">
                                    <table id="user_data" class="table table-striped table-bordered" style=" font-family: 'Roboto', sans-serif; width:100%">
                              <thead>
                                 <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    <th>Password</th>
                                    <th>Delete</th>
                                 </tr>
                              </thead>
                       
                           </table>
                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            
            <!--- MODEL START ------->
            
            
            
     <div id="updateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
       
          <button type="button" height="30px;" style="margin-bottom:10px;"class="close" id="close"  data-dismiss="modal">&times;</button>
          
         <center> <h4 class="modal-title"  style="color:Grey; font-family: 'Roboto', sans-serif;
                              font-family: 'Rubik', sans-serif;">Update User Details</h4></center>
    
        <div class="modal-body">
         
                        <form class="form2" id="form2"  method="post"> 
                         <div class="alert alert1 alert-danger" role="alert">
                           <strong id="error1"></strong></strong>
                        </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-6 p-0">Email</label>
                              <input type="email" name="updateemail" class="form-control  p-0 border-1" id="updateemail" autocomplete="off" placeholder="Enter email ID">
                            </div>
                            
                             <div class="form-group col-md-6">
                             <label class="col-md-6 p-0">Enter Your Pin</label>
                              <input type="text" name="update_user_pin" class="form-control  p-0 border-1"  max="9999" maxlength="4" id="update_user_pin" autocomplete="off" placeholder="Enter a Specific  Pin">
                        </div>    
                        </div>
                         <div class="row">
                             <div class="form-group col-md-6">
                           <label class="col-md-6 p-0">First Name</label>
                              <input type="text" name="updatefirstname" id="updatefirstname"  id="updatefirstname"  class="form-control p-0 border-1" autocomplete="off" placeholder="Enter first Name">
                       </div>
                       <div class="form-group col-md-6">
                         <label class="col-md-6 p-0">Last Name</label>
                              <input type="text" name="updatelastname" style="display:block" class="form-control  p-0 border-1" id="updatelastname"  autocomplete="off" placeholder="Enter last name">
                          </div> 
                          </div>
                           <div class="row">
                             <div class="form-group col-md-6">
                                 <label class="col-md-6 p-0">Password</label>
                              <input type="text" class="form-control p-0 border-1" name="updatepassword" id="updatepassword"  placeholder="Enter Password"> 
                             </div>
                            </div> 
                             <div class="row">
                            <div class="form-group col-md-6">
                              <input type="hidden" id="txt_userid" value="0">
                               <button type="button" class="btn btn-success btn-lg" id="btn_save">Save</button>
                                 <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        </form>
                       
        </div>
       
      </div>
      
    </div>
  </div>
 
            
            
            
            
            
 <!-----MODEL END ----->
            
            
            
            
            
            
            
            
            
            <script>
                $(document).ready(function(){
                       
                        var dataTable = $("#user_data").DataTable({
                            
                           "processing" : true,
                           "serverSide":true,
                              "columnDefs": [ {
                              'targets': [1,2,3,4,5], 
                               'orderable': false, 
                          }],
                           "ajax":{
                               url:"include/userShowData.php",
                               type:"post"
                           },
                           "fnDrawCallback": function() {
                             $('.status').bootstrapToggle();
                      
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
                       }
             });
             $(document).on('click', '.btn1', function (e) {
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
                
          $(document).on('click', '.btn2', function (e) {
               var user_id = $(this).data('id');
                $.ajax({
    type:'POST',
    url:'include/userdelete.php',
    data:{user_id:user_id},
    dataType: 'text',
     success: function (response) {
         if(response=="YES"){
              Swal.fire({
                           title: "Admin",
                           icon: "success",
                           text: "User Successfully Deleted",
                           type: "success"
                          })  
                           dataTable.ajax.reload();
         }else{
             Swal.fire({
                           title: "Admin",
                           icon: "Error",
                           text: "Something Went Wrong",
                           type: "Error"
                          })  
         }
    }

     })
               
          }); 
           $(function () {
        $("#close").click(function () {
            $("#updateModal").modal("hide");
        });
        });
           $('#user_data').on('click','.updateUser',function(){
                    var id = $(this).data('id');
                   $('#txt_userid').val(id);
                      $.ajax({
                                  url: 'include/userShowData.php',
                                  type: 'post',
                                  data: {request: 2, id: id},
                                  dataType: 'json',
                                     success: function(response){
                                     if(response.status == 1){
                                       $("#updateemail").val(response.data.email)
                                           $('#update_user_pin').val(response.data.user_pin);
                                           $('#updatefirstname').val(response.data.firstname);
                                           $('#updatelastname').val(response.data.lastname);
                                           $('#updatepassword').val(response.data.password1);
                                  }
                                  }
                        })
                });
                $('#btn_save').click(function(){
                    var id = $('#txt_userid').val();
                   var firstname = $("#updatefirstname").val();
                   var lastname = $("#updatelastname").val();
                   var email  = $("#updateemail").val();
                   var password = $("#updatepassword").val();
                   var pin = $("#update_user_pin").val();
                  if(firstname != '' && lastname != '' && email != '' && password != '' && pin != ''){
                      $.ajax({
                        url: 'include/userShowData.php',
                        type:'post',
                        data: {request: 3, id: id,firstname: firstname, lastname: lastname, email: email, password: password,
                        pin:pin},
                        dataType: 'json',
                        success: function(response){
                            
                            if(response.status == 0){
                                 $('.alert1').show();
                   $('#error1').html(response.message);
                            }
                            else if(response.status == 1){
                            Swal.fire({
                                       title: "Admin",
                                      icon: "success",
                                      text: "User Successfully Updated",
                                      type: "success"
                             	}).then(function() {
			                                     	window.location = "addUser.php";
			                                       	});
                                
                             dataTable.ajax.reload();
                              $('#updatepassword','#updateemail','#updatelastname','#updatefirstname','#update_user_pin').val('');
                          
                            }
                            else{
                                                       Swal.fire({
                           title: "Admin",
                           icon: "error",
                           text: "Something Error Occured",
                           type: "error"  
                       })
                            }
                        }
                      })
                   }else{
                       Swal.fire({
                           title: "Admin",
                           icon: "warning",
                           text: "Fill All The Fields",
                           type: "warning"  
                       })
                   }
                });
             
                });
               
            </script>
            <?=  $footer ?>
         </div>
      </div>
      <?= $footer_links; ?>
    
     </script>
      <script>
   /*     $(".btn1").click(function(e){
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
         }*/
      </script>
      <script>
      $("document").ready(function(){
          
jQuery.validator.addMethod("validate_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email Address.");


   jQuery.validator.addMethod("maxLen", function (value, element, param) {
    //console.log('element= ' + $(element).attr('name') + ' param= ' + param )
    if ($(element).val().length > param) {
        return false;
    } else {
        return true;
    }
}, "only 4 number should be allowed for pin");

$('#user_pin').keypress(
            function(event) {
                //Allow only backspace and delete
                if (event.keyCode != 46 && event.keyCode != 8) {
                    if (!parseInt(String.fromCharCode(event.which))) {
                        event.preventDefault();
                    }
                }
            }
        );



           $("form[name='adduser']").validate({
            

            rules: {
              
                 	email: {
				                required: true,
				                validate_email: true
		                    	},
                 user_pin: {
                 required: true,
                 minlength:4,
                 maxLen:4
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
                  	domainEmail: {
				                    required: "This field is required",
				                   
		                    	},
               user_pin: {
                 required: "This field is required",
                minlength:"Please enter at least 4 characters."
                 
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
            
              //$("#form").click(function(e){
             
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
       
           <script>
                       $(document).on('click', '#ecsv', function (e) {
                           var id = $(this).data('id');
                        
                           showPass2(id);
                           e.preventDefault();
                           });
                           function showPass2(id){
                             
                           swal.fire({
                           title: 'Admin',
                           html:
                            '<label style="font-size:20px; font-weight:bold">Please Enter Your Specific Pin</label>' +
                            '<input id="swal-input2" class="swal2-input" placeholder="Enter a pin">',
                             text: "Click on a Button to Download File",
                           type: 'success',
                           showCancelButton: true,
                           confirmButtonColor: '#3085d6',
                           cancelButtonColor: '#d33',
                           confirmButtonText: 'Download File',
                         
                           
                           preConfirm: function() {
                              return new Promise(function(resolve) {
                               
                               var pin = $('#swal-input2').val();
                           $.ajax({
                               url: 'include/forExportPinVerify.php',
                             type: 'POST',
                             data: {'id': id , 'pin':pin},
                             dataType: "text"
                           })
                           
                             .done(function(response){
                                 
                                 if($.trim(response) == "same"){
                                    download();
                                    swal.close();
                                 }else{
                                     swal.fire('Oops...', 'Pin is Wrong.. !', 'error');
                                 }
                             //
                            })
                           .fail(function(response){
                               alert('byee');
                             swal.fire('Oops...', 'Something went wrong !', 'error');
                            })
                       
                         });
                           },
                           
                           allowOutsideClick: false     
                           }); 
                           }
                    
                    
function convertToCSV(obj) {

    var array = typeof objArray != 'object' ? JSON.parse(obj) : obj;
    var str = '';
    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
}

function exportCSVFile(headers, obj, fileTitle) {
    
    if (headers) {
        obj.unshift(headers);
    }
    
    
 var jsonObject = JSON.stringify(obj);

    var csv = this.convertToCSV(jsonObject);;

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { 
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}
function download(){
  
     $.ajax({
             type: "GET",
             url: "include/exportcsvuser.php",
             success: function (data){
                 var obj = JSON.parse(data)
                 var headers = {
                             ID: 'ID'.replace(/,/g, ''), // remove commas to avoid errors
                             firstname:'First Name',
                             lastname:'Last Name',
                               email:'Email',
                              password:'password',
                               userpin:'User Pin',
                               userstatus:'User Status',
                           };
                         
                     var fileTitle = 'users';

            exportCSVFile(headers, obj , fileTitle); 
    
             }
         });
        
    
}


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

      
   </body>
</html>