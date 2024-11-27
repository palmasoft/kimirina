<?php

class mapaCentrosSaludControlador extends ControllerBase {

    function ver_mapa_centros_salud() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['tiposPoblacion'] = TiposPoblacionModel::todos_tipos_poblacion_para_web();
        $this->vista->mostrar("centrosSalud/mapaCentrosSalud", $this->datos);
    }

    function busqueda_mapa_centros_salud() {
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['provincia-chosen']);
        $this->datos['tiposPoblacion'] = TiposPoblacionModel::todos_tipos_poblacion_para_web();
        
        
         $this->datos['idProvincia'] = $this->datos['provincia-chosen'];
         $this->datos['idCanton'] = $this->datos['sel-lista-cantones'];
         $this->datos['idTipoPob'] = $this->datos['sel-lista-tiposPoblacion'];

        $this->datos['lugaresResultado'] = CentrosSaludModel::filtrados_por(                
                        $this->datos['provincia-chosen'],
                        $this->datos['sel-lista-cantones'],
                        $this->datos['sel-lista-tiposPoblacion']
        );
        
        
        $this->vista->mostrar("centrosSalud/mapaCentrosSalud", $this->datos);
    }

}