<?php
//storing all logic here
$total_items = DashboardStats::getTotalItems();
$total_books = DashboardStats::getTotalItems("Books");
$total_others = DashboardStats::getTotalItems("Books", true);
$total_booksin_perc = ($total_items > 0) ? ($total_books * 100) / $total_items : 0;
$total_others_perc = ($total_items > 0) ? ($total_others * 100) / $total_items : 0;

//get total orders 

$total_orders = DashboardStats::getTotalOrders();
$total_orders_ship = DashboardStats::getTotalOrders("Shipped");
$total_orders_ship_perc = $total_orders > 0 ? ($total_orders_ship * 100) / $total_orders : 0;
$total_orders_pend = DashboardStats::getTotalOrders("Pending");
$total_orders_pend_perc = $total_orders > 0 ? ($total_orders_pend * 100) / $total_orders : 0;
$total_orders_canc = DashboardStats::getTotalOrders("Cancelled");
$total_orders_canc_perc = $total_orders > 0 ? ($total_orders_canc * 100) / $total_orders : 0;

$total_orders_ref = DashboardStats::getTotalOrders("Refunded");
$total_orders_ref_perc = ($total_orders > 0) ? ($total_orders_ref * 100) / $total_orders : 0;
?>
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <td width="50%">Total Items</td>
            <td>
                <div class="progress progress-danger"  alt="<?php echo $total_items; ?>" title="<?php echo $total_items; ?>">
                    <div class="bar" style="width: 100%" alt="<?php echo $total_items; ?>" title="<?php echo $total_items; ?>"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Books</td>
            <td>
                <div class="progress progress-warning" alt="<?php echo $total_books; ?>" title="<?php echo $total_books; ?>">
                    <div class="bar" style="width: <?php echo $total_booksin_perc ?>%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Other Items</td>
            <td>
                <div class="progress progress-success" alt="<?php echo $total_others; ?>" title="<?php echo $total_others; ?>">
                    <div class="bar" style="width: <?php echo $total_others_perc ?>%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Total Orders</td>
            <td>
                <div class="progress progress-info" alt="<?php echo $total_orders; ?>" title="<?php echo $total_orders; ?>">
                    <div class="bar" style="width: 100%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Shipped Orders</td>
            <td>
                <div class="progress progress-info" alt="<?php echo $total_orders_ship_perc; ?>" title="<?php echo $total_orders_ship_perc; ?>">
                    <div class="bar" style="width: <?php echo $total_orders_ship_perc; ?>%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Pending Orders</td>
            <td>
                <div class="progress progress-info" alt="<?php echo $total_orders_ship; ?>" title="<?php echo $total_orders_ship; ?>">
                    <div class="bar" style="width: <?php echo $total_orders_pend_perc; ?>%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Canceled Orders</td>
            <td>
                <div class="progress progress-info" alt="<?php echo $total_orders_canc; ?>" title="<?php echo $total_orders_canc; ?>">
                    <div class="bar" style="width: <?php echo $total_orders_canc_perc; ?>%"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Refunded Orders</td>
            <td>
                <div class="progress progress-info" alt="<?php echo $total_orders_ref; ?>" title="<?php echo $total_orders_ref; ?>">
                    <div class="bar" style="width: <?php echo $total_orders_ref_perc; ?>%"></div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="well">

    <dl class="dl-horizontal">
        <dt>Total Customers</dt>
        <dd><?php echo DashboardStats::getTotalCustomers(); ?></dd>
        <dt>Total Orders</dt>
        <dd><?php echo $total_orders; ?></dd>
        <dt>Shipped Orders</dt>
        <dd><?php echo $total_orders_ship; ?></dd>
        <dt>Pending Orders</dt>
        <dd><?php echo $total_orders_pend; ?></dd>
        <dt>Canceled Orders</dt>
        <dd><?php echo $total_orders_canc; ?></dd>
        <dt>Refunded Orders</dt>
        <dd><?php echo $total_orders_ref; ?></dd>

    </dl>
</div>