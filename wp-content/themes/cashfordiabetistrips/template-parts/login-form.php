<?php
ob_start();
?>
<div class="border border-gray-c1 p-4 h-100">
    <h1 class="pb-3 mb-3 mb-md-4 border-bottom border-gray-c1">Login</h1>
    <form action="<?php echo $this->login_page_action ?>" method="POST">
        <?php wp_nonce_field($this->login_page_action, 'login'); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control rounded-0">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control rounded-0">
        </div>
        <div class="row">
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Remember Me
                    </label>
                </div>
                <div>
                    <a href="<?php echo home_url('lost-password') ?>">Lost your password?</a>
                </div>
            </div>
            <div class="col">
                <input type="submit" value="LOG IN" name="submit_login" class="btn btn-green-c2 text-white rounded-0 px-5 py-3" />
            </div>
        </div>
    </form>
</div>
<?php
return ob_get_clean();

?>