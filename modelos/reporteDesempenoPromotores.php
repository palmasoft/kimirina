<?php

class ReporteDesempenoPromotoresModel extends ModelBase{
    
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
      AND periodos.FECHA_MAX_PERIODO
    )    
    ";
    public static $sqlBasePromotores = "SELECT DISTINCT
	    usuarios.NICK
	    , tipo_usuario.ID_ROL
	    , tipo_usuario.CODIGO_ROL
	    , tipo_usuario.NOMBRE_ROL
	    , tipo_poblacion.ID_TIPOPOBLACION
	    , tipo_poblacion.CODIGO_TIPOPOBLACION
	    , tipo_poblacion.NOMBRE_TIPOPOBLACION
	    , tipo_poblacion.ALIAS_TIPOPOBLACION
	    , cantones.ID_PROVINCIA
	    , personas_sistema.*
	FROM
	    personas_sistema
            LEFT JOIN cantones
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	    LEFT JOIN subreceptores_tipo_poblacion 
                ON (personas_sistema.ID_SUBRECEPTOR = subreceptores_tipo_poblacion.ID_SUBRECEPTOR) 
            LEFT JOIN tipo_poblacion 
                ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
	    LEFT JOIN usuarios
		ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
	    LEFT JOIN tipo_usuario 
	        ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
              
	";
    
    public static $sqlBaseRegistrosSemanales = " 
                SELECT 
                    registro_semanal.*,
                    registro_semanal_contacto.*
                FROM   registro_semanal 
                     LEFT JOIN cantones 
                                 ON(( registro_semanal.ID_CANTON = cantones.ID_CANTON )) 
                     LEFT JOIN provincias 
                                ON(( registro_semanal.ID_PROVINCIA = provincias.ID_PROVINCIA )) 
                     LEFT JOIN registro_semanal_contacto 
                            ON(( registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL )) 
                     INNER JOIN personas_sistema 
                             ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                     INNER JOIN periodos
			ON ( FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			periodos.ACTUAL = 'SI')
            )      
";
    
    public static $sqlBaseRegistrosSemanalesDNI = " 
                SELECT 
                    registro_semanal.*,
                    registro_semanal_contacto.*
                FROM   registro_semanal 
                     LEFT JOIN cantones 
                                 ON(( registro_semanal.ID_CANTON = cantones.ID_CANTON )) 
                     LEFT JOIN provincias 
                                ON(( registro_semanal.ID_PROVINCIA = provincias.ID_PROVINCIA )) 
                     LEFT JOIN registro_semanal_contacto 
                            ON(( registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL )) 
                     INNER JOIN personas_sistema 
                             ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                     INNER JOIN periodos
			ON ( FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO
                            )      
";
    
    public static $sqlBaseDerivados = " 
         SELECT
             MIN(atencion_salud.FECHA_ATENCION) AS FECHA_ATENCION
            , atencion_salud.*
        FROM
            registro_semanal_contacto
            INNER JOIN atencion_salud 
                 ON (registro_semanal_contacto.ID_PEMAR = atencion_salud.ID_PEMAR)
           INNER JOIN registro_semanal 
                 ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
           
         ";
    
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroAtencionSubreceptor = "  AND  atencion_salud.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroRegistroPromotor = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
    
   public static function promotores($monitor ="", $promotor="", $provincia = "", $canton = ""){
       
       $filtro = " WHERE ";
        if( $canton != "" ){
            $filtro .= " personas_sistema.CANTON_PERSONA = ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        } 
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$promotor." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";  
        $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas."GROUP BY NOMBRE_REAL_PERSONA";
        $query = self::$sqlBasePromotores.$filtro;
//        echo $query;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;        
    }
    
    public static function todos_semana( $idPromotor, $fechaInicio, $fechaFin, $actividad){
       $query = self::$sqlBase." where personas_sistema.ID_PERSONA = ".$idPromotor."  AND 
            (FECHA_ACTIVIDAD_MONITOR BETWEEN '".$fechaInicio."' AND '".$fechaFin."')
                AND ID_ACTIVIDAD = ".$actividad."  ";        
        $consulta = self::consulta( $query );
        
        if (count($consulta) > 0) {            
            return count($consulta);
        }
        return 0;  
    }
    
    public static function registros_semanales_promotor($idPromotor, $fechaInicio, $fechaFinal){
       $filtro = ' where ';
       $filtro .= " registro_semanal.ID_PROMOTOR = ".$idPromotor." and ";
       $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
       $filtro .= " FECHA_CONTACTO BETWEEN '".$fechaInicio."' AND '".$fechaFinal."'
           ";
       
       //echo self::$sqlBaseRegistrosSemanales.$filtro ;
       $consulta = self::consulta( self::$sqlBaseRegistrosSemanales.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }  
    }
    
    public static function registros_semanales_promotor_dni($idPromotor, $fechaInicio, $fechaFinal){
       $filtro = ' where ';
       $filtro .= " registro_semanal.ID_PROMOTOR = ".$idPromotor." and ";
       $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
       $filtro .= " FECHA_CONTACTO BETWEEN '".$fechaInicio."' AND '".$fechaFinal."'
           ";
       
       //echo self::$sqlBaseRegistrosSemanales.$filtro ;
       $consulta = self::consulta( self::$sqlBaseRegistrosSemanalesDNI.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }  
    }
    public static function fecha_min_atencion($pemar, $ano_periodo){
        $filtro = ' WHERE atencion_salud.ID_PEMAR = '. $pemar.
                ' AND YEAR(atencion_salud.FECHA_ATENCION) = '.$ano_periodo.
            ' GROUP BY FECHA_ATENCION ASC';
        
        $consulta = self::consulta( self::$sqlBaseDerivados.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0];
        }
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
    
    public static function datos($ID_PROMOTOR){
    	$query = self::$sqlBase." WHERE personas_sistema.ACTIVO='SI' AND ID_PERSONA =".$ID_PROMOTOR;
        
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}