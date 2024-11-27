<?php

class directorio_centro_saludControlador extends ControllerBase {

    function cargar_vista_listado_centro_salud() {
        $this->datos['centros'] = centrosserviciossaludModel::todos();
        $this->vista->mostrar('directorio_centro_salud/tabla_ubicaciones_centro_salud', $this->datos);
    }

    function cargar_vista_formulario_listado_centro_salud() {
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['tipocentros'] = TiposCentrosSaludModel::todos();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();

        $this->vista->mostrar('directorio_centro_salud/form_ubicaciones_centro_salud', $this->datos);
    }

    function guardar_nuevo_centro_salud() {
        $idcentrosalud = centrosserviciossaludModel::insertar(
                $this->datos['cantones'], $this->datos['subreceptor'], $this->datos['id_servicio'], 
                $this->datos['nombre-ubicacion'], $this->datos['identificacion-ubicaicion'], $this->datos['telefono-ubicaicion'], 
                $this->datos['correo-ubicaicion'], $this->datos['web-ubicaicion'], $this->datos['contacto-ubicaicion'], 
                $this->datos['direccion-ubicaicion'], 
                $this->datos['gps_lat_marcador'], $this->datos['gps_lon_marcador'], $this->datos['marcador-ubicaicion'], 
                $this->datos['cobertura-ubicaicion']
        );

        if ($idcentrosalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Centro o unidad de servicio <strong>' . $this->datos['nombre-ubicacion'] . '</strong> creada exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_centro_servicio() {
        
        $this->datos['ubicaciones'] = centrosserviciossaludModel::datos($this->datos['id_centroservicio']);
        $this->datos['LATITUD_LUGAR'] = $this->datos['ubicaciones']->LATITUD_CENTROSERVICIO;
        $this->datos['LONGITUD_LUGAR'] = $this->datos['ubicaciones']->LONGITUD_CENTROSERVICIO;
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['ubicaciones']->ID_PROVINCIA);
        $this->datos['tipocentros'] = TiposCentrosSaludModel::todos();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        
        $this->vista->mostrar('directorio_centro_salud/form_ubicaciones_centro_salud', $this->datos);
    }

    function editar_centro_salud() {

        $idcentrosalud = centrosserviciossaludModel::update(
                $this->datos['registro-id'], $this->datos['subreceptor'], $this->datos['cantones'], $this->datos['id_servicio'], 
                $this->datos['nombre-ubicacion'], $this->datos['identificacion-ubicaicion'], $this->datos['telefono-ubicaicion'], 
                $this->datos['correo-ubicaicion'], $this->datos['web-ubicaicion'], $this->datos['contacto-ubicaicion'], 
                $this->datos['direccion-ubicaicion'], 
                $this->datos['gps_lat_marcador'], $this->datos['gps_lon_marcador'], $this->datos['marcador-ubicaicion'], 
                $this->datos['cobertura-ubicaicion']
        );
        if ($idcentrosalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Centro o unidad de servicio <strong>' . $this->datos['nombre-ubicacion'] . '</strong> modificado exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_centro_servicio() {
        $idcentrosalud = centrosserviciossaludModel::eliminar(
                        $this->datos['id_centroservicio']
        );
        if ($idcentrosalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}