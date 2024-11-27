<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of centrosSalud
 *
 * @author Software
 */
class CentrosSaludModel extends ModelBase {

    public static $sqlBase = "                
        SELECT
            subreceptores.CODIGO_SUBRECEPTOR
            , subreceptores.NOMBRE_SUBRECEPTOR
            , subreceptores.SIGLAS_SUBRECEPTOR
            , provincias.CODIGO_PROVINCIA
            , provincias.NOMBRE_PROVINCIA
            , cantones.CODIGO_CANTON
            , cantones.NOMBRE_CANTON
            , tipo_centro_salud.CODIGO_TIPO_CENTROSERVICIO
            , tipo_centro_salud.NOMBRE_TIPO_CENTROSERVICIO
            , centros_servicios_salud.*
        FROM
            centros_servicios_salud
            LEFT JOIN cantones 
                ON (centros_servicios_salud.ID_CANTON = cantones.ID_CANTON)
            LEFT JOIN tipo_centro_salud 
                ON (centros_servicios_salud.ID_TIPO_CENTROSERVICIO = tipo_centro_salud.ID_TIPO_CENTROSERVICIO)
            LEFT JOIN subreceptores 
                ON (centros_servicios_salud.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
            LEFT JOIN provincias 
                ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)

	";

    public static function todos() {
        $query = self::$sqlBase . " WHERE centros_servicios_salud.ACTIVO = 'SI'  GROUP BY centros_servicios_salud.ID_CENTROSERVICIO ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function por_subreceptor($idSubreceptor) {
        $query = self::$sqlBase . " WHERE centros_servicios_salud.ID_SUBRECEPTOR = ".$idSubreceptor." AND centros_servicios_salud.ACTIVO = 'SI'  GROUP BY centros_servicios_salud.ID_CENTROSERVICIO ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function en_el_canton($idCanton) {
        $query = self::$sqlBase . " WHERE centros_servicios_salud.ACTIVO = 'SI' AND cantones.ID_CANTON = " . $idCanton . "  GROUP BY centros_servicios_salud.ID_CENTROSERVICIO ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function en_la_provincia($idProvincia) {
        $query = self::$sqlBase . " WHERE  centros_servicios_salud.ACTIVO = 'SI' AND provincias.ID_PROVINCIA = " . $idProvincia . "  GROUP BY centros_servicios_salud.ID_CENTROSERVICIO ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function filtrados_por($idProvincia, $idCanton, $tipoPoblacion) {
        $query = self::$sqlBase . " 
    LEFT JOIN subreceptores_tipo_poblacion 
        ON (subreceptores_tipo_poblacion.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
    LEFT JOIN tipo_poblacion 
        ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
    WHERE centros_servicios_salud.ACTIVO = 'SI' ";
        
        if ( !empty($tipoPoblacion) ) {
            $query .= "AND tipo_poblacion.CODIGO_TIPOPOBLACION = '" . $tipoPoblacion . "'   ";
        }

        if ($idProvincia > 0) {
            $query .= "AND provincias.ID_PROVINCIA = " . $idProvincia . "  ";
        }

        if ($idCanton > 0) {
            $query .= "AND cantones.ID_CANTON = " . $idCanton . "  ";
        }

        $query .= 'ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ';
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static $sqlServicios = "
        SELECT
            servicios_salud.*,
            count( servicios_centro_salud.ID_CENTROSERVICIO ) AS CENTROS_SALUD 
        FROM
            servicios_salud
            LEFT JOIN  servicios_centro_salud
                ON (servicios_salud.ID_SERVICIO = servicios_centro_salud.ID_SERVICIO )";

    public static function todos_servicios() {
        $query = self::$sqlServicios . " GROUP BY servicios_salud.ID_SERVICIO  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static $sqlTiposCentros = "select * from tipo_centro_salud ";

    public static function todos_tipos_centros_salud() {
        $query = self::$sqlTiposCentros . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar($codigoTipoCentroDeSalud, $nombreTipoCentroDeSalud, $observacionesTipoCentroDeSalud) {
        $query = "            
            insert into tipo_centro_salud (CODIGO_TIPO_CENTROSERVICIO, NOMBRE_TIPO_CENTROSERVICIO, OBSERVACIONES_TIPO_CENTROSERVICIO) 
            values ('" . $codigoTipoCentroDeSalud . "', '" . $nombreTipoCentroDeSalud . "', '" . $observacionesTipoCentroDeSalud . "')";
        return self::crear_ultimo_id($query);
    }

}
