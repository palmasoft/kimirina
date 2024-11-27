<?php

class auditoriaFormulariosModel  extends ModelBase {
    
   static $sqlBaseRegistroSemanales = "
       SELECT
            subreceptores.*
            , personas_sistema.*            
            , auditoria_formularios.*
        FROM
            auditoria_formularios            
            INNER JOIN personas_sistema 
                ON (auditoria_formularios.ID_MODIFICA = personas_sistema.ID_PERSONA)
            INNER JOIN subreceptores 
                ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
       ";
   
   public static function correcciones( $TIPO_FORMULARIO, $ID_FORMULARIO ) {
        $query = self::$sqlBaseRegistroSemanales . " WHERE "
            . " auditoria_formularios.TIPO_FORMULARIO = '".$TIPO_FORMULARIO."' AND "
            . " auditoria_formularios.ID_FORMULARIO = ".$ID_FORMULARIO." "
            . "  ORDER BY auditoria_formularios.FECHA_MODIFICACION DESC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
   }
    
    
    public static function insertar($ID_FORMULARIO, $TIPO_FORMULARIO, $RAZONES_MODIFICACION, $DATOS_ANTIGUOS, $DATOS_NUEVOS) {
           $query =  "INSERT INTO auditoria_formularios
            (ID_FORMULARIO,
             TIPO_FORMULARIO,
             ID_MODIFICA,
             FECHA_MODIFICACION,
             RAZONES_MODIFICACION,
             DATOS_ANTIGUOS,
             DATOS_NUEVOS)
             VALUES ('".$ID_FORMULARIO."',
                    '".$TIPO_FORMULARIO."',
                    '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "',
                    CURRENT_TIMESTAMP,
                    '".$RAZONES_MODIFICACION."',
                    '".$DATOS_ANTIGUOS."',
                    '".$DATOS_NUEVOS."')
                ";
           
            return self::crear_ultimo_id($query);       
    }
}