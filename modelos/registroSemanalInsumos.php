<?php

class RegistroSemanalInsumosModel extends ModelBase {

    public static $sqlBase = " SELECT * FROM registro_semanal_insumo_entregado ";
    public static $sqlGroup = "";

    public static function todos() {
        $query = self::$sqlBase . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function insertar($ID_REGISTRO_CONTACTO, $ID_INSUMO, $ID_CANTIDAD ) {        
        $query = "insert into registro_semanal_insumo_entregado 
            ( ID_REGISTRO_CONTACTO, ID_INSUMO, CANTIDAD )
            values( '".$ID_REGISTRO_CONTACTO."', '".$ID_INSUMO."', '".$ID_CANTIDAD."' "
        . ")";
        return self::crear_ultimo_id($query);
    }
    
    public static function eliminar_insumos_contacto($ID_REGISTRO_CONTACTO) {        
        $query = "delete from registro_semanal_insumo_entregado "
                . "where ID_REGISTRO_CONTACTO = ".$ID_REGISTRO_CONTACTO." ; ";
        return self::modificarRegistros($query);
    }

}

?>