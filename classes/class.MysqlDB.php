<?php
 /*
 * @author Juan Marfil Bustos
 * @email jmarfilb (at) gmail (dot) com
 *
 */

 require_once 'class.DBConnection.php';
 require_once 'class.DBStatic.php';
 require_once 'class.DBExceptions.php';

 /**
  * Clase para realizar una conexion permanente a una base de datos Mysql y eventuales
  * conexiones fugaces
  *
  * @uses DBConnection Extiende a la clase DBConnection generica
  * @uses MysqlExceptions Usa las clases derivadas de Exception para manejo de Excepciones con la base de datos
  */
 class MysqlDB extends DBConnection implements DBStatic {

 	/**
 	 * @var int Identificador de enlace con la base de datos
 	 * @name $linkDataBase
 	 * @access private
 	 */
	private $linkDataBase = '';

	/**
	 * Constructor de la clase MysqlDB
	 *
	 * @access public
	 * @internal Puede lanzar ConnectException si no se puede conectar a la base de datos
	 * @param string $host La direccion del host a conectar (nombre o IP)
	 * @param string $user El usuario a conectar a la base de datos
	 * @param string $pass La contraseña para conectar a la base de datos
	 * @param string $db El nombre de la base de datos a conectar
	 */
	public function __construct($host, $user, $pass, $db){
		parent::DBConnection($host, $user, $pass, $db);
		$this->connectDataBase();
	}
	
	/**
	 * Destructor de la clase
	 */
	public function __destruct(){				
		$this->closeDataBase();
	}
	
	/**
	 * Realiza la conexion permanente a la base de datos
	 *
	 * @access public
	 * @internal Puede lanzar ConnectException si no se puede conectar a la base de datos
	 * @return bool Devuleve true si la conexion se realizo correctamente
	 */
	public function connectDataBase(){
		$this->linkDataBase = new mysqli($this->host, $this->user, $this->password);
  		if ($this->linkDataBase->connect_error) {
  			throw new ConnectException("Imposible realizar la conexion: " . $this->linkDataBase->connect_error);
  		}  		
  		if(!$this->linkDataBase->select_db($this->dataBase)){
  			throw new QueryException("No se puede seleccionar la base de datos: " . $this->linkDataBase->connect_error);
  		}
  		return true;
	}

	/**
	 * Ejecuta una consulta en la conexion permanente de la base de datos
	 *
	 * @access public
	 * @internal Puede lanzar una QueryException si se realiza una consulta erronea
	 * @param string consulta La consulta SQL a realizar
	 * @return resource El resultado de la consulta SQL
	 */
	public function execute($consulta){
		$resultado = $this->linkDataBase->query($consulta);

  		if(!$resultado){
  			throw new QueryException("Consulta no v�lida: --$consulta-- " . $this->linkDataBase->connect_error);
  		}
  		return $resultado;
	}
	
 	/**
	 * Devuelve una cadena con los caracteres especiales escapados
	 *
	 * @access public
	 * @param string cadena Cadena a escapar
	 * @return string Una cadena con los caracteres especiales escapados
	 */
	public function escapeChar($cadena){
		return $this->linkDataBase->real_escape_string($cadena);
	}
	
 	/**
	 * Devuelve el valor del ultimo id insertado en la tabla
	 * @return int El �ltimo id insertado
	 */
	public function getLastInsertId(){
		return $this->linkDataBase->insert_id;
	}
	
	/**
	 * Cierra la conexion con la base de datos
	 */
	public function closeDataBase(){
		$this->linkDataBase->close();
	}
	
 	/**
	 * Realiza una conexion fugaz a la base de datos: abre la conexion, ejecuta y cierra la conexion
	 *
	 * @access public
	 * @internal Puede lanzar ConnectException si no se puede conectar a la base de datos,
	 * 			 QueryException si hay una consulta erronea o CloseException si el enlace a la
	 * 			 base de datos no puede cerrarse
	 * @param string $host La direccion del host a conectar (nombre o IP)
	 * @param string $user El usuario a conectar a la base de datos
	 * @param string $pass La contraseña para conectar a la base de datos
	 * @param string $db El nombre de la base de datos a conectar
	 * @param string query La consulta a ejecutar
	 * @return resource El resultado de la consulta
	 */
	public static function flashConnectDataBase($host, $user, $pass, $db, $query){
		$link = new mysqli($host, $user, $pass);
  		if ($link->connect_error) {
  			throw new ConnectException("Imposible realizar la conexion: " . $this->linkDataBase->connect_error);
  		}
  		
  		$link->select_db($db);		
  		$resultado = $link->query( $query);
  		  		
  		if(!$resultado){
  			throw new QueryException("Consulta no v�lida: --$consulta-- " . $this->linkDataBase->connect_error);
  		}

  		return $resultado;
	}

	/**
	 * Extrae una fila del resultado de una consulta SQL
	 *
	 * @access public
	 * @param resource resultado El resultado de una consulta SQL
	 * @return fila Una fila de la consulta
	 */
	public static function fechtRows($resultado){
		return mysqli_fetch_row($resultado);
	}
	
 	/**
	 * Extrae una fila asociativa del resultado de una consulta SQL
	 *
	 * @access public
	 * @param resource resultado El resultado de una consulta SQL
	 * @return fila Una fila de la consulta
	 */
	public static function fechtRowsAsocc($resultado){
		return mysqli_fetch_assoc($resultado);
	}

	/**
	 * Devuelve el numero de filas devueltas por la operacion indicada
	 *
	 * @access public
	 * @param resource $resultado El resultado de una consulta SQL
	 * @return int El numero de filas devueltas por la ultima operacion
	 */
	public static function getNumRowsReturn($resultado){
		return mysqli_num_rows($resultado);
	}

	/**
	 * Devuelve el numero de filas afectadas por la operacion indicada
	 *
	 * @access public
	 * @param resource $resultado El resultado de una consulta SQL
	 * @return int El numero de filas afectadas por la ultima operacion
	 */
	public static function getNumRowsAfectadas($resultado){
		return mysqli_affected_rows($resultado);
	}

	/**
	 * Devuelve un array con el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return array Devuelve un array con el resultado de una consulta
	 */
	public static function getArray($resultado){
		$array = array();
		while($row = mysqli_fetch_row($resultado)){
			$array[] = $row;
		}
		return $array;
	}
	
	/**
	 * Devuelve un array asociativo (nombre de columnas) con el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return array Devuelve un array con el resultado de una consulta
	 */
	public static function getArrayAsocc($resultado){
		$array = array();
		while($row = mysqli_fetch_assoc($resultado)){
			$array[] = $row;
		}
		return $array;
	}

	/**
	 * Devuelve el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return unknown Devuelve un dato con el resultado de una consulta
	 */
	public static function getData($resultado){
		if( mysqli_num_rows($resultado)==1 ){
			$row = mysqli_fetch_row($resultado);
			return $row[0];
		}
		return false;
	}

 }


?>