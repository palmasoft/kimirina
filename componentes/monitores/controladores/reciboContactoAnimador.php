<?php

class reciboContactoAnimadorControlador extends ControllerBase {

    var $msnResultado = '';

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    function mostrar_tabla_recibo_contacto_animador() {
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_pendientesRevisionRevisado();
        $this->vista->mostrar("recibo_contacto_animador/tablaContactoAnimador", $this->datos);
    }

    function nuevo_form_recibo_contacto_animador() {

        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();
        $this->datos['Lugares'] = array(); //LugaresIntervencionModel::todos();
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['TiposPemars'] = TiposPoblacionModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['Insumos'] = InsumosModel::todos();
        $this->datos['Animadores'] = AgentesModel::animadores();

        $this->datos['NoRecibo'] = ReciboContactoAnimadorModel::ultimoRecibo();

        $this->vista->mostrar("recibo_contacto_animador/formContactoAnimador", $this->datos);
    }

    function agregar_recibo_contacto_animador() {

        //print_r($this->datos);
        //print_r($this->enviados);
        $this->msnResultado = "";
        $objTipoPob = TiposPoblacionModel::datos($this->datos['tipo_pemar']);
        $SEXO = $objTipoPob->SEXO_TIPOPOBLACION;

        $idPemar = PemarsModel::validar_codigo($this->datos['codigo-pemar']);
        if ($idPemar <= 0) {
            $idPemar = PemarsModel::insertar_con_sexo_sin_correo(
                    $this->datos['tipo_pemar'], $this->datos['sel-lista-cantones'], $this->datos['codigo-pemar'], 
                    $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $SEXO, 
                    $this->datos['primer_nombre'], $this->datos['segundo_nombre'], 
                    $this->datos['primer_apellido'], $this->datos['segundo_apellido'], 
                    $this->datos['otro_nombre_contacto'], '', $this->datos['telefono_contacto']
            );
        }

        if (isset($this->datos['chk-cedula-verificada'])) {
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto']
                );
            }
        }

        $idReciboAnimador = ReciboContactoAnimadorModel::insertar(
                        $this->datos['num_recibo'], $this->datos['subreceptor'], $objTipoPob->CODIGO_TIPOPOBLACION, $this->datos['hora'], $this->datos['dia-contacto'], $this->datos['mes-contacto'], $this->datos['ano-contacto'], $this->datos['sel-lista-cantones'], $this->datos['provincia-chosen'], $this->datos['TipolugarArbodaje'], $this->datos['sel-lista-lugar_intervencion'], $this->datos['promotor'], $this->datos['tema-recibo'], $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto'], isset($this->datos['chk-cedula-verificada']) ? 'SI' : 'NO', $this->datos['fechaAtencion'], $this->datos['horaAtencion'], $this->datos['centro_salud'], $this->datos['servicio_salud'], $this->datos['observaciones_animador'], $idPemar, $this->datos['alcance']
        );

        if ($idReciboAnimador > 0) {

            $objRecibo = ReciboContactoAnimadorModel::datos($idReciboAnimador);
            ReciboContactoAnimadorModel::guardar_cantidad_condones($idReciboAnimador, $this->datos['noCondones']);
            ReciboContactoAnimadorModel::guardar_cantidad_lubricantes($idReciboAnimador, $this->datos['noLubricantes']);
            ReciboContactoAnimadorModel::guardar_cantidad_folletos($idReciboAnimador, $this->datos['noFolletos']);

            if (count($this->enviados) > 0) {
                $this->msnResultado .= "<h4>Soportes del Recibo de Contacto por Animador.</h4>";
                $dirArchivo = 'soportes' . DS . 'animadores' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                        $this->datos['promotor'] . DS . $objTipoPob->CODIGO_TIPOPOBLACION . DS . $objRecibo->NO_RECIBO_CONTACTOANIMADOR . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ReciboContactoSoportes::insertar_soporte(
                                $idReciboAnimador, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }


            echo '{"resultado":"EXITO", "mensaje":"Registro Guardado Exitosamente. ' . $this->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function editar_form_recibo_contacto_animador() {
        $this->cargar_datos_recibo_contacto();
        $this->vista->mostrar("recibo_contacto_animador/formContactoAnimador", $this->datos);
    }

    function actualizar_recibo_contacto_animador() {

        //print_r($this->datos);
        //print_r($this->enviados);
        $this->msnResultado = "";
        $objTipoPob = TiposPoblacionModel::datos($this->datos['tipo_pemar']);
        $SEXO = $objTipoPob->SEXO_TIPOPOBLACION;

        $idPemar = PemarsModel::validar_codigo($this->datos['codigo-pemar']);
        if ($idPemar <= 0) {
            $idPemar = PemarsModel::insertar_con_sexo_sin_correo(
                    $this->datos['tipo_pemar'], $this->datos['sel-lista-cantones'], $this->datos['codigo-pemar'], 
                    $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $SEXO, 
                    $this->datos['primer_nombre'], $this->datos['segundo_nombre'], 
                    $this->datos['primer_apellido'], $this->datos['segundo_apellido'], 
                    $this->datos['otro_nombre_contacto'], '', $this->datos['telefono_contacto']
            );
        }

        if (isset($this->datos['chk-cedula-verificada'])) {
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['primer_nombre'], $this->datos['segundo_nombre'], 
                        $this->datos['primer_apellido'], $this->datos['segundo_apellido'], 
                        $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto']
                );
            }
        }


        $idReciboAnimador = ReciboContactoAnimadorModel::update(
                        $this->datos['registro-id'], $this->datos['num_recibo'], $this->datos['subreceptor'], $objTipoPob->CODIGO_TIPOPOBLACION, $this->datos['hora'], $this->datos['dia-contacto'], $this->datos['mes-contacto'], $this->datos['ano-contacto'], $this->datos['sel-lista-cantones'], $this->datos['provincia-chosen'], $this->datos['TipolugarArbodaje'], $this->datos['sel-lista-lugar_intervencion'], $this->datos['promotor'], $this->datos['tema-recibo'], $this->datos['primer_nombre'], $this->datos['segundo_nombre'], $this->datos['primer_apellido'], $this->datos['segundo_apellido'], $this->datos['otro_nombre_contacto'], $this->datos['ced_identidad_contacto'], $this->datos['telefono_contacto'], isset($this->datos['chk-cedula-verificada']) ? 'SI' : 'NO', $this->datos['fechaAtencion'], $this->datos['horaAtencion'], $this->datos['centro_salud'], $this->datos['servicio_salud'], $this->datos['observaciones_animador'], $idPemar, $this->datos['alcance']
        );

        $objRecibo = ReciboContactoAnimadorModel::datos($this->datos['registro-id']);
        ReciboContactoAnimadorModel::update_cantidad_condones($this->datos['registro-id'], $this->datos['noCondones']);
        ReciboContactoAnimadorModel::update_cantidad_lubricantes($this->datos['registro-id'], $this->datos['noLubricantes']);
        ReciboContactoAnimadorModel::update_cantidad_folletos($this->datos['registro-id'], $this->datos['noFolletos']);

        $soportes = array();
        if (isset($this->datos['archivo-asociado'])) {
            $soportes = $this->datos['archivo-asociado'];
        }
        ReciboContactoSoportes::eliminar_soportes_excepto($this->datos['registro-id'], $soportes);

        if (count($this->enviados) > 0) {
            $this->msnResultado .= "<h4>Soportes del Recibo de Contacto por Animador.</h4>";
            $dirArchivo = 'soportes' . DS . 'animadores' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                    $this->datos['promotor'] . DS . $objTipoPob->CODIGO_TIPOPOBLACION . DS . $objRecibo->NO_RECIBO_CONTACTOANIMADOR . DS;
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    ReciboContactoSoportes::insertar_soporte(
                            $this->datos['registro-id'], str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $this->msnResultado .= $resp;
                }
            }
        }

        return $idReciboAnimador;
    }

    function update_recibo_contacto_animador() {

        $idReciboAnimador = $this->actualizar_recibo_contacto_animador();

        if ($idReciboAnimador > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Actualizado Exitosamente. ' . $this->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_recibo_contacto_animador() {
        $idReciboAnimador = ReciboContactoAnimadorModel::eliminar(
                        $this->datos['idContactoAnimador']
        );
        if ($idReciboAnimador > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function cargar_datos_recibo_contacto() {

        $this->datos['datosContactoAnimador'] = ReciboContactoAnimadorModel::datos($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->SOPORTES = ReciboContactoSoportes::archivos_en_el_registro($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->CONDONES = ReciboContactoAnimadorModel::condones_entregados($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->LUBRICANTES = ReciboContactoAnimadorModel::lubricantes_entregados($this->datos['idReciboAnimador']);
        $this->datos['datosContactoAnimador']->INSUMOS->FOLLETOS = ReciboContactoAnimadorModel::folletos_entregados($this->datos['idReciboAnimador']);


        $this->datos['centrosSalud'] = CentrosSaludModel::todos();
        $this->datos['serviciosSalud'] = ServiciosModel::todos();

        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['Lugares'] = LugaresIntervencionModel::lugares_del_tipo_provincia_canton($this->datos['datosContactoAnimador']->ID_TIPOLUGAR, $this->datos['datosContactoAnimador']->ID_PROVINCIA, $this->datos['datosContactoAnimador']->ID_CIUDAD);

        $this->datos['TiposPemars'] = TiposPoblacionModel::todos();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($this->datos['datosContactoAnimador']->ID_PROVINCIA);

        $this->datos['Temas'] = TemasModel::todos();
        $this->datos['Insumos'] = InsumosModel::todos();
        $this->datos['Animadores'] = AgentesModel::animadores();
    }

    function mostrar_datos_contacto_animador() {
        $this->cargar_datos_recibo_contacto();
        $this->vista->mostrar("recibo_contacto_animador/VerContactoAnimador", $this->datos);
    }


    function mostrar_datos_contacto_animador_modal() {
        $this->cargar_datos_recibo_contacto();
        $this->vista->mostrar("recibo_contacto_animador/datosReciboContacto", $this->datos);
    }
}
