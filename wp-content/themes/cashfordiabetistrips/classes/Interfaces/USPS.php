<?php

namespace Cashfordiabetistrips\Interfaces;

interface USPS{
    public function build_xml_request($xml_path);
    public function get_response($url);
}