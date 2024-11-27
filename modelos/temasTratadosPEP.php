<?php

class temasTratadosPEPModel extends ModelBase{
    
    public static $sqlBase = "SELECT 
                    COUNT( registro_semanal_contacto.ID_TEMA_CONTACTO ) AS CANT
                    FROM
                    registro_semanal_contacto
                    LEFT JOIN registro_semanal 
                    ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
                    LEFT JOIN temas 
                    ON (registro_semanal_contacto.ID_TEMA_CONTACTO = temas.ID_TEMA)
                    INNER JOIN periodos
                    ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
                    " ;
    public static $sqlBaseTemas = " select temas.* from temas ";                    
    public static $sqlGroupby = "
                                GROUP BY 
                                periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    temas.TITULO_TEMA,
                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL ";
public static $sqlBasePromotores = "
	SELECT DISTINCT personas_sistema.*
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

public static $filtroSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  

    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
     public static function promotores( $monitor ="", $promotor="",  $provincia = "", $canton = ""){
         $filtro = "LEFT JOIN registro_semanal 
                    ON (personas_sistema.ID_PERSONA = registro_semanal.ID_PROMOTOR)
                     WHERE ";
        
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$promotor." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        $filtro .= " ( tipo_usuario.CODIGO_ROL = 'PROMO'  OR tipo_usuario.CODIGO_ROL = 'PROANI')";       
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        $query = self::$sqlBasePromotores .$filtro.self::$filtroEstadoRevision;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;      
    }
    
     public static function temas(){
      $query = self::$sqlBaseTemas." where temas.ACTIVO='SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0;  
    }
        
    public static function temas_tratados_tipo($idTema, $tipoFormato, $promotor="", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';        
        $filtro .= " registro_semanal_contacto.ID_TEMA_CONTACTO = ".$idTema." and";
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoFormato."' and";
        
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }       
        if( $promotor != "" ){
            $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor." and";
        }        
        $filtro .= " periodos.ID_PERIODO = ".$periodo.self::$filtroEstadoRevision;
        $query = self::$sqlBase.$filtro;
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