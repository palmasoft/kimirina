<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");


define('_P4LM4S0FTLTD4', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'CARP_BASE', dirname(__FILE__).DS );


//Incluimos el FrontController
require 'libs/sistema/GUIController.php';
//Lo iniciamos con su metodo estático main.
GUIController::ejecutar_accion();

?>