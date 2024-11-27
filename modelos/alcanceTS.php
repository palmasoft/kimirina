<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AlcanceTSModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                alcance_TS.*
            from alcance_TS
        
        ";
        public static function todos(){
            $query = self::$sqlBase." where alcance_TS.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function datos($idAlcanceTS){
            $query = self::$sqlBase." where alcance_TS.ID_ALCANCETS = '".$idAlcanceTS."' AND alcance_TS.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
        
        public static function insertar( $codigoTipoLugar, $nombreTipoLugar, $observacionesTipoLugar) {
            $query =  "            
            insert into tipo_lugares (CODIGO_TIPOLUGAR, NOMBRE_TIPOLUGAR, OBSERVACIONES_TIPOLUGAR) 
            values ('".$codigoTipoLugar."', '".$nombreTipoLugar."', '".$observacionesTipoLugar."')";            
            return self::crear_ultimo_id($query);       
        }
    
        
        public static function update($id, $codigoTipoLugar, $nombreTipoLugar, $observacionesTipoLugar) {
            $query = " 
                update tipo_lugares 
                        set
                        CODIGO_TIPOLUGAR = '".$codigoTipoLugar."' , 
                        NOMBRE_TIPOLUGAR = '".$nombreTipoLugar."' , 
                        OBSERVACIONES_TIPOLUGAR = '".$observacionesTipoLugar."' , 
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_TIPOLUGAR='".$id."'";            
            return self::modificarRegistros($query);       
        }
        
        public static function eliminar($id) {
            $query = " update tipo_lugares set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_TIPOLUGAR='".$id."'";            
            return self::modificarRegistros($query);       
        }
    
}
?>