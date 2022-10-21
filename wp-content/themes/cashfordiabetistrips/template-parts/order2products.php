<?php
$username = $this->LoginForm->user["username"];
$count = 1;
$order_total = 0;
$order_row = $this->Orders->get_order($_GET['order_id']);
ob_start(); ?>
<h1>Order #<?php echo $_GET['order_id']; ?></h1>
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <th class="text-right">#</th>
        <th>Name</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Price</th>
        <th class="text-right">Sub Total</th>
    </thead>
    <?php foreach ($this->Orders->get_order2products($_GET['order_id']) as $o2p_row) { ?>
        <tr>
            <td class="text-right"><?php echo $count++; ?></td>
            <td><?php echo ucwords($o2p_row->product_name) ?></td>
            <td class="text-right"><?php echo $o2p_row->o2p_quantity; ?></td>
            <td class="text-right"><?php echo $o2p_row->o2p_price; ?></td>
            <td class="text-right"><?php echo $o2p_row->o2p_quantity * $o2p_row->o2p_price ?></td>
        </tr>
        <?php $order_total += $o2p_row->o2p_quantity * $o2p_row->o2p_price; ?>
    <?php } ?>
</table>
</div>

<h3 class="mt-5">Order Details</h3>
<table class="table">
    <tbody>
        <tr>
            <td>ID</td>
            <td><?php echo $order_row->id ?></td>
        </tr>        
        <tr>
            <td>Date</td>
            <td><?php echo $order_row->date_time ?></td>
        </tr>        
        <tr>
            <td>Name</td>
            <td><?php echo $order_row->name ?></td>
        </tr>        
        <tr>
            <td>State</td>
            <td><?php echo $order_row->state ?></td>
        </tr>        
        <tr>
            <td>City</td>
            <td><?php echo $order_row->city ?></td>
        </tr>        
        <tr>
            <td>Street</td>
            <td><?php echo $order_row->street ?></td>
        </tr>        
        <tr>
            <td>Postcode</td>
            <td><?php echo $order_row->postcode ?></td>
        </tr>        
        <tr>
            <td>Phone</td>
            <td><?php echo $order_row->phone ?></td>
        </tr>        
        <tr>
            <td>Email</td>
            <td><?php echo $order_row->email ?></td>
        </tr>        
        <tr>
            <td>Payment Method</td>
            <td><?php echo $order_row->payment_method . ': ' . $order_row->pm_val ?></td>
        </tr>        
        <tr>
            <td>Promo Code</td>
            <td><?php echo $order_row->promo_code ?></td>
        </tr>        
        <tr>
            <td>Notes</td>
            <td><?php echo $order_row->notes ?></td>
        </tr>        
        </tr>        
        <tr>
            <td>Total</td>
            <td><b>$<?php echo $order_total ?></b></td>
        </tr>        
    </tbody>
</table>    
<?php
return ob_get_clean();
