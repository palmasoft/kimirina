<?php

class abordajesPromotoresControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_abordajes_promotores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("monitores/abordajesPromotores", $this->datos);
    }

    public function busqueda_vista_abordajes_promotores() {

        $promotores = abordajesMensualPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $provincia = NULL, $canton = NULL
        );

        $this->vista->mostrar("monitores/abordajesPromotores", $this->datos);
    }

    public function generar_datos_informe($periodos, $promotores) {

        $objInforme = NULL;
        $objInforme->filas = array();

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                foreach ($periodos as $periodo) {
                    $registros = abordajesMensualPromotoresModel::registros_semanales_promotores($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    if (!empty($registros)) {
                        foreach ($registros as $registro) {

                            if (Usuario::esDNI()) {
                                $recurrencias = AbordajesPromotoresModel::recurrencias_por_periodo_pemar_dni(
                                                $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );
                            } else {
                                $recurrencias[0] = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                                $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );
                            }

                            $registro->NUEVO = NULL;
                            $registro->RECURRENTE = NULL;
                            $registro->REFERIDOS_EFECTIVO = NULL;

                            $registro->NUEVO = 'NO';
                            $registro->RECURRENTE = 'NO';
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $registro->NUEVO = 'SI';
                            } else {
                                foreach ($recurrencias as $recurrencia) {
                                    if (!empty($recurrencia)) {
                                        if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                            $registro->RECURRENTE = 'SI';
                                        }
                                    }
                                }
                            }

                            $registro->REFERIDOS_EFECTIVO = 'NO';
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                $registro->REFERIDOS_EFECTIVO = 'SI';
                            }
                            $registro->NOMBRE_PROMOTOR = $registro->NOMBRE_REAL_PERSONA;
                            array_push($objInforme->filas, $registro);
                        }
                    }
                }
            }
        }

        $this->datos['Informe'] = $objInforme;
        return $objInforme;
    }

    public function esNuevo($registro, $periodo) {
        $primer_abordaje = AbordajesPromotoresModel::primer_abordaje($registro->ID_PEMAR, $periodo);
        if (!empty($primer_abordaje)) {
            if ($registro->ID_REGISTRO_CONTACTO == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function esDerivadoEfectivo($registro, $ano_periodo) {
        $fechaAtencion = consolidadoMensualDerivadosModel::fecha_min_atencion($registro->ID_PEMAR, $ano_periodo);
        if (!empty($fechaAtencion)) {
            if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function accion_generar_pdf() {

        $idProvincia = '';
        $nombreProvincia = 'TODAS';
        if ($this->datos['provincia-chosen'] != "") {
            $provincia = UbicacionesModel::provincia($this->datos['provincia-chosen']);
            $idProvincia = $provincia->ID_PROVINCIA;
            $nombreProvincia = $provincia->NOMBRE_PROVINCIA;
        }

        $idCanton = '';
        $nombreCanton = 'TODOS';
        if ($this->datos['sel-lista-cantones'] != "") {
            $canton = UbicacionesModel::canton($this->datos['sel-lista-cantones']);
            $idProvincia = $canton->ID_CANTON;
            $nombreCanton = $canton->NOMBRE_CANTON;
        }

        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        } else {
            $nombrePromotor = $nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $promotores = abordajesMensualPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeAbordajePromotores::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAbordajePromotores::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function accion_generar_xls() {

        $idProvincia = '';
        $nombreProvincia = 'todas';
        if ($this->datos['provincia-chosen'] != "") {
            $provincia = UbicacionesModel::provincia($this->datos['provincia-chosen']);
            $idProvincia = $provincia->ID_PROVINCIA;
            $nombreProvincia = $provincia->NOMBRE_PROVINCIA;
        }

        $idCanton = '';
        $nombreCanton = 'todos';
        if ($this->datos['sel-lista-cantones'] != "") {
            $canton = UbicacionesModel::canton($this->datos['sel-lista-cantones']);
            $idProvincia = $canton->ID_CANTON;
            $nombreCanton = $canton->NOMBRE_CANTON;
        }

        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        } else {
            $nombrePromotor = $nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $promotores = abordajesMensualPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeAbordajePromotores::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAbordajePromotores::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }

    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                $registros = abordajesMensualPromotoresModel::registros_semanales($promotor->ID_PERSONA, $periodo->ID_PERIODO, $provincia, $canton);
                if (!empty($registros)) {
                    foreach ($registros as $registro) {
                        array_push($objInforme->filas, $registro);
                    }
                }
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;

        return $objInforme;
    }

}
