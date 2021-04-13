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
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords"
         content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
      <meta name="description"
         content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
      <meta name="robots" content="noindex,nofollow">
      <title>Domain managment system</title>
      <?=$header_links ?>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300&family=Rubik:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      
      <script src="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"></script>
     
    
      <style>
      .error1 {
         color:#B22222;
         }
         
         .alert1{
             display:none;
         }
         .error {
         color:#B22222;
         }
          .alert{
             display:none;
         }
         .slow .toggle-group { transition: left 0.10s; -webkit-transition: left 0.10s; }
          .dataTables_wrapper .dataTables_paginate .paginate_button
             {
             padding:0px;
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
                  <h4 class="page-title text-uppercase font-medium font-14">Domain </h4>
               </div>
               <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                  <div class="d-md-flex">
                     <ol class="breadcrumb ml-auto">
                        <li><a href="#">Domain</a></li>
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
                           <strong id="error"></strong></strong>
                        </div>
                      
                        <form class="form-horizontal form-material" id="form" name="frm1"  method="post">
                           <h3 class="text-center" style="font-family: 'Roboto', sans-serif;
                              font-family: 'Rubik', sans-serif;">Add Domain</h3>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Select User</label>
                                    <select name="user_id" id="sel" class="form-control col-md-6">
                                       <option value="" disabled selected>choose User</option>
                                       <?php
                                          $query="SELECT * FROM users WHERE user_type NOT IN (1) ORDER BY id DESC";
                                          
                                          $select_users = mysqli_query($con,$query);
                                             while($row = mysqli_fetch_assoc($select_users)){
                                           $id = $row['id'];
                                           $firstname = $row['firstname'];
                                           $lastname = $row['lastname'];
                                          
                                          
                                          echo "<option  value='{$id}'>{$firstname} {$lastname}</option>";
                                          }
                                          
                                          ?>
                                    </select>
                                    <span id="selctusererr" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Name</label>
                                    <input type="text" name="domainName" class="form-control  p-0 border-1"id="domainName" autocomplete="off" placeholder="Enter Domain Name">
                                    <span id="domainName1" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Provider Name</label>
                                    <input type="text" name="domainProName" class="form-control  p-0 border-1" 
                                      
                                       id="domainProName" autocomplete="off" placeholder="Enter Domain Provider name">
                                    <span id="domainProName1" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Provider Id</label>
                                    <input type="text" name="domainProId" class="form-control  p-0 border-1"
                                 
                                       id="domainProId" autocomplete="off" placeholder="Enter Domain Provider Id">
                                    <span id="domainProId1" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Provider Password</label>
                                    <input type="password" name="domainProPass" class="form-control  p-0 border-1"
                                      
                                       id="domainProPass" autocomplete="off" placeholder="Enter Domain Provider Password">
                                    <span id="domainProPass1" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label for="startdatelbl">Starting Date</label>
                                    <input type="text" class="form-control" name="startingdate" id="startingdate"
                                    
                                       >              
                                    <span id="startd1" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label for="expirydatelbl">Expiry Date</label>
                                    <input type="text" class="form-control" name="expirydate" id="expirydate"
                                      
                                       name="expirydate">
                                    <span id="expiryd1" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label>
                                    <input type="checkbox" class="filled-in" name="checkbox" id="checkbox" value="1"/>
                                    <span>Cloudfare</span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0" name="lblemail">Email</label>
                                    <input type="text" name="domainEmail" class="form-control  p-0 border-1 valid" id="domainEmail" 
                                       autocomplete="off" placeholder="Enter Email ID" aria-required="true" aria-invalid="false">
                                    <span id="domainEmail1" class="text-danger font-weight-bold " name="domainEmail1"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0" name="lblpass">Password</label>
                                    <input type="password" name="domainPass" class="form-control  p-0 border-1" 
                                       id="domainPass" autocomplete="off" placeholder="Enter Password">
                                    <span id="domainPass1" class="text-danger font-weight-bold" name="domainPass1"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-12">
                              <div class="input-field col s6">
                                 <center>  <input type="submit"  name="submit" id="submit" value="Submit" class="btn btn-success"></center>
                              
                              </div>
                           </div>
                        </form>
                        <hr style="color:red";>
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
                                 <table id="domain_data" class="table table-striped table-bordered" style="width:100%;  font-family: 'Roboto', sans-serif; ">
                                    <thead>
                                       <tr>
                                          <th>Id</th>
                                          <th>User Id</th>
                                          <th>Domain Name</th>
                                          <th>Domain Details<br></th>
                                          <th>Domain Date's</th>
                                          <th>Left Days</th>
                                          <th>Action</th>
                                          <th>Notification</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                
                                 </table>
                              </div>
                           </div>
                        </div>

  
     <div id="updateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
       
          <button type="button" height="30px;" style="margin-bottom:10px;"class="close" id="close"  data-dismiss="modal">&times;</button>
          
         <center> <h4 class="modal-title"  style="color:Grey; font-family: 'Roboto', sans-serif;
                              font-family: 'Rubik', sans-serif;">Update Domain Details</h4></center>
    
        <div class="modal-body">
                                <div class="alert alert1 alert-danger" role="alert">
                           <strong id="error1"></strong></strong>
                        </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s12">
                                    <label class="col-md-12 p-0">Select User</label>
                                    <select name="user_id" id="sel1" class="form-control col-md-12">
                                       <option value="" disabled selected>choose User</option>
                                       <?php
                                          $query="SELECT * FROM users WHERE user_type NOT IN (1) ORDER BY id DESC";
                                          
                                          $select_users = mysqli_query($con,$query);
                                             while($row = mysqli_fetch_assoc($select_users)){
                                           $id = $row['id'];
                                           $firstname = $row['firstname'];
                                           $lastname = $row['lastname'];
                                          
                                          
                                          echo "<option  value='{$id}'>{$firstname} {$lastname}</option>";
                                          }
                                          
                                          ?>
                                    </select>
                                    <span id="selctusererr" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Name</label>
                                    <input type="text" name="doname" class="form-control  p-0 border-1"id="doname" autocomplete="off" placeholder="Enter Domain Name">
                                    <span id="doname1" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Provider Name</label>
                                    <input type="text" name="dopname" class="form-control  p-0 border-1" 
                                      
                                       id="dopname" autocomplete="off" placeholder="Enter Domain Provider name">
                                    <span id="dopname1" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0">Domain Provider Id</label>
                                    <input type="text" name="dpid" class="form-control  p-0 border-1"
                                 
                                       id="dpid" autocomplete="off" placeholder="Enter Domain Provider Id">
                                    <span id="dpid1" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-8 p-0">Domain Provider Password</label>
                                    <input type="text" name="dppass" class="form-control  p-0 border-1"
                                      
                                       id="dppass" autocomplete="off" placeholder="Enter Domain Provider Password">
                                    <span id="dppass1" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label for="startdatelbl">Starting Date</label>
                                    <input type="text" class="form-control" name="s1" id="s1">              
                                    <span id="s11" class="text-danger font-weight-bold"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label for="expirydatelbl">Expiry Date</label>
                                    <input type="text" class="form-control" name="s2" id="s2">
                                    <span id="s22" class="text-danger font-weight-bold"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label>
                                    <input type="checkbox" class="filled-in" name="checkbox1" id="checkbox1" value="0"/>
                                    <span>Cloudfare</span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-4">
                              <div class="row">
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0" name="l1">Email</label>
                                    <input type="text" name="demail" class="form-control  p-0 border-1 valid" id="demail" 
                                       autocomplete="off" placeholder="Enter Email ID" aria-required="true" aria-invalid="false">
                                    <span id="d1" class="text-danger font-weight-bold " name="demail1"></span>
                                 </div>
                                 <div class="input-field col s6">
                                    <label class="col-md-6 p-0" name="l2">Password</label>
                                    <input type="password" name="dpass" class="form-control  p-0 border-1" 
                                       id="dpass" autocomplete="off" placeholder="Enter Password">
                                    <span id="d2" class="text-danger font-weight-bold" name="dpass1"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-12">
                              <div class="input-field col s6">
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
  <script>
    $("#s1").datepicker({dateFormat: "dd-mm-yy"});
      $("#s2").datepicker({ dateFormat: "dd-mm-yy"})
                        </script>  
                          <script>
                           $(function name1() {
                           $('label[name="l1"]').hide();
                           $('span[name="d1"]').hide();
                           $('input[name="demail"]').hide();
                           $('label[name="l2"]').hide();
                            $('span[name="d2"]').hide();
                           $('input[name="dpass"]').hide();
                           $('label[id="domainEmail-error"]').hide();
                              $('label[id="domainPass-error"]').hide();
                           
                           $('input[name="checkbox1"]').on('click', function () {
                               if ($(this).prop('checked')) {
                                   
                                   $('label[name="l1"]').fadeIn();
                                   $('input[name="demail"]').fadeIn();
                                    $('span[name="d1"]').fadeIn();
                                   $('label[name="l2"]').fadeIn();
                                   $('input[name="dpass"]').fadeIn();
                                   $('span[name="d2"]').fadeIn();
                                   $('label[id="domainEmail-error"]').fadeIn(); 
                                   $('label[id="domainPass-error"]').fadeIn();
                               } else {
                                    $('label[name="l1"]').hide();
                                    $('input[name="demail"]').hide();
                                    $('span[name="d1"]').hide();
                                    $('label[name="l2"]').hide();
                                    $('input[name="dpass"]').hide();
                                    $('span[name="d2"]').hide();
                                    $('label[id="d2-error"]').hide();
                                    $('label[id="domainEmail-error"]').hide();
                               }
                           });
                           });
   
     $(function () {
        $("#close").click(function () {
            $("#updateModal").modal("hide");
             
             $('#checkbox1').prop('checked', false);
                 $('label[name="l1"]').hide();
                 $('input[name="demail"]').hide();
                 $('span[name="d1"]').hide();
                 $('label[name="l2"]').hide();
                 $('input[name="dpass"]').hide();
                 $('span[name="d2"]').hide();
                 $('label[id="d2-error"]').hide();
                 $('label[id="domainEmail-error"]').hide();
            
        });
    });
                        </script>  
                        
                        <script>
                               $(document).ready(function(){
                        var dataTable = $("#domain_data").DataTable({
                           "processing" : true,
                           "serverSide":true,
                           "columnDefs": [ {
                              'targets': [1,2,3,4,5,6,7,8], 
                               'orderable': false, 
                          }],
                         
                        "ajax":{
                               url:"include/domainShowData.php",
                                   type:"post"
                           },
            
                        
                             "fnDrawCallback": function() {
                               $('.status').bootstrapToggle();
                               $('.flag').bootstrapToggle();
                             
                               $(".flag").change(function(){
                                if($(this).prop("checked")) {
                                     $("#value1").val("on");
                                }else{
                                     $("#value1").val("off");
                                }
                                var id1 = $(this).attr("data-id");
                                var value1 = $("#value1").val();
                                console.log(id1);
                                console.log(value1);
                                var action1 = 'change_status';
                                
                                  $.ajax({
                                 url:'include/domainflagstatus.php',
                                 type: 'POST',
                                 data: { 
                                     'id1':id1,
                                     'value1':value1,
                                     'action1':action1
                                     },
                                 dataType: "text"
                                 
                                  })
                                 .done(function(response){
                                    Swal.fire({
                                             title: "Admin",
                                             icon: "success",
                                             text: "User Notification Changed",
                                             type: "success"
                                         })
                                  
                                 })
                                 fail(function(){
                                        Swal.fire({
                                             title: "Admin",
                                             icon: "error",
                                             text: "Something Went Wrong...",
                                             type: "error"
                                         })
                                  });
                                
                             });
                             
                              $(".status").change(function(){
                                   if($(this).prop("checked")){
                                     $("#value").val("Enable");
                                 }else{
                                      $("#value").val("Disable");
                                 }
                              
                           var id = $(this).attr("data-id");
                           var value = $("#value").val();
                                 console.log(id);
                                 console.log(value);
                                 var action = 'change_status';
                             
                                $.ajax({
                                 url:'include/domainstatus.php',
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
                                         })
                             
                                 })
                                 .fail(function(){
                                      Swal.fire({
                                             title: "Admin",
                                             icon: "error",
                                             text: "User Notification Changed",
                                             type: "error"
                                         })
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
                             text: "Click on a Button to show Password",
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
                               url: 'include/userpassverify.php',
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
                            var id = $(this).data('id');
                          
                             $.ajax({
                                type:'POST',
                                 url:'include/domaindelete.php',
                                  data:{id:id},
                                  success: function(response){
                                   if(response =="YES"){
                                     Swal.fire({
                                       title: "Admin",
                                      icon: "success",
                                      text: "Domain Successfully Deleted",
                                      type: "success"
                                     }) 
                                     dataTable.ajax.reload();
                                    }else{
                                   Swal.fire({
                                         title: "Admin",
                                         icon: "Error",
                                         text: "Something went Wrong",
                                         type: "Error"
                                        })  
                                   }
                                   }
                                })
                               });
                                 $('#domain_data').on('click','.updateUser',function(){
                                  var id = $(this).data('id');
                                  $('#txt_userid').val(id);
                                  $.ajax({
                                  url: 'include/domainShowData.php',
                                  type: 'post',
                                  data: {request: 2, id: id},
                                  dataType: 'json',
                                  success: function(response){
                                     if(response.status == 1){
                                          $("#sel1").val(response.data.userid);
                                           $('#doname').val(response.data.domainName);
                                           $('#dopname').val(response.data.domainProviderName);
                                           $('#dpid').val(response.data.domainid);
                                           $('#dppass').val(response.data.domainpass);
                                           $('#s1').val(response.data.startdate);
                                           $('#s2').val(response.data.expirydate);
                                           $('#demail').val(response.data.cemail);
                                           $('#dpass').val(response.data.cpass);
                                            var dmail = response.data.cemail;
                                            var dpass = response.data.cpass;
                                            if(dmail == "" || dmail == null && dpass == "" || dpass == null){
                                                  $('#checkbox1').prop('checked', false);
                                                  $('label[name="l1"]').hide();
                                                  $('input[name="demail"]').hide();
                                                  $('span[name="d1"]').hide();
                                                  $('label[name="l2"]').hide();
                                                  $('input[name="dpass"]').hide();
                                                  $('span[name="d2"]').hide();
                                                  $('label[id="d2-error"]').hide();
                                                  $('label[id="domainEmail-error"]').hide();
                                            }else{
                                                 $('#checkbox1').prop('checked', true);
                                                 $('label[name="l1"]').fadeIn();
                                                 $('input[name="demail"]').fadeIn();
                                                 $('span[name="d1"]').fadeIn();
                                                 $('label[name="l2"]').fadeIn();
                                                 $('input[name="dpass"]').fadeIn();
                                                 $('span[name="d2"]').fadeIn();
                                                 $('label[id="domainEmail-error"]').fadeIn(); 
                                                 $('label[id="domainPass-error"]').fadeIn();
                                            }
                                     }
                                  
                                  }
                             })
                         }); 
                             $('#btn_save').click(function(){
                                   var id = $('#txt_userid').val();
                                   var uid = $('#sel1').val();
                                   var dname = $('#doname').val();
                                   var dopname = $('#dopname').val();
                                   var dpid = $('#dpid').val();
                                   var dppass = $('#dppass').val();
                                   var s1 = $('#s1').val();
                                   var s2 = $('#s2').val();
                                   var clemail = $('#demail').val();
                                   var clpass = $('#dpass').val();
                                   var checkbox1  = $("#checkbox1").val();
                                    
                if(uid != '' && dname != '' && dopname != '' && dpid != '' && dppass != '' && s1 != '' && s2 != ''){
                        $.ajax({
                        url: 'include/domainShowData.php',
                        type:'post',
                        data: {request: 3, id: id,uid: uid, dname: dname, dopname: dopname, dpid: dpid,
                        dppass:dppass ,s1:s1,s2:s2,clemail:clemail,clpass:clpass,checkbox1:checkbox1},
                        dataType: 'json',
                        success: function(response){
                             if(response.status == 0){
                                 $('.alert1').show();
                   $('#error1').html(response.message);
                            }
                            else  if(response.status == 1){
                                
                            Swal.fire({
                                       title: "Admin",
                                      icon: "success",
                                      text: "Domain Successfully Updated",
                                      type: "success"
                            	}).then(function() {
			                                     	window.location = "domain.php";
			                                       	}); 
                                
                             dataTable.ajax.reload();
                             $('#doname','#dopname','#dpid','#dppass','#s1','#s2','#clemail','#clpass').val('');
                             $("#updateModal").modal("hide");
                             $('#checkbox1').prop('checked', false);
                             $('label[name="l1"]').hide();
                             $('input[name="demail"]').hide();
                             $('span[name="d1"]').hide();
                             $('label[name="l2"]').hide();
                             $('input[name="dpass"]').hide();
                             $('span[name="d2"]').hide();
                             $('label[id="d2-error"]').hide();
                             $('label[id="domainEmail-error"]').hide();
                             $('#txt_userid').val(0);
                            }else{
                               Swal.fire({
                                       title: "Admin",
                                      icon: "error",
                                      text: "Something Went Wrong",
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
                           <script>
                              $(function() {
                               
                             $("form[name='frm1']").validate({
                             
                               rules: {
                                 user_id   :"required",
                                 domainName:"required",
                                 domainProName: "required",
                                 domainProId:"required",
                                 domainProPass: {
                                   required: true,
                                   minlength: 3,
                                   maxlength:20
                                 },
                                 startingdate:"required",
                                 expirydate:"required",
                                 domainEmail:"required",
                                 domainPass:"required",
                               
                               },
                               
                               messages: {
                                   
                                 user_id:"This field is required",
                                 domainName: "This field is required",
                                 domainProName: "This field is required", 
                                 domainProId: "This field is required",
                                  domainProPass: {
                                   required: "This field is required",
                                   minlength: "Your password must be at least 3 characters long",
                                   maxlength:"Your Password must be only 20 character long",
                                 },
                                   startingdate:"This field is required",
                                   expirydate:"This field is required",
                                   domainEmail:"This field is required",
                                   domainPass:"This field is required"
                               },
                               submitHandler: function(form) {
                                   
                                 var  userid = $("#sel").val();  
                                 var  domainName = $("#domainName").val();
                                 var  domainProName = $("#domainProName").val();
                                 var  domainProId = $("#domainProId").val();
                                 var  domainProPass = $("#domainProPass").val();
                                 var  startingdate = $("#startingdate").val();
                                 var  expirydate = $("#expirydate").val();
                                 var  domainEmail = $("#domainEmail").val();
                                 var  domainPass = $("#domainPass").val();
                                 var checkbox  = $("#checkbox").val();
                                 
                                 var action = 'domain_data';
                                 
                                $.ajax({
                                url: "include/domainAdd.php",
                                type: "POST",
                                dataType: "text",
                                data: { userid: userid, 
                                        domainName: domainName,
                                        domainProName: domainProName,
                                        domainProId: domainProId,
                                        domainProPass:domainProPass,
                                        startingdate:startingdate,
                                        expirydate : expirydate,
                                        domainEmail : domainEmail,
                                        domainPass : domainPass,
                                        checkbox:   checkbox,
                                        action:action
                                }
                                })
                               .done(function(response){
                                     $('.alert').show();
                                     $('#error').html(response);
                                   userid = $("#sel").val("");  
                                   domainName = $("#domainName").val("");
                                   domainProName = $("#domainProName").val("");
                                   domainProId = $("#domainProId").val("");
                                   domainProPass = $("#domainProPass").val("");
                                   domainEmail = $("#domainEmail").val("");
                                   domainPass = $("#domainPass").val("");
                                  // checkbox  = $("#checkbox").checked = false;
                                  document.getElementById("checkbox").checked = false;
                                  
                                    console.log(response);
                                    
                                    
                                    
                           $('label[name="lblemail"]').hide();
                           $('span[name="domainEmail1"]').hide();
                           $('input[name="domainEmail"]').hide();
                           $('label[name="lblpass"]').hide();
                            $('span[name="domainPass1"]').hide();
                           $('input[name="domainPass"]').hide();
                           $('label[id="domainEmail-error"]').hide();
                              $('label[id="domainPass-error"]').hide();
                                 })
                                 .fail(function(response){
                                  console.log(response);
                                 });
                                 
                               return false;
                                  
                             }
                        });
                    });
                       </script>
                        <script>
                     
                          $("#startingdate").datepicker({
                           dateFormat: "yy-mm-dd"
                           }).datepicker("setDate", "y");
                            
                            $("#expirydate").datepicker({
                           dateFormat: "yy-mm-dd"
                           }).datepicker("setDate", "+1y");
                            
                        </script>  
                            <script>
                           $(function name1() {
                           $('label[name="lblemail"]').hide();
                           $('span[name="domainEmail1"]').hide();
                           $('input[name="domainEmail"]').hide();
                           $('label[name="lblpass"]').hide();
                            $('span[name="domainPass1"]').hide();
                           $('input[name="domainPass"]').hide();
                           $('label[id="domainEmail-error"]').hide();
                              $('label[id="domainPass-error"]').hide();
                           
                           $('input[name="checkbox"]').on('click', function () {
                               if ($(this).prop('checked')) {
                                   
                                   $('label[name="lblemail"]').fadeIn();
                                   $('input[name="domainEmail"]').fadeIn();
                                    $('span[name="domainEmail1"]').fadeIn();
                                   
                                         
                                   $('label[name="lblpass"]').fadeIn();
                                   $('input[name="domainPass"]').fadeIn();
                                   $('span[name="domainPass1"]').fadeIn();
                                   $('label[id="domainEmail-error"]').fadeIn(); 
                                   $('label[id="domainPass-error"]').fadeIn();
                                   
                               } else {
                                   $('label[name="lblemail"]').hide();
                                   $('input[name="domainEmail"]').hide();
                                    $('span[name="domainEmail1"]').hide();
                                  
                                   
                                         
                                   $('label[name="lblpass"]').hide();
                                   $('input[name="domainPass"]').hide();
                                    $('span[name="domainPass1"]').hide();
                                        $('label[id="domainPass-error"]').hide();
                                   
                                     $('label[id="domainEmail-error"]').hide();
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
             url: "include/exportcsv.php",
             success: function (data){
                 var obj = JSON.parse(data)
                 var headers = {
                             ID: 'ID'.replace(/,/g, ''), // remove commas to avoid errors
                             UserID : 'User ID',
                             domainName:'Domain Name',
                              domainProviderName:'Domain Provider Name',
                              domainProviderId:'Domain Provider Id',
                              domainProviderpassword:'Domain Provider Password',
                               startingdate:'Starting Date',
                               expirydate:'Expiry Date',
                               cloudfaremail:'Cloudfare Email',
                               cloudfarePassword:'cloudfare Password',
                              status:'Status',
                              notification:'notification status'
                           };
                         
                     var fileTitle = 'domain';

            exportCSVFile(headers, obj , fileTitle); 
    
             }
         });
        
    
}


</script>
                       
                     </div>
                  </div>
               </div>
            </div>

            <?=  $footer ?>
         </div>
      </div>
      <?= $footer_links; ?>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
 
      <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
   </body>
</html>