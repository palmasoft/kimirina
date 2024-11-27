<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class mapaCentrosSaludControlador extends ControllerBase {

    function ver_mapa_centros_salud() {
        $this->datos['provincias'] = UbicacionesModel::provincias();
        $this->datos['cantones'] = array();
        $this->datos['tipoLugares'] = TiposCentrosSaludModel::todos();

        $this->datos['lugaresResultado'] = CentrosSaludModel::todos();

        $this->vista->mostrar("mapas/basico_centros_salud", $this->datos);
    }

    function centros_salud_json() {
        $unidadesSalud = CentrosSaludModel::todos();
        if (!empty($this->datos['poblacion'])) {
            $unidadesSalud = CentrosSaludModel::filtrados_por($this->datos['provincia'], $this->datos['canton'], $this->datos['poblacion']);
        } else {
            if ($this->datos['provincia'] > 0) {                
                $unidadesSalud = CentrosSaludModel::en_la_provincia($this->datos['provincia']);
            }
            if ($this->datos['canton'] > 0) {
                $unidadesSalud = CentrosSaludModel::en_el_canton($this->datos['canton']);
            }
        }

        echo json_encode($unidadesSalud);
    }

    function subreceptores_json() {
        $subreceptores = SubreceptoresModel::todos();
        if ($this->datos['provincia'] > 0) {
            $subreceptores = SubreceptoresModel::en_la_provincia($this->datos['provincia']);
        }        
        if ($this->datos['canton'] > 0) {
            $subreceptores = SubreceptoresModel::en_el_canton($this->datos['canton']);
        }
        echo json_encode($subreceptores);
    }

    function busqueda_mapa_centros_salud() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();

        $this->datos['lugaresResultado'] = UbicacionesModel::lugares_filtrados(
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'], $this->datos['tipoLugar']
        );

        $this->vista->mostrar("lugaresIntervencion/mapaLugaresIntervencion", $this->datos);
    }

}
