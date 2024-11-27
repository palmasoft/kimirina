<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AyudasModel extends ModelBase {

    public static $sqlBase = "SELECT ayudas.* FROM ayudas ";
    public static function todas() {
        $query = self::$sqlBase . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_codigo( $CODIGO_AYUDA ) {
        $query = self::$sqlBase . " WHERE ayudas.CODIGO_AYUDA = '".$CODIGO_AYUDA."' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

}
