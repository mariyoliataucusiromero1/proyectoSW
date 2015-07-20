<?php

/**
 * Archivo 'Sesion.php'
 * 
 * Archivo que define la clase 'Sesion'
 * 
 * @license http://creativecommons.org/licenses/by-sa/2.5/pe/ Atribucion-CompartirIgual 2.5 Peru
 */

/**
 * Clase 'Sesion'
 * 
 * Esta clase se encarga de manejar las sesiones
 */
class Sesion {

    /**
     * Metodo que inicia una Sesion
     */
    public static function iniciar() {
        session_start();
        self::tiempo();
    }

    /**
     * Metodo que elimina una variable de sesion o elimina la sesion
     * @param string $clave variable de sesion
     */
    public static function matar($clave = FALSE) {
        if ($clave) {
            unset($_SESSION[$clave]);
        } else {
            unset($_SESSION);
            session_destroy();
        }
    }

    /**
     * Metodo que guarda una variable en la sesion
     * @param type $clave
     * @param type $valor
     */
    public static function set($clave, $valor) {
        if (!empty($clave)) {
            $_SESSION[$clave] = $valor;
        }
    }

    /**
     * Metodo que obtiene una variable almacenada en la sesion
     * @param type $clave
     * @return string
     */
    public static function get($clave) {
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        }
        return '';
    }
    
    /**
     * Método que regenera la sesion
     */
    public static function regenerar() {
        session_regenerate_id(TRUE);
    }
    
    /**
     * Método que maneja el tiempo de sesion
     */
    public static function tiempo() {
        if (Sesion::get('autenticado')) {
            Sesion::set('tiempo', time());
        }
    }

}
