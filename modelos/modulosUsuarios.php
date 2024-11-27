<?php

class modulosUsuariosModel extends ModelBase{
    
    public static $sqlBase = "SELECT * FROM modulos_sistema " ;

    public static function todos(){
    	$query = self::$sqlBase." WHERE ESTADO='ACTIVO' ";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function datos($ID_ROL){
    	$query = self::$sqlBase." WHERE ACTIVO='Si' AND ID_ROL='$ID_ROL' ";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
    
    public static function update($ID_ROL, $CODIGO_ROL, $NOMBRE_ROL, $OBSERVACIONES_ROL, $PERMISOS_ROL){
    	 $query ="
            UPDATE tipo_usuario
                SET
                  CODIGO_ROL = '$CODIGO_ROL',
                  NOMBRE_ROL = '$NOMBRE_ROL',
                  OBSERVACIONES_ROL = '$OBSERVACIONES_ROL',
                  PERMISOS_ROL = '$PERMISOS_ROL',
                  FECHA_MODIFICACION = 'CURRENT_TIMESTAMP',
                  ACTIVO = 'Si'
                WHERE ID_ROL = '$ID_ROL';";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}

?>