<?php
/*
 * @author Juan Marfil Bustos
 * @email jmarfilb (at) gmail (dot) com
 */

 


 /**
  * Contiene los datos de acceso para la conexion con la base de datos mysql
  * con privilegios de lectura y escritura para los datos de la web
  */
 class Acceso{

 	/**
 	 * @var string La direccion del host a conectar (nombre o IP)
 	 * @name $host
 	 * @access public
 	 */
	public static $host = 'localhost';

	/**
 	 * @var string El usuario a conectar a la base de datos
 	 * @name $user
 	 * @access public
 	 */
	public static $user = 'u331967724_cys';	

	/**
 	 * @var string La contrase�a para conectar a la base de datos
 	 * @name $password
 	 * @access public
 	 */	
	//public static $password = 'hostingpruebas1';
	public static $password = 'dS5iUjRd_yp*tr5';

	/**
 	 * @var string El nombre de la base de datos a conectar
 	 * @name $dataBase
 	 * @access public
 	 */
	public static $dataBase = 'u331967724_cys';

 }
 

?>