<?php

class promotoresActividadModel extends ModelBase{
    
    public static $sqlBase = " SELECT periodos.CODIGO_PERIODO, 
                                periodos.FECHA_MIN_PERIODO, 
                                periodos.FECHA_MAX_PERIODO, 
                                personas_sistema.ID_PERSONA, 
                                personas_sistema.NOMBRE_REAL_PERSONA, 
                                registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA, 
                                centros_servicios_salud.NOMBRE_CENTROSERVICIO,
                                registro_semanal.ESTADO_REVISION,
                                registro_semanal.TIPO_FORMATO_REGISTROSEMANAL, 
                                COUNT( registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA) AS CANT 
                    " ;
                        
    public static $sqlGroupby = " GROUP BY 
                                 periodos.CODIGO_PERIODO, 
                                periodos.FECHA_MIN_PERIODO, 
                                periodos.FECHA_MAX_PERIODO, 
                                personas_sistema.ID_PERSONA, 
                                personas_sistema.NOMBRE_REAL_PERSONA, 
                                registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA, 
                                centros_servicios_salud.NOMBRE_CENTROSERVICIO,
                                registro_semanal.ESTADO_REVISION,
                                registro_semanal.TIPO_FORMATO_REGISTROSEMANAL
                                 ";
   public static $sqlBaseContactos = "    
           SELECT count(registro_semanal.ID_REGISTROSEMANAL) AS NUMERO
            FROM
                registro_semanal
            INNER JOIN registro_semanal_contacto
                ON ( registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL )
            INNER JOIN periodos
                ON ( registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND (periodos.ACTUAL = 'SI'))
                    ";
   
   public static $sqlBaseContactosDni = "    
           SELECT count(registro_semanal.ID_REGISTROSEMANAL) AS NUMERO
            FROM
                registro_semanal
            INNER JOIN registro_semanal_contacto
                ON ( registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL )
            INNER JOIN periodos
                ON ( registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO)
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
	    , personas_sistema.*
	FROM
	    personas_sistema
	    LEFT JOIN tipo_poblacion 
	        ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
	    LEFT JOIN usuarios
		ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
	    LEFT JOIN tipo_usuario 
	        ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
	";
    public static $sqlBaseRegistrosSemanales = " 
                SELECT 
                    registro_semanal.*,
                    registro_semanal_contacto.*,
                    centros_servicios_salud.*

                FROM   registro_semanal 
                     LEFT JOIN cantones 
                                 ON(( registro_semanal.id_canton = cantones.id_canton )) 
                     LEFT JOIN provincias 
                                ON(( registro_semanal.id_provincia = provincias.id_provincia )) 
                     LEFT JOIN registro_semanal_contacto 
                            ON(( registro_semanal_contacto.id_registrosemanal = registro_semanal.id_registrosemanal )) 
                     INNER JOIN personas_sistema 
                             ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                     INNER JOIN periodos
			ON ( FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			periodos.ACTUAL = 'SI') )   
                    LEFT JOIN centros_servicios_salud
			ON (centros_servicios_salud.ID_CENTROSERVICIO = registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA)
";
    
    public static $sqlBaseRegistrosSemanalesTrimestral = " 
                SELECT 
                    registro_semanal.*,
                    registro_semanal_contacto.*,
                    centros_servicios_salud.*

                FROM   registro_semanal 
                     LEFT JOIN cantones 
                                 ON(( registro_semanal.id_canton = cantones.id_canton )) 
                     LEFT JOIN provincias 
                                ON(( registro_semanal.id_provincia = provincias.id_provincia )) 
                     LEFT JOIN registro_semanal_contacto 
                            ON(( registro_semanal_contacto.id_registrosemanal = registro_semanal.id_registrosemanal )) 
                     INNER JOIN personas_sistema 
                             ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                     INNER JOIN periodos
			ON ( FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )   
                    LEFT JOIN centros_servicios_salud
			ON (centros_servicios_salud.ID_CENTROSERVICIO = registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA)
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
    
    public static $filtroActivo = " personas_sistema.ACTIVO = 'SI' ";  
    
    
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroAtencionSubreceptor = "  AND  atencion_salud.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroRegistroPromotor = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
    public static $filtroRegistroPromotorDNI = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )";
    
    
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function fecha_min_atencion($PEMAR, /*$CENTROSALUD,*/ $ANO_PERIODO){
        $filtro = " WHERE registro_semanal_contacto.ID_PEMAR = ". $PEMAR.
                " AND YEAR(atencion_salud.FECHA_ATENCION) = ".$ANO_PERIODO.
//        " AND registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA = ".$CENTROSALUD.
            " GROUP BY FECHA_ATENCION ASC";
        
       self::$sqlBaseDerivados.$filtro;
        $consulta = self::consulta( self::$sqlBaseDerivados.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    
    public static function promotores_filtrados( $monitor ="", $promotor="",  $provincia = "", $canton = ""){
        
        $flag = false;
        $filtro = " WHERE ";
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
            $flag = true;
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
            $flag = true;
        } 
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$promotor." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";  
        if($flag){
            if(Usuario::esDNI()){
                $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision.self::$filtroPersonasActivas;
                $query = self::$sqlBasePromotores. self::$filtroRegistroPromotorDNI .$filtro;            
            }else{
                $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision.self::$filtroPersonasActivas;
                $query = self::$sqlBasePromotores. self::$filtroRegistroPromotor .$filtro;            
            }
            
        }else{
            $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas;
            $query = self::$sqlBasePromotores.$filtro;            
        }
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function promotores() {

        $query = self::$sqlBasePromotores. " WHERE ". self::$filtroPersonasActivas ;
        if (SubreceptoresModel::tiene_restricciones()) {
            $query .= self::$filtroPersonasSubreceptor . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
//    public static function promotores_filtro($provincia="", $cantones="", $monitor="", $promotor="") {
//        //falta implementar
//        $query = self::$sqlBasePromotores. " WHERE ". self::$filtroActivo ;
//        if (SubreceptoresModel::tiene_restricciones()) {
//            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
//        }
//
//        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";
//        $consulta = self::consulta($query);
//        if (count($consulta) > 0) {
//            return $consulta;
//        }
//        return 0;
//    }

    public static function promotores_filtrados_por_id($IDprOMOTOR) {

        $query = self::$sqlBasePromotores. " WHERE ". self::$filtroPersonasActivas ;
        if (SubreceptoresModel::tiene_restricciones()) {
            $query .= self::$filtroPersonasSubreceptor . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI')  AND personas_sistema.ID_PERSONA = " . $IDprOMOTOR . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function promotores_filtrados_por_monitor($IdMonitor) {

        $query = self::$sqlBasePromotores. " WHERE ". self::$filtroPersonasActivas ;
        if (SubreceptoresModel::tiene_restricciones()) {
            $query .= self::$filtroPersonasSubreceptor . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI')  AND personas_sistema.PERTENECE_A_ID= " . $IdMonitor . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function registros_semanales_promotor($idPromotor, $periodo, $tipo){
       $filtro = ' where ';
       $filtro .= " registro_semanal.ID_PROMOTOR = ".$idPromotor." and ";
       $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipo."' and ";
       $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
       $filtro .= " periodos.ID_PERIODO = ".$periodo;
       
       self::$sqlBaseRegistrosSemanales.$filtro;

       $consulta = self::consulta( self::$sqlBaseRegistrosSemanales.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }  
    }
    
    public static function registros_semanales_promotor_trimestral($idPromotor, $periodo, $tipo){
       $filtro = ' where ';
       $filtro .= " registro_semanal.ID_PROMOTOR = ".$idPromotor." and ";
       $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipo."' and ";
       $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
       $filtro .= " periodos.ID_PERIODO = ".$periodo->ID_PERIODO." and periodos.TRIM_PERIODO = ".$periodo->TRIM_PERIODO;
       
//       echo self::$sqlBaseRegistrosSemanales.$filtro;

       $consulta = self::consulta( self::$sqlBaseRegistrosSemanalesTrimestral.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }  
    }
    
    public static function cantidad_contactados_ts($promotor, $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;

        $consulta = self::consulta( self::$sqlBaseContactos.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    
    public static function cantidad_contactados_ts_dni($promotor, $periodo, $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TS' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;
        $consulta = self::consulta( self::$sqlBaseContactosDni.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    public static function cantidad_contactados_hsh($promotor, $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;

        $consulta = self::consulta( self::$sqlBaseContactos.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    
    public static function cantidad_contactados_hsh_dni($promotor, $periodo, $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'HSH' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;
        
        $consulta = self::consulta( self::$sqlBaseContactosDni.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    public static function cantidad_contactados_trans($promotor="", $periodo = "", $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
         $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;
        
        $consulta = self::consulta( self::$sqlBaseContactos.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    public static function cantidad_contactados_trans_dni($promotor, $periodo, $provincia = "", $canton =""){
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' and";
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor;
        $filtro .= " and periodos.ID_PERIODO = ".$periodo->ID_PERIODO;
        $consulta = self::consulta( self::$sqlBaseContactosDni.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0]->NUMERO;
        }
    }
    public static function cantidad_efectivos_ts($promotor="", $periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_efectivos_hsh($promotor="", $periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    public static function cantidad_efectivos_trans($promotor="", $periodo = "", $provincia = "", $canton =""){
        return 0;
    }
    
    
    public static function cantidad_tipo($tipoFormato, $promotor="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';
        
        $filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";
        
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
        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$promotor." and";
        }
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo;
        
    	$query = self::$sqlBase.$filtro.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    
    public static function datosCMR($promotor){
    	$query = self::$sqlBase." WHERE personas_sistema.ID_PERSONA = ".$promotor." ";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->TIPO_FORMATO_REGISTROSEMANAL;
        }
        return 0;   
    }
    
    public static function datosCS(){
    	$query = self::$sqlBase."";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->NOMBRE_CENTROSERVICIO;
        }
        return 0;   
    }
}
