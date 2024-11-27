<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MensajesSitemaModel extends ModelBase {

    public static $sqlBase = "SELECT * FROM mensajes_sistema ";
    public static $sqlOrden = "ORDER BY mensajes_sistema.ORDEN_MENSAJESISTEMA DESC ";

    public static function todos() {
        $query = self::$sqlBase . " ". self::$sqlOrden;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

}
