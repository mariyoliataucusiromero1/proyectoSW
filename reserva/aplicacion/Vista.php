<?php

/**
 * Archivo 'Vista', vista principal
 * 
 * En este archivo se define la clase 'Vista'
 *  
 * @license http://creativecommons.org/licenses/by-sa/2.5/pe/ Atribucion-CompartirIgual 2.5 Peru
 */

/**
 * Clase View
 * 
 * Esta clase es la Vista principal, de esta clase no heredara ninguna,
 * a diferncia del controlador principal. Esta clase se encargar de incluir
 * una determinada vista
 */
class Vista {

    /** @var array hojas de estilo */
    private $_css;

    /** @var array archivos javascript */
    private $_js;

    /** @var string ruta de la plantilla */
    private $_plantilla;

    /** @var string ruta de la carpeta pública */
    private $_publico;

    /** @var Peticion  */
    private $_peticion;

    /** @var string titulo de la página */
    public $titulo;

    /** @var int página actual */
    public $pactual;

    /** @var string metodo */
    public $metodo;

    public function __construct(Peticion $peticion) {
        $this->_peticion = $peticion;
        $this->metodo = $this->_peticion->getMetodo();
        $this->_plantilla = URL_BASE . 'vistas/_plantilla/';
        $this->_publico = URL_BASE . 'publico/';
        $this->_css = array();
        $this->_js = array();
        $this->titulo = TITULO;
        $this->pactual = 1;
    }

    /**
     * Método que las vistas que corresponden a cada controlador
     * @param string $vista nombre del archivo
     * @param type $parcial
     * @throws Exception
     */
    public function renderizar($vista, $parcial = FALSE) {
        $rutaVista = RAIZ . 'vistas' . SD . $this->_peticion->getControlador() . SD . $vista . '.phtml';

        if (is_readable($rutaVista)) {
            if ($parcial) {
                require_once $rutaVista;
            } else {
                ob_start();
                require_once $rutaVista;
                $this->contenido = ob_get_contents();
                ob_end_clean();
                require_once RAIZ . 'vistas' . SD . '_plantilla' . SD . 'plantilla.phtml';
            }
        } else {
            throw new Exception('Vista no encontrada');
        }
    }

    /**
     * Método que genera paginacion de registros
     * @param int $actual página actual
     * @param int $nreg número de registros
     * @param string $url direccion de la paginacion
     * @param type $ancla hashtag si se requiere
     */
    public function getPaginacion($actual, $nreg, $url, $ancla = '') {
        $npaginas = intval(($nreg - 1) / REG_PAG) + 1;
        if ($actual <= 0 || $actual > $npaginas) {
            $actual = 1;
        }
        $this->pactual = $actual;
        if ($npaginas > 1) {
            $desde = ($actual - 2 < 1) ? 1 : $actual - 2;
            $hasta = ($desde + 4 > $npaginas) ? $npaginas : $desde + 4;
            $this->paginar = array('desde' => $desde, 'hasta' => $hasta, 'npaginas' => $npaginas, 'actual' => $actual, 'url' => URL_BASE . $url, 'ancla' => $ancla);
            ob_start();
            require_once RAIZ . 'vistas' . SD . '_plantilla' . SD . 'paginador.phtml';
            $this->paginar = ob_get_contents();
            ob_get_clean();
        }
    }

    /**
     * Método que agrega un css a la vista
     * @param string $css nombre del archivo css
     */
    public function setCss($css) {
        $this->_css[] = $this->_plantilla . 'css/' . $css . '.css';
    }

    /**
     * Método que agrega un js a la vista
     * @param string $js nombre del archivo js
     */
    public function setJs($js) {
        $this->_js[] = $this->_plantilla . 'js/' . $js . '.js';
    }
    
    /**
     * Método que fomatea la fecha aaaa-mm-dd a dd/mm/aaaa
     * @param type $fecha
     * @return type
     */
    public function fecha($fecha) {
        return implode("/", array_reverse(explode("-", $fecha)));
    }
    /**
     *  Método que formatea la hora hh:mm:ss a hh:mm
     * @param string $hora
     * @return type
     */
    public function hora($hora) {
        return substr($hora, 0, 5);
    }

}
