<?php

class ActividadesMonitorControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }    
    function mostrar_tabla_datos_actividades() {
        $this->datos['Actividades'] = ActividadesMonitorModel::todos();
        $this->vista->mostrar("actividades_monitor/listadoActividadesMonitor", $this->datos);
    }

    function datos_para_formularios() {

        $this->datos['periodoActual'] = PeriodosModel::activo();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['actividades'] = ActividadesTecnicasModel::todos();
        $this->datos['temas'] = TemasModel::todos();
        $this->datos['personas'] = PersonasSistemaModel::todos();
        $this->datos['idTipoUsuario'] = TiposUsuariosModel::todos();

        if (isset($this->datos['idActividad'])) {
            $this->datos['datosActividad'] = ActividadesMonitorModel::datos($this->datos['idActividad']);
            $this->datos['datosActividad']->SOPORTES = ActividadMonitorSoportesModel::archivos_en_el_registro($this->datos['idActividad']);
            $this->datos['datosActividad']->ASISTENTES = ActividadesMonitorAsistentesModel::asistentes_de_la_actividad($this->datos['idActividad']);
            $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['datosActividad']->ID_PROVINCIA);
        }
    }
    function ver_datos_actividad() {
        $this->datos_para_formularios();
        $this->vista->mostrar("actividades_monitor/actividadMonitor", $this->datos);
    }

    function crear_datos_actividad() {
        $this->datos_para_formularios();
        $this->vista->mostrar("actividades_monitor/formActividadMonitor", $this->datos);
    }
    function agregar_actividad_monitor() {
        $this->msnResultado = "";
        $idActividadMonitor = ActividadesMonitorModel::insertar(
                        $this->datos['idActividad'], $this->datos['lugarResidencia'], $this->datos['fechaRealizacion'], $this->datos['horaInicio'], $this->datos['horaFinal'], $this->datos['idTema'], $this->datos['observaciones'], "", "", $this->datos['dir_archivo_soporte']
        );

        if ($idActividadMonitor > 0) {

            $objActividad = ActividadesMonitorModel::datos($idActividadMonitor);
            if (isset($this->datos['id_persona'])) {
                foreach ($this->datos['id_persona'] as $persona) {
                    ActividadesMonitorAsistentesModel::insertar($idActividadMonitor, $persona);
                }
            }

            if (count($this->enviados) > 0) {

                $this->msnResultado .= "<h5>Soportes de la Actividad realizada por el Monitor.</h5>";
                $dirArchivo = 'soportes' . DS . 'actividades_monitores' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD . DS . $objActividad->ID_ACTIVIDADREALIZADA . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ActividadMonitorSoportesModel::insertar_soporte(
                                $objActividad->ID_ACTIVIDADREALIZADA, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }

            echo '{ "resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente. ' . $this->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema.  ' . $this->msnResultado . '"}';
        }
    }

    function editar_datos_actividad() {
        $this->datos_para_formularios();
        $this->vista->mostrar("actividades_monitor/formActividadMonitor", $this->datos);
    }
    function editar_actividad_monitor() {
        $this->msnResultado = "";
        $idActividadMonitor = ActividadesMonitorModel::update(
                        $this->datos['registro-id'], $this->datos['idActividad'], $this->datos['lugarResidencia'], $this->datos['fechaRealizacion'], $this->datos['horaInicio'], $this->datos['horaFinal'], $this->datos['idTema'], $this->datos['observaciones'], "", "", $this->datos['dir_archivo_soporte']
        );

        if ($idActividadMonitor > 0) {

            $objActividad = ActividadesMonitorModel::datos($this->datos['registro-id']);
            ActividadesMonitorAsistentesModel::eliminar_asistentes_actividad($this->datos['registro-id']);
            foreach ($this->datos['id_persona'] as $persona) {
                ActividadesMonitorAsistentesModel::insertar($this->datos['registro-id'], $persona);
            }

            $soportes = null;
            if (isset($this->datos['archivo-asociado'])) {
                $soportes = $this->datos['archivo-asociado'];
            }
            ActividadMonitorSoportesModel::eliminar_soportes_excepto($objActividad->ID_ACTIVIDADREALIZADA, $soportes);
            if (count($this->enviados) > 0) {
                $this->msnResultado .= "<h5>Soportes de la Actividad realizada por el Monitor.</h5>";
                $dirArchivo = 'soportes' . DS . 'actividades_monitores' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD . DS . $objActividad->ID_ACTIVIDADREALIZADA . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ActividadMonitorSoportesModel::insertar_soporte(
                                $objActividad->ID_ACTIVIDADREALIZADA, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }

            echo '{ "resultado":"EXITO", "mensaje":"Registro Actualizado Exitosamente. ' . $this->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . ' "}';
        }
    }

    function eliminar_actividad_monitor() {
        $elimlinado = ActividadesMonitorModel::eliminar($this->datos['idActividad']);
        if ($elimlinado > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro ELIMINADO Exitosamente. ' . $this->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido eliminar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . ' "}';
        }
    }

    function retorna_datos_persona() {
        $datosPersonas = PersonasSistemaModel::datos($this->datos['idPersona']);
        echo json_encode($datosPersonas);
    }

}
