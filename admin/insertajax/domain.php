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
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300&family=Rubik:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
      <style>
         .error {
         color:#B22222;
         }
          .alert{
             display:none;
         }
         .slow .toggle-group { transition: left 0.10s; -webkit-transition: left 0.10s; }
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
                                    <input type="email" name="domainEmail" class="form-control  p-0 border-1" id="domainEmail" 
                                       autocomplete="off" placeholder="Enter Email ID">
                                    <span id="domainEmail1" class="text-danger font-weight-bold" name="domainEmail1"></span>
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
                        <div class="row">
                           <div class="col-xs-12">
                              <div class="table-responsive">
                                 <table id="domain_data" class="table table-striped table-bordered" style="width:100%;  font-family: 'Roboto', sans-serif; ">
                                    <thead>
                                       <tr>
                                          <th>Id</th>
                                          <th>User Id</th>
                                          <th>DomainName</th>
                                          <th>Domain provider Name<br>Domain Provider ID</th>
                                          <th>Start Date</th>
                                          <th>Expiry Date</th>
                                          <th>Cloudfare Email<br>Cloudfare Password</th>
                                        
                                         
                                          <th>Action</th>
                                          <th>Domain Provider Password</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php  
                                          // $query ="SELECT * FROM domain WHERE  id AND   delete_status != 'disable' ";
                                                                   
                                                        $query ="SELECT * FROM domain ORDER BY id DESC"; 
                                                        //$query = "SELECT * FROM `users`  JOIN domain WHERE users.id = domain.id";
                                                          $result = mysqli_query($con, $query);  
                                                          while($row = mysqli_fetch_array($result))  
                                                         
                                                          {    
                                                               $user_id  = $row['user_id'];
                                                               
                                                             
                                             ?>
                                       <?php
                                          $query2  = "SELECT * FROM users WHERE id = $user_id";
                                          $result2 = mysqli_query($con,$query2);
                                          while($row2 = mysqli_fetch_array($result2))
                                          $email = $row2['email'];
                                          ?>
                                       <tr>
                                          <td><?php  echo $row['id'] ?></td>
                                          <td><?php echo $email; ?> </td>
                                          <td><?php echo  $row['domain_name'] ?></td>
                                          <td><?php echo  $row['domain_provider_name'] ?><br><?php echo  $row['domain_provider_id'] ?></td>
                                          <td><?php echo  $row['starting_date'] ?><br></td>
                                          <td><?php echo  $row['expiry_date'] ?></td>
                                          <td><?php echo  $row['cf_email'] ?><br><?php echo  $row['cf_pass'] ?></td>
                                      
                                        
                                         
                                              <td>
                                             <input type="hidden" name="value"  id="value" class="value" value="Enable" >
                                             <?php
                                                if($row['domain_status'] == 'Enable'){
                                                    
                                                    ?>
                                             <input type = "checkbox"  data-id="<?php echo $row['id'];?>" data-size="small" data-style="slow"  checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" class ="status">
                                             <?php   }else{
                                                ?>
                                             <input type = "checkbox"  data-id="<?php echo $row['id'];?>" data-size="small"  data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" class ="status">
                                             <?php    }
                                                ?>
                                          </td>
                                         
                                         
                                         
                                          <td>
                                             <input type="hidden" name="domainid" class="domainid" id="domainid" value="<?php  echo $row['user_id'] ?>">
                                             <button type="button" data-id="<?php echo $row['user_id']; ?>" href="javascript:void(0)" class="btn btn-danger btn-sm btn1">Show Password</button>
                                          </td>
                                        
                                          <?php 
                                             }
                                               
                                             ?> 
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
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
                           // $("#startingdate").datepicker().datepicker("setDate", new Date());
                            
                           
                            //$("#expirydate").datepicker().datepicker("setDate", new Date());
                                   $("#startingdate").datepicker({
                           dateFormat: "dd/mm/yy"
                           }).datepicker("setDate", "y");
                            
                            $("#expirydate").datepicker({
                           dateFormat: "dd/mm/yy"
                           }).datepicker("setDate", "+1y");
                            
                        </script>  
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
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
         <script>
                           $(document).ready(function() {
                           $('#domain_data').DataTable();
                           
                           });
                                 
                        </script>   
   </body>
</html>