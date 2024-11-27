<?php

class desempenopromotoresControlador extends ControllerBase {
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_desempeno_promotores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();

        $this->datos['ttlActividades'] = 0;
        $this->datos['ttlReuniones'] = 0;
        $this->datos['ttlReferidos'] = 0;
        $this->datos['ttlTotal'] = 0;

        $this->vista->mostrar("monitores/desempenoMensualPromotores", $this->datos);
    }

    public function cargar_vista_desempeno_promotores_filtro() {
        
        $promotores = ReporteDesempenoPromotoresModel::promotores(
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

        $this->datos['Informes'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $provincia = NULL, $canton = NULL
        );

        $this->vista->mostrar("monitores/desempenoMensualPromotores", $this->datos);
       
    }
    
    public function informe_viejo($periodo, $promotores){


        $objInforme = NULL;
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlReferidos = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $informeActividades = NULL;
                $informeActividades->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;
                $informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;
                $nuevaFecha = null;
                $fecha_inicial = $periodo->FECHA_MIN_PERIODO;
                $fecha_final = $periodo->FECHA_MAX_PERIODO;

                /*
                 * SEMANAS DE ACTIVIDADES                 * 
                 */
                //falta implementar los referidos
                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_1_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_2_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_3_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                //ultima semana                         
                $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha)) / 60 / 60 / 24);
                $nuevaFecha = strtotime('+' . $dias_restantes -1 . ' day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_4_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);

                $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION + $informeActividades->SEM_2_CAPACITACION + $informeActividades->SEM_3_CAPACITACION + $informeActividades->SEM_4_CAPACITACION;
                $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES + $informeActividades->SEM_2_REUNIONES + $informeActividades->SEM_3_REUNIONES + $informeActividades->SEM_4_REUNIONES;
                $informeActividades->TOTAL_REFERIDOS = $informeActividades->SEM_1_REFERIDOS + $informeActividades->SEM_2_REFERIDOS + $informeActividades->SEM_3_REFERIDOS + $informeActividades->SEM_4_REFERIDOS;

                $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION;
                $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES;
                $objInforme->ttlReferidos += $informeActividades->TOTAL_REFERIDOS;
                $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlReferidos;
                $objInforme->informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;

                array_push($objInforme->filas, $informeActividades);
            }//fin foreach
        }
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informes'] = $objInforme;


        $this->vista->mostrar("monitores/desempenoMensualPromotores", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $promotores){

        $objInforme = NULL;
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlReferidos = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $informeActividades = NULL;
                $informeActividades->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;
                $informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;
		if(SubreceptoresModel::datos($promotor->ID_SUBRECEPTOR)->SIGLAS_SUBRECEPTOR=='QUIMERA'){
                    $informeActividades->TIPO_PEP = "HSH/TS";
                }
                
                $informeActividades->SEM_1_CAPACITACION = 0;
                $informeActividades->SEM_1_REUNIONES = 0;
                $informeActividades->SEM_1_REFERIDOS = 0;
                $informeActividades->SEM_2_CAPACITACION = 0;
                $informeActividades->SEM_2_REUNIONES = 0;
                $informeActividades->SEM_2_REFERIDOS = 0;
                $informeActividades->SEM_3_CAPACITACION = 0;
                $informeActividades->SEM_3_REUNIONES = 0;
                $informeActividades->SEM_3_REFERIDOS = 0;
                $informeActividades->SEM_4_CAPACITACION = 0;
                $informeActividades->SEM_4_REUNIONES = 0;
                $informeActividades->SEM_4_REFERIDOS = 0;
                
                foreach ($periodos as $periodo) {
                    $nuevaFecha = null;
                    $fecha_inicial = $periodo->FECHA_MIN_PERIODO;
                    $fecha_final = $periodo->FECHA_MAX_PERIODO;

                    /*
                     * SEMANAS DE ACTIVIDADES                 * 
                     */
                    //falta implementar los referidos
                    $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                    $nuevaFecha = date('Y-m-d', $nuevaFecha);
                    $informeActividades->SEM_1_CAPACITACION += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                    $informeActividades->SEM_1_REUNIONES += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                    $informeActividades->SEM_1_REFERIDOS += self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                    $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                    $fecha_inicial = date('Y-m-d', $fecha_inicial);

                    $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                    $nuevaFecha = date('Y-m-d', $nuevaFecha);
                    $informeActividades->SEM_2_CAPACITACION += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                    $informeActividades->SEM_2_REUNIONES += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                    $informeActividades->SEM_2_REFERIDOS += self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                    $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                    $fecha_inicial = date('Y-m-d', $fecha_inicial);

                    $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                    $nuevaFecha = date('Y-m-d', $nuevaFecha);
                    $informeActividades->SEM_3_CAPACITACION += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                    $informeActividades->SEM_3_REUNIONES += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                    $informeActividades->SEM_3_REFERIDOS += self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                    $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                    $fecha_inicial = date('Y-m-d', $fecha_inicial);

                    //ultima semana                         
                    $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha)) / 60 / 60 / 24);
                    $nuevaFecha = strtotime('+' . $dias_restantes -1 . ' day', strtotime($fecha_inicial));
                    $nuevaFecha = date('Y-m-d', $nuevaFecha);
                    $informeActividades->SEM_4_CAPACITACION += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                    $informeActividades->SEM_4_REUNIONES += (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                    $informeActividades->SEM_4_REFERIDOS += self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);

                }
                $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION + $informeActividades->SEM_2_CAPACITACION + $informeActividades->SEM_3_CAPACITACION + $informeActividades->SEM_4_CAPACITACION;
                $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES + $informeActividades->SEM_2_REUNIONES + $informeActividades->SEM_3_REUNIONES + $informeActividades->SEM_4_REUNIONES;
                $informeActividades->TOTAL_REFERIDOS = $informeActividades->SEM_1_REFERIDOS + $informeActividades->SEM_2_REFERIDOS + $informeActividades->SEM_3_REFERIDOS + $informeActividades->SEM_4_REFERIDOS;

                $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION;
                $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES;
                $objInforme->ttlReferidos += $informeActividades->TOTAL_REFERIDOS;
                $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlReferidos;
                $objInforme->informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;

                array_push($objInforme->filas, $informeActividades);
            }//fin foreach
        }

        $this->datos['Informes'] = $objInforme;
        return $objInforme;
    }

    public function referidosEfectivosViejo($promotor, $fechaInicio, $fechaFinal, $periodo) {
        $nroReferidos = 0;
        $registros = ReporteDesempenoPromotoresModel::registros_semanales_promotor(
                        $promotor->ID_PERSONA, $fechaInicio, $fechaFinal
        );
        
        
        if (!empty($registros)) {
            /* Si existen registros en esa semana, se busca si los pemar abordados 
             *  asistieron a un centro de servicio
             */
            foreach ($registros as $registro) {
                $recurrencia = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR
                );
                $fechaAtencion = ReporteDesempenoPromotoresModel::fecha_min_atencion($registro->ID_PEMAR, $periodo->ANO_PERIODO);
                //$fechaContacto = new DateTime($registro->FECHA_CONTACTO . ' ' . $registro->HORA_CONTACTOANIMADOR);
                
                if (!empty($fechaAtencion)) {
                    if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                        
                        if(self::esNuevo($registro, $periodo)){
                            $nroReferidos++;
                        }else{
                            if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                $nroReferidos++;
                            }
                        }
                    }
                }
            }//fin del for
        }
        
        return $nroReferidos;
    }
    
    public function referidosEfectivos($promotor, $fechaInicio, $fechaFinal, $periodo) {
        $nroReferidos = 0;
        
        if(Usuario::esDNI()){
            $registros = ReporteDesempenoPromotoresModel::registros_semanales_promotor_dni(
                        $promotor->ID_PERSONA, $fechaInicio, $fechaFinal
            );
        }else{
            $registros = ReporteDesempenoPromotoresModel::registros_semanales_promotor(
                        $promotor->ID_PERSONA, $fechaInicio, $fechaFinal
            );
        }
        
        if (!empty($registros)) {
            foreach ($registros as $registro) {
                
                if(Usuario::esDNI()){
                    $recurrencias = AbordajesPromotoresModel::recurrencias_por_periodo_pemar_dni(
                                $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                    );
                }else{
                    $recurrencias[0] = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                            $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                    );
                }
                
                $fechaAtencion = ReporteDesempenoPromotoresModel::fecha_min_atencion($registro->ID_PEMAR, $periodo->ANO_PERIODO);
                
                if (!empty($fechaAtencion)) {
                    if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                        
                        if(self::esNuevo($registro, $periodo)){
                            $nroReferidos++;
                        }else{
                            foreach ($recurrencias as $recurrencia) {
                                if(!empty($recurrencia)){}
                                    if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                        $nroReferidos++;
                                    }
                                }
                            }
//                            if(Usuario::esDNI()){
//                                $nroReferidos += count($recurrencias);
//                            }else{
//                                if ($recurrencias[0]->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
//                                    $nroReferidos++;
//                                }
//                            }
                        }
                    }
                }
            }
            return $nroReferidos;
        }
        
    
    public function esNuevo($registro, $periodo) {
        $primer_abordaje = AbordajesPromotoresModel::primer_abordaje($registro->ID_PEMAR, $periodo->ID_PERIODO);
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

    public function lista_seleccion_promotores() {
        $datos = AgentesModel::promotores_en_monitores($this->datos['id_Monitor']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', $this->datos['id_lista'], '', ' ', 'cargar_promotores();', ' select-chosen  ', ' width: 100%; ', false, 'todos', 'promotor-formulario'
        );
    }
    
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

        $promotores = ReporteDesempenoPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $idProvincia, $idCanton
        );
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        ); 
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeDesempenoPromotores::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeDesempenoPromotores::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        

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

        $promotores = ReporteDesempenoPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $idProvincia, $idCanton
        );
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        ); 
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeDesempenoPromotores::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeDesempenoPromotores::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }

    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlReferidos = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        
        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $informeActividades = NULL;
                $informeActividades->NOMBRE_PROMOTOR = $promotor->NOMBRE_REAL_PERSONA;
                $informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;
                $nuevaFecha = null;
                $fecha_inicial = PeriodosModel::activo()->FECHA_MIN_PERIODO;
                $fecha_final = PeriodosModel::activo()->FECHA_MAX_PERIODO;

                /*
                 * SEMANAS DE ACTIVIDADES                 * 
                 */
                //falta implementar los referidos
                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_1_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_2_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_3_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);
                $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                $fecha_inicial = date('Y-m-d', $fecha_inicial);

                //ultima semana                         
                $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha)) / 60 / 60 / 24);
                $nuevaFecha = strtotime('+' . $dias_restantes -1 . ' day', strtotime($fecha_inicial));
                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 1));
                $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoPromotoresModel::todos_semana($promotor->ID_PERSONA, $fecha_inicial, $nuevaFecha, 2));
                $informeActividades->SEM_4_REFERIDOS = self::referidosEfectivos($promotor, $fecha_inicial, $nuevaFecha, $periodo);

                $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION + $informeActividades->SEM_2_CAPACITACION + $informeActividades->SEM_3_CAPACITACION + $informeActividades->SEM_4_CAPACITACION;
                $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES + $informeActividades->SEM_2_REUNIONES + $informeActividades->SEM_3_REUNIONES + $informeActividades->SEM_4_REUNIONES;
                $informeActividades->TOTAL_REFERIDOS = $informeActividades->SEM_1_REFERIDOS + $informeActividades->SEM_2_REFERIDOS + $informeActividades->SEM_3_REFERIDOS + $informeActividades->SEM_4_REFERIDOS;

                $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION;
                $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES;
                $objInforme->ttlReferidos += $informeActividades->TOTAL_REFERIDOS;
                $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlReferidos;
                $objInforme->informeActividades->TIPO_PEP = $promotor->CODIGO_TIPOPOBLACION;

                array_push($objInforme->filas, $informeActividades);
            }//fin foreach
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->datos['Informes'] = $objInforme;
        
        return $objInforme;

    }

}
