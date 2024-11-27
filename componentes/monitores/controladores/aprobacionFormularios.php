<?php

class aprobacionFormulariosControlador extends ControllerBase {
    

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function ver_aprobacion_formularios() {
        $this->datos['PeriodosRevision'] = PeriodosModel::activo();
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_revisionRevisado();
        $this->datos['TodasConsejerias'] = ConsejeriaPvvsModel::todos_revisionRevisado();       
        $this->datos['RegistrosSemanales'] = RegistroSemanalModel::todos_revisionRevisado(); 
        $this->datos['AtencionesSalud'] = registroAtencionSaludModel::todos_revisionRevisado();
        
        $this->vista->mostrar("aprobacion_formularios/listado_aprobacion_formularios", $this->datos);
    }
    
    public function generar_formularios_aprobacion(){        
        RevisionRegistros::cambiar_registros_a_revision();
        $this->ver_aprobacion_formularios();
    }
    
    public function aprobar_formulario_animador(){
        $idRevisionFormulario = ReciboContactoAnimadorModel::update_estado_aprobacion( 
                        $this->datos['registro-id-animador'],  
                        "APROBADO", "MANUAL"
        );      
        if( $idRevisionFormulario > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Recibo de Contacto por Animador APROBADO."}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    } 
    
    public function aprobar_formulario_consejeria(){
        $idRevisionFormulario = ConsejeriaPvvsModel::update_estado_aprobacion( 
                        $this->datos['registro-id-consejeria'],  
                        "APROBADO", "MANUAL"
        );      
        if( $idRevisionFormulario > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro de Consejeria APROBADO"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    } 
    public function aprobar_formulario_semanal_contacto(){
        $idRevisionFormulario = RegistroSemanalModel::update_estado_aprobacion( 
                        $this->datos['registro-id-contacto'],  
                        "APROBADO", "MANUAL"
        );      
        if( $idRevisionFormulario > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Hoja de Registro Semanal de Alcances por Promotor APROBADO."}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    public function aprobar_formulario_atencion_salud(){
        $idRevisionFormulario = registroAtencionSaludModel::update_estado_aprobacion( $this->datos['registro-id-atencion_salud'], "MANUAL" );      
        if( $idRevisionFormulario > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro de Atencion en centro de Salud APROBADO."}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
}
