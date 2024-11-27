<?php

ini_set('memory_limit', '-1');

 	$db_users = array(
 		array( 'user' => 'kimirina_adm', 'pass' => 'k1m1r1n4' )  
 		/*, array( 'user' => 'kimirina_usr0', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr1', 'pass' => 'k1m1r1n4' )  
 		, array( 'user' => 'kimirina_usr2', 'pass' => 'k1m1r1n4'  )  
 		, array( 'user' => 'kimirina_usr3', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr4', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr5', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr6', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr7', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr8', 'pass' => 'k1m1r1n4'  ) 
 		, array( 'user' => 'kimirina_usr9', 'pass' => 'k1m1r1n4'  ) */
 	);
	$idUser = rand(1, count($db_users)) - 1;

	$config->set('plantillas', 'plantillas/');
	$config->set('libreria', 'libs/');
	$config->set('componentes', 'componentes/');
	$config->set('modelos', 'modelos/');
        
	$config->set('passEncript', 'sinap_kimirina');
  
	$config->set('URL_PUBLICA', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] );



	$config->set('LOGINTEMPLATE', 'login/');
	$config->set('URL_ICONOS_MODULOS', 'imagenes/modulos/');

	$config->set('dbtype', 'mysql');
	$config->set('dbhost', 'localhost');
	$config->set('dbport', '');
	$config->set('dbname', 'kimirina_simon');
  
  
	$config->set('dbuser', ''.$db_users[$idUser]['user'].'' );
	$config->set('dbpass', ''.$db_users[$idUser]['pass'].'' );

	$config->set('dbuser', '');
	$config->set('dbpass', '');


?>