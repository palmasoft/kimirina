<?php

class lugaresConsejeriasControlador  extends ControllerBase {
    
    function cargar_vista_listado() {
    	$this->datos['lugaresConsejeria'] = LugaresConsejeriaModel::todos();      
        $this->vista->mostrar( 'lugares_consejeria/tabla_consejeria', $this->datos );
    }
     
    function cargar_vista_formulario_listado() {
        $this->vista->mostrar( 'lugares_consejeria/formularioConsejeria', $this->datos );
    }

    function guardar_nuevo_lugar_consejeria(){
    	$idlugarconsejeria = LugaresConsejeriaModel::insertar( 
                $this->datos['codigo_lugar_consejeria'], 
                $this->datos['nombre_lugar_consejeria'], 
                $this->datos['observaciones_lugar_consejeria']
        );
        
        if( $idlugarconsejeria > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Lugar Consejeria '.$this->datos['nombre_lugar_consejeria'].' Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    function editar_form_lugares_consejeria(){
        $this->datos['consejeria'] = LugaresConsejeriaModel::datos($this->datos['id_consejeria']);      
        $this->vista->mostrar( 'lugares_consejeria/formularioConsejeria', $this->datos );

    }
    function editar_consejeria(){
        $idlugarconsejeria = LugaresConsejeriaModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['codigo_lugar_consejeria'], 
                $this->datos['nombre_lugar_consejeria'],
                $this->datos['observaciones_lugar_consejeria']
        );      
        if( $idlugarconsejeria > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }

    }
    function eliminar_lugar_consejeria(){
        $idlugarconsejeria = LugaresConsejeriaModel::eliminar(
        $this->datos['id_consejeria']
        );        
        if( $idlugarconsejeria > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
}
?>