<?php

class subreceptoresControlador extends ControllerBase {

    function cargar_vista_listado_subreceptores() {
        $this->datos['subreceptores'] = SubreceptoresModel::todos_gestor();
        foreach ($this->datos['subreceptores'] as $indice => $value) {
            $this->datos['subreceptores'][$indice]->TIPOS_POBLACION = SubreceptoresModel::tipos_poblacion($value->ID_SUBRECEPTOR);
        }
        $this->vista->mostrar('subreceptores/listadoSubreceptores', $this->datos);
    }

    public function editar_subreceptor() {
        $id = SubreceptoresModel::update(
                        $this->datos['registro-id'], $this->datos['codigo_subreceptor'], $this->datos['siglas_subreceptor'], $this->datos['nombre_subreceptor'], $this->datos['edad_min_subreceptor'], $this->datos['edad_max_subreceptor'], $this->datos['max_condones_subreceptor'], $this->datos['gestor']
        );

        SubreceptoresModel::borrar_tipo_poblacion($this->datos['registro-id']);
        if (!empty($this->datos['poblacion'])) {
            foreach ($this->datos['poblacion'] as $poblaciones) {
                SubreceptoresModel::insertar_lugares($this->datos['registro-id'], $poblaciones);
            }
        }

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Exitoso"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function editar_form_subreceptores() {
        $this->datos['subreceptor'] = SubreceptoresModel::datos_subreceptor($this->datos['id_subreceptor']);
        $this->datos['gestores'] = PersonasSistemaModel::personas_en_idTipoPersona(5);
        $this->datos['tiposPoblacion'] = TiposPoblacionModel::todos();
        $this->datos['subreceptor']->TIPOS_POBLACION = SubreceptoresModel::id_tipos_poblacion($this->datos['subreceptor']->ID_SUBRECEPTOR);
        //print_r($this->datos['subreceptor']);
        $this->vista->mostrar("subreceptores/formSubreceptores", $this->datos);
    }

    public function lista_tipos_poblacion() {
        $datos = SubreceptoresModel::id_tipos_poblacion($this->datos['id_subreceptor']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'CODIGO_TIPOPOBLACION', 'ID_TIPOPOBLACION', $this->datos['id_lista'], '', '', 
                '', ' select-chosen', '  ', false, 
                'seleccione uno', 'tipos_poblacion_subreceptor'
        );
    }

    public function tipos_poblacion() {
        $tipoPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($this->datos['idSubreceptor']);
        echo json_encode($tipoPobSubreceptor);
    }

    public function tipos_poblacion_todos() {
        $tipoPobSubreceptor = SubreceptoresModel::tipos_poblacion_todos();
        echo json_encode($tipoPobSubreceptor);
    }

}

?>