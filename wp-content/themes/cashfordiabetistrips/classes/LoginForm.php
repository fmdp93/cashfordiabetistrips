<?php

namespace Cashfordiabetistrips;

use App\Classes\Session;
use App\Classes\Validation;
use App\Model\User as ModelUser;
use Cashfordiabetistrips\UserMailing;
use Cashfordiabetistrips\Interfaces\Form;

class LoginForm implements Form
{
    public $error = array();
    public $user_data = array();

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->session = new Session();
        $this->ModelUser = new ModelUser();

        $this->login_page_action = home_url('login');

        add_action('template_redirect', array($this, 'submit'));
        add_action('template_redirect', array($this, 'set_html_flashdata'));
        add_filter('login_form', array($this, 'the_view'));
    }

    /** Hooks */
    public function set_html_flashdata()
    {
        $this->html_error = $this->session->error_message;
        $this->html_user_data = $this->session->user_data;   
        $this->user = $this->session->user;     
    }

    public function the_view()
    {
        return include get_stylesheet_directory() . '/template-parts/login-form.php';
    }

    /** End of Hooks */

    public function submit()
    {
        if (Validation::form_nonce('login', $this->login_page_action)) {
            $this->set_user_data();
            $this->validate() || (wp_redirect(home_url('login')) && exit);

            // set user cookie
            $user = $this->ModelUser->get_user($this->user_data['email'], $this->user_data['password']);
            $default_address = $this->ModelUser->get_default_address($user->id);

            $user = (object) array_merge((array) $user, (array) $default_address);
            if ($this->user_data['remember_me']) {
                $this->session->set_cookie('user', $user);
            } else {
                $this->session->user = $user;
            }

            wp_redirect(home_url('my-account'));
            exit;
        }
    }

    private function set_user_data()
    {
        $this->user_data['email'] = $_POST['email'];
        $this->user_data['password'] = $_POST['password'];
        $this->user_data['remember_me'] = $_POST['remember_me'] ?? 0;

        $this->session->set_flashdata('user_data', $this->user_data);
    }

    public function validate()
    {
        $this->set_login_error();

        $this->session->set_flashdata('error_message', $this->error);
        if (!empty($this->error)) {
            return false;
        }

        return true;
    }

    private function set_login_error()
    {

        // Database check        
        $row = $this->ModelUser->get_user($this->user_data['email'], $this->user_data['password']);
        if ($row === null) {
            $this->error['login'] = "Incorrect email/username/password";
        }
    }
}
