<?php

class ConsumoInsumosModel extends ModelBase {

    public static $sqlBase = "SELECT
                    insumos.NOMBRE_INSUMO
                    , insumos.ID_INSUMO
                    , subreceptores.SIGLAS_SUBRECEPTOR
                    , periodos.CODIGO_PERIODO
                    , periodos.ID_PERIODO
                    , insumos_consumo.*
                    FROM
                    insumos_consumo
                    LEFT JOIN insumos 
                    ON (insumos_consumo.ID_INSUMO_CONSUMO = insumos.ID_INSUMO)
                    LEFT JOIN subreceptores 
                    ON (subreceptores.ID_SUBRECEPTOR = insumos_consumo.ID_SUBRECEPTOR_CONSUMO)
                    LEFT JOIN periodos 
                    ON (periodos.ID_PERIODO = insumos_consumo.ID_PERIODO_CONSUMO)";

    public static function todos() {
        $query = self::$sqlBase;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar($ID_SUBRECEPTOR_CONSUMO, $ID_PERIODO_CONSUMO, $ID_INSUMO_CONSUMO, $CANTIDAD_CONSUMO_INSUMO) {
        $query = "
            INSERT INTO insumos_consumo
            (
             ID_SUBRECEPTOR_CONSUMO,
             ID_PERIODO_CONSUMO,
             ID_INSUMO_CONSUMO,
             CANTIDAD_CONSUMO_INSUMO)
            VALUES (
                    '$ID_SUBRECEPTOR_CONSUMO',
                    '$ID_PERIODO_CONSUMO',
                    '$ID_INSUMO_CONSUMO',
                    '".$CANTIDAD_CONSUMO_INSUMO."')
            ";
        return self::crear_ultimo_id($query);
    }
    
    public static function update($ID_CONSUMO_INSUMO, $ID_SUBRECEPTOR_CONSUMO, $ID_PERIODO_CONSUMO, $ID_INSUMO_CONSUMO, $CANTIDAD_CONSUMO_INSUMO) {
        $query = "
            UPDATE insumos_consumo 
            SET
                ID_SUBRECEPTOR_CONSUMO = ".$ID_SUBRECEPTOR_CONSUMO.",
                ID_PERIODO_CONSUMO = ".$ID_PERIODO_CONSUMO.",
                ID_INSUMO_CONSUMO = ".$ID_INSUMO_CONSUMO.",
                CANTIDAD_CONSUMO_INSUMO = '".$CANTIDAD_CONSUMO_INSUMO."' 
            WHERE
                ID_CONSUMO_INSUMO = ".$ID_CONSUMO_INSUMO."";
        return self::modificarRegistros($query);
    }
    
    
    public static function datos($ID_CONSUMO_INSUMO) {
        $query = self::$sqlBase."where ID_CONSUMO_INSUMO = '$ID_CONSUMO_INSUMO' ";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
    
    public static function datos_por_parametros($ID_SUBRECEPTOR_CONSUMO, $ID_PERIODO_CONSUMO, $ID_INSUMO_CONSUMO) {
        $query = self::$sqlBase."where ID_SUBRECEPTOR_CONSUMO = '$ID_SUBRECEPTOR_CONSUMO' AND  
            ID_PERIODO_CONSUMO= '$ID_PERIODO_CONSUMO' AND ID_INSUMO_CONSUMO= '$ID_INSUMO_CONSUMO'";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
}
