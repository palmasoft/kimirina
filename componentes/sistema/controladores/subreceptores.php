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
                $this->datos['registro-id'], $this->datos['codigo_subreceptor'], 
                $this->datos['siglas_subreceptor'], $this->datos['nombre_subreceptor'], 
                $this->datos['edad_min_subreceptor'], $this->datos['edad_max_subreceptor'], $this->datos['max_condones_subreceptor'], 
                $this->datos['gestor'],
                $this->datos['provincia_subreceptor'], $this->datos['canton_subreceptor'],
                $this->datos['direccion_subreceptor'], $this->datos['telefono_subreceptor'], $this->datos['contacto_subreceptor'],  
                $this->datos['web_subreceptor'], $this->datos['logo_subreceptor'], 
                $this->datos['gps_lat_marcador'],  $this->datos['gps_lon_marcador']
                
        );

        SubreceptoresModel::borrar_tipo_poblacion($this->datos['registro-id']);
        if (!empty($this->datos['poblacion'])) {
            foreach ($this->datos['poblacion'] as $poblaciones) {
                SubreceptoresModel::insertar_lugares($this->datos['registro-id'], $poblaciones);
            }
        }

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Se ha actrualizado la informacion del <strong>SUBRECEPTOR</strong> correctamente."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function editar_form_subreceptores() {
        $this->datos['subreceptor'] = SubreceptoresModel::datos_subreceptor($this->datos['id_subreceptor']);
        $this->datos['gestores'] = PersonasSistemaModel::personas_en_idTipoPersona(5);
        $this->datos['tiposPoblacion'] = TiposPoblacionModel::todos();
        $this->datos['subreceptor']->TIPOS_POBLACION = SubreceptoresModel::id_tipos_poblacion($this->datos['subreceptor']->ID_SUBRECEPTOR);
        
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['subreceptor']->PROVINCIA_SUBRECEPTOR);
        $rutaDir = "archivos".DS."logos".DS."subreceptores".DS;
        $this->datos['logos'] = Archivos::listar_archivos_directorio($rutaDir);
        $this->datos['LATITUD_LUGAR'] = $this->datos['subreceptor']->LATITUD_SUBRECEPTOR;
        $this->datos['LONGITUD_LUGAR'] = $this->datos['subreceptor']->LONGITUD_SUBRECEPTOR;
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