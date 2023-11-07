<?php

namespace Cashfordiabetistrips;

use App\Classes\Pagination;
use App\Classes\Validation;
use Cashfordiabetistrips\Orders;
use Cashfordiabetistrips\LoginForm;
use Cashfordiabetistrips\RegisterForm;
use Cashfordiabetistrips\EditAccountForm;

class User
{
    public function __construct()
    {
        $this->RegisterForm = new RegisterForm();
        $this->LoginForm = new LoginForm();
        $this->EditAccountForm = new EditAccountForm();        
        $this->Orders = new Orders();        

        // add_action('generate_rewrite_rules', 'eg_add_rewrite_rules');
        add_action('template_redirect', array($this, 'check_login'));
        add_action('template_redirect', array($this, 'check_logout'));
        add_filter('load_page', array($this, 'load_page'));
    }

    function eg_add_rewrite_rules()
    {
        global $wp_rewrite;

        $new_rules = array(
            'my-account/(edit-account)/?$' => 'my-account?page=' . $wp_rewrite->preg_index(1),
        );
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }

    /**
     * Load templates
     */
    public function load_page()
    {
        $page = "";
        if (CURRENT_PAGE == home_url('login')) {
            $page = include get_stylesheet_directory() . '/template-parts/login-page-content.php';
        }

        if (CURRENT_PAGE == home_url('my-account')) {
            switch ($_GET['page'] ?? '') {
                case 'edit_account':
                    $page = include get_stylesheet_directory() . '/template-parts/edit_account.php';
                    break;
                case 'orders':
                    $page = include get_stylesheet_directory() . '/template-parts/orders.php';
                    break;
                case 'order2products':
                    $page = include get_stylesheet_directory() . '/template-parts/order2products.php';
                    break;
                default:
                    $page = include get_stylesheet_directory() . '/template-parts/dashboard.php';
            }
        }

        if (CURRENT_PAGE == home_url('edit-account')) {
            $page = include get_stylesheet_directory() . '/template-parts/dashboard.php';
        }

        if (CURRENT_PAGE == home_url('my-account/edit-account')) {
            $page = include get_stylesheet_directory() . '/template-parts/edit_account.php';
        }
        return $page;
    }

    public function check_login()
    {
        if (!isset($_COOKIE['user']) && CURRENT_PAGE == home_url('my-account')) {
            wp_redirect(home_url('login'));
            exit;
        }
    }

    public function check_logout()
    {
        if (isset($_COOKIE['user']) && CURRENT_PAGE == home_url('logout')) {
            setcookie('user', '', time() + 1, '/');
            wp_redirect(home_url('login'));
            exit;
        }
    }

    /**
     * template_redirect end
     */
}
