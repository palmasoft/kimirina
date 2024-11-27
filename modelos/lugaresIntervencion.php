<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LugaresIntervencionModel extends ModelBase {    
    
    public static $sqlBase = "
		SELECT
                    tipo_lugares.CODIGO_TIPOLUGAR
                    , tipo_lugares.NOMBRE_TIPOLUGAR
                    , tipo_lugares.OBSERVACIONES_TIPOLUGAR
                    , provincias.ID_PROVINCIA  
                    , provincias.NOMBRE_PROVINCIA
                    , cantones.NOMBRE_CANTON
                    , lugares_intervencion.*
                FROM
                    lugares_intervencion
                    LEFT JOIN tipo_lugares 
                        ON (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
                    LEFT JOIN cantones 
                        ON (lugares_intervencion.ID_CANTON = cantones.ID_CANTON)
                    LEFT JOIN provincias 
                        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
        ";    

    public static function todos_lugares() {
    	$query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI'  ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }   
    
    public static function lugares_del_tipo( $id_tipolugar ){
        $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'  ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_del_tipo_provincia_canton( $id_tipolugar, $idProvincia, $idCanton ){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = ".$id_tipolugar."
             AND cantones.ID_PROVINCIA = ".$idProvincia."
                AND lugares_intervencion.ID_CANTON = ".$idCanton."
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_canton_tipolugar( $id_tipolugar, $idCanton ){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'
                AND lugares_intervencion.ID_CANTON = '".$idCanton."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_provincia_tipolugar( $id_tipolugar, $idProvincia){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'
             AND cantones.ID_PROVINCIA = '".$idProvincia."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_provincia_canton( $idProvincia, $idCanton ){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
             AND cantones.ID_PROVINCIA = '".$idProvincia."'
                AND lugares_intervencion.ID_CANTON = '".$idCanton."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_provincia( $idProvincia){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
             AND cantones.ID_PROVINCIA = '".$idProvincia."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_canton($idCanton ){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
                AND lugares_intervencion.ID_CANTON = '".$idCanton."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function lugares_en_tipolugar( $id_tipolugar){
       $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'
                ORDER BY LATITUD_LUGAR, LONGITUD_LUGAR ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta;
        }
        return 0;    
    }
    
    public static function todos(){
            $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function datos($idLugar){
            $query = self::$sqlBase." WHERE lugares_intervencion.ACTIVO = 'SI' AND lugares_intervencion.ID_LUGAR = '".$idLugar."' AND lugares_intervencion.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }

        public static function insertar($ID_TIPOLUGAR, $ID_CANTON, $NOMBRE_LUGAR, $DIRECCION_LUGAR, $TELEFONO_LUGAR,
                                    $CONTACTO_LUGAR, $TELEFONO_CONTACTO_LUGAR, $CORREO_CONTACTO_LUGAR, $WEB_LUGAR, 
                                    $LATITUD_LUGAR, $LONGITUD_LUGAR, $REFERENCIA_LUGAR, $OBSERVACIONES_LUGAR) {
            $query =  "
                INSERT INTO lugares_intervencion
            (ID_CANTON,
             ID_TIPOLUGAR,
             NOMBRE_LUGAR,
             DIRECCION_LUGAR,
             TELEFONO_LUGAR,
             CONTACTO_LUGAR,
             TELEFONO_CONTACTO_LUGAR,
             CORREO_CONTACTO_LUGAR,
             WEB_LUGAR,
             LATITUD_LUGAR,
             LONGITUD_LUGAR,
             REFERENCIA_LUGAR,
             OBSERVACIONES_LUGAR)
                
                VALUES (".$ID_CANTON.",
                        ".$ID_TIPOLUGAR.",
                        '".$NOMBRE_LUGAR."',
                        '".$DIRECCION_LUGAR."',
                        '".$TELEFONO_LUGAR."',
                        '".$CONTACTO_LUGAR."',
                        '".$TELEFONO_CONTACTO_LUGAR."',
                        '".$CORREO_CONTACTO_LUGAR."',
                        '".$WEB_LUGAR."',
                        '".$LATITUD_LUGAR."',
                        '".$LONGITUD_LUGAR."',
                        '".$REFERENCIA_LUGAR."',
                        '".$OBSERVACIONES_LUGAR."')

            ";            
            
            return self::crear_ultimo_id($query);       
        }
        public static function update($id, $ID_TIPOLUGAR, $ID_CANTON, $NOMBRE_LUGAR, $DIRECCION_LUGAR, $TELEFONO_LUGAR,
                                    $CONTACTO_LUGAR, $TELEFONO_CONTACTO_LUGAR, $CORREO_CONTACTO_LUGAR, $WEB_LUGAR, 
                                    $LATITUD_LUGAR, $LONGITUD_LUGAR, $REFERENCIA_LUGAR, $OBSERVACIONES_LUGAR) {
             $query = " 
                update lugares_intervencion
                        set
                         ID_CANTON = ".$ID_CANTON.",
                         ID_TIPOLUGAR = ".$ID_TIPOLUGAR.",
                         NOMBRE_LUGAR = '".$NOMBRE_LUGAR."',
                         DIRECCION_LUGAR = '".$DIRECCION_LUGAR."',
                         TELEFONO_LUGAR = '".$TELEFONO_LUGAR."',
                         CONTACTO_LUGAR = '".$CONTACTO_LUGAR."',
                         TELEFONO_CONTACTO_LUGAR = '".$TELEFONO_CONTACTO_LUGAR."',
                         CORREO_CONTACTO_LUGAR = '".$CORREO_CONTACTO_LUGAR."',
                         WEB_LUGAR = '".$WEB_LUGAR."',
                         LATITUD_LUGAR = '".$LATITUD_LUGAR."',
                         LONGITUD_LUGAR = '".$LONGITUD_LUGAR."',
                         REFERENCIA_LUGAR = '".$REFERENCIA_LUGAR."',
                         OBSERVACIONES_LUGAR = '".$OBSERVACIONES_LUGAR."',
                         FECHA_MODIFICACION = CURRENT_TIMESTAMP
                
                where ID_LUGAR='".$id."'";          

            return self::modificarRegistros($query);       
        }
        

        public static function eliminar($id) {
            $query = "update lugares_intervencion set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_LUGAR='".$id."'";            
        return self::modificarRegistros($query);       
        }
        
        public static function lugarPorNombre($nombre){
            $query = "select ID_LUGAR from lugares_intervencion where lugares_intervencion.NOMBRE_LUGAR = '".$nombre."'";// and lugares_intervencion.ID_CANTON = '".$idCanton."' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_LUGAR;
            }
            return 0; 
        }    
        
        public static function lugar_nombre_tipolugar_canton( $id_tipolugar, $idCanton, $nombrelugar){
       $query = "select ID_LUGAR from lugares_intervencion WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'
                AND lugares_intervencion.ID_CANTON = '".$idCanton."'
                AND lugares_intervencion.NOMBRE_LUGAR = '".$nombrelugar."' ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta[0]->ID_LUGAR;
        }
        return 0;    
        }
        
        public static function otroLugar_nombre_tipolugar_canton( $id_tipolugar, $idCanton){
       $query = "select ID_LUGAR from lugares_intervencion WHERE lugares_intervencion.ACTIVO = 'SI' 
            AND lugares_intervencion.ID_TIPOLUGAR = '".$id_tipolugar."'
                AND lugares_intervencion.ID_CANTON = '".$idCanton."'
                AND lugares_intervencion.NOMBRE_LUGAR LIKE 'OTRO' ";
        $consulta = self::consulta( $query );
        if ( count($consulta) > 0) {
            return $consulta[0]->ID_LUGAR;
        }
        return 0;    
        }
    }
?>