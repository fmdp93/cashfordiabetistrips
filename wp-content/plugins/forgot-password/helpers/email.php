<?php

/**
 * Checks if email exists on table.
 * 
 * @param string $email
 * @param string $table (Optional. Default "users") The MySql table name.
 * @param string $email_field (Optional. Default "email") The MySql column name.
 * 
 * @return boolean true if email exists else false.
 */

function fmdp_email_exists($email, $table = "users", $email_field = "email")
{
    global $wpdb;
    $sql = "SELECT * FROM $table WHERE $email_field = %s";
    return $wpdb->get_row($wpdb->prepare($sql, $email)) !== null;
}

/**
 * Generates a password reset key and stores it in the table.
 * 
 * @param string $table (Optional. Default "users") Table name.
 * @param string $pwk_field (Optional. Default "password_reset_key") The password reset key field name.
 * @param string $pwk_exp_field (Optional. Default "password_reset_key_expiration") The password reset key expiration field name.
 * 
 * @return $reset_key;
 */

function fmdp_generate_password_reset_key(
    $email,
    $table = 'users',
    $pwk_field = 'password_reset_key',
    $pwk_exp_field = 'password_reset_key_expiration',
    $email_field = "email"
) {
    global $wpdb;
    do {
        $reset_key = bin2hex(random_bytes(16));
        $dt = new DateTime();
        $expiration = $dt->add(new DateInterval("PT1H"))->format("Y-m-d H:i:s");

        $r = $wpdb->get_results("SELECT * FROM users WHERE $pwk_field = $reset_key");
    } while (!empty(count($r)));

    $wpdb->update(
        $table,
        [
            $pwk_field => $reset_key,
            $pwk_exp_field => $expiration
        ],
        [$email_field => $email]
    );

    return $reset_key;
}

function fmdp_change_email_content_type()
{
    return 'text/html';
}
