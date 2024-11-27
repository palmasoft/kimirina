<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EsquemasArvModel extends ModelBase {    
    
	public static $sqlBase = " select esquemas_arv.* from esquemas_arv ";
        
    public static function todos(){
            $query = self::$sqlBase." where esquemas_arv.ACTIVO='SI' ";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
        }
        
    public static function insertar($codEsquema, $nombreEsquema, $obsEsquema) {
            $query =  "
                insert into esquemas_arv (CODIGO_ESQUEMA_ARV, NOMBRE_ESQUEMA_ARV, OBSERVACIONES_ESQUEMA_ARV)
                values ('".$codEsquema."', '".$nombreEsquema."', '".$obsEsquema."')";            
            return self::crear_ultimo_id($query);       
    }
    public static function datos($idEsquemasArv) {
        $query = self::$sqlBase . " where esquemas_arv.ID_ESQUEMA_ARV = '" . $idEsquemasArv . "' AND esquemas_arv.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
        
    public static function update($id, $codEsquema, $nombreEsquema, $obsEsquema) {
        $query = " 
                update esquemas_arv 
                        set
                        CODIGO_ESQUEMA_ARV = '" . $codEsquema . "' , 
                        NOMBRE_ESQUEMA_ARV = '" . $nombreEsquema . "' , 
                        OBSERVACIONES_ESQUEMA_ARV = '" . $obsEsquema . "' ,                        
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_ESQUEMA_ARV='" . $id . "'";
        return self::modificarRegistros($query);
    }    
	
	 public static function eliminar($id) {
            $query = " update esquemas_arv set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_ESQUEMA_ARV='".$id."'";            
            return self::modificarRegistros($query);       
        }
    
}
?>