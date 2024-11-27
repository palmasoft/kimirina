<?php

class tiposControlador extends ControllerBase {
    public function json_todos_tipos_poblacion() {
        $datos = TiposPoblacionModel::todos_tipos_poblacion();		
        echo json_encode($datos);	
    }
    
    
    public function json_todos_tipos_poblacion_web() {
        $datos = TiposPoblacionModel::todos_tipos_poblacion_para_web();		
        echo json_encode($datos);	
    }
}

?>