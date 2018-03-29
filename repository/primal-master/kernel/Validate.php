<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validate
 *
 * @author temp
 */
class Validate {

    private $pattern;
    private $error;

    function __construct($pattern, $error) {
        $this->pattern = $pattern;
        $this->error = $error;
    }

    function getError(){
    	return $this->error;																		
    }
    
    public function validate($value) {
        //echo $this->pattern .','. $value . '<br>';
        return preg_match($this->pattern, $value) > 0;
    }

    public static function integer(){
    	return new Validate(
    		'[0-9]+', 'Este campo debe ser un numero entero'
    	);
    }
    
    public static function numeric(){
    	return new Validate(
    		'\\w+', 'Este campo debe ser un numero entero'
    	);
    }
    
}



?>
