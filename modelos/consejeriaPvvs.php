<?php

class ConsejeriaPvvsModel extends ModelBase {

    public static $sqlBase = "
           SELECT
                cantones.*
                , provincias.*
                , lugares_consejeria.*
                , pemar.*
                , centros_servicios_salud.*
                , consejero.*
                , subreceptores.*
                , consejero.NOMBRE_REAL_PERSONA AS NOMBRE_CONSEJERO
                , monitor.`NOMBRE_REAL_PERSONA` AS NOMBRE_MONITOR
                , coordinador.`NOMBRE_REAL_PERSONA` AS NOMBRE_COORDINADOR
                , digitador.`NOMBRE_REAL_PERSONA` AS NOMBRE_DIGITADOR
                , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
                , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
                , consejeria_pvvs.FECHA_CREACION AS FECHA_CREACION_CONSEJERIA
                , consejeria_pvvs.FECHA_MODIFICACION AS FECHA_MODIFICACION_CONSEJERIA
                , consejeria_pvvs.FECHA_ELIMINACION AS FECHA_ELIMINACION_CONSEJERIA
                , consejeria_pvvs.*
                ,(SELECT consejeria_pvvs_insumos.CANTIDAD FROM consejeria_pvvs_insumos WHERE consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS = consejeria_pvvs.ID_CONSEJERIA_PVVS AND ID_INSUMO = 1  ) AS NUM_CONDONES
                ,(SELECT consejeria_pvvs_insumos.CANTIDAD FROM consejeria_pvvs_insumos WHERE consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS = consejeria_pvvs.ID_CONSEJERIA_PVVS AND ID_INSUMO = 2  ) AS NUM_LUBRICANTES
                ,(SELECT consejeria_pvvs_insumos.CANTIDAD FROM consejeria_pvvs_insumos WHERE consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS = consejeria_pvvs.ID_CONSEJERIA_PVVS AND ID_INSUMO = 6  ) AS NUM_PASTILLEROS
                ,(SELECT consejeria_pvvs_insumos.CANTIDAD FROM consejeria_pvvs_insumos WHERE consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS = consejeria_pvvs.ID_CONSEJERIA_PVVS AND ID_INSUMO = 15  ) AS NUM_MATERIAL_IEC
                
