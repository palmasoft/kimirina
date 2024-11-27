<?php

class reporteMensualIntervencionPromotorModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    tipo_lugares.NOMBRE_TIPOLUGAR,
                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                    registro_semanal_contacto.TIPO_ALCANCE_CONTACTO ,
                    COUNT( registro_semanal_contacto.ID_TIPOLUGAR ) AS CANT
                    FROM
                    registro_semanal_contacto
                    LEFT JOIN registro_semanal 
                    ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
                    LEFT JOIN tipo_lugares 
                    ON (registro_semanal_contacto.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
                    INNER JOIN periodos
                    ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
                    " ;
        
    public static $sqlBaseContactos = "
           SELECT COUNT( registro_semanal_contacto.ID_REGISTRO_CONTACTO) AS CANT
           FROM
                registro_semanal
           LEFT JOIN registro_semanal_contacto 
                ON (registro_semanal.ID_REGISTROSEMANAL = registro_semanal_contacto.ID_REGISTROSEMANAL)
           INNER JOIN periodos
                ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )";

      
    
    public static $sqlGroupby = "GROUP BY 
                                periodos.CODIGO_PERIODO,
                                periodos.FECHA_MIN_PERIODO,
                                periodos.FECHA_MAX_PERIODO,
                                tipo_lugares.NOMBRE_TIPOLUGAR,
                                registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                                registro_semanal_contacto.TIPO_ALCANCE_CONTACTO";

    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
   
    public static function cantidad_tipo_ts( $idtipolugar, $id_promotor, $periodo, $provincia = "", $canton = ""){
        
        $query = " SELECT COUNT( registro_semanal_contacto.ID_REGISTRO_CONTACTO) AS CANT
           FROM
                registro_semanal
           LEFT JOIN registro_semanal_contacto 
                ON (registro_semanal.ID_REGISTROSEMANAL = registro_semanal_contacto.ID_REGISTROSEMANAL)
           INNER JOIN periodos
                ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )";
       
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal_contacto.ID_TIPOLUGAR = ".$idtipolugar." and";
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$id_promotor. " and";
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' and";        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        $consulta = self::consulta($query.$filtro );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0; 
    }
    
    public static function cantidad_tipo_hsh( $idtipolugar, $id_promotor,$periodo, $provincia = "", $canton = ""){
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal_contacto.ID_TIPOLUGAR = ".$idtipolugar." and";
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$id_promotor. " and";
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' and";        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        $consulta = self::consulta(self::$sqlBaseContactos.$filtro );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }
    
    public static function cantidad_tipo_trans( $idtipolugar, $id_promotor, $periodo, $provincia = "", $canton = ""){
       $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal_contacto.ID_TIPOLUGAR = ".$idtipolugar." and";
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$id_promotor. " and";
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' and";        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        $consulta = self::consulta(self::$sqlBaseContactos.$filtro );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }
    public static $sqlSubFrecuencia = "SELECT DISTINCT registro_semanal_contacto.ID_REGISTROSEMANAL
           FROM
                registro_semanal_contacto
           LEFT JOIN registro_semanal
                ON (registro_semanal.ID_REGISTROSEMANAL = registro_semanal_contacto.ID_REGISTROSEMANAL)
           INNER JOIN periodos
                ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO) 
                
     ";
     public static function frecuencia( $idtipolugar, $promotor,  $periodo, $provincia = "", $canton = ""){
       
        $query = " SELECT COUNT(r.ID_REGISTROSEMANAL) AS CANT FROM (";
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal_contacto.ID_TIPOLUGAR = ".$idtipolugar." and";
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor. " and";
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        $query .= self::$sqlSubFrecuencia.$filtro.") as r";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }
    public static function promotores( $id_monitor, $id_promotor){
       return AgentesModel::promotores();
    }
    public static function tipolugares( $id_monitor, $id_promotor){
       return TiposLugaresModel::todos();
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