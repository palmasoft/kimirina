<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PeriodosIndicadoresModel extends ModelBase {

    public static $sqlBase = " select  * from periodos_indicadores ";

    public static function todos() {
        $query = self::$sqlBase . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    static $sqlMetasindicadores = "SELECT
                indicadores.*
                , periodos.*
                , indicadores_metas.*
                , indicadores_metas.VALOR_META_INDICADOR as META_SEMESTRE
            FROM
                indicadores_metas
                INNER JOIN indicadores 
                    ON (indicadores_metas.ID_INDICADOR = indicadores.ID_INDICADOR)
                INNER JOIN periodos 
                    ON (indicadores_metas.ID_PERIODO_INDICADOR = periodos.ID_PERIODO)";
    
     public static function metas($ID_INDICADOR) {
        $query = self::$sqlMetasindicadores . " WHERE indicadores.ID_INDICADOR = ".$ID_INDICADOR." ;";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

}
