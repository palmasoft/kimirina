<?php

class formulariosGestionControlador extends ControllerBase {
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }
     
    function datos_subreceptor_periodo() {        
        
        $array['periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo-form-control'] );
        $array['subreceptor'] =SubreceptoresModel::datos($this->datos['subreceptor-form-control'] );        
        
        echo json_encode($array);
    }
    
}
