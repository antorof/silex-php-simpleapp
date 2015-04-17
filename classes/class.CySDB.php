<?php
 /*
 * @author Juan Marfil Bustos 
 * @email jmarfilb (at) gmail (dot) com  
 */
 
 require_once 'class.Acceso.php';
 require_once 'class.MysqlDB.php';
 
 /**
  * Clase que abstrae una conexion a la base de datos
  */
 class CySDB extends MysqlDB {
 	
	public function __construct(){
		parent::__construct(Acceso::$host, Acceso::$user, Acceso::$password, Acceso::$dataBase);
		$this->execute("SET NAMES 'utf8'");
	}	
	
 }
 
 ?>