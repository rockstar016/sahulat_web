<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function() {
        ajaxpost();

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
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Dashboard
            </h3>
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

