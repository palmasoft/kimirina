<?php

class mapaLugaresInvervencionControlador extends ControllerBase {

    function ver_mapa_lugares_intervencion() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();

        $this->vista->mostrar("lugaresIntervencion/mapaLugaresIntervencion", $this->datos);
    }

    function busqueda_mapa_lugares_intervencion() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();        
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['provincia-chosen']);
        $this->datos['tipoLugares'] = TiposLugaresModel::todos();
        
         $this->datos['idProvincia'] = $this->datos['provincia-chosen'];
         $this->datos['idCanton'] = $this->datos['sel-lista-cantones'];
         $this->datos['idTipoLugar'] = $this->datos['tipoLugar'];

        $this->datos['lugaresResultado'] = UbicacionesModel::lugares_filtrados(
                        $this->datos['provincia-chosen'],
                        $this->datos['sel-lista-cantones'],
                        $this->datos['tipoLugar']
        );
       
        $this->vista->mostrar("lugaresIntervencion/mapaLugaresIntervencion", $this->datos);
    }

}
