<?php

/**
 * Plugin Name: Cash For Diabetis Strips
 *  
 */

use CashfordiabetistripsPlugin\Admin;
// from cashfordiabetistrips theme's folder
use Cashfordiabetistrips\Product;

require_once ABSPATH . 'vendor/autoload.php';

final class Cashfordiabetistrips
{
    protected static $instance = null;

    public function __construct()
    {
        $this->setup_vars();
        $this->includes();
        $this->initialize_classes();
    }

    // Singleton
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function setup_vars()
    {
        $this->file = __FILE__;

        $this->plugin_dir = plugin_dir_path($this->file);
        $this->plugin_url = plugin_dir_url($this->file);

        $this->include_dir = trailingslashit($this->plugin_dir . 'includes');
        
        $this->admin_uploads_folder = ADMIN_UPLOADS_FOLDER;
        do_action('hook_setup_vars');
    }

    private function includes()
    {
        include_once $this->include_dir . 'functions.php';
        include_once $this->include_dir . 'my_debugger_helper.php';
        include_once $this->include_dir . 'common/constants.php';
    }

    private function initialize_classes(){
        $this->Admin = new Admin($this);
        $this->Product = new Product($this);        
    }    
}

function Cashfordiabetistrips()
{
    return Cashfordiabetistrips::instance();
}

if (defined('Cashfordiabetistrips_LATE_LOAD')) {
    add_action('plugins_loaded', 'picanomnom', (int) Cashfordiabetistrips_LATE_LOAD);
} else {
    $Cashfordiabetistrips = Cashfordiabetistrips();
}
