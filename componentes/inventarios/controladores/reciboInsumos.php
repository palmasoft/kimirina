<?php

class reciboinsumosControlador extends ControllerBase {

    function mostrar_tabla_recibo_insumos() {

        $this->datos['ReciboInsumos'] = ReciboInsumosModel::todos();
        $this->vista->mostrar("recibo_insumos/tablaReciboInsumos", $this->datos);
    }

    function nuevo_form_recibo_insumos() {

        $this->datos['Insumos'] = InsumosModel::todos();
        $this->datos['Persona'] = PersonasSistemaModel::todos();

        $this->vista->mostrar("recibo_insumos/formReciboInsumos", $this->datos);
    }

    function agregar_recibo_insumos() {

        InsumosModel::updateStock($this->datos['insumo'], $this->datos['cantidadInsumo']);
        $idReciboInsumos = ReciboInsumosModel::insertar(
                        $this->datos['insumo'], $this->datos['persona'], $this->datos['fechaRecibo'], $this->datos['cantidadInsumo'], $this->datos['loteReferencia']);

        if ($idReciboInsumos > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. Intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_recibo_insumos() {

        $this->datos['Insumos'] = InsumosModel::todos();
        $this->datos['Persona'] = PersonasSistemaModel::todos();
        $this->datos['datosInsumos'] = ReciboInsumosModel::datos($this->datos['id_recibo_insumos']);

        $this->vista->mostrar("recibo_insumos/formReciboInsumos", $this->datos);
    }

    function update_recibo_insumos() {

//        $idInsumos = InsumosModel::updateStock2($this->datos['insumo'],$this->datos['cantidadAnterior'], $this->datos['cantidadInsumo']);
        $idInsumosAnterior = InsumosModel::updateStockResta($this->datos['insumoAnterior'], $this->datos['cantidadAnterior']);
        $idInsumos = InsumosModel::updateStock($this->datos['insumo'], $this->datos['cantidadInsumo']);
        $idReciboInsumos = ReciboInsumosModel::update(
                        $this->datos['registro-id'], $this->datos['insumo'], $this->datos['persona'], $this->datos['fechaRecibo'], $this->datos['cantidadInsumo'], $this->datos['loteReferencia']);
        /*
         * Si se modifica solo el lote de referencia y se deja la misma cantidad de insumos
         * arroja un error
         */
        //print_r($idInsumos." Y ". $idReciboInsumos);
//        echo "idrecibo=".$idReciboInsumos." idinsumos=".$idInsumos;
        if (($idReciboInsumos + $idInsumos + $idInsumosAnterior) > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido modificar. Intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_recibo_insumo() {

        $datos = ReciboInsumosModel::datos($this->datos['id_recibo_insumos']);
        $idInsumos = InsumosModel::updateStockResta($datos->ID_INSUMO, $datos->CANTIDAD_RECIBOINSUMO);
        $idReciboInsumos = ReciboInsumosModel::eliminar($this->datos['id_recibo_insumos']);

        if ($idReciboInsumos > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Recibo de Insumos eliminado correctamente. "}';
        } else {
            echo '{ "resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

}
