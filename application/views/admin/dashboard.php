<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="https://maps.google.com/maps/api/js?key=<?php echo $this->config->item('google_map_key');?>"></script>
<script src="<?php echo base_url();?>assets/global/plugins/gmaps/gmaps.js" type="text/javascript"></script>
<link rel = "stylesheet" type ="text/css" href="<?php echo base_url();?>assets/global/plugins/chartist/chartist.min.css">
<script src="<?php echo base_url();?>assets/global/plugins/chartist/chartist.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
    var posArr = [];
    var map;
    var mychat;
    $(document).ready(function() {

        ajaxpost();
        var data = {
            labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
            series: [
                [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
            ]
        };

        var options = {
            high: 10,
            low: 0
        };




        map = new GMaps({
            el: '#dashboard_map',
            lat: "30",
            lng: "20"
        });

        ajaxgetdata();
        ajaxgetsummary();

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
        ajaxgetVisitNo();



    });

    function ajaxpost()
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetIntegratedData"); ?>",
            data: {data : ""},
            cache: false,
            success: function(result){
                var dataTable_1 = $('#table_1').dataTable();
                dataTable_1.fnClearTable();
                data = JSON.parse(result);
                data = data.tbData1;
                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    dataTable_1.fnAddData( [
                            data.no,
                            data.created_at,
                            data.State,
                            data.username,
                            data.servicename
                        ]
                    );
                });
                var dataTable_2 = $('#table_2').dataTable();
                dataTable_2.fnClearTable();
                data = JSON.parse(result);
                data = data.tbData2;
                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    dataTable_2.fnAddData( [
                            data.no,
                            data.username,
                            data.servicename,
                            data.State,
                            data.toryes
                        ]
                    );
                });
                var dataTable_3 = $('#table_3').dataTable();
                dataTable_3.fnClearTable();
                data = JSON.parse(result);
                data = data.tbData3;
                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    dataTable_3.fnAddData( [
                            data.no,
                            data.username,
                            data.created_date,
                            data.order_date
                        ]
                    );
                });
                var dataTable_4 = $('#table_4').dataTable();
                dataTable_4.fnClearTable();
                data = JSON.parse(result);
                data = data.tbData4;
                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    dataTable_4.fnAddData( [
                            data.no,
                            data.username,
                            data.created_date,
                            data.order_date
                        ]
                    );
                });
                var dataTable_5 = $('#table_5').dataTable();
                dataTable_5.fnClearTable();
                data = JSON.parse(result);
                data = data.tbData5;
                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    dataTable_5.fnAddData( [
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
                setTimeout(ajaxpost, 5000);
            }
        });
    };
    function ajaxgetdata()
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetPosData"); ?>",
            data: {data : ""},
            cache: false,
            success: function(result){
                posArr = JSON.parse(result);
                dashboard_map();
                setTimeout(ajaxgetdata, 5000);
            }
        });
    };
    function ajaxgetsummary()
    {
        $.ajax({
            type:"POST",
            url:"<?php echo base_url("admin/Dashboard/GetIntegratedSummary");?>",
            data:{data:""},
            cache:false,
            success: function(result){
                var ppp = JSON.parse(result);
                document.getElementById("noClientReg").innerHTML = ppp.noClientReg;
                document.getElementById("noCompleteOrder").innerHTML = ppp.noCompleteOrder;
                document.getElementById("noPendingOrder").innerHTML = ppp.noPendingOrder;
                document.getElementById("noClientOrder").innerHTML = ppp.noClientOrder;
                document.getElementById("noProcessedOrder").innerHTML = ppp.noProcessedOrder;
                setTimeout(ajaxgetsummary, 5000);
            }
        });
    };
    function ajaxgetVisitNo()
    {
        $.ajax({
            type:"POST",
            url:"<?php echo base_url("admin/Dashboard/getNoServiceManVisits");?>",
            data:{data:""},
            cache:false,
            success: function(result){

                var ppp = JSON.parse(result);

                var newData_visit = {
                    labels:ppp.labels,
                    series: [ppp.series_visit]
                };
                var newData_accept = {
                    labels:ppp.labels,
                    series: [ppp.series_accepted]
                };
                var newData_reject = {
                    labels:ppp.labels,
                    series: [ppp.series_rejected]
                };

                new Chartist.Bar('.ct-chart',newData_visit);
                new Chartist.Bar('.ct-chart1', newData_accept);
                new Chartist.Bar('.ct-chart2', newData_reject);

            }
        });

    }


    var dashboard_map = function () {
        if(posArr.length < 1) {
            return;
        }
        for(var i=0; i<posArr.length; i++)
        {
            map.addMarker({
                lat: posArr[i].lat,
                lng: posArr[i].log,
                title: 'Serivceman Position',
                infoWindow: {
                    content: "<b>"+posArr[i].servicename+"</b>(<b>"+posArr[i].servicephone+"</b>)"
                }
            })
        }
        map.setZoom(2);
    }
</script>


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

            <div>
                <table width ="100%">
                    <tr>
                        <td>
                            <h3 class="page-title">
                                Dashboard
                            </h3>
                        </td>
                        <td align="right" style="padding-right: 2%">
                            <div >
                                <img class="avatar" alt=""  width = "80" src="<?php echo base_url() ;?>assets/global/img/FiStar.png">
                                <b>50 Reviews          </b>
                            </div>
                            <div>
                                <img class="avatar" alt="" width = "80" src="<?php echo base_url();?>assets/global/img/FStar.png">
                                <b>23 Reviews          </b>
                            </div>
                            <div>
                                <img class="avatar" alt="" width = "80" src="<?php echo base_url();?>assets/global/img/thStar.png">
                                <b>40 Reviews          </b>
                            </div>
                            <div>
                                <img class="avatar" alt="" width = "80" src="<?php echo base_url();?>assets/global/img/tStar.png">
                                <b>30 Reviews          </b>
                            </div>
                            <div>
                                <img class="avatar" alt="" width = "80" src="<?php echo base_url();?>assets/global/img/oStar.png">
                                <b>10 Reviews          </b>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- BEGIN PAGE HEADER-->

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li style="margin-top: 8px;">
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashobard">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/dashboard">Dashboard</a>
                    </li>
                </ul>
            </div>

            <div class ="rows">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noFeedback">
                                1349
                            </div>
                            <div class="desc">
                                Feedbacks
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noClientReg">
                                0
                            </div>
                            <div class="desc">
                                Client Registration
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="details">
                            <div class="number" id = "noClientOrder">
                                1349
                            </div>
                            <div class="desc">
                                Client Orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>



                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-tag"></i>
                        </div>
                        <div class="details">
                            <div class="number" id ="noPendingOrder">
                                12,5M$
                            </div>
                            <div class="desc">
                                Pending Orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="noProcessedOrder">

                            </div>
                            <div class="desc">
                                Processed Orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-check-circle-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id = "noCompleteOrder">
                                12,5M$
                            </div>
                            <div class="desc">
                                Completed Orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp hide"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Site Visits</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="ct-chart"></div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp hide"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Acceptance </span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="ct-chart1"></div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp hide"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Reject</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="ct-chart2"></div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>



            </div>

            <!-- BEGIN GOOGLE MAP -->
            <div id="dashboard_map" class="gmaps" data-lat="10" data-lot="43.5212983">

            </div>
            <!-- END GOOGLE MAP-->
            <div >
                <div class ="portlet box blue-steel">
                    <div class = "portlet-title">
                        <div class="caption">
                            Table1
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="tabbable-line">
                            <div class="tab-content">
                                <div class="tab-pane active" id="overview_table1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id ="table_1">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class ="portlet box blue-steel">
                        <div class = "portlet-title">
                            <div class="caption">
                                Table2
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <div class="tabbable-line">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview_table2">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered" id ="table_2">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class ="portlet box blue-steel">
                        <div class = "portlet-title">
                            <div class="caption">
                                Table3
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <div class="tabbable-line">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview_table1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered" id ="table_3">
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
                        </div>
                    </div>
                </div>
            </div>

            <div >
                <div class ="portlet box blue-steel">
                    <div class = "portlet-title">
                        <div class="caption">
                            Table4
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="tabbable-line">
                            <div class="tab-content">
                                <div class="tab-pane active" id="overview_table1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id ="table_4">
                                            <thead>
                                            <tr>
                                                <th>
                                                    No
                                                </th>
                                                <th>
                                                    Client Name
                                                </th>
                                                <th>
                                                    Requested service time
                                                </th>
                                                <th>
                                                    Service assign time
                                                </th>
                                                <th>
                                                    Service man accepted or reject time
                                                </th>

                                                <th>
                                                    Completed time
                                                </th>
                                                <th>
                                                    Timezone difference
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
                    </div>
                </div>

            </div>
            <div  >
                <!-- BEGIN PORTLET-->
                <div class ="portlet box blue-steel">
                    <div class = "portlet-title">
                        <div class="caption">
                            Table5
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="tabbable-line">
                            <div class="tab-content">
                                <div class="tab-pane active" id="overview_table5">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id ="table_5">
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
                                                    Average response time to control room
                                                </th>
                                                <th>
                                                    Average response time to client
                                                </th>
                                                <th>
                                                    rating
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
