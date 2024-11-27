<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CantonesModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                cantones.*
            from cantones 
        
        ";
        public static function todosCantones(){
            $query = self::$sqlBase;
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function cantonPorNombre($nombre){
            $query = "select ID_CANTON from cantones where cantones.NOMBRE_CANTON = '".$nombre."'";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_CANTON;
            }
            return 0; 
        }
        
        public static function idProvinciaDelCanton($id){
            $query = "select ID_PROVINCIA from cantones where cantones.ID_CANTON = '".$id."'";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_PROVINCIA;
            }
            return 0; 
        }
    
}

?>