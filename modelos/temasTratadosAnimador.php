<?php

class temasTratadosAnimadorModel extends ModelBase{
    
    public static $sqlBase = "SELECT 
  COUNT(
    recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR
  ) AS CANT 
FROM
  recibo_contacto_animador 
  LEFT JOIN temas 
    ON (
      recibo_contacto_animador.ID_TEMA = temas.ID_TEMA
    ) 
  INNER JOIN periodos 
    ON (
      CONCAT(
        recibo_contacto_animador.ANO_CONTACTOANIMADOR,
        '-',
        recibo_contacto_animador.MES_CONTACTOANIMADOR,
        '-',
        recibo_contacto_animador.DIA_CONTACTOANIMADOR
      ) BETWEEN periodos.FECHA_MIN_PERIODO 
      AND periodos.FECHA_MAX_PERIODO
    )" ;
    
    public static $sqlBaseAnimadores = "
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
    public static $sqlBaseTemas = " select temas.* from temas ";
    public static $filtroSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroEstadoRevision = " AND recibo_contacto_animador.ESTADO_REVISION= 'APROBADO'";  
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }

    public static function todos_con_filtros($idTema, $tipoFormato, $animador="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';
        
        $filtro .= " temas.ID_TEMA = '".$idTema."' and";
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoFormato."' and";
        
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " registro_semanal.ID_MONITOR = ".$monitor." and";
        }
        if( $animador != "" ){
            $filtro .= " registro_semanal.ID_PROMOTOR = ".$animador." and";
        }
        
                
        $filtro .= " periodos.CODIGO_PERIODO = '".$periodo."'";

        $query = self::$sqlBase.$filtro.self::$sqlGroupby;

        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
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
    
    public static function todos_ts($idTema, $animador="", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';        
        $filtro .= " recibo_contacto_animador.ID_TEMA = '".$idTema."' and";
        $filtro .= " recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TS' and";
        
        if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
        }
        if( $animador != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        }
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo.self::$filtroEstadoRevision;
        $query = self::$sqlBase.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    public static function todos_hsh($idTema, $animador="", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " recibo_contacto_animador.ID_TEMA = '".$idTema."' and";
        
        $filtro .= " recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'HSH' and";
        
        if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
        }
        if( $animador != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        }
        
                
        $filtro .= " periodos.ID_PERIODO = ".$periodo.self::$filtroEstadoRevision;

        $query = self::$sqlBase.$filtro;

        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    public static function todos_trans($idTema, $animador="", $periodo = "", $provincia = "", $canton =""){
         $filtro = ' where ';
        
        $filtro .= " recibo_contacto_animador.ID_TEMA = '".$idTema."' and";
        
        $filtro .= " recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TRANS' and";
        
        if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
        }
        if( $animador != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
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