<?php

	$urlInterface = 'http://www.corporacionregistrocivil.gov.ec/OnLine/show_cedula.asp';

     $postdata = http_build_query(
            array(
                'nroced' => $_GET['cedula'],
                'strCAPTCHAsc' => $_GET['codAcceso'],
                'strCAPTCHA' => $_GET['codAcceso']
            )
    );

    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata,
        'Content-Length' => '4000'
        )
    );

    $context = stream_context_create($opts);
    echo $response = file_get_contents( $urlInterface, 0, $context);
    //$canton = json_decode($response, TRUE);    
    

