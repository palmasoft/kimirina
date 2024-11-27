<?php

class RegistroActividadPromocionEntregaInsumosModel extends ModelBase {

    public static $sqlBase = "  
                SELECT
                    subreceptores.*
                    , actividades_promocion.*
                    , lugares_intervencion.*
                    , provincias.*
                    , tipo_usuario.*
                    , personas_sistema.*
                    , tipo_lugares.*
                    , cantones.*
                    , digitador.`NOMBRE_REAL_PERSONA` AS NOMBRE_DIGITADOR
                    , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
                    , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
                    , actividades_promocion.FECHA_CREACION AS FECHA_CREACION_ACTIVIDAD_PROMOCION
                    , actividades_promocion.FECHA_MODIFICACION AS FECHA_MODIFICACION_ACTIVIDAD_PROMOCION
                    , actividades_promocion.FECHA_ELIMINACION AS FECHA_ELIMINACION_ACTIVIDAD_PROMOCION
                    , (SELECT cantidad_insumo FROM actividades_promocion_insumos WHERE ID_INSUMO = 1 AND actividades_promocion_insumos.ID_ACTIVIDAD_PROMOCION = actividades_promocion.ID_ACTIVIDAD_PROMOCION) AS CANT_CONDONES 
                    , (SELECT cantidad_insumo FROM actividades_promocion_insumos WHERE ID_INSUMO = 2 AND actividades_promocion_insumos.ID_ACTIVIDAD_PROMOCION = actividades_promocion.ID_ACTIVIDAD_PROMOCION) AS CANT_LUBRICANTES 
                    , (SELECT cantidad_insumo FROM actividades_promocion_insumos  WHERE ID_INSUMO = 3  AND actividades_promocion_insumos.ID_ACTIVIDAD_PROMOCION = actividades_promocion.ID_ACTIVIDAD_PROMOCION) AS CANT_FOLLETOS 
                FROM
                    actividades_promocion
                    INNER JOIN lugares_intervencion 
                        ON (actividades_promocion.ID_LUGAR_ACTIVIDAD_PROMOCION = lugares_intervencion.ID_LUGAR)
                    INNER JOIN personas_sistema 
                        ON (actividades_promocion.ID_RESPONSABLE_ACTIVIDAD_PROMOCION = personas_sistema.ID_PERSONA)
                     INNER JOIN tipo_usuario 
                        ON (personas_sistema.ID_ROL_TIPOUSUARIO = tipo_usuario.ID_ROL)
                    INNER JOIN tipo_lugares 
                        ON (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
                    INNER JOIN cantones 
                        ON (lugares_intervencion.ID_CANTON = cantones.ID_CANTON)
                    INNER JOIN subreceptores 
                        ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
                    INNER JOIN provincias 
                        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
                    LEFT JOIN personas_sistema AS digitador
                        ON (actividades_promocion.ID_DIGITA = digitador.ID_PERSONA)
                    LEFT JOIN personas_sistema AS modifica
                        ON (actividades_promocion.ID_MODIFICA = modifica.ID_PERSONA)
                    LEFT JOIN personas_sistema AS elimina
                        ON (actividades_promocion.ID_ELIMINA = elimina.ID_PERSONA)";
    
    public static $filtroPeriodo = " INNER JOIN periodos ON (actividades_promocion.FECHA_ACTIVIDAD_PROMOCION >= periodos.FECHA_MIN_PERIODO AND actividades_promocion.FECHA_ACTIVIDAD_PROMOCION <= periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d ) ";
    public static $filtroActivo = " actividades_promocion.ACTIVO = 'SI' ";
    public static $filtroSR = " AND personas_sistema.ID_SUBRECEPTOR = ";

    public static function todos() {

        $query = self::$sqlBase .  " WHERE " . self::$filtroActivo . " ";
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }       

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function todos_gestion() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO );
        if ( Usuario::tiene_restricciones()) {
            $query .= " WHERE personas_sistema.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }       

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    
    public static function todos_periodo() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO ) . " WHERE " . self::$filtroActivo . " ";
        if ( Usuario::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }       

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($idRegistro) {
        $query = self::$sqlBase . "where actividades_promocion.ID_ACTIVIDAD_PROMOCION  = '" . $idRegistro . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function eliminarInsumos($ID_ACTIVIDAD_PROMOCION) {
        $query = "DELETE 
                 FROM actividades_promocion_insumos
                 WHERE ID_ACTIVIDAD_PROMOCION = $ID_ACTIVIDAD_PROMOCION";

        return self::modificarRegistros($query);
    }

    public static function eliminaActividad($ID_REGISTRO) {
        $query = "UPDATE actividades_promocion
                    SET 
                      FECHA_ELIMINACION = CURRENT_TIMESTAMP,
                      ID_ELIMINA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . ",
                      ACTIVO = 'NO'
                    WHERE ID_ACTIVIDAD_PROMOCION = $ID_REGISTRO";

        return self::modificarRegistros($query);
    }

    public static function insertarInsumoCondones($ID_ACTIVIDAD_PROMOCION, $CANTIDAD_INSUMO) {
        $query = "INSERT INTO actividades_promocion_insumos
            (ID_ACTIVIDAD_PROMOCION,
             ID_INSUMO,
             CANTIDAD_INSUMO)
            VALUES ($ID_ACTIVIDAD_PROMOCION,
            1,
            $CANTIDAD_INSUMO)";

        return self::crear_ultimo_id($query);
    }

    public static function insertarInsumoLubricantes($ID_ACTIVIDAD_PROMOCION, $CANTIDAD_INSUMO) {
        $query = "INSERT INTO actividades_promocion_insumos
            (ID_ACTIVIDAD_PROMOCION,
             ID_INSUMO,
             CANTIDAD_INSUMO)
            VALUES ($ID_ACTIVIDAD_PROMOCION,
            2,
            $CANTIDAD_INSUMO)";

        return self::crear_ultimo_id($query);
    }

    public static function insertarInsumoFolleteria($ID_ACTIVIDAD_PROMOCION, $CANTIDAD_INSUMO) {
        $query = "INSERT INTO actividades_promocion_insumos
            (ID_ACTIVIDAD_PROMOCION,
             ID_INSUMO,
             CANTIDAD_INSUMO)
            VALUES ($ID_ACTIVIDAD_PROMOCION,
            3,
            $CANTIDAD_INSUMO)";

        return self::crear_ultimo_id($query);
    }

    public static function insertar(
            $FECHA_ACTIVIDAD_PROMOCION, $ID_LUGAR_ACTIVIDAD_PROMOCION, $MOTIVO_ACTIVIDAD_PROMOCION, 
            $NUM_HSH_ACTIVIDAD_PROMOCION, $NUM_TS_ACTIVIDAD_PROMOCION, $NUM_TRANS_ACTIVIDAD_PROMOCION,  $NUM_PVVS_ACTIVIDAD_PROMOCION, 
            $ID_RESPONSABLE_ACTIVIDAD_PROMOCION) {
        $query = "INSERT INTO actividades_promocion
            (
             FECHA_ACTIVIDAD_PROMOCION,
             ID_LUGAR_ACTIVIDAD_PROMOCION,
             MOTIVO_ACTIVIDAD_PROMOCION,
             NUM_HSH_ACTIVIDAD_PROMOCION,
             NUM_TS_ACTIVIDAD_PROMOCION,
             NUM_TRANS_ACTIVIDAD_PROMOCION,
             NUM_PVVS_ACTIVIDAD_PROMOCION,
             ID_RESPONSABLE_ACTIVIDAD_PROMOCION,
             FECHA_CREACION,
             ID_DIGITA)
            VALUES (
                    '$FECHA_ACTIVIDAD_PROMOCION',
                    '$ID_LUGAR_ACTIVIDAD_PROMOCION',
                    '$MOTIVO_ACTIVIDAD_PROMOCION',
                    '$NUM_HSH_ACTIVIDAD_PROMOCION',
                    '$NUM_TS_ACTIVIDAD_PROMOCION',
                    '$NUM_TRANS_ACTIVIDAD_PROMOCION',
                    '$NUM_PVVS_ACTIVIDAD_PROMOCION',
                    '$ID_RESPONSABLE_ACTIVIDAD_PROMOCION',
                    CURRENT_TIMESTAMP,
                    " . $_SESSION['SESION_USUARIO']->ID_PERSONA . ");";

        return self::crear_ultimo_id($query);
    }

    public static function update(
            $id_registro, $FECHA_ACTIVIDAD_PROMOCION, $ID_LUGAR_ACTIVIDAD_PROMOCION, $MOTIVO_ACTIVIDAD_PROMOCION, 
            $NUM_HSH_ACTIVIDAD_PROMOCION, $NUM_TS_ACTIVIDAD_PROMOCION, $NUM_TRANS_ACTIVIDAD_PROMOCION, $NUM_PVVS_ACTIVIDAD_PROMOCION,
            $ID_RESPONSABLE_ACTIVIDAD_PROMOCION) {
        $query = "UPDATE actividades_promocion
                SET 
                  FECHA_ACTIVIDAD_PROMOCION = '$FECHA_ACTIVIDAD_PROMOCION',
                  ID_LUGAR_ACTIVIDAD_PROMOCION = $ID_LUGAR_ACTIVIDAD_PROMOCION,
                  MOTIVO_ACTIVIDAD_PROMOCION = '$MOTIVO_ACTIVIDAD_PROMOCION',
                  NUM_HSH_ACTIVIDAD_PROMOCION = $NUM_HSH_ACTIVIDAD_PROMOCION,
                  NUM_TS_ACTIVIDAD_PROMOCION = $NUM_TS_ACTIVIDAD_PROMOCION,
                  NUM_PVVS_ACTIVIDAD_PROMOCION = $NUM_PVVS_ACTIVIDAD_PROMOCION,
                  NUM_TRANS_ACTIVIDAD_PROMOCION = $NUM_TRANS_ACTIVIDAD_PROMOCION,
                  ID_RESPONSABLE_ACTIVIDAD_PROMOCION = $ID_RESPONSABLE_ACTIVIDAD_PROMOCION,
                  FECHA_MODIFICACION = CURRENT_TIMESTAMP,
                  ID_MODIFICA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . "
                WHERE ID_ACTIVIDAD_PROMOCION = $id_registro";

        return self::modificarRegistros($query);
    }

}
