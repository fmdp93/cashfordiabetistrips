<?php

namespace App\Classes;

use stdClass;

class Session
{
    public function set_flashdata($key, $value)
    {
        if(!is_array($value)){            
            $value = array($value, "single_var_sess" => true);
        }
        
        $value = array_merge($value, array('flash_data' => true));
                
        setcookie($key, urlencode(json_encode($value, JSON_HEX_QUOT)), 0, "/");
    }

    public function set_cookie($key, $value)
    {        
        setcookie($key, urlencode(json_encode($value, JSON_HEX_QUOT)), time() + WEEK_IN_SECONDS * 2, "/");
    }

    public function __get($key){
        $var = json_decode(urldecode($_COOKIE[$key] ?? ''), true);

        if($var['flash_data'] ?? false){
            setcookie($key, '', time() + 1, "/");
        }        
        return $var["single_var_sess"] ?? false ? $var[0] : $var;
    }

    public function __set($key, $value){        
        setcookie($key, urlencode(json_encode($value, JSON_HEX_QUOT)), 0, "/");
    }
}
