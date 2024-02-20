<?php

use App\Classes\Pagination;

$username = $this->LoginForm->user["username"];
ob_start(); ?>
<h1>Orders</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th class="text-right">Order ID</th>
            <th>Name</th>
            <th colspan="2">Payment Method</th>
            <th class="text-right">Total</th>
            <th class="text-center">Date</th>
            <th>Action</th>
        </thead>
        <?php foreach ($this->Orders->get_orders($_GET['pagenow'] ?? 1) as $orders_row) { ?>
            <tr>
                <td class="text-right"><?php echo $orders_row->id ?></td>
                <td><?php echo ucwords($orders_row->name) ?></td>
                <td><?php echo ucwords($orders_row->payment_method); ?></td>
                <td><?php echo $orders_row->pm_val; ?></td>
                <td class="text-right">$<?php echo $this->Orders->get_order_total($orders_row->id) ?></td>
                <td class="text-right"><?php echo $orders_row->date_time; ?></td>
                <td><a href="<?php echo home_url('my-account/?page=order2products&order_id=' . $orders_row->id); ?>" class="btn btn-green-c2 text-white">View</a></td>
            </tr>
        <?php } ?>
    </table>
    <div class="float-right mt-5">
        <?php
        $orders = $this->Orders->get_orders();
        $all_row_count = count($this->Orders->get_orders() ?? array());
        $page_count = $all_row_count / PAGINATION_ROW_PER_PAGE;
        echo paginate_links(array(
            'base' => home_url('my-account/?page=orders%_%'),
            'format' => '&pagenow=%#%',
            'total' => $page_count,
            'current' => $_GET['pagenow'] ?? 1,
        )); ?>
    </div>
</div>
<?php
return ob_get_clean();
