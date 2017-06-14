
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Order details information</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="">Order</a>
                        <i class="fa fa-angle-right"></i>
					</li>
                    <li>
                        <a href=""><?= substr($orderdetail['0']['updated_at'],0,10);?></a>
                    </li>
				</ul>

			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN ORDER DETAILS -->
            <div class="row">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold "> Order Detail View</span>
                        </div>

                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>
                    </div>

                    <div class="portlet-content portlet-body">
                        <!--BEGIN ORDER DETAILS VIEW TABLE-->
                        <table class="table table-condensed">
                            <thead>
                            <tr>

                                <th>
                                    Created Date
                                </th>
                                <th>
                                    Client
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Service man
                                </th>
                                <th>
                                    Status
                                </th>
                                <?php if ($orderdetail['0']['status'] == '2'):?>
                                <th>
                                    Feedback
                                </th>
                                <?php endif;?>
                                <th>
                                    Last updated date
                                </th>
                                <th>
                                    Order Expectation Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td><?php echo $orderdetail['0']['created_at']?></td>
                                    <td><?php echo $client_name?></td>
                                    <td><?php echo $orderdetail['0']['ord_address']?></td>
                                    <td><?php echo $service_name?></td>
                                    <td>
                                        <?php if ($orderdetail['0']['status'] == '0'):?>
                                            <span class="label bg-red-sunglo">pending</span>
                                        <?php elseif ($orderdetail['0']['status'] == '1'):?>
                                            <span class="label bg-green-jungle">accepted</span>
                                        <?php elseif ($orderdetail['0']['status'] == '2'):?>
                                            <span class="label bg-blue-madison">completed</span>
                                        <?php endif;?>
                                    </td>
                                    <?php if ($orderdetail['0']['status'] == '2'):?>
                                        <td>
                                            <div class="star-ratings">
                                                <select id="user_ratingbar" name="rating" readonly="true" autocomplete="off">
                                                    <?php
                                                        for ($i=1;$i < 6; $i++){
                                                            $temp = "<option value='".$i."' ";
                                                            if($i == $orderdetail['0']['ord_feedback']){
                                                                $temp .= " selected";
                                                            }
                                                            $temp .= ">".$i."</option>";
                                                            echo $temp;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    <?php endif;?>
                                    <td><?php echo $orderdetail['0']['updated_at']?></td>
                                    <td><?php echo $orderdetail['0']['order_date']?></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--END ORDER DETAILS VIEW TABLE-->

                        <!-- BEGIN GOOGLE MAP -->
                        <div id="google_map" class="gmaps" data-name="<?php echo $orderdetail['0']['ord_lat'];?>" data-value="<?php echo $orderdetail['0']['ord_long'];?>">

                        </div>
                        <!-- END GOOGLE MAP-->
                    </div>
                </div>
            </div>
			<!-- END ORDER DETAILS -->
		</div>
	</div>
	<!-- END CONTENT -->

	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->


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
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN GOOGLE MAP PLUGINS -->
<script src="https://maps.google.com/maps/api/js?key=<?php echo $this->config->item('google_map_key');?>"></script>
<script src="<?php echo base_url();?>assets/global/plugins/gmaps/gmaps.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/maps-google.js" type="text/javascript"></script>
<!-- END GOOGLE MAP PLUGINS -->
<!--BEGIN RATEBAR-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ratebar/jquery.barrating.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/bootstrap-ratingbar.js"></script>
<!--END RATEBAR-->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        MapsGoogle.initmapmarker();
        BootStrapRatingBar.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
