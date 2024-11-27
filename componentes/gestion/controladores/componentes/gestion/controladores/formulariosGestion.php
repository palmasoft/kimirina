<?php

class formulariosGestionControlador extends ControllerBase {
    
    function ver_lista_registro_semanal_gestion(){
        $this->datos['formularios'] = RegistroSemanalModel::todos_aprobado();
        
        $this->vista->mostrar("formulariosGestion/listadoRegistosSemanales", $this->datos);
    }
    function ver_lista_registro_animadores_gestion(){
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_aprobado();
        
        $this->vista->mostrar("formulariosGestion/listadoRegistrosAnimadores", $this->datos);
    }
    function ver_lista_consejerias_pvvs_gestion(){
        $this->datos['TodasConsejerias'] =  ConsejeriaPvvsModel::todos_aprobado();
        
        $this->vista->mostrar("formulariosGestion/listadoConsejeriasPvvs", $this->datos);
    }
    
    
    
    
    function datos_subreceptor_periodo() {        
        $array['periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo'] );
        $array['subreceptor'] =SubreceptoresModel::datos($this->datos['subreceptor'] );        
        
        echo json_encode($array);
    }
    
}
