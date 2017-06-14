<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>



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
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
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
                        <table class="col-sm-12 table table-striped" id="order_pend_table">
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
                                <th>

                                </th>

                            </tr>
                            </thead>
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
<script type="text/javascript" charset="utf-8">
    var data_array_list = [];
    $(document).ready(function() {

        var table = $('#order_pend_table').dataTable( {
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
                    "orderable": false,
                    "visible":false
                }
            ]
            ,
            "columnDefs": [
                {
                "targets": [7],
                "data": [null, undefined],
                "defaultContent": ['<button  class="btn btn-small green-jungle" id="edit_btn" type="button">Edit</button>']
                }
                ,
                {
                    "targets": [8],
                    "data": [ undefined],
                    "defaultContent": ['<button class="btn btn-small red-sunglo" id="assign_btn" type="button">Assign</button>']
                }
            ]
        } );


        $('#order_pend_table tbody').on( 'click', 'button', function (e) {
            if(this.id == "edit_btn")
            {
                var data = table.api().row($(this).parents('tr')).data();
                window.location.assign("<?php echo base_url();?>admin/order/edit_order/"+data[ 6 ]);

            }
            if(this.id == "assign_btn")
            {
                var data = table.api().row($(this).parents('tr')).data();
                window.location.assign("<?php echo base_url();?>admin/order/assign_order/"+data[ 6 ]);

            }

        } );
        ajaxpost();
    });

    function ajaxpost()
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/order/pending_API"); ?>",
            data: {data : ""},
            cache: false,
            success: function(result){
                var table = $('#order_pend_table').dataTable();
                data = JSON.parse(result);
                var no = 0;
                if(data_array_list.length < data.length){
                    data_array_list = data;
                    table.fnClearTable();
                    $.each(data, function(index, data) {
                        no++;
                        var serviceman = "";

                        if( typeof(data.service[0])!= 'undefined'){
                            serviceman =  data.service[0]['user_name']+"("+data.service[0]['user_phone']+")";
                        }
                        //!!!--Here is the main catch------>fnAddData
                        table.fnAddData( [
                                no,
                                data.client[0]['user_name'],
                                serviceman,
                                data.created_at,
                                data.updated_at,
                                data.order_date,
                                data.id,

                            ]
                        );
                    });
                }
                setTimeout(ajaxpost, 5000);

            }
        });
    };

</script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
    });


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
