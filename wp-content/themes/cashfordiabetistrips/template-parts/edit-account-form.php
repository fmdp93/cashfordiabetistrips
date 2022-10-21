<?php
ob_start();
?>
<form action="<?php echo $this->form_action ?>" method="POST">
    <?php wp_nonce_field($this->form_action, 'edit_account'); ?>
    <?php echo apply_filters('user_details_form', ''); ?>
    <?php echo apply_filters('payment_method', ''); ?>    
    <input type="submit" value="UPDATE" name="submit_register" class="btn btn-green-c2 text-white rounded-0 px-5 py-3" />
</form>
<?php
return ob_get_clean();
