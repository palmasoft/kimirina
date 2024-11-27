<?php

class registroEventosMasivosControlador extends ControllerBase {

    function ver_registro_evento_masivo() {
//        $this->datos['ObjEvento'] = EventosReferidosEfectivos::datos($this->datos['id_evento_masivo']);        
        $registros = EventosReferidosEfectivos::datos($this->datos['id_evento_masivo']);
        $registros->SOPORTES = EventoMasivoSoportesModel::archivos_en_el_registro($this->datos['id_evento_masivo']);
        $this->datos['ObjEvento'] = $registros;
        $this->vista->mostrar("registroEventosMasivos/ver_evento_masivo", $this->datos);
    }

    function mostar_tabla_registro_eventos_masivos() {
        $this->datos['eventosReferidosEfectivos'] = EventosReferidosEfectivos::todos();
        $this->vista->mostrar("registroEventosMasivos/tabla_registro_eventos_masivos", $this->datos);
    }

    function cargar_datos_formularios() {
        $this->datos['periodoActual'] = PeriodosModel::actual();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        $this->datos['TiposUsuario'] = TiposUsuariosModel::todos();
        $this->datos['Lugares'] = array(); //LugaresIntervencionModel::todos();
        $this->datos['usuarios'] = array(); 
        if (isset($this->datos['id_evento_masivo'])) {
            $this->datos['ObjEvento'] = EventosReferidosEfectivos::datos($this->datos['id_evento_masivo']);
            $this->datos['ObjEvento']->SOPORTES = EventoMasivoSoportesModel::archivos_en_el_registro($this->datos['id_evento_masivo']);
            $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['ObjEvento']->ID_PROVINCIA);
            $this->datos['Lugares'] = LugaresIntervencionModel::lugares_del_tipo_provincia_canton(
                            $this->datos['ObjEvento']->ID_TIPOLUGAR, $this->datos['ObjEvento']->ID_PROVINCIA, $this->datos['ObjEvento']->ID_CANTON
            );
            $this->datos['usuarios'] = PersonasSistemaModel::personas_en_idTipoPersona($this->datos['ObjEvento']->ID_ROL_TIPOUSUARIO);
        }
    }

    function mostar_form_registro_eventos_masivos() {
        $this->cargar_datos_formularios();
        $this->vista->mostrar("registroEventosMasivos/form_registro_eventos_masivos", $this->datos);
    }

    function guardar_evento_masivo_referidos_efectivos() {
        $msnResultado = "";
        $idEvento = EventosReferidosEfectivos::insertar(
                        $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['idPersona'], $this->datos['referidos'], $this->datos['motivoActividad'], $this->datos['empresaOrganizaActividad']
        );
        $ObjEvento = EventosReferidosEfectivos::datos($idEvento);
        if ($idEvento > 0) {
//            $ObjEvento = EventosReferidosEfectivos::datos($idEvento);
            EventosReferidosEfectivos::agregar_condones($ObjEvento->ID_EVENTO_MASIVO, $this->datos['condones']);
            EventosReferidosEfectivos::agregar_lubricantes($ObjEvento->ID_EVENTO_MASIVO, $this->datos['lubricantes']);
            EventosReferidosEfectivos::agregar_folletos($ObjEvento->ID_EVENTO_MASIVO, $this->datos['piezascomunicativas']);

            if (count($this->enviados) > 0) {

                $msnResultado .= "<h5>Soportes del Evento Masivo con Referidos Efectivos.</h5>";
                $dirArchivo = 'soportes' . DS . 'eventos-masivos-referidos-efectivos' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $ObjEvento->ID_EVENTO_MASIVO . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        EventoMasivoSoportesModel::insertar_soporte(
                                $ObjEvento->ID_EVENTO_MASIVO, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $msnResultado .= $resp;
                    }
                }
            }
            if ($idEvento > 0) {
                echo '{ "resultado":"EXITO", "mensaje":" Registro guardado Exitosamente. ' . $msnResultado . ' "}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $msnResultado . ' "}';
            }
        }
    }

    function mostar_editar_form_registro_eventos_masivos() {
        $this->cargar_datos_formularios();
        $this->vista->mostrar("registroEventosMasivos/form_registro_eventos_masivos", $this->datos);
    }

    function editar_evento_masivo_referidos_efectivos() {
        $msnResultado = "";
        $modEvento = EventosReferidosEfectivos::actualizar(
                        $this->datos['registro-id'], $this->datos['fechaactividad'], $this->datos['lugar_intervencion_contacto'], $this->datos['idPersona'], $this->datos['referidos'], $this->datos['motivoActividad'], $this->datos['empresaOrganizaActividad']
        );
        $ObjEvento = EventosReferidosEfectivos::datos($this->datos['registro-id']);
        if ($modEvento > 0) {

            EventosReferidosEfectivosInsumos::eliminar_insumos_contacto($this->datos['registro-id']);
            EventosReferidosEfectivos::agregar_condones($ObjEvento->ID_EVENTO_MASIVO, $this->datos['condones']);
            EventosReferidosEfectivos::agregar_lubricantes($ObjEvento->ID_EVENTO_MASIVO, $this->datos['lubricantes']);
            EventosReferidosEfectivos::agregar_folletos($ObjEvento->ID_EVENTO_MASIVO, $this->datos['piezascomunicativas']);

            $soportes = null;
            if (isset($this->datos['archivo-asociado'])) {
                $soportes = $this->datos['archivo-asociado'];
            }

            EventoMasivoSoportesModel::eliminar_soportes_excepto($ObjEvento->ID_EVENTO_MASIVO, $soportes);

            if (count($this->enviados) > 0) {


                $msnResultado .= "<h5>Soportes del Evento Masivo con Referidos Efectivos.</h5>";
                $dirArchivo = 'soportes' . DS . 'eventos-masivos-referidos-efectivos' . DS .
                        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS . $ObjEvento->ID_EVENTO_MASIVO . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        EventoMasivoSoportesModel::insertar_soporte(
                                $ObjEvento->ID_EVENTO_MASIVO, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $msnResultado .= $resp;
                    }
                }
            }
        }

        if ($modEvento > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Se ha actualizado correctamente el Evento Masivo con Referidos Efectivos."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_registro_eventos_masivos() {

        $modEvento = EventosReferidosEfectivos::eliminar($this->datos['id_evento_masivo']);
        if ($modEvento > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Se ha eliminado correctamente el Evento Masivo con Referidos Efectivos."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido eliminar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

}
