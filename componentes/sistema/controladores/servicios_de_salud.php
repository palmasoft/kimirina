<?php

class servicios_de_saludControlador extends ControllerBase {
   
    function mostrar_formulario_servicios_de_salud(){        
        $this->vista->mostrar( "servicios_de_salud/form_servicios_de_salud", array());
    }
    function mostrar_tabla_servicios_de_salud(){    
        $this->datos['serviciosSalud'] = ServiciosModel::todos();        
        $this->vista->mostrar( "servicios_de_salud/tabla_servicios_de_salud", $this->datos );
    }
    function agregar_servicio_de_salud() {
        
        $idServicioSalud = ServiciosModel::insertar(
                $this->datos['nombreServicioDeSalud'], 
                $this->datos['codigoServicioDeSalud'],
                $this->datos['observacionesServicioDeSalud'],
                $this->datos['nivelServicioDeSalud']
        );        
        if( $idServicioSalud > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_servicios_salud(){
        $this->datos['servicioSalud'] = ServiciosModel::datos($this->datos['id_servicio_salud']);      
        $this->vista->mostrar( 'servicios_de_salud/form_servicios_de_salud', $this->datos );
    }

    function eliminar_servicios_salud(){
        $idServicioSalud = ServiciosModel::eliminar(
            $this->datos['id_servicio_salud']
        );        
        if( $idServicioSalud > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
        
    }
    function editar_servicio_de_salud(){
        $idServicioSalud = ServiciosModel::update(
                $this->datos['registro-id'] ,
                $this->datos['nombreServicioDeSalud'], 
                $this->datos['codigoServicioDeSalud'],
                $this->datos['observacionesServicioDeSalud'],
                $this->datos['nivelServicioDeSalud']
        );        
        if( $idServicioSalud > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}?>