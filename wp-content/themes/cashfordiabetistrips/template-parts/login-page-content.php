<?php
ob_start();
?>
<div class="row flex-nowrap px-5">
    <div class="col-12 col-md-6 px-3">
        <?php echo apply_filters('login_form', ''); ?>
    </div>
    <div class="col-12 col-md-6 px-3">
        <?php echo apply_filters('register_form', ''); ?>
    </div>
</div>
<?php
return ob_get_clean();

?>