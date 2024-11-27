<?php

class ayudasControlador extends ControllerBase {
    
    public function cargar_ayuda() {

        $this->datos['ayuda'] = AyudasModel::datos_por_codigo($this->datos['codigo_ayuda']);
        //print_r($this->datos['ayuda']);
        $this->vista->mostrar( "ayuda/modal_videotutor", $this->datos);
    }

}