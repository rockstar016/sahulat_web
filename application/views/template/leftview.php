<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>

                        <li class="start <?php if ($category == 0) echo 'active open';?>">

                <a href="javascript:;">

                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <?php if($category == 0) echo '<span class="selected">';?></span>
                    <span <?php if($category == 0 ) echo 'class="arrow open"'; else echo 'class = "arrow"';?>></span>

                </a>

                <ul class="sub-menu">

                    <li  <?php if($category == 0 && $sub_category == 0) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/summary">
                            Summary</a>
                    </li>

                    <li  <?php if($category == 0 && $sub_category == 1) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/tableone">
                            Table1</a>
                    </li>

                    <li <?php if($category == 0 && $sub_category == 2) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/tabletwo">
                            Table2</a>
                    </li>

                    <li <?php if($category == 0 && $sub_category == 3) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/tablethree">
                            Table3</a>
                    </li>

                    <li <?php if($category == 0 && $sub_category == 4) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/tablefour">
                            Table4</a>
                    </li>

                    <li <?php if($category == 0 && $sub_category == 5) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/dashboard/tablefive">
                            Table5</a>
                    </li>

                </ul>
            </li>

            <li class="start <?php if ($category == 0) echo 'active open';?>">

                <a href="javascript:;">

                    <i class="icon-user"></i>
                    <span class="title">Users</span>
                    <?php if($category == 0) echo '<span class="selected">';?></span>
                    <span <?php if($category == 0 ) echo 'class="arrow open"'; else echo 'class = "arrow"';?>></span>

                </a>

                <ul class="sub-menu">

                    <li  <?php if($category == 0 && $sub_category == 0) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/customers">
                            Customers</a>
                    </li>

                    <li <?php if($category == 0 && $sub_category == 1) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/service">
                            Service man</a>
                    </li>

                </ul>

            </li>

            <li <?php if($category == 1) echo 'class="active"'?>>

                <a href="<?php echo base_url();?>admin/order">
                    <i class="icon-basket"></i>
                    <span class="title">Orders</span>
                    <?php if($category == 1) echo "<span class=\"selected\"></span>";?>
                    <span <?php if($category == 1 ) echo 'class="arrow open"'; else echo 'class = "arrow"';?>></span>
                </a>

                <ul class="sub-menu">

                    <li <?php if($category == 1 && $sub_category == 0) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/order/manage">
                            Create</a>
                    </li>

                    <li <?php if($category == 1 && $sub_category == 1) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/order/pending">
                            Pending</a>
                    </li>

                    <li <?php if($category == 1 && $sub_category == 2) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/order/show_accept">
                            Accepted</a>
                    </li>

                    <li <?php if($category == 1 && $sub_category == 3) echo 'class="active"';?>>
                        <a href="<?php echo base_url();?>admin/order/complete">
                            Completed</a>
                    </li>
                </ul>

            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
