<?php
if (
    isset($_GET['action'])
    && $_GET['action'] === FMDP_ACTION_CHANGE_PASS
) { ?>
    <h1>Change Password Form</h1>
    <form method="POST">
        <?php
        $key_is_valid = fmdp_forgot_password_check_key();

        $error_message = fmdp_flash_message("error_message");
        echo fmdp_forget_password_message($error_message, "error");

        if ($key_is_valid === true) { ?>
            <?php wp_nonce_field(); ?>
            <input type="hidden" name="key" value="<?php echo $_GET['key'] ?>">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" placeholder="New password" class="form-control">
            </div>

            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password</label>
                <input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm new password" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="submit_change_pass" value="Change Password">
            </div>
        <?php
        }
        
        if ($key_is_valid === false) {
            $pwrk_err_message = fmdp_flash_message("pwrk_err_message");
            echo fmdp_forget_password_message($pwrk_err_message, "error");
        ?>            
            <p><a href="<?php echo home_url('forgot-password') ?>">Request a forgot password link</a></p>
        <?php } ?>
    </form>
<?php }
?>