<?php
get_header();
?>
<main class="container-fluid mt-3 mt-lg-5">
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
            <div class="row">
                <div class="col-auto">
                    <ul id="user_panel" class="list-group">
                        <li class="list-group-item"><a href="<?php echo home_url('my-account') ?>">Dashboard</a></li>
                        <li class="list-group-item"><a href="<?php echo home_url('my-account?page=orders') ?>">Orders</a></li>
                        <li class="list-group-item"><a href="#">Address Information</a></li>
                        <li class="list-group-item"><a href="<?php echo home_url('my-account?page=edit_account') ?>">Account Details</a></li>
                        <li class="list-group-item"><a href="<?php echo home_url('logout') ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="my_account_content" class="col">                    
                    <div class="h-100 border border-gray-c1 p-3 p-md-4">
                        <?php echo apply_filters('load_page', ''); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>