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
                Manage orders
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li style="margin-top: 8px;">
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/order/pending">Orders</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="">create new order</a>
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
                                <span class="caption-subject bold"> Create New Order</span>
                            </div>
                            <div class="tools">
                                <a href="" class="collapse"></a>
                            </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo  base_url();?>admin/order/manage">
                            <div class="form-body">

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Client Name</div>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <select name = "client_list" class="form-control select2me" data-placeholder="Select..." id="client_list">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                        <div class="col-sm-2 control-label">Deliver Time</div>
                                        <div class="col-sm-10">
                                            <div class="input-group date form_datetime">
                                                <input id="date_time_order" name="date_time_order" type="text" size="16" readonly class="form-control" required>
                                                <span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">GPS location</div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="loc_lat" type="text" size="16"  class="form-control" required onkeypress="validate(event)">
                                            <span class="input-group-addon">
                                                - </span>
                                            <input name="loc_lot" type="text" size="16"  class="form-control" required onkeypress="validate(event)">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 control-label">Delivery Address</div>
                                    <div class="col-sm-10  ">
                                        <div class="input-group col-sm-12">
                                            <input name="client_address" type="text" size="16" class="form-control" required autocomplete="true">
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

<!-- BEGIN DATE TIME PICKER LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END DATE TIME PICKER LEVEL PLUGINS -->



<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        $('.input-group').find('.timepicker').timepicker('showWidget');
        ComponentsPickers.init();
        $.ajax({
            type:'POST',
            url: "<?php echo base_url()?>admin/customer/list",
            data: {

            },
            success:function(data, status){
                $('#client_list').empty();
                if (data && data.length > 0) {
                    data=$.parseJSON( data ); //parse response string
                    for(i = 0 ; i < Object.keys(data).length; i++){
                        $('#client_list').append("<option value='" + data[i].id + "'>" + data[i].user_name + " (" + data[i].user_phone+")" + "</option>");
                    }
                }
            }
        });

    });
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\.|\-/;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>