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

        $this->datos['mostrarHSH'] = false;
        $this->datos['mostrarTS'] = false;
        $this->datos['mostrarTRANS'] = false;
        $this->datos['mostrarCPPV'] = false;
        $tiposPoblacion = SubreceptoresModel::id_tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPoblacion)) {
            foreach ($tiposPoblacion as $tipo) {
                switch ($tipo->ID_TIPOPOBLACION) {
                    case 1:
                        $this->datos['mostrarHSH'] = true;
                        break;
                    case 2:
                        $this->datos['mostrarTS'] = true;
                        break;
                    case 3:
                        $this->datos['mostrarTRANS'] = true;
                        break;
                    case 4:
                        $this->datos['mostrarCPPV'] = true;
                        break;
                    default:
                        break;
                }
            }
        }
        if (!SubreceptoresModel::tiene_restricciones()) {
            $this->datos['mostrarHSH'] = true;
            $this->datos['mostrarTS'] = true;
            $this->datos['mostrarTRANS'] = true;
            $this->datos['mostrarCPPV'] = true;
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
        $msnResultado = "";
        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::insertar(
                        $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['motivoActividad'], isset($this->datos['totalhsh']) ? $this->datos['totalhsh'] : 0, isset($this->datos['totalts']) ? $this->datos['totalts'] : 0, isset($this->datos['totaltrans']) ? $this->datos['totaltrans'] : 0, $this->datos['idPersona']
        );
        $objActividad = RegistroActividadPromocionEntregaInsumosModel::datos($idRegistroEntregaActividad);

        if ($idRegistroEntregaActividad > 0) {

            $idCondones = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoCondones($idRegistroEntregaActividad, $this->datos['condones']);
            $idLubricantes = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoLubricantes($idRegistroEntregaActividad, $this->datos['lubricantes']);
            $idFollteria = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoFolleteria($idRegistroEntregaActividad, $this->datos['piezascomunicativas']);


            if (count($this->enviados) > 0) {

                $msnResultado .= "<h5>Soportes de la Actividad de Promocion con entrega de insumos.</h5>";
                $dirArchivo = 'soportes' . DS . 'promocion-insumos' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD_PROMOCION . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ActividadPromocionInsumosSoportesModel::insertar_soporte(
                                $objActividad->ID_ACTIVIDAD_PROMOCION, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $msnResultado .= $resp;
                    }
                }
            }

            if ($idCondones > 0 && $idLubricantes > 0 && $idFollteria > 0) {
                echo '{ "resultado":"EXITO", "mensaje":"Registro guardado Exitosamente. ' . $msnResultado . ' "}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $msnResultado . ' "}';
            }
        }
    }

    function mostar_form_editar_registro_promocion_insumos() {
        $this->datos_para_formulario();
        $this->vista->mostrar("registro_Promocion_Insumos/form_registro_promocion_insumos", $this->datos);
    }

    function update_registro_entrega_insumos() {

        $msnResultado = "";
        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::update(
                        $this->datos['registro-id'], $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['motivoActividad'], isset($this->datos['totalhsh']) ? $this->datos['totalhsh'] : 0, isset($this->datos['totalts']) ? $this->datos['totalts'] : 0, isset($this->datos['totaltrans']) ? $this->datos['totaltrans'] : 0, $this->datos['idPersona']
        );
        $objActividad = RegistroActividadPromocionEntregaInsumosModel::datos($this->datos['registro-id']);

        if ($idRegistroEntregaActividad > 0) {
            RegistroActividadPromocionEntregaInsumosModel::eliminarInsumos($this->datos['registro-id']);

            $idCondones = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoCondones($this->datos['registro-id'], $this->datos['condones']);
            $idLubricantes = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoLubricantes($this->datos['registro-id'], $this->datos['lubricantes']);
            $idFollteria = RegistroActividadPromocionEntregaInsumosModel::insertarInsumoFolleteria($this->datos['registro-id'], $this->datos['piezascomunicativas']);

            $soportes = null;
            if (isset($this->datos['archivo-asociado'])) {
                $soportes = $this->datos['archivo-asociado'];
            }

            ActividadPromocionInsumosSoportesModel::eliminar_soportes_excepto($objActividad->ID_ACTIVIDAD_PROMOCION, $soportes);
            if (count($this->enviados) > 0) {


                $msnResultado .= "<h5>Soportes de la Actividad de Promocion con entrega de insumos.</h5>";
                $dirArchivo = 'soportes' . DS . 'promocion-insumos' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $objActividad->ID_ACTIVIDAD_PROMOCION . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ActividadPromocionInsumosSoportesModel::insertar_soporte(
                                $objActividad->ID_ACTIVIDAD_PROMOCION, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $msnResultado .= $resp;
                    }
                }
            }



            if ($idCondones > 0 && $idLubricantes > 0 && $idFollteria > 0) {
                echo '{ "resultado":"EXITO", "mensaje":"Registro modificado Exitosamente. ' . $msnResultado . '"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $msnResultado . '"}';
            }
        }
    }

    function eliminar_registro_promocion_insumos() {

        $idRegistroEntregaActividad = RegistroActividadPromocionEntregaInsumosModel::eliminaActividad($this->datos['registro-id']);
        RegistroActividadPromocionEntregaInsumosModel::eliminarInsumos($this->datos['registro-id']);

        if ($idRegistroEntregaActividad > 0) {

            echo '{ "resultado":"EXITO", "mensaje":"Registro eliminado Exitosamente. "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido eliminar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $msnResultado . '"}';
        }
    }

}
