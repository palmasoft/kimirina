<?php

setlocale(LC_ALL, "es_ES");
date_default_timezone_set('America/Guayaquil'); 

define('_P4LM4S0FTLTD4', 1);
define('DS', DIRECTORY_SEPARATOR);
define('CARP_BASE', dirname(__FILE__) . DS);
//$externalIp = file_get_contents('http://phihag.de/ip/');
//$externalIp = 'simon.kimirina.org';
//define('URL_PUBLICA', "http://" . $externalIp . dirname($_SERVER['PHP_SELF']) . "/" );

//Incluimos el FrontController
require 'libs/sistema/GUIController.php';
//Lo iniciamos con su metodo est�tico main.

header("Content-Type: text/html;charset=utf-8");
//header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=UTF-8');


GUIController::ejecutar_accion();
