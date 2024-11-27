<?php

class auditoriaFormulariosControlador extends ControllerBase {


    public function editar_form_recibo_contacto_animador_aprobado() {

        $this->datos['datosContactoAnimador'] = ReciboContactoAnimadorModel::datos($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($this->datos['idReciboAnimador']);

        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();

        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['Lugares'] = LugaresIntervencionModel::lugares_del_tipo_provincia_canton($this->datos['datosContactoAnimador']->ID_TIPOLUGAR, $this->datos['datosContactoAnimador']->ID_PROVINCIA, $this->datos['datosContactoAnimador']->ID_CIUDAD);

        $this->datos['TiposPemars'] = TiposPoblacionModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['datosContactoAnimador']->ID_PROVINCIA);

        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['Insumos'] = InsumosModel::todos();
        $this->datos['Animadores'] = AgentesModel::animadores();

        $this->vista->mostrar("registrosAprobados/formContactoAnimadorAprobados", $this->datos);
    }

    public function update_recibo_contacto_animador_aprobado() {

        print_r($this->datos);

        $idContactoAnimador = $this->datos['registro-id'];

        $objAnimadorAntiguo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idContactoAnimador);
        $objAnimadorAntiguo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idContactoAnimador);
        $objAnimadorAntiguo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idContactoAnimador);
        $objAnimadorAntiguo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idContactoAnimador);
        $objAnimadorAntiguo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idContactoAnimador);


        $msnResultado = "";
        $objTipoPob = TiposPoblacionModel::datos($this->datos['tipo_pemar']);
        $SEXO = $objTipoPob->SEXO_TIPOPOBLACION;

        $idPemar = PemarsModel::validar_codigo($this->datos['codigo-pemar']);
        if ($idPemar <= 0) {
            $idPemar = PemarsModel::insertar_sin_sexo(
                            $this->datos['tipo_pemar'], $this->datos['codigo-pemar'], $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], '', $this->datos['telefono_contacto']
            );
        }

        if (isset($this->datos['chk-cedula-verificada'])) {
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto']
                );
            }
        }


        $idReciboAnimador = ReciboContactoAnimadorModel::update(
                        $this->datos['registro-id'], $this->datos['num_recibo'], $this->datos['subreceptor'], $objTipoPob->CODIGO_TIPOPOBLACION, $this->datos['hora'], $this->datos['dia-contacto'], $this->datos['mes-contacto'], $this->datos['ano-contacto'], $this->datos['sel-lista-cantones'], $this->datos['provincia-chosen'], $this->datos['TipolugarArbodaje'], $this->datos['sel-lista-lugar_intervencion'], $this->datos['promotor'], $this->datos['tema-recibo'], $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto'], isset($this->datos['chk-cedula-verificada']) ? 'SI' : 'NO', $this->datos['fechaAtencion'], $this->datos['horaAtencion'], $this->datos['centro_salud'], $this->datos['servicio_salud'], $this->datos['observaciones_animador'], $idPemar, $this->datos['alcance']
        );


        $objRecibo = ReciboContactoAnimadorModel::datos($this->datos['registro-id']);
        ReciboContactoAnimadorModel::update_cantidad_condones($this->datos['registro-id'], $this->datos['noCondones']);
        ReciboContactoAnimadorModel::update_cantidad_lubricantes($this->datos['registro-id'], $this->datos['noLubricantes']);
        ReciboContactoAnimadorModel::update_cantidad_folletos($this->datos['registro-id'], $this->datos['noFolletos']);

        $soportes = null;
        if (isset($this->datos['archivo-asociado'])) {
            $soportes = $this->datos['archivo-asociado'];
        }
        ReciboContactoSoportes::eliminar_soportes_excepto($this->datos['registro-id'], $soportes);

        if (count($this->enviados) > 0) {
            $msnResultado .= "<h4>Soportes del Recibo de Contacto por Animador.</h4>";
            $dirArchivo = 'soportes' . DS . 'animadores' . DS . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS .
                    $this->datos['promotor'] . DS . $objTipoPob->CODIGO_TIPOPOBLACION . DS . $objRecibo->NO_RECIBO_CONTACTOANIMADOR . DS;
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    ReciboContactoSoportes::insertar_soporte(
                            $this->datos['registro-id'], str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $msnResultado .= $resp;
                }
            }
        }


        $objAnimadorNuevo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idContactoAnimador);
        $objAnimadorNuevo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idContactoAnimador);
        $objAnimadorNuevo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idContactoAnimador);
        $objAnimadorNuevo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idContactoAnimador);
        $objAnimadorNuevo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idContactoAnimador);



        $idAuditoria = auditoriaFormulariosModel::insertar($this->datos['registro-id'], 'RECIBO ANIMADOR', $this->datos['razones_contacto_animador'], json_encode($objAnimadorAntiguo) . "", json_encode($objAnimadorNuevo) . "");

        if ($idAuditoria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro Corregido Exitosamente. ' . $msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
        //echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
    }

    public function editar_formulario_registro_semanal_aprobado() {

        $datosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosRegistro->ID_REGISTROSEMANAL);
        $datosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosRegistro->ID_REGISTROSEMANAL);
        $this->datos['periodoActual'] = PeriodosModel::activo();

        $this->cargar_datos_tipo_formulario($datosRegistro->TIPO_FORMATO_REGISTROSEMANAL);

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($datosRegistro->ID_PROVINCIA);

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        $this->datos['Lugares'] = array(); //LugaresIntervencionModel::todos();

        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['ServiciosSalud'] = CentrosSaludModel::todos_servicios();

        $this->datos['datosRegistroSemanal'] = $datosRegistro;


        $this->vista->mostrar("registrosAprobados/RegistroSemanalContactoAprobado", $this->datos);
    }

    public function cambiar_formulario_registro_semanal_aprobado() {


        $datosRegistroAntiguo = RegistroSemanalModel::datos($this->datos['registro-id']);

        $msnResultado = '';
        $tipoPoblacion = $this->datos['tipo_poblacion'];
        $idRegistroSemanal = RegistroSemanalModel::update(
                        $this->datos['registro-id'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'], $this->datos['cod_poblacion'], $this->datos['periodo-contactos'], $this->datos['fecha_contacto_inicio_semana'], $this->datos['fecha_contacto_fin_semana'], $this->datos['promotor-formulario']
        );

        //if ($idRegistroSemanal > 0) {
        $ObjRegistro = RegistroSemanalModel::datos($this->datos['registro-id']);
        $msnResultado .= "Numero de Seguimiento Asignado: <b>#" . $ObjRegistro->NUM_REGISTROSEMANAL . "</b>.<br />";
        if (count($this->datos['codigoAbordaje']) > 0) {
            $abordajes = 0;
            RegistroSemanalContactosModel::eliminar_contactos_del_registro($this->datos['registro-id']);
            foreach ($this->datos['codigoAbordaje'] as $indice => $codUnicoPemar) {

                $idPemar = PemarsModel::validar_codigo($codUnicoPemar);
                if ($idPemar <= 0) {
                    $idPemar = PemarsModel::insertar_con_sexo_sin_correo(
                                    $tipoPoblacion, $this->datos['sel-lista-cantones'], $codUnicoPemar, $this->datos['mesNaceAbordaje'][$indice], $this->datos['anoNaceAbordaje'][$indice], $this->datos['sexoAbordaje'][$indice], $this->datos['primerNombreAbordaje'][$indice], $this->datos['segundoNombreAbordaje'][$indice], $this->datos['primerApellidoAbordaje'][$indice], $this->datos['segundoApellidoAbordaje'][$indice], $this->datos['otroNombreAbordaje'][$indice], '', $this->datos['telefonoAbordaje'][$indice]
                    );
                }

                if ($this->datos['cedulaVerificada'][$indice] == "SI") {
                    PemarsModel::actualizar_informacion_personal(
                            $idPemar, $this->datos['primerNombreAbordaje'][$indice], $this->datos['segundoNombreAbordaje'][$indice], $this->datos['primerApellidoAbordaje'][$indice], $this->datos['segundoApellidoAbordaje'][$indice], $this->datos['otroNombreAbordaje'][$indice], $this->datos['cedulaAbordaje'][$indice], $this->datos['telefonoAbordaje'][$indice]
                    );
                }

                $idRegistroContacto = RegistroSemanalContactosModel::insertar(
                                $ObjRegistro->ID_REGISTROSEMANAL, $this->datos['fecha-contacto'][$indice], $this->datos['hora-contacto'][$indice], $idPemar, $tipoPoblacion, $this->datos['tipolugar-abordaje'][$indice], $this->datos['lugar-abordaje'][$indice], $this->datos['primerNombreAbordaje'][$indice], $this->datos['segundoNombreAbordaje'][$indice], $this->datos['primerApellidoAbordaje'][$indice], $this->datos['segundoApellidoAbordaje'][$indice], $this->datos['otroNombreAbordaje'][$indice], $this->datos['cedulaAbordaje'][$indice], $this->datos['cedulaVerificada'][$indice], $this->datos['telefonoAbordaje'][$indice], $this->datos['edadAbordaje'][$indice], $this->datos['sexoAbordaje'][$indice], $this->datos['trabajoSexualAbordaje'][$indice], $this->datos['alcanceAbordaje'][$indice], $this->datos['tipoAlcanceAbordaje'][$indice], $this->datos['temaAbordaje'][$indice], $this->datos['fechaAtencionAbordaje'][$indice], $this->datos['horaAtencionAbordaje'][$indice], $this->datos['servicioSaludAbordaje'][$indice], 'NULL', $this->datos['obserAbordaje'][$indice]
                );

                if ($idRegistroContacto > 0) {
                    $abordajes++;
                    RegistroSemanalInsumosModel::eliminar_insumos_contacto($idRegistroContacto);
                    RegistroSemanalInsumosModel::insertar($idRegistroContacto, 1, $this->datos['cantCondonesAbordaje'][$indice]);
                    RegistroSemanalInsumosModel::insertar($idRegistroContacto, 2, $this->datos['cantLubricantesAbordaje'][$indice]);
                    RegistroSemanalInsumosModel::insertar($idRegistroContacto, 3, $this->datos['cantInfoAbordaje'][$indice]);
                }
            }
        }
        $msnResultado .= "Este registro tiene " . $abordajes . " abordajes asociados.<br />";

        $soportes = null;
        if (isset($this->datos['archivo-asociado'])) {
            $soportes = $this->datos['archivo-asociado'];
        }
        RegistroSemanalArchivosModel::eliminar_soportes_excepto($ObjRegistro->ID_REGISTROSEMANAL, $soportes);


        if (count($this->enviados) > 0) {
            $msnResultado .= "<h4>Soportes del Registro Semanal.</h4>";
            $dirArchivo = 'soportes' . DS . 'promotores' . DS . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . DS .
                    $this->datos['promotor-formulario'] . DS . $this->datos['cod_poblacion'] . DS . $ObjRegistro->NUM_REGISTROSEMANAL . DS;
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    RegistroSemanalArchivosModel::insertar_soporte(
                            $ObjRegistro->ID_REGISTROSEMANAL, str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $msnResultado .= $resp;
                }
            }
        }
        //}


        $datosRegistroNuevo = RegistroSemanalModel::datos($this->datos['registro-id']);

        $this->cargar_datos_tipo_formulario($datosRegistroNuevo->TIPO_FORMATO_REGISTROSEMANAL);
        $datosRegistroNuevo->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($this->datos['registro-id']);




        $idAuditoria = auditoriaFormulariosModel::insertar($this->datos['registro-id'], 'REGISTRO SEMANAL CONTACTO', $this->datos['razones_registro_semanal_contacto'], json_encode($datosRegistroAntiguo) . "", json_encode($datosRegistroNuevo) . "");
        if ($idAuditoria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Hoja de Registro Semanal de Alcances de Promotores Corregido exitosamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    public function cargar_datos_tipo_formulario($tipoForm) {
        $this->datos['tipoPoblacion'] = $tipoForm;
        switch ($tipoForm) {
            case 'HSH':
                $this->datos['idTipoPoblacion'] = 1;
                $this->datos['aliasOtroNombre'] = "Otro Nombre";
                $this->datos['mensaje'] = "Formato de registro semanal de alcances con Hombres que tienen Sexo con Hombres!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(1)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(1)->MAXIMO_LUBRICANTES;
                break;
            case 'TS': $this->datos['idTipoPoblacion'] = 2;
                $this->datos['aliasOtroNombre'] = "Otro Nombre";
                $this->datos['mensaje'] = "Formato de registro semanal de alcances con Trabajadores(as) Sexuales!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(2)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(2)->MAXIMO_LUBRICANTES;
                break;
            case 'TRANS': $this->datos['idTipoPoblacion'] = 3;
                $this->datos['aliasOtroNombre'] = "Otro Nombre";
                $this->datos['mensaje'] = "Formato de registro semanal de alcances con chicas TRANS!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(3)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(3)->MAXIMO_LUBRICANTES;
                break;
        }
    }

    
    
    
    public function correcciones_registro_semanal_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('REGISTRO SEMANAL CONTACTO', $this->datos['idRegistroSemanal']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

    public function correcciones_recibo_animador_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('RECIBO ANIMADOR', $this->datos['idReciboAnimador']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

    public function correcciones_consejeria_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('CONSEJERIA PVVS', $this->datos['idConsejeria']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

}
