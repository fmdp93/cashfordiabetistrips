<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function dumpre($string) {
    echo '<pre>';
    var_dump($string);
    echo '</pre>';
}

function echocomma($string) {
    echo $string, ',';
}

function bracethis($string) {
    echo '[' . $string . ']';
}

function echobr() {
    echo '<br>';
}

function dt($sec){
    echo date('F d, Y h:i:s', $sec);    
}