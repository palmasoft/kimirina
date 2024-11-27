<?php

class TiposPoblacionModel extends ModelBase {

    public static $sqlBase = "
            select
                tipo_poblacion.*
            from tipo_poblacion  ";
    
      public static $filtroSR = " INNER JOIN subreceptores_tipo_poblacion 
        ON ( tipo_poblacion.ID_TIPOPOBLACION = subreceptores_tipo_poblacion.ID_TIPOPOBLACION ) 
		AND  subreceptores_tipo_poblacion.ID_SUBRECEPTOR =  ";

    public static function todos() {         
        $query = "";
        if( Usuario::noTieneRestricciones() or !SubreceptoresModel::tiene_restricciones() ){
           $query = self::$sqlBase;
        }  else {
           $query = self::$sqlBase.self::$filtroSR." " .$_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR. " " ;
        }
        
        $query .= " where tipo_poblacion.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_tipos_poblacion_para_web() {
        $query = " select * from tipo_poblacion where MOSTRAR_WEB = 'SI' and  tipo_poblacion.ACTIVO = 'SI' ;";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_tipos_poblacion() {
        $query = "select * from tipo_poblacion  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    public static function poblacionconID($id){
        $query = "select * from tipo_poblacion  where ID_TIPOPOBLACION = '".$id."'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }


    public static function insertar($codigoTipoPemar, $nombreTipoPemar, $aliasTipoPemar, $observacionesTipoPemar, $mostrarTipoPemar) {
        $query = "            
            insert into tipo_poblacion (CODIGO_TIPOPOBLACION, NOMBRE_TIPOPOBLACION, ALIAS_TIPOPOBLACION, OBSERVACIONES_TIPOPOBLACION, MOSTRAR_WEB) 
            values ('" . $codigoTipoPemar . "', '" . $nombreTipoPemar . "', '" . $aliasTipoPemar . "', '" . $observacionesTipoPemar . "', '" . $mostrarTipoPemar . "')";
        return self::crear_ultimo_id($query);
    }

    public static function datos($idTipoPemar) {
        $query = self::$sqlBase . " where tipo_poblacion.ID_TIPOPOBLACION = '" . $idTipoPemar . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function eliminar($id) {
        $query = " update tipo_poblacion set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_TIPOPOBLACION='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function update($id, $codigoTipoPemar, $nombreTipoPemar, $aliasTipoPemar, $observacionesTipoPemar, $mostrarTipoPemar) {
        $query = " 
                update tipo_poblacion 
                        set
                        CODIGO_TIPOPOBLACION = '" . $codigoTipoPemar . "' , 
                        NOMBRE_TIPOPOBLACION = '" . $nombreTipoPemar . "' , 
                            ALIAS_TIPOPOBLACION = '" . $aliasTipoPemar . "' , 
                        OBSERVACIONES_TIPOPOBLACION = '" . $observacionesTipoPemar . "' , 
                           MOSTRAR_WEB = '" . $mostrarTipoPemar . "' , 
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_TIPOPOBLACION='" . $id . "'";
        return self::modificarRegistros($query);
    }
    
    public static function idPoblacionConCodigo($codigoTipoPoblacion){
        $query = "select ID_TIPOPOBLACION from tipo_poblacion  where CODIGO_TIPOPOBLACION = '".$codigoTipoPoblacion."' and  tipo_poblacion.ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_TIPOPOBLACION;
        }
        return 0;
    }
    
    public static function sexoPoblacion($idTipoPoblacion){
        $query = "select SEXO_TIPOPOBLACION from tipo_poblacion  where ID_TIPOPOBLACION = '".$idTipoPoblacion."' and  tipo_poblacion.ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->SEXO_TIPOPOBLACION;
        }
        return 0;
    }
    
    public static function poblacionTrabajoSexual($idTipoPoblacion){
        $query = "select CODIGO_TIPOPOBLACION from tipo_poblacion  where ID_TIPOPOBLACION = '".$idTipoPoblacion."' and  tipo_poblacion.ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta->CODIGO_TIPOPOBLACION;
        }
        return 0;
    }
    
    public static function codigoPoblacionConCodigo($codigoTipoPoblacion){
        $query = "select CODIGO_TIPOPOBLACION from tipo_poblacion  where CODIGO_TIPOPOBLACION = '".$codigoTipoPoblacion."' and  tipo_poblacion.ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->CODIGO_TIPOPOBLACION;
        }
        return 0;
    }
}

?>