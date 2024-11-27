<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TiposCentrosSaludModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                tipo_centro_salud.*
            from tipo_centro_salud 
        
        ";
        public static function todos(){
            $query = self::$sqlBase." where tipo_centro_salud.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function datos($idCentroSalud){
            $query = self::$sqlBase." where tipo_centro_salud.ID_TIPO_CENTROSERVICIO = '".$idCentroSalud."' AND tipo_centro_salud.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
        
        public static function insertar( $codigoCentroSalud, $nombreCentroSalud, $observacionesCentroSalud) {
            $query =  "            
            insert into tipo_centro_salud (
                CODIGO_TIPO_CENTROSERVICIO, 
                NOMBRE_TIPO_CENTROSERVICIO, 
                OBSERVACIONES_TIPO_CENTROSERVICIO
            )values ('".$codigoCentroSalud."', '".$nombreCentroSalud."', '".$observacionesCentroSalud."')";            
            return self::crear_ultimo_id($query);       
        }
    
        
        public static function update($id, $codigoCentroSalud, $nombreCentroSalud, $observacionesCentroSalud) {
            $query = " 
                update tipo_centro_salud 
                        set
                        CODIGO_TIPO_CENTROSERVICIO = '".$codigoCentroSalud."' , 
                        NOMBRE_TIPO_CENTROSERVICIO = '".$nombreCentroSalud."' , 
                        OBSERVACIONES_TIPO_CENTROSERVICIO = '".$observacionesCentroSalud."' , 
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_TIPO_CENTROSERVICIO='".$id."'";            
            return self::modificarRegistros($query);       
        }
        
        public static function eliminar($id) {
            $query = " update tipo_centro_salud set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_TIPO_CENTROSERVICIO='".$id."'";            
            return self::modificarRegistros($query);       
        }
    
}
?>