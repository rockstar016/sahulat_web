<div class="clearfix" xmlns:width="http://www.w3.org/1999/xhtml" xmlns:width="http://www.w3.org/1999/xhtml"
     xmlns:width="http://www.w3.org/1999/xhtml">
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
                Create New Member
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
                        <a href="">create new member</a>
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
                                <span class="caption-subject bold"> Create New Member</span>
                            </div>
                            <div class="tools">
                                <a href="" class="collapse"></a>
                            </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo  base_url();?>admin/service/create">
                            <div class="form-body">

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Member Name</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-user fa-fw"></i>
                                                <input id="username" class="form-control" type="text" name="username" placeholder="username" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Member Password</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-lock fa-fw"></i>
                                                <input id="password" class="form-control" type="password" name="password" placeholder="password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Email Address</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-envelope fa-fw"></i>
                                                <input id="emailaddress" class="form-control" type="text" name="emailaddress" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($phone_error === true):?>
                                    <div class="alert alert-danger col-sm-offset-2">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                        <div>
                                            Phone number is already exists. Try again with other phone number, please.
                                        </div>
                                    </span>
                                    </div>
                                <?php endif;?>
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Phone Number</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-phone fa-fw"></i>
                                                <input id="userphone" value="+92-" class="form-control" size="15" maxlength="15" type="text" name="userphone" placeholder="Phone Number:+92-xxx-xxxxxxx" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-right">
                                        <button type="submit" class="btn btn-large red-sunglo margin-right-10" style="width: 100%;">Create</button>
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

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