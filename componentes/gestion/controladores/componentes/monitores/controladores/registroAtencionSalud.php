<?php

class registroAtencionSaludControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    function cargar_vista_listado() {
        $this->datos['registrosAtencionSalud'] = registroAtencionSaludModel::todos_pendienteRevisionRevisado();
        $this->vista->mostrar('registro_atencion_salud/listadoRegistroAtencionSalud', $this->datos);
    }

    function datos_para_formulario() {

        $this->datos_filtro_subreceptores();

        $this->datos['periodoActual'] = PeriodosModel::activo();
//        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['centrosSalud'] = CentrosSaludModel::por_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $this->datos['tiposServicio'] = ServiciosModel::todos();
        $this->datos['Subreceptor'] = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        $this->datos['tiposPemars'] = SubreceptoresModel::id_tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        if (isset($this->datos['id_atencion_salud'])) {
            $this->datos['registrosAtencion'] = registroAtencionSaludModel::datos($this->datos['id_atencion_salud']);
            $this->datos['Subreceptor'] = SubreceptoresModel::datos_subreceptor($this->datos['registrosAtencion']->ID_SUBRECEPTOR);
            $this->datos['tiposPemars'] = SubreceptoresModel::id_tipos_poblacion($this->datos['registrosAtencion']->ID_SUBRECEPTOR);
        }
    }

    function mostrar_datos_registro_atencion() {
        $this->datos_para_formulario();
        $this->vista->mostrar('registro_atencion_salud/verRegistroAtencionSalud', $this->datos);
    }

    function cargar_vista_formulario_nuevo() {
        $this->datos_para_formulario();
        $this->vista->mostrar('registro_atencion_salud/formRegistroAtencionSalud', $this->datos);
    }

    function guardar_nuevo_registro_atencion_salud() {
        $idPemar = PemarsModel::validar_codigo($this->datos['codigo-pemar']);
        if (!$idPemar) {
            $idPemar = PemarsModel::insertar_sin_sexo(
                            $this->datos['tiposPemars'], $this->datos['codigo-pemar'], $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $this->datos['nombreUno'], $this->datos['nombreDos'], $this->datos['apellidoUno'], $this->datos['apellidoDos'], $this->datos['cedula'], ""
            );
        }

        $verificado = 'NO';
        if (isset($this->datos['chk-cedula-verificada'])) {
            $objPemar = PemarsModel::datos_pemar($idPemar);
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                $verificado = 'SI';
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['nombreUno'], $this->datos['nombreDos'], $this->datos['apellidoUno'], $this->datos['apellidoDos'], $objPemar->OTRO_NOMBRE_POBLACION, $this->datos['cedula'], $objPemar->NUMERO_TELEFONO_POBLACION
                );
            }
        }
        $idRegistroSalud = registroAtencionSaludModel::insertar(
                        $this->datos['centroSalud'], TiposPoblacionModel::datos($this->datos['tiposPemars'])->CODIGO_TIPOPOBLACION, $idPemar, $this->datos['fechaAtencion'], $this->datos['horaAtencion'], $this->datos['tipoServicio'], $this->datos['subreceptor'], $this->datos['nombreUno'], $this->datos['nombreDos'], $this->datos['apellidoUno'], $this->datos['apellidoDos'], $this->datos['cedula'], $verificado
        );

        if ($idRegistroSalud > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registrado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_registro_atencion_salud() {
        $this->datos_para_formulario();
        $this->vista->mostrar('registro_atencion_salud/formRegistroAtencionSalud', $this->datos);
    }

    function actualizar_datos_atencion_salud() {
        $idRegistroSalud = 0;
        $idPemar = PemarsModel::validar_codigo($this->datos['codigo-pemar']);
        if (!$idPemar) {
            $idPemar = PemarsModel::insertar_sin_sexo(
                            $this->datos['tiposPemars'], $this->datos['codigo-pemar'], $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $this->datos['nombreUno'], $this->datos['nombreDos'], $this->datos['apellidoUno'], $this->datos['apellidoDos'], $this->datos['cedula'], ""
            );
        }
        $verificado = 'NO';
        if (isset($this->datos['chk-cedula-verificada'])) {
            $objPemar = PemarsModel::datos_pemar($idPemar);
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                $verificado = 'SI';
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['nombreUno'], $this->datos['apellidoUno'], $this->datos['nombreDos'], $this->datos['apellidoDos'], $objPemar->OTRO_NOMBRE_POBLACION, $this->datos['cedula'], $objPemar->NUMERO_TELEFONO_POBLACION
                );
            }
        }
        $idRegistroSalud = registroAtencionSaludModel::update(
                        $this->datos['id_atencion_salud'], $this->datos['centroSalud'], TiposPoblacionModel::datos($this->datos['tiposPemars'])->CODIGO_TIPOPOBLACION, $idPemar, //aqui va la id del pemar asociado
                        $this->datos['fechaAtencion'], $this->datos['horaAtencion'], $this->datos['tipoServicio'], $this->datos['subreceptor'], $this->datos['nombreUno'], $this->datos['nombreDos'], $this->datos['apellidoUno'], $this->datos['apellidoDos'], $this->datos['cedula'], $verificado
        );

        return $idRegistroSalud;
    }

    function editar_registro_atencion_salud() {
        $idRegistroSalud = $this->actualizar_datos_atencion_salud();
        if ($idRegistroSalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_registro_atencion_salud() {
        $idRegistroAtencionSalud = registroAtencionSaludModel::eliminar(
                        $this->datos['id_atencion_salud']
        );
        if ($idRegistroAtencionSalud > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si el problema persite consulte al administrador del sistema."}';
        }
    }

}
