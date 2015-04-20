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
        $nombre = $this->db->escapeChar($nombre);
        $email = $this->db->escapeChar($email);
        $telefono = $this->db->escapeChar($telefono);

        $query = "INSERT INTO contactos
                  VALUES (NULL,'$nombre','$email','$telefono')";

        return $this->db->execute($query);
    }

    public function actualizarContacto($id, $nombre, $email=NULL, $telefono=NULL) {
        $id = $this->db->escapeChar($id);
        $nombre = $this->db->escapeChar($nombre);
        $email = $this->db->escapeChar($email);
        $telefono = $this->db->escapeChar($telefono);

        $query = "UPDATE contactos
                  SET nombre='$nombre',
                      email='$email',
                      telefono='$telefono'
                  WHERE id='$id'";

        return $this->db->execute($query);
    }

    public function eliminarContacto($id) {
        $id = $this->db->escapeChar($id);

        return $this->db->deleteRow($id,"contactos");
    }

    public function obtenerContacto($id) {
        $id = $this->db->escapeChar($id);

        $query = "SELECT * FROM contactos WHERE id='$id' LIMIT 1";

        return $this->db->getArrayAsocc($this->db->execute($query));
    }

    public function aniadirCampoAdicional($contacto,$nombre,$contenido) {
        $contacto = $this->db->escapeChar($contacto);
        $nombre = $this->db->escapeChar($nombre);
        $contenido = $this->db->escapeChar($contenido);

        $query = "INSERT INTO campos_adicionales
                  VALUES (NULL,'$contacto','$nombre','$contenido')";
        return $this->db->execute($query);
    }

    public function eliminarCampoAdicional($id) {
        $id = $this->db->escapeChar($id);

        return $this->db->deleteRow($id,"campos_adicionales");
    }

    public function eliminarCamposAdicionales($contacto) {
        $contacto = $this->db->escapeChar($contacto);

        return $this->db->deleteRows("campos_adicionales","contacto='$contacto'");
    }

    public function listarContactos() {
        $query = "SELECT * FROM contactos";

        return $this->db->getArrayAsocc($this->db->execute($query));
    }
} 