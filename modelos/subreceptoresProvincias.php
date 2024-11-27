<?php

class SubreceptoresProvinciasModel extends ModelBase {

    static $sqlbase = 'SELECT
                    provincias.*
                    , subreceptores.NOMBRE_SUBRECEPTOR
                    , subreceptores.SIGLAS_SUBRECEPTOR
                    ,subreceptores_provincias.*
                    FROM
                    subreceptores_provincias
                    INNER JOIN subreceptores 
                        ON (subreceptores_provincias.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
                    INNER JOIN provincias 
                        ON (subreceptores_provincias.ID_PROVINCIA = provincias.ID_PROVINCIA) ';

    public static function todos() {
        $query = self::$sqlbase . " ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function todos_con_provincia() {
        $query = self::$sqlbase;

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function provincias_subreceptor($idSubrecptor) {
        $query = self::$sqlbase. " WHERE subreceptores_provincias.ID_SUBRECEPTOR = " . $idSubrecptor . "; ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function eliminar_provincias_subreceptor($idSubrecptor) {
        $query =  "DELETE  FROM subreceptores_provincias  WHERE subreceptores_provincias.ID_SUBRECEPTOR = " . $idSubrecptor . " ; ";        
        return self::modificarRegistros($query);
    }

   
    public static function datos_subreceptorProvincia($idProvinciaSubrecptor) {
        $query =self::$sqlbase. " WHERE ID_PROVINCIA_SUBRECEPTOR = " . $idProvinciaSubrecptor . "; ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
    
    public static function subreceptorProvincia($idSubreceptor, $idProvincia) {
        $query = "
            INSERT INTO subreceptores_provincias
            (
             ID_SUBRECEPTOR,
             ID_PROVINCIA)
            VALUES (
                    $idSubreceptor,
                    $idProvincia);
                    ";

        return self::crear_ultimo_id($query);
    }

    public static function updateProvincia($idsubpro, $idSubreceptor, $idProvincia) {
        $query = "
            UPDATE subreceptores_provincias
            SET 
              ID_SUBRECEPTOR = $idSubreceptor,
              ID_PROVINCIA = $idProvincia
            WHERE ID_PROVINCIA_SUBRECEPTOR = $idsubpro";

        return self::crear_ultimo_id($query);
    }

    public static function eliminar($id) {
        $query = "DELETE FROM subreceptores_provincias "
                . "WHERE ID_PROVINCIA_SUBRECEPTOR = " . $id . " ";
        return self::modificarRegistros($query);
    }

}
