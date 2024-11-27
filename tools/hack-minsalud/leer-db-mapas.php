<?php


$fichero = 'newubicacion3.sql';
// Abre el fichero para obtener el contenido existente
//$actual = file_get_contents($fichero);
// Añade una nueva persona al fichero
//$actual .= "////iiciamos----------------";

$enlace = mysql_connect('localhost', 'root', '');
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}
mysql_select_db('kimirina_tmp');


function consulta_mapas($sql)
{
	
	$postdata = http_build_query(
	    array(
	    	'valor'=> $sql
	    )
	);

	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $postdata
	    )
	);

	$context = stream_context_create($opts);
	$response = file_get_contents("http://201.219.3.112/restructura/mapas/ubicaciones/leeDependencias.php", 0, $context);
	
	return json_decode($response);
}


function consulta_bd_kimirina($sQl)
{
	mysql_query( $sQl );
	return mysql_insert_id();	
}


$sqlProvincias ="SELECT DISTINCT(provincia) as item FROM unidades order by provincia";
$provinicias = consulta_mapas($sqlProvincias);
$i = 0;
foreach ($provinicias as $index => $provincia) {
	//echo "Provincia ".$i." -	> ".$provincia[0];
	$i++;
	//echo "<br/>";
        $sql1 = "insert into provincia (NOMBRE_PROVINCIA) values ('".$provincia[0]."');";
        file_put_contents($fichero, $sql1, FILE_APPEND);
	$idProvincia = consulta_bd_kimirina(
		$sql1
	);

	$sqlCantones ="SELECT DISTINCT(canton) as item FROM unidades WHERE provincia = '".$provincia[0]."' order by provincia";
	$cantones = consulta_mapas($sqlCantones);
	$j = 0;
	foreach ($cantones as $j => $canton) {
		//echo " - Cánton ".$j." -	> ".$canton[0];
		$j++;
		//echo "<br/>";
              
                
                $sql2 = "
			insert into canton ( ID_PROVINCIA, NOMBRE_CANTON ) 
			values ( '".$idProvincia."', '".$canton[0]."' ) ;";
                file_put_contents($fichero, $sql2, FILE_APPEND);
		$idCanton = consulta_bd_kimirina($sql2);

		$sqlParroquias ="SELECT DISTINCT(parroquia) as item FROM unidades WHERE provincia = '".$provincia[0]."' and canton = '".$canton[0]."'  order by provincia";
		$parroquias = consulta_mapas($sqlParroquias);
		$v = 0;
		foreach ($parroquias as $v => $parroquia) {
			//echo " - - parroquia ".$v." -	> ".$parroquia[0];
			$v++;
			//echo "<br/>";
                        $sql3 = "
				insert into parroquias ( ID_CANTON, CODIGO_PARROQUIA, NOMBRE_PARROQUIA )
				values ( '".$idCanton."', '".substr($parroquia[0], 0,3)."', '".$parroquia[0]."' );";   
                        file_put_contents($fichero, $sql3, FILE_APPEND);
			$idParroquia  = consulta_bd_kimirina($sql3);
		}
	}

}




/*
$sqlProvincias ="SELECT concat( concat( concat(id , '-'), concat( provincia, '-') ) ,   concat( concat(canton , '-'), concat( parroquia, '-') ) )as item FROM unidades order by provincia";
$provinicias = consulta_mapas($sqlProvincias);
$i = 0;
foreach ($provinicias as $index => $provincia) {
	echo $i." -	> ".$provincia[0];
	$i++;
	echo "<br/>";
}*/

?>