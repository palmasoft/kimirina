<?php

class ReporteDesempenoAnimadoresModel extends ModelBase{
    
    public static $sqlBase = "
               SELECT *
                FROM
                    personas_sistema
                    INNER JOIN actividades_monitor_asistentes 
                        ON (personas_sistema.ID_PERSONA = actividades_monitor_asistentes.ID_ASISTENTE)
                    INNER JOIN actividades_monitor 
                        ON (actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR = actividades_monitor.ID_ACTIVIDADREALIZADA)
                         INNER JOIN periodos 
                    ON (
                      actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
                      AND periodos.FECHA_MAX_PERIODO AND periodos.ACTUAL = 'SI' 
                    )    
                    ";
    public static $sqlBaseDNI = "
               SELECT *
                FROM
                    personas_sistema
                    INNER JOIN actividades_monitor_asistentes 
                        ON (personas_sistema.ID_PERSONA = actividades_monitor_asistentes.ID_ASISTENTE)
                    INNER JOIN actividades_monitor 
                        ON (actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR = actividades_monitor.ID_ACTIVIDADREALIZADA)
                         INNER JOIN periodos 
                    ON (
                      actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO
                    )    
                    ";
      public static $sqlBaseAnimadores = "
        SELECT DISTINCT
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
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) ";             
      
      
    public static $filtroSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroEstadoRevision = " AND recibo_contacto_animador.ESTADO_REVISION= 'APROBADO'";  
    
    
   public static function todos_semana( $idAnimador, $fechaInicio, $fechaFin, $actividad){
       
       /* modificar para promotores */ 
    	if(Usuario::esDNI()){
            $query = self::$sqlBaseDNI;
        }else{
            $query = self::$sqlBase;
        }
        $query .= " where personas_sistema.ID_PERSONA = ".$idAnimador."  AND 
            (FECHA_ACTIVIDAD_MONITOR BETWEEN '".$fechaInicio."' AND '".$fechaFin."')
                AND ID_ACTIVIDAD = ".$actividad."  ";        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;   
    }
    
    public static function animadores( $monitor ="", $animador="",  $provincia = "", $canton = ""){
        $filtro = "INNER JOIN recibo_contacto_animador 
                    ON (personas_sistema.ID_PERSONA = recibo_contacto_animador.ID_PROMOTOR)
                     WHERE ";
        
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD= ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $animador != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$animador." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        $filtro .= " ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";       
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        $query = self::$sqlBaseAnimadores .$filtro.self::$filtroEstadoRevision;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function animadores_desempeño( $monitor ="", $animador="",  $provincia = "", $canton = ""){
        
        if( $canton != "" ){
            $filtro .= " personas_sistema.CANTON_PERSONA= ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $animador != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$animador." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        $filtro .= " ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";       
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        $query = self::$sqlBaseAnimadores.$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    
    public static function todos_semana_con_filtros($fechaInicio, $fechaFin, $actividad, 
                                             $monitor="", $promotor="", $periodo = "",
                                             $provincia = "", $canton =""){
        /* modificar para promotores */
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " actividades_monitor.ID_CANTON = ".$canton." and";
        }
        if( $promotor != ""){
            $filtro .= " actividades_monitor_asistentes.ID_ASISTENTE = ".$promotor." and";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." and";
        }
        
                
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo;
        
        
        
        $query = self::$sqlBase.$filtro;

        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function datos($ID_ANIMADOR){
    	$query = self::$sqlBase." WHERE personas_sistema.ACTIVO='SI' AND ID_PERSONA =".$ID_ANIMADOR;
        
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}