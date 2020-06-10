<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo base_url('assets/user'); ?>/plugins/images/favicon.png">
    <title> Upskill</title>

    <!-- Bootstrap Core CSS -->

    <link href="<?php echo base_url('assets/user'); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="<?php echo base_url('assets/user'); ?>/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css"
        rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/user'); ?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css"
        rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('assets/user'); ?>/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/user'); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend'); ?>/jodit.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/user'); ?>/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url('assets/user'); ?>/css/colors/megna.css" id="theme" rel="stylesheet">
    <script src="<?php echo base_url('assets/backend'); ?>/jodit.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>



<![endif]-->


<style>
.zoom {
 
  transition: transform .2s; /* Animation */
  
}
.zoom:hover {
  transform: scale(3.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>


</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg "
                    href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i
                        class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="<?php echo base_url(''); ?>"><b><img height="30"
                                src="<?php echo base_url('assets/backend'); ?>/plugins/images/admin.png"
                                alt="home" /></b><span class="hidden-xs"><strong>Upskill</strong></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i
                                class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
            
                    </li>
                    <!-- /.dropdown -->
                    <!-- .Megamenu -->

                    <li class="dropdown">

                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img
                                src="<?php echo base_url('assets/backend'); ?>/plugins/images/admin.png" alt="user-img"
                                width="36" class="img-circle"><b class="hidden-xs">Administrator</b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <!--   <li><a href="javascript:void(0)"><i class="ti-user"></i>  My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Account Setting</a></li> -->
                            <li><a href="<?php echo base_url('admin/Backend/logout') ?>"><i
                                        class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.Megamenu -->
                    <!--  <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li> -->
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span
                                class="input-group-btn">
                                <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                        <!-- /input-group -->
                    </li>

                    <li class="nav-small-cap m-t-10"></li>
                    <li> <a href="<?php echo base_url('admin/dashboard'); ?>" class="waves-effect"><i
                                class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>



                     <li> <a href="<?php echo base_url('admin/Backend/user_details'); ?>" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span
                                class="hide-menu"> users <span class="fa arrow"></span></span></a>
 </li>
 
                   
             





                </ul>
            </div>
        </div>