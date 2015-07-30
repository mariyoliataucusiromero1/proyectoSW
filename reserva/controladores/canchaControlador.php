<?php

class canchaControlador extends Controlador {

    /** @var canchaModelo  */
    private $_modelo;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    }

    public function nuevo() {
        if ($this->getInt('guardar')) {
            $this->_vista->dato = $this->post;
            $this->_modelo = $this->getModelo('cancha');
            if (!$this->getTex('nombre')) {
                $this->_vista->error[] = 'Nombre no válido.';
            }
            if (!$this->getTex('ubicacion')) {
                $this->_vista->error[] = 'Ubicacion  no válido.';
            } elseif ($this->_modelo->existeUbicacion($this->post['ubicacion'])) {
                $this->_vista->error[] = 'Ubicacion ya existe.';
            }
            if (!isset($this->_vista->error)) {
                $this->quitar('guardar');
                $this->setPost('admin_id', Sesion::get('id'));
                $this->_modelo->insertar($this->getPost());
                Sesion::set('_msg', 'Se ha insertado un cancha');
                $this->redireccionar('cancha/listar');
            }
        }
        $this->_vista->titulo = 'Nuevo cancha';
        $this->_vista->renderizar('nuevo');
    }
    public function listar() {
        $this->_modelo = $this->getModelo('cancha');
        $this->_vista->dato = $this->_modelo->listar();
        $this->_vista->titulo = 'Lista de cancha';
        $this->_vista->renderizar('listar');
        $this->_vista->setJs('cancha');
        $this->_vista->renderizar('listar');
    }

}