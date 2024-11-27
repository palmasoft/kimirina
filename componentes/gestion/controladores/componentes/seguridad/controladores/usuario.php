<?php

class usuarioControlador extends ControllerBase {

    function mostrar_tabla_usuario() {

        $this->datos['Usuario'] = UsuariosModel::todos();
        $this->vista->mostrar("usuario/tablaUsuario", $this->datos);
    }

    function nuevo_form_usuario() {

        $this->datos['Modulo'] = modulosUsuariosModel::todos();
        $this->datos['Permisos'] = FuncionesModel::todas_funciones();
        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        $this->datos['perteneceA'] = PersonasSistemaModel::todos();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();

        $this->datos['permisosSel'] = array();

        $modulos = FuncionesModel::todos_modulos();
        foreach ($modulos as $modulo) {
            $modulo->FUNCIONES = FuncionesModel::todos_menus_modulo($modulo->ID_MODULO);
        }
        $this->datos['Permisos'] = $modulos;

        $this->vista->mostrar("usuario/formUsuario", $this->datos);
    }

    function agregar_nuevo_usuario() {

        $idUsuario = UsuariosModel::nuevoSinFoto($this->datos['nick'], $this->datos['password'], $this->datos['email']);
        $idPersonaSis = PersonasSistemaModel::asociar_usuario_persona($idUsuario, $this->datos['idPersona']);
        foreach ($this->datos['permiso'] as $permiso) {
            UsuariosModel::insertarPermisos($idUsuario, $permiso);
        }

        if ($idUsuario > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_usuario() {

        $this->datos['datosUsuario'] = UsuariosModel::datos_del_usuario($this->datos['id_usuario']);
        $this->datos['tipoUsuarioPermisos'] =  $this->datos['datosUsuario']->ID_ROL_TIPOUSUARIO;
        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        $this->datos['perteneceA'] = PersonasSistemaModel::todos();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['Modulo'] = modulosUsuariosModel::todos();

        
        $this->datos['personas'] = PersonasSistemaModel::personas_en_idTipoPersona( $this->datos['tipoUsuarioPermisos'] );
        $objPermisosUsusario = UsuariosModel::permisos($this->datos['id_usuario']);
        $this->datos['permisosSel'] = array();
        if (!empty($objPermisosUsusario)) {
            foreach ($objPermisosUsusario as $permiso) {
                array_push($this->datos['permisosSel'], $permiso->ID_MENU);
            }
        }

        $modulos = FuncionesModel::todos_modulos();
        foreach ($modulos as $modulo) {
            $modulo->FUNCIONES = FuncionesModel::todos_menus_modulo($modulo->ID_MODULO);
        }
        $this->datos['Permisos'] = $modulos;
        
        $this->vista->mostrar("usuario/formUsuario", $this->datos);
    }

    function editar_datos_usuario() {

        $idUpdate = UsuariosModel::editarSinFoto(
                        $this->datos['registro-id'], $this->datos['nick'], $this->datos['password'], $this->datos['email']
        );

        $idPersonaSis = PersonasSistemaModel::asociar_usuario_persona($this->datos['registro-id'], $this->datos['idPersona']);

        UsuariosModel::eliminarPermisos($this->datos['registro-id']);
        foreach ($this->datos['permiso'] as $permiso) {
            $idUpdate += UsuariosModel::insertarPermisos($this->datos['registro-id'], $permiso);
        }

        if ($idUpdate > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Guardar Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_usuario() {
        $objUsuario = UsuariosModel::datos_del_usuario($this->datos['id_usuario']);
        if ($objUsuario->ESTADO == 'ACTIVO') {

            $idUsuarioDesactiva = UsuariosModel::desactivar( $this->datos['id_usuario'] );
            if ($idUsuarioDesactiva > 0) {
                echo '{"resultado":"EXITO", "mensaje":"Registro Desactivado Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido desactivar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
            
        } else {

            $idUsuarioDesactiva = UsuariosModel::activar( $this->datos['id_usuario'] );
            if ($idUsuarioDesactiva > 0) {
                echo '{"resultado":"EXITO", "mensaje":"Registro Desactivado Exitosamente"}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido desactivar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
            
        }
        
        
    }

}
