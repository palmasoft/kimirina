<?php

class registroAtencionSaludModel extends ModelBase {

    public static $sqlbase = "
       SELECT
            centros_servicios_salud.*
            , tipo_poblacion.* 
            , pemar.*
            , servicios_salud.*
            , atencion_salud.*
            , personas_sistema.*
            , subreceptores.*
            , digitador.NOMBRE_REAL_PERSONA  AS NOMBRE_DIGITADOR
            , monitor.NOMBRE_REAL_PERSONA  AS NOMBRE_MONITOR
            , coordinador.NOMBRE_REAL_PERSONA  AS NOMBRE_COORDINADOR
            , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
            , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
            , atencion_salud.FECHA_CREACION AS FECHA_CREACION_ATENCION_SALUD
            , atencion_salud.FECHA_MODIFICACION AS FECHA_MODIFICACION_ATENCION_SALUD
            , atencion_salud.FECHA_ELIMINACION AS FECHA_ELIMINACION_ATENCION_SALUD
        FROM
            atencion_salud
            INNER JOIN centros_servicios_salud 
                ON (atencion_salud.ID_CENTRO_SALUD = centros_servicios_salud.ID_CENTROSERVICIO)
            INNER JOIN tipo_poblacion 
                ON (atencion_salud.TIPO_FORMATO_ATENCION = tipo_poblacion.CODIGO_TIPOPOBLACION)
            INNER JOIN pemar 
                ON (atencion_salud.ID_PEMAR = pemar.ID_POBLACION)
            INNER JOIN servicios_salud 
                ON (atencion_salud.ID_SERVICIO_SALUD = servicios_salud.ID_SERVICIO)
            INNER JOIN subreceptores 
                ON (atencion_salud.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
            LEFT JOIN personas_sistema 
                ON (atencion_salud.ID_DIGITADOR = personas_sistema.ID_PERSONA)
            LEFT JOIN personas_sistema AS digitador
                ON (atencion_salud.ID_DIGITADOR = digitador.ID_PERSONA)
            LEFT JOIN personas_sistema AS monitor
                ON (atencion_salud.ID_MONITOR = monitor.ID_PERSONA)
            LEFT JOIN personas_sistema AS coordinador
                ON (atencion_salud.ID_SUPERVISOR = coordinador.ID_PERSONA)                 

        LEFT JOIN personas_sistema AS modifica
          ON (
            atencion_salud.ID_MODIFICA = modifica.ID_PERSONA
          )          
        LEFT JOIN personas_sistema AS elimina
          ON (
            atencion_salud.ID_ELIMINA = elimina.ID_PERSONA
          )
        ";
    public static $sqlGroup = "  ORDER BY atencion_salud.FECHA_ATENCION DESC ";
    //public static $filtroPeriodo = "   INNER JOIN periodos ON ( ( date(atencion_salud.FECHA_ATENCION) <= date(periodos.FECHA_MAX_PERIODO) ) AND periodos.ACTUAL = 'SI' )";
    public static $filtroPeriodo = " INNER JOIN periodos ON ( atencion_salud.FECHA_ATENCION >= periodos.FECHA_MIN_PERIODO AND atencion_salud.FECHA_ATENCION <= periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d  ) ";
    public static $filtroActivo = " atencion_salud.ACTIVO = 'SI' ";
    public static $filtroSR = " AND atencion_salud.ID_SUBRECEPTOR = ";
    public static $filtroGestor = " AND subreceptores.ID_GESTOR = ";

    public static function todos() {

        $query = self::$sqlbase .  " WHERE " . self::$filtroActivo . "  ";
        $query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_pendientes() {

        $query = self::$sqlbase .sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  .
                " WHERE " . self::$filtroActivo . " AND atencion_salud.ESTADO_REVISION = 'PENDIENTE'  ";
        $query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_revisionRevisado() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( atencion_salud.ESTADO_REVISION = 'EN REVISION' OR atencion_salud.ESTADO_REVISION = 'REVISADO'  )";
        $query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }
        
    public static function todos_pendienteRevisionRevisado() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE' OR atencion_salud.ESTADO_REVISION = 'EN REVISION' OR atencion_salud.ESTADO_REVISION = 'REVISADO'  )";
        $query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }
        
    public static function todos_pendienteRevision() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE' OR atencion_salud.ESTADO_REVISION = 'EN REVISION' )";
        $query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_periodo() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " ";
        $query .= self::restricciones_atencion_salud();
        $query .= ', atencion_salud.ESTADO_REVISION DESC';

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_revision() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND atencion_salud.ESTADO_REVISION = 'EN REVISION' ";
$query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_revisados() {

        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND atencion_salud.ESTADO_REVISION = 'REVISADO' ";
$query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_aprobados() {

        $query = self::$sqlbase .sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " AND atencion_salud.ESTADO_REVISION = 'APROBADO' ";
$query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }
    
    public static function todos_gestion() {

        $query = self::$sqlbase .sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO );
$query .= self::restricciones_atencion_salud();

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function cinco_porciento_pendientes_HSH($limit) {
        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " "
                . "AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE') "
                . "AND atencion_salud.TIPO_FORMATO_ATENCION = 'HSH' ";
$query .= self::restricciones_atencion_salud();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TS($limit) {
        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " "
                . "AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE') "
                . "AND atencion_salud.TIPO_FORMATO_ATENCION = 'TS' ";
        $query .= self::restricciones_atencion_salud();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_TRANS($limit) {
        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " "
                . "AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE') "
                . "AND atencion_salud.TIPO_FORMATO_ATENCION = 'TRANS' ";
        $query .= self::restricciones_atencion_salud();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function cinco_porciento_pendientes_PVVS($limit) {
        $query = self::$sqlbase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO )  . " WHERE " . self::$filtroActivo . " "
                . "AND ( atencion_salud.ESTADO_REVISION = 'PENDIENTE') "
                . "AND atencion_salud.TIPO_FORMATO_ATENCION = 'PVVS'  ";
        $query .= self::restricciones_atencion_salud();
        $query .= " , RAND() LIMIT $limit";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    
  
    public static function insertar(
    $idCentroSalud, $TIPO_FORMATO_ATENCION, $idPEMAR, $fechaAtencion, $horaAtencion, $idServicioSalud, $idSubreceptor, $nombreUno, $nombreDos, $apellidoUno, $apellidoDos, $cedula, $verificado
    ) {
        $query = "insert INTO atencion_salud (
             ID_CENTRO_SALUD, TIPO_FORMATO_ATENCION, ID_PEMAR, FECHA_ATENCION, HORA_ATENCION,
             ID_SERVICIO_SALUD,ID_SUBRECEPTOR,
             PRIMER_NOMBRE_PEMAR, SEGUNDO_NOMBRE_PEMAR, PRIMER_APELLIDO_PEMAR, SEGUNDO_APELLIDO_PEMAR,
            CEDULA_PEMAR, VERIFICADO_PEMAR, ID_DIGITADOR
            ) VALUES (
            '" . $idCentroSalud . "', '" . $TIPO_FORMATO_ATENCION . "', " . $idPEMAR . ", '" . $fechaAtencion . "', '" . $horaAtencion . "',
            '" . $idServicioSalud . "', '" . $idSubreceptor . "',
            '" . $nombreUno . "','" . $nombreDos . "','" . $apellidoUno . "','" . $apellidoDos . "','" . $cedula . "','" . $verificado . "',
             " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " )";

        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = " update atencion_salud set "
                . "ACTIVO = 'NO' , "
                . "ID_ELIMINA =  " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , "
                . "FECHA_ELIMINACION = CURRENT_TIMESTAMP "
                . "where ID_ATENCION_SALUD='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function datos($id) {
        $query = self::$sqlbase . " where atencion_salud.ID_ATENCION_SALUD = '" . $id . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {

            return $consulta[0];
        }
        return 0;
    }

    public static function datos_por_codPemar($codPemar) {
        $query = self::$sqlbase . " WHERE  pemar.CODIGO_UNICO_PERSONA = '" . $codPemar . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_cedPemar($cedPemar) {
        $query = self::$sqlbase . " WHERE  pemar.CI_POBLACION = '" . $cedPemar . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function update(
    $id, $centroSalud, $TIPO_FORMATO_ATENCION, $idPEMAR, $fechaAtencion, $horaAtencion, $tipoServicio, $subreceptor, $nombreUno, $nombreDos, $apellidoUno, $apellidoDos, $cedula, $verificado
    ) {
        $query = " 
                update atencion_salud 
                        set                       
                        ID_CENTRO_SALUD = '" . $centroSalud . "' ,                             
                        TIPO_FORMATO_ATENCION = '" . $TIPO_FORMATO_ATENCION . "',
                        ID_PEMAR = " . $idPEMAR . " , 
                        FECHA_ATENCION = '" . $fechaAtencion . "' ,                        
                        HORA_ATENCION = '" . $horaAtencion . "',
                        ID_SERVICIO_SALUD ='" . $tipoServicio . "',
                        ID_SUBRECEPTOR ='" . $subreceptor . "',

                        PRIMER_NOMBRE_PEMAR = '" . $nombreUno . "',
                        SEGUNDO_NOMBRE_PEMAR = '" . $nombreDos . "',
                        PRIMER_APELLIDO_PEMAR = '" . $apellidoUno . "',
                        SEGUNDO_APELLIDO_PEMAR = '" . $apellidoDos . "',
                        CEDULA_PEMAR = '" . $cedula . "',
                        VERIFICADO_PEMAR = '" . $verificado . "',

                        ID_MODIFICA =  " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , 
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP 
                where ID_ATENCION_SALUD='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function update_estado_revision($id, $tipo_revision = '') {
        $query = "UPDATE atencion_salud SET "
                . "ESTADO_REVISION = 'EN REVISION', TIPO_REVISION = '" . $tipo_revision . "',   "
                . "ID_MONITOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_ATENCION_SALUD = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function update_estado_revisado($id, $tipo_revision = '') {
        $query = "UPDATE atencion_salud SET "
                . "ESTADO_REVISION = 'REVISADO', TIPO_REVISION = '" . $tipo_revision . "', "
                . "ID_MONITOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_ATENCION_SALUD = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function update_estado_aprobacion($id, $tipo_revision = '') {
        $query = "UPDATE atencion_salud SET "
                . "ESTADO_REVISION = 'APROBADO', TIPO_REVISION = '" . $tipo_revision . "',   "
                . "ID_SUPERVISOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_ATENCION_SALUD = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function update_estado_no_aprobado($id, $tipo_revision = '') {
        $query = "UPDATE atencion_salud SET "
                . "ESTADO_REVISION = 'NO APROBADO', TIPO_REVISION = '" . $tipo_revision . "',  "
                . "ID_SUPERVISOR = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " WHERE ID_ATENCION_SALUD = " . $id . "  ";
        return self::modificarRegistros($query);
    }
  
    public static function total_numero_estado_revision() {
        $consulta = NULL;
        $consulta->TOTAL_PENDIENTES = count(registroAtencionSaludModel::todos_pendientes());
        $consulta->TOTAL_ENREVISION = count(registroAtencionSaludModel::todos_revision());
        $consulta->TOTAL_REVISADOS = count(registroAtencionSaludModel::todos_revisados());
        $consulta->TOTAL_APROBADOS = count(registroAtencionSaludModel::todos_aprobados());

        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function restricciones_atencion_salud() {
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
