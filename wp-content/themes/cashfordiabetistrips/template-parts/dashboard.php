<?php 
$username = $this->LoginForm->user["username"];
ob_start(); ?>

<h1>Dashboard</h1>
<p>Hello <?php echo $username ?> (not <?php echo $username; ?>? <a href="<?php home_url('logout') ?>">Log out</a>)</p>
<p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and <a href="<?php echo home_url('edit_account') ?>">edit your password and account details.</a></p>
<?php
return ob_get_clean();
