<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Sahulat | ControlRoom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>
    <link href="<?php echo base_url();?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <!-- END THEME STYLES -->
    <!--BEGIN RATE BAR-->
    <link href="<?php echo base_url();?>assets/global/plugins/jquery-ratebar/themes/bootstrap-stars.css" rel="stylesheet" type="text/css"/>
    <!--END RATE BAR-->
    <!--BEGIN DROPDOWN-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
    <!--END DROPDOWN-->

    <!--BEGIN DATA PAGER TABLE-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <!--END DATA PAGER TABLE-->
    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="<?php echo base_url();?>assets/img/service_logo_title.png" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
<!--                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">-->
<!--                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">-->
<!--                        <i class="icon-bell"></i>-->
<!--                        <span class="badge badge-danger">-->
<!--					4 </span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="external">-->
<!--                            <h3><span class="bold">4 pending</span> notifications</h3>-->
<!--                            <a href="extra_profile.html">view all</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">-->
<!--                                <li>-->
<!--                                    <a href="javascript:;">-->
<!--                                        <span class="time">just now</span>-->
<!--                                        <span class="details">-->
<!--									<span class="label label-sm label-icon label-success">-->
<!--									<i class="fa fa-plus"></i>-->
<!--									</span>-->
<!--									New Order created. </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="javascript:;">-->
<!--                                        <span class="time">just now</span>-->
<!--                                        <span class="details">-->
<!--									<span class="label label-sm label-icon label-success">-->
<!--									<i class="fa fa-plus"></i>-->
<!--									</span>-->
<!--									New Order created. </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="javascript:;">-->
<!--                                        <span class="time">just now</span>-->
<!--                                        <span class="details">-->
<!--									<span class="label label-sm label-icon label-success">-->
<!--									<i class="fa fa-plus"></i>-->
<!--									</span>-->
<!--									New Order created. </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="javascript:;">-->
<!--                                        <span class="time">3 mins</span>-->
<!--                                        <span class="details">-->
<!--									<span class="label label-sm label-icon label-danger">-->
<!--									<i class="fa fa-bolt"></i>-->
<!--									</span>-->
<!--									Delivery is completed. </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!---->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-user" ></i>
                        <span class="username username-hide-on-mobile">
					<?php echo $admin->master_name?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo base_url()?>admin/admin">
                                <i class="icon-user"></i> Admin Manage</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url()?>admin/logout">
                                <i class="icon-key"></i> Log Out </a>
                        </li>

                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>