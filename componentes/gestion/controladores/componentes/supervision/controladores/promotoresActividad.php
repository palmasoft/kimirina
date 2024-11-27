<?php

class promotoresActividadControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_promotores_actividad() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("monitores/promotoresActividad", $this->datos);
    }

    public function busqueda_promotores_actividad() {

        $promotores = promotoresActividadModel::promotores_filtrados(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

//        if ($this->datos['promotor-formulario'] != "") {
//            $promotores = promotoresActividadModel::promotores_filtrados_por_id($this->datos['promotor-formulario']);
//        } else if ($this->datos['monitor-formulario'] != "") {
//            $promotores = promotoresActividadModel::promotores_filtrados_por_monitor($this->datos['monitor-formulario']);
//        } else {
//            $promotores = promotoresActividadModel::promotores();
//        }
        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();

        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $objInformePromotor = NULL;
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;

                //PARA TS
                $objInformePromotor->CENTRO_SERVICIO_TS = self::cantidad_efectivos($promotor, $periodo, "TS");
                $objInformePromotor->PARES_CONTACTADOS_TS = PromotoresActividadModel::cantidad_contactados_ts($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TS += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_TS = 0;
                }

                //PARA HSH
                $objInformePromotor->CENTRO_SERVICIO_HSH = self::cantidad_efectivos($promotor, $periodo, "HSH");
                $objInformePromotor->PARES_CONTACTADOS_HSH = PromotoresActividadModel::cantidad_contactados_hsh($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_HSH)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_HSH as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_HSH += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_HSH = 0;
                }


                //PARA TRANS
                $objInformePromotor->CENTRO_SERVICIO_TRANS = self::cantidad_efectivos($promotor, $periodo, "TRANS");
                $objInformePromotor->PARES_CONTACTADOS_TRANS = PromotoresActividadModel::cantidad_contactados_trans($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TRANS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TRANS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TRANS += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_TRANS = 0;
                }


                array_push($objInforme->filas, $objInformePromotor);
            }
        }
        $this->datos['Informe'] = $objInforme;

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->vista->mostrar("monitores/promotoresActividad", $this->datos);
    }

    public function cantidad_efectivos($promotor, $periodo, $tipo) {
        $registros = PromotoresActividadModel::registros_semanales_promotor($promotor->ID_PERSONA, $periodo->ID_PERIODO, $tipo);

        $resultado = NULL;
        $resultado->nroEfectivos = 0;
        $resultado->centrosServicio = array();

        $centros_servicio = NULL;
        $centros_salud = CentrosSaludModel::por_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($centros_salud)) {
            foreach ($centros_salud as $key => $centro_salud) {
                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $centro_salud->NOMBRE_CENTROSERVICIO;
                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_EFECTIVOS = 0;
                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_REFERIDOS = 0;
            }
        }
//        print_r($centros_servicio);


        if (!empty($registros)) {
            foreach ($registros as $registro) {
                foreach ($centros_salud as $key => $value) {
                    $fechaAtencion = PromotoresActividadModel::fecha_min_atencion($registro->ID_PEMAR, $periodo->ANO_PERIODO);
                    if (!empty($fechaAtencion)) {
                        if ($value->ID_CENTROSERVICIO == $fechaAtencion->ID_CENTRO_SALUD && $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                            $centros_servicio[$value->ID_CENTROSERVICIO]->NUMERO_EFECTIVOS += 1;
                        }
                    }
                    $centros_servicio[$value->ID_CENTROSERVICIO]->NUMERO_REFERIDOS += 1;
                }
            }
        }


        return $centros_servicio;
    }

//    public function cantidad_efectivos($promotor, $periodo, $tipo) {
//        $registros = PromotoresActividadModel::registros_semanales_promotor($promotor->ID_PERSONA, $periodo->ID_PERIODO, $tipo);
//        $resultado = NULL;
//        $resultado->nroEfectivos = 0;
//        $centros_servicio = NULL;
//        $resultado->centrosServicio = array();
//        //$centros_salud = centrosserviciossaludModel::todos();
//        if (!empty($registros)) {
//            foreach ($registros as $key => $value) {
//                $centros_servicio[$value->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $value->NOMBRE_CENTROSERVICIO;
//                $centros_servicio[$value->ID_CENTROSERVICIO]->NUMERO_EFECTIVOS = 0;
//                $centros_servicio[$value->ID_CENTROSERVICIO]->NUMERO_REFERIDOS = 0;
//            }
//        }
//
//        if (!empty($registros)) {
//            foreach ($registros as $registro) {                
//                foreach ($centros_servicio as $key => $value) {
//                    if ($key == $registro->ID_CENTROSERVICIO) {  
//                        $fechaAtencion = PromotoresActividadModel::fecha_min_atencion($registro->ID_PEMAR, $registro->ID_CENTROSERVICIO, $periodo->ANO_PERIODO);
//                        if (!empty($fechaAtencion)) {
//                            if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
//                                $resultado->nroEfectivos++;
//                                $value->NUMERO_EFECTIVOS += 1;
//                            } 
//                        } 
//                        $value->NUMERO_REFERIDOS += 1;
//                    }
//                }
//            }
//        }
//        
//        
//        return $centros_servicio;
//    }


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

        $promotores = promotoresActividadModel::promotores_filtrados(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        } else {
            $nombrePromotor = $nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $promotores, $idProvincia, $idCanton
        );

        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->datos['RUTA'] = InformePromotoresActividad::generar(
                        $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $promotores, $provincia = NULL, $canton = NULL) {


        $objInforme = NULL;
        $objInforme->filas = array();

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $objInformePromotor = NULL;
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;

                //PARA TS
                $objInformePromotor->CENTRO_SERVICIO_TS = self::cantidad_efectivos($promotor, $periodo, "TS");
                $objInformePromotor->PARES_CONTACTADOS_TS = PromotoresActividadModel::cantidad_contactados_ts($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TS += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_TS = 0;
                }

                //PARA HSH
                $objInformePromotor->CENTRO_SERVICIO_HSH = self::cantidad_efectivos($promotor, $periodo, "HSH");
                $objInformePromotor->PARES_CONTACTADOS_HSH = PromotoresActividadModel::cantidad_contactados_hsh($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_HSH)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_HSH as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_HSH += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_HSH = 0;
                }


                //PARA TRANS
                $objInformePromotor->CENTRO_SERVICIO_TRANS = self::cantidad_efectivos($promotor, $periodo, "TRANS");
                $objInformePromotor->PARES_CONTACTADOS_TRANS = PromotoresActividadModel::cantidad_contactados_trans($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TRANS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TRANS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TRANS += $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_TRANS = 0;
                }

                array_push($objInforme->filas, $objInformePromotor);
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();

        $this->datos['Informes'] = $objInforme;

        return $objInforme;
    }

}
