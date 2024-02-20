<?php

namespace App\Model;

class User
{
    public $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function get_user($email, $password)
    {
        $data = array(
            $email,
            $email,
            $password
        );
        $prepare = $this->wpdb->prepare("SELECT * FROM users WHERE (email = %s || username = %s) && `password` = %s", $data);
        return $this->wpdb->get_row($prepare);
    }

    public function get_default_address($user_id)
    {
        $data = array($user_id);
        $prepare = $this->wpdb->prepare("SELECT * FROM address2users WHERE user_id = %d && is_default = 1", $data);
        return $this->wpdb->get_row($prepare);
    }
}
