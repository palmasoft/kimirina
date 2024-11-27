<?php

class lugaresIntervencionControlador extends ControllerBase {

    public function lista_seleccion_lugares() {
        $datos = LugaresIntervencionModel::todos();
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_LUGAR', 'ID_LUGAR', 'sel-lista-lugar_intervencion', '', ' ', ' ', ' select-chosen  ', ' width: 100%; ', false, 'seleccione uno', 'canton-formulario'
        );
    }

    public function lista_seleccion_lugares_por_tipo() {
        $datos = LugaresIntervencionModel::lugares_del_tipo_provincia_canton($this->datos['id_tipolugar'], $this->datos['id_Provincia'], $this->datos['id_Canton']);

        $nombreLista = isset($this->datos['idLista']) ? $this->datos['idLista'] : 'sel-lista-lugar_intervencion';

        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_LUGAR', 'ID_LUGAR', $nombreLista, '', ' ', ' ', ' select-chosen  ', ' width: 100%; ', false, 'seleccione uno', 'canton-formulario'
        );
    }

    public function lista_seleccion_lugares_por_tipo_obligatorio() {
        $datos = LugaresIntervencionModel::lugares_del_tipo($this->datos['id_tipolugar']);

        $nombreLista = isset($this->datos['idLista']) ? $this->datos['idLista'] : 'sel-lista-lugar_intervencion';

        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_LUGAR', 'ID_LUGAR', $nombreLista, '', ' ', ' ', ' select-chosen  ', ' width: 100%; ', false, 'seleccione uno', 'canton-formulario'
        );
    }

    public function cargar_vista_formulario_lugares_intervencion() {
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();

        $this->vista->mostrar('lugares_intervencion/form_lugares_intervencion', $this->datos);
    }

    public function cargar_vista_lugares_intervencion() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();

        $this->vista->mostrar('lugares_intervencion/tabla_lugares_intervencion', $this->datos);
    }

    public function busqueda_lugares_intervencion() {

        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();

        $provincia = $this->datos['provincia-chosen'];
        $canton = $this->datos['sel-lista-cantones'];
        $tipoLugar = $this->datos['tipo-lugar'];

        if (($provincia == "") && ($canton == "") && ($tipoLugar == "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::todos();
        } else if (($provincia != "") && ($canton != "") && ($tipoLugar != "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_del_tipo_provincia_canton($tipoLugar, $provincia, $canton);
        } else if (($provincia != "") && ($canton != "") && ($tipoLugar == "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_provincia_canton($provincia, $canton);
        } else if (($provincia != "") && ($canton == "") && ($tipoLugar != "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_provincia_tipolugar($tipoLugar, $provincia);
        } else if (($provincia == "") && ($canton != "") && ($tipoLugar != "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_canton_tipolugar($tipoLugar, $canton);
        } else if (($provincia != "") && ($canton == "") && ($tipoLugar == "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_provincia($provincia);
        } else if (($provincia == "") && ($canton != "") && ($tipoLugar == "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_canton($canton);
        } else if (($provincia == "") && ($canton == "") && ($tipoLugar != "")) {
            $this->datos['lugaresIntervencion'] = LugaresIntervencionModel::lugares_en_tipolugar($tipoLugar);
        }

        if ($provincia != "") {
            $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($provincia);
        }


        $this->datos['datos_filtro']->ID_PROVINCIA = $provincia;
        $this->datos['datos_filtro']->ID_CANTON = $canton;
        $this->datos['datos_filtro']->ID_TIPOLUGAR = $tipoLugar;
        $this->vista->mostrar('lugares_intervencion/tabla_lugares_intervencion', $this->datos);
    }

    function guardar_nuevo_lugar_intervencion() {
        $idLugarIntervencion = LugaresIntervencionModel::insertar(
                        $this->datos['tipoLugar'], $this->datos['cantones'], $this->datos['nombreLugar'], $this->datos['direccionLugar'], $this->datos['telefonoLugar'], $this->datos['nombreContacto'], $this->datos['telefonoContacto'], $this->datos['correoContacto'], $this->datos['web'], $this->datos['gps_lat_marcador'], $this->datos['gps_lon_marcador'], $this->datos['referencia'], $this->datos['observaciones']
        );

        if ($idLugarIntervencion > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Lugar de Intervencion <strong>' . $this->datos['nombreLugar'] . '</strong> creado exitosamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_lugar_intervencion() {

        $idlugarintevencion = LugaresIntervencionModel::eliminar(
                        $this->datos['id_lugar']
        );

        if ($idlugarintevencion > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_lugar_intervencion() {
        $this->datos['lugarIntervencion'] = LugaresIntervencionModel::datos($this->datos['id_lugar']);
        $this->datos['LATITUD_LUGAR'] = $this->datos['lugarIntervencion']->LATITUD_LUGAR;
        $this->datos['LONGITUD_LUGAR'] = $this->datos['lugarIntervencion']->LONGITUD_LUGAR;
        
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['lugarIntervencion']->ID_PROVINCIA);
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();

        $this->vista->mostrar('lugares_intervencion/form_lugares_intervencion', $this->datos);
    }

    function nombre_responsable() {
        $LUGAR = LugaresIntervencionModel::datos($this->datos['idLugar']);
        echo $LUGAR->CONTACTO_LUGAR;
    }

    function editar_lugar_intervencion() {
        $idLugarIntervencion = LugaresIntervencionModel::update(
                        $this->datos['registro-id'], $this->datos['tipoLugar'], $this->datos['cantones'], $this->datos['nombreLugar'], $this->datos['direccionLugar'], $this->datos['telefonoLugar'], $this->datos['nombreContacto'], $this->datos['telefonoContacto'], $this->datos['correoContacto'], $this->datos['web'], $this->datos['gps_lat_marcador'], $this->datos['gps_lon_marcador'], $this->datos['referencia'], $this->datos['observaciones']
        );
        if ($idLugarIntervencion > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Lugar de Intervencion <strong>' . $this->datos['nombreLugar'] . '</strong> Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
