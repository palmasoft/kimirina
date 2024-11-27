<?php

class revisionFormulariosControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    function mostrar_panel_revision() {
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_revision();
        $this->datos['TodasConsejerias'] = ConsejeriaPvvsModel::todos_revision();
        $this->datos['RegistrosSemanales'] = RegistroSemanalModel::todos_revision();
        $this->datos['AtencionesSalud'] = registroAtencionSaludModel::todos_revision();

        
        $this->datos['PeriodosRevision'] = PeriodosModel::activo();
        $this->datos['registrosSemanalesPendientes'] = count(RegistroSemanalModel::todos_pendientes());
        $this->datos['registrosAnimadores'] = count(ReciboContactoAnimadorModel::todos_pendientes());
        $this->datos['registrosConsejeria'] = count(ConsejeriaPvvsModel::todos_pendientes());
        $this->datos['registrosAtencionSalud'] = count(registroAtencionSaludModel::todos_pendientes());

        $this->vista->mostrar("revision_formularios/listado_revision_formularios", $this->datos);
    }

    public function ver_revision_formularios() {
        $this->mostrar_panel_revision();
    }

    public function generar_formularios_revison() {
        RevisionRegistros::cambiar_registros_a_revision();
        $this->mostrar_panel_revision();
    }

    public function revisar_formulario_animador() {
        $idRevisionFormulario = ReciboContactoAnimadorModel::update_estado_revision(
                        $this->datos['registro-id-animador'], "REVISADO", 'MANUAL'
        );
        if ($idRevisionFormulario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Recibo de Contacto por Animador cambiado a estado REVISADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function revisar_formulario_consejeria() {
        $idRevisionFormulario = ConsejeriaPvvsModel::update_estado_revision(
                        $this->datos['registro-id-consejeria'], "REVISADO", 'MANUAL'
        );
        if ($idRevisionFormulario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro de Consejeria cambiado a estado REVISADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function revisar_formulario_semanal_contacto() {
        $idRevisionFormulario = RegistroSemanalModel::update_estado_revision(
                        $this->datos['registro-id-contacto'], "REVISADO", 'MANUAL'
        );
        if ($idRevisionFormulario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Hoja de Registro Semanal de Alcances cambiado a estado REVISADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function revisar_formulario_atencion_salud() {
        $idRevisionFormulario = registroAtencionSaludModel::update_estado_revisado(
                        $this->datos['registro-id-atencion_salud'], 'MANUAL'
        );
        if ($idRevisionFormulario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro de Atencion en Salud cambiado a REVISADO."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function generar_reporte_estado_de_la_revision_registros_semanales() {

        echo "1.  FECHA".date('y-m-d h:i:s')."<br />";

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $periodo = PeriodosModel::activo();
        echo "2.  FECHA".date('y-m-d h:i:s')."<br />";
        $totales = array();
        $totales = RegistroSemanalModel::total_numero_estado_revision();
        $registros = RegistroSemanalModel::todos_periodo();
        echo "3.  FECHA".date('y-m-d h:i:s')."<br />";
        $this->datos['RUTA'] = ReporteEstadoRevision::generar_promotores(
                        $subreceptor, $periodo, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $totales, $registros
        );
        echo "FIN.  FECHA".date('y-m-d h:i:s')."<br />";
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_reporte_estado_de_la_revision_recibos_animadores() {

        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $periodo = PeriodosModel::activo();
        
        $totales = array();
        $totales = ReciboContactoAnimadorModel::total_numero_estado_revision();
        $registros = ReciboContactoAnimadorModel::todos_periodo();
        
        $this->datos['RUTA'] = ReporteEstadoRevision::generar_animadores(
                        $subreceptor, $periodo, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $totales, $registros
        );
        
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_reporte_estado_de_la_revision_consejerias() {

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $periodo = PeriodosModel::activo();

        $totales = array();
        $totales = ConsejeriaPvvsModel::total_numero_estado_revision();
        $registros = ConsejeriaPvvsModel::todos_periodo();

        $this->datos['RUTA'] = ReporteEstadoRevision::generar_consejeros(
                        $subreceptor, $periodo, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $totales, $registros
        );
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_reporte_estado_de_la_revision_atencion_salud() {

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $periodo = PeriodosModel::activo();

        $totales = array();
        $totales = registroAtencionSaludModel::total_numero_estado_revision();
        $registros = registroAtencionSaludModel::todos_periodo();

        $this->datos['RUTA'] = ReporteEstadoRevision::generar_atencion_salud(
                        $subreceptor, $periodo, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $totales, $registros
        );
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

}
