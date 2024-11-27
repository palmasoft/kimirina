<?php

class ActividadesMonitorModel extends ModelBase {

    public static $sqlBase = "
            SELECT
                subreceptores.* ,   
                provincias.*
                , actividades_tecnicas.*
                , cantones.*
                , personas_sistema.*
                , temas.*
                , actividades_monitor.*
                , monitor.`NOMBRE_REAL_PERSONA` AS NOMBRE_MONITOR
                , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
                , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
                , actividades_monitor.FECHA_CREACION AS FECHA_CREACION_ACTIVIDAD_MONITOR
                , actividades_monitor.FECHA_MODIFICACION AS FECHA_MODIFICACION_ACTIVIDAD_MONITOR
                , actividades_monitor.FECHA_ELIMINACION AS FECHA_ELIMINACION_ACTIVIDAD_MONITOR
                , (SELECT COUNT(actividades_monitor_asistentes.ID_ASISTENCIA_ACTIVIDAD) from actividades_monitor_asistentes WHERE  actividades_monitor_asistentes.ID_ACTIVIDAD_MONITOR = actividades_monitor.ID_ACTIVIDADREALIZADA  ) 
                    AS ASISTENTES
            FROM
                actividades_monitor
                INNER JOIN actividades_tecnicas 
                    ON (actividades_monitor.ID_ACTIVIDAD = actividades_tecnicas.ID_ACTIVIDAD)
                INNER JOIN cantones 
                    ON (actividades_monitor.ID_CANTON = cantones.ID_CANTON)
                INNER JOIN personas_sistema 
                    ON (actividades_monitor.ID_MONITOR = personas_sistema.ID_PERSONA)
                INNER JOIN provincias 
                    ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
                INNER JOIN temas 
                    ON (actividades_monitor.ID_TEMA = temas.ID_TEMA)
                LEFT JOIN personas_sistema AS monitor
                    ON (actividades_monitor.ID_MONITOR = monitor.ID_PERSONA)
                LEFT JOIN personas_sistema AS modifica
                    ON (actividades_monitor.ID_MODIFICA = modifica.ID_PERSONA)
                LEFT JOIN personas_sistema AS elimina
                    ON (actividades_monitor.ID_ELIMINA = elimina.ID_PERSONA)
                INNER JOIN subreceptores 
                ON (
                    monitor.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR
                )
        ";
    //public static $sqlGroup = " ORDER BY consejeria_pvvs.FECHA_CREACION DESC ";
    public static $filtroPeriodo = " INNER JOIN periodos ON ( actividades_monitor.FECHA_ACTIVIDAD_MONITOR >= periodos.FECHA_MIN_PERIODO AND actividades_monitor.FECHA_ACTIVIDAD_MONITOR <= periodos.FECHA_MAX_PERIODO AND periodos.ID_PERIODO = %d  ) ";
    public static $filtroActivo = " actividades_monitor.ACTIVO = 'SI' ";
    public static $filtroSR = " AND personas_sistema.ID_SUBRECEPTOR = ";
    public static $filtroGestor = " AND subreceptores.ID_GESTOR = ";

    public static function restricciones_actividades() {
        $query = "";
        if (Usuario::tiene_restricciones() and ! Usuario::esGestor()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }
        if (Usuario::esGestor()) {
            $query .= self::$filtroGestor . " " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " ";
        }
        return $query;
    }

    public static function todos() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO) . " WHERE " . self::$filtroActivo . " ";
        $query .= self::restricciones_actividades();

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_gestion() {
        $query = self::$sqlBase . sprintf(self::$filtroPeriodo, PeriodosModel::activo()->ID_PERIODO);
        $query .= self::restricciones_actividades();
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($ID_ACTIVIDAD) {
        $query = self::$sqlBase . " WHERE actividades_monitor.ACTIVO='SI' AND actividades_monitor.ID_ACTIVIDADREALIZADA  = " . $ID_ACTIVIDAD . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function insertar($ID_ACTIVIDAD, $ID_CANTON, $FECHA_ACTIVIDAD_MONITOR, $HORA_INICIO_ACTIVIDAD_MONITOR, $HORA_FIN_ACTIVIDAD_MONITOR, $ID_TEMA, $CONCLUSIONES_ACTIVIDAD_MONITOR, $LATITUD_ACTIVIDAD_MONITOR, $LONGITUD_ACTIVIDAD_MONITOR, $URL_DOCUMENTO_FORMULARIO) {

        $ID_MONITOR = $_SESSION['SESION_USUARIO']->ID_PERSONA;
        $query = "insert into actividades_monitor(ID_ACTIVIDAD,ID_CANTON,ID_MONITOR,FECHA_ACTIVIDAD_MONITOR,
            HORA_INICIO_ACTIVIDAD_MONITOR,HORA_FIN_ACTIVIDAD_MONITOR,ID_TEMA,CONCLUSIONES_ACTIVIDAD_MONITOR,
            LATITUD_ACTIVIDAD_MONITOR,LONGITUD_ACTIVIDAD_MONITOR, URL_DOCUMENTO_FORMULARIO) 
                values (" . $ID_ACTIVIDAD . ", " . $ID_CANTON . ", " . $ID_MONITOR . ", '" . $FECHA_ACTIVIDAD_MONITOR . "'
                    , '" . $HORA_INICIO_ACTIVIDAD_MONITOR . "','" . $HORA_FIN_ACTIVIDAD_MONITOR . "'
                    , " . $ID_TEMA . ", '" . $CONCLUSIONES_ACTIVIDAD_MONITOR . "', '" . $LATITUD_ACTIVIDAD_MONITOR . "'
                    , '" . $LONGITUD_ACTIVIDAD_MONITOR . "', '$URL_DOCUMENTO_FORMULARIO' )";
        return self::crear_ultimo_id($query);
    }

    public static function update($ID_ACTIVIDADREALIZADA, $ID_ACTIVIDAD, $ID_CANTON, $FECHA_ACTIVIDAD_MONITOR, $HORA_INICIO_ACTIVIDAD_MONITOR, $HORA_FIN_ACTIVIDAD_MONITOR, $ID_TEMA, $CONCLUSIONES_ACTIVIDAD_MONITOR, $LATITUD_ACTIVIDAD_MONITOR, $LONGITUD_ACTIVIDAD_MONITOR, $URL_DOCUMENTO_FORMULARIO = "") {

        $ID_MONITOR = $_SESSION['SESION_USUARIO']->ID_PERSONA;
        $query = "  
        update actividades_monitor 
            set
            ID_ACTIVIDAD = " . $ID_ACTIVIDAD . " , 
            ID_CANTON = " . $ID_CANTON . " , 
            FECHA_ACTIVIDAD_MONITOR = '" . $FECHA_ACTIVIDAD_MONITOR . "' , 
            HORA_INICIO_ACTIVIDAD_MONITOR = '" . $HORA_INICIO_ACTIVIDAD_MONITOR . "' , 
            HORA_FIN_ACTIVIDAD_MONITOR = '" . $HORA_FIN_ACTIVIDAD_MONITOR . "' , 
            ID_TEMA = " . $ID_TEMA . " , 
            CONCLUSIONES_ACTIVIDAD_MONITOR = '" . $CONCLUSIONES_ACTIVIDAD_MONITOR . "' , 
            LATITUD_ACTIVIDAD_MONITOR = '" . $LATITUD_ACTIVIDAD_MONITOR . "' , 
            LONGITUD_ACTIVIDAD_MONITOR = '" . $LONGITUD_ACTIVIDAD_MONITOR . "' , 
            ID_MODIFICA = " . $ID_MONITOR . " , 	
            FECHA_MODIFICACION = CURRENT_TIMESTAMP,
            URL_DOCUMENTO_FORMULARIO = '" . $URL_DOCUMENTO_FORMULARIO . "' 
	where
	ID_ACTIVIDADREALIZADA = " . $ID_ACTIVIDADREALIZADA . " ";
        return self::modificarRegistros($query);
    }

    static public function eliminar($idActividad) {
        $query = "UPDATE actividades_monitor 
        SET
          ACTIVO = 'NO',
          ID_ELIMINA =  " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " ,
          FECHA_ELIMINACION = CURRENT_TIMESTAMP
        WHERE ID_ACTIVIDADREALIZADA =  " . $idActividad . " ";
        return self::modificarRegistros($query);
    }

}
