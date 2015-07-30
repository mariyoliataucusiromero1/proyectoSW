<?php

class canchaModelo extends Modelo {
    public function __construct() {
        parent::__construct();
    }
    
    public function insertar($datos) {
        $this->_bd->ejecutar('INSERT INTO cancha VALUES(NULL, ?, ?, ?)', $datos);
    }
    
    public function contar() {
        return $this->_bd->getScalar('SELECT COUNT(id) FROM cancha');
    }
        
    public function get($id) {
        return $this->_bd->getFila('SELECT * FROM cancha WHERE id = ?', $id);
    }
    public function listar() {
        return $this->_bd->getArray('SELECT * FROM cancha WHERE admin_id = ?', array(Sesion::get('id')));
    }
    public function existeUbicacion($ubicacion) {
        return $this->_bd->getScalar('SELECT id FROM cancha WHERE ubicacion = ?', $ubicacion);
    }
    public function editar($datos) {
        $this->_bd->ejecutar('UPDATE cancha SET nombre=?, ubicacion=? WHERE id = ?', $datos);
    }

    public function eliminar($id) {
        $this->_bd->ejecutar('DELETE FROM cancha WHERE id = ?', $id);
    }

    public function buscarPlaca($nombre) {
        return $this->_bd->getArray('SELECT * FROM cancha WHERE nombre LIKE ?', $nombre . '%');
    }

   
}
