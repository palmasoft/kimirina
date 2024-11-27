<?php

class revisionFormulariosTotalesControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }
    
    public function ver_revision_formularios_totales() {

        $this->datos['totalAnimadores'] = ReciboContactoAnimadorModel::total_numero_estado_revision();
        $this->datos['totalConsejerias'] = ConsejeriaPvvsModel::total_numero_estado_revision();
        $this->datos['totalContactos'] = RegistroSemanalModel::total_numero_estado_revision();
        $this->datos['totalAtencionSalud'] = registroAtencionSaludModel::total_numero_estado_revision();
        $this->datos['PeriodosRevision'] = PeriodosModel::activo();

        $this->vista->mostrar("revision_formularios/listado_revison_formularios_totales", $this->datos);
    }

    public function revisar_todos_formularios_animadores() {
        $pendientes = ReciboContactoAnimadorModel::todos_pendientes();
        $revision = ReciboContactoAnimadorModel::todos_revision();

        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';

        $this->datos['animador'] = array_merge($pendientes, $revision);
        $pendientesAnimadores = $this->datos['animador'];
        $correcto = true;

        if (!empty($pendientesAnimadores)) {
            foreach ($pendientesAnimadores as $indice => $value) {
                $idRevisionFormulario = ReciboContactoAnimadorModel::update_estado_revision($value->ID_CONTACTOANIMADOR, "REVISADO", 'AUTOMATICA');
                if ($idRevisionFormulario > 0) {
                    $pendientesAnimadores[$indice]->ID_CONTACTOANIMADOR = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros Revisados Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No hay pendientes o En Revision"}';
        }
    }

    public function revisar_todos_formularios_consejerias() {

        $pendientes = ConsejeriaPvvsModel::todos_pendientes();
        $revision = ConsejeriaPvvsModel::todos_revision();

        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';

        $this->datos['consejeria'] = array_merge($pendientes, $revision);
        $pendientesConsejerias = $this->datos['consejeria'];

        $correcto = true;
        if (!empty($pendientesConsejerias)) {
            foreach ($pendientesConsejerias as $indice => $value) {
                $idRevisionFormulario = ConsejeriaPvvsModel::update_estado_revision($value->ID_CONSEJERIA_PVVS, "REVISADO", 'AUTOMATICA');
                if ($idRevisionFormulario > 0) {
                    $pendientesConsejerias[$indice]->ID_CONSEJERIA_PVVS = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros Revisados Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No hay pendientes o En Revision"}';
        }
    }

    public function revisar_todos_formularios_semanales_contactos() {

        $pendientes = RegistroSemanalModel::todos_pendientes();
        $revision = RegistroSemanalModel::todos_revision();

        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';

        $this->datos['contacto'] = array_merge($pendientes, $revision);
        $pendientesContactos = $this->datos['contacto'];

        $correcto = true;
        if (!empty($pendientesContactos)) {
            foreach ($pendientesContactos as $indice => $value) {
                $idRevisionFormulario = RegistroSemanalModel::update_estado_revision($value->ID_REGISTROSEMANAL, "REVISADO", 'AUTOMATICA');
                if ($idRevisionFormulario > 0) {
                    $pendientesContactos[$indice]->ID_REGISTROSEMANAL = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros Revisados Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No hay pendientes o En Revision"}';
        }
    }

    public function revisar_todos_registros_atencion_salud() {

        $pendientes = registroAtencionSaludModel::todos_pendientes();
        $revision = registroAtencionSaludModel::todos_revision();

        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';

        $this->datos['contacto'] = array_merge($pendientes, $revision);
        $pendientesContactos = $this->datos['contacto'];

        $correcto = true;
        if (!empty($pendientesContactos)) {
            foreach ($pendientesContactos as $indice => $value) {
                $idRevisionFormulario = registroAtencionSaludModel::update_estado_revisado($value->ID_ATENCION_SALUD, 'AUTOMATICA');
                if ($idRevisionFormulario > 0) {
                    $pendientesContactos[$indice]->ID_ATENCION_SALUD = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros Revisados Exitosamente."}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No hay pendientes o En Revision"}';
        }
    }

}
