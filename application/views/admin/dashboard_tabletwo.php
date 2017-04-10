<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function() {
      ajaxpost();
        var table = $('#tabletwo').DataTable( {
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
    });

    function ajaxpost()
    {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/Dashboard/GetJsonDataTableTwo"); ?>",
            data: {data : ""},
            cache: false,
            success: function(result){

                var table = $('#tabletwo').dataTable();
                 table.fnClearTable();

                data = JSON.parse(result);

                $.each(data, function(index, data) {
                    //!!!--Here is the main catch------>fnAddData
                    table.fnAddData( [
                            data.no,
                            data.username,
                            data.servicename,
                            data.State,
                            data.toryes
                        ]
                    );
                });

                //setTimeout(ajaxpost, 1000);

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
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Table1
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url()?>admin/dashboard">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="">Dashboard</a>
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
                            <span class="caption-subject bold ">Table2</span>
                        </div>

                        <div class="tools">
                            <a href="" class="collapse"></a>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <!--Begin Search and filters-->
                        <div class="table-toolbar">

                        </div>

                        <table class="col-sm-12 table table-condensed" id="tabletwo">
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
        2016 &copy; SAHULAT company All rights reserved.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>




<!--BEGIN PAGINATION-->
 <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!--END PAGINATION-->

