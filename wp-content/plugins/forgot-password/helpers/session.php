<?php
/**
 * Use session once.
 * 
 * @param string $session_name The session name
 * 
 * @return $string Session value or empty string if
 *  session is not set.
 */
function fmdp_flash_message($session_name){
    if (isset($_SESSION[$session_name])) {
        $val = $_SESSION[$session_name];
        unset($_SESSION[$session_name]);
        return $val;
    }
    return "";
}
