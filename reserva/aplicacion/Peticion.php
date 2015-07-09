<?php
/**
 * Archivo que maneja las peticiones
 * 
 * En este archivo se administra las urls de la forma "base_url/controlador/meto
 * do/argumentos".
 * 
 * @license http://creativecommons.org/licenses/by-sa/2.5/pe/ Atribucion-CompartirIgual 2.5 Peru
 */

/**
 * Clase que maneja las peticiones
 * 
 * En esta clase se administra las urls o peticiones de la forma
 * "base_url/controlador/metodo/argumentos", extrayendo el controlador, 
 * el metodo y los argumentos.
 */
class Peticion {
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    public $url;

    public function __construct() {
        if (!is_null(filter_input(INPUT_GET, 'url'))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $_aux = explode('/', $this->url);
            $_url = array_filter($_aux);
            
            $this->_controlador = strtolower(array_shift($_url));
            $this->_metodo = strtolower(array_shift($_url));
            $this->_argumentos = $_url;
        }
       
        if (!$this->_controlador) {
            $this->_controlador = 'index';
        }
        
        if (!$this->_metodo) {
            $this->_metodo = 'index';
        }
        
        if (!isset($this->_argumentos)) {
            $this->_argumentos = array();
        }
    }
    
    /**
     * Metodo que retorna el controlador de la url
     * 
     * @return string controlador
     */
    public function getControlador() {
        return $this->_controlador;
    }
    
    /**
     * Metodo que retorna el metodo de la url 
     * @return string metodo
     */
    public function getMetodo() {
        return $this->_metodo;
    }
    
    /**
     * Metodo que retorna los argumentos de la url
     * 
     * @return array argumentos
     */
    public function getArgumentos() {
        return $this->_argumentos;
    }
}