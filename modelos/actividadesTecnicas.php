<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActividadesTecnicasModel extends ModelBase {    
    
	public static $sqlBase = "
            select
                actividades_tecnicas.*
            from actividades_tecnicas 
        ";
        
        public static function todos(){
            $query = self::$sqlBase." where actividades_tecnicas.ACTIVO='SI'";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function insertar( $nombreActividad, $instruccionesActividad) {
            $query =  "            
            insert into actividades_tecnicas(NOMBRE_ACTIVIDAD,INSTRUCCIONES_ACTIVIDAD) 
            values ('".$nombreActividad."', '".$instruccionesActividad."')";            
            return self::crear_ultimo_id($query);       
        }
    
        public static function eliminar($id) {
            $query = " update actividades_tecnicas set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_ACTIVIDAD='".$id."'";            
            return self::modificarRegistros($query);       
        }
        
        public static function datos($idActividadTecnica){
            $query = self::$sqlBase." where actividades_tecnicas.ID_ACTIVIDAD = '".$idActividadTecnica."' AND actividades_tecnicas.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
		
	public static function update($id, $nombreActividad, $instrucciones) {
            $query = " 
                update actividades_tecnicas 
                        set
                        NOMBRE_ACTIVIDAD = '". ($nombreActividad)."' , 
                        INSTRUCCIONES_ACTIVIDAD = '".($instrucciones)."',
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_ACTIVIDAD='".$id."'";            
            return self::modificarRegistros($query);       
        }
}
?>