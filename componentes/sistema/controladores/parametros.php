<?php
class parametrosControlador extends ControllerBase {
    function cargar_vista_listado_parametros(){
        $this->datos['parametros'] = parametrosModel::todos();      
        $this->vista->mostrar( 'parametros/tabla_parametros', $this->datos );
    }
}


