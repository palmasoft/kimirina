<?php

class tipousuarioControlador extends ControllerBase {

    function mostrar_tabla_tipo_usuario() {

        $this->datos['TipoUsuario'] = TiposUsuariosModel::todos();
        $this->vista->mostrar("tipo_usuario/tablaTipoUsuario", $this->datos);
    }

    function editar_form_tipo_usuario() {
        
        $this->datos['datosTipoUsuario'] = TiposUsuariosModel::datos($this->datos['id_tipo_usuario']);
        $this->datos['tipoUsuarioPermisos'] = $this->datos['datosTipoUsuario']->ID_ROL;
        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        
        $permisos = $this->datos['datosTipoUsuario']->PERMISOS_ROL;
        $this->datos['permisosSel'] = json_decode($permisos);
        
        
        $modulos = FuncionesModel::todos_modulos();
        foreach ($modulos as $modulo) {
            $modulo->FUNCIONES = FuncionesModel::todos_menus_modulo( $modulo->ID_MODULO );
        }        
        $this->datos['Permisos'] = $modulos;   
        $this->vista->mostrar("tipo_usuario/formTipoUsuario", $this->datos);
    }
    
    function update_tipo_usuario() {
        
        $datosJson = "";
        if( isset($this->datos['permiso']) ){
            $datosJson = json_encode($this->datos['permiso']);
        }
        
        $idTipoUsuario= TiposUsuariosModel::update(
                $this->datos['registro-id'], $this->datos['codRol'], 
                $this->datos['nombreRol'], $this->datos['observaciones'], $datosJson
         );
        
        if ($idTipoUsuario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function check_permisos_tipo_usuario(){
        
        $this->datos['datosTipoUsuario'] = TiposUsuariosModel::datos($this->datos['id_tipo_usuario']);        
        $this->datos['tipoUsuarioPermisos'] = $this->datos['datosTipoUsuario']->ID_ROL;
        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        
        $permisos = $this->datos['datosTipoUsuario']->PERMISOS_ROL;
        $this->datos['permisosSel'] = json_decode($permisos);        
         
        $modulos = FuncionesModel::todos_modulos();
        foreach ($modulos as $modulo) {
            $modulo->FUNCIONES = FuncionesModel::todos_menus_modulo( $modulo->ID_MODULO );
        }        
        $this->datos['Permisos'] = $modulos; 
        
        $this->vista->mostrar("tipo_usuario/listaPermisosUsuario", $this->datos);
        
    }
    
}