<?php

class metaseIndicadoresControlador extends ControllerBase{
    function mostar_tabla_metas_indicadores(){
        $this->datos['indicadores'] = IndicadoresModel::todos();
        $this->vista->mostrar('metaseIndicadores/tablaMetaseIndicadores', $this->datos);
    }
}
