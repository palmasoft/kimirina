<?php

class InsumosModel extends ModelBase {
    
    public static $sqlBase = "select 	* from insumos ";

    public static function todos(){
    	$query = self::$sqlBase." where insumos.ACTIVO = 'SI'";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }

    
    public static function insertar($nombreInsumo, $observaciones) {
            $query =  "            
            insert into insumos(NOMBRE_INSUMO,OBSERVACIONES) 
            values ('".$nombreInsumo."', '".$observaciones."')";            
            return self::crear_ultimo_id($query);       
    }
    
    public static function updateStock($ID_INSUMO, $CANTIDAD) {
            $query ="UPDATE insumos
                    SET
                    STOCK_ACTUAL = STOCK_ACTUAL + $CANTIDAD
                    WHERE ID_INSUMO = '$ID_INSUMO'";            
            return self::modificarRegistros($query);       
    }
    
    public static function updateStock2($ID_INSUMO, $CANTIDAD1, $CANTIDAD2) {
           $query ="UPDATE insumos
                    SET
                    STOCK_ACTUAL = (STOCK_ACTUAL - $CANTIDAD1) + $CANTIDAD2
                    WHERE ID_INSUMO = $ID_INSUMO";            
            return self::modificarRegistros($query);       
    }
    
    public static function updateStockResta($ID_INSUMO, $CANTIDAD) {
           $query ="UPDATE insumos
                    SET
                    STOCK_ACTUAL = STOCK_ACTUAL - $CANTIDAD
                    WHERE ID_INSUMO = $ID_INSUMO";            
            return self::modificarRegistros($query);       
    }
    
    public static function eliminar($id) {
            $query = " update insumos set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_INSUMO='".$id."'";            
            return self::modificarRegistros($query);       
    }
    
    public static function datos($idInsumo){
            $query = self::$sqlBase." where insumos.ID_INSUMO = '".$idInsumo."' AND insumos.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
    }
	public static function update($id, $nombreInsumo, $observaciones) {
            $query = " 
                update insumos 
                        set
                        NOMBRE_INSUMO = '". ($nombreInsumo)."' , 
                        OBSERVACIONES = '".($observaciones)."',
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_INSUMO='".$id."'";            
            return self::modificarRegistros($query);       
   }
   
   public static function idInsumo($nombre){
            $query = "select ID_INSUMO from insumos where insumos.NOMBRE_INSUMO = '".$nombre."' AND insumos.ACTIVO = 'SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0]->ID_INSUMO;
            }
            return 0; 
    }
    
}?>