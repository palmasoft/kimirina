<?php

class UbicacionesModel extends ModelBase {

    public static function todas_regiones() {
        $query = "SELECT ID_REGION, 
			NOMBRE_REGION, 
			OBSERVACIONES_REGION	 
		FROM regiones  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static $sqlLugares2 = "
		SELECT
                    lugares_intervencion.*,
                    tipo_lugares.*
                FROM
                    lugares_intervencion
                    LEFT JOIN tipo_lugares 
                        ON (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
        ";
    public static $sqlProvincia = "
		SELECT DISTINCT
		    regiones.ID_REGION
		    , regiones.NOMBRE_REGION
		    , provincias.ID_PROVINCIA
		    , provincias.NOMBRE_PROVINCIA
		    , provincias.OBSERVACIONES_PROVINCIA
		FROM
		    provincias
		    LEFT JOIN regiones 
		        ON (provincias.ID_REGION = regiones.ID_REGION)
	";
    public static $filtroSR = "    INNER JOIN subreceptores_provincias 
        ON (provincias.ID_PROVINCIA = subreceptores_provincias.ID_PROVINCIA) 
		AND subreceptores_provincias.ID_SUBRECEPTOR =  ";
    
    public static $filtroPS = "    LEFT JOIN personas_sistema 
        ON (personas_sistema.ID_SUBRECEPTOR = subreceptores_provincias.ID_SUBRECEPTOR) ";
    
    public static $filtroCN = "    LEFT JOIN cantones 
    ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA) ";
    
    public static $filtroRegistroPromotor = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROVINCIA = provincias.ID_PROVINCIA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
    
    public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  

    public static function todas_provincias() {

        $query = self::$sqlProvincia;
        if (Usuario::tiene_restricciones() && !UsuariosModel::esGestor() ) {
            $query = self::$sqlProvincia . self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }

        $consulta = self::consulta($query." ORDER BY provincias.NOMBRE_PROVINCIA ASC ");
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }
    
    public static function provincias_filtradas($monitor="", $promotor="", $provincia="", $canton=""){
        
        $filtro = " ".self::$filtroSR.$_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR." ".self::$filtroPS." ".self::$filtroRegistroPromotor;
        
        if( $canton != "" ){
            $filtro .= self::$filtroCN;
        }
        
        $filtro.= " WHERE";
        
//        if( $provincia != "" || $promotor != "" || $monitor != ""){
//            $filtro .= " where ";
//        }
        
        if( $canton != "" ){
            $filtro .= " cantones.ID_CANTON = ".$canton." and";
        }
        
        if( $provincia != "" ){
            $filtro .= " provincias.ID_PROVINCIA = ".$provincia." and";
        } 
               
        if( $promotor != "" ){
            $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor." and";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." and";
        }
        
        $query = self::$sqlProvincia.$filtro." subreceptores_provincias.ID_SUBRECEPTOR =  ".$_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR.self::$filtroEstadoRevision;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;  
        
    }

    public static function provincias() {

        $query = self::$sqlProvincia." ORDER BY provincias.NOMBRE_PROVINCIA ASC ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function provincia($idProvincia) {

        $query = "SELECT * FROM provincias WHERE provincias.ID_PROVINCIA= " . $idProvincia;
//        if (SubreceptoresModel::tiene_restricciones()) {
//            $query = self::$sqlProvincia . self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
//        }

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function todas_provincias_filtro($promotor = "", $monitor = "", $periodo = "", $provincia = "", $canton = "") {
        // no implementado aun

        return 0;
    }

    public static function lugares_filtrados($provincia = "", $canton = "", $tipo = "") {
        $filtro = " LEFT JOIN cantones
			ON(cantones.ID_CANTON = lugares_intervencion.ID_CANTON)    
                    LEFT JOIN provincias
			ON(cantones.ID_PROVINCIA = provincias.ID_PROVINCIA) WHERE ";

        if ($provincia != "") {
            $filtro .= " provincias.ID_PROVINCIA = " . $provincia . " and";
        }
        if ($canton != "") {
            $filtro .= " lugares_intervencion.ID_CANTON = " . $canton . " and";
        }
        if ($tipo != "") {
            $filtro .= " lugares_intervencion.ID_TIPOLUGAR = " . $tipo . " and";
        }

        $filtro .= " 1=1 ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR";
        $query = self::$sqlLugares2 . $filtro;

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function provincias_en_la_region($ID_REGION) {
        $query = self::$sqlProvincia . " WHERE  regiones.ID_REGION =  " . $ID_REGION . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static $sqlCanton = "
		SELECT
		    regiones.ID_REGION
		    , regiones.NOMBRE_REGION
		    , provincias.ID_PROVINCIA
		    , provincias.NOMBRE_PROVINCIA
		    , cantones.ID_CANTON
		    , cantones.NOMBRE_CANTON
		    , cantones.OBSERVACIONES_CANTON
		FROM
		    cantones
		    LEFT JOIN provincias
		        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
		    LEFT JOIN regiones 
		        ON (provincias.ID_REGION = regiones.ID_REGION)
	";

    public static function todos_cantones() {
        $query = self::$sqlCanton." ORDER BY cantones.NOMBRE_CANTON ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function canton($idCanton) {
        $query = self::$sqlCanton." WHERE cantones.ID_CANTON= " . $idCanton;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function cantone($idCanton) {
        $query = self::$sqlCanton." WHERE cantones.ID_CANTON= " . $idCanton;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function canton_por_nombre($idCanton) {
        $query = self::$sqlCanton." WHERE cantones.NOMBRE_CANTON = " . $idCanton;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function cantones_en_la_provincia($ID_PROVINCIA) {
        $query = self::$sqlCanton . " WHERE provincias.ID_PROVINCIA = " . $ID_PROVINCIA . " ORDER BY cantones.NOMBRE_CANTON ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static $sqlParroquias = "
		SELECT
		    regiones.ID_REGION
		    , regiones.NOMBRE_REGION
		    , provincias.ID_PROVINCIA
		    , provincias.NOMBRE_PROVINCIA
		    , cantones.ID_CANTON
		    , cantones.NOMBRE_CANTON
		    , parroquias.*
		FROM  parroquias
		    LEFT JOIN cantones 
		        ON (parroquias.ID_CANTON = cantones.ID_CANTON)
		    LEFT JOIN provincias 
		        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA )
		    LEFT JOIN regiones 
		        ON (provincias.ID_REGION = regiones.ID_REGION)
        ";

    public static function todas_parroquias() {
        $query = self::$sqlParroquias;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function parroquias_en_el_canton($ID_CANTON) {
        $query = self::$sqlParroquias . " WHERE cantones.ID_CANTON = " . $ID_CANTON . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static $sqlLugares = "
		SELECT
                    tipo_lugares.CODIGO_TIPOLUGAR
                    , tipo_lugares.NOMBRE_TIPOLUGAR
                    , tipo_lugares.OBSERVACIONES_TIPOLUGAR
                    , lugares_intervencion.*
                FROM
                    lugares_intervencion
                    LEFT JOIN tipo_lugares 
                        ON (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
        ";

    public static function todos_lugares() {
        $query = self::$sqlLugares . " ORDER BY lugares_intervencion.NOMBRE_LUGAR, LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function lugares_del_tipo($id_tipolugar) {
        $query = self::$sqlLugares . " WHERE lugares_intervencion.ID_TIPOLUGAR = '" . $id_tipolugar . "'  ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

}
