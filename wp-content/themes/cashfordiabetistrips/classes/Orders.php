<?php

namespace Cashfordiabetistrips;

use App\Classes\Pagination;
use App\Classes\Session;
use App\Model\Product as ModelProduct;

class Orders
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->ModelProduct = new ModelProduct();     
        $this->session = new Session();          
    }

    public function get_orders($offset = "no_index")
    {
        $data = array($this->session->user['id']);
        $data = Pagination::get_data($offset, $data);
        $prepare = $this->wpdb->prepare("SELECT * FROM orders WHERE user_id = %d ORDER BY `date_time` DESC, id DESC " . Pagination::$limit, $data);
        return $this->wpdb->get_results($prepare);
    }   

    public function get_order($order_id){
        $data = array($order_id);        
        $prepare = $this->wpdb->prepare("SELECT * FROM orders WHERE id = %d", $data);
        return $this->wpdb->get_row($prepare);
    }

    public function get_order2products($order_id){
        $data = array($order_id);
        $prepare = $this->wpdb->prepare(
            "SELECT *, p.name product_name,
                o2p.price o2p_price, o2p.quantity o2p_quantity
            FROM order2products o2p 
            INNER JOIN orders o 
            INNER JOIN products p
            ON o.id = o2p.order_id && p.id = o2p.product_id
            WHERE o2p.order_id = %d", $data);
        return $this->wpdb->get_results($prepare);
    }

    public function get_order_total($order_id)
    {
        $data = array($order_id);
        $prepare = $this->wpdb->prepare("SELECT SUM(quantity * price) FROM order2products WHERE order_id = %d", $data);
        return $this->wpdb->get_var($prepare);
    }   
}
