<?php
$ERROR_REPORTING = E_ALL;
//$ERROR_REPORTING = 0;

error_reporting($ERROR_REPORTING);

// Iniciacizacion de variables generales
require_once("classes/GestorContactos.php");

$gc = new GestorContactos();