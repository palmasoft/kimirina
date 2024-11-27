<?php

class gestoresSubreceptoresControlador extends ControllerBase {

    function ver_lista_gestores_subreceptores() {        
        $this->datos['datosGestoresSubreceptores'] = gestoresSubreceptoresModel::todos();
        
        $this->vista->mostrar("gestores_subreceptores/listado_gestores_subreceptores", $this->datos);
    }
    
    function mostrar_form_gestores_subreceptores() {
        $this->datos['gestores'] = PersonasSistemaModel::personas_en_idTipoPersona(5);
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
       
        $this->vista->mostrar("gestores_subreceptores/form_gestores_subreceptores", $this->datos);
    }
     public function editar_gestor_subreceptores() {
        $id = gestoresSubreceptoresMOdel::update(
                        $this->datos['registro-id'], $this->datos['gestor'], $this->datos['subreceptor']
        );

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Exitoso"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    public function editar_form_gestor_subreceptores() {
        $this->datos['datosGestoresSubreceptores'] = gestoresSubreceptoresModel::datos($this->datos['id_gestor_subreceptor']);
        $this->datos['gestores'] = PersonasSistemaModel::personas_en_idTipoPersona(5);
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        
        $this->vista->mostrar("gestores_subreceptores/form_gestores_subreceptores", $this->datos);
    }
    public function guardar_nuevo_gestor_subreceptor() {
        $id = gestoresSubreceptoresMOdel::insertar(
                        $this->datos['gestor'], $this->datos['subreceptor']
        );

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Exitoso"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    function eliminar_gestor_subreceptores(){
    	$id = gestoresSubreceptoresMOdel::eliminar(
               $this->datos['id_gestor_subreceptor']
        );        
        if( $id > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
   
    
}
