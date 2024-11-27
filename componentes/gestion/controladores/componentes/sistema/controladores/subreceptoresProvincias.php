<?php

class subreceptoresProvinciasControlador extends ControllerBase {

    function mostrar_tabla_subreceptores_provincias() {

        $this->datos['SubreceptorProvincia'] = SubreceptoresModel::todos_con_provincia();
        
        $this->vista->mostrar("provincias_subreceptores/tablaProvinciaSubreceptores", $this->datos);
    }
    function nuevo_form_subreceptores_provincias() {

        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();

        $this->vista->mostrar("provincias_subreceptores/formProvinciaSubreceptores", $this->datos);
    }

    function agregar_nuevo_subreceptores_provincias() {
        
        $idSubProvincia = SubreceptoresModel::subreceptorProvincia($this->datos['id_subreceptor'], $this->datos['provincia-chosen']);
        
        if ($idSubProvincia > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_subreceptores_provincias() {

        $this->datos['datosSubreceptor'] = SubreceptoresModel::datos_subreceptorProvincia($this->datos['registro_id']);
        
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();

        $this->vista->mostrar("provincias_subreceptores/formProvinciaSubreceptores", $this->datos);
    }

    function editar_subreceptores_provincias() {

        $idSubProvincia = SubreceptoresModel::updateProvincia($this->datos['id_subreceptor'], $idSubreceptor, $idProvincia);

        if ($idSubProvincia > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
}

?>
