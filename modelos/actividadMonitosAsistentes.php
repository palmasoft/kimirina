<?php
class ActividadesMonitorAsistentesModel extends ModelBase {
    
       public static $sqlBase = "
          SELECT
            actividades_monitor.*,
            tipo_usuario.* ,
            personas_sistema.*,
            actividades_monitor_asistentes.*
            FROM
                actividades_monitor_asistentes
                LEFT JOIN actividades_monitor 
                    ON (actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR = actividades_monitor.ID_ACTIVIDADREALIZADA)
                LEFT JOIN personas_sistema 
                    ON (actividades_monitor_asistentes.ID_ASISTENTE = personas_sistema.ID_PERSONA) 
               LEFT JOIN tipo_usuario 
                    ON ( personas_sistema.ID_ROL_TIPOUSUARIO = tipo_usuario.ID_ROL) 
        ";

    public static function todos() {
        $query = self::$sqlBase . "";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    
    public static function asistentes_de_la_actividad($id_actividad) {
        $query = self::$sqlBase . " WHERE actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR = ".$id_actividad."  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    
    
    public static function insertar($ID_ACTIVIDAD_MONITOR, $ID_PERSONA){
        $query = "
            insert into actividades_monitor_asistentes  (ID_ACTIVIDAD_MONITOR,  ID_ASISTENTE )
            values (  ".$ID_ACTIVIDAD_MONITOR.", ".$ID_PERSONA."  ) ";
        return self::crear_ultimo_id( $query );
    }
    
    
    public static function eliminar_asistentes_actividad($ID_ACTIVIDAD_MONITOR){
        $query = "
            DELETE FROM actividades_monitor_asistentes where ID_ACTIVIDAD_MONITOR =  ".$ID_ACTIVIDAD_MONITOR."; ";
        return self::modificarRegistros( $query );
    }
}
?>