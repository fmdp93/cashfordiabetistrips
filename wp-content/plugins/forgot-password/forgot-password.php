<?php

/**
 * Plugin Name: Forgot Password
 * Version: 1.0
 * Author: Francis Mari D. Punzalan
 * Description: Use [forgot_password_reset_link] shortcode for your forgot password page.
 */

session_start();

define("FMDP_ACTION_CHANGE_PASS", "change_pw");
define("FMDP_PAGE_SUCCESS", "success");
define("FMDP_FORGOT_PASSWORD_LINK_EXP", 1);

require_once "helpers/session.php";
require_once "helpers/email.php";
require_once "helpers/html.php";

add_filter('wp_mail_content_type', 'fmdp_change_email_content_type');

function fmdp_forgot_password_form_shortcode()
{
    ob_start();
    require_once "components/email-form.php";
    require_once "components/change-password-form.php";
    require_once "components/success.php";

    return ob_get_clean();
}

add_shortcode('forgot_password_form', 'fmdp_forgot_password_form_shortcode');

function fmdp_forgot_password_request_link_submit()
{
    if (!isset($_POST['submit_request'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['_wpnonce'])) {
        $_SESSION['error_message'] = "Invalid nonce";
        return;
    }

    $email = sanitize_email($_POST['email']);

    if (!is_email($email)) {
        $_SESSION['error_message'] = "Invalid email";
        return;
    }

    if (!fmdp_email_exists($email)) {
        $_SESSION['error_message'] = "Email does not exists";
        return;
    }

    $reset_key = fmdp_generate_password_reset_key($email);
    $forgot_password_url = home_url("forgot-password");
    $reset_link = "<a href='$forgot_password_url?"
        . "action=change_pw"
        . "&key=$reset_key'>"
        . "Reset Password"
        . "</a>";
    $subject = 'Password Reset';
    $message = 'Click the following link to reset your password: ' . $reset_link;

    wp_mail($email, $subject, $message);
    $_SESSION['success_message'] = "Password reset link sent to {$_POST['email']}.";
    
    wp_redirect(home_url("forgot-password?ppage=" . FMDP_PAGE_SUCCESS));    
    exit;
}

add_action('init', 'fmdp_forgot_password_request_link_submit');

function fmdp_forgot_password_change_pass_submit()
{

    if (!isset($_POST['submit_change_pass'])) {
        return false;
    }

    if (fmdp_forgot_password_check_key() === false) {
        return false;
    }

    if (!wp_verify_nonce($_POST['_wpnonce'])) {
        return false;
    }

    global $wpdb;
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password !== $confirm_new_password) {
        $_SESSION['error_message'] = 'Password mismatched';
        return false;
    }

    if ($new_password === "") {
        $_SESSION['error_message'] = 'Password can\'t be empty';
        return false;
    }

    $wpdb->update(
        'users',
        [
            'password' => $new_password,
            'password_reset_key' => "",
            'password_reset_key_expiration' => date("Y-m-d H:i:s")
        ],
        ['password_reset_key' => $_POST['key']]
    );

    $_SESSION['success_message'] = 'Password change successful.
        <a href="' . home_url("my-account") . '">You can now login.</a>';
    wp_redirect(home_url("forgot-password?ppage=" . FMDP_PAGE_SUCCESS));    
    exit;
}

add_action('init', 'fmdp_forgot_password_change_pass_submit');

/**
 * Validates the password reset key.
 * 
 * @return bool True if valid. False otherwise.
 */

function fmdp_forgot_password_check_key()
{
    global $wpdb;
    $key = $_GET['key'];

    if ($key === "") {
        $_SESSION["pwrk_err_message"] = "Key is empty";
        return false;
    }

    $sql = $wpdb->prepare("SELECT * FROM users WHERE `password_reset_key` = %s", [$key]);
    $row = $wpdb->get_row($sql);
    if ($key !== $row?->password_reset_key) {
        $_SESSION["pwrk_err_message"] = "Invalid key";
        return false;
    }

    // $date_now > $from_db_date
    $key_date = new DateTime($row->password_reset_key_expiration);
    $dt_date_now = new DateTime();
    $diff = $dt_date_now->getTimestamp() - $key_date->getTimestamp();
    $diff_in_hour = $diff / 60 / 60;

    if ($diff_in_hour >= FMDP_FORGOT_PASSWORD_LINK_EXP) {
        $_SESSION["pwrk_err_message"] = "Key expired";
        return false;
    }

    return true;
}
