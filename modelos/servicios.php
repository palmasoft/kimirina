<?php

class ServiciosModel extends ModelBase {

    public static $sqlBase = "select servicios_salud.* from servicios_salud";
    
        public static function todos(){
            $query = self::$sqlBase." where servicios_salud.ACTIVO='SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
        public static function datos($idservicioSalud){
            $query = self::$sqlBase." where servicios_salud.ID_SERVICIO = '".$idservicioSalud."' AND servicios_salud.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
        }
        public static function insertar( $nombreServicioDeSalud, $codigoServicioDeSalud, $observacionesServicioDeSalud, $nivelServicioDeSalud) {
            $query =  "            
            insert into servicios_salud (NOMBRE_SERVICIO, CODIGO_SERVICIO, OBSERVACIONES_SERVICIO, NIVEL_SERVICIO) 
            values ('".$nombreServicioDeSalud."', '".$codigoServicioDeSalud."', '".$observacionesServicioDeSalud."', '".$nivelServicioDeSalud."')";            
            return self::crear_ultimo_id($query);       
        }
        public static function update($id, $nombreservicio, $codigoservicio, $observacionesservicio, $nivelservicio) {
            $query = " 
                update servicios_salud
                        set
                        NOMBRE_SERVICIO = '".$nombreservicio."' , 
                        CODIGO_SERVICIO = '".$codigoservicio."' , 
                        OBSERVACIONES_SERVICIO = '".$observacionesservicio."' , 
                        NIVEL_SERVICIO = '".$nivelservicio."',
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_SERVICIO='".$id."'";            
            return self::modificarRegistros($query);       
        }
        public static function eliminar($id) {
            $query = " update servicios_salud set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_SERVICIO='".$id."'";            
        return self::modificarRegistros($query);       
        }

}