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
                    echo $user[0]['user_name'];
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
                        <a href="<?php echo base_url();?>admin/service">Service members</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href=""><?php
                            echo $user[0]['user_name'];
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
                        <!---->
                        <form class="form-horizontal" role="form" method="post" action="<?php echo  base_url()?>admin/service/edit/<?php echo $user[0]['id']?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">User Name</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-user fa-fw"></i>
                                                <input id="username" class="form-control" type="text" name="username" placeholder="username" value="<?php echo $user[0]['user_name'];?>" required>
                                            </div>
                                            <span class="input-group-btn">
												<button class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
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
                                                <input id="emailaddress" class="form-control" type="text" name="emailaddress" placeholder="Email Address" value="<?php echo $user[0]['user_email'];?>">
                                            </div>
                                            <span class="input-group-btn">
												<button class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">User Phone</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-phone fa-fw"></i>
                                                <input id="userphone" value="<?php echo $user[0]['user_phone'];?>" class="form-control" size="15" maxlength="15" type="text" name="userphone" placeholder="Phone Number:+92-xxx-xxxxxxx" required>

                                            </div>
                                            <span class="input-group-btn">
												<button class="btn btn-success red-sunglo" type="submit"><i class="fa fa-arrow-left fa-fw"></i> Update </button>
												</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">
                                    <div class="col-sm-6 pull-right">
                                        <?php if ($user[0]['verified_phone'] === '0'):?>
                                            <a class="btn blue-madison col-sm-12" href="<?php echo base_url();?>admin/service/verify/2/<?php echo $user[0]['id']?>">Activate phone</a>
                                        <?php endif;?>
                                    </div>

                                    <div class="col-sm-6 pull-right">
                                        <?php if ($user[0]['verified_email'] === '0'):?>
                                            <a class="btn blue-madison col-sm-12" href="<?php echo base_url();?>admin/service/verify/1/<?php echo $user[0]['id']?>">Activate email</a>
                                        <?php endif;?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-right">
                                        <?php if ($user[0]['is_activated'] === '0'):?>
                                            <a class="btn blue-madison col-sm-12" href="<?php echo base_url();?>admin/service/activeuser/<?php echo $user[0]['id']?>">Activate this account</a>
                                        <?php endif;?>
                                        <?php if ($user[0]['is_activated'] === '1'):?>
                                            <a class="btn red-sunglo col-sm-12" href="<?php echo base_url();?>admin/service/blockuser/<?php echo $user[0]['id']?>">Block this account</a>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- END USER PROFILE DETAILS-->


            <!-- BEGIN PASSWORD CHANGE -->
            <div class="row">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold"> Password Change</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form" id="user_form" method="post" action="<?php echo  base_url()?>admin/service/password/<?php echo $user[0]['id']?>">
                            <input type="hidden" name="password_change" value="1">
                            <div class="form-body">

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">New password</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-key fa-fw"></i>
                                                <input id="new_pass" class="form-control" type="password" name="new_pass" placeholder="type new password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Confirm new password</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-lock fa-fw"></i>
                                                <input id="confirm_pass" class="form-control" type="password" name="confirm_pass" placeholder="confirm new password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($password_error === true):?>
                                    <div class="alert alert-danger col-sm-offset-2">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                        <div>
                                            Password doesn't match. Try again.
                                        </div>
                                    </span>
                                    </div>
                                <?php endif;?>
                                <div class="form-group">
                                    <div class="col-sm-6 pull-right">
                                        <button type="submit" class="btn btn-large red-sunglo margin-right-10" style="width: 100%;">Password Change</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- END PASSWORD CHANGE-->
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
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<!--END DATEPICKER-->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar

    });
    $("#userphone").on('keydown',function(){
        var key = event.keyCode || event.charCode;
        if( key == 8 || key == 46 ){
            if($("#userphone").val().length == 4){
                return false;
            }
            return true;
        }
        if(!(key >= 48 && key <=57)){
            return false;
        }
        if($("#userphone").val().length == 7){
            var current_value = $("#userphone").val();
            current_value = current_value + "-";
            $("#userphone").val(current_value);
        }

    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>