<?php

class esquemaArvControlador  extends ControllerBase {
    
    function cargar_vista_listado() {
    	$this->datos['esquemaArv'] = EsquemasArvModel::todos();        
        $this->vista->mostrar( 'esquemas_arv/listadoEsquemas_arv', $this->datos );
    }
     
    function cargar_vista_formulario_nuevo() {
        $this->vista->mostrar( 'esquemas_arv/formEsquemasArv', $this->datos );
    }

    function editar_form_esquema_arv(){           
        $this->datos['esquemasArv'] = EsquemasArvModel::datos( $this->datos['id_esquemasArv'] );      
        $this->vista->mostrar( 'esquemas_arv/formEsquemasArv', $this->datos );
    }
    function editar_esquema_arv() {                      
        $idEsquemaArv = EsquemasArvModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['codigoEsquema'], 
                $this->datos['nombreEsquema'], 
                $this->datos['observacionesEsquema']
        );      
        if( $idEsquemaArv > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    function guardar_nuevo_esquema_arv() {
        
        $idEsquemaArv = EsquemasArvModel::insertar( 
                $this->datos['codigoEsquema'], 
                $this->datos['nombreEsquema'], 
                $this->datos['observacionesEsquema']
        );
        
        if( $idEsquemaArv > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Esquema ARV '.$this->datos['nombreEsquema'].' Almacenado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
        
    }
    function eliminar_esquema_arv(){
    	$idEsquemaArv = EsquemasArvModel::eliminar(
                $this->datos['id_esquemasArv']
        );        
        if( $idEsquemaArv > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
}
?>