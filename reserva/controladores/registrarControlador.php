<?php

class registrarControlador extends Controlador {

    /** @var registrarModelo  */
    private $_modelo;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->getInt('guardar')) {
            $this->dump($this->post);
            $this->_vista->dato = $this->post;
            if ($this->post['rol'] == 'clien') {
                $_rol = 'cliente';
            } elseif ($this->post['rol'] == 'emple') {
                $_rol = 'empleado';
            } elseif ($this->post['rol'] == 'admin') {
                $_rol = 'control';
            }
            $this->_modelo = $this->getModelo('registrar');
            
            $this->_vista->error[] = 'No pudo acceder al sistema';
        }
        $this->_vista->titulo = 'Registrate';
        $this->_vista->renderizar('registrar');
    }

}
