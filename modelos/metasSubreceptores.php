<?php

class MetasSubreceptoresModel extends ModelBase {

    static $sqlbase = "
        SELECT
            subreceptores.*,
            subreceptores_metas.*,
            indicadores.*,
            periodos_indicadores.*
    FROM
        subreceptores_metas
        INNER JOIN subreceptores 
            ON (subreceptores_metas.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
        INNER JOIN indicadores 
            ON (subreceptores_metas.ID_INDICADOR = indicadores.ID_INDICADOR)
        INNER JOIN periodos_indicadores 
        ON (subreceptores_metas.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR) ";

    public static function todos() {
        $query = self::$sqlbase . "WHERE ACTIVO='SI'";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function todos_subreceptor($ID_SUBRECEPTOR) {
        $query = self::$sqlbase . "WHERE subreceptores_metas.ID_SUBRECEPTOR = " . $ID_SUBRECEPTOR . " ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public function datos_meta_subreceptor($id_meta_subreceptor) {
        $query = self::$sqlbase . " WHERE subreceptores_metas.ID_SUBRECEPTOR_META = " . $id_meta_subreceptor . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function valor_meta($subreceptor, $periodo, $indicador) {
        $query = "
            SELECT * FROM subreceptores_metas 
            WHERE ID_SUBRECEPTOR = " . $subreceptor . " AND
                ID_PERIODO_INDICADOR = " . $periodo . " AND
                ID_INDICADOR = " . $indicador . " ";

        $consulta = self::consulta($query);        
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function insertar($subreceptor, $periodo, $indicador, $meta) {
        $query = "
                insert into subreceptores_metas (
                     ID_SUBRECEPTOR,
                     ID_PERIODO_INDICADOR,
                     ID_INDICADOR,
                     META_SUBRECEPTOR )
                     values (" . $subreceptor . "," . $periodo . "," . $indicador . "," . $meta . ")";

        return self::crear_ultimo_id($query);
    }

    public static function actualizar_meta($subreceptor, $periodo, $indicador, $meta) {
        $query = "
            UPDATE subreceptores_metas SET                
                META_SUBRECEPTOR = " . $meta . ",
                FECHA_MODIFICACION = CURRENT_TIMESTAMP
            WHERE ID_SUBRECEPTOR = " . $subreceptor . " AND
                ID_PERIODO_INDICADOR = " . $periodo . " AND
                ID_INDICADOR = " . $indicador . " ";


        return self::modificarRegistros($query);
    }

    public static function update($id, $subreceptor, $periodo, $indicador, $meta) {
        $query = "
                UPDATE subreceptores_metas
                 SET
                ID_SUBRECEPTOR = " . $subreceptor . ",
                ID_PERIODO_INDICADOR = " . $periodo . ",
                ID_INDICADOR = " . $indicador . ",
                META_SUBRECEPTOR = " . $meta . ",
                FECHA_MODIFICACION = CURRENT_TIMESTAMP
                WHERE subreceptores_metas.ID_SUBRECEPTOR_META = $id";

        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = "
                DELETE FROM subreceptores_metas
                WHERE subreceptores_metas.ID_SUBRECEPTOR_META = $id";

        return self::modificarRegistros($query);
    }

}
