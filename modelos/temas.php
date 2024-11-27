<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TemasModel extends ModelBase {    
    
	public static $sqlBase = " select temas.* from temas ";
        
        public static function todos(){
            $query = self::$sqlBase." where temas.ACTIVO='SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        
        public static function insertar( $tituloTema, $descripcionTema, $instruccionesTema) {
            $query =  "            
            insert into temas(TITULO_TEMA,DESCRIPCION_TEMA,INSTRUCCIONES_TEMA) 
            values ('".$tituloTema."', '".$descripcionTema."', '".$instruccionesTema."')";            
            return self::crear_ultimo_id($query);       
        }
        
        public static function eliminar($id) {
            $query = " update temas set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_TEMA='".$id."'";            
            return self::modificarRegistros($query);       
        }
    
        public static function datos($idTema){
            $query = self::$sqlBase." where temas.ID_TEMA = '".$idTema."' AND temas.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
        
        public static function IDTemas($nombreTema){
            $query = self::$sqlBase."Select ID_TEMA from Temas where temas.TITULO_TEMA = '".$nombreTema."' AND temas.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
        
        public static function update($id, $tituloTema, $descripcionTema, $instruccionesTema) {
            $query = " 
                update temas 
                        set
                        TITULO_TEMA = '". ($tituloTema)."' , 
                        DESCRIPCION_TEMA = '".($descripcionTema)."' , 
                        INSTRUCCIONES_TEMA = '".($instruccionesTema)."' ,
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_TEMA='".$id."'";            
            return self::modificarRegistros($query);       
        }
        
        public static function temaConNombre($nombreTema){
            $query = "Select ID_TEMA from temas where temas.TITULO_TEMA = '".$nombreTema."' AND temas.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_TEMA;
            }
            return 0; 
        }
        
}
?>