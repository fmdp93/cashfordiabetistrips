<?php
ob_start();
?>
<div class="border border-gray-c1 p-4 h-100">
    <h1 class="pb-3 mb-3 mb-md-4 border-bottom border-gray-c1">Register</h1>
    <form action="<?php echo $this->login_page_action ?>" method="POST">
        <?php wp_nonce_field($this->login_page_action, 'register'); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control rounded-0">
        </div>
        <p>A password will be sent to your email address.</p>
        <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
        <input type="submit" value="REGISTER" name="submit_register" class="btn btn-green-c2 text-white rounded-0 px-5 py-3" />
    </form>
</div>
<?php
return ob_get_clean();

?>