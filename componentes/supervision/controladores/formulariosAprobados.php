<?php

class formulariosAprobadosControlador extends ControllerBase {
    /*
     * REGISTRO SEMANALES
     */

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function ver_lista_fomularios_aprobados_registro_semanal() {
        $this->datos['formularios'] = RegistroSemanalModel::todos_aprobado();
        $this->vista->mostrar("registrosAprobados/registroSemanal/listadoRegistosSemanales", $this->datos);
    }

    public function ver_registro_semanal_aprobado() {
        $datosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $this->datos = RegistroSemanalModel::cargar_datos_tipo_formulario($datosRegistro->TIPO_FORMATO_REGISTROSEMANAL, $this->datos);
        $datosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($this->datos['idRegistroSemanal']);
        $datosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($this->datos['idRegistroSemanal']);

        $this->datos['tipoPoblacion'] = $datosRegistro->TIPO_FORMATO_REGISTROSEMANAL;
        $this->datos['datosRegistroSemanal'] = $datosRegistro;

        $this->vista->mostrar("registrosAprobados/registroSemanal/verRegistoSemanalAprobado", $this->datos);
    }

    public function editar_formulario_registro_semanal_aprobado() {

        $datosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosRegistro->ID_REGISTROSEMANAL);
        $datosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosRegistro->ID_REGISTROSEMANAL);
        $this->datos['periodoActual'] = PeriodosModel::activo();

        $this->datos = RegistroSemanalModel::cargar_datos_tipo_formulario($datosRegistro->TIPO_FORMATO_REGISTROSEMANAL, $this->datos);

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($datosRegistro->ID_PROVINCIA);

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        $this->datos['Lugares'] = array(); //LugaresIntervencionModel::todos();

        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['ServiciosSalud'] = CentrosSaludModel::todos_servicios();

        $this->datos['datosRegistroSemanal'] = $datosRegistro;

        $this->vista->mostrar("registrosAprobados/registroSemanal/RegistroSemanalContactoAprobado", $this->datos);
    }

    public function cambiar_formulario_registro_semanal_aprobado() {

        $datosViejosRegistro = RegistroSemanalModel::datos($this->datos['registro-id']);
        $datosViejosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);
        $datosViejosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);

        $ctrRegistroSemanal = $this->cargar('registroSemanal', 'monitores');
        $ctrRegistroSemanal->actualizar_registro_semanal();

        $datosNuevosRegistro = RegistroSemanalModel::datos($this->datos['registro-id']);
        $datosNuevosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);
        $datosNuevosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);


        $idAuditoria = auditoriaFormulariosModel::insertar(
                        $this->datos['registro-id'], 'REGISTRO SEMANAL CONTACTO', $this->datos['razones_registro_semanal_contacto'], json_encode($datosViejosRegistro) . "", json_encode($datosNuevosRegistro) . ""
        );
        if ($idAuditoria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Hoja de Registro Semanal de Alcances de Promotores Corregido exitosamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    public function eliminar_formulario_registro_semanal_aprobado() {

        $datosViejosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosViejosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);
        $datosViejosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);

        $seCambio = RegistroSemanalModel::eliminar_hoja($this->datos['idRegistroSemanal']);

        $datosNuevosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosNuevosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);
        $datosNuevosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);

        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $this->datos['idRegistroSemanal'], 'REGISTRO SEMANAL CONTACTO', $this->datos['razones_registro_semanal_contacto'], json_encode($datosViejosRegistro) . "", json_encode($datosNuevosRegistro) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"La Hoja de Registro Semanal de Alcances #' . $datosNuevosRegistro->NUM_REGISTROSEMANAL . ' se ha cambiado a NO APROBADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function no_aprobar_registro_semanal_contacto() {

        $datosViejosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosViejosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);
        $datosViejosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosViejosRegistro->ID_REGISTROSEMANAL);

        $seCambio = RegistroSemanalModel::update_estado_desaprobacion(
                        $this->datos['idRegistroSemanal'], "MANUAL"
        );

//        $estaAceptado = false;
//        if (!empty(InformesMensualesModel::estado_por_periodo($idSubreceptor, $idPeriodo)->ID_ACEPTADO)) {
//            $estaAceptado = true;
//        }
//        if ($estaAceptado) {
//            $subreceptor = SubreceptoresModel::datos_subreceptor($idSubreceptor);
//            $indicadores = IndicadoresModel::todos_subreceptores();
//            $estado = 'ACEPTADO';
//            $reporteMensualSubreceptor = $this->cargar('reporteMensualSubreceptor', 'gestion');;
//            $datosReporte = $reporteMensualSubreceptor->generar_datos_reporte($subreceptor, $periodo, $indicadores);
//            $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
//                            $subreceptor, $datosReporte, $periodo, $estado
//            );
//        }

        $datosNuevosRegistro = RegistroSemanalModel::datos($this->datos['idRegistroSemanal']);
        $datosNuevosRegistro->CONTACTOS = RegistroSemanalContactosModel::contactos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);
        $datosNuevosRegistro->SOPORTES = RegistroSemanalArchivosModel::archivos_en_el_registro($datosNuevosRegistro->ID_REGISTROSEMANAL);

        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $this->datos['idRegistroSemanal'], 'REGISTRO SEMANAL CONTACTO', $this->datos['razones_registro_semanal_contacto'], json_encode($datosViejosRegistro) . "", json_encode($datosNuevosRegistro) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"La <strong>HOJA de REGISTRO SEMANAL DE ALCANCES  #' . $datosNuevosRegistro->NUM_REGISTROSEMANAL . '</strong> se ha cambiado a NO APROBADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    /*
     * REGISTRO DE ANIMADORES
     */

    function ver_lista_fomularios_aprobados_registro_animadores() {

        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_aprobado();
        $this->vista->mostrar("registrosAprobados/reciboContactos/listadoRegistrosAnimadores", $this->datos);
    }

    function mostrar_datos_contacto_animador() {
        $ctrReciboContacto = $this->cargar('reciboContactoAnimador', 'monitores');
        $ctrReciboContacto->cargar_datos_recibo_contacto();
        $this->datos = array_merge($ctrReciboContacto->datos, $this->datos);
        $this->vista->mostrar("registrosAprobados/reciboContactos/verReciboContactoAprobado", $this->datos);
    }

    function editar_form_recibo_contacto_animador_aprobado() {
        $ctrReciboContacto = $this->cargar('reciboContactoAnimador', 'monitores');
        $ctrReciboContacto->cargar_datos_recibo_contacto();
        $this->datos = array_merge($ctrReciboContacto->datos, $this->datos);
        $this->vista->mostrar("registrosAprobados/reciboContactos/formContactoAnimadorAprobados", $this->datos);
    }

    function update_recibo_contacto_animador_aprobado() {

        $idAtencionSalud = $this->datos['registro-id'];

        $objAnimadorAntiguo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idAtencionSalud);
        $objAnimadorAntiguo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idAtencionSalud);
        $objAnimadorAntiguo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idAtencionSalud);
        $objAnimadorAntiguo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idAtencionSalud);
        $objAnimadorAntiguo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idAtencionSalud);

        $ctrReciboContacto = $this->cargar('reciboContactoAnimador', 'monitores');
        $ctrReciboContacto->actualizar_recibo_contacto_animador();

        $objAnimadorNuevo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idAtencionSalud);
        $objAnimadorNuevo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idAtencionSalud);
        $objAnimadorNuevo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idAtencionSalud);
        $objAnimadorNuevo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idAtencionSalud);
        $objAnimadorNuevo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idAtencionSalud);

        $idAuditoria = auditoriaFormulariosModel::insertar(
                        $this->datos['registro-id'], 'RECIBO ANIMADOR', $this->datos['razones_cambios_registro'], json_encode($objAnimadorAntiguo) . "", json_encode($objAnimadorNuevo) . ""
        );

        if ($idAuditoria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro de <strong>RECIBO DE CONTACTO #' . $objAnimadorNuevo->NO_RECIBO_CONTACTOANIMADOR . '</strong> por Animador Corregido Exitosamente. ' . $ctrReciboContacto->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_recibo_contacto_aprobado() {
        $idReciboContacto = $this->datos['idContactoAnimador'];

        $objAnimadorAntiguo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idReciboContacto);
        $objAnimadorAntiguo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idReciboContacto);

        $seCambio = ReciboContactoAnimadorModel::eliminar($idReciboContacto);

        $objAnimadorNuevo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idReciboContacto);
        $objAnimadorNuevo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idReciboContacto);


        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $idReciboContacto, 'RECIBO ANIMADOR', $this->datos['razones_cambios_registro'], json_encode($objAnimadorAntiguo) . "", json_encode($objAnimadorNuevo) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"Se ha eliminado correctamente el <strong>RECIBO DE CONTACTO APROBADO</strong> ."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido ELIMINAR. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function no_aprobar_recibo_contacto_animador_aprobado() {

        $idReciboContacto = $this->datos['idContactoAnimador'];
        $objAnimadorAntiguo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idReciboContacto);
        $objAnimadorAntiguo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idReciboContacto);
        $objAnimadorAntiguo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idReciboContacto);

        $seCambio = ReciboContactoAnimadorModel::update_estado_aprobacion(
                        $idReciboContacto, "NO APROBADO", "MANUAL"
        );

        $objAnimadorNuevo = ReciboContactoAnimadorModel::mostrar_datos_recibo_contacto_animador($idReciboContacto);
        $objAnimadorNuevo->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($idReciboContacto);
        $objAnimadorNuevo->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($idReciboContacto);

//        $idSubreceptor = empty($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR) ? 1 : $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR;
//        if (isset($this->datos['subreceptor'])) {
//            $idSubreceptor = $this->datos['subreceptor'];
//        }        
//        $periodo = PeriodosModel::activo();
//        if (isset($this->datos['periodo-informe'])) {
//            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
//        }        
//        $idPeriodo = $periodo->ID_PERIODO;        
//        $estaAceptado = false;
//        if (!empty(InformesMensualesModel::estado_por_periodo($idSubreceptor, $idPeriodo)->ID_ACEPTADO)) {
//            $estaAceptado = true;
//        }        
//        if($estaAceptado){
//            $subreceptor = SubreceptoresModel::datos_subreceptor($idSubreceptor);
//            $indicadores = IndicadoresModel::todos_subreceptores();
//            $estado = 'aceptado';
//            $reporteMensualSubreceptor = new reporteMensualSubreceptorControlador();
//            $datosReporte = $reporteMensualSubreceptor->generar_datos_reporte($subreceptor, $periodo, $indicadores);
//            $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
//                    $subreceptor, $datosReporte, $periodo, $estado
//            );
//        }

        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $idReciboContacto, 'RECIBO ANIMADOR', $this->datos['razones_cambios_registro'], json_encode($objAnimadorAntiguo) . "", json_encode($objAnimadorNuevo) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"El Recibo de Contacto por Animador ha cambiado a <strong>NO APROBADO</strong>.."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    /*
     * REGISTROS DE ATENCION EN SLUD
     */

    function ver_lista_fomularios_aprobados_atencion_salud() {

        $this->datos['registrosAtencionSalud'] = registroAtencionSaludModel::todos_aprobados();
        $this->vista->mostrar("registrosAprobados/atencionSalud/listadoAtencionSalud", $this->datos);
    }

    function mostrar_datos_atencion_salud_aprobado() {
        $ctrAtencionSalud = $this->cargar('registroAtencionSalud', 'monitores');
        $ctrAtencionSalud->datos_para_formulario();
        $this->datos = array_merge($ctrAtencionSalud->datos, $this->datos);
        $this->vista->mostrar("registrosAprobados/atencionSalud/verRegistroAtencionSalud", $this->datos);
    }

    function editar_form_atencion_salud_aprobado() {
        $ctrAtencionSalud = $this->cargar('registroAtencionSalud', 'monitores');
        $ctrAtencionSalud->datos_para_formulario();
        $this->datos = array_merge($ctrAtencionSalud->datos, $this->datos);
        $this->vista->mostrar("registrosAprobados/atencionSalud/formRegistroAtencionSalud", $this->datos);
    }

    function update_atencion_salud_aprobado() {
        $idAtencionSalud = $this->datos['id_atencion_salud'];
        $objAntes = registroAtencionSaludModel::datos($idAtencionSalud);
        $ctrAtencionSalud = $this->cargar('registroAtencionSalud', 'monitores');
        $seCambio = $ctrAtencionSalud->actualizar_datos_atencion_salud();
        $objNuevo = registroAtencionSaludModel::datos($idAtencionSalud);
        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $this->datos['id_atencion_salud'], 'ATENCION EN SALUD', $this->datos['razones_cambios_registro'], json_encode($objAntes) . "", json_encode($objNuevo) . ""
            );
            echo '{ "resultado":"EXITO", "mensaje":"Registro Corregido Exitosamente. ' . $ctrAtencionSalud->msnResultado . '"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido actualizar el registro de ATENCION EN UNIDAD DE SALUD. '
            . 'Verifique que haya realizadó algún cambio e intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_atencion_salud_aprobado() {
        $objAntes = registroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        $seCambio = registroAtencionSaludModel::eliminar($this->datos['id_atencion_salud']);
        $objNuevo = registroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        $idAuditoria = auditoriaFormulariosModel::insertar(
                        $this->datos['id_atencion_salud'], 'ATENCION EN SALUD', $this->datos['razones_cambios_registro'], json_encode($objAntes) . "", json_encode($objNuevo) . ""
        );
        if ($seCambio > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Se ha eliminado correctamente el registro de  <strong>ATENCION EN UNIDAD DE SALUD</strong> ."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido ELIMINAR. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function no_aprobar_atencion_salud_aprobado() {
        $objAntes = registroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        $seCambio = registroAtencionSaludModel::update_estado_no_aprobado($this->datos['id_atencion_salud'], 'MANUAL');
        $objNuevo = registroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        if ($seCambio > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                            $this->datos['id_atencion_salud'], 'ATENCION EN SALUD', $this->datos['razones_cambios_registro'], json_encode($objAntes) . "", json_encode($objNuevo) . ""
            );
            echo '{ "resultado":"EXITO", "mensaje":"El registro de  ATENCION EN UNIDAD DE SALUD se ha cambiado a <strong>NO APROBADO</strong> exitosamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    /*
     * CONSEJERIA A PVVS
     */

    function ver_lista_fomularios_aprobados_consejerias_pvvs() {
        $this->datos['TodasConsejerias'] = ConsejeriaPvvsModel::todos_aprobado();
        $this->vista->mostrar("registrosAprobados/consejerias/listadoConsejeriasPvvs", $this->datos);
    }

    public function editar_form_consejeria_pvvs_aprobado() {
        $objConsejeria = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['idConsejeria']);
        $objConsejeria->SOPORTES = ConsejeriaPvvsSoportesModel::archivos_en_el_registro($this->datos['idConsejeria']);
        $objConsejeria->INSUMOS->CONDONES = ConsejeriaPvvsModel::condones_entregados($this->datos['idConsejeria']);
        $objConsejeria->INSUMOS->LUBRICANTES = ConsejeriaPvvsModel::lubricantes_entregados($this->datos['idConsejeria']);
        $objConsejeria->INSUMOS->PASTILLEROS = ConsejeriaPvvsModel::pastilleros_entregados($this->datos['idConsejeria']);
        $objConsejeria->INSUMOS->MATERIAL_IEC = ConsejeriaPvvsModel::material_iec_entregados($this->datos['idConsejeria']);

        $this->datos['datosConsejeria'] = $objConsejeria;
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['Promotores'] = AgentesModel::consejeros();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($objConsejeria->ID_PROVINCIA);
        $this->datos['periodoActual'] = PeriodosModel::activo();

        $this->datos['lugaresConsejeria'] = LugaresConsejeriaModel::todos();
        $this->datos['esquemasArv'] = EsquemasArvModel::todos();

        $this->datos['maximoCondones'] = TiposPoblacionModel::datos(4)->MAXIMO_CONDONES;

        $this->vista->mostrar("registrosAprobados/consejerias/ConsejeriaPVVS_aprobados", $this->datos);
    }

    public function editar_consejeria_pvvs_aprobado() {

        $objConsejeriaAntiguo = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id']);
        $objConsejeriaAntiguo->SOPORTES = ConsejeriaPvvsSoportesModel::archivos_en_el_registro($this->datos['registro-id']);
        $objConsejeriaAntiguo->INSUMOS->CONDONES = ConsejeriaPvvsModel::condones_entregados($this->datos['registro-id']);
        $objConsejeriaAntiguo->INSUMOS->LUBRICANTES = ConsejeriaPvvsModel::lubricantes_entregados($this->datos['registro-id']);
        $objConsejeriaAntiguo->INSUMOS->PASTILLEROS = ConsejeriaPvvsModel::pastilleros_entregados($this->datos['registro-id']);
        $objConsejeriaAntiguo->INSUMOS->MATERIAL_IEC = ConsejeriaPvvsModel::material_iec_entregados($this->datos['registro-id']);

        //print_r($this->datos);

        $ctrConsejeriaPVVS = $this->cargar('consejeriaPVVS', 'monitores');
        $seCambio = $ctrConsejeriaPVVS->actualizar_datos_consejeria();

        $objConsejeriaNuevo = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id']);
        $objConsejeriaNuevo->SOPORTES = ConsejeriaPvvsSoportesModel::archivos_en_el_registro($this->datos['registro-id']);
        $objConsejeriaNuevo->INSUMOS->CONDONES = ConsejeriaPvvsModel::condones_entregados($this->datos['registro-id']);
        $objConsejeriaNuevo->INSUMOS->LUBRICANTES = ConsejeriaPvvsModel::lubricantes_entregados($this->datos['registro-id']);
        $objConsejeriaNuevo->INSUMOS->PASTILLEROS = ConsejeriaPvvsModel::pastilleros_entregados($this->datos['registro-id']);
        $objConsejeriaNuevo->INSUMOS->MATERIAL_IEC = ConsejeriaPvvsModel::material_iec_entregados($this->datos['registro-id']);

        $idAuditoria = auditoriaFormulariosModel::insertar(
                        $this->datos['registro-id'], 'CONSEJERIA PVVS', $this->datos['razones_consejeria_pvvs'], json_encode($objConsejeriaAntiguo) . "", json_encode($objConsejeriaNuevo) . ""
        );
        if ($idAuditoria > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro de CONSEJERIA A PVVS Corregido Exitosamente. ' . $ctrConsejeriaPVVS->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar los datos de AUDITORIA. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    public function no_aprobar_consejeria_pvvs() {
        $idRevisionFormulario = ConsejeriaPvvsModel::update_estado_aprobacion(
                        $this->datos['registro-id-consejeria'], "NO APROBADO", "MANUAL"
        );
        if ($idRevisionFormulario > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                    $this->datos['registro-id-consejeria'], 'CONSEJERIA PVVS', $this->datos['razones_consejeria_pvvs'], 
                    json_encode(ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id-consejeria'])) . "", 
                    json_encode(ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id-consejeria'])) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"Formulario de consejeria NO APROBADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function eliminar_consejerias_pvvs_aprobado() {
        $idRevisionFormulario = ConsejeriaPvvsModel::eliminar($this->datos['registro-id-consejeria']);
        if ($idRevisionFormulario > 0) {
            $idAuditoria = auditoriaFormulariosModel::insertar(
                    $this->datos['registro-id-consejeria'], 'CONSEJERIA PVVS', $this->datos['razones_consejeria_pvvs'], 
                    json_encode(ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id-consejeria'])) . "", 
                    json_encode(ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id-consejeria'])) . ""
            );
            echo '{"resultado":"EXITO", "mensaje":"Formulario de consejeria ELIMINADO Correctamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
