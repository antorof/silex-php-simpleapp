<?php
/*
 * @author Juan Marfil Bustos
 * */

 /**
  * Clase para los errores de conexion con la base de datos
  *
  * @uses Exception Excepcion standar
  */
 class ConnectException extends Exception{

	/**
	 * Constructor de la clase
	 *
	 * @access public
	 * @param string message El mensage de error
	 * @param int code Codigo del error
	 */
 	public function ConnectException($message, $code = 0){
 		parent::__construct($message, $code);
 	}

 	/**
	 * Funcion para pasar la excepcion a un string
	 *
	 * @access public
	 * @return string La descripcion de la excepcion junto con el codigo
	 */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
 }


 /**
  * Clase para los errores de consulta con la base de datos
  *
  * @uses Exception Excepcion standar
  */
 class QueryException extends Exception{

	/**
	 * Constructor de la clase
	 *
	 * @access public
	 * @param string message El mensage de error
	 * @param int code Codigo del error
	 */
 	public function QueryException($message, $code = 0){
 		parent::__construct($message, $code);
 	}

 	/**
	 * Funcion para pasar la excepcion a un string
	 *
	 * @access public
	 * @return string La descripcion de la excepcion junto con el codigo
	 */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
 }

 /**
  * Clase para los errores al cerrar la conexion con la base de datos
  *
  * @uses Exception Excepcion standar
  */
 class CloseException extends Exception{

	/**
	 * Constructor de la clase
	 *
	 * @access public
	 * @param string message El mensage de error
	 * @param int code Codigo del error
	 */
 	public function CloseException($message, $code = 0){
 		parent::__construct($message, $code);
 	}

	/**
	 * Funcion para pasar la excepcion a un string
	 *
	 * @access public
	 * @return string La descripcion de la excepcion junto con el codigo
	 */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
 }
?>