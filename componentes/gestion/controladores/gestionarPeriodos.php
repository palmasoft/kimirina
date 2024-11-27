<?php

class gestionarPeriodosControlador extends ControllerBase {

    function mostrar_form_gestionar_periodos() {
        $this->datos['Periodos'] = PeriodosModel::todos();
        $this->vista->mostrar("cambioPeriodo/listadoPeriodos", $this->datos);
    }
    
    function habilitar_periodos() {
                
        if (PeriodosModel::desactivarPeriodo( PeriodosModel::actual()->ID_PERIODO )) {
            $codigoPeriodo = PeriodosModel::datos($this->datos['periodo-a-activar'])->CODIGO_PERIODO;
            if (PeriodosModel::activarPeriodo($this->datos['periodo-a-activar'])) {
                echo '{"resultado":"EXITO", "mensaje":"Se activo el periodo ' . $codigoPeriodo . ' correctamente" }';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"Se presento un error al activar el periodo ' . $codigoPeriodo . ', si el error persiste contacte al administrador del sistema"}';
            }
        } else {
            echo '{"resultado":"ERROR", "mensaje":"Se presento un error al activar el periodo ' . $codigoPeriodo . ', si el error persiste contacte al administrador del sistema"}';
        }        
    }

}
