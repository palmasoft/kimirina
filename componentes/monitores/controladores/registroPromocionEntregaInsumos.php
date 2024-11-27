<?php

class registroPromocionEntregaInsumosControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    function mostar_tabla_registro_promocion_insumos() {
        $this->datos['registroActividad'] = RegistroActividadPromocionEntregaInsumosModel::todos_periodo();
        $this->vista->mostrar("registro_Promocion_Insumos/listado_registro_promocion_insumos", $this->datos);
    }

    function datos_para_formulario() {
        $this->datos['periodoActual'] = PeriodosModel::activo();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        $this->datos['idTipoUsuario'] = TiposUsuariosModel::todos();
        if (isset($this->datos['id_registro'])) {
            $registros = RegistroActividadPromocionEntregaInsumosModel::datos($this->datos['id_registro']);
            $registros->SOPORTES = ActividadPromocionInsumosSoportesModel::archivos_en_el_registro($this->datos['id_registro']);
            $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($registros->ID_PROVINCIA);
            $this->datos['lugares'] = LugaresIntervencionModel::lugares_en_canton_tipolugar($registros->ID_TIPOLUGAR, $registros->ID_CANTON);
            $this->datos['usuarios'] = PersonasSistemaModel::personas_en_idTipoPersona($registros->ID_ROL_TIPOUSUARIO);
            $this->datos['promocionInsumos'] = $registros;
        }
    }

    function mostar_datos_registro_promocion_insumos() {
        $this->datos_para_formulario();
        $this->vista->mostrar("registro_Promocion_Insumos/verRegistroPromocionInsumos", $this->datos);
    }

    function mostar_form_registro_promocion_insumos() {
        $this->datos_para_formulario();
        $this->vista->mostrar("registro_Promocion_Insumos/form_registro_promocion_insumos", $this->datos);
    }

    function guardar_registro_entrega_insumos() {
        $this->msnResultado = "";
        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::insertar(
                        $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['motivoActividad'], isset($this->datos['totalhsh']) ? $this->datos['totalhsh'] : 0, isset($this->datos['totalts']) ? $this->datos['totalts'] : 0, isset($this->datos['totaltrans']) ? $this->datos['totaltrans'] : 0, isset($this->datos['totalpvvs']) ? $this->datos['totalpvvs'] : 0, $this->datos['idPersona']
        );
        $objActividad = RegistroActividadPromocionEntregaInsumosModel::datos($idRegistroEntregaActividad);

        $idCondones = 0;
        $idLubricantes = 0;
        $idFollteria = 0;
        if ($idRegistroEntregaActividad > 0) {

            $idCondones = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoCondones($idRegistroEntregaActividad, $this->datos['condones']);
            $idLubricantes = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoLubricantes($idRegistroEntregaActividad, $this->datos['lubricantes']);
            $idFollteria = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoFolleteria($idRegistroEntregaActividad, $this->datos['piezascomunicativas']);
            if (count($this->enviados) > 0) {
                $this->msnResultado .= "<h5>Soportes de la Actividad de Promocion con entrega de insumos.</h5>";
                $dirArchivo = 'soportes' . DS . 'promocion-insumos' . DS .
                        $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD_PROMOCION . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ActividadPromocionInsumosSoportesModel::insertar_soporte(
                                $objActividad->ID_ACTIVIDAD_PROMOCION, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }
        }

        if ($idCondones > 0 && $idLubricantes > 0 && $idFollteria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro de Actividad de Promocion con entrega de insumos guardado Exitosamente. ' . $this->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar la Actividad de Promocion con entrega de insumos. Intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . ' "}';
        }
    }

    function mostar_form_editar_registro_promocion_insumos() {
        $this->datos_para_formulario();
        $this->vista->mostrar("registro_Promocion_Insumos/form_registro_promocion_insumos", $this->datos);
    }

    function update_registro_entrega_insumos() {

        $this->msnResultado = "";
        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::update(
                        $this->datos['registro-id'], $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['motivoActividad'], isset($this->datos['totalhsh']) ? $this->datos['totalhsh'] : 0, isset($this->datos['totalts']) ? $this->datos['totalts'] : 0, isset($this->datos['totaltrans']) ? $this->datos['totaltrans'] : 0, isset($this->datos['totalpvvs']) ? $this->datos['totalpvvs'] : 0, $this->datos['idPersona']
        );
        $objActividad = RegistroActividadPromocionEntregaInsumosModel::datos($this->datos['registro-id']);

        $idCondones = 0;
        $idLubricantes = 0;
        $idFollteria = 0;
        if ($idRegistroEntregaActividad > 0) {
            RegistroActividadPromocionEntregaInsumosModel::eliminarInsumos($this->datos['registro-id']);
            $idCondones = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoCondones($this->datos['registro-id'], $this->datos['condones']);
            $idLubricantes = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoLubricantes($this->datos['registro-id'], $this->datos['lubricantes']);
            $idFollteria = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoFolleteria($this->datos['registro-id'], $this->datos['piezascomunicativas']);
        }

        $soportes = null;
        if (isset($this->datos['archivo-asociado'])) {
            $soportes = $this->datos['archivo-asociado'];
        }
        ActividadPromocionInsumosSoportesModel::eliminar_soportes_excepto($objActividad->ID_ACTIVIDAD_PROMOCION, $soportes);

        if (count($this->enviados) > 0) {
            $this->msnResultado .= "<h5>Soportes de la Actividad de Promocion con entrega de insumos.</h5>";
            $dirArchivo = 'soportes' . DS . 'promocion-insumos' . DS .
                    $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD_PROMOCION . DS;
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    ActividadPromocionInsumosSoportesModel::insertar_soporte(
                            $objActividad->ID_ACTIVIDAD_PROMOCION, str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $this->msnResultado .= $resp;
                }
            }
        }

        if ($idCondones > 0 && $idLubricantes > 0 && $idFollteria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro de Actividad de Promocion con entrega de insumos modificado Exitosamente. ' . $this->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar la Actividad de Promocion con entrega de insumos. Intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . '"}';
        }
    }

    function eliminar_registro_promocion_insumos() {

        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::eliminaActividad($this->datos['registro-id']);
        RegistroActividadPromocionEntregaInsumosModel::eliminarInsumos($this->datos['registro-id']);

        if ($idRegistroEntregaActividad > 0) {

            echo '{ "resultado":"EXITO", "mensaje":"Registro de Actividad de Promocion con entrega de insumos eliminado Exitosamente. "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido eliminar la Actividad de Promocion con entrega de insumos. Intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . '"}';
        }
    }

}
