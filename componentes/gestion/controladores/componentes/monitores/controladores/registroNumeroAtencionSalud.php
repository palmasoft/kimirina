<?php

class registroNumeroAtencionSaludControlador extends ControllerBase {

    function cargar_vista_listado() {

        $this->datos['registrosNumeroAtencionSalud'] = registroNumeroAtencionSaludModel::todos();
        $this->vista->mostrar('registro_numero_atencion_salud/listadoRegistroNumeroAtencionSalud', $this->datos);
    }
    
    function cargar_vista_formulario_nuevo() {
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['tiposServicio'] = ServiciosModel::todos();
        $this->vista->mostrar('registro_numero_atencion_salud/formRegistroNumeroAtencionSalud', $this->datos);
    }

    function guardar_nuevo_numero_atencion_salud() {
        $idNumeroRegistroSalud = registroNumeroAtencionSaludModel::insertar(
                        $this->datos['ano-reporte'], $this->datos['mes-reporte'], $this->datos['centroSalud'], 
                        $this->datos['tipoServicio'], $this->datos['numPEMAR'], $this->datos['observaciones'],
                $this->datos['dir_archivo_soporte']);

        if ($idNumeroRegistroSalud > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registrado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_numero_atencion_salud() {
        $this->datos['registrosAtencion'] = registroNumeroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['tiposServicio'] = ServiciosModel::todos();
        $this->vista->mostrar('registro_numero_atencion_salud/formRegistroNumeroAtencionSalud', $this->datos);
    }
    
    function mostrar_datos_registro_numero_atencion() {
        $this->datos['registrosAtencion'] = registroNumeroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['tiposServicio'] = ServiciosModel::todos();
        $this->vista->mostrar('registro_numero_atencion_salud/VerRegistroNumeroAtencionSalud', $this->datos);
    }

    function editar_numero_atencion_salud() {

        $idNumeroRegistroSalud = registroNumeroAtencionSaludModel::update(
                        $this->datos['id_atencion_salud'], $this->datos['ano-reporte'],$this->datos['mes-reporte'],
                        $this->datos['centroSalud'], $this->datos['tipoServicio'], $this->datos['numPEMAR'], $this->datos['observaciones']
        );

        if ($idNumeroRegistroSalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_numero_atencion_salud() {
        $idNumeroRegistroSalud = registroNumeroAtencionSaludModel::eliminar(
                        $this->datos['id_atencion_salud']
        );
        if ($idNumeroRegistroSalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

}

?>