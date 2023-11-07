<?php 

namespace Cashfordiabetistrips\Interfaces;

use Cashfordiabetistrips\Interfaces\Form;

interface Mailing{
    public function __construct(Form $form);
    public function send();
    public function body_building();
    
}