<?php 
$username = $this->LoginForm->user["username"];
ob_start(); ?>
<h1>Edit Account</h1>
<?php alertSuccess($this->EditAccountForm->html_success); ?>
<?php echo apply_filters('edit_account_form', ''); ?>
<?php
return ob_get_clean();
