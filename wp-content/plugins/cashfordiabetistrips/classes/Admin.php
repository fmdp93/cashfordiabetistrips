<?php

namespace CashfordiabetistripsPlugin;

use Cashfordiabetistrips\Setup;
use CashfordiabetistripsPlugin\Validation;

class Admin
{
    private $wpdb;
    private $wp;

    public function __construct(\Cashfordiabetistrips $Cashfordiabetistrips)
    {
        global $wpdb;
        global $wp;
        $this->wp = $wp;
        $this->wpdb = $wpdb;
        $this->ThemeSetup = new Setup();
        $this->Cashfordiabetistrips = $Cashfordiabetistrips;
        $this->menu_slug = 'cashfordiabetistrips-products';
        $this->add_product_action = admin_url('admin.php');

        add_action('admin_menu', array($this, 'set_admin_menu'));
        add_action('more_admin_enqueue_scripts', array($this->ThemeSetup, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 11);
        add_action('admin_action_cashfordiabetistrips_add_product_action', array($this, 'submit'));
        add_action('wp_ajax_cashfordiabetistrips_validate_price', array($this, 'validate_price'));
    }

    public function set_admin_menu()
    {
        add_menu_page(
            'Cash For Diabetis Strips',
            'Cash For Diabetis Strips',
            'manage_options',
            'cash_for_diabetis_strips',
            array($this, 'get_manage_product_page'),
            home_url('asset/img/favicon.png'),
            100
        );

        add_submenu_page(
            'cash_for_diabetis_strips',
            'Add Product',
            'Add Product',
            'manage_options',
            'cashfordiabetistrips-add-product',
            array($this, 'get_add_product_page')
        );
    }

    public function get_manage_product_page()
    {
        $page = $_GET['page_num'] ?? 1;        
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $paginationSql = "LIMIT $perPage OFFSET $offset";
        $sql = "SELECT 
            p.id p_id, p.brand, p.name p_name,
            p.price, p.quantity,
            m.name model_name  
            FROM products p 
            INNER JOIN models m 
            ON p.model = m.id 
            $paginationSql";

        $products = $this->wpdb->get_results($sql);

        include $this->Cashfordiabetistrips->plugin_dir . '/template-parts/admin/products.php';
    }

    public function get_add_product_page()
    {
        include $this->Cashfordiabetistrips->plugin_dir . '/template-parts/admin/add-product.php';
    }

    public function validate_price()
    {
        $price = trim($_GET['price']);
        $response = array();
        $response['status_code'] = Validation::is_money_value($price);

        echo json_encode($response);
        wp_die();
    }

    public function submit()
    {
        if (Validation::form_nonce("add_product_action_nonce", $this->add_product_action)) {
            // validate price            
            $price = trim($_POST['price']);
            $product_folder = $this->Cashfordiabetistrips->admin_uploads_folder . '/products';
            $ext = strtolower(pathinfo(basename($_FILES['picture']['name']), PATHINFO_EXTENSION));
            $temp_file_path = tempnam($product_folder, '');
            unlink($temp_file_path);
            $filename = basename($temp_file_path) . '.' . $ext;
            $filepath = $product_folder . '/' . $filename;

            // move file            
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $filepath)) {
                $data = array(
                    'name' => trim($_POST['name']),
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'front_page_title' => trim($_POST['front_page_title']),
                    'price' => $price,
                    'picture' => $filename,
                    'quantity' => trim($_POST['quantity']),
                );
                $format = array("%s", "%s", "%s", "%s", "%f", "%s", "%d");

                // insert to db
                $this->wpdb->insert('products', $data, $format);
                $message = urlencode('Product added successfully.');
            } else {
                $message = urlencode('Please fix the form fields below.');
                $status_code = 'error';
            }
        }
        wp_redirect($_SERVER['HTTP_REFERER'] . '&message=' . $message . '&status_code=' . $status_code);
        exit;
    }

    public static function admin_enqueue_scripts()
    {
        do_action("more_admin_enqueue_scripts");
        if (is_admin()) {
            wp_enqueue_script(
                'ajax-script',
                get_stylesheet_directory_uri() . '/assets/js/add_product.js',
                array('jquery'),
                '1.1',
                true
            );

            wp_localize_script(
                'ajax-script',
                'cashfordiabetistrips_js_globals',
                [
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('nonce_name')
                ]
            );
        }
    }
}
