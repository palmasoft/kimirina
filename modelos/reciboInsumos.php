<?php

class ReciboInsumosModel extends ModelBase {

    public static $sqlBase = "SELECT
                    insumos.NOMBRE_INSUMO
                    , insumos.ID_INSUMO
                    , personas_sistema.ID_PERSONA
                    , personas_sistema.NOMBRE_REAL_PERSONA
                    , insumos_recibos.*
                    FROM
                    insumos_recibos
                    LEFT JOIN insumos 
                    ON (insumos_recibos.ID_INSUMO = insumos.ID_INSUMO)
                    LEFT JOIN personas_sistema 
                    ON (insumos_recibos.ID_RECIBE = personas_sistema.ID_PERSONA) ";

    public static function todos() {
        $query = self::$sqlBase." where insumos_recibos.ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar($ID_INSUMO, $ID_RECIBE, $FECHA_RECIBOINSUMO, $CANTIDAD_RECIBOINSUMO, $LOTE_REFERENCIA_RECIBOINSUMO) {
        $query = "
            INSERT INTO insumos_recibos
            (
             ID_INSUMO,
             ID_RECIBE,
             FECHA_RECIBOINSUMO,
             CANTIDAD_RECIBOINSUMO,
             LOTE_REFERENCIA_RECIBOINSUMO)
            VALUES (
                    '$ID_INSUMO',
                    '$ID_RECIBE',
                    '$FECHA_RECIBOINSUMO',
                    '$CANTIDAD_RECIBOINSUMO',
                    '$LOTE_REFERENCIA_RECIBOINSUMO')
            ";
        return self::crear_ultimo_id($query);
    }
    
    public static function update($ID_RECIBOINSUMO, $ID_INSUMO, $ID_RECIBE, $FECHA_RECIBOINSUMO, $CANTIDAD_RECIBOINSUMO, $LOTE_REFERENCIA_RECIBOINSUMO) {
        $query = "
            UPDATE insumos_recibos SET
             ID_INSUMO = $ID_INSUMO,
             ID_RECIBE = $ID_RECIBE,
             FECHA_RECIBOINSUMO = '$FECHA_RECIBOINSUMO',
             CANTIDAD_RECIBOINSUMO = $CANTIDAD_RECIBOINSUMO,
             LOTE_REFERENCIA_RECIBOINSUMO = '$LOTE_REFERENCIA_RECIBOINSUMO',
             FECHA_MODIFICACION = CURRENT_TIMESTAMP
             WHERE ID_RECIBOINSUMO = $ID_RECIBOINSUMO
            ";
        return self::modificarRegistros($query);
    }
    
    
    public static function datos($ID_RECIBOINSUMO) {
        $query = self::$sqlBase."where insumos_recibos.ACTIVO = 'SI' and ID_RECIBOINSUMO = '$ID_RECIBOINSUMO' ";
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
    public static function eliminar($id) {
        $query = "
            UPDATE insumos_recibos SET
            ACTIVO = 'NO', FECHA_ELIMINACION = CURRENT_TIMESTAMP 
            WHERE ID_RECIBOINSUMO = " . $id . "  ";
        return self::modificarRegistros($query);
    }
    
}
