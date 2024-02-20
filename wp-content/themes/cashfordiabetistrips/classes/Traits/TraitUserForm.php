<?php

namespace Cashfordiabetistrips\Traits;

trait TraitUserForm
{
    private function set_user_only_data()
    {
        $this->user_data['email'] = $_POST['email'];
        $this->user_data['name'] = $_POST['name'];
        $this->user_data['address'] = $_POST['address'];
        $this->user_data['city'] = $_POST['city'];
        $this->user_data['state'] = $_POST['state'];
        $this->user_data['zip'] = $_POST['zip'];
        $this->user_data['phone_num'] = $_POST['phone_num'];
    }

    private function set_user_only_error(){
        $this->set_email_error();
        $this->set_name_error();
        $this->set_address_error();
        $this->set_city_error();
        $this->set_state_error();
        $this->set_zip_error();
        $this->set_phone_num_error();
        $this->set_payment_method_error();
        $this->set_pm_val_error();
    }

    private function set_payment_method_error()
    {
        if (empty($this->user_data['payment_method'])) {
            $this->error['payment_method'] = "This field is required";
        }
    }

    private function set_pm_val_error()
    {
        if (empty($this->user_data['pm_val'])) {
            $this->error['pm_val'] = "This field is required";
        }
    }

    private function set_email_error()
    {
        if (empty($this->user_data['email'])) {
            $this->error['email'] = "This field is required";
        }
    }

    private function set_name_error()
    {
        if (empty($this->user_data['name'])) {
            $this->error['name'] = "This field is required";
        }
    }

    private function set_address_error()
    {
        if (empty($this->user_data['address'])) {
            $this->error['address'] = "This field is required";
        }
    }

    private function set_city_error()
    {
        if (empty($this->user_data['city'])) {
            $this->error['city'] = "This field is required";
        }
    }

    private function set_state_error()
    {
        if (empty($this->user_data['state'])) {
            $this->error['state'] = "This field is required";
        }
    }

    private function set_zip_error()
    {
        if (empty($this->user_data['zip'])) {
            $this->error['zip'] = "This field is required";
        }
    }

    private function set_phone_num_error()
    {
        if (empty($this->user_data['phone_num'])) {
            $this->error['phone_num'] = "This field is required";
        }
    }

    
}
