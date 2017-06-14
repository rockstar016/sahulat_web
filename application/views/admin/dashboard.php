


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
            <!--BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Dashboard <small>reports & statistics</small>
            </h3>


            <!-- BEGIN PAGE HEADER-->

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/dashboard">Dashboard</a>
                    </li>
                </ul>
                <div class="page-toolbar">

                        <div class="form-body" >
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="input-group input-large date-picker input-daterange" data-date="<?php echo $end_date;?>" data-date-format="yyyy-mm-dd">
                                    <input id="from" type="text" class="form-control" name="from" value="<?php echo $start_date;?>">
                                    <span class="input-group-addon">
												to </span>
                                    <input id="to" type="text" class="form-control" name="to" value="<?php echo $end_date;?>">
                                    <span class="input-group-btn">
                                        <button onclick="onClickRefresh()" class="btn btn-small">View</button>
                                    </span>
                                </div>
                            </div>

                        </div>

                </div>
            </div>

            <!---Dashboard top items -->
            <div class ="rows col-sm-12">
                <div class="col-sm-4">
                    <div class="dashboard-stat yellow-casablanca">
                        <div class="visual">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noFeedback">
                                0
                            </div>
                            <div class="desc">
                                Feedbacks
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Total feedback <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="dashboard-stat yellow-casablanca">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noClientReg">
                                0
                            </div>
                            <div class="desc">
                                Registered clients
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Whole client <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="dashboard-stat yellow-casablanca">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noServiceReg">
                                0
                            </div>
                            <div class="desc">
                                Registered service member
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Whole members <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--End first items-->

            <!---Dashboard second items -->
            <div class ="rows col-sm-12">
                <div class="col-sm-3">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noTotalOrders">
                                0
                            </div>
                            <div class="desc">
                                Total orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="dashboard-stat red-sunglo">
                        <div class="visual">
                            <i class="fa fa-th-list"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noPendingOrders">
                                0
                            </div>
                            <div class="desc">
                                Pending
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Whole client <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="dashboard-stat green-jungle">
                        <div class="visual">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noProcessOrders">
                                0
                            </div>
                            <div class="desc">
                                Processing
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Whole members <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noCompletedOrders">
                                0
                            </div>
                            <div class="desc">
                                Completed
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            Whole members <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--End second items-->

            <!--Dashboard row chart--->
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Order statistic
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="pie_static" class="chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Order history
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="series_chart" class="chart">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--End Chart Region-->

            <!-- BEGIN GOOGLE MAP -->
            <div id="dashboard_map" class="gmaps margin-bottom-15" data-lat="10" data-lot="43.5212983">

            </div>
            <!-- END GOOGLE MAP-->

            <div >
                <div class ="portlet box blue-steel">
                    <div class = "portlet-title">
                        <div class="caption">
                            Status of Orders in Duration
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="col-sm-12 table table-striped table-hover table-bordered" id ="table_1">
                            <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Client name
                                </th>
                                <th>
                                    Service man
                                </th>
                                <th>
                                    Created Date
                                </th>
                                <th>
                                    State
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class ="portlet box purple-intense">
                        <div class = "portlet-title">
                            <div class="caption">
                                Recently Orders(Today, Yesterday)
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="col-sm-12 table table-striped table-hover table-bordered" id ="table_2">
                                <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Client Name
                                    </th>
                                    <th>
                                        Service name
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class ="portlet box red-sunglo">
                        <div class = "portlet-title">
                            <div class="caption">
                                Postdated Orders
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <table class="col-sm-12 table table-striped table-hover table-bordered" id ="table_3">
                                <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Client Name
                                    </th>
                                    <th>
                                        Created Date
                                    </th>
                                    <th>
                                        Request date
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div >
                <div class ="portlet box blue-steel">
                    <div class = "portlet-title">
                        <div class="caption">
                            Completed Orders In Duration
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="col-sm-12 table table-striped table-hover table-bordered" id ="table_4">
                            <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Client Name
                                </th>

                                <th>
                                    Request date
                                </th>
                                <th>
                                    created time
                                </th>
                                <th>
                                    Completed time
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
            <div>
                <!-- BEGIN PORTLET-->
                <div class ="portlet box green-jungle">
                    <div class = "portlet-title">
                        <div class="caption">
                            Service team member information
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="col-sm-12 table table-striped table-hover table-bordered" id ="table_5">
                            <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Service Name
                                </th>
                                <th>
                                    Phone Number
                                </th>
                                <th>
                                    Job Pending
                                </th>
                                <th>
                                    Job Assigned
                                </th>
                                <th>
                                    Job Processed
                                </th>
                                <th>
                                    Job Completed
                                </th>
                                <th>
                                    Average response to control room
                                </th>
                                <th>
                                    Average response to client
                                </th>
                                <th>
                                    rating
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- END PORTLET-->
            </div>

            <!-- END PAGE HEADER-->
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
<!-- BEGIN JAVASCRIPTS-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="https://maps.google.com/maps/api/js?key=<?php echo $this->config->item('google_map_key');?>"></script>
<script src="<?php echo base_url();?>assets/global/plugins/gmaps/gmaps.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.categories.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.stack.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.crosshair.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/charts-flotcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" charset="utf-8">
    var posArr = [], markers = [];
    var map;
    var current_table_1_array = [], current_table_2_array = [], current_table_3_array = [], current_table_4_array = [], current_table_5_array = [];
    var timer1, timer2, timer3, timer4;
    $(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        ChartsFlotcharts.initPieCharts(0,0,0,0);
        ChartsFlotcharts.initLineCharts();
        ComponentsPickers.init();
        map = new GMaps({
            el: '#dashboard_map',
            lat: "30.3753",
            lng: "69.3451"
        });
        map.setZoom(8);
        $('#table_1').DataTable( {
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                }
            ]
        } );
        $('#table_2').DataTable( {
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                }
            ]
        } );
        $('#table_3').DataTable( {
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                }
            ]
        } );
        $('#table_4').DataTable( {
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                }
            ]
        } );
        $('#table_5').DataTable( {
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                }
            ]
        } );

        onClickRefresh();

    });

    function onClickRefresh(){
        clearTimeout(timer1);
        clearTimeout(timer2);
        clearTimeout(timer3);
        clearTimeout(timer4);
        ajaxInitTables();
        ajaxgetsummary();
        ajaxgetChartData();
        ajaxgetPosition();
    };

    //checked
    function ajaxgetChartData(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetChartData"); ?>",
            data: {
                start_date:$('#from').val(),
                end_date:$('#to').val()},
            cache: false,
            success: function(result){
                posArr = JSON.parse(result);
                ChartsFlotcharts.initPieCharts(posArr.pie_static.total, posArr.pie_static.complete, posArr.pie_static.accept, posArr.pie_static.pending);
                ChartsFlotcharts.initLineCharts(posArr.flot_static);
                timer3 = setTimeout(ajaxgetChartData, 5000);
            }
        });
    };

    function ajaxInitTables() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetIntegratedData"); ?>",
            data:
                {
                    start_date:$('#from').val(),
                    end_date:$('#to').val()
                },
            cache: false,
            success: function(result){
                var dataTable_1 = $('#table_1').dataTable();

                data = JSON.parse(result);

                data = data.tbData1;
                if(current_table_1_array.length < data.length){
                    current_table_1_array = data;
                    dataTable_1.fnClearTable();
                    $.each(data, function(index, data) {
                        //!!!--Here is the main catch------>fnAddData
                        dataTable_1.fnAddData( [
                                data.no ,
                                data.username,
                                data.servicename,
                                data.created_at,
                                data.State
                            ]
                        );
                    });
                }


                var dataTable_2 = $('#table_2').dataTable();
                data = JSON.parse(result);
                data = data.tbData2;
                if(current_table_2_array.length < data.length) {
                    dataTable_2.fnClearTable();
                    current_table_2_array = data;
                    $.each(data, function (index, data) {
                        //!!!--Here is the main catch------>fnAddData
                        dataTable_2.fnAddData([
                                data.no,
                                data.username,
                                data.servicename,
                                data.State,
                                data.toryes
                            ]
                        );
                    });
                }


                var dataTable_3 = $('#table_3').dataTable();
                data = JSON.parse(result);
                data = data.tbData3;

                if(current_table_3_array.length < data.length) {
                    dataTable_3.fnClearTable();
                    current_table_3_array = data;
                    $.each(data, function (index, data) {
                        //!!!--Here is the main catch------>fnAddData
                        dataTable_3.fnAddData([
                                data.no,
                                data.username,
                                data.created_date,
                                data.order_date
                            ]
                        );
                    });
                }


                var dataTable_4 = $('#table_4').dataTable();
                data = JSON.parse(result);
                data = data.tbData4;
                if(current_table_4_array.length < data.length) {
                    dataTable_4.fnClearTable();
                    current_table_4_array = data;
                    $.each(data, function (index, data) {
                        //!!!--Here is the main catch------>fnAddData

                        dataTable_4.fnAddData([
                                data.no,
                                data.username,
                                data.order_date,
                                data.created_date,
                                data.completed_date
                            ]
                        );
                    });
                }

                var dataTable_5 = $('#table_5').dataTable();
                data = JSON.parse(result);
                data = data.tbData5;
                if(current_table_5_array.length < data.length) {
                    dataTable_5.fnClearTable();
                    current_table_5_array = data;
                    $.each(data, function (index, data) {
                        //!!!--Here is the main catch------>fnAddData
                        dataTable_5.fnAddData([
                                data.no,
                                data.servicename,
                                data.phonenum,
                                data.JobPend,
                                data.Job_Assign,
                                data.JobProcess,
                                data.JobComplete,
                                data.AvgRespControl,
                                data.AvgrepClient,
                                data.rating
                            ]
                        );
                    });
                }
                timer1 = setTimeout(ajaxInitTables, 9000);
            }
        });
    };

    function ajaxgetPosition() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetPosData"); ?>",
            data: {data : ""},
            cache: false,
            success: function(result){
                posArr = JSON.parse(result);
                dashboard_map();
                timer4 = setTimeout(ajaxgetPosition, 8000);
            }
        });
    };

    //checked
    function ajaxgetsummary() {

        $.ajax({
            type:"POST",
            url:"<?php echo base_url("admin/Dashboard/GetIntegratedSummary");?>",
            data:{
                start_date:$('#from').val(),
                end_date:$('#to').val()
            },
            cache:false,
            success: function(result){
                var ppp = JSON.parse(result);
                document.getElementById("noClientReg").innerHTML = ppp.noClientReg;
                document.getElementById("noServiceReg").innerHTML = ppp.noServiceReg;
                document.getElementById("noFeedback").innerHTML = ppp.noFeedback;

                document.getElementById("noTotalOrders").innerHTML = ppp.noTotalOrders;
                document.getElementById("noPendingOrders").innerHTML = ppp.noPendingOrders;
                document.getElementById("noProcessOrders").innerHTML = ppp.noProcessOrders;
                document.getElementById("noCompletedOrders").innerHTML = ppp.noCompletedOrders;
                timer2 = setTimeout(ajaxgetsummary, 8000);
            }
        });
    };

    var dashboard_map = function () {
        if(posArr.length < 1) {
            return;
        }

        for(var i = 0 ; i < markers.length ; i++){
            markers[i].setMap(null);
        }

        markers = [];

        for(var i=0; i<posArr.length; i++)
        {
            var tmp_marker =  map.addMarker({
                lat: posArr[i].lat,
                lng: posArr[i].log,
                title: posArr[i].servicename,
                infoWindow: {
                    content: "<b>"+posArr[i].servicename+"</b>(<b>"+posArr[i].servicephone+"</b>)"
                }
            });
            tmp_marker.show
            markers.push(tmp_marker);
        }
    };

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
