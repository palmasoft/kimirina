<?php

class aprobacionFormulariosTotalesControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }
    
    public function ver_aprobacion_formularios_totales() {
        
        $this->datos['totalAnimadores'] = ReciboContactoAnimadorModel::total_numero_estado_revision();
        $this->datos['totalConsejerias'] = ConsejeriaPvvsModel::total_numero_estado_revision();
        $this->datos['totalContactos'] = RegistroSemanalModel::total_numero_estado_revision();
        $this->datos['totalAtencionSalud'] = registroAtencionSaludModel::total_numero_estado_revision();
        
        $this->datos['PeriodosRevision'] = PeriodosModel::activo();        
        $this->vista->mostrar("aprobacion_formularios/listado_aprobacion_formualarios_totales", $this->datos);
    }

    
    
    public function aprobar_todos_formularios_animadores() {
        
        $pendientes = ReciboContactoAnimadorModel::todos_pendientes();
        $revision = ReciboContactoAnimadorModel::todos_revision();
        $revisados = ReciboContactoAnimadorModel::todos_revisado();
        
        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';
        ($revisados == 0) ? $revisados = array() : '';
        
        $this->datos['animador'] = array_merge($pendientes, $revision, $revisados);
        $pendientesAnimadores = $this->datos['animador'];
        $correcto = true;
        
        if(!empty($pendientesAnimadores)){
            foreach ($pendientesAnimadores as $indice => $value) {
                $idRevisionFormulario = ReciboContactoAnimadorModel::update_estado_aprobacion($value->ID_CONTACTOANIMADOR, "APROBADO", "AUTOMATICA");
                if ($idRevisionFormulario > 0) {
                    $pendientesAnimadores[$indice]->ID_CONTACTOANIMADOR = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Recibos de Contactos de Animadores APROBADOS Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No hay Pendientes, En Revision, o Revisados"}';
        }
    }

    public function aprobar_todos_formularios_consejerias() {
       
        $pendientes = ConsejeriaPvvsModel::todos_pendientes();
        $revision = ConsejeriaPvvsModel::todos_revision();
        $revisados = ConsejeriaPvvsModel::todos_revisado();
        
        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';
        ($revisados == 0) ? $revisados = array() : '';
        
        $this->datos['consejeria'] = array_merge($pendientes, $revision, $revisados );
        $pendientesConsejerias = $this->datos['consejeria'];
        
        $correcto = true;
        if(!empty($pendientesConsejerias)){
            foreach ($pendientesConsejerias as $indice => $value) {
                $idRevisionFormulario = ConsejeriaPvvsModel::update_estado_aprobacion($value->ID_CONSEJERIA_PVVS, "APROBADO", "AUTOMATICA");
                if ($idRevisionFormulario > 0) {
                    $pendientesConsejerias[$indice]->ID_CONSEJERIA_PVVS = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros de Consejeria PVVS APROBADOS Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No hay Pendientes, En Revision, o Revisados"}';
        }
        
    }

    public function aprobar_todos_formularios_semanales_contactos() {
        
        $pendientes = RegistroSemanalModel::todos_pendientes();
        $revision = RegistroSemanalModel::todos_revision();
        $revisados = RegistroSemanalModel::todos_revisado();
        
        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';
        ($revisados == 0) ? $revisados = array() : '';
        
        $this->datos['contacto'] = array_merge($pendientes, $revision, $revisados );
        $pendientesContactos = $this->datos['contacto'];
        
        $correcto = true;
        if(!empty($pendientesContactos)){
            foreach ($pendientesContactos as $indice => $value) {
                $idRevisionFormulario = RegistroSemanalModel::update_estado_aprobacion($value->ID_REGISTROSEMANAL, "APROBADO", "AUTOMATICA");
                if ($idRevisionFormulario > 0) {
                    $pendientesContactos[$indice]->ID_REGISTROSEMANAL = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Hojas de Registro Semanal de Alcances APROBADOS Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No hay Pendientes, En Revision, o Revisados"}';
        }
    }
    
    public function aprobar_todos_formularios_atencion_salud() {
        
        $pendientes = registroAtencionSaludModel::todos_pendientes();
        $revision = registroAtencionSaludModel::todos_revision();
        $revisados = registroAtencionSaludModel::todos_revisados();
        
        ($pendientes == 0) ? $pendientes = array() : '';
        ($revision == 0) ? $revision = array() : '';
        ($revisados == 0) ? $revisados = array() : '';
        
        $this->datos['contacto'] = array_merge($pendientes, $revision, $revisados );
        $pendientesContactos = $this->datos['contacto'];
        
        $correcto = true;
        if(!empty($pendientesContactos)){
            foreach ($pendientesContactos as $indice => $value) {
                $idRevisionFormulario = registroAtencionSaludModel::update_estado_aprobacion($value->ID_ATENCION_SALUD, "AUTOMATICA");
                if ($idRevisionFormulario > 0) {
                    $pendientesContactos[$indice]->ID_ATENCION_SALUD = $idRevisionFormulario;
                } else {
                    $correcto = false;
                    break;
                }
            }
            if ($correcto) {
                echo '{"resultado":"EXITO", "mensaje":"Registros de Atencion en unidades de Salud APROBADOS Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No hay Pendientes, En Revision, o Revisados"}';
        }
    }

}