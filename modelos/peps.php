<?php

/* * 
 * PERSONAS QUE HACEN PARTE DEL PROYECTO Y UTILIZAN EL SISTEMA
 */

class AgentesModel extends ModelBase {

    public static $sqlBase = "
	SELECT DISTINCT
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
           INNER JOIN subreceptores
		ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
	";
    public static $filtroSR = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroActivo = " personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroRegistroPromotor = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
    public static $filtroRegistroPromotorDNI = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO)";

    public static function promotores() {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if (Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function promotores_filtro($provincia="", $cantones="", $monitor="", $promotor="") {
        //falta implementar
        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function promotores_filtro_parametros($monitor ="", $promotor="", $provincia = "", $canton = ""){
        
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
        $filtro .= self::$filtroActivo." and (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' )";  
        if($flag){
            if(Usuario::esDNI()){
                $filtro .= self::$filtroSR. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision;
                $query = self::$sqlBase.self::$filtroRegistroPromotorDNI.$filtro;
            }else{
                $filtro .= self::$filtroSR. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision;
                $query = self::$sqlBase.self::$filtroRegistroPromotor.$filtro;
            }
        }else{
            $filtro .= self::$filtroSR. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
            $query = self::$sqlBase.$filtro;
        }
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;        
    }

    public static function promotores_filtrados_por_id($IDprOMOTOR) {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' )  AND personas_sistema.ID_PERSONA = " . $IDprOMOTOR . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function promotores_filtrados_por_monitor($IdMonitor) {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' )  AND personas_sistema.PERTENECE_A_ID= " . $IdMonitor . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function promotores_filtrados_por_cantones($IdCanton) {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' )  AND personas_sistema.CANTON_PERSONA = " . $IdCanton . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function promotores_filtrados_por_provincias($IdProvincia) {

         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' )  AND cantones.ID_PROVINCIA = " . $IdProvincia . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function animadores() {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function animadores_filtro($provincia="", $cantones="", $monitor="", $promotor="") {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }
        
        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function animadores_filtrados_por_id($IdAnimador) {

         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'ANIMA' )  AND personas_sistema.ID_PERSONA = " . $IdAnimador . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function consejeros() {

         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

       $query .= " AND ( tipo_usuario.CODIGO_ROL = 'CONSE' OR tipo_usuario.CODIGO_ROL = 'CONANI' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function monitor() {
 
         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'MONT' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    
    public static function monitor_filtro($provincia="", $cantones="", $monitor="", $promotor="") {
        //falta implementar
        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'MONT' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function coordinador() {

         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'COORDI' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function promotores_en_monitores($idMonitor) {

        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }
        $query .=  " AND ( tipo_usuario.CODIGO_ROL = 'PROMO' AND PERTENECE_A_ID='$idMonitor')";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function animadores_en_monitores($idAnimador) {

         $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'ANIMA' AND PERTENECE_A_ID='$idAnimador')";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function monitores_en_coordinadores($idCoordinador) {
        $query = self::$sqlBase. " WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND tipo_usuario.CODIGO_ROL = 'MONT' AND PERTENECE_A_ID=" . $idCoordinador;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function consejeros_en_monitores($idMonitor) {
         $query = self::$sqlBase. "WHERE ". self::$filtroActivo ;
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $query .= " AND ( tipo_usuario.CODIGO_ROL = 'CONSE' AND PERTENECE_A_ID='$idMonitor')";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    
    
    
    public static $sqlTemas = " SELECT temas.* FROM temas ";
    public function temas_de_salud() {
        $query = self::$sqlTemas . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

}

?>