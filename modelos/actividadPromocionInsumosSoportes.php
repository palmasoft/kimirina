<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActividadPromocionInsumos
 *
 * @author Software
 */
class ActividadPromocionInsumosSoportesModel extends ModelBase {
    
   
    public static $sqlBase = "SELECT * FROM actividades_promocion_soportes ";

    public static function insertar_soporte($ID_ACTIVIDAD_PROMOCION, $RUTA_ACTIVIDAD_PROMOCION, $TIPO_ACTIVIDAD_PROMOCION) {
        $query = "INSERT INTO actividades_promocion_soportes (
            ID_ACTIVIDAD_PROMOCION,  RUTA_SOPORTE_ACTIVIDAD_PROMOCION,  TIPO_SOPORTE_ACTIVIDAD_PROMOCION 
        ) VALUES (  
            '" . $ID_ACTIVIDAD_PROMOCION . "', '" . ( $RUTA_ACTIVIDAD_PROMOCION ) . "','" . $TIPO_ACTIVIDAD_PROMOCION . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function archivos_en_el_registro($ID_ACTIVIDAD_PROMOCION) {
        $query = self::$sqlBase . " WHERE ID_ACTIVIDAD_PROMOCION = " . $ID_ACTIVIDAD_PROMOCION . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            
            return $consulta;
        }
        return 0;
    }
    
     public static function eliminar_soportes_excepto($ID_ACTIVIDAD_PROMOCION, $soportes = array() ){        
        $sqlNO = 'DELETE FROM actividades_promocion_soportes WHERE ID_ACTIVIDAD_PROMOCION = '.$ID_ACTIVIDAD_PROMOCION.'   ';
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_ACTIVIDAD_PROMOCION <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }
    
}
