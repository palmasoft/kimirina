<?php
class insumosControlador extends ControllerBase {
   
    function mostrar_tabla_insumos(){   
        $this->datos['Insumos'] = InsumosModel::todos();        
        $this->vista->mostrar( "insumos/tablaInsumos", $this->datos);
    }
    
    function mostrar_formulario_insumos(){        
        $this->vista->mostrar( "insumos/formInsumos", array());
    }
	
    function agregar_insumo() {
        $idInsumo = InsumosModel::insertar( 
                $this->datos['nombreInsumo'], 
                $this->datos['observacionesInsumo']
        );
        
        if( $idInsumo > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    function eliminar_insumo() {      
        
         $idInsumo = InsumosModel::eliminar(  
                $this->datos['id_insumo']
        );        
        if( $idInsumo > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }         
    }
    
	function editar_form_insumo(){  
        $this->datos['insumo'] = InsumosModel::datos($this->datos['id_insumo']);      
        $this->vista->mostrar( "insumos/formInsumos", $this->datos);
    }
	
	function editar_insumo() {        
               
        $idInsumo = InsumosModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['nombreInsumo'], 
                $this->datos['observacionesInsumo']
        );      
        if( $idInsumo > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
	
}
?>