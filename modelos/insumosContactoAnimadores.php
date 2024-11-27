<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class InsumosContactoAnimadorModel extends ModelBase {

    public static $sqlBase = "SELECT *
          FROM recibo_contacto_insumo_entregado
        ";

    public static function todos() {
        $query = self::$sqlBase . "";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }


    public static function datos($idRecibo) {
        $query = self::$sqlBase . " where recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR = '" . $idRecibo . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function insertar($ID_CONTACTOANIMADOR, $ID_INSUMO, $CANTIDAD) {
        $query = "  IINSERT INTO recibo_contacto_insumo_entregado
            (ID_CONTACTOANIMADOR,
             ID_INSUMO,
             CANTIDAD)
                VALUES ('$ID_CONTACTOANIMADOR',
                        '$ID_INSUMO',
                        '$CANTIDAD'))";
        return self::crear_ultimo_id($query);
    }

    public static function update() {
        $query = "";
        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = "";
        return self::modificarRegistros($query);
    }

}

?>