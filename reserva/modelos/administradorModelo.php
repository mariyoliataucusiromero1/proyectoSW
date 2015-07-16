<?php

class administradorModelo extends Modelo {
    public function __construct() {
        parent::__construct();
    }
    
    public function insertar($datos) {
        $this->_bd->ejecutar('INSERT INTO administrador VALUES(NULL, ?, ?, ?, ?, ?, ?)', $datos);
    }
    
    public function existeDni($dni) {
        return $this->_bd->getScalar('SELECT id FROM administrador WHERE dni = ?', $dni);
    }
    
    public function existeEmail($email) {
        return $this->_bd->getScalar('SELECT id FROM administrador WHERE email = ?', $email);
    }
    
    public function contar() {
        return $this->_bd->getScalar('SELECT COUNT(id) FROM administrador');
    }
        
    public function get($id) {
        return $this->_bd->getFila('SELECT * FROM administrador WHERE id = ?', $id);
    }
    
   
}
