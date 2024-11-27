<?php

class tablaNavegacionWebControlador extends ControllerBase {

    function ver_tabla_navegacion_web() {
        $this->datos['navegacion_web'] = NavegacionWebModel::todo();
        
//        print_r($this->datos['navegacion_web']);
        $this->vista->mostrar("navegacionWeb/tablaNavegacionWeb", $this->datos);
    }
}
