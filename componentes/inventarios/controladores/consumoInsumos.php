<?php


class consumoinsumosControlador extends ControllerBase {

    function mostrar_tabla_consumo_insumos() {

        $this->datos['ConsumoInsumos'] = ConsumoInsumosModel::todos();
        $this->vista->mostrar("consumo_insumos/tablaConsumoInsumos", $this->datos);
    }
}
    
?>