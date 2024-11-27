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
class EventoMasivoSoportesModel extends ModelBase {
    
   
    public static $sqlBase = "SELECT * FROM eventos_masivos_soporte ";

    public static function insertar_soporte($ID_EVENTO_MASIVO, $RUTA_EVENTO_MASIVO, $TIPO_EVENTO_MASIVO) {
        $query = "INSERT INTO eventos_masivos_soporte (
            ID_EVENTO_MASIVO,  RUTA_SOPORTE_EVENTO_MASIVO,  TIPO_SOPORTE_EVENTO_MASIVO 
        ) VALUES (  
            '" . $ID_EVENTO_MASIVO . "', '" . ( $RUTA_EVENTO_MASIVO ) . "','" . $TIPO_EVENTO_MASIVO . "'
        ) ;";
        return self::crear_ultimo_id($query);
    }

    public static function archivos_en_el_registro($ID_EVENTO_MASIVO) {
        $query = self::$sqlBase . " WHERE ID_EVENTO_MASIVO = " . $ID_EVENTO_MASIVO . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            
            return $consulta;
        }
        return 0;
    }
    
     public static function eliminar_soportes_excepto($ID_EVENTO_MASIVO, $soportes = array() ){        
        $sqlNO = 'DELETE FROM eventos_masivos_soporte WHERE ID_EVENTO_MASIVO = '.$ID_EVENTO_MASIVO;
        if(count($soportes) > 0){
            $sqlNO .= ' AND ';
            for ($index = 0; $index < count($soportes); $index++) {
                $sqlNO .= ' ID_SOPORTE_EVENTO_MASIVO <> '.$soportes[$index];
                if( ($index+1) != count($soportes) ){
                    $sqlNO .= ' AND ';
                }
            }
        }
        return self::modificarRegistros($sqlNO);
    }
    
}
