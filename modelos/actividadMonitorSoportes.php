<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActividadMonitorSoportesModel extends ModelBase {

    public static $sqlBase = "SELECT * FROM actividades_monitor_soportes ";

    public static function insertar_soporte($ID_ACTIVIDAD_MONITOR, $RUTA_SOPORTE_ACTIVIDAD_MONITOR, $TIPO_SOPORTE_ACTIVIDAD_MONITOR) {
        $query = "INSERT INTO actividades_monitor_soportes (
            ID_ACTIVIDAD_MONITOR,  RUTA_SOPORTE_ACTIVIDAD_MONITOR,  TIPO_SOPORTE_ACTIVIDAD_MONITOR 
        ) VALUES (  
            '" . $ID_ACTIVIDAD_MONITOR . "', '" . ( $RUTA_SOPORTE_ACTIVIDAD_MONITOR ) . "','" . $TIPO_SOPORTE_ACTIVIDAD_MONITOR . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function archivos_en_el_registro($idRegistroSemanal) {
        $query = self::$sqlBase . " WHERE ID_ACTIVIDAD_MONITOR = " . $idRegistroSemanal . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
     public static function eliminar_soportes_excepto($idRegistro, $soportes = array() ){        
        $sqlNO = 'DELETE FROM actividades_monitor_soportes WHERE ID_ACTIVIDAD_MONITOR = '.$idRegistro.'   ';
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_ACTIVIDAD_MONITOR <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }

}
