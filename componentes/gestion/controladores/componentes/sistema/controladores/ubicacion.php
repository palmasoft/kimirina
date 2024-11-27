<?php

class ubicacionControlador extends ControllerBase {

    public function lista_seleccion_regiones() {
        $datos = UbicacionesModel::todas_regiones();
        echo $this->formularios->Lista_Seleccion_Multipe(
                $datos, $campoTexto, $campoValor, $id_lista, $option = '00', $onclick = '', $onchange = '', $estilo = '', $multiple = false, $textoDefecto = '', $name = ''
        );
    }

    public function json_todas_provincias() {
        $datos = UbicacionesModel::provincias();
        echo json_encode($datos);
    }

    public function lista_seleccion_todas_provincias() {
        $datos = UbicacionesModel::todas_provincias();
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_PROVINCIA', 'ID_PROVINCIA', $this->datos['id_lista'], '', '', '', ' ', ' width: 100%; ', false, 'seleccione una', 'provincia-formulario'
        );
    }

    public function lista_seleccion_provincias() {
        $datos = UbicacionesModel::provincias_en_la_region($this->datos['id_region']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_PROVINCIA', 'ID_PROVINCIA', $this->datos['id_lista'], '', ' ', '', '  ', ' width: 100%; ', false, 'seleccione una', 'provincia-formulario'
        );
    }

    public function lista_seleccion_cantones() {
        $datos = UbicacionesModel::cantones_en_la_provincia($this->datos['id_provincia']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_CANTON', 'ID_CANTON', $this->datos['id_lista'], '', ' ', '', '  ', ' width: 100%; ', false, 'seleccione una', 'canton-formulario'
        );
    }

    public function lista_seleccion_lugares() {
        $datos = UbicacionesModel::lugares_del_tipo($this->datos['id_tipolugar']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_LUGAR', 'ID_LUGAR', 'sel-lista-lugar_intervencion', '', ' ', ' ', '  ', '  width: 100%;  ', false, 'seleccione uno', 'canton-formulario'
        );
    }

    public function json_cantones_en_la_provincia() {
        $datos = UbicacionesModel::cantones_en_la_provincia($this->datos['id_provincia']);
        echo json_encode($datos);
    }

    public function json_canton_por_nombre() {
        $datos = UbicacionesModel::canton_por_nombre($this->datos['nombre_canton']);
        echo json_encode($datos);
    }

    public function lista_seleccion_parroquias() {
        $datos = UbicacionesModel::parroquias_en_el_canton($this->datos['id_canton']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_PARROQUIA', 'ID_PARROQUIA', 'sel-lista-parroquias', '', '', '', ' select-chosen  ', ' width: 100%; ', false, 'seleccione una', 'parroquia-formulario'
        );
    }

    public function json_parroquias_en_el_canton() {
        $datos = UbicacionesModel::parroquias_en_el_canton($this->datos['id_canton']);
        echo json_encode($datos);
    }

    public function nombre_del_canton() {
        $canton = UbicacionesModel::canton($this->datos['canton']);
        echo $canton->NOMBRE_CANTON;
    }

    public function nombre_de_la_provincia() {
        $provincia = UbicacionesModel::provincia($this->datos['provincia']);
        echo $provincia->NOMBRE_PROVINCIA;
    }

}

?>