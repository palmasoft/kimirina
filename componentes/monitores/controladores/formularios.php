<?php

class formulariosControlador extends ControllerBase {
	
    public function administrador_formularios() {

        $_SESSION['ruta'] = array(
            'Monitores' => '#',
            'Formularios' => '#',
            'Listado' => '#'
        );

        $this->datos['formularios'] = FormulariosModel::todos();
        $this->datos['Consejeria'] = ConsejeriaPvvsModel::todos();
        
        $this->vista->mostrar( "formularios/listado", $this->datos);
    }

    public function nuevo_formulario_contacto() {
        $_SESSION['ruta'] = array(
            'Monitores' => '#',
            'Formularios' => '#',
            'Nuevo Formulario' => '#'
        );
        
        $this->datos['regiones'] = UbicacionesModel::todas_regiones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::todas_parroquias();
        
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        
        $this->datos['Temas'] = TemasModel::todos();         
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['ServiciosSalud'] = CentrosSaludModel::todos_servicios();
        $this->datos['Pemars'] = PemarsModel::todos();
        $this->datos['TiposPemar'] = PemarsModel::todos_tipos();
        
        $lista_codigos = array();
        if(count($this->datos['Pemars']) > 0);
            foreach ($this->datos['Pemars'] as $Pemar) {
                    $lista_codigos[] = '"'.$Pemar->CODIGO_UNICO_PERSONA.'"';
            }        
        $this->datos['lista_codigos_pemar'] = $lista_codigos;                
       

        $this->vista->mostrar( "formularios/RegistroSemanalContacto", $this->datos);
    }

    public function formulario_nuevo_contacto() {        
        $this->datos['TipoLugares'] = TiposLugaresModel::todos();
        
        $this->datos['temas'] = TemasModel::todos();         
        $this->datos['centros_salud'] = CentrosSaludModel::todos();
        $this->datos['servicios_salud'] = CentrosSaludModel::todos_servicios();
        $this->datos['pemars'] = PemarsModel::todos();
        $this->datos['tipos_pemars'] = PemarsModel::todos_tipos();
        
        $lista_codigos = array();
        if(count($this->datos['pemars']) > 0);
            foreach ($this->datos['pemars'] as $Pemar) {
                    $lista_codigos[] = '"'.$Pemar->CODIGO_UNICO_PERSONA.'"';
            }        
        $this->datos['lista_codigos_pemar'] = $lista_codigos;                
        
        //$this->datos['regiones'] = UbicacionesModel::todas_regiones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::parroquias_en_el_canton( $this->datos['id_canton'] );
        
        $this->vista->mostrar( "formularios/modal", $this->datos);
    }
 
    
    
    
    
    
    
    public function mostrar_formulario_alcance_TS() {
        $_SESSION['ruta'] = array(
            'Monitores' => '#',
            'Formularios' => '#',
            'Nuevo Formulario' => '#'
        );
        
        //$this->datos['regiones'] = UbicacionesModel::todas_regiones();
        $this->datos['Temas'] = TemasModel::todos(); 
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::todas_parroquias();

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();
        
        $this->datos['Insumos'] = InsumosModel::todos();
        
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();

        $this->vista->mostrar( "formularios/TrabajoAlcanceAPares", $this->datos);
    }

    
    
    
    function mostrar_formulario_recibo_pemar(){
        
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();
        
        $this->datos['Lugares'] = LugaresIntervencionModel::todos();
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['TiposPemars'] = TiposPoblacionModel::todos_tipos_poblacion();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        
        $this->datos['Temas'] = TemasModel::todos();  
        $this->datos['Insumos'] = InsumosModel::todos();        
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->vista->mostrar( "formularios/ReciboContactoPEMAR", $this->datos);
       
    }
    
    
}

?>