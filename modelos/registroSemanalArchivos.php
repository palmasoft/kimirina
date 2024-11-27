<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistroSemanalArchivos
 *
 * @author Software
 */
class RegistroSemanalArchivosModel extends ModelBase {

    public static $sqlBase = "SELECT * FROM registro_semanal_soportes ";

    public static function insertar_soporte($ID_REGISTROSEMANAL, $RUTA_SOPORTE_REGISTROSEMANAL, $TIPO_SOPORTE_REGISTROSEMANAL) {
        $query = "INSERT INTO registro_semanal_soportes (
            ID_REGISTROSEMANAL,  RUTA_SOPORTE_REGISTROSEMANAL,  TIPO_SOPORTE_REGISTROSEMANAL 
        ) VALUES (  
            '" . $ID_REGISTROSEMANAL . "', '" . ( $RUTA_SOPORTE_REGISTROSEMANAL ) . "','" . $TIPO_SOPORTE_REGISTROSEMANAL . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function archivos_en_el_registro($idRegistroSemanal) {
        $query = self::$sqlBase . " WHERE ID_REGISTROSEMANAL = " . $idRegistroSemanal . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
     public static function eliminar_soportes_excepto($idRegistro, $soportes = array() ){        
        $sqlNO = 'DELETE FROM registro_semanal_soportes WHERE ID_REGISTROSEMANAL = '.$idRegistro;
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_REGISTROSEMANAL <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }

}
