<?php

class metaseIndicadoresControlador extends ControllerBase{
    function mostar_tabla_metas_indicadores(){
        $this->datos['indicadores'] = IndicadoresModel::todos();
        $this->datos['PeriodosIndicadores'] = PeriodosIndicadoresModel::todos();
        foreach ($this->datos['indicadores'] as $indicador){
            $indicador->METAS_PERIODOS = PeriodosIndicadoresModel::metas($indicador->ID_INDICADOR);
        }
        $this->vista->mostrar('metaseIndicadores/tablaMetaseIndicadores', $this->datos);
    }
}
