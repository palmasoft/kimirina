<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LugaresConsejeriaModel extends ModelBase {

    public static $sqlBase = " select lugares_consejeria.* from lugares_consejeria ";

    public static function todos() {
        $query = self::$sqlBase . " where lugares_consejeria.ACTIVO='SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar($codigoConsejeria, $nombreConsejeria, $obsConsejeria) {
        $query = "
                INSERT INTO lugares_consejeria(CODIGO_LUGAR_CONSEJERIA,NOMBRE_LUGAR_CONSEJERIA,OBSERVACIONES_LUGAR_CONSEJERIA)
                values ( '" . $codigoConsejeria . "', '" . $nombreConsejeria . "', '" . $obsConsejeria . "')";
        return self::crear_ultimo_id($query);
    }

    public static function datos($idconsejeria) {
        $query = self::$sqlBase . " where lugares_consejeria.ID_LUGAR_CONSEJERIA = '" . $idconsejeria . "' AND lugares_consejeria.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function update($id, $codigoTipoLugar, $nombreTipoLugar, $observacionesTipoLugar) {
        $query = " 
                update lugares_consejeria
                        set
                        CODIGO_LUGAR_CONSEJERIA = '" . $codigoTipoLugar . "', 
                        NOMBRE_LUGAR_CONSEJERIA = '" . $nombreTipoLugar . "' , 
                        OBSERVACIONES_LUGAR_CONSEJERIA = '" . $observacionesTipoLugar . "' , 
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_LUGAR_CONSEJERIA='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = " update lugares_consejeria set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_LUGAR_CONSEJERIA='" . $id . "'";
        return self::modificarRegistros($query);
    }

}
