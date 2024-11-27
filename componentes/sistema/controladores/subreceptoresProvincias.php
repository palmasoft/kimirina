<?php

class subreceptoresProvinciasControlador extends ControllerBase {

    function mostrar_cambiar_provincias_subreceptor() {

        $this->datos['provinciasSubreceptor'] = SubreceptoresProvinciasModel::provincias_subreceptor($this->datos['subreceptor_id']);
        if ($this->datos['provinciasSubreceptor'] == 0) {
            $this->datos['provinciasSubreceptor'] = array();
        }
        $this->datos['Subreceptor'] = SubreceptoresModel::datos($this->datos['subreceptor_id']);
        $this->datos['Provincias'] = UbicacionesModel::provincias();

        $this->vista->mostrar("provincias_subreceptores/formProvinciasSubreceptor", $this->datos);
    }

    function mostrar_tabla_subreceptores_provincias() {

        $this->datos['SubreceptorProvincia'] = SubreceptoresProvinciasModel::todos_con_provincia();
        $this->datos['SubReceptores'] = SubreceptoresModel::todos();
        $this->vista->mostrar("provincias_subreceptores/tablaProvinciaSubreceptores", $this->datos);
    }

    function nuevo_form_subreceptores_provincias() {

        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();

        $this->vista->mostrar("provincias_subreceptores/formProvinciaSubreceptores", $this->datos);
    }

    function guardar_cambios_provincias_subreceptor() {
        $seCreo = 0;
        $seEliminaron = SubreceptoresProvinciasModel::eliminar_provincias_subreceptor($this->datos['idSubreceptor']);
        //if ($seEliminaron > 0) {
        foreach ($this->datos['provincias_subrecptor'] as $idProvincia) {
            $seCreo += SubreceptoresProvinciasModel::subreceptorProvincia($this->datos['idSubreceptor'], $idProvincia);
        }
        //}

        if (($seCreo + $seEliminaron) > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Se han actualizado <strong>las provincias asociadas</strong> al subreceptor Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function agregar_nuevo_subreceptores_provincias() {

        $idSubProvincia = SubreceptoresProvinciasModel::subreceptorProvincia($this->datos['id_subreceptor'], $this->datos['provincia-chosen']);

        if ($idSubProvincia > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_subreceptores_provincias() {

        $this->datos['datosSubreceptor'] = SubreceptoresProvinciasModel::datos_subreceptorProvincia($this->datos['registro_id']);
        if ($this->datos['datosSubreceptor'] == 0) {
            $this->datos['datosSubreceptor'] = array();
        }

        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();

        $this->vista->mostrar("provincias_subreceptores/formProvinciaSubreceptores", $this->datos);
    }

    function editar_subreceptores_provincias() {

        $idSubProvincia = SubreceptoresProvinciasModel::updateProvincia($this->datos['id_subreceptor'], $idSubreceptor, $idProvincia);

        if ($idSubProvincia > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_subreceptores_provincias() {

        $idSubProvincia = SubreceptoresProvinciasModel::eliminar($this->datos['id_subreceptor']);

        if ($idSubProvincia > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
