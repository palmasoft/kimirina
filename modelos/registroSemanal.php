<?php

class RegistroSemanalModel extends ModelBase {

    public static $sqlBase = " 
       SELECT 
        registro_semanal.*,
        provincias.* ,        
        cantones.*,
        promotor.*,
        subreceptores.*,
        digitador.`NOMBRE_REAL_PERSONA` AS NOMBRE_DIGITADOR,
        monitor.`NOMBRE_REAL_PERSONA` AS NOMBRE_MONITOR,
        supervisor.`NOMBRE_REAL_PERSONA` AS NOMBRE_COORDINADOR,
        modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA,
        elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA,
        registro_semanal.FECHA_CREACION AS FECHA_CREACION_REGISTRO_SEMANAL,
        registro_semanal.FECHA_MODIFICACION AS FECHA_MODIFICACION_REGISTRO_SEMANAL,
        registro_semanal.FECHA_ELIMINACION AS FECHA_ELIMINACION_REGISTRO_SEMANAL,
        (SELECT COUNT(registro_semanal_contacto.ID_REGISTRO_CONTACTO ) FROM registro_semanal_contacto 
          INNER JOIN registro_semanal AS r_s ON ( registro_semanal_contacto.ID_REGISTROSEMANAL = r_s.ID_REGISTROSEMANAL ) 
        WHERE registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL) AS CONTACTOS 
      FROM
        registro_semanal 
        INNER JOIN provincias 
          ON (
            registro_semanal.ID_PROVINCIA = provincias.ID_PROVINCIA
          ) 
        INNER JOIN cantones 
          ON (
            registro_semanal.ID_CANTON = cantones.ID_CANTON
          ) 
        INNER JOIN personas_sistema AS promotor 
          ON (
            registro_semanal.ID_PROMOTOR = promotor.ID_PERSONA
          ) 
        INNER JOIN subreceptores 
          ON (
            promotor.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR
          ) 
        LEFT JOIN personas_sistema AS digitador 
          ON (
            registro_semanal.ID_DIGITADOR = digitador.ID_PERSONA
          ) 
        LEFT JOIN personas_sistema AS monitor 
          ON (
            registro_semanal.ID_MONITOR = monitor.ID_PERSONA
          ) 
        LEFT JOIN personas_sistema AS supervisor 
          ON (
            registro_semanal.ID_SUPERVISOR = supervisor.ID_PERSONA
          )
        LEFT JOIN personas_sistema AS modifica
          ON (
            registro_semanal.ID_MODIFICA = modifica.ID_PERSONA
          )          
        LEFT JOIN personas_sistema AS elimina
          ON (
            registro_semanal.ID_ELIMINA = elimina.ID_PERSONA
          )
          ";
    public static $sqlGroup = " GROUP  BY registro_semanal.ID_REGISTROSEMANAL ORDER BY registro_semanal.FECHA_CREACION DESC ";
    public static $filtroPeriodo = " INNER JOIN periodos ON (registro_semanal.SEMANA_DEL >= periodos.FECHA_MIN_PERIODO AND registro_semanal.SEMANA_HASTA <= periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d ) ";
    public static $filtroActivo = " registro_semanal.ACTIVO = 'SI' ";
    public static $filtroSR = " AND promotor.ID_SUBRECEPTOR = ";
    public static $filtroGestor = " AND subreceptores.ID_GESTOR = ";

    public static function todos() {
        $query = self::$sqlBase . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($ID_REGISTROSEMANAL) {
        $query = self::$sqlBase . " WHERE registro_semanal.ID_REGISTROSEMANAL = " . $ID_REGISTROSEMANAL . " " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function insertar(
    $ID_PROVINCIA, $ID_CANTON, $TIPO_FORMATO_REGISTROSEMANAL, $PERIODO_REGISTROSEMANAL, $SEMANA_DEL, $SEMANA_HASTA, $ID_PROMOTOR
    ) {
        $query = "insert into registro_semanal ( ID_PROVINCIA,  ID_CANTON,  TIPO_FORMATO_REGISTROSEMANAL, PERIODO_REGISTROSEMANAL, SEMANA_DEL, SEMANA_HASTA, ID_DIGITADOR,  ID_PROMOTOR ) values (
            " . $ID_PROVINCIA . ", " . $ID_CANTON . ", 
            '" . $TIPO_FORMATO_REGISTROSEMANAL . "', '" . $PERIODO_REGISTROSEMANAL . "', 
            '" . $SEMANA_DEL . "', '" . $SEMANA_HASTA . "', 
            " . $_SESSION['SESION_USUARIO']->ID_PERSONA . ",	
            '" . $ID_PROMOTOR . "'
        )";
        return self::crear_ultimo_id($query);
    }

    public static function update($ID_REGISTROSEMANAL, $ID_PROVINCIA, $ID_CANTON, $TIPO_FORMATO_REGISTROSEMANAL, $PERIODO_REGISTROSEMANAL, $SEMANA_DEL, $SEMANA_HASTA, $ID_PROMOTOR) {
        $query = "
            UPDATE registro_semanal set	
                ID_PROVINCIA = " . $ID_PROVINCIA . " , 
                ID_CANTON = " . $ID_CANTON . " , 
                TIPO_FORMATO_REGISTROSEMANAL = '" . $TIPO_FORMATO_REGISTROSEMANAL . "' , 	
                PERIODO_REGISTROSEMANAL = '" . $PERIODO_REGISTROSEMANAL . "' , 
                SEMANA_DEL = '" . $SEMANA_DEL . "' , 
                SEMANA_HASTA = '" . $SEMANA_HASTA . "' , 
                ID_PROMOTOR =  " . $ID_PROMOTOR . " , 
                ID_MODIFICA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , 
                FECHA_MODIFICACION = CURRENT_TIMESTAMP 
            WHERE
                ID_REGISTROSEMANAL = " . $ID_REGISTROSEMANAL . " ";
        return self::modificarRegistros($query);
    }

    public static function todos_pendientesRevision() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' OR registro_semanal.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientesRevisionRevisado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' OR registro_semanal.ESTADO_REVISION = 'EN REVISION'  OR registro_semanal.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisionRevisado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' OR registro_semanal.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisionRevisadoAprobado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' OR registro_semanal.ESTADO_REVISION = 'EN REVISION' OR registro_semanal.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_registro_semanal();
        $query .= ', registro_semanal.ESTADO_REVISION DESC';

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientesRevisionRevisadoAprobado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' OR  registro_semanal.ESTADO_REVISION = 'PENDIENTE' OR  registro_semanal.ESTADO_REVISION = 'EN REVISION' OR registro_semanal.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_registro_semanal();
        $query .= ' , registro_semanal.ESTADO_REVISION DESC';

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_periodo() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' OR  registro_semanal.ESTADO_REVISION = 'PENDIENTE' OR  registro_semanal.ESTADO_REVISION = 'EN REVISION' OR registro_semanal.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_registro_semanal();
        $query .= ' , registro_semanal.ESTADO_REVISION DESC';

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_HSH($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE') AND TIPO_FORMATO_REGISTROSEMANAL = 'HSH' ";
        $query .= self::restricciones_registro_semanal();
        $query .= ", RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE') AND TIPO_FORMATO_REGISTROSEMANAL = 'TS' ";
        $query .= self::restricciones_registro_semanal();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TRANS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE') AND TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' ";
        $query .= self::restricciones_registro_semanal();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_HSH($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' ) AND TIPO_FORMATO_REGISTROSEMANAL = 'HSH' ";
        $query .= self::restricciones_registro_semanal();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' ) AND TIPO_FORMATO_REGISTROSEMANAL = 'TS' ";
        $query .= self::restricciones_registro_semanal();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_revisados_TRANS($limit) {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' ) AND TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' ";
        $query .= self::restricciones_registro_semanal();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_pendientes_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_pendientes_numero_hsh() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' )  AND TIPO_FORMATO_REGISTROSEMANAL = 'HSH' ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_pendientes_numero_ts() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' )  AND TIPO_FORMATO_REGISTROSEMANAL = TS' ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_pendientes_numero_trans() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'PENDIENTE' )  AND TIPO_FORMATO_REGISTROSEMANAL = 'TRANS' ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_revision() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revision_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'EN REVISION' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_revisado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_revisado_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'REVISADO' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_aprobado() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . "  WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_aprobado_numero() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . "  WHERE " . self::$filtroActivo . " AND ( registro_semanal.ESTADO_REVISION = 'APROBADO' ) ";
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return count($consulta);
        }
        return 0;
    }

    public static function todos_gestion() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO);
        $query .= self::restricciones_registro_semanal();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function update_estado_desaprobacion($id, $tipoRevision = '') {
        $query = "UPDATE registro_semanal SET "
                . "ESTADO_REVISION = 'NO APROBADO', "
                . "TIPO_REVISION = '" . $tipoRevision . "',  "
                . "FECHA_DESAPRUEBA = CURRENT_TIMESTAMP,  "
                . "ID_DESAPRUEBA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " "
                . "WHERE ID_REGISTROSEMANAL = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function update_estado_aprobacion($id, $estado, $tipoRevision = '') {
        $query = "UPDATE registro_semanal SET "
                . "ESTADO_REVISION = '" . $estado . "', "
                . "TIPO_REVISION = '" . $tipoRevision . "',  "
                . "ID_SUPERVISOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " "
                . "WHERE ID_REGISTROSEMANAL = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function update_estado_revision($id, $estado, $tipoRevision = '') {
        $query = "UPDATE registro_semanal SET "
                . "ESTADO_REVISION = '" . $estado . "', "
                . "TIPO_REVISION = '" . $tipoRevision . "', "
                . "ID_MONITOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " "
                . "WHERE ID_REGISTROSEMANAL = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function total_numero_estado_revision() {
        $consulta = NULL;
        $consulta->TOTAL_PENDIENTES = RegistroSemanalModel::todos_pendientes_numero();
        $consulta->TOTAL_ENREVISION = RegistroSemanalModel::todos_revision_numero();
        $consulta->TOTAL_REVISADOS = RegistroSemanalModel::todos_revisado_numero();
        $consulta->TOTAL_APROBADOS = RegistroSemanalModel::todos_aprobado_numero();

        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function eliminar_hoja($id) {
        $query = "
            UPDATE registro_semanal SET
            ACTIVO = 'NO', ID_ELIMINA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . ", FECHA_ELIMINACION = CURRENT_TIMESTAMP 
            WHERE ID_REGISTROSEMANAL = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    static public function cargar_datos_tipo_formulario($tipoForm, $datos = array()) {
        $datos['tipoPoblacion'] = $tipoForm;
        switch ($tipoForm) {
            case 'HSH':
                $datos['idTipoPoblacion'] = 1;
                $datos['aliasOtroNombre'] = "";
                $datos['mensaje'] = "Formato de registro semanal de alcances con Hombres que tienen Sexo con Hombres!";
                $datos['maximoCondones'] = TiposPoblacionModel::datos(1)->MAXIMO_CONDONES;
                $datos['maximoLubricantes'] = TiposPoblacionModel::datos(1)->MAXIMO_LUBRICANTES;
                break;
            case 'TS': $datos['idTipoPoblacion'] = 2;
                $datos['aliasOtroNombre'] = "Nombre Artistico";
                $datos['mensaje'] = "Formato de registro semanal de alcances con Trabajadores(as) Sexuales!";
                $datos['maximoCondones'] = TiposPoblacionModel::datos(2)->MAXIMO_CONDONES;
                $datos['maximoLubricantes'] = TiposPoblacionModel::datos(2)->MAXIMO_LUBRICANTES;
                break;
            case 'TRANS': $datos['idTipoPoblacion'] = 3;
                $datos['aliasOtroNombre'] = "Nombre Trans";
                $datos['mensaje'] = "Formato de registro semanal de alcances con TRANS!";
                $datos['maximoCondones'] = TiposPoblacionModel::datos(3)->MAXIMO_CONDONES;
                $datos['maximoLubricantes'] = TiposPoblacionModel::datos(3)->MAXIMO_LUBRICANTES;
                break;
        }
        return $datos;
    }

    public static function restricciones_registro_semanal() {
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
