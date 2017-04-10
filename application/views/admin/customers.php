
<!-- END HEADER -->
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
			Customers <small><?php echo count($userlist)?> user(s)</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li style="margin-top: 8px;">
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url()?>admin/customer">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url()?>admin/customer">Customers</a>
					</li>
				</ul>
				<div class="page-toolbar" style="padding: 8px;">
                    <div class="inputs">
                        <div class="portlet-input input-inline input-large">
                            <div class="input-group">
                                <input type="text" class="form-control input-circle-left" placeholder="search..." id="search_content_text" value="<?php echo $search?>">
                                <span class="input-group-btn">
										<button class="btn btn-circle-right btn-default blue-madison" type="button" onclick="onSearchClick()">Search</button>
                                </span>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<!-- END PAGE HEADER-->

            <!--BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <a href="<?php echo base_url();?>admin/customers/create" class="btn blue-madison pull-right">
                        <i class="icon-plus"></i>
                        Add new client
                    </a>
                </div>
            </div>


            <?php for($i = 0 ; $i < count($userlist); $i+=3):?>
            <div class="row ">

                <?php for($j = 0; $j < 3 ; $j++):?>
                    <?php if(($i+$j) < count($userlist)):?>
                    <div class="col-md-4">
                    <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold <?php if($userlist[$i+$j]->is_activated == 1):?>
                                    font-blue-steel
                                    <?php else:?>
                                    font-red-sunglo
                                    <?php endif;?>"><?php echo $userlist[$i+$j]->user_name?></span>
                                    <span class="caption-helper">detail information</span>
                                </div>
                                <div class="tools">
                                    <a href="" class="collapse"></a>
                                </div>
                            </div>
                            <div class="row portlet-body">
                                <div class="col-md-4">
                                    <?php $prog_value = 10;
                                            if($userlist[$i+ $j]->verified_phone == 1){
                                                $prog_value += 50;
                                            }
                                            if($userlist[$i+ $j]->verified_email == 1){
                                                $prog_value += 40;
                                            }?>
                                    <input class="knob" data-width="100" data-height="100" data-min="0" readonly="true" data-displayprevious=true value="<?php echo $prog_value?>">
                                </div>
                                <div class="col-md-8">
                                    <h5 style="color: #8896a0;">
                                        <span class="fa fa-envelope-o"></span> <?php echo $userlist[$i+$j]->user_email?>
                                        <?php if($userlist[$i+$j]->verified_email == 1):?>
                                            <span class="fa fa-check font-blue"></span>
                                        <?php else:?>
                                            <span class="fa fa-times font-red-sunglo"></span>
                                        <?php endif;?>
                                    </h5>
                                    <h5 style="color: #8896a0;">
                                        <span class="fa fa-phone"></span> <?php echo $userlist[$i+$j]->user_phone?>
                                        <?php if($userlist[$i+$j]->verified_phone == 1):?>
                                            <span class="fa fa-check font-blue"></span>
                                        <?php else:?>
                                            <span class="fa fa-times font-red-sunglo"></span>
                                        <?php endif;?>
                                    </h5>
                                    <h5 style="color: #8896a0; ">Joined at: <?php echo $userlist[$i + $j]->created_at?></h5>
                                    <div class="col-sm-12">
                                        <a href="<?php echo base_url();?>admin/customer/<?php echo $userlist[$i + $j]->id?>" class="btn btn-default bg-blue-madison col-sm-5" >Details</a>
                                        <a href="<?php echo base_url();?>admin/customer/edit/<?php echo $userlist[$i + $j]->id?>" class="btn btn-default bg-red-sunglo col-sm-5" >Edit</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endfor;?>
            </div>
            <?php endfor;?>
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

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-knob/js/jquery.knob.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-knob-dials.js"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        ComponentsKnobDials.init();
    });

    function onSearchClick(){
        search_value = $('#search_content_text').val();
        if(search_value != ""){
            window.location.assign("<?php echo base_url();?>admin/customers/search/" + search_value);
        }
        else{
            window.location.assign("<?php echo base_url();?>admin/customers");
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

