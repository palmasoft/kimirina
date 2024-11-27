<?php

class registroSemanalControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function mostrar_tabla_registros_semanales() {
        $this->datos['formularios'] = RegistroSemanalModel::todos_pendientesRevisionRevisado();
        //print_r( $this->datos['formularios'] );
        $this->vista->mostrar("registro_semanal_contactos/listado", $this->datos);
    }

    public function actualizar_registro_semanal() {
        $this->msnResultado = '';
        $tipoPoblacion = $this->datos['tipo_poblacion'];
        $idRegistroSemanal = RegistroSemanalModel::update(
                        $this->datos['registro-id'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'], $this->datos['cod_poblacion'], $this->datos['periodo-contactos'], $this->datos['fecha_contacto_inicio_semana'], $this->datos['fecha_contacto_fin_semana'], $this->datos['promotor-formulario']
        );
        if ($idRegistroSemanal > 0) {
            $ObjRegistro = RegistroSemanalModel::datos($this->datos['registro-id']);
            $this->msnResultado .= "Numero de Seguimiento Asignado: <b>#" . $ObjRegistro->NUM_REGISTROSEMANAL . "</b>.<br />";
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
            $this->msnResultado .= "Este registro tiene " . $abordajes . " abordajes asociados.<br />";
        }

        $soportes = array();
        if (isset($this->datos['archivo-asociado'])) { 
            $soportes = $this->datos['archivo-asociado'];
        }
        RegistroSemanalArchivosModel::eliminar_soportes_excepto($this->datos['registro-id'], $soportes);

        if (count($this->enviados) > 0) {
            $this->msnResultado .= "<h4>Soportes del Registro Semanal.</h4>";
            $dirArchivo = 'soportes' . DS . 'promotores' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                    $this->datos['promotor-formulario'] . DS . $this->datos['cod_poblacion'] . DS . $ObjRegistro->NUM_REGISTROSEMANAL . DS;
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    RegistroSemanalArchivosModel::insertar_soporte(
                            $ObjRegistro->ID_REGISTROSEMANAL, str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $this->msnResultado .= $resp;
                }
            }
        }
        
        $reporteMensualSubreceptor = $this->cargar('reporteMensualSubreceptor', 'gestion');
        $reporteMensualSubreceptor->estado_reporte_mensual(PeriodosModel::actual(), $this->datos['SubReceptor']);
        
        if( isset( $this->datos['estaAceptadoPeriodo'] ) && RegistroSemanalModel::datos($this->datos['registro-id'])->ESTADO_REVISION == "APROBADO"){
            
//            $reporteMensualSubreceptor->actualizar_datos_reporte();
//            $reporteMensualSubreceptor->aceptar_informe_mensual();
//            $estadoReporte = ReporteMensualSubreceptorModel::datos_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
//            $preAprueba = PersonasSistemaModel::datos($estadoReporte->ID_PREAPRUEBA);
//            $aprueba = PersonasSistemaModel::datos($estadoReporte->ID_APRUEBA);
//            $indicadores = IndicadoresModel::todos_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR);
//            $datosReporte = $reporteMensualSubreceptor->generar_datos_reporte($this->datos['SubReceptor'], $this->datos['Periodo'], $indicadores);
//            $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
//                    $this->datos['SubReceptor'], $datosReporte, $this->datos['Periodo'], $preAprueba->NOMBRE_REAL_PERSONA, $aprueba->NOMBRE_REAL_PERSONA, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
//            );
//            ReporteMensualSubreceptorModel::actualiza_ruta_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO, $this->datos['RUTA']);
            
        }else{
//            echo "No entro";
        }
        
        return $idRegistroSemanal;
    }

    public function cambiar_formulario_registro_semanal() {
        $idRegistroSemanal = $this->actualizar_registro_semanal();
        if ($idRegistroSemanal > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Hoja de Registro Semanal de Alcances de Promotores Actualizado Correctamente. ' . $this->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function guardar_datos_nuevo_registro_semanal() {

        $this->msnResultado = "";
        $tipoPoblacion = $this->datos['tipo_poblacion'];
        $idRegistroSemanal = RegistroSemanalModel::insertar(
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'], $this->datos['cod_poblacion'], $this->datos['periodo-contactos'], $this->datos['fecha_contacto_inicio_semana'], $this->datos['fecha_contacto_fin_semana'], $this->datos['promotor-formulario']
        );
        if ($idRegistroSemanal > 0) {
            $ObjRegistro = RegistroSemanalModel::datos($idRegistroSemanal);
            $this->msnResultado .= "Numero de Seguimiento Asignado: <b>#" . $ObjRegistro->NUM_REGISTROSEMANAL . "</b>.<br />";
            if (count($this->datos['codigoAbordaje']) > 0) {
                $abordajes = 0;
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
                        RegistroSemanalInsumosModel::insertar($idRegistroContacto, 1, $this->datos['cantCondonesAbordaje'][$indice]);
                        RegistroSemanalInsumosModel::insertar($idRegistroContacto, 2, $this->datos['cantLubricantesAbordaje'][$indice]);
                        RegistroSemanalInsumosModel::insertar($idRegistroContacto, 3, $this->datos['cantInfoAbordaje'][$indice]);
                    }
                }
            }
            $this->msnResultado .= "Este registro tiene " . $abordajes . " abordajes asociados.<br />";
            if (count($this->enviados) > 0) {
                $this->msnResultado .= "<h4>Soportes del Registro Semanal.</h4>";
                $dirArchivo = 'soportes' . DS . 'promotores' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                        $this->datos['promotor-formulario'] . DS . $this->datos['cod_poblacion'] . DS . $ObjRegistro->NUM_REGISTROSEMANAL . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        RegistroSemanalArchivosModel::insertar_soporte(
                                $ObjRegistro->ID_REGISTROSEMANAL, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }
        }

        if ($idRegistroSemanal > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Hoja de Registro Semanal de Alcances de Promotores guardado. ' . $this->msnResultado . ' "}';
        } else {
            echo '{ "resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function ver_registro_semanal() {

        $datosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $this->cargar_datos_tipo_formulario($datosRegistro->TIPO_FORMATO_REGISTROSEMANAL);
        $datosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($this->datos['idRegistroSemanal']);
        $datosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($this->datos['idRegistroSemanal']);

        $this->datos['tipoPoblacion'] = $datosRegistro->TIPO_FORMATO_REGISTROSEMANAL;
        $this->datos['datosRegistroSemanal'] = $datosRegistro;

        $this->vista->mostrar("registro_semanal_contactos/VerRegistroSemanalContacto", $this->datos);
    }

    public function ver_registro_semanal_modal() {

        $datosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);

        $this->cargar_datos_tipo_formulario($datosRegistro->TIPO_FORMATO_REGISTROSEMANAL);
        $datosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($this->datos['idRegistroSemanal']);
        $datosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($this->datos['idRegistroSemanal']);
        $this->datos['tipoPoblacion'] = $datosRegistro->TIPO_FORMATO_REGISTROSEMANAL;
        $this->datos['datosRegistroSemanal'] = $datosRegistro;

        $this->vista->mostrar("registro_semanal_contactos/datosFormatoContactos", $this->datos);
    }

    public function cargar_datos_tipo_formulario($tipoForm) {
        $this->datos['tipoPoblacion'] = $tipoForm;
        switch ($tipoForm) {
            case 'HSH':
                $this->datos['idTipoPoblacion'] = 1;
                $this->datos['aliasOtroNombre'] = "";
                $this->datos['mensaje'] = "Formulario de formatos de registro semanal de alcances con Hombres que tienen Sexo con Hombres!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(1)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(1)->MAXIMO_LUBRICANTES;
                break;
            case 'TS': $this->datos['idTipoPoblacion'] = 2;
                $this->datos['aliasOtroNombre'] = "Nombre Artistico";
                $this->datos['mensaje'] = "Formulario de formatos de registro semanal de alcances con Trabajadores(as) Sexuales!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(2)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(2)->MAXIMO_LUBRICANTES;
                break;
            case 'TRANS': $this->datos['idTipoPoblacion'] = 3;
                $this->datos['aliasOtroNombre'] = "Nombre Trans";
                $this->datos['mensaje'] = "Formulario de formatos de registro semanal de Alcances con TRANS!";
                $this->datos['maximoCondones'] = TiposPoblacionModel::datos(3)->MAXIMO_CONDONES;
                $this->datos['maximoLubricantes'] = TiposPoblacionModel::datos(3)->MAXIMO_LUBRICANTES;
                break;
        }
    }

    public function nuevo_formulario_registro_semanal() {

        $this->cargar_datos_tipo_formulario($this->datos['tipoPoblacion']);
        $this->datos['periodoActual'] = PeriodosModel::activo();

        $this->datos['regiones'] = UbicacionesModel::todas_regiones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::todas_parroquias();

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        $this->datos['Lugares'] = array();

        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['ServiciosSalud'] = CentrosSaludModel::todos_servicios();
        $this->datos['Pemars'] = PemarsModel::todos();
        $this->datos['TiposPemar'] = PemarsModel::todos_tipos();


        $this->vista->mostrar("registro_semanal_contactos/RegistroSemanalContacto", $this->datos);
    }

    public function editar_formulario_registro_semanal() {
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
        $this->vista->mostrar("registro_semanal_contactos/RegistroSemanalContacto", $this->datos);
    }

    public function lista_seleccion_establecimiento() {

        $CentrosSaludResto = centrosserviciossaludModel::todos();
        $dtsCanton->ID_CANTON= ""; 
        $dtsCanton->ID_PROVINCIA = "";
        if (isset($this->datos['id_canton']) and ! empty($this->datos['id_canton'])) {
            $dtsCanton = UbicacionesModel::canton($this->datos['id_canton']);
            $CentrosSaludCanton = centrosserviciossaludModel::todos_filtro_canton($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
            $CentrosSaludProvincia = centrosserviciossaludModel::todos_filtro_provincia($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
            $CentrosSaludResto = centrosserviciossaludModel::todos_filtro_no_canton_no_provincia($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
        }
        
        echo '<select id="centro_servicio_salud_derivado" name="centro_servicio_salud_derivado" class="select- span12" >'
            .'<option value="" data-nombre=""  selected="true" >No fue atendido</option>';
        
        if(count($CentrosSaludCanton)){
            echo '<optgroup label="CANTON: '.$dtsCanton->NOMBRE_CANTON.'">';
            foreach ($CentrosSaludCanton as $centro) {        
                echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
                echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
                echo '</option>';
            }
            echo '</optgroup>';
        }
        if(count($CentrosSaludProvincia)){
        echo '<optgroup label="PROVINCIA: '.$dtsCanton->NOMBRE_PROVINCIA.'">';
        foreach ($CentrosSaludProvincia as $centro) {        
            echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
            echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
            echo '</option>';
        }
        echo '</optgroup>';
        }
        if(count($CentrosSaludResto)){
        echo '<optgroup label="RESTO DE ECUADOR">';
        foreach ($CentrosSaludResto as $centro) {        
            echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
            echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
            echo '</option>';
        }
        echo '</optgroup>';
        }
        
        echo '</select>';

    }

    public function eliminar_formulario_registro_semanal() {
        $idRegistroSemanal = RegistroSemanalModel::eliminar_hoja($this->datos['idRegistroSemanal']);
        if ($idRegistroSemanal > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Semanal de Alcances de Promotores eliminado correctamente. "}';
        } else {
            echo '{ "resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
