<?php

/**
 * Archivo 'Modelo'
 * 
 * Este archivo define la calse 'Modelo'
 * 
 * @license http://creativecommons.org/licenses/by-sa/2.5/pe/ Atribucion-CompartirIgual 2.5 Peru
 */

/**
 * Clase 'Modelo'
 * 
 * Modelo principal del cual extenderan los demas modelos, tiene un
 * atributo protegido que hace refencia a la clase 'Bd'
 */
class Modelo {

    /** @var Bd */
    protected $_bd;

    public function __construct() {
        $this->_bd = Bd::getIntancia();
    }

}
