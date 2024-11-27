<?php

class insumosentregadoPEPModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    insumos.ID_INSUMO,
                    insumos.NOMBRE_INSUMO,
                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL ,
                    SUM( registro_semanal_insumo_entregado.CANTIDAD ) AS CANT
                    FROM
                    registro_semanal_contacto 
                    LEFT JOIN registro_semanal 
                    ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
                    LEFT JOIN registro_semanal_insumo_entregado 
                    ON ( registro_semanal_contacto.ID_REGISTRO_CONTACTO = registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO )
                    LEFT JOIN insumos 
                    ON ( registro_semanal_insumo_entregado.ID_INSUMO = insumos.ID_INSUMO )
                    INNER JOIN periodos
                    ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
                    " ;
    
    public static $sqlGroupby = " GROUP BY 
                                periodos.CODIGO_PERIODO,
                                periodos.FECHA_MIN_PERIODO,
                                periodos.FECHA_MAX_PERIODO,
                                insumos.NOMBRE_INSUMO,
                                registro_semanal.TIPO_FORMATO_REGISTROSEMANAL ";
 public static $sqlBasePromotores = "
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
	";
 
 public static $cantidadInsumos = "   
     SELECT
   SUM( registro_semanal_insumo_entregado.CANTIDAD) AS cantidad
FROM
    registro_semanal_insumo_entregado
    INNER JOIN registro_semanal_contacto 
        ON (registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO = registro_semanal_contacto.ID_REGISTRO_CONTACTO)
    INNER JOIN insumos 
        ON (registro_semanal_insumo_entregado.ID_INSUMO = insumos.ID_INSUMO)
    INNER JOIN registro_semanal 
        ON (registro_semanal.ID_REGISTROSEMANAL = registro_semanal_contacto.ID_REGISTROSEMANAL)
    INNER JOIN periodos
			ON (  registro_semanal_contacto.FECHA_CONTACTO
			 BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			 periodos.ACTUAL = 'SI')) 
";
 
  public static $cantidadInsumosDNI = "   
     SELECT
   SUM( registro_semanal_insumo_entregado.CANTIDAD) AS cantidad
FROM
    registro_semanal_insumo_entregado
    INNER JOIN registro_semanal_contacto 
        ON (registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO = registro_semanal_contacto.ID_REGISTRO_CONTACTO)
    INNER JOIN insumos 
        ON (registro_semanal_insumo_entregado.ID_INSUMO = insumos.ID_INSUMO)
    INNER JOIN registro_semanal 
        ON (registro_semanal.ID_REGISTROSEMANAL = registro_semanal_contacto.ID_REGISTROSEMANAL)
    INNER JOIN periodos
			ON (  registro_semanal_contacto.FECHA_CONTACTO
			 BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO  ) 
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
 
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function promotores( $monitor ="", $promotor="",  $provincia = "", $canton = ""){
        $filtro = " WHERE ";
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
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";  
        $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision.self::$filtroPersonasActivas;
        $query = self::$sqlBasePromotores.self::$filtroRegistroPromotor.$filtro;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    
    public static function cantidad_condones_TS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 1 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_condones_HSH( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 1 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_condones_TRANS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 1 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    
    public static function cantidad_lubricantes_TS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 2 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_lubricantes_HSH( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 2 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_lubricantes_TRANS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 2 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    
    public static function cantidad_folletos_TS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 3 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_folletos_HSH( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
         
        
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 3 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    public static function cantidad_folletos_TRANS( $promotor = "", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
         if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        $filtro .="  registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' 
            AND registro_semanal_insumo_entregado.ID_INSUMO = 3 
            AND registro_semanal.ID_PROMOTOR =".$promotor."
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
    }
    
    public static function cantidad_tipo( $idInsumo, $tipoFormato, $promotor="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';
        $filtro .= " insumos.ID_INSUMO = '".$idInsumo."' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoFormato."' and";
        
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
        }
        if( $monitor != ""){
            $filtro .= " registro_semanal.ID_MONITOR = ".$monitor." and";
        }
        if( $promotor != "" ){
            $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor." and";
        }
        
                
        $filtro .= " periodos.CODIGO_PERIODO = '".$periodo."'";
        
        
        
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
