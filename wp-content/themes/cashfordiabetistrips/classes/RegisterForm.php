<?php

namespace Cashfordiabetistrips;

use App\Classes\Session;
use App\Classes\Validation;
use Cashfordiabetistrips\UserMailing;
use Cashfordiabetistrips\Interfaces\Form;

class RegisterForm implements Form
{
    public $error = array();
    public $user_data = array();

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->session = new Session();

        $this->login_page_action = home_url('login');
        // $this->USPSReturnLabel = new USPSReturnLabel();
        // $this->html_error = json_decode(urldecode($_COOKIE['error_message'] ?? ''), true);
        add_action('template_redirect', array($this, 'submit'));
        add_action('template_redirect', array($this, 'set_html_flashdata'));
        add_filter('register_form', array($this, 'the_view'));
    }

    /** Hooks */
    public function set_html_flashdata()
    {
        $this->html_error = $this->session->error_message;
        $this->html_user_data = $this->session->user_data;
    }

    public function the_view()
    {
        return include get_stylesheet_directory() . '/template-parts/register-form.php';
    }

    /** End of Hooks */

    public function submit()
    {
        if (Validation::form_nonce('register', $this->login_page_action)) {
            $this->set_user_data();
            $this->validate() || (wp_redirect(home_url('login')) && exit);

            $UserMailing = new UserMailing($this);
            $UserMailing->body_building();
            $UserMailing->send();

            // add to db
            $data = array($this->user_data['email'], $this->user_data['username'], $this->user_data['password']);
            $prepare = $this->wpdb->prepare("INSERT INTO users (email, username, `password`) values (%s, %s, %s)", $data);
            $this->wpdb->query($prepare);

            // set user cookie
            $this->session->user = $this->user_data;

            wp_redirect(home_url('my-account'));
            exit;
        }
    }

    private function set_user_data()
    {
        $this->user_data['email'] = $_POST['email'];
        $this->user_data['username'] = substr($_POST['email'], 0, strpos($_POST['email'], '@'));
        $this->user_data['password'] = randomPassword();

        $this->session->set_flashdata('user_data', $this->user_data);
    }

    public function validate()
    {
        $this->set_email_error();

        // setcookie('error_message', urlencode(json_encode($this->error, JSON_HEX_QUOT)), time() + 30, "/");
        $this->session->set_flashdata('error_message', $this->error);
        if (!empty($this->error)) {
            return false;
        }

        return true;
    }

    private function set_email_error()
    {
        if (empty($this->user_data['email'])) {
            $this->error['email'] = "This field is required";
        }

        if (!is_email($this->user_data['email'])) {
            $this->error['email'] = "Please put a valid email address";
        }

        // Database check
        $data = array($this->user_data['email']);
        $prepare = $this->wpdb->prepare("SELECT COUNT(*) as user_count FROM users WHERE email = %s", $data);
        $user_count = $this->wpdb->get_var($prepare);
        if ($user_count == 1) {
            $this->error['email'] = "An account is already registered with your email address. Please log in.";
        }
    }
}
