<?php
session_start();

//echo $_SESSION['user_id'];
$id=$_SESSION['user_id'];


// retrive data
include '../../common/dbsql.php';

$tablename="user";
$cols="*";
$fields ="user_id";
$value=$id;


// get personal data
$dataRow=retrive($tablename,$cols,$fields,$value);

$name= $dataRow['name'];
$mail=$dataRow['email'];
$role=$dataRow['role'];
$pro_pic=$dataRow['pro_pic'];


//get data from tree
$dataTree=retrive("tree","*",$fields,$value);
$left_pt=$dataTree['left_pt']-$dataTree['point_paid'];
$right_pt=$dataTree['right_pt']-$dataTree['point_paid'];



/*$sql2="SELECT * FROM pro_pic WHERE user_id= '$id'";
$result=$conn->query($sql2);

while($row = $result->fetch_assoc()) {
    $pro_pic=$row['pro_pic'];


    //echo "<img src='".$pro_pic."'>";
    break;
    }
 



 //get team details

 
*/

?>



<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>logged in | <?php echo "$name";?> | Admin</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />



    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="http://knowza.lk/wp-content/uploads/2022/03/Selles-Stock-4-e1647173670162.png">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


    <style type="text/css">
        .rounded-circle{
            object-fit: cover;
        }
        .dark-logo{
        	width:150px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="http://knowza.lk/wp-content/uploads/2022/03/Selles-Stock-4-e1647173670162.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                          <img src="http://knowza.lk/wp-content/uploads/2022/03/Selles-Stock-4-e1647173670162.png" alt="homepage" class="light-logo" /> 
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                       <!-- <span class="logo-text">

                            <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                          
                            <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span> -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="mdi mdi-magnify me-1"></i> <span class="font-16">Search</span></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                  <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                      <!--  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $pro_pic;?>" alt="user" class="rounded-circle" width="31" height='31'>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
                                    Inbox</a>
                            </ul>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul> 
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        
                         <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="admin_panel.php" aria-expanded="false"><i
                                    class="mdi mdi-account-network selected"></i><span class="hide-menu">Admin</span></a></li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="table-basic.html" aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                                    class="hide-menu">Profile</span></a></li> -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="approve_points.php" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Requests</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="approve_main.php" aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Approve</span></a></li>
                    
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                     href="../html1/team.php" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                        class="hide-menu">Team</span></a></li>
<!--                        <li class="text-center p-40 upgrade-btn">-->
<!--                            <a href="register-form.php"-->
<!--                                class="btn d-block w-100 btn-danger text-white" >add new</a>-->
<!--                        </li>-->
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">admin</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Admin Dashboard</h1> 
                    </div>
                    <div class="col-4">
                        
                    </div>
                    <div class="col-2">
                        <div class="text-end upgrade-btn">
                            <a href="../html1/register-form.php"
                                class="btn d-block w-50 btn-danger text-white" >add new</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?php echo $pro_pic;?>"
                                        class="rounded-circle" width="150" height="150" />
                                    <h4 class="card-title m-t-10">Knowza Admin</h4>
                                    <h6 class="card-subtitle"><?php echo $role;?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                                    class="icon-people"></i>
                                                <font class="font-medium"><?php echo $left_pt;?></font>
                                            </a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                                    class="icon-picture"></i>
                                                <font class="font-medium"><?php echo $right_pt;?></font>
                                            </a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo $mail;?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo $dataRow['phone'];?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?php echo $dataRow['addr'];?></h6>
                                <div class="map-box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                        width="100%" height="150" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div> <small class="text-muted p-t-30 db">Social Profile</small>
                                <br />
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Settings</h3>
                                <div class="row">
                                	<div class="col-6">
                                		<p>Change profile picture:</p>
                                	</div>
                                	<div class="col-6">
                                		<a href="../../common/change_pro_pic.php" class="btn btn-primary">edit</a>
                                	</div>
                                	<div class="col-6">
                                		<p>Change password:</p>
                                	</div>
                                	<div class="col-6">
                                		<a href="../../common/change_pw.php" class="btn btn-primary">edit</a>
                                	</div>
                                
                                	
                                	
                                	
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                    	<div class="card">
                            <div class="card-body">
                                <h3>Options</h3>
                                <div class="row">
                                	<div class="col-6">
                                		<p>See requests</p>
                                	</div>
                                	<div class="col-6">
                                		<button class=" btn btn-primary">Check</button>
                                	</div>
                                	<div class="col-6">
                                		<p>Approve registrations</p>
                                	</div>
                                	<div class="col-6">
                                		<a href="approve_main.php" class=" btn btn-primary">Check</a>
                                	</div>
                                	
                                </div>
                            </div>
                    	</div>
                    </div>
                    <!-- Column -->

                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved.Designed and Developed by <a
                    href="https://panhindagraphics.com/home/">Panhindagraphics web unit</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.js"></script>
</body>

</html>