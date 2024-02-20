<?php
get_header();
?>
<div class="container-fluid mt-3 mt-lg-5">
    <div class="row bg-dark p-3 text-white">
        <div class="col-12">
            <div class="col-12 col-md-8 mx-auto">
                <div class="row">
                    <h3>My Account</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12 col-md-8 mx-auto">
            <div class="px-5">
                <?php alertError($User->LoginForm->html_error["login"] ?? ''); ?>
                <?php alertError($User->RegisterForm->html_error["email"] ?? ''); ?>
            </div>            
            <?php echo apply_filters('load_page', ''); ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>