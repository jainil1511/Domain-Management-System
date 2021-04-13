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
 
 <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                   
                    <a class="navbar-brand" href="dashboard.php">
                     <!--    
                        <span class="logo-text">
                        
                            <img src="../images/admin.png" height="35px" style="margin:10px;"alt="homepage" />
                        </span> -->
                    </a>
                    
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
               
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block mr-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#" style="text-decoration:none;">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">
                                       <span>
                                           <?
                                           echo $firstname;
                                           
                                           ?>
                                    </span></a>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>