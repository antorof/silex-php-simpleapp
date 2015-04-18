<?php
/**
 * @author Juan Marfil
 * @author Antonio Toro
 */

 interface DBStatic {
 	
 	/**
	 * Realiza una conexion fugaz a la base de datos: abre la conexion, ejecuta y cierra la conexion
	 *
	 * @access public
	 * @param string $host La direccion del host a conectar (nombre o IP)
	 * @param string $user El usuario a conectar a la base de datos
	 * @param string $pass La contraseña para conectar a la base de datos
	 * @param string $db El nombre de la base de datos a conectar
	 * @param string query La consulta a ejecutar
	 * @return resource El resultado de la consulta
	 */
	public static function flashConnectDataBase($host, $user, $pass, $db, $query);

	/**
	 * Extrae una fila del resultado de una consulta SQL
	 *
	 * @access public
	 * @param resource resultado El resultado de una consulta SQL
	 * @return fila Una fila de la consulta
	 */
	public static function fechtRows($resultado);
	
	/**
	 * Extrae una fila asociativa del resultado de una consulta SQL
	 *
	 * @access public
	 * @param resource resultado El resultado de una consulta SQL
	 * @return fila Una fila de la consulta
	 */
	public static function fechtRowsAsocc($resultado);

	/**
	 * Devuelve el numero de filas devueltas por la operacion indicada
	 *
	 * @access public
	 * @param resource $resultado El resultado de una consulta SQL
	 * @return int El numero de filas devueltas por la ultima operacion
	 */
	public static function getNumRowsReturn($resultado);

	/**
	 * Devuelve el numero de filas afectadas por la operacion indicada
	 *
	 * @access public
	 * @param resource $resultado El resultado de una consulta SQL
	 * @return int El numero de filas afectadas por la ultima operacion
	 */
	public static function getNumRowsAfectadas($resultado);

	/**
	 * Devuelve un array con el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return array Devuelve un array con el resultado de una consulta
	 */
	public static function getArray($resultado);
	
	/**
	 * Devuelve un array asociativo (nombre de columnas) con el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return array Devuelve un array con el resultado de una consulta
	 */
	public static function getArrayAsocc($resultado);

	/**
	 * Devuelve el resultado de la consulta
	 *
	 * @access public
	 * @param result resultado El resource resultado de una consulta
	 * @return unknown Devuelve un dato con el resultado de una consulta
	 */
	public static function getData($resultado);
 }
?>