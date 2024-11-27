<?php

class abordajesMensualConsejerosModel extends ModelBase {

    public static $sqlCantidad = "
    SELECT
    SUM(consejeria_pvvs_insumos.CANTIDAD) AS cantidad
    
    FROM
    consejeria_pvvs
    INNER JOIN consejeria_pvvs_insumos 
       ON (consejeria_pvvs.ID_CONSEJERIA_PVVS = consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS)
    INNER JOIN personas_sistema 
        ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
    INNER JOIN insumos 
     ON (consejeria_pvvs_insumos.ID_INSUMO = insumos.ID_INSUMO)
    INNER JOIN cantones 
        ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
    INNER JOIN periodos
        ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )";
    public static $sqlpersalcanzadas = "
        SELECT
            COUNT(consejeria_pvvs.ID_CONSEJERIA_PVVS) AS cantidad
        FROM
            consejeria_pvvs
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO ) ";
    public static $sqlConsejerias = "
            SELECT
             personas_sistema.*
            , consejeria_pvvs.*
            , pemar.*
            FROM
            consejeria_pvvs
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            LEFT JOIN pemar 
                       ON(( pemar.ID_POBLACION = consejeria_pvvs.ID_PEMAR ))
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
    ";
    public static $sqlConsejerosFiltrados = "
            SELECT
            consejeria_pvvs.ID_CONSEJERO
            , personas_sistema.ID_PERSONA
            , personas_sistema.NOMBRE_REAL_PERSONA
            FROM
            consejeria_pvvs
            INNER JOIN consejeria_pvvs_insumos 
               ON (consejeria_pvvs.ID_CONSEJERIA_PVVS = consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS)
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            INNER JOIN insumos 
             ON (consejeria_pvvs_insumos.ID_INSUMO = insumos.ID_INSUMO)
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
    ";
    public static $sqlBaseConsejeros = "
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
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";
    public static $filtroEstadoRevision = " AND consejeria_pvvs.ESTADO_REVISION= 'APROBADO'";
    public static $filtroPeriodo = " INNER JOIN periodos
                                                ON ( consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";

    public static function todos() {
        $query = self::$sqlBase . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function cantidad_condones($idConsejero, $periodo = "", $provincia = "", $canton = "") {

        return self::cantidad_tipo_insumo($idConsejero, '1', $periodo, $provincia, $canton);
    }

    public static function cantidad_lubricantes($idConsejero, $periodo = "", $provincia = "", $canton = "") {

        return self::cantidad_tipo_insumo($idConsejero, '2', $periodo, $provincia, $canton);
    }

    public static function cantidad_pastilleros($idConsejero, $periodo = "", $provincia = "", $canton = "") {

        return self::cantidad_tipo_insumo($idConsejero, '6', $periodo, $provincia, $canton);
    }

    public static function cantidad_tipo_insumo($idConsejero, $idInsumo, $periodo = "", $provincia = "", $canton = "", $monitor = "") {

        $filtro = ' where ';
        if ($provincia != "") {
            $filtro .= " cantones.ID_PROVINCIA = " . $provincia . " and";
        }
        if ($canton != "") {
            $filtro .= " consejeria_pvvs.ID_CANTON = " . $canton . " and";
        }
        if ($monitor != "") {
            $filtro .= " personas_sistema.PERTENECE_A_ID = " . $monitor . " and";
        }

        $filtro .= " consejeria_pvvs.ID_CONSEJERO = " . $idConsejero . " and";

        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";

        $filtro .= " insumos.ID_INSUMO = '" . $idInsumo . "' and";

        $filtro .= " periodos.ID_PERIODO = " . $periodo . " AND consejeria_pvvs.ACTIVO = 'SI' ";

        $query = self::$sqlCantidad . $filtro;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0;
    }

    public static function consejeros($idConsejero = "", $monitor = "", $provincia = "", $canton = "") {
//        $filtro = "INNER JOIN consejeria_pvvs 
//                    ON (
//                      personas_sistema.ID_PERSONA = consejeria_pvvs.ID_CONSEJERO
//                    ) " . self::$filtroPeriodo . "  WHERE ";
        
        $filtro = " WHERE ";

        if ($canton != "") {
            $filtro .= " consejeria_pvvs.ID_CANTON = " . $canton . " and";
        } else if ($provincia != "") {
            $filtro .= " cantones.ID_PROVINCIA = " . $provincia . " and";
        }
        if ($idConsejero != "") {
            $filtro .= " personas_sistema.ID_PERSONA = " . $idConsejero . " AND";
        }
        if ($monitor != "") {
            $filtro .= " personas_sistema.PERTENECE_A_ID = " . $monitor . " AND";
        }
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'CONSE' OR tipo_usuario.CODIGO_ROL = 'CONANI') ";
//        $filtro .= self::$filtroPersonasSubreceptor . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " " . self::$filtroPersonasActivas . self::$filtroEstadoRevision;
        $filtro .= self::$filtroPersonasSubreceptor . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " " . self::$filtroPersonasActivas;
        $query = self::$sqlBaseConsejeros . $filtro;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function _consejeros($idConsejero = "", $periodo = "", $provincia = "", $canton = "", $monitor = "") {

        $filtro = ' where ';
        if ($provincia != "") {
            $filtro .= " cantones.ID_PROVINCIA = " . $provincia . " and";
        }
        if ($canton != "") {
            $filtro .= " consejeria_pvvs.ID_CANTON = " . $canton . " and";
        }
        if ($monitor != "") {
            $filtro .= " personas_sistema.PERTENECE_A_ID = " . $monitor . " and";
        }

        if ($idConsejero != "") {
            $filtro .= " consejeria_pvvs.ID_CONSEJERO = " . $idConsejero . " and";
        }


        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";

        $filtro .= " periodos.CODIGO_PERIODO = " . $periodo . " ";

        $query = self::$sqlConsejerosFiltrados . $filtro . " GROUP BY consejeria_pvvs.ID_CONSEJERO";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function consejerias($idConsejero, $periodo = "", $provincia = "", $canton = "") {

       return ConsejeriaPvvsModel::consejerias_filtros_informes($idConsejero, $periodo , $provincia, $canton ) ;
    }

}


