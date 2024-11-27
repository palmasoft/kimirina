<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProvinciasModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                provincias.*
            from provincias 
        
        ";
        public static function todasProvincias(){
            $query = self::$sqlBase;
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function provinciaPorNombre($nombre){
            $query = "select ID_PROVINCIA from provincias where provincias.NOMBRE_PROVINCIA = '".$nombre."' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_PROVINCIA;
            }
            return 0; 
        }
    
}

?>
