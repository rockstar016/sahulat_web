<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php echo $leftview;?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Edit Information<small>&nbsp;<?php
                    echo $user[0]['master_name'];
                    ?></small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li style="margin-top: 8px;">
                        <i class="fa fa-home"></i>
                        <a href="">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/admin">Administrators</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href=""><?php
                            echo $user[0]['master_name'];
                            ?></a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!--BEGIN PAGE CONTENT-->

            <!--BEGIN USER PROFILE DETAILS-->
            <div class="row">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject bold"> User Profile Information</span>

                            </div>
                            <div class="tools">
                                <a href="" class="collapse"></a>
                            </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo  base_url()?>admin/admin/edit/<?php echo $user[0]['id']?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">User Name</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-user fa-fw"></i>
                                                <input id="username" class="form-control" type="text" name="username" placeholder="username" value="<?php echo $user[0]['master_name'];?>">
                                            </div>
                                            <span class="input-group-btn">
												<button class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Admin password</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-envelope fa-fw"></i>
                                                <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $user[0]['master_password'];?>">
                                            </div>
                                            <span class="input-group-btn">
												<button id="password" class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Email Address</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-envelope fa-fw"></i>
                                                <input id="emailaddress" class="form-control" type="text" name="emailaddress" placeholder="Email Address" value="<?php echo $user[0]['master_email'];?>">
                                            </div>
                                            <span class="input-group-btn">
												<button id="changemail" class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">User Name</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-phone fa-fw"></i>
                                                <input id="userphone" class="form-control" type="text" name="userphone" placeholder="Phone Number" value="<?php echo $user[0]['master_phone'];?>">
                                            </div>
                                            <span class="input-group-btn">
												<button id="changephone" class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- END USER PROFILE DETAILS-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2016 &copy; SAHULAT company All rights reserved.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!--END DATEPICKER-->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar

    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>