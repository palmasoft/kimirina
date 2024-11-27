<?php

class informacionControlador extends ControllerBase {

    function mostrar_informacion_sistema() {
        $this->vista->mostrar("informacion", $this->datos, "sistema");
        echo "--cargo--";
    }

    function panel_de_control() {
        $this->datos['mensajes'] = MensajesSitemaModel::todos();
        $this->vista->mostrar("informacion/panel_control", $this->datos, "sistema");
    }

}
