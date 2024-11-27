<?php

class tipo_centro_de_saludControlador extends ControllerBase {
    
    function mostrar_form_tipo_centro_de_salud(){        
        $this->vista->mostrar( "tipocentrodesalud/form_tipo_centro_de_salud", array());
    }
   
    function mostrar_editar_tipo_centro_de_salud(){      
        
        $this->datos['TipoCentroSalud'] = TiposCentrosSaludModel::datos( $this->datos['id_tipocentrosalud'] );
        
        $this->vista->mostrar( "tipocentrodesalud/form_tipo_centro_de_salud", $this->datos );
    }  
    
    
    function mostrar_tabla_tipo_centro_de_salud(){
        $this->datos['TiposCentrosSalud'] = TiposCentrosSaludModel::todos();
        
        $this->vista->mostrar( "tipocentrodesalud/tabla_tipo_centro_de_salud", $this->datos);
    }
    function agregar_tipo_centro_de_salud() {
        
        $idTipoCentroSalud = TiposCentrosSaludModel::insertar( 
                $this->datos['codigoTipoCentroDeSalud'], 
                $this->datos['nombreTipoCentroDeSalud'],
                $this->datos['observacionesTipoCentroDeSalud']
        );        
        if( $idTipoCentroSalud > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    
    function editar_tipo_centro_de_salud() {        
               
        $idTipoCS = TiposCentrosSaludModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['codigoTipoCentroDeSalud'], 
                $this->datos['nombreTipoCentroDeSalud'], 
                $this->datos['observacionesTipoCentroDeSalud']
        );      
        if( $idTipoCS > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    
    
    
    function eliminar_tipo_centros_salud() {        
        $idTipoCS= TiposCentrosSaludModel::eliminar(  
                $this->datos['id_tipocentrosalud']
        );        
        if( $idTipoCS > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Tipo de Centro de Salud Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
?>