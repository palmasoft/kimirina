<?php

class ArticulosControlador extends ControllerBase {

    public function mostrar_listado_articulos() {

        $_SESSION['ruta'] = array(
            'Domicilios' => '#',
            'Productos' => '#',
            'Listado' => '#'
        );

        $mProductos = $this->modelo->cargar('articulos');
        $this->datos['productos'] = $mProductos->todos_los_articulos();
        $this->vista->mostrar( "articulos/listado", $this->datos);
    }


}

?>