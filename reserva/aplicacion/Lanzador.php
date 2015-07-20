<?php

/**
 * Archivo que contiene la clase Bootstrap
 * 
 * Este Archivo declara la clase 'Lanzador'. 
 * 
 * @license http://creativecommons.org/licenses/by-sa/2.5/pe/ Atribucion-CompartirIgual 2.5 Peru
 */

/**
 * Clase Lanzador
 * 
 * Esta clase es el encargado de incluir el controlador y ejecutar el metodo
 * con sus respectivos argumentos, todo esto con ayuda de 'Peticion'.
 */
class Lanzador {

    /**
     * Metodo que incluye el controlador y ejecuta el metodo con sus respectivos
     * parametros o argumentos, con ayuda de 'Peticion'.
     * 
     * @param Request $peticion
     * @throws Se produce una excepcion cuando no existe el controlador requerido 
     */
    public static function ejecutar(Peticion $peticion) {
        $ncontrolador = $peticion->getControlador() . 'Controlador';
        $rutaControlador = RAIZ . 'controladores' . SD . $ncontrolador . '.php';
        $metodo = $peticion->getMetodo();
        $argumentos = $peticion->getArgumentos();

        if (is_readable($rutaControlador)) {
            require_once $rutaControlador;
            $controlador = new $ncontrolador;

            if (!is_callable(array($controlador, $metodo))) {
                throw new Exception('metodo no encontrado');
            }

            if (isset($argumentos)) {
                call_user_func_array(array($controlador, $metodo), $argumentos);
            } else {
                call_user_func(array($controlador, $metodo));
            }
        } else {
            throw new Exception('Controlador no encontrado: ' . $ncontrolador);
        }
    }

}
