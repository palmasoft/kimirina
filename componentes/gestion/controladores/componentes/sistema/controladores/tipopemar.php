<?php

class tipopemarControlador extends ControllerBase {

    function mostrar_tipopemar() {
        $this->datos['TiposPemars'] = TiposPoblacionModel::todos();

        $this->vista->mostrar("tipo_poblacion/tablaTipoPoblacion", $this->datos);
    }

    function nuevo_form_tipo_pemar() {

        $this->vista->mostrar("tipo_poblacion/formTipoPoblacion", array());
    }

    function agregar_tipo_pemar() {
        $idTipoPemar = TiposPoblacionModel::insertar(
                        $this->datos['codigoTipoPemar'], $this->datos['nombreTipoPemar'], $this->datos['aliasTipoPemar'], $this->datos['observacionesTipoPemar'], $this->datos['mostrarTipoPemar']
        );
        if ($idTipoPemar > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_tipo_pemar() {
        $idTipoPemar = TiposPoblacionModel::eliminar(
                        $this->datos['id_tipopemar']
        );
        if ($idTipoPemar > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_tipo_pemar() {
        $this->datos['TipoPemar'] = TiposPoblacionModel::datos($this->datos['id_tipopemar']);
        $this->vista->mostrar("tipo_poblacion/formTipoPoblacion", $this->datos);
    }

    function editar_tipo_pemar() {
        $idTipoPemar = TiposPoblacionModel::update(
                        $this->datos['registro-id'], $this->datos['codigoTipoPemar'], $this->datos['nombreTipoPemar'], $this->datos['aliasTipoPemar'], $this->datos['observacionesTipoPemar'], $this->datos['mostrarTipoPemar']
        );
        if ($idTipoPemar > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
?>

