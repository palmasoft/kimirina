<?php

class insumosentregadoAnimadoresModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    insumos.ID_INSUMO,
                    insumos.NOMBRE_INSUMO,
                    recibo_contacto_animador.ID_PROMOTOR,
                    SUM(`recibo_contacto_insumo_entregado`.`CANTIDAD`) AS CANT
                    FROM
                    recibo_contacto_animador
                    LEFT JOIN recibo_contacto_insumo_entregado 
                    ON (recibo_contacto_animador.ID_CONTACTOANIMADOR = recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR)
                    LEFT JOIN personas_sistema 
                        ON (recibo_contacto_animador.ID_PROMOTOR= personas_sistema.ID_PERSONA)
                    LEFT JOIN insumos 
                    ON ( recibo_contacto_insumo_entregado.ID_INSUMO= insumos.ID_INSUMO )
                    INNER JOIN periodos
                        ON ( CONCAT(recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-',
					recibo_contacto_animador.MES_CONTACTOANIMADOR, '-',
					recibo_contacto_animador.DIA_CONTACTOANIMADOR)
                         BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )" ;
    
    public static $sqlGroupby = " GROUP BY
                                periodos.CODIGO_PERIODO,
                                periodos.FECHA_MIN_PERIODO,
                                periodos.FECHA_MAX_PERIODO,
                                insumos.ID_INSUMO,
                                insumos.NOMBRE_INSUMO,
                                recibo_contacto_animador.ID_PROMOTOR";
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
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	";
  public static $cantidadInsumos = "
      SELECT

SUM(cantidad) AS cantidad
FROM
    recibo_contacto_insumo_entregado
    INNER JOIN insumos 
        ON (recibo_contacto_insumo_entregado.ID_INSUMO = insumos.ID_INSUMO)
    
    INNER JOIN recibo_contacto_animador 
        ON (recibo_contacto_animador.ID_CONTACTOANIMADOR = recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR)
     LEFT JOIN cantones
         ON (cantones.ID_CANTON = recibo_contacto_animador.ID_CIUDAD)
    INNER JOIN periodos
			ON ( DATE( CONCAT( recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-',
			 recibo_contacto_animador.MES_CONTACTOANIMADOR,'-', 
			 recibo_contacto_animador.DIA_CONTACTOANIMADOR)) 
			 BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			 periodos.ACTUAL = 'SI'))

      ";
  
  public static $cantidadInsumosDNI = "
      SELECT

SUM(cantidad) AS cantidad
FROM
    recibo_contacto_insumo_entregado
    INNER JOIN insumos 
        ON (recibo_contacto_insumo_entregado.ID_INSUMO = insumos.ID_INSUMO)
    
    INNER JOIN recibo_contacto_animador 
        ON (recibo_contacto_animador.ID_CONTACTOANIMADOR = recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR)
     LEFT JOIN cantones
         ON (cantones.ID_CANTON = recibo_contacto_animador.ID_CIUDAD)
    INNER JOIN periodos
			ON ( DATE( CONCAT( recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-',
			 recibo_contacto_animador.MES_CONTACTOANIMADOR,'-', 
			 recibo_contacto_animador.DIA_CONTACTOANIMADOR)) 
			 BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )

      ";
  
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroAtencionSubreceptor = "  AND  atencion_salud.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND recibo_contacto_animador.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroRegistroAnimador = " LEFT JOIN recibo_contacto_animador
                                                ON (recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( CONCAT(
                                                            recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                                                            '-',
                                                            recibo_contacto_animador.MES_CONTACTOANIMADOR,
                                                            '-',
                                                            recibo_contacto_animador.DIA_CONTACTOANIMADOR
                                                          ) BETWEEN periodos.FECHA_MIN_PERIODO 
                                                                AND periodos.FECHA_MAX_PERIODO 
                                                                AND(
                                                                    periodos.ACTUAL = 'SI') )"; 
  
  
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function animadores( $monitor ="", $animador="", $provincia = "", $canton = ""){
        $filtro = " WHERE ";
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
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
        $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision.self::$filtroPersonasActivas;
        $query = self::$sqlBaseAnimadores.self::$filtroRegistroAnimador.$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    
    public static function cantidad_condones_TS( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 1 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    public static function cantidad_condones_HSH( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'HSH' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 1 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
       
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    public static function cantidad_condones_TRANS( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TRANS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 1 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    
    public static function cantidad_lubricantes_TS( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 2 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    public static function cantidad_lubricantes_HSH( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'HSH' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 2 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0;
    }
    public static function cantidad_lubricantes_TRANS( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TRANS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 2 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0;
    }
    
    public static function cantidad_folletos_TS( $animador, $periodo="", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 3 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    public static function cantidad_folletos_HSH( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'HSH' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 3 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    public static function cantidad_folletos_TRANS( $animador = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TRANS' 
            AND recibo_contacto_insumo_entregado.ID_INSUMO = 3 
            AND recibo_contacto_animador.ID_PROMOTOR =".$animador."
            AND periodos.ID_PERIODO = ".$periodo;
        
        if(Usuario::esDNI()){
            $query = self::$cantidadInsumosDNI.$filtro.self::$filtroEstadoRevision;
        }else{
            $query = self::$cantidadInsumos.$filtro.self::$filtroEstadoRevision;
        }
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0; 
    }
    
    
    public static function cantidad_tipo( $idInsumo, $tipoFormato, $animador="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';

        $filtro .= " insumos.ID_INSUMO = '".$idInsumo."' and";
        
        $filtro .= " recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = '".$tipoFormato."' and";
        
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION= 'APROBADO' and";
        
        if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " recibo_contacto_animador.ID_MONITOR = ".$monitor." and";
        }
        if( $animador != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        }
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo;
        
        
        
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
