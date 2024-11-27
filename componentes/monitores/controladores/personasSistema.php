<?php

class personasSistemaControlador extends ControllerBase {

    function cargar_vista_listado() {
        $this->datos['PersonasSistema'] = PersonasSistemaModel::todos();
        $this->vista->mostrar('personas_sistema/listadoPersonaSistema', $this->datos);
    }

    function cargar_vista_formulario_nuevo() {

        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        $this->datos['tiposPoblacion'] = tiposPoblacionModel::todos();
        $this->datos['perteneceA'] = PersonasSistemaModel::todos();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->vista->mostrar('personas_sistema/formPersonaSistema', $this->datos);
    }

    function guardar_nueva_persona_sistema() {
        $idPersonaSistema = PersonasSistemaModel::insertar(
                        $this->datos['tipoUsuario'], $this->datos['tiposPoblacion'], $this->datos['cantones'], $this->datos['nombreReal'], $this->datos['nombreOtro'], $this->datos['identificacion'], $this->datos['telefono'], $this->datos['correo'], $this->datos['direccion'], $this->datos['fechaNacimiento'], $this->datos['observaciones'], $this->datos['perteneceA'], $this->datos['subreceptor']
        );


//        $idUsusario = UsuariosModel::nuevoSinFoto(  $this->datos['identificacion'] , 'soyclave', $this->datos['correo']);
//        if( $idUsusario > 0 ){
//            PersonasSistemaModel::asociar_usuario_persona($idUsusario, $idPersonaSistema);
//            $json = TiposUsuariosModel::datos( $this->datos['tipoUsuario'] )->PERMISOS_ROL;
//            $permisos = json_decode($json);
//            foreach ($permisos as $permiso) {
//                UsuariosModel::insertarPermisos( $idUsusario, $permiso );            
//            }
//        }

        if ($idPersonaSistema > 0) {
            echo '{ "resultado":"EXITO", "mensaje":"Persona <strong>' . $this->datos['nombreReal'] . '</strong> Registrada Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_personas_sistema() {
        $idPersonaSistema = PersonasSistemaModel::eliminar(
                        $this->datos['id_persona_sistema']
        );
        if ($idPersonaSistema > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_persona_sistema() {
        $this->datos['personaSistema'] = PersonasSistemaModel::datos($this->datos['id_persona_sistema']);

        $this->datos['tiposUsuarios'] = TiposUsuariosModel::todos();
        $this->datos['tiposPoblacion'] = tiposPoblacionModel::todos();
        $this->datos['perteneceA'] = PersonasSistemaModel::todos();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['personaSistema']->ID_PROVINCIA);
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();

        $this->vista->mostrar('personas_sistema/formPersonaSistema', $this->datos);
    }

    function editar_persona_sistema() {
        $idPersonaSistema = PersonasSistemaModel::update(
                        $this->datos['registro-id'], $this->datos['tipoUsuario'], $this->datos['tiposPoblacion'], $this->datos['cantones'], $this->datos['nombreReal'], $this->datos['nombreOtro'], $this->datos['identificacion'], $this->datos['telefono'], $this->datos['correo'], $this->datos['direccion'], $this->datos['fechaNacimiento'], $this->datos['observaciones'], $this->datos['perteneceA'], $this->datos['subreceptor']
        );

        if ($idPersonaSistema > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}

?>