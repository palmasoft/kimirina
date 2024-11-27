<?php

class tipolugaresControlador extends ControllerBase {

    function mostrar_tipolugares() {
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->vista->mostrar("tipo_lugares/tablaTipoLugares", $this->datos);
    }

    function nuevo_form_tipo_lugares() {
        $this->vista->mostrar("tipo_lugares/formTipoLugares", array());
    }

    function agregar_tipo_lugar() {

        $idTipoLugar = TiposLugaresModel::insertar(
                        $this->datos['codigoTipoLugar'], $this->datos['nombreTipoLugar'], $this->datos['observacionesTipoLugar']
        );
        if ($idTipoLugar > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_tipo_lugares() {

        $this->datos['TipoLugar'] = TiposLugaresModel::datos($this->datos['id_tipolugar']);
        $this->vista->mostrar("tipo_lugares/formTipoLugares", $this->datos);
    }

    function editar_tipo_lugar() {

        $idTipoLugar = TiposLugaresModel::update(
                        $this->datos['registro-id'], $this->datos['codigoTipoLugar'], $this->datos['nombreTipoLugar'], $this->datos['observacionesTipoLugar']
        );
        if ($idTipoLugar > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_tipo_lugar() {
        $idTipoLugar = TiposLugaresModel::eliminar(
                        $this->datos['id_tipolugar']
        );
        if ($idTipoLugar > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
