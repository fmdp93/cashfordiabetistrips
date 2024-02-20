<?php

namespace App\Classes;

class Validation{
    public static function is_money_value($price, $success='sucess', $error='error'){
        if(preg_match('/\b\d{1,3}(?:,?\d{3})*(?:\.\d{3})?\b/', $price)){
            return $success;          
        }else{
            return $error;
        }
    }

    public static function form_nonce($field_name, $action){        
        return isset($_POST[$field_name]) && wp_verify_nonce($_POST[$field_name], $action);        
    }

    public static function is_whole_number($number){
        return preg_match("/[\d]*/", $number);
    }    
}