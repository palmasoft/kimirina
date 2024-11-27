<?php

class ReciboContactoAnimadorModel extends ModelBase {

    public static $sqlBase = "
        SELECT            
             provincias.*         
            , cantones.* 
            , tipo_lugares.* 
            , lugares_intervencion.* 
            , temas.* 
            , tipo_poblacion.* 
            , pemar.* 
            , animador.* 
            , subreceptores.* 
            , recibo_contacto_animador.* 
            , animador.NOMBRE_REAL_PERSONA AS NOMBRE_ANIMADOR
            , digitador.NOMBRE_REAL_PERSONA AS NOMBRE_DIGITADOR
            , monitor.NOMBRE_REAL_PERSONA AS NOMBRE_MONITOR
            , coordinador.NOMBRE_REAL_PERSONA AS NOMBRE_COORDINADOR
            , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
            , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
            , recibo_contacto_animador.FECHA_CREACION AS FECHA_CREACION_RECIBO_ANIMADOR
            , recibo_contacto_animador.FECHA_MODIFICACION AS FECHA_MODIFICACION_RECIBO_ANIMADOR
            , recibo_contacto_animador.FECHA_ELIMINACION AS FECHA_ELIMINACION_RECIBO_ANIMADOR
            , cantones.ID_CANTON AS ID_CANTON_RECIBO
            , DATE( CONCAT( recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-', recibo_contacto_animador.MES_CONTACTOANIMADOR,'-', recibo_contacto_animador.DIA_CONTACTOANIMADOR) ) AS FECHA_CONTACTO
            ,(SELECT recibo_contacto_insumo_entregado.CANTIDAD FROM recibo_contacto_insumo_entregado WHERE recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR = recibo_contacto_animador.ID_CONTACTOANIMADOR AND ID_INSUMO = 1  ) AS NUM_CONDONES
            ,(SELECT recibo_contacto_insumo_entregado.CANTIDAD FROM recibo_contacto_insumo_entregado WHERE recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR = recibo_contacto_animador.ID_CONTACTOANIMADOR AND ID_INSUMO = 2  ) AS NUM_LUBRICANTES
            ,(SELECT recibo_contacto_insumo_entregado.CANTIDAD FROM recibo_contacto_insumo_entregado WHERE recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR = recibo_contacto_animador.ID_CONTACTOANIMADOR AND ID_INSUMO = 3  ) AS NUM_FOLLETOS
    
            FROM recibo_contacto_animador 
            INNER JOIN cantones 
                ON (recibo_contacto_animador.ID_CIUDAD = cantones.ID_CANTON)
            INNER JOIN provincias 
                ON (recibo_contacto_animador.ID_PROVINCIA = provincias.ID_PROVINCIA)
            INNER JOIN tipo_lugares 
                ON (recibo_contacto_animador.ID_TIPO_LUGAR = tipo_lugares.ID_TIPOLUGAR)
            INNER JOIN lugares_intervencion 
                ON (recibo_contacto_animador.ID_LUGAR = lugares_intervencion.ID_LUGAR)
            INNER JOIN temas 
                ON (recibo_contacto_animador.ID_TEMA = temas.ID_TEMA)
            INNER JOIN tipo_poblacion 
                ON (recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = tipo_poblacion.CODIGO_TIPOPOBLACION)
            INNER JOIN pemar 
                ON (recibo_contacto_animador.ID_PEMAR = pemar.ID_POBLACION)
            INNER JOIN personas_sistema AS animador
                ON (recibo_contacto_animador.ID_PROMOTOR = animador.ID_PERSONA)
            LEFT JOIN personas_sistema AS digitador
                ON (recibo_contacto_animador.ID_DIGITADOR = digitador.ID_PERSONA)
            LEFT JOIN personas_sistema AS monitor
                ON (recibo_contacto_animador.ID_MONITOR = monitor.ID_PERSONA)
            LEFT JOIN personas_sistema AS coordinador
                ON (recibo_contacto_animador.ID_SUPERVISOR = coordinador.ID_PERSONA)
            LEFT JOIN personas_sistema AS modifica
                ON (recibo_contacto_animador.ID_MODIFICA = modifica.ID_PERSONA)
            LEFT JOIN personas_sistema AS elimina
                ON (recibo_contacto_animador.ID_ELIMINA = elimina.ID_PERSONA)
            LEFT JOIN subreceptores 
                ON (animador.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR) 
        ";
    public static $sqlGroup = " ORDER BY recibo_contacto_animador.FECHA_CREACION DESC ";
    public static $filtroPeriodo = " INNER JOIN periodos ON ( date( concat( recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-', recibo_contacto_animador.MES_CONTACTOANIMADOR,'-', recibo_contacto_animador.DIA_CONTACTOANIMADOR) ) BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d ) ";
    public static $filtroActivo = " recibo_contacto_animador.ACTIVO = 'SI' ";
    public static $filtroSR = " AND animador.ID_SUBRECEPTOR = ";    
    public static $filtroGestor = " AND subreceptores.ID_GESTOR = ";

    public static function todos() {
        $query = self::$sqlBase . " WHERE recibo_contacto_animador.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($idRecibo) {
        $query = self::$sqlBase . " where recibo_contacto_animador.ID_CONTACTOANIMADOR = '" . $idRecibo . "' AND recibo_contacto_animador.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datos_por_codPemar($codPemar) {
        $query = self::$sqlBase . " where pemar.CODIGO_UNICO_PERSONA = '" . $codPemar . "' AND recibo_contacto_animador.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_cedPemar($cedPemar) {
        $query = self::$sqlBase . " where pemar.CI_POBLACION = '" . $cedPemar . "' AND recibo_contacto_animador.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function ultimoRecibo() {
        $query = " Select NO_RECIBO_CONTACTOANIMADOR from recibo_contacto_animador
            where recibo_contacto_animador.ACTIVO = 'SI' order by ID_CONTACTOANIMADOR DESC";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->NO_RECIBO_CONTACTOANIMADOR;
        }
        return 0;
    }

    public static function insertar(
    $NO_RECIBO_CONTACTOANIMADOR, $CODIGO_SUBRECEPTOR_CONTACTOANIMADOR, $TIPO_FORMATO_CONTACTOANIMADOR, $HORA_CONTACTOANIMADOR, $DIA_CONTACTOANIMADOR, $MES_CONTACTOANIMADOR, $ANO_CONTACTOANIMADOR, $ID_CIUDAD, $ID_PROVINCIA, $ID_TIPO_LUGAR, $ID_LUGAR, $ID_PROMOTOR, $ID_TEMA, $PRIMER_NOMBRE_PEMAR, $SEGUNDO_NOMBRE_PEMAR, $PRIMER_APELLIDO_PEMAR, $SEGUNDO_APELLIDO_PEMAR, $OTRO_NOMBRE_PEMAR, $CEDULA_PEMAR, $TELEFONO_PEMAR, $VERIFICADO_PEMAR, $FECHA_ATENCION_CONTACTOANIMADOR, $HORA_ATENCION_CONTACTOANIMADOR, $ID_CENTRO_SALUD, $ID_SERVICIO_SALUD, $OBSERVACIONES_CONTACTOANIMADOR, $ID_PEMAR, $TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR
    ) {


        $query = "INSERT INTO recibo_contacto_animador (                    
                    NO_RECIBO_CONTACTOANIMADOR,
                    CODIGO_SUBRECEPTOR_CONTACTOANIMADOR,
                    TIPO_FORMATO_CONTACTOANIMADOR,
                    HORA_CONTACTOANIMADOR,
                    DIA_CONTACTOANIMADOR,
                    MES_CONTACTOANIMADOR,
                    ANO_CONTACTOANIMADOR,
                    ID_CIUDAD,
                    ID_PROVINCIA,
                    ID_TIPO_LUGAR,
                    ID_LUGAR,
                    ID_TEMA,
                    PRIMER_NOMBRE_PEMAR,
                    SEGUNDO_NOMBRE_PEMAR,
                    PRIMER_APELLIDO_PEMAR,
                    SEGUNDO_APELLIDO_PEMAR,
                    OTRO_NOMBRE_PEMAR,
                    CEDULA_PEMAR,
                    TELEFONO_PEMAR,
                    VERIFICADO_PEMAR,
                    FECHA_ATENCION_CONTACTOANIMADOR,
                    ID_PROMOTOR,
                    HORA_ATENCION_CONTACTOANIMADOR,
                    ID_CENTRO_SALUD,
                    ID_SERVICIO_SALUD,
                    OBSERVACIONES_CONTACTOANIMADOR,
                    ID_PEMAR,                    
                    TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR,
                    ID_DIGITADOR
                  ) VALUES (
                '" . $NO_RECIBO_CONTACTOANIMADOR . "', 
                '" . $CODIGO_SUBRECEPTOR_CONTACTOANIMADOR . "', 
                '" . $TIPO_FORMATO_CONTACTOANIMADOR . "', 
                '" . $HORA_CONTACTOANIMADOR . "', 
                '" . $DIA_CONTACTOANIMADOR . "', 
                '" . $MES_CONTACTOANIMADOR . "', 
                '" . $ANO_CONTACTOANIMADOR . "', 
                " . $ID_CIUDAD . ", 
                " . $ID_PROVINCIA . ", 
                " . $ID_TIPO_LUGAR . ", 
                " . $ID_LUGAR . ", 
                " . $ID_TEMA . ", 
                    
                '" . $PRIMER_NOMBRE_PEMAR . "',
                '" . $SEGUNDO_NOMBRE_PEMAR . "',
                '" . $PRIMER_APELLIDO_PEMAR . "',
                '" . $SEGUNDO_APELLIDO_PEMAR . "',
                '" . $OTRO_NOMBRE_PEMAR . "',
                '" . $CEDULA_PEMAR . "',
                '" . $TELEFONO_PEMAR . "',
                '" . $VERIFICADO_PEMAR . "',

                " . ($FECHA_ATENCION_CONTACTOANIMADOR == "" ? "NULL" : "'" . $FECHA_ATENCION_CONTACTOANIMADOR . "'") . ",
                " . $ID_PROMOTOR . ", 
                '" . $HORA_ATENCION_CONTACTOANIMADOR . "', 
                " . ($ID_CENTRO_SALUD == "" ? "NULL" : "" . $ID_CENTRO_SALUD . "") . ",
                " . ($ID_SERVICIO_SALUD == "" ? "NULL" : "" . $ID_SERVICIO_SALUD . "") . ", 
                '" . $OBSERVACIONES_CONTACTOANIMADOR . "', 
                " . $ID_PEMAR . ", 
                '" . $TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR . "',
                " . $_SESSION['SESION_USUARIO']->ID_PERSONA . "
            )";
        return self::crear_ultimo_id($query);
    }

