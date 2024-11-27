<?php

class consolidadopromotoresControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_consolidado_promotores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("monitores/consolidadoMensualPromotores", $this->datos);
    }

    public function busqueda_vista_consolidado_promotores() {
        $objInforme = NULL;
        $objInforme->totalNuevosTS = 0;
        $objInforme->totalRecuTS = 0;
        $objInforme->totalNuevosHSH = 0;
        $objInforme->totalRecuHSH = 0;
        $objInforme->totalNuevosTRANS = 0;
        $objInforme->totalRecuTRANS = 0;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        $promotores = consolidadoMensualDerivadosModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                $objInformePromotor = NULL;
                $registros = consolidadoMensualDerivadosModel::registros_semanales($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $nuevos_HSH = 0;
                $recurrentes_HSH = 0;
                $nuevos_TS = 0;
                $recurrentes_TS = 0;
                $nuevos_TRANS = 0;
                $recurrentes_TRANS = 0;
                if (!empty($registros)) {
                    foreach ($registros as $registro) {

                        $recurrencia = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR
                        );

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_HSH++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_HSH++;
                                    }
                                }
                            } else {
                                
                            }
                        }

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TS++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_TS++;
                                    }
                                }
                            } else {
                                
                            }
                        }

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TRANS++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_TRANS++;
                                    }
                                }
                            } else {
                                
                            }
                        }
                    }
                }
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;

                $objInformePromotor->NUEVOS_TS = $nuevos_TS;
                $objInformePromotor->RECURRENTES_TS = $recurrentes_TS;

                $objInformePromotor->NUEVOS_HSH = $nuevos_HSH;
                $objInformePromotor->RECURRENTES_HSH = $recurrentes_HSH;

                $objInformePromotor->NUEVOS_TRANS = $nuevos_TRANS;
                $objInformePromotor->RECURRENTES_TRANS = $recurrentes_TRANS;

                $objInformePromotor->TOTAL_NUEVOS = $objInformePromotor->NUEVOS_TS + $objInformePromotor->NUEVOS_HSH + $objInformePromotor->NUEVOS_TRANS;
                $objInformePromotor->TOTAL_RECURRENTES = $objInformePromotor->RECURRENTES_TS + $objInformePromotor->RECURRENTES_HSH + $objInformePromotor->RECURRENTES_TRANS;

                array_push($objInforme->filas, $objInformePromotor);


                $objInforme->totalNuevosTS += $objInformePromotor->NUEVOS_TS;
                $objInforme->totalNuevosHSH +=$objInformePromotor->NUEVOS_HSH;
                $objInforme->totalNuevosTRANS += $objInformePromotor->NUEVOS_TRANS;

                $objInforme->totalRecuTS +=$objInformePromotor->RECURRENTES_TS;
                $objInforme->totalRecuHSH += $objInformePromotor->RECURRENTES_HSH;
                $objInforme->totalRecuTRANS += $objInformePromotor->RECURRENTES_TRANS;
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = $objInforme;

//        $this->vista->mostrar("monitores/abordajesPromotores", $this->datos);
        $this->vista->mostrar("monitores/consolidadoMensualPromotores", $this->datos);
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
    
    public function accion_generar_pdf() {

       $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
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

        $promotores = consolidadoMensualDerivadosModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $idProvincia, $idCanton
        );
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $promotores, $idProvincia, $idCanton
        );
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['RUTA'] = InformeConsolidadoPromotores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $promotores, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->totalNuevosTS = 0;
        $objInforme->totalRecuTS = 0;
        $objInforme->totalNuevosHSH = 0;
        $objInforme->totalRecuHSH = 0;
        $objInforme->totalNuevosTRANS = 0;
        $objInforme->totalRecuTRANS = 0;
        $objInforme->filas = array();

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                $objInformePromotor = NULL;
                $registros = consolidadoMensualDerivadosModel::registros_semanales($promotor->ID_PERSONA, $periodo->ID_PERIODO, $provincia, $canton);
                $nuevos_HSH = 0;
                $recurrentes_HSH = 0;
                $nuevos_TS = 0;
                $recurrentes_TS = 0;
                $nuevos_TRANS = 0;
                $recurrentes_TRANS = 0;
                if (!empty($registros)) {
                    foreach ($registros as $registro) {

                        $recurrencia = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR
                        );

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_HSH++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_HSH++;
                                    }
                                }
                            } else {
                                
                            }
                        }

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TS++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_TS++;
                                    }
                                }
                            } else {
                                
                            }
                        }

                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
                            if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TRANS++;
                                } else {
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $recurrentes_TRANS++;
                                    }
                                }
                            } else {
                                
                            }
                        }
                    }
                }
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;

                $objInformePromotor->NUEVOS_TS = $nuevos_TS;
                $objInformePromotor->RECURRENTES_TS = $recurrentes_TS;

                $objInformePromotor->NUEVOS_HSH = $nuevos_HSH;
                $objInformePromotor->RECURRENTES_HSH = $recurrentes_HSH;

                $objInformePromotor->NUEVOS_TRANS = $nuevos_TRANS;
                $objInformePromotor->RECURRENTES_TRANS = $recurrentes_TRANS;

                $objInformePromotor->TOTAL_NUEVOS = $objInformePromotor->NUEVOS_TS + $objInformePromotor->NUEVOS_HSH + $objInformePromotor->NUEVOS_TRANS;
                $objInformePromotor->TOTAL_RECURRENTES = $objInformePromotor->RECURRENTES_TS + $objInformePromotor->RECURRENTES_HSH + $objInformePromotor->RECURRENTES_TRANS;

                array_push($objInforme->filas, $objInformePromotor);


                $objInforme->totalNuevosTS += $objInformePromotor->NUEVOS_TS;
                $objInforme->totalNuevosHSH +=$objInformePromotor->NUEVOS_HSH;
                $objInforme->totalNuevosTRANS += $objInformePromotor->NUEVOS_TRANS;

                $objInforme->totalRecuTS +=$objInformePromotor->RECURRENTES_TS;
                $objInforme->totalRecuHSH += $objInformePromotor->RECURRENTES_HSH;
                $objInforme->totalRecuTRANS += $objInformePromotor->RECURRENTES_TRANS;
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;
        
        return $objInforme;

    }

    public function lista_seleccion_promotores() {
        $datos = AgentesModel::promotores_en_monitores($this->datos['id_Monitor']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', $this->datos['id_lista'], '', ' ', 'cargar_promotores();', ' select-chosen  ', ' width: 100%; ', false, 'todos', 'promotor-formulario'
        );
    }

}
