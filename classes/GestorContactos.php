<?php
require("class.WADB.php");
/**
 * @author Antonio Toro
 */
class GestorContactos {
    public $db;

    public function __construct() {
        $this->db = new WADB();
    }

    public function aniadirContacto($nombre, $email=NULL, $telefono=NULL) {
        $query = "INSERT INTO contactos
                  VALUES (NULL,'$nombre','$email','$telefono')";

        return $this->db->execute($query);
    }

    public function actualizarContacto($id, $nombre, $email=NULL, $telefono=NULL) {
        $query = "UPDATE contactos
                  SET nombre='$nombre',
                      email='$email',
                      telefono='$telefono'
                  WHERE id='$id'";

        return $this->db->execute($query);
    }

    public function eliminarContacto($id) {
        return $this->db->deleteRow($id,"contactos");
    }

    public function obtenerContacto($id) {
        $query = "SELECT * FROM contactos WHERE id='$id' LIMIT 1";

        return $this->db->getArrayAsocc($this->db->execute($query));
    }

    public function aniadirCampoAdicional($contacto,$nombre,$contenido) {
        $query = "INSERT INTO campos_adicionales
                  VALUES (NULL,'$contacto','$nombre','$contenido')";
        return $this->db->execute($query);
    }

    public function eliminarCampoAdicional($id) {
        return $this->db->deleteRow($id,"campos_adicionales");
    }

    public function eliminarCamposAdicionales($contacto) {
        return $this->db->deleteRows("campos_adicionales","contacto='$contacto'");
    }

    public function listarContactos() {
        $query = "SELECT * FROM contactos";

        return $this->db->getArrayAsocc($this->db->execute($query));
    }
} 