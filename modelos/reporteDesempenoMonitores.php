<?php

class ReporteDesempenoMonitoresModel extends ModelBase{
    
    public static $sqlBase = "
                    SELECT * FROM actividades_monitor
                    INNER JOIN  personas_sistema
                    ON(personas_sistema.ID_PERSONA = actividades_monitor.ID_MONITOR)
                     INNER JOIN periodos 
    ON (
      actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
      AND periodos.FECHA_MAX_PERIODO
    ) 
    ";
    public static $sqlParticipacion = "
                    SELECT * FROM actividades_monitor_asistentes
                    INNER JOIN  personas_sistema
                    ON(personas_sistema.ID_PERSONA = actividades_monitor_asistentes.ID_ASISTENTE)
                    INNER JOIN  actividades_monitor
                    ON(actividades_monitor.ID_ACTIVIDADREALIZADA = actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR)
                     INNER JOIN periodos 
    ON (
      actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
      AND periodos.FECHA_MAX_PERIODO
    ) 
    ";
    public static $sqlReunion = "
                    SELECT * FROM actividades_monitor
                    INNER JOIN  personas_sistema
                    ON(personas_sistema.ID_PERSONA = actividades_monitor.ID_MONITOR)
    ";
    public static $sqlBaseMonitores = "
            SELECT
                 personas_sistema.*
            FROM
                personas_sistema
                LEFT JOIN tipo_poblacion 
                    ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
                LEFT JOIN usuarios
                    ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
                LEFT JOIN tipo_usuario 
                    ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
                LEFT JOIN cantones
                    ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
            ";
    
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";
    
   public static function todos_semana( $idMonitor, $fechaInicio, $fechaFin, $actividad){
    	$query = self::$sqlBase." where actividades_monitor.ID_MONITOR = ".$idMonitor."  AND 
            (FECHA_ACTIVIDAD_MONITOR BETWEEN '".$fechaInicio."' AND '".$fechaFin."')
                AND ID_ACTIVIDAD = ".$actividad."  "; 
        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;   
    }
    
    public static function participacion( $idMonitor, $fechaInicio, $fechaFin, $actividad){
    	$query = self::$sqlParticipacion." where actividades_monitor_asistentes.ID_ASISTENTE = ".$idMonitor."  AND 
            (FECHA_ACTIVIDAD_MONITOR BETWEEN '".$fechaInicio."' AND '".$fechaFin."')
                AND ID_ACTIVIDAD = ".$actividad."  "; 
        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;   
    }
    
    public static function supervision( $idMonitor, $fechaInicio, $fechaFin, $actividad){
    	$query = self::$sqlBase." where actividades_monitor.ID_MONITOR = ".$idMonitor."  AND 
            (FECHA_ACTIVIDAD_MONITOR BETWEEN '".$fechaInicio."' AND '".$fechaFin."')
                AND ID_ACTIVIDAD = ".$actividad."  "; 
        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;   
    }
    
    public static function reunion( $idMonitor, $fechaInicio, $fechaFin, $actividad){
    	$query = self::$sqlReunion." where actividades_monitor.ID_MONITOR = ".$idMonitor." 
                AND ID_ACTIVIDAD = ".$actividad."  "; 
        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;   
    }
    
    public static function monitores( $promotor="", $monitor ="", $provincia = "", $canton = ""){
        $filtro = " WHERE ";
        
        if( $canton != "" ){
            $filtro .= " personas_sistema.CANTON_PERSONA = ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        } 
        if( $monitor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$monitor." AND";
        }
        if( $promotor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$promotor." AND";
        }
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'MONT')";  
        $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas;
        $query = self::$sqlBaseMonitores .$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function todos_semana_con_filtros($fechaInicio, $fechaFin, $actividad, 
                                             $coordinador="", $monitor="", $periodo = "",
                                             $provincia = "", $canton =""){
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " actividades_monitor.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " actividades_monitor.ID_MONITOR = ".$monitor." and";
        }
        if( $coordinador != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$coordinador." and";
        }
        
                
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo;
        
        
        
        $query = self::$sqlBase.$filtro;

        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function datos($ID_MONITOR){
    	$query = self::$sqlBase." WHERE personas_sistema.ACTIVO='SI' AND ID_PERSONA =".$ID_MONITOR;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}