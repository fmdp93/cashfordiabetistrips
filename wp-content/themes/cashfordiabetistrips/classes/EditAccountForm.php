<?php

namespace Cashfordiabetistrips;

use App\Classes\Session;
use App\Classes\Validation;
use App\Model\User as ModelUser;
use Cashfordiabetistrips\Interfaces\Form;
use Cashfordiabetistrips\Traits\TraitUserForm;

class EditAccountForm implements Form
{
    use TraitUserForm;
    public $error = array();
    public $user_data = array();

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->session = new Session();
        $this->ModelUser = new ModelUser();

        $this->form_action = home_url('my-account?page=edit_account');

        add_action('template_redirect', array($this, 'submit'));
        add_action('template_redirect', array($this, 'set_html_flashdata'));
        add_filter('user_details_form', array($this, 'user_details_form'));
        add_filter('payment_method', array($this, 'payment_method'));
        add_filter('edit_account_form', array($this, 'the_view'));
    }

    /** Hooks */
    public function set_html_flashdata()
    {
        $this->html_error = $this->session->error_message;
        $this->html_success = $this->session->success_message;
        $this->html_user_data = $this->session->user_data;
    }

    public function the_view()
    {
        return include get_stylesheet_directory() . '/template-parts/edit-account-form.php';
    }

    public function user_details_form()
    {
        return include get_stylesheet_directory() . '/template-parts/user_details_form.php';
    }

    public function payment_method()
    {
        return include get_stylesheet_directory() . '/template-parts/payment-method.php';
    }

    /** End of Hooks */

    public function submit()
    {
        if (Validation::form_nonce('edit_account', $this->form_action)) {
            $this->set_user_data();
            $this->validate() || (wp_redirect(home_url('my-account?page=edit_account')) && exit);

            /**
             *  update db
             */

            // check if user has address
            $user_addresses_results = $this->get_user_addresses();

            // insert to address2users if no address and set as default address
            if (!$this->insert_address_if_no_addr($user_addresses_results)) {

                // update address2users if only one address
                $this->update_the_only_address($user_addresses_results);
            }

            // set user cookie
            $user = $this->ModelUser->get_user($this->session->user['username'], $this->session->user['password']);
            $default_address = $this->ModelUser->get_default_address($user->id);
            $user = (object) array_merge((array) $user, (array) $default_address);

            $this->session->set_cookie('user', $user);

            $this->session->set_flashdata('success_message', "Account details updated");
            wp_redirect(home_url('my-account?page=edit_account'));
            exit;
        }
    }

    private function update_the_only_address($user_addresses_results)
    {
        if (is_array($user_addresses_results) && count($user_addresses_results) == 1) {
            $data = array(
                $this->user_data['name'],
                $this->user_data['state'],
                $this->user_data['city'],
                $this->user_data['address'],
                $this->user_data['zip'],
                $this->user_data['phone_num'],
                $this->user_data['email'],
                $this->user_data['payment_method'],
                $this->user_data['pm_val'],
                $this->session->user['id'],
            );

            $prepare = $this->wpdb->prepare(
                "
                UPDATE address2users SET name = %s, state = %s, city = %s, street = %s, postcode = %s, phone = %s, email = %s, payment_method = %s, pm_val = %s
                    WHERE user_id = %d",
                $data
            );
            $this->wpdb->query($prepare);
        }
    }

    private function insert_address_if_no_addr($user_addresses_results)
    {
        if (empty($user_addresses_results)) {
            $data = array(
                $this->session->user['id'],
                $this->user_data['name'],
                $this->user_data['state'],
                $this->user_data['city'],
                $this->user_data['address'],
                $this->user_data['zip'],
                $this->user_data['phone_num'],
                $this->user_data['email'],
                $this->user_data['payment_method'],
                $this->user_data['pm_val'],
            );
            $prepare = $this->wpdb->prepare(
                "
                INSERT INTO address2users (user_id, name, state, city, street, postcode, phone, email, payment_method, pm_val, is_default)
                    VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, 1)",
                $data
            );
            $this->wpdb->query($prepare);
            return true;
        }
    }

    private function get_user_addresses()
    {
        $data = array($this->session->user['id']);
        $prepare = $this->wpdb->prepare("SELECT * FROM address2users WHERE user_id = %d", $data);
        return $this->wpdb->get_results($prepare);
    }

    private function set_user_data()
    {
        $this->set_user_only_data();
        $this->user_data['payment_method'] = $_POST['payment_method'];
        $this->user_data['pm_val'] = $_POST['pm_val'];

        $this->session->set_flashdata('user_data', $this->user_data);
    }

    public function validate()
    {
        $this->set_user_only_error();

        $this->session->set_flashdata('error_message', $this->error);
        if (!empty($this->error)) {
            return false;
        }

        return true;
    }
}
