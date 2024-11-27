<?php

class paresUbicadosMesModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    registro_semanal.ID_PROMOTOR,
                    registro_semanal_contacto.TRABAJO_SEXUAL_CONTACTO,
                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                    registro_semanal_contacto.TIPO_ALCANCE_CONTACTO ,
                    COUNT( registro_semanal_contacto.TIPO_ALCANCE_CONTACTO) AS CANT
                    FROM
                    registro_semanal_contacto
                    LEFT JOIN registro_semanal 
                    ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
                    INNER JOIN periodos
                    ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
                    " ;
                        
    public static $sqlGroupby = "GROUP BY
                                    periodos.CODIGO_PERIODO,
                                    periodos.FECHA_MIN_PERIODO,
                                    periodos.FECHA_MAX_PERIODO,
                                    registro_semanal_contacto.TRABAJO_SEXUAL_CONTACTO,
                                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                                    registro_semanal_contacto.TIPO_ALCANCE_CONTACTO
                                    ";
public static $sqlBasePromotores = "SELECT
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
	    LEFT JOIN tipo_poblacion 
	        ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
	    LEFT JOIN usuarios
		ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
	    LEFT JOIN tipo_usuario 
	        ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
	    LEFT JOIN cantones
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	";
    
    
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
     public static function promotores($idMonitor, $idPromotor, $provincia = "", $canton = ""){
       $filtro = " WHERE ";
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " personas_sistema.CANTON_PERSONA = ".$canton." and";
        }  
        if( $idPromotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$idPromotor." AND";
        }
        if( $idMonitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$idMonitor." AND";
        }
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI')";       
        $query = self::$sqlBasePromotores .$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;        
    }
    public static function primer_abordaje($idPemar, $idPeriodo){
       $query = "SELECT 

	ANO_PERIODO, ID_TIPOPOBLACION,	CODIGO_TIPOPOBLACION,
	ID_POBLACION,	CODIGO_UNICO_PERSONA,	ID_PERIODO_INDICADOR,
	CODIGO_PERIODO_INDICADOR,	ID_PERIODO, 	CODIGO_PERIODO, 
	TIPO_AGENTE,	ID_SUBRECEPTOR,	ID_PERSONA,
	REGISTRO_ABORDAJE,	FECHA_PRIMER_ABORDAJE
        
    FROM(
	(SELECT * FROM primer_abordaje_promotor)  
 
       ) AS FPP
    WHERE ID_POBLACION = ".$idPemar." AND FECHA_PRIMER_ABORDAJE = ( 
	SELECT MIN(FECHA_PRIMER_ABORDAJE) 
	FROM(
		(SELECT * FROM primer_abordaje_promotor)  		 
	) AS FPP
	WHERE ID_POBLACION = ".$idPemar." AND ANO_PERIODO = (SELECT ANO_PERIODO FROM PERIODOS WHERE ID_PERIODO = ".$idPeriodo." )
        )ORDER BY
            ID_TIPOPOBLACION, 
            ID_POBLACION,
            ANO_PERIODO,
            FECHA_PRIMER_ABORDAJE";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    public static function registros_semanales($promotor, $periodo = "", $provincia = "", $canton = ""){      
       
       return consolidadoMensualDerivadosModel::registros_semanales($promotor, $periodo, $provincia, $canton);
    }
    
    public static function registros_semanales_promotores($promotor, $periodo = "", $provincia = "", $canton = ""){      
       
       return RegistroSemanalContactosModel::registros_semanales_promotores($promotor, $periodo, $provincia, $canton);
    }
    
    public static function cantidad_TS_NUEVO($promotor="",$periodo = "", $provincia = "", $canton =""){
        
        return 0;
    }
    public static function cantidad_TS_RECURRENTE($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_NUEVO($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_RECURRENTE($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TRANS_NUEVO($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TRANS_RECURRENTE($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TS_TS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TS_NOTS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_TS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_HSH_NOTS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TRANS_TS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TRANS_NOTS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    
    
    
    
    public static function cantidad_TS_NUEVO_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TS_RECURRENTE_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_NUEVO_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_RECURRENTE_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TRANS_NUEVO_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TRANS_RECURRENTE_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_TS_TS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TS_NOTS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_HSH_TS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_HSH_NOTS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TRANS_TS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    public static function cantidad_TRANS_NOTS_REFERIDOS($promotor="",$periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    
    
    public static function cantidad_tipo($tipoFormato, $tipoAlcance, $promotor="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';

        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoFormato."' and";
        
        $filtro .= " registro_semanal_contacto.TIPO_ALCANCE_CONTACTO = '".$tipoAlcance."' and";
        
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " actividades_monitor.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " actividades_monitor.ID_MONITOR = ".$monitor." and";
        }
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PROMOTOR = ".$promotor." and";
        }
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo." ";
        
    	$query = self::$sqlBase.$filtro.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    
     public static function cantidad_tipo_ts($tipoFormato, $tipoAlcance, $ts = "", $promotor="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';

        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoFormato."' and";
        
        $filtro .= " registro_semanal_contacto.TIPO_ALCANCE_CONTACTO = '".$tipoAlcance."' and";
        
        if( $ts != "" ){        
        $filtro .= " registro_semanal_contacto.TRABAJO_SEXUAL_CONTACTO = '".$ts."' and";
        }
        
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " actividades_monitor.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " actividades_monitor.ID_MONITOR = ".$monitor." and";
        }
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PROMOTOR = ".$promotor." and";
        }
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo." ";
        
        
        
    	$query = self::$sqlBase.$filtro.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    
    public static function datos($ID_ROL){
    	$query = self::$sqlBase." WHERE ACTIVO='Si' AND ID_ROL='$ID_ROL' ";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}

?>