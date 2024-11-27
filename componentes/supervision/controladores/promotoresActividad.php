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
        
        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $provincia = NULL, $canton = NULL
        );

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
    
    public function informe_viejo($periodos, $promotores) {
        $objInforme = NULL;
        $objInforme->filas = array();
        
        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $objInformePromotor = NULL;
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;
                foreach ($periodos as $periodo) {
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
        }
        $this->datos['Informe'] = $objInforme;
        return $objInforme;
//        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
//        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
//        $this->datos['Promotores'] = AgentesModel::promotores();
//        $this->datos['Monitores'] = AgentesModel::monitor();
//
//        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
//        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
//        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
//        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
//        
//        $this->vista->mostrar("monitores/promotoresActividad", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $promotores) {
        $objInforme = NULL;
        $objInforme->filas = array();
        
        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $objInformePromotor = NULL;
                $objInformePromotor->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;
                
                $objInformePromotor->PARES_CONTACTADOS_TS = 0;
                $objInformePromotor->PARES_EFECTIVOS_TS = 0;
                
                $objInformePromotor->PARES_CONTACTADOS_HSH = 0;
                $objInformePromotor->PARES_EFECTIVOS_HSH = 0;
                
                $objInformePromotor->PARES_CONTACTADOS_TRANS = 0;
                $objInformePromotor->PARES_EFECTIVOS_TRANS = 0;
               
                //PARA TS
                $objInformePromotor->CENTRO_SERVICIO_TS = self::cantidad_efectivos($promotor, $periodos, "TS");
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TS = $value->NUMERO_EFECTIVOS;
                    }
                } else {
                    $objInformePromotor->PARES_EFECTIVOS_TS = 99;
                } 


               
                //PARA HSH
                $objInformePromotor->CENTRO_SERVICIO_HSH = self::cantidad_efectivos($promotor, $periodos, "HSH");
                if (!empty($objInformePromotor->CENTRO_SERVICIO_HSH)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_HSH as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_HSH = $value->NUMERO_EFECTIVOS;
                    }
                } else {

                }

/*
                //PARA TRANS
                $objInformePromotor->CENTRO_SERVICIO_TRANS = self::cantidad_efectivos($promotor, $periodos, "TRANS");
                if (!empty($objInformePromotor->CENTRO_SERVICIO_TRANS)) {
                    foreach ($objInformePromotor->CENTRO_SERVICIO_TRANS as $value) {
                        $objInformePromotor->PARES_EFECTIVOS_TRANS = $value->NUMERO_EFECTIVOS;
                    }
                } else {

                }
                */
                
                foreach ($periodos as $periodo) {
                    
                    if(Usuario::esDNI()){
                        $objInformePromotor->PARES_CONTACTADOS_TS += PromotoresActividadModel::cantidad_contactados_ts_dni($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformePromotor->PARES_CONTACTADOS_HSH += PromotoresActividadModel::cantidad_contactados_hsh_dni($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformePromotor->PARES_CONTACTADOS_TRANS += PromotoresActividadModel::cantidad_contactados_trans_dni($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }else{
                        $objInformePromotor->PARES_CONTACTADOS_TS += PromotoresActividadModel::cantidad_contactados_ts($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformePromotor->PARES_CONTACTADOS_HSH += PromotoresActividadModel::cantidad_contactados_hsh($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        //$objInformePromotor->PARES_CONTACTADOS_TRANS += PromotoresActividadModel::cantidad_contactados_trans($promotor->ID_PERSONA, $periodo, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }
                
                array_push($objInforme->filas, $objInformePromotor);
            }
        }
        
        $this->datos['Informe'] = $objInforme;
        return $objInforme;
    }

    public function cantidad_efectivos_viejo($promotor, $periodo, $tipo) {
        $registros = PromotoresActividadModel::registros_semanales_promotor($promotor->ID_PERSONA, $periodo->ID_PERIODO, $tipo);

        $resultado = NULL;
        $resultado->nroEfectivos = 0;
        $resultado->centrosServicio = array();

        $centros_servicio = NULL;
        $centros_salud = centrosserviciossaludModel::todos();
        if (!empty($registros)) {
            foreach ($registros as $registro) {
                $fechaAtencion = PromotoresActividadModel::fecha_min_atencion($registro->ID_PEMAR, $periodo->ANO_PERIODO);
                foreach ($centros_salud as $key => $centro_salud) {
                    if (!empty($fechaAtencion)) {
                        if ($centro_salud->ID_CENTROSERVICIO == $fechaAtencion->ID_CENTRO_SALUD && $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                            $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $centro_salud->NOMBRE_CENTROSERVICIO;
                            $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_EFECTIVOS += 1;
                            $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_REFERIDOS += 1;
                        }else if ($centro_salud->ID_CENTROSERVICIO == $fechaAtencion->ID_CENTRO_SALUD){
                            $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $centro_salud->NOMBRE_CENTROSERVICIO;
                            $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_REFERIDOS += 1;
                        }
                    }
                }
            }
        }
        return $centros_servicio;
    }
    //Has el foreach de periodos en esta funcion y no antes.
    public function cantidad_efectivos($promotor, $periodos, $tipo) {
        
        $centros_servicio = NULL;
        $centros_salud = centrosserviciossaludModel::todos_informes();

        foreach ($periodos as $periodo) {
            
            if(Usuario::esDNI()){
                $registros = PromotoresActividadModel::registros_semanales_promotor_trimestral($promotor->ID_PERSONA, $periodo, $tipo);
            }else{
                $registros = PromotoresActividadModel::registros_semanales_promotor($promotor->ID_PERSONA, $periodo->ID_PERIODO, $tipo);
            }

            if (!empty($registros)) {
                foreach ($registros as $registro) {
                    $fechaAtencion = PromotoresActividadModel::fecha_min_atencion($registro->ID_PEMAR, $periodo->ANO_PERIODO);
                    
                    foreach ($centros_salud as $key => $centro_salud) {
                        if (!empty($fechaAtencion)) {
                            if ($centro_salud->ID_CENTROSERVICIO == $fechaAtencion->ID_CENTRO_SALUD && $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $centro_salud->NOMBRE_CENTROSERVICIO;
                                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_EFECTIVOS ++;
                                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_REFERIDOS ++;
                            }else if ($centro_salud->ID_CENTROSERVICIO == $fechaAtencion->ID_CENTRO_SALUD){
                                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NOMBRE_CENTROSERVICIO = $centro_salud->NOMBRE_CENTROSERVICIO;
                                $centros_servicio[$centro_salud->ID_CENTROSERVICIO]->NUMERO_REFERIDOS ++;
                            }
                        }
                    }
                    
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformePromotoresActividad::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformePromotoresActividad::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();

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

        $promotores = promotoresActividadModel::promotores_filtrados(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        } else {
            $nombrePromotor = $nombrePromotor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformePromotoresActividad::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformePromotoresActividad::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }

    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL) {


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