            FROM
                consejeria_pvvs
                INNER JOIN cantones 
                    ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
                INNER JOIN provincias 
                    ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
                INNER JOIN lugares_consejeria 
                    ON (consejeria_pvvs.ID_LUGAR_CONSEJERIA = lugares_consejeria.ID_LUGAR_CONSEJERIA)
                INNER JOIN pemar 
                    ON (consejeria_pvvs.ID_PEMAR = pemar.ID_POBLACION)
                INNER JOIN centros_servicios_salud 
                    ON (consejeria_pvvs.ID_CENTRO_SERVICIO = centros_servicios_salud.ID_CENTROSERVICIO)
                LEFT JOIN personas_sistema AS consejero
                    ON (consejeria_pvvs.ID_CONSEJERO = consejero.ID_PERSONA)
                LEFT JOIN subreceptores 
                    ON (consejero.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
                LEFT JOIN personas_sistema AS monitor
                    ON (consejeria_pvvs.ID_MONITOR = monitor.ID_PERSONA)
                LEFT JOIN personas_sistema AS coordinador
                    ON (consejeria_pvvs.ID_SUPERVISOR = coordinador.ID_PERSONA)
                LEFT JOIN personas_sistema AS digitador
                    ON (consejeria_pvvs.ID_DIGITADOR = digitador.ID_PERSONA)
                LEFT JOIN personas_sistema AS modifica
                    ON (consejeria_pvvs.ID_MODIFICA = modifica.ID_PERSONA)
                LEFT JOIN personas_sistema AS elimina
                    ON (consejeria_pvvs.ID_ELIMINA = elimina.ID_PERSONA)
                   ";
    public static $sqlGroup = " ORDER BY consejeria_pvvs.FECHA_CREACION DESC ";
    public static $filtroPeriodo = " INNER JOIN periodos ON ( consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d ) ";
    public static $filtroActivo = " consejeria_pvvs.ACTIVO = 'SI' ";
    public static $filtroSR = " AND consejero.ID_SUBRECEPTOR = ";
    public static $filtroGestor = " AND subreceptores.ID_GESTOR = ";

    public static function todos() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_codPemar($codPemar) {
        $query = self::$sqlBase . " WHERE  pemar.CODIGO_UNICO_PERSONA = '" . $codPemar . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_cedPemar($cedPemar) {
        $query = self::$sqlBase . " WHERE  pemar.CI_POBLACION = '" . $cedPemar . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function eliminar($id) {
        $query = " update consejeria_pvvs set 
            ACTIVO = 'NO' , 
            FECHA_ELIMINACION = CURRENT_TIMESTAMP,
            ID_ELIMINA = '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "'
            where ID_CONSEJERIA_PVVS='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function mostrar_datos_consejeria_pvvs($ID_CONSEJERIA_PVVS) {

        $query = self::$sqlBase . " WHERE ID_CONSEJERIA_PVVS='" . $ID_CONSEJERIA_PVVS .
                "' AND consejeria_pvvs.ACTIVO='SI'   ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function update($ID_CONSEJERIA_PVVS, $ID_CANTON, $FECHA_CONSEJERIA, $ID_PEMAR, $HORA_INICIO, $HORA_FIN, $PRIMER_NOMBRE_PEMAR, $SEGUNDO_NOMBRE_PEMAR, $PRIMER_APELLIDO_PEMAR, $SEGUNDO_APELLIDO_PEMAR, $CEDULA_PEMAR, $TELEFONO_PEMAR, $VERIFICADO_PEMAR, $SEXO_PERSONA, $EDAD, $TRATAMIENTO_ARV, $ID_ESQUEMA_ARV, $TIEMPO_SABE_DIAGNOSTICO, $ID_TIPO_LUGAR, $OBSERVACIONES, $REFERENCIA, $ID_CONSEJERO, $ID_CENTRO_SERVICIO, $TIPO_ALCANCE_CONSEJERIA_PVVS) {

        $query = "
            UPDATE 
                consejeria_pvvs 
              SET
                ID_CANTON = '" . $ID_CANTON . "',
                FECHA_CONSEJERIA = '" . $FECHA_CONSEJERIA . "',
                ID_PEMAR = '" . $ID_PEMAR . "',
                HORA_INICIO = '" . $HORA_INICIO . "',
                HORA_FIN = '" . $HORA_FIN . "',
                PRIMER_NOMBRE_PEMAR = '" . $PRIMER_NOMBRE_PEMAR . "',
                SEGUNDO_NOMBRE_PEMAR = '" . $SEGUNDO_NOMBRE_PEMAR . "',
                PRIMER_APELLIDO_PEMAR = '" . $PRIMER_APELLIDO_PEMAR . "',
                SEGUNDO_APELLIDO_PEMAR = '" . $SEGUNDO_APELLIDO_PEMAR . "',
                CEDULA_PEMAR = '" . $CEDULA_PEMAR . "',
                TELEFONO_PEMAR = '" . $TELEFONO_PEMAR . "',
                VERIFICADO_PEMAR = '" . $VERIFICADO_PEMAR . "',
                SEXO_PERSONA = '" . $SEXO_PERSONA . "',
                EDAD = '" . $EDAD . "',
                TRATAMIENTO_ARV = '" . $TRATAMIENTO_ARV . "',
                ID_ESQUEMA_ARV = " . ($ID_ESQUEMA_ARV == "" ? 'NULL' : $ID_ESQUEMA_ARV) . ",
                TIEMPO_SABE_DIAGNOSTICO = '" . $TIEMPO_SABE_DIAGNOSTICO . "',
                ID_LUGAR_CONSEJERIA = '" . $ID_TIPO_LUGAR . "',
                OBSERVACIONES = '" . $OBSERVACIONES . "',
                REFERENCIA = '" . $REFERENCIA . "',
                ID_CONSEJERO = '" . $ID_CONSEJERO . "',
                ID_CENTRO_SERVICIO = '" . $ID_CENTRO_SERVICIO . "',
                TIPO_ALCANCE_CONSEJERIA_PVVS = 'TIPO_ALCANCE_CONSEJERIA_PVVS',
                FECHA_MODIFICACION = CURRENT_TIMESTAMP,
                ID_MODIFICA = '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "' 
              WHERE ID_CONSEJERIA_PVVS = '" . $ID_CONSEJERIA_PVVS . "' ";

        return self::modificarRegistros($query);
    }

    public static function insertar($ID_CANTON, $FECHA_CONSEJERIA, $ID_PEMAR, $HORA_INICIO, $HORA_FIN, $PRIMER_NOMBRE_PEMAR, $SEGUNDO_NOMBRE_PEMAR, $PRIMER_APELLIDO_PEMAR, $SEGUNDO_APELLIDO_PEMAR, $CEDULA_PEMAR, $TELEFONO_PEMAR, $VERIFICADO_PEMAR, $SEXO_PERSONA, $EDAD, $TRATAMIENTO_ARV, $ID_ESQUEMA_ARV, $TIEMPO_SABE_DIAGNOSTICO, $ID_TIPO_LUGAR, $OBSERVACIONES, $REFERENCIA, $ID_CONSEJERO, $ID_CENTRO_SERVICIO, $TIPO_ALCANCE_CONSEJERIA_PVVS) {
        $query = "INSERT INTO consejeria_pvvs (
                ID_CANTON,  FECHA_CONSEJERIA,  ID_PEMAR,HORA_INICIO,HORA_FIN,
                PRIMER_NOMBRE_PEMAR,  SEGUNDO_NOMBRE_PEMAR,  PRIMER_APELLIDO_PEMAR,  SEGUNDO_APELLIDO_PEMAR,  
                CEDULA_PEMAR, TELEFONO_PEMAR,  VERIFICADO_PEMAR,  SEXO_PERSONA,  EDAD,
                TRATAMIENTO_ARV,  ID_ESQUEMA_ARV,  TIEMPO_SABE_DIAGNOSTICO,  ID_LUGAR_CONSEJERIA,  
                OBSERVACIONES,  REFERENCIA,  ID_CONSEJERO,  ID_CENTRO_SERVICIO,  TIPO_ALCANCE_CONSEJERIA_PVVS,  ID_DIGITADOR
            ) values (
                '" . $ID_CANTON . "', '" . $FECHA_CONSEJERIA . "', '" . $ID_PEMAR . "', '" . $HORA_INICIO . "', '" . $HORA_FIN . "'
               ,'" . $PRIMER_NOMBRE_PEMAR . "', '" . $SEGUNDO_NOMBRE_PEMAR . "', '" . $PRIMER_APELLIDO_PEMAR . "', '" . $SEGUNDO_APELLIDO_PEMAR . "'                
               ,'" . $CEDULA_PEMAR . "' ,'" . $TELEFONO_PEMAR . "', '" . $VERIFICADO_PEMAR . "', '" . $SEXO_PERSONA . "', '" . $EDAD . "'
               , '" . $TRATAMIENTO_ARV . "', " . ($ID_ESQUEMA_ARV == "" ? 'NULL' : $ID_ESQUEMA_ARV) . ", '" . $TIEMPO_SABE_DIAGNOSTICO . "', '" . $ID_TIPO_LUGAR . "', "
                . "'" . $OBSERVACIONES . "', '" . $REFERENCIA . "', '" . $ID_CONSEJERO . "', '" . $ID_CENTRO_SERVICIO . "', "
                . "'" . $TIPO_ALCANCE_CONSEJERIA_PVVS . "', '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "')";
        return self::crear_ultimo_id($query);
    }

    public static function cambiar_cantidad_condones($ID_CONSEJERIA_PVVS, $CANTIDAD) {
        $query = "            
                UPDATE consejeria_pvvs_insumos
                SET CANTIDAD = '" . $CANTIDAD . "' WHERE ID_CONSEJERIA_PVVS = '" .
                $ID_CONSEJERIA_PVVS . "'
                AND ID_INSUMO = 1    
                ";
        return self::modificarRegistros($query);
    }

    public static function guardar_cantidad_condones($id_consejeria, $cantidad) {
        $query = "            
                insert into consejeria_pvvs_insumos(ID_CONSEJERIA_PVVS,
             ID_INSUMO,CANTIDAD) 
                values (" . $id_consejeria . ", 1,'" . $cantidad . "')";
        return self::crear_ultimo_id($query);
    }

    public static function cambiar_cantidad_lubricantes($ID_CONSEJERIA_PVVS, $CANTIDAD) {
        $query = "            
                UPDATE consejeria_pvvs_insumos
                SET CANTIDAD = '" . $CANTIDAD . "' WHERE ID_CONSEJERIA_PVVS = '" .
                $ID_CONSEJERIA_PVVS . "'
                AND ID_INSUMO = 2    
                ";
        return self::modificarRegistros($query);
    }

    public static function guardar_cantidad_lubricantes($id_consejeria, $cantidad) {
        $query = "            
                insert into consejeria_pvvs_insumos(ID_CONSEJERIA_PVVS,
             ID_INSUMO,CANTIDAD) 
                values ('" . $id_consejeria . "','2','" . $cantidad . "')";
        return self::crear_ultimo_id($query);
    }

    public static function cambiar_cantidad_pastilleros($ID_CONSEJERIA_PVVS, $CANTIDAD) {
        $query = "            
                UPDATE consejeria_pvvs_insumos
                SET CANTIDAD = '" . $CANTIDAD . "' WHERE ID_CONSEJERIA_PVVS = '" .
                $ID_CONSEJERIA_PVVS . "'
                AND ID_INSUMO = 6    
                ";
        return self::modificarRegistros($query);
    }

    public static function guardar_cantidad_pastilleros($id_consejeria, $cantidad) {
        $query = "            
                insert into consejeria_pvvs_insumos(ID_CONSEJERIA_PVVS,
             ID_INSUMO,CANTIDAD) 
                values ('" . $id_consejeria . "','6','" . $cantidad . "')";
        return self::crear_ultimo_id($query);
    }

    public static function cambiar_cantidad_material_iec($ID_CONSEJERIA_PVVS, $CANTIDAD) {
        $query = "            
                UPDATE consejeria_pvvs_insumos
                SET CANTIDAD = '" . $CANTIDAD . "' WHERE ID_CONSEJERIA_PVVS = '" .
                $ID_CONSEJERIA_PVVS . "'
                AND ID_INSUMO = 15    
                ";
        return self::modificarRegistros($query);
    }

    public static function guardar_cantidad_material_iec($id_consejeria, $cantidad) {
        $query = "INSERT INTO consejeria_pvvs_insumos(ID_CONSEJERIA_PVVS,
             ID_INSUMO,CANTIDAD ) values ('" . $id_consejeria . "','15','" . $cantidad . "')";
        return self::crear_ultimo_id($query);
    }

    public static function condones_entregados($ID_CONSEJERIA_PVVS) {
        $query = " SELECT * FROM consejeria_pvvs_insumos
                    WHERE ID_CONSEJERIA_PVVS = " . $ID_CONSEJERIA_PVVS . " AND ID_INSUMO = 1 ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function lubricantes_entregados($ID_CONSEJERIA_PVVS) {
        $query = " 
            SELECT * FROM consejeria_pvvs_insumos
                WHERE ID_CONSEJERIA_PVVS = " . $ID_CONSEJERIA_PVVS .
                " AND ID_INSUMO = 2 
        ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function pastilleros_entregados($ID_CONSEJERIA_PVVS) {
        $query = " 
            SELECT * FROM consejeria_pvvs_insumos
                WHERE ID_CONSEJERIA_PVVS = " . $ID_CONSEJERIA_PVVS .
                " AND ID_INSUMO = 6 
        ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function material_iec_entregados($ID_CONSEJERIA_PVVS) {
        $query = " 
            SELECT * FROM consejeria_pvvs_insumos
                WHERE ID_CONSEJERIA_PVVS = " . $ID_CONSEJERIA_PVVS .
                " AND ID_INSUMO = 15 
        ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_HSH($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE') AND pemar.ID_TIPOPOBLACION = 1";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE') AND pemar.ID_TIPOPOBLACION = 2";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TRANS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE') AND pemar.ID_TIPOPOBLACION = 3 ";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_PVVS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE') AND pemar.ID_TIPOPOBLACION = 4 ";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    /*
     */

    public static function cinco_porciento_revisados_HSH($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) AND  pemar.ID_TIPOPOBLACION = 1";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) AND pemar.ID_TIPOPOBLACION = 2";
        $query .= self::restricciones_consejeria();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TRANS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) AND pemar.ID_TIPOPOBLACION = 3 ";
        $query .= self::restricciones_consejeria();
        $query .= "  , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientesRevisionRevisado() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE' OR consejeria_pvvs.ESTADO_REVISION = 'EN REVISION' OR consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientesRevision() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE' OR consejeria_pvvs.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_revision() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_consejeria();
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisionRevisado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'EN REVISION' OR consejeria_pvvs.ESTADO_REVISION = 'REVISADO'  ) ";
        $query .= self::restricciones_consejeria();
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_periodo() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . "  ";
        $query .= self::restricciones_consejeria();
        $query .= ' , consejeria_pvvs.ESTADO_REVISION DESC';
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revision_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_aprobado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . "  WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_aprobado_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_revisado() {
        $query = self::$sqlBase . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisado_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( consejeria_pvvs.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_gestion() {

        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO);
        $query .= self::restricciones_consejeria();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function update_estado_revision($id, $estado, $tipoRevision = '') {
        $query = "UPDATE consejeria_pvvs SET "
                . "ESTADO_REVISION = '" . $estado . "', TIPO_REVISION = '" . $tipoRevision . "', "
                . "ID_MONITOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_CONSEJERIA_PVVS = " . $id;
        return self::modificarRegistros($query);
    }

    public static function update_estado_aprobacion($id, $estado, $tipoRevision = '') {
        $query = "UPDATE consejeria_pvvs SET "
                . "ESTADO_REVISION = '" . $estado . "', TIPO_REVISION = '" . $tipoRevision . "',   "
                . "ID_SUPERVISOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_CONSEJERIA_PVVS = " . $id;
        return self::modificarRegistros($query);
    }

    public static function total_numero_estado_revision() {
        $consulta = NULL;
        $consulta->TOTAL_PENDIENTES = ConsejeriaPvvsModel::todos_pendientes_numero();
        $consulta->TOTAL_ENREVISION = ConsejeriaPvvsModel::todos_revision_numero();
        $consulta->TOTAL_REVISADOS = ConsejeriaPvvsModel::todos_revisado_numero();
        $consulta->TOTAL_APROBADOS = ConsejeriaPvvsModel::todos_aprobado_numero();

        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function restricciones_consejeria() {
        $query = "";
        if (Usuario::tiene_restricciones() and ! Usuario::esGestor()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }
        if (Usuario::esGestor()) {
            $query .= self::$filtroGestor . " " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " ";
        }
        return $query .= self::$sqlGroup;
    }



    public static function consejerias_filtros_informes($idConsejero, $periodo = "", $provincia = "", $canton = "") {

        $filtro = ' where ';

        if ($canton != "") {
            $filtro .= " consejeria_pvvs.ID_CANTON = " . $canton . " and";
        } else if ($provincia != "") {
            $filtro .= " cantones.ID_PROVINCIA = " . $provincia . " and";
        }

        $filtro .= " consejeria_pvvs.ID_CONSEJERO = " . $idConsejero . " and";

        //$filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";

        $filtro .= " consejeria_pvvs.ACTIVO = 'SI' ";

        //echo self::$sqlBase . sprintf(self::$filtroPeriodo, $periodo)  . $filtro;

        $consulta = self::consulta( self::$sqlBase . sprintf(self::$filtroPeriodo, $periodo)   . $filtro);
        if (count($consulta) > 0) {
            return $consulta;
        }
    }


}