    public static function guardar_cantidad_condones($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
                INSERT INTO recibo_contacto_insumo_entregado
            (ID_CONTACTOANIMADOR,
             ID_INSUMO,
             CANTIDAD)
                values ('" . $ID_RECIBOANIMADOR . "', 1," . $cantidad . ")";
        return self::crear_ultimo_id($query);
    }

    public static function guardar_cantidad_lubricantes($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
                INSERT INTO recibo_contacto_insumo_entregado
            (ID_CONTACTOANIMADOR,
             ID_INSUMO,
             CANTIDAD) 
                values ('" . $ID_RECIBOANIMADOR . "',2," . $cantidad . ")";
        return self::crear_ultimo_id($query);
    }

    public static function guardar_cantidad_folletos($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
                INSERT INTO recibo_contacto_insumo_entregado
            (ID_CONTACTOANIMADOR,
             ID_INSUMO,
             CANTIDAD) 
                values ('" . $ID_RECIBOANIMADOR . "',3," . $cantidad . ")";
        return self::crear_ultimo_id($query);
    }

    public static function update($ID_CONTACTOANIMADOR, $NO_RECIBO_CONTACTOANIMADOR, $CODIGO_SUBRECEPTOR_CONTACTOANIMADOR, $TIPO_FORMATO_CONTACTOANIMADOR, $HORA_CONTACTOANIMADOR, $DIA_CONTACTOANIMADOR, $MES_CONTACTOANIMADOR, $ANO_CONTACTOANIMADOR, $ID_CIUDAD, $ID_PROVINCIA, $ID_TIPO_LUGAR, $ID_LUGAR, $ID_PROMOTOR, $ID_TEMA, $PRIMER_NOMBRE_PEMAR, $SEGUNDO_NOMBRE_PEMAR, $PRIMER_APELLIDO_PEMAR, $SEGUNDO_APELLIDO_PEMAR, $OTRO_NOMBRE_PEMAR, $CEDULA_PEMAR, $TELEFONO_PEMAR, $VERIFICADO_PEMAR, $FECHA_ATENCION_CONTACTOANIMADOR, $HORA_ATENCION_CONTACTOANIMADOR, $ID_CENTRO_SALUD, $ID_SERVICIO_SALUD, $OBSERVACIONES_CONTACTOANIMADOR, $ID_PEMAR, $TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR
    ) {

       $query = "UPDATE recibo_contacto_animador SET NO_RECIBO_CONTACTOANIMADOR = '" . $NO_RECIBO_CONTACTOANIMADOR . "' , 
                    CODIGO_SUBRECEPTOR_CONTACTOANIMADOR = '" . $CODIGO_SUBRECEPTOR_CONTACTOANIMADOR . "' , 
                    TIPO_FORMATO_CONTACTOANIMADOR = '" . $TIPO_FORMATO_CONTACTOANIMADOR . "' , 
                    HORA_CONTACTOANIMADOR = '" . $HORA_CONTACTOANIMADOR . "' , 
                    DIA_CONTACTOANIMADOR = '" . $DIA_CONTACTOANIMADOR . "' , 
                    MES_CONTACTOANIMADOR = '" . $MES_CONTACTOANIMADOR . "' , 
                    ANO_CONTACTOANIMADOR = '" . $ANO_CONTACTOANIMADOR . "' , 
                    ID_CIUDAD = " . $ID_CIUDAD . " , 
                    ID_PROVINCIA = " . $ID_PROVINCIA . " , 
                    ID_TIPO_LUGAR = " . $ID_TIPO_LUGAR . " , 
                    ID_LUGAR = " . $ID_LUGAR . " , 
                    ID_PROMOTOR = " . $ID_PROMOTOR . " , 
                    ID_TEMA = " . $ID_TEMA . " , 
                        
 
               PRIMER_NOMBRE_PEMAR = '" . $PRIMER_NOMBRE_PEMAR . "',
               SEGUNDO_NOMBRE_PEMAR = '" . $SEGUNDO_NOMBRE_PEMAR . "',
               PRIMER_APELLIDO_PEMAR = '" . $PRIMER_APELLIDO_PEMAR . "',
               SEGUNDO_APELLIDO_PEMAR = '" . $SEGUNDO_APELLIDO_PEMAR . "',
               OTRO_NOMBRE_PEMAR = '" . $OTRO_NOMBRE_PEMAR . "',
               CEDULA_PEMAR = '" . $CEDULA_PEMAR . "',
               TELEFONO_PEMAR = '" . $TELEFONO_PEMAR . "',
               VERIFICADO_PEMAR = '" . $VERIFICADO_PEMAR . "',

                    FECHA_ATENCION_CONTACTOANIMADOR = '" . $FECHA_ATENCION_CONTACTOANIMADOR . "' , 
                    HORA_ATENCION_CONTACTOANIMADOR = '" . $HORA_ATENCION_CONTACTOANIMADOR . "' , 
                    ID_CENTRO_SALUD = " . $ID_CENTRO_SALUD . " , 
                    ID_SERVICIO_SALUD = " . $ID_SERVICIO_SALUD . " , 
                    OBSERVACIONES_CONTACTOANIMADOR = '" . $OBSERVACIONES_CONTACTOANIMADOR . "' , 
                    ID_PEMAR = " . $ID_PEMAR . " , 
                    FECHA_MODIFICACION = CURRENT_TIMESTAMP , 
                    TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR = '" . $TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR . "',
                    ID_MODIFICA =  " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " 
        WHERE ID_CONTACTOANIMADOR = $ID_CONTACTOANIMADOR ";
        return self::modificarRegistros($query);
    }

    public static function update_cantidad_condones($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
             UPDATE recibo_contacto_insumo_entregado
SET
  ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR',
  CANTIDAD = $cantidad
WHERE ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR' AND ID_INSUMO = 1 ";
        return self::modificarRegistros($query);
    }

    public static function update_cantidad_lubricantes($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
        UPDATE recibo_contacto_insumo_entregado
        SET
          ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR',
          CANTIDAD = $cantidad
        WHERE ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR' AND ID_INSUMO = 2 ";
        return self::modificarRegistros($query);
    }

    public static function update_cantidad_folletos($ID_RECIBOANIMADOR, $cantidad) {
        $query = "            
             UPDATE recibo_contacto_insumo_entregado
SET
  ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR', 
  CANTIDAD = $cantidad
WHERE ID_CONTACTOANIMADOR = '$ID_RECIBOANIMADOR' AND  ID_INSUMO = 3 ";
        return self::modificarRegistros($query);
    }

    public static function validar_codigo($CODIGO_GENERADO) {
        $query = "select ID_POBLACION from pemar where CODIGO_UNICO_PERSONA = '" . $CODIGO_GENERADO . "'  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_POBLACION;
        }
        return 0;
    }

    public static function eliminar($id) {
        $query = " update recibo_contacto_animador set 
            ACTIVO = 'NO' , 
            FECHA_ELIMINACION = CURRENT_TIMESTAMP,
            ID_ELIMINA = '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "'
            where ID_CONTACTOANIMADOR='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function condones_entregados($ID_CONTACTO_ANIMADOR) {
        $query = " 
               select
                ID_CONTACTOANIMADOR,
                ID_INSUMO,
                CANTIDAD
                from recibo_contacto_insumo_entregado
                    WHERE ID_CONTACTOANIMADOR = " . $ID_CONTACTO_ANIMADOR . " AND ID_INSUMO = 1 
            ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function lubricantes_entregados($ID_CONTACTO_ANIMADOR) {
        $query = " 
               select
                ID_CONTACTOANIMADOR,
                ID_INSUMO,
                CANTIDAD
                from recibo_contacto_insumo_entregado
                WHERE ID_CONTACTOANIMADOR = " . $ID_CONTACTO_ANIMADOR . " AND ID_INSUMO = 2 
        ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function folletos_entregados($ID_CONTACTO_ANIMADOR) {
        $query = " 
             select
                ID_CONTACTOANIMADOR,
                ID_INSUMO,
                CANTIDAD
                from recibo_contacto_insumo_entregado
                WHERE ID_CONTACTOANIMADOR = " . $ID_CONTACTO_ANIMADOR . " AND ID_INSUMO = 3 
        ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function mostrar_datos_recibo_contacto_animador($ID_CONTACTOANIMADOR) {

        $query = self::$sqlBase . " where ID_CONTACTOANIMADOR='" . $ID_CONTACTOANIMADOR . "'  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    
    
    
    
    
    public static function todos_pendientesRevisionRevisado() {


        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' OR recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' OR recibo_contacto_animador.ESTADO_REVISION = 'REVISADO' ) ";
       $query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function todos_pendientesRevision() {


        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' OR recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_periodo() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . "  ";
        $query .= self::restricciones_recibo_contacto();
        $query .= ' , recibo_contacto_animador.ESTADO_REVISION DESC ';

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    
    
    
    public static function cinco_porciento_pendientes_HSH($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' ) AND recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'HSH' ";
        $query .= self::restricciones_recibo_contacto();
        $query .=  ", RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TS($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE' ) AND recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TS'  ";
        $query .= self::restricciones_recibo_contacto();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TRANS($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE'  ) AND recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'TRANS' ";
$query .= self::restricciones_recibo_contacto();
        $query .=  " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_PVVS($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'PENDIENTE'  ) AND recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = 'PVVS' ";
$query .= self::restricciones_recibo_contacto();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisado() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisado_numero() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function cinco_porciento_revisados_HSH($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO') AND pemar.ID_TIPOPOBLACION = 1 ";
        $query .= self::restricciones_recibo_contacto();
        $query .=  "  ORDER BY RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TS($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO') AND pemar.ID_TIPOPOBLACION = 2 ";
$query .= self::restricciones_recibo_contacto();
        $query .=  "  ORDER BY RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TRANS($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO' ) AND pemar.ID_TIPOPOBLACION = 3 ";
$query .= self::restricciones_recibo_contacto();
        $query .=   "  ORDER BY RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_aprobado() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO ) . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_aprobado_numero() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_revisionRevisado() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'REVISADO' OR recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revision() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revision_numero() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' ) ";
$query .= self::restricciones_recibo_contacto();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }
    
    public static function todos_gestion() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO );        
        $query .= self::restricciones_recibo_contacto();
        
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revision($limit) {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( recibo_contacto_animador.ESTADO_REVISION = 'EN REVISION' ) ";
$query .= self::restricciones_recibo_contacto();
        $query .= "  ORDER BY RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    
    
    
    
    
    public static function update_estado_revision($id, $estado, $tipoRevision = '') {
        $query = "UPDATE recibo_contacto_animador SET "
                . "ESTADO_REVISION = '" . $estado . "',  TIPO_REVISION = '" . $tipoRevision . "', "
                . "ID_MONITOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_CONTACTOANIMADOR = " . $id;
        return self::modificarRegistros($query);
    }

    public static function update_estado_aprobacion($id, $estado, $tipoRevision = '') {
        $query = "UPDATE recibo_contacto_animador SET "
                . "ESTADO_REVISION = '" . $estado . "',  TIPO_REVISION = '" . $tipoRevision . "', "
                . "ID_SUPERVISOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_CONTACTOANIMADOR = " . $id;
        return self::modificarRegistros($query);
    }

    public static function total_numero_estado_revision() {
        $consulta = NULL;
        $consulta->TOTAL_PENDIENTES = ReciboContactoAnimadorModel::todos_pendientes_numero();
        $consulta->TOTAL_ENREVISION = ReciboContactoAnimadorModel::todos_revision_numero();
        $consulta->TOTAL_REVISADOS = ReciboContactoAnimadorModel::todos_revisado_numero();
        $consulta->TOTAL_APROBADOS = ReciboContactoAnimadorModel::todos_aprobado_numero();

        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    } 

    public static function restricciones_recibo_contacto() {
        $query = "";
        if (Usuario::tiene_restricciones() and ! Usuario::esGestor()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }
        if (Usuario::esGestor()) {
            $query .= self::$filtroGestor . " " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " ";
        }
        return $query .= self::$sqlGroup;
    }    
    
}
