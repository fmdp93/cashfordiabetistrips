<?php 

namespace Cashfordiabetistrips;

use Cashfordiabetistrips\Interfaces\USPS;

class USPSReturnLabel implements USPS{
    public function __construct(){
       
    }  

    public function build_xml_request($xml_path){
        $this->xml = include $xml_path;
        $this->xml = urlencode(preg_replace('/[\t\n]/', '', $this->xml));
    }

    public function get_response($url)
    {        
        return file_get_contents($url . $this->xml);
    }
}