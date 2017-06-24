
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
                Cancelled Orders
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>

                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/order">Order</a>
                    </li>

                </ul>
                <div class="page-toolbar">

                </div>
            </div>
            <!-- END PAGE HEADER-->

            <div class="row margin-bottom-10">

            </div>

            <!-- begin accepted -->
            <div class="row">
                <div class="portlet box green-jungle">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold ">Cancelled orders</span>
                        </div>

                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <!--Begin Search and filters-->
                        <div class="table-toolbar">

                        </div>

                        <table class="col-sm-12 table table-condensed" id="order_cancelled_table">
                            <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Accepted Date
                                </th>
                                <th>
                                    Client name
                                </th>
                                <th>
                                    Service man
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0 ; $i < count($cancelled); $i++):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo $cancelled[$i]['created_at'];?></td>
                                    <td><?php echo $cancelled[$i]['updated_at'];?></td>
                                    <td><?php echo $cancelled[$i]['client']['0']['user_name'];?> &nbsp;(<?php echo $cancelled[$i]['client']['0']['user_phone'];?>)</td>
                                    <td><?php echo $cancelled[$i]['service']['0']['user_name'];?> &nbsp;(<?php echo $cancelled[$i]['service']['0']['user_phone'];?>)</td>
                                    <td><a href="<?php echo base_url();?>admin/order/view/<?php echo $cancelled[$i]['id']?>" class="btn btn-small green-jungle"><i class="fa fa-map-marker"></i> View position</a></td>
                                </tr>
                            <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end accepted -->
        </div>
    </div>
    <!-- END CONTENT -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->


<div class="page-footer">
    <div class="page-footer-inner">
        2016 &copy; SAHULAT company All rights recancelled.
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
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--BEGIN PAGINATION-->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/order-table-managed.js"></script>
<!--END PAGINATION-->

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