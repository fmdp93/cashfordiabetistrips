<?php

namespace App\Model;

class Product{    
    public $wpdb;

    public function __construct()
    {        
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function get_products($where = " "){
        return $this->wpdb->get_results("SELECT * FROM products " . $where);
    }
}