<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");


define('_P4LM4S0FTLTD4', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'CARP_BASE', dirname(__FILE__).DS );


//Incluimos el FrontController
require 'libs/sistema/GUIController.php';
//Lo iniciamos con su metodo est�tico main.

header('Cache-Control: max-age=60, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+60)." GMT");
header('Content-Type: text/html; charset=utf-8');


GUIController::main();


?>