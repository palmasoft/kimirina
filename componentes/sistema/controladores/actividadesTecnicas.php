<?php

class actividadesTecnicasControlador extends ControllerBase {
   
    function mostrar_tabla_actividades_tecnicas(){
        $this->datos['actividadesTecnicas'] = ActividadesTecnicasModel::todos();
        $this->vista->mostrar("actividades_tecnicas/tablaActividadesTecnicas", $this->datos);
    }
	
    function mostrar_formulario_actividades_tecnicas(){ 
        $this->vista->mostrar( "actividades_tecnicas/formActividadesTecnicas", array());
    }
     
    function agregar_actividad_tecnica() {
        $idActividadTecnica = ActividadesTecnicasModel::insertar(  
                $this->datos['nombreActividad'], 
                $this->datos['instruccionesActividad']
        );
        
        if( $idActividadTecnica > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    function eliminar_actividad() {        
        
         $idActividad = ActividadesTecnicasModel::eliminar(  
                $this->datos['id_actividad']
        );        
        if( $idActividad > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }         
    }
	
	function editar_form_actividad_tecnica(){  
        $this->datos['actividadTecnica'] = ActividadesTecnicasModel::datos($this->datos['id_actividad']);      
        $this->vista->mostrar( "actividades_tecnicas/formActividadesTecnicas", $this->datos);
    }
	
	function editar_actividad_tecnica() {        
               
        $idActividad = ActividadesTecnicasModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['nombreActividad'], 
                $this->datos['instruccionesActividad']
        );      
        if( $idActividad > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
	
}
?>