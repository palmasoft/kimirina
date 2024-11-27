<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class controlSubreceptorPeriodoControlador extends ControllerBase {
    
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function mostrar_modal() {        
        
        $this->vista->mostrar("control/modalFormSubreceptorPeriodo", $this->datos);        
    }
    
    public function cambiar_subreceptor_periodo() {        
        
        $array['periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo-form-control'] );
        $array['subreceptor'] =SubreceptoresModel::datos($this->datos['subreceptor-form-control'] );        
        
        echo json_encode($array);      
    }
    
}

