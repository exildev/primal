<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app
 *
 * @author dell
 */
class app extends View{
    public function __construct() {
        parent::__construct(realpath(dirname(__FILE__)) . "/../templ/");
    }
    
    public function main() {
        return parent::render('dashboard.html', array());
    }
}
