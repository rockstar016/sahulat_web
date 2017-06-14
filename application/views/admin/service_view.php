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
                User Information<small>&nbsp;<?php
                    echo $user[0]['user_name'];
                    ?></small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li style="margin-top: 8px;">
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/service">Service team members</a>
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
                <div class="portlet">
                    <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject bold font-blue-steel"> Member Profile Information</span>
                            </div>
                            <div class="tools">
                                <a href="" class="collapse"></a>
                            </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Information
                                    </th>
                                    <th>
                                        Verified
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        Member Name
                                    </th>
                                    <th>
                                        <?php
                                            echo $user[0]['user_name'];
                                        ?>
                                    </th>
                                    <th>
                                        <span class="fa fa-check font-blue"></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Phone number
                                    </th>
                                    <th>
                                        <?php
                                            echo $user[0]['user_phone'];
                                        ?>
                                    </th>
                                    <th>
                                        <?php if($user[0]['verified_phone'] == true):?>
                                            <span class="fa fa-check font-blue"></span>
                                        <? else:?>
                                            <span class="fa fa-times font-red-sunglo"></span>
                                        <? endif;?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Email address
                                    </th>
                                    <th>
                                        <?php
                                            echo $user[0]['user_email'];
                                        ?>
                                    </th>
                                    <th>
                                        <?php if($user[0]['verified_email'] == true):?>
                                            <span class="fa fa-check font-blue"></span>
                                        <? else:?>
                                            <span class="fa fa-times font-red-sunglo"></span>
                                        <? endif;?>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END USER PROFILE DETAILS-->


            <!-- BEGIN OF PORTLET HISTORY-->
            <div class="row">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold "> Member Order History</span>
                        </div>

                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <!--Begin Search and filters-->
                        <div class="table-toolbar">

                        </div>

                        <table class="col-sm-12 table table-condensed" id="customer_order_history">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Position
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i = 0 ; $i < count($orderlist); $i++):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo $orderlist[$i]['updated_at']?></td>
                                    <?php if($orderlist[$i]['status'] == 0):?>
                                        <td><span class="label bg-red-sunglo">pending</span> </td>
                                    <?php elseif ($orderlist[$i]['status'] == 1):?>
                                        <td><span class="label bg-green-jungle">accepted</span> </td>
                                    <?php elseif ($orderlist[$i]['status'] == 2):?>
                                        <td><span class="label bg-blue-madison">completed</span> </td>
                                    <?php endif;?>

                                    <td><a class="btn btn-xs blue-madison" href="<?php echo base_url().'admin/order/view/'.$orderlist[$i]['id'];?>"><i class="fa fa-map-marker"></i> Show Details </a></td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END OF PORTLET USER HISTORY-->
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


<!--BEGIN PAGINATION-->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/table-managed.js"></script>
<!--END PAGINATION-->



<!--END DATEPICKER-->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar

        TableManaged.init();

    });
    
    function OnClickRefreshStatistic() {
        window.alert("click");
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>