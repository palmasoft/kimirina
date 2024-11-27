<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TiposLugaresModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                tipo_lugares.*
            from tipo_lugares 
        
        ";
        public static function todos(){
            $query = self::$sqlBase." where tipo_lugares.ACTIVO = 'SI' ORDER BY NOMBRE_TIPOLUGAR ASC ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function datos($idTipoLugar){
            $query = self::$sqlBase." where tipo_lugares.ID_TIPOLUGAR = '".$idTipoLugar."' AND tipo_lugares.ACTIVO = 'SI' ";
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
        
        public function todos_filtro($provincia,$cantones,$monitor,$promotor) {
            return "";            
        }
        
        public static function tipoLugarPorNombre($nombre){
            $query = "select ID_TIPOLUGAR from tipo_lugares where tipo_lugares.NOMBRE_TIPOLUGAR = '".$nombre."' and ACTIVO = 'SI'";// and lugares_intervencion.ID_CANTON = '".$idCanton."' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_TIPOLUGAR;
            }
            return 0; 
        }
    
}
?>