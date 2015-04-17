<?php
/*
 * @author Juan Marfil Bustos
 * @email jmarfilb (at) gmail (dot) com
 */

 /**
  * Clase para realizar una conexion permanente a una base de datos Generica y eventuales
  * conexiones fugaces
  */
 abstract class DBConnection{

	/**
	 * Constructor de la clase DBConnection
	 *
	 * @access public
	 * @internal Puede lanzar ConnectException si no se puede conectar a la base de datos
	 * @param string $host La direccion del host a conectar (nombre o IP)
	 * @param string $user El usuario a conectar a la base de datos
	 * @param string $pass La contraseña para conectar a la base de datos
	 * @param string $db El nombre de la base de datos a conectar
	 */
	public function DBConnection($host, $user, $pass, $db){
		$this->host = $host;
		$this->user = $user;
		$this->password = $pass;
		$this->dataBase = $db;
	}

	/**
	 * Realiza la conexion permanente a la base de datos
	 *
	 * @access public
	 * @return bool Devuleve true si la conexion se realizo correctamente
	 */
	public abstract function connectDataBase();

	/**
	 * Ejecuta una consulta en la conexion permanente de la base de datos
	 *
	 * @access public
	 * @param string consulta La consulta SQL a realizar
	 * @return resource El resultado de la consulta SQL
	 */
	public abstract function execute($consulta);
	
	/**
	 * Devuelve una cadena con los caracteres especiales escapados
	 *
	 * @access public
	 * @param string cadena Cadena a escapar
	 * @return string Una cadena con los caracteres especiales escapados
	 */
	public abstract function escapeChar($cadena);
	
	/**
	 * Devuelve el valor del ultimo id insertado en la tabla
	 * @return int El �ltimo id insertado
	 */
	public abstract function getLastInsertId();
	
	/**
	 * Cierra la conexion con la base de datos
	 */
	public abstract function closeDataBase();

 }


?>