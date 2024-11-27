<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class centrosserviciossaludModel extends ModelBase {    

   public static $sqlBase = "
   SELECT NOMBRE_CANTON
      , NOMBRE_TIPO_CENTROSERVICIO
      , provincias.ID_PROVINCIA  
      , provincias.NOMBRE_PROVINCIA
      , provincias.OBSERVACIONES_PROVINCIA    
      ,centros_servicios_salud.*
      ,subreceptores.SIGLAS_SUBRECEPTOR
    FROM
    centros_servicios_salud
    
    LEFT JOIN cantones 
        ON (centros_servicios_salud.ID_CANTON = cantones.ID_CANTON)
    LEFT JOIN tipo_centro_salud 
        ON (centros_servicios_salud.ID_TIPO_CENTROSERVICIO = tipo_centro_salud.ID_TIPO_CENTROSERVICIO)
    LEFT JOIN provincias
        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
   LEFT JOIN subreceptores
        ON (subreceptores.ID_SUBRECEPTOR = centros_servicios_salud.ID_SUBRECEPTOR)
      ";
        

    public static function todos(){
            $query = self::$sqlBase."where centros_servicios_salud.ACTIVO='SI' ORDER BY centros_servicios_salud.ID_CANTON ASC, provincias.ID_PROVINCIA ASC, centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC  ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
    }      

    public static function todos_informes(){
            $query = self::$sqlBase."  ORDER BY centros_servicios_salud.ID_CANTON ASC, provincias.ID_PROVINCIA ASC, centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC  ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
    }
    /* Ordena los centros de servicios primero por el canton y provincia seleccionados **/
    public static function todos_filtro($canton="", $provincia = ""){            
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON =".$canton." AND provincias.ID_PROVINCIA =".$provincia.")  "
                    . " ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }        
        $query = self::$sqlBase.$filtro;
        $consulta = self::consulta( $query );
        
        
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON <> ".$canton." AND provincias.ID_PROVINCIA =".$provincia.") "
                    . " ORDER BY  centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }        
        $query = self::$sqlBase.$filtro;
        $consulta2 = self::consulta( $query );
        
        
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON <> ".$canton." AND provincias.ID_PROVINCIA <> ".$provincia.") "
                    . " ORDER BY  centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }        
        $query = self::$sqlBase.$filtro;
        $consulta3 = self::consulta( $query );
        
            $resp = array_merge( $consulta, $consulta2, $consulta3);            
            return $resp;
    }
    
    public static function todos_filtro_canton($canton="", $provincia = ""){            
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON =".$canton." AND provincias.ID_PROVINCIA =".$provincia.")  "
                    . " ORDER BY centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }        
        $query = self::$sqlBase.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function todos_filtro_provincia($canton="", $provincia = ""){            
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON <> ".$canton." AND provincias.ID_PROVINCIA =".$provincia.") "
                    . " ORDER BY  centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }           
        $query = self::$sqlBase.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function todos_filtro_no_canton_no_provincia($canton="", $provincia = ""){            
        $filtro = " WHERE centros_servicios_salud.ACTIVO='SI' AND ";
        if( $provincia != "" && $canton != "" ){
            $filtro.= "  "
                    . "(centros_servicios_salud.ID_CANTON <> ".$canton." AND provincias.ID_PROVINCIA <> ".$provincia.") "
                    . " ORDER BY  centros_servicios_salud.NOMBRE_CENTROSERVICIO ASC ";
        }           
        $query = self::$sqlBase.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function datos($id) {
        $query = self::$sqlBase . " where centros_servicios_salud.ID_CENTROSERVICIO = '" . $id . "' AND centros_servicios_salud.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function insertar($ID_CANTON, $ID_SUBRECEPTOR, $ID_TIPO_CENTROSERVICIO, $NOMBRE_CENTROSERVICIO, $IDENTIFICACION_CENTROSERVICIO, 
                                    $TELEFONO_CENTROSERVICIO, $CORREO_CENTROSERVICIO, $WEB_CENTROSERVICIO, $CONTACTO_CENTROSERVICIO,
                                    $DIRECCION_CENTROSERVICIO, $LATITUD_CENTROSERVICIO, $LONGITUD_CENTROSERVICIO, $MARCADOR_CENTROSERVICIO,
                                    $COBERTURA_CENTROSERVICIO) {
            $query =  "
                INSERT INTO centros_servicios_salud
            (ID_CANTON,
             ID_SUBRECEPTOR,
             ID_TIPO_CENTROSERVICIO,
             NOMBRE_CENTROSERVICIO,
             IDENTIFICACION_CENTROSERVICIO,
             TELEFONO_CENTROSERVICIO,
             CORREO_CENTROSERVICIO,
             WEB_CENTROSERVICIO,
             CONTACTO_CENTROSERVICIO,
             DIRECCION_CENTROSERVICIO,
             LATITUD_CENTROSERVICIO,
             LONGITUD_CENTROSERVICIO,
             MARCADOR_CENTROSERVICIO,
             COBERTURA_CENTROSERVICIO)
            VALUES (
            ".$ID_CANTON.",
            ".$ID_SUBRECEPTOR.",
            ".$ID_TIPO_CENTROSERVICIO.",
            '".htmlspecialchars($NOMBRE_CENTROSERVICIO)."',
            '".$IDENTIFICACION_CENTROSERVICIO."',
            '".$TELEFONO_CENTROSERVICIO."',
            '".$CORREO_CENTROSERVICIO."',
            '".$WEB_CENTROSERVICIO."',
            '".$CONTACTO_CENTROSERVICIO."',
            '".htmlspecialchars($DIRECCION_CENTROSERVICIO)."',
            '".$LATITUD_CENTROSERVICIO."',
            '".$LONGITUD_CENTROSERVICIO."',
            '".$MARCADOR_CENTROSERVICIO."',
            '".$COBERTURA_CENTROSERVICIO."')";  

        return self::crear_ultimo_id($query);       
    }
    public static function update($ID, $ID_SUBRECEPTOR, $ID_CANTON, $ID_TIPO_CENTROSERVICIO, $NOMBRE_CENTROSERVICIO, $IDENTIFICACION_CENTROSERVICIO, 
                                    $TELEFONO_CENTROSERVICIO, $CORREO_CENTROSERVICIO, $WEB_CENTROSERVICIO, $CONTACTO_CENTROSERVICIO,
                                    $DIRECCION_CENTROSERVICIO, $LATITUD_CENTROSERVICIO, $LONGITUD_CENTROSERVICIO, $MARCADOR_CENTROSERVICIO,
                                    $COBERTURA_CENTROSERVICIO) {
            $query =  "
            UPDATE centros_servicios_salud
                SET 
                  ID_CANTON = ".$ID_CANTON.",
                  ID_SUBRECEPTOR = ".$ID_SUBRECEPTOR.",
                  ID_TIPO_CENTROSERVICIO = '".$ID_TIPO_CENTROSERVICIO."',
                  NOMBRE_CENTROSERVICIO = '".htmlspecialchars($NOMBRE_CENTROSERVICIO)."',
                  IDENTIFICACION_CENTROSERVICIO = '".$IDENTIFICACION_CENTROSERVICIO."',
                  TELEFONO_CENTROSERVICIO = '".$TELEFONO_CENTROSERVICIO."',
                  CORREO_CENTROSERVICIO = '".$CORREO_CENTROSERVICIO."',
                  WEB_CENTROSERVICIO = '".$WEB_CENTROSERVICIO."',
                  CONTACTO_CENTROSERVICIO = '".$CONTACTO_CENTROSERVICIO."',
                  DIRECCION_CENTROSERVICIO = '".htmlspecialchars($DIRECCION_CENTROSERVICIO)."',
                  LATITUD_CENTROSERVICIO = '".$LATITUD_CENTROSERVICIO."',
                  LONGITUD_CENTROSERVICIO = '".$LONGITUD_CENTROSERVICIO."',
                  MARCADOR_CENTROSERVICIO = '".$MARCADOR_CENTROSERVICIO."',
                  COBERTURA_CENTROSERVICIO = '".$COBERTURA_CENTROSERVICIO."',
                  FECHA_MODIFICACION = CURRENT_TIMESTAMP
                WHERE ID_CENTROSERVICIO = '" . $ID . "'";         
                return self::modificarRegistros($query);      
    }
    

    public static function eliminar($id) {
        $query = " update centros_servicios_salud set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_CENTROSERVICIO='".$id."'";            
    return self::modificarRegistros($query);       
    }

    public static function centroPorNombre($nombre){
            
            $query = "select ID_CENTROSERVICIO from centros_servicios_salud where NOMBRE_CENTROSERVICIO = '".$nombre."' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_CENTROSERVICIO;
            }
            return 0; 
        }
    
}
?>