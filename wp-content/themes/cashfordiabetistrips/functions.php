<?php

use Cashfordiabetistrips\Setup;
use Cashfordiabetistrips\Product;
use Cashfordiabetistrips\User;

require_once ABSPATH . 'vendor/autoload.php';

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

// function wpb_modify_jquery() {
//     //check if front-end is being viewed
//     if (!is_admin()) {
//         // Remove default WordPress jQuery
//         wp_deregister_script('jquery');
//         // Register new jQuery script via Google Library    
//         wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '3.6.0');
//         // Enqueue the script   
//         wp_enqueue_script('jquery');
//     }
// }
// // Execute the action when WordPress is initialized
// add_action('init', 'wpb_modify_jquery');

$Setup = new Setup();
$Product = new Product();
$User = new User();