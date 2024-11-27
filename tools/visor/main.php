<?php

$path_parts = pathinfo( $_GET['soporte_url'] );
//echo $path_parts['dirname'], "<br />";
//echo $path_parts['basename'], "<br />";
echo $path_parts['extension'], "<br />";
//echo $path_parts['filename'], "<br />"; 

$visor ="http://simon.kimirina.org/" ;

$office =  array();
if( in_array(  $path_parts['extension'],$office) ) {
   $visor = "http://view.officeapps.live.com/op/view.aspx?src=http://simon.kimirina.org/" ;
}

$office =  array('pdf','odf','doc','docx' ,'ppt', 'pptx' ,'xls', 'xlsx' );
if( in_array(  $path_parts['extension'],$office) ) {
   $visor = "https://docs.google.com/viewer?embedded=true&url=http://simon.kimirina.org/" ;	
}

$iamges =  array ('JPEG', 'PNG', 'GIF', 'TIFF', 'BMP');
if( in_array(  $path_parts['extension'],$iamges) ) {
   $visor ="http://simon.kimirina.org/" ;
}

header('Location: '.$visor.$_GET['soporte_url'] );
exit;

