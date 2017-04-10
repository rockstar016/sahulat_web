
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
						<a href="">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url()?>admin/order/pending">Order</a>
                        <i class="fa fa-angle-right"></i>
					</li>
                    <li>
                        <a href=""><?= substr($order['0']['updated_at'],0,10);?></a>
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
                                    Duration Date
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td><?php echo $order['0']['created_at'];?></td>
                                    <td><?php echo $client['0']['user_name'];?></td>
                                    <td><?php echo $order['0']['ord_address'];?></td>
                                    <td>
                                        <div class="input-group col-sm-12">
                                            <select name = "serviceman_list" class="form-control select2me"  data-placeholder="Select..." id="serviceman_list">

                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $order['0']['order_date']?></td>
                                    <td><button id="bt_assign" class="btn red-sunglo" data-value="<?php echo $order['0']['id']?>" onclick="OnClickAssignButton()">Assign Order</button> </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--END ORDER DETAILS VIEW TABLE-->

                        <!-- BEGIN GOOGLE MAP -->
                        <div id="client_service_map" class="gmaps" data-lat="<?php echo $order['0']['ord_lat'];?>" data-lot="<?php echo $order['0']['ord_long'];?>">

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
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN GOOGLE MAP PLUGINS -->
<script src="http://maps.google.com/maps/api/js?key=<?php echo $this->config->item('google_map_key');?>" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/gmaps/gmaps.js" type="text/javascript"></script>

<!-- END GOOGLE MAP PLUGINS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        $.ajax({
            type:'POST',
            url: "<?php echo base_url()?>admin/customer/service_list",
            data: {

            },
            success:function(data, status){
                $('#client_list').empty();
                if (data && data.length > 0) {
                    data=$.parseJSON( data ); //parse response string
                    for(i = 0 ; i < Object.keys(data).length; i++){
                        $('#serviceman_list').append("<option value='" + data[i].id + "'>" + data[i].user_name + " (" + data[i].user_phone + " )" + "</option>");
                    }
                    $('#serviceman_list').select2().trigger('change');
                }
            }
        });
        client_service_map();
        $('#serviceman_list').on("change",function(){
            service_man_id = $('#serviceman_list').val();
            $.ajax({
                type:'POST',
                url: "<?php echo base_url()?>admin/service/getposition",
                data: {
                    serv_id: service_man_id
                },
                success:function(data, status){
                    if (data && data.length > 0) {
                        data=$.parseJSON( data ); //parse response string
                        map.removeMarkers();
                        map.addMarker({
                            lat: lat,
                            lng: lot,
                            title: 'Client Position',
                            infoWindow:{
                                content: "<b>Client Position</b>"
                            }
                        });

                        map.addMarker({
                            icon:"<?php echo base_url();?>assets/admin/pages/img/marker_service.png",
                            lat: data[0]['service_cur_lat'],
                            lng: data[0]['service_cur_long'],
                            title: "Selected service member position",
                            infoWindow:{
                                content: "<b>Selected service member position</b>"
                            }
                        });

                        map.setZoom(10);
                    }
                }
            });
        });
    });

    var client_service_map = function () {
        lat = $('#client_service_map').data('lat');
        lot = $('#client_service_map').data('lot');
        map = new GMaps({
            el: '#client_service_map',
            lat: lat,
            lng: lot
        });

        map.addMarker({
            lat: lat,
            lng: lot,
            title: 'Client Position',
            infoWindow:{
                content: "<b>Client Position</b>"
            }
        });
        map.setZoom(10);
    }
    function OnClickAssignButton(){
        service_man_id = $('#serviceman_list').val();
        ord_id = $('#bt_assign').data('value');

        $.ajax({
            type:'POST',
            url: "<?php echo base_url()?>admin/order/assign_order_api",
            data: {
                service_id: service_man_id,
                order_id:ord_id
            },
            success:function(data, status){

            },
            error:function(){

            }
        });

        $.ajax({
            type:'POST',
            url: "<?php echo base_url()?>admin/order/gettoken",
            data: {
                service_id: service_man_id,
            },
            success:function(data, status){
                if (data && data.length > 0) {
                    data = $.parseJSON(data);
                    var fb_token = data.fb_token;
                    var key = data.key;

                    var json = {
                        "to": fb_token,
                        "notification": {
                            "title": "New task",
                            "body": "You have new task"
                        },
                        "data": {
                            "title": "New task",
                            "body": "You have new task"
                        }
                    };

                    $.ajax({
                        url: 'https://fcm.googleapis.com/fcm/send',
                        type: "POST",
                        processData : false,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('Authorization', 'key=' + key);
                        },
                        data: JSON.stringify(json),
                        success: function (data, status) {
                            window.location.assign("<?php echo base_url();?>admin/order/pending");
                        },
                        error: function(error) {
                            window.alert("Failed to send push notification to service team. Use your phone to send client information, please");
                            window.location.assign("<?php echo base_url();?>admin/order/pending");
                        }
                    });
                }
            },
            error:function(){

            }
        });
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
