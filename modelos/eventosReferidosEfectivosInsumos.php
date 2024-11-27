<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventosReferidosEfectivosInsumos
 *
 * @author Software
 */
class EventosReferidosEfectivosInsumos extends ModelBase {

    //put your code here
    public static $sqlBase = "SELECT
            eventos_masivos_insumos.*
            , insumos.*
            , eventos_masivos.*
        FROM
            eventos_masivos_insumos
            INNER JOIN insumos 
                ON (eventos_masivos_insumos.ID_INSUMO = insumos.ID_INSUMO)
            INNER JOIN eventos_masivos 
                ON (eventos_masivos_insumos.ID_EVENTO_MASIVO = eventos_masivos.ID_EVENTO_MASIVO) ";

    public static function todos() {
        $query = self::$sqlBase . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar( $ID_EVENTO_MASIVO, $ID_INSUMO, $CANTIDAD_INSUMO) {
        $query = "INSERT INTO eventos_masivos_insumos (
                    ID_EVENTO_MASIVO,
                    ID_INSUMO,
                    CANTIDAD_INSUMO
                    ) VALUES (
                      '" .$ID_EVENTO_MASIVO. "',
                      '" .$ID_INSUMO. "',
                      '" .$CANTIDAD_INSUMO. "'
                    ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function eliminar_insumos_contacto($ID_EVENTO_MASIVO) {
        $query = "DELETE FROM eventos_masivos_insumos  WHERE eventos_masivos_insumos.ID_EVENTO_MASIVO = " . $ID_EVENTO_MASIVO . " ; ";
        return self::modificarRegistros($query);
    }

}
