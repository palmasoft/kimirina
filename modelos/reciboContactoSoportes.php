<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReciboContactoSoportes
 *
 * @author Software
 */
class ReciboContactoSoportes extends ModelBase {
    
    public static $sqlBase = "SELECT * FROM recibo_contato_soportes ";
    
    public static function insertar_soporte($ID_RECIBOCONTACTO, $RUTA_SOPORTE_RECIBOCONTACTO, $TIPO_SOPORTE_RECIBOCONTACTO) {
        $query = "INSERT INTO recibo_contato_soportes ( ID_RECIBOCONTACTO, RUTA_SOPORTE_RECIBOCONTACTO, TIPO_SOPORTE_RECIBOCONTACTO 
        ) VALUES  ( 
            '" . $ID_RECIBOCONTACTO . "', '" . ( $RUTA_SOPORTE_RECIBOCONTACTO ) . "','" . $TIPO_SOPORTE_RECIBOCONTACTO . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }
    
    

    public static function archivos_en_el_registro($ID_RECIBOCONTACTO) {
        $query = self::$sqlBase . " WHERE ID_RECIBOCONTACTO = " . $ID_RECIBOCONTACTO . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function eliminar_soportes_excepto($ID_RECIBOCONTACTO, $soportes = array() ){        
        $sqlNO = 'DELETE FROM recibo_contato_soportes WHERE ID_RECIBOCONTACTO = '.$ID_RECIBOCONTACTO;
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_RECIBOCONTACTO <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }

    

}
