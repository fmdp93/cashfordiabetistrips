<?php 
if(!empty($_GET)){
    return false;
}

$message = fmdp_flash_message("error_message");
echo fmdp_forget_password_message($message, "error"); 
$message = fmdp_flash_message("success_message");
echo fmdp_forget_password_message($message, "success"); 
?>
<form method="POST">
    <?php wp_nonce_field(); ?>
    <label for="email">E-mail</label>
    <input type="text" name="email" id="email" placeholder="Email">
    <input type="submit" name="submit_request" value="Send link">
</form>