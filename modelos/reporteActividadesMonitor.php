<?php

class reporteActividadesMonitorModel extends ModelBase{
    
    public static $sqlBase = "
      SELECT 
  periodos.CODIGO_PERIODO,
  periodos.FECHA_MIN_PERIODO,
  periodos.FECHA_MAX_PERIODO,
  actividades_tecnicas.ID_ACTIVIDAD,
  actividades_tecnicas.NOMBRE_ACTIVIDAD,
  actividades_monitor.ID_CANTON,
  cantones.ID_PROVINCIA,
  personas_sistema.ID_PERSONA,
  personas_sistema.NOMBRE_REAL_PERSONA,
  COUNT(
    actividades_monitor.ID_ACTIVIDADREALIZADA
  ) AS CANTIDAD 
FROM
  actividades_monitor 
  LEFT JOIN actividades_tecnicas 
    ON (
      actividades_tecnicas.ID_ACTIVIDAD = actividades_monitor.ID_ACTIVIDAD
    ) 
  LEFT JOIN personas_sistema 
    ON (
      personas_sistema.ID_PERSONA = actividades_monitor.ID_MONITOR
    ) 
  LEFT JOIN cantones 
    ON (
      cantones.ID_CANTON = actividades_monitor.ID_CANTON
    ) 
  INNER JOIN periodos 
    ON (
      actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
      AND periodos.FECHA_MAX_PERIODO
    ) 
  ";
                        
    public static $sqlGroupby = " 
                               GROUP BY 
                                periodos.CODIGO_PERIODO,
                                periodos.FECHA_MIN_PERIODO,
                                periodos.FECHA_MAX_PERIODO,
                                actividades_tecnicas.NOMBRE_ACTIVIDAD ";

    public static $sqlBaseMonitores = "
	SELECT personas_sistema.*
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
    public static $sqlBaseActividades = "
            select
                actividades_tecnicas.*
            from actividades_tecnicas 
        ";
    public static $sqlBaseNroActividades = "
        SELECT 
         count(actividades_monitor.ID_ACTIVIDADREALIZADA) AS NUMERO
        FROM
            actividades_monitor
            INNER JOIN actividades_tecnicas 
                ON (actividades_monitor.ID_ACTIVIDAD = actividades_tecnicas.ID_ACTIVIDAD)
            INNER JOIN personas_sistema 
                ON (actividades_monitor.ID_MONITOR = personas_sistema.ID_PERSONA)
            INNER JOIN periodos 
            ON (
              actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
              AND periodos.FECHA_MAX_PERIODO AND periodos.ACTUAL = 'SI'
            ) 
            LEFT JOIN cantones
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	
            ";
    
    public static $sqlBaseNroActividadesPeriodoInactivo = "
        SELECT 
         count(actividades_monitor.ID_ACTIVIDADREALIZADA) AS NUMERO
        FROM
            actividades_monitor
            INNER JOIN actividades_tecnicas 
                ON (actividades_monitor.ID_ACTIVIDAD = actividades_tecnicas.ID_ACTIVIDAD)
            INNER JOIN personas_sistema 
                ON (actividades_monitor.ID_MONITOR = personas_sistema.ID_PERSONA)
            INNER JOIN periodos 
            ON (
              actividades_monitor.FECHA_ACTIVIDAD_MONITOR BETWEEN periodos.FECHA_MIN_PERIODO 
            ) 
            LEFT JOIN cantones
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	
            ";
    
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";
    
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    
    public static function monitores( $coordinador="", $monitor ="", $provincia = "", $canton = ""){
        $filtro = " WHERE ";
        if( $canton != "" ){
            $filtro .= " personas_sistema.CANTON_PERSONA = ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }        
        if( $monitor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$monitor." AND";
        }
        if( $coordinador != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$coordinador." AND";
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
    public static function actividades(){
        $filtro = " WHERE actividades_tecnicas.ACTIVO='SI'";
        $query = self::$sqlBaseActividades .$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0; 
    }
    public static function cantidad_actividades($monitor="", $tipoActividad="", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        
        if( $canton != "" ){
            $filtro .= " actividades_monitor.ID_CANTON = ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        
        if( $monitor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$monitor." and";
        }
        if( $tipoActividad != "" ){
            $filtro .= " actividades_monitor.ID_ACTIVIDAD = ".$tipoActividad." and";
        }
        $filtro .= " periodos.ID_PERIODO = '".$periodo."'";
        if(Usuario::esDNI()){
         $query = self::$sqlBaseNroActividadesPeriodoInactivo.$filtro;   
        }else{
         $query = self::$sqlBaseNroActividades.$filtro;   
        }
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
        return 0; 
    }

    public static function todos_con_filtros($coordinador="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
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
        
        
        
        $query = self::$sqlBase.$filtro.self::$sqlGroupby;

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