<?php

class alcanceTSControlador extends ControllerBase {
    
    function mostrar_alcance_TS(){   
        $this->datos['AlcanceTS'] = AlcanceTSModel::todos();        
        $this->vista->mostrar( "alcance_TS/tablaAlcanceTS", $this->datos);
    }
    
    function nuevo_form_alcance_TS(){   
        $this->datos['Temas'] = TemasModel::todos(); 
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::todas_parroquias();

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();
        
        $this->datos['Insumos'] = InsumosModel::todos();
        
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        
        $this->vista->mostrar( "alcance_TS/TrabajoAlcanceAPares", $this->datos);
    }
    
    function agregar_alcance_TS() {
        
        $idTipoLugar = TiposLugaresModel::insertar(  
                $this->datos['codigoTipoLugar'], 
                $this->datos['nombreTipoLugar'], 
                $this->datos['observacionesTipoLugar']
        );        
        if( $idTipoLugar > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
       
    function editar_form_alcance_TS(){   
        $this->datos['Temas'] = TemasModel::todos(); 
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['parroquias'] = UbicacionesModel::todas_parroquias();

        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Animadores'] = AgentesModel::animadores();
        
        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();
        
        $this->datos['Insumos'] = InsumosModel::todos();
        
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        
        
        $this->datos['$datosAlcanceTS'] = AlcanceTSModel::datos( $this->datos['id_alcanceTS'] ); 
        
        $this->vista->mostrar( "alcance_TS/TrabajoAlcanceAPares", $this->datos);
    }
    
    
    
    function editar_tipo_lugar() {        
               
        $idTipoLugar = TiposLugaresModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['codigoTipoLugar'], 
                $this->datos['nombreTipoLugar'], 
                $this->datos['observacionesTipoLugar']
        );      
        if( $idTipoLugar > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    
    
    
    function eliminar_tipo_lugar() {        
        $idTipoLugar = TiposLugaresModel::eliminar(  
                $this->datos['id_tipolugar']
        );        
        if( $idTipoLugar > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
}
?>