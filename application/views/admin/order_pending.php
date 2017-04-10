
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
			    New Orders
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url()?>admin/order/pending">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="">Order</a>
					</li>

				</ul>
				<div class="page-toolbar">

				</div>
			</div>
			<!-- END PAGE HEADER-->
              <!-- begin pending -->
            <div class="row">
                <div class="portlet box red-sunglo">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold ">Pending order</span>
                        </div>

                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <!--Begin Search and filters-->
                        <div class="table-toolbar">

                        </div>

                        <table class="col-sm-12 table table-condensed" id="order_pending_table">
                            <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Client name
                                </th>

                                <th>
                                    Awarded service man
                                </th>
                                <th>
                                    Created
                                </th>
                                <th>
                                    Last Update
                                </th>
                                <th>
                                    Duration
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php for($i = 0 ; $i < count($pending); $i++):?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $pending[$i]['client'][0]['user_name'];?>&nbsp;
                                            (<?php echo $pending[$i]['client'][0]['user_phone'];?>)
                                        </td>

                                        <td><?php
                                            if(isset($pending[$i]['service'][0]['user_name'])){
                                                echo $pending[$i]['service'][0]['user_name']." "."(".$pending[$i]['service'][0]['user_phone'].")";
                                            }
                                            else{
                                                echo "";
                                            }?></td>
                                        <td><?php echo $pending[$i]['created_at'];?></td>
                                        <td><?php echo $pending[$i]['updated_at'];?></td>
                                        <td><?php echo $pending[$i]['order_date'];?></td>
                                        <td><a href="<?php echo base_url();?>admin/order/edit_order/<?php echo $pending[$i]['id']?>" class="btn btn-small green-jungle">Edit</a></td>
                                        <td><a href="<?php echo base_url();?>admin/order/assign_order/<?php echo $pending[$i]['id']?>" class="btn btn-small red-sunglo">Assign</a></td>
                                    </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end pending -->



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
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--BEGIN PAGINATION-->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/order-table-managed.js"></script>
<!--END PAGINATION-->

<!--- BEGIN DATEPICKER-->
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<!--- BEGIN DATEPICKER-->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar

        OrderTableManaged.init();
    });


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>