<?php

class formulariosregistradosControlador extends ControllerBase {
    
    function mostrar_tabla_formularios_registrados() {

        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos();
        $this->vista->mostrar("formulariosRegistrados/tablaFormRegistrados", $this->datos);
    }
    
    
    
}

?>