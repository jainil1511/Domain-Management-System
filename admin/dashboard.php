<?php
   session_start();
   include('../includes/connect.php');
   require('../includes/assets.php');
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       
       header("location: ../login.php");
       exit;
   }
   ?>
 <?php
           
          if(isset($_SESSION['email'])){
            
         $email  =$_SESSION['email'];
      
      $query="SELECT * FROM `users` WHERE `email`= '$email' ";
      $user_data= mysqli_query($con,$query); 
                                    
    while($row=mysqli_fetch_assoc($user_data))
    {     $id = $row['id'];
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];
          $user_type = $row['user_type'];
          
    } 
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
      <style>
          
.card {
    overflow:hidden;
}

.card-body .rotate {
    z-index: 8;
    float: right;
    height: 100%;
}

.card-body .rotate i {
    color: rgba(20, 20, 20, 0.15);
    position: absolute;
    left: 0;
    left: auto;
    right: -10px;
    bottom: 0;
    display: block;
    -webkit-transform: rotate(-44deg);
    -moz-transform: rotate(-44deg);
    -o-transform: rotate(-44deg);
    -ms-transform: rotate(-44deg);
    transform: rotate(-44deg);
}
.white-box{
-moz-box-shadow:    0 0 6px 3px #999;
        -webkit-box-shadow: 0 0 6px 3px #999;
        box-shadow:         0 0 6px 3px #999;
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
            <?php include("../includes/header1.php");
            ?>
         <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                  
                             
                    <?php if($_SESSION['user_type']=="1"){?>
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="text-decoration:none" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                         
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"  style="text-decoration:none" href="addUser.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Add User</span>
                            </a>
                        </li>
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"  style="text-decoration:none" href="domain.php"
                                aria-expanded="false">
                                <i class="fa fa-life-ring " aria-hidden="true"></i>
                                <span class="hide-menu">Domain</span>
                            </a>
                        </li>
                          <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="text-decoration:none" href="logout.php"
                                aria-expanded="false">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span class="hide-menu">Log out</span>
                            </a>
                        </li>
                        <?php }else { ?>
                       <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"  style="text-decoration:none" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                    
                           <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"  style="text-decoration:none" href="addDomain.php"
                                aria-expanded="false">
                                <i class="fa fa-life-ring" aria-hidden="true"></i>
                                <span class="hide-menu">domain</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"  style="text-decoration:none" href="logout.php"
                                aria-expanded="false">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span class="hide-menu">Log out</span>
                            </a>
                        </li>
                        
                        <?php } ?>
                    </ul>

                </nav>
                </script>
            </div>
         </aside>
         <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
               <div class="row align-items-center">
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                     <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
                  </div>
               </div>
            </div>
      
             <div class="container-fluid">
               
                  <?php if($_SESSION['user_type']=="1"){?>
                <div class="row justify-content">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <a href="addUser.php" style="text-decoration:none; color:black; font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;">
                        <h4 > User</h4>
                            <h3 class="box-title">Total Users</h3></a>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-success">
        
                                 <?php
                                                 $query = "SELECT * FROM users";
                                                 $users = mysqli_query($con,$query);
                                                $user_counts = mysqli_num_rows($users);
                                                 echo "<div class='huge'  style='text-decoration:none; color:black; font-family: Roboto, sans-serif;
                        font-family: Rubik, sans-serif;'><a href='addUser.php' style='text-decoration:none; color:black;'>{$user_counts}</a>"; 
                                ?>
                                    
                                </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                     
                        <div class="white-box analytics-info">
                            <a href="domain.php" style="text-decoration:none; color:black; font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;">
                            <h4 tyle="text-decoration:none; color:black; font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;"> Domain</h4>
                            <h3 class="box-title">Total Domain</h3></a>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple">
                                      <?php
                                                 $query = "SELECT * FROM domain";
                                                 $domain = mysqli_query($con,$query);
                                                 $domain_count = mysqli_num_rows($domain);
                                                 echo "<div class='huge'  style='text-decoration:none; color:black; font-family: Roboto, sans-serif;
                        font-family: Rubik, sans-serif;'><a href='addUser.php' style='text-decoration:none; color:black;'>{$domain_count}</a>"; 
                                      ?>
                                </span></li>
                            </ul>
                        </div>
                    </div>
                   </div>
                   
                   <?php
                   
                  }else{
                  
                  ?>
                  
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                             <a href="domain.php" style="text-decoration:none; color:black; font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;">
                            <h4 tyle="text-decoration:none; color:black; font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;"> Domain</h4>
                            <h3 class="box-title">Total Domain</h3></a>
                            </a>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple">
                                      <?php
                                                
                                                 $query = "SELECT * FROM domain where user_id = '$id' ";
                                                 $domain = mysqli_query($con,$query);
                                                 $domain_count = mysqli_num_rows($domain);
                                                 echo "<div class='huge' style='text-decoration:none; color:black; font-family: Roboto, sans-serif;
                        font-family: Rubik, sans-serif;'><a href='domain.php' style='text-decoration:none; color:black;'>{$domain_count}</a>"; 
                                      ?>
                                </span></li>
                            </ul>
                        </div>
                    </div>
                   </div>
                  
                  <?php
                  }
                  ?>
                </div>
                    
    <!--                
          <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-body">
                         <h3 style="font-family: 'Roboto', sans-serif;
                        font-family: 'Rubik', sans-serif;">Dashboard</h3>
                           
                                       
              
                            </div>
                     </div>
                  </div>
                </div>
                </div>-->
                </div>
                
           </div>
         <?=  $footer ?>
          </div>
      <?= $footer_links; ?>
      
         </body>
</html>