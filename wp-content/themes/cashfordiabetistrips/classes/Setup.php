<?php

namespace Cashfordiabetistrips;

global $wp;

if (!class_exists('Setup')) {
    class Setup
    {
        public function __construct()
        {
            $this->init_constants();
            add_action('init', array($this, 'theme_supports'));
            add_filter('pre_get_document_title', array($this, 'change_the_title'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));            
            add_action('template_redirect', array($this, 'redirects'));
        }

        private function init_constants()
        {
            defined("PAGINATION_ROW_PER_PAGE") || define("PAGINATION_ROW_PER_PAGE", 10);
        }

        public function theme_supports()
        {
            add_post_type_support('page', 'post-formats');
        }

        public function change_the_title()
        {
            return 'CashForDiabetiStrips';
        }

        public function enqueue_scripts()
        {
            // wp_enqueue_script("jquery");
            wp_enqueue_style(
                'style',
                get_template_directory_uri() . '/style.css',
                array(), //parent has no dependency  
                '1.0'
            );

            wp_enqueue_style('aos-css', get_stylesheet_directory_uri() . '/assets/css/aos.css');
            wp_enqueue_style('fa-css', get_stylesheet_directory_uri() . '/assets/css/all.css');
            wp_enqueue_style('flatpickr-css', get_stylesheet_directory_uri() . '/assets/css/flatpickr.min.css');

            wp_enqueue_script('jquery-slim', get_stylesheet_directory_uri() . '/assets/js/jquery.slim.min.js', array(), '1', true);
            wp_enqueue_script('popper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array(), '1', true);
            wp_enqueue_script('aos-js', get_stylesheet_directory_uri() . '/assets/js/aos.js', array(), '1', true);
            // wp_enqueue_script('jquery-3.5', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array(), '3.5', true);
            wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '6.0.0', true);
            wp_enqueue_script('modal-js', get_stylesheet_directory_uri() . '/assets/js/classes/modal.js', array(), '1.1', true);
            wp_enqueue_script('flatpickr', get_stylesheet_directory_uri() . '/assets/js/flatpickr.min.js', array('jquery'), '1', true);   
            wp_enqueue_script('products_to_sell', get_stylesheet_directory_uri() . '/assets/js/products_to_sell.js', array(), '1.1', true);            
            wp_enqueue_script('script', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), '1.1', true);         
            // do_action('hook_enqueue_scripts');       
        }

        public function redirects()
        {
            $this->init();

            if (CURRENT_PAGE == home_url('success-message') && !isset($_COOKIE['success_message'])) {
                $this->redirect_success_message(function () {
                    return isset($_COOKIE['success_message']);
                }, home_url('products-to-sell'));
            }
        }

        private function redirect_success_message($callback, $url)
        {
            if ($callback) {
                wp_redirect($url);
                exit;
            }
        }

        private function includes()
        {
        }

        /**
         * Define constant if not already set.
         *
         * @param string      $name
         * @param string|bool $value
         */
        private function define($name, $value)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        private function init()
        {
            global $wp;
            $this->wp = $wp;
            $this->wp->parse_request();
            defined("CURRENT_PAGE") || define("CURRENT_PAGE", esc_url(home_url($this->wp->request)));
        }
    }
} else {
    die("Setup Exists");
}
