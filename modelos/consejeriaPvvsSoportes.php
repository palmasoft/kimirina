<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConsejeriaPvvsSoportesModel extends ModelBase {

    public static $sqlBase = "SELECT * FROM consejeria_pvvs_soportes ";

    public static function insertar_soporte($ID_CONSEJERIA, $RUTA_SOPORTE_CONSEJERIA, $TIPO_SOPORTE_CONSEJERIA) {
        $query = "INSERT INTO consejeria_pvvs_soportes (
            ID_CONSEJERIA,  RUTA_SOPORTE_CONSEJERIA,  TIPO_SOPORTE_CONSEJERIA 
        ) VALUES (  
            '" . $ID_CONSEJERIA . "', '" . ( $RUTA_SOPORTE_CONSEJERIA ) . "','" . $TIPO_SOPORTE_CONSEJERIA . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function archivos_en_el_registro($idRegistroSemanal) {
        $query = self::$sqlBase . " WHERE ID_CONSEJERIA = " . $idRegistroSemanal . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
     public static function eliminar_soportes_excepto($idRegistro, $soportes = array() ){        
        $sqlNO = 'DELETE FROM consejeria_pvvs_soportes WHERE ID_CONSEJERIA = '.$idRegistro.'  ';
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_CONSEJERIA <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }

}
