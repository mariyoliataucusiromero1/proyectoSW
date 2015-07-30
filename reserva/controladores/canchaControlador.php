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
    public function listarCancha() {
        $this->_modelo = $this->getModelo('cancha');
        $this->_vista->dato = $this->_modelo->listarCancha();
        $this->_vista->titulo = 'Lista de cancha';
        $this->_vista->renderizar('listarCan');
        $this->_vista->setJs('cancha');
        $this->_vista->renderizar('listarCan');
    }
    public function editar($id) {
        $id = $this->aInt($id);
        if (!$id) {
            $this->redireccionar('cancha/listar');
        }
        $this->_modelo = $this->getModelo('cancha');
        $this->_vista->dato = $this->_modelo->get($id);
        if (!$this->_vista->dato) {
            $this->redireccionar('cancha/listar');
        }
        if ($this->getInt('guardar')) {
            $this->_vista->dato = $this->post;
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
                $this->setPost('id', $id);
                $this->_modelo->editar($this->getPost());
                Sesion::set('_msg', 'Se ha guardado su operación');
                $this->redireccionar('cancha/listar');
            }
        }
        $this->_vista->titulo = 'Editar cancha';
        $this->_vista->renderizar('nuevo');
    }

    public function eliminar($id) {
        $id = $this->aInt($id);
        if (!$id) {
            $this->redireccionar('cancha/listar');
        }
        $this->_modelo = $this->getModelo('cancha');
        $this->_vista->dato = $this->_modelo->get($id);
        if (!$this->_vista->dato) {
            $this->redireccionar('cancha/listar');
        }
        if ($this->getInt('guardar')) {
            $this->_modelo->eliminar($id);
            Sesion::set('_msg', 'Se ha eleiminado un cancha');
            $this->redireccionar('cancha/listar');
        }
        $this->_vista->titulo = '¿Desea eliminar el cancha ' . $this->_vista->dato['nombre'] . '?';
        $this->_vista->renderizar('eliminar');
    }
    
        public function canchacar_placa($placa) {
        $this->_modelo = $this->getModelo('cancha');
        $this->_vista->dato = $this->_modelo->canchacarPlaca($placa);
        $this->_vista->renderizar('canchacar', TRUE);

    }

}