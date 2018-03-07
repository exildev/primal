<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author dell
 */

Kernel::package('app');

class Person extends Model{

    private $id;
    private $first_name;
    private $last_name;
    private $tel;

    public function __construct() {
        $this->id = Constrain::pk($this);
        $this->first_name = Input::create_text('first_name');
        $this->last_name = Input::create_text('last_name');
        $this->tel = Input::create_integer('tel');
    }
    function getId() {
        return $this->id;
    }

    function getFirst_name() {
        return $this->first_name;
    }

    function getLast_name() {
        return $this->last_name;
    }

    function getTel() {
        return $this->tel;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    function setLast_name($last_name) {
        $this->last_name = $last_name;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    public function get_called_class() {
        return get_called_class();
    }

}
