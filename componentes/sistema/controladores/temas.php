<?php
class temasControlador extends ControllerBase {
    
    function mostrar_tabla_temas(){     
        $this->datos['Temas'] = TemasModel::todos(); 
        $this->vista->mostrar( "temas/tablaTemas", $this->datos);
    }
    function mostrar_formulario_temas(){     
        
        $this->vista->mostrar( "temas/formTemas", $this->datos);
    }
    
    function agregar_tema(){
        
        $idTema = TemasModel::insertar(  
                $this->datos['tituloTema'], 
                $this->datos['descripcionTema'], 
                $this->datos['instruccionesTema']
        );
        
        if( $idTema > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
     function eliminar_tema(){        
        
         $idTema = TemasModel::eliminar(  
                $this->datos['id_tema']
        );        
        if( $idTema > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }         
    }
    
    function editar_form_tema(){   
        
        $this->datos['tema'] = TemasModel::datos( $this->datos['id_tema'] );      
        $this->vista->mostrar( "temas/formTemas", $this->datos);
    }
        
    function editar_tema() {        
               
        $idTema = TemasModel::update(  
                $this->datos['registro-id'] ,
                $this->datos['tituloTema'], 
                $this->datos['descripcionTema'], 
                $this->datos['instruccionesTema']
        );      
        if( $idTema > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
     
}
?>