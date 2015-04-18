<?php
/**
 * @author Juan Marfil
 * @author Antonio Toro
 */
 
 require_once 'class.Acceso.php';
 require_once 'class.MysqlDB.php';
 
 /**
  * Clase que abstrae una conexion a la base de datos
  */
 class WADB extends MysqlDB {
 	
	public function __construct(){
		parent::__construct(Acceso::$host, Acceso::$user, Acceso::$password, Acceso::$dataBase);
		$this->execute("SET NAMES 'utf8'");
	}	
	
 }
 
 ?>