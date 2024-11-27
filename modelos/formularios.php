<?php

class FormulariosModel extends ModelBase {

    public static $sqlBase = " SELECT * FROM listado_registros_semanales ";
    public static $sqlGroup = "";

    public static function todos() {
        $query = self::$sqlBase."  ".self::$sqlGroup;
        $consulta = self::consulta( $query );
        if( count($consulta) > 0 ) return $consulta;
        return 0;    
    }   

	public static function crear_encabezdao_formulario($ID_PARROQUIA,$ID_PROMOTOR,$ID_MONITOR,$LATITUD_FORMULARIO,$LONGITUD_FORMULARIO)
	{
		 $query = "insert into formularios_contacto(
		 	ID_PARROQUIA,ID_PROMOTOR,ID_MONITOR,LATITUD_FORMULARIO,LONGITUD_FORMULARIO
		 	)  values ( 
		 	".$ID_PARROQUIA.", ".$ID_PROMOTOR.", ".$ID_MONITOR.", ".$LATITUD_FORMULARIO.", ".$LONGITUD_FORMULARIO." )";
		return self::crear_ultimo_id( $query );
	}



}?>