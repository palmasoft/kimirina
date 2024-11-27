<?php


class existenciasInsumosControlador extends ControllerBase {

    function mostrar_tabla_existencias_insumos() {

        $this->datos['Insumos'] = InsumosModel::todos();
        $this->vista->mostrar("existencias_insumos/tablaExistenciasInsumos", $this->datos);
    }
}
    
?>
