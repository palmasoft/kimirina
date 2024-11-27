<?php

class desempenoMonitoresControlador extends ControllerBase {
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_desempeno_monitores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->vista->mostrar("coordinadores/desempenoMensualMonitores", $this->datos);
    }
    
    public function busqueda_desempeno_monitores() {
        
        $monitores = ReporteDesempenoMonitoresModel::monitores(
                                            $this->datos['coordinador-formulario'], $this->datos['monitor-formulario'],
                                            $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Coordinador'] = $this->datos['coordinador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->datos['informes'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $monitores, $provincia = NULL, $canton = NULL
        );
       
        $this->vista->mostrar("coordinadores/desempenoMensualMonitores", $this->datos);
    }
    
    public function informe_viejo($periodo, $monitores){

        $objInforme = NULL;
        
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlSupervisiones = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        
        if(!empty($monitores)){
            foreach ($monitores as $monitor){            

                    $informeActividades = NULL;
                    $informeActividades->NOMBRE_MONITOR = $monitor->NOMBRE_REAL_PERSONA;
                    $nuevaFecha = null;                
                    $fecha_inicial = $periodo[0]->FECHA_MIN_PERIODO;     
                    $fecha_final = $periodo[0]->FECHA_MAX_PERIODO;

                    /*
                     * SMANAS DE ACTIVIDADES                 * 
                     */
                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                            $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA,  $fecha_inicial, $nuevaFecha, 1));                        
                            $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                                                
                            $informeActividades->SEM_1_SUPERVISIONES = ($reportes = ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                        
                            $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));
                            $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_2_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                                                
                            $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_3_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            //ultima semana                         
                            $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha))/60/60/24);
                            $nuevaFecha = strtotime('+'.$dias_restantes-1 . ' day', strtotime($fecha_inicial));  
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                         
                            $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                        
                            $informeActividades->SEM_4_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));

                            $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION +$informeActividades->SEM_2_CAPACITACION +$informeActividades->SEM_3_CAPACITACION +$informeActividades->SEM_4_CAPACITACION ;
                            $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES +$informeActividades->SEM_2_REUNIONES +$informeActividades->SEM_3_REUNIONES +$informeActividades->SEM_4_REUNIONES ;
                            $informeActividades->TOTAL_SUPERVISIONES = $informeActividades->SEM_1_SUPERVISIONES +$informeActividades->SEM_2_SUPERVISIONES +$informeActividades->SEM_3_SUPERVISIONES +$informeActividades->SEM_4_SUPERVISIONES ;

                            $informeActividades->REUNIONES_EQUIPO_TECNICO = (ReporteDesempenoMonitoresModel::reunion( $monitor->ID_PERSONA, $periodo[0]->FECHA_MIN_PERIODO,$periodo[0]->FECHA_MAX_PERIODO, 4));

                            $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION ;
                            $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES ;
                            $objInforme->ttlSupervisiones += $informeActividades->TOTAL_SUPERVISIONES ;
                            $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlSupervisiones;


                            array_push($objInforme->filas, $informeActividades);

            }//fin foreach            
        }
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Coordinador'] = $this->datos['coordinador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->datos['informes'] = $objInforme;
        return $objInforme;
       
//        $this->vista->mostrar("coordinadores/desempenoMensualMonitores", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $monitores){
        $objInforme = NULL;
        
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlSupervisiones = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        
        if(!empty($monitores)){
            foreach ($monitores as $monitor){            

                    $informeActividades = NULL;
                    $informeActividades->NOMBRE_MONITOR = $monitor->NOMBRE_REAL_PERSONA;
                    
                    $informeActividades->SEM_1_CAPACITACION = 0;
                    $informeActividades->SEM_1_REUNIONES = 0;
                    $informeActividades->SEM_1_SUPERVISIONES = 0;
                    $informeActividades->SEM_2_CAPACITACION = 0;
                    $informeActividades->SEM_2_REUNIONES = 0;
                    $informeActividades->SEM_2_SUPERVISIONES = 0;
                    $informeActividades->SEM_3_CAPACITACION = 0;
                    $informeActividades->SEM_3_REUNIONES = 0;
                    $informeActividades->SEM_3_SUPERVISIONES = 0;
                    $informeActividades->SEM_4_CAPACITACION = 0;
                    $informeActividades->SEM_4_REUNIONES = 0;
                    $informeActividades->SEM_4_SUPERVISIONES = 0;
                    $informeActividades->REUNIONES_EQUIPO_TECNICO = 0;
                    
                    foreach ($periodos as $periodo) {
                        $nuevaFecha = null;                
                        $fecha_inicial = $periodo->FECHA_MIN_PERIODO;     
                        $fecha_final = $periodo->FECHA_MAX_PERIODO;

                        /*
                         * SMANAS DE ACTIVIDADES                 * 
                         */
                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                            $informeActividades->SEM_1_CAPACITACION += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA,  $fecha_inicial, $nuevaFecha, 1));                        
                            $informeActividades->SEM_1_REUNIONES += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                                                
                            $informeActividades->SEM_1_SUPERVISIONES += ($reportes = ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                        
                            $informeActividades->SEM_2_CAPACITACION += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));
                            $informeActividades->SEM_2_REUNIONES += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_2_SUPERVISIONES += (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                                                
                            $informeActividades->SEM_3_CAPACITACION += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_3_REUNIONES += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_3_SUPERVISIONES += (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            //ultima semana                         
                            $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha))/60/60/24);
                            $nuevaFecha = strtotime('+'.$dias_restantes-1 . ' day', strtotime($fecha_inicial));  
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                         
                            $informeActividades->SEM_4_CAPACITACION += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_4_REUNIONES += (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                        
                            $informeActividades->SEM_4_SUPERVISIONES += (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            
                            $informeActividades->REUNIONES_EQUIPO_TECNICO += (ReporteDesempenoMonitoresModel::reunion( $monitor->ID_PERSONA, $periodo->FECHA_MIN_PERIODO,$periodo->FECHA_MAX_PERIODO, 4));
                    }
                    $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION +$informeActividades->SEM_2_CAPACITACION +$informeActividades->SEM_3_CAPACITACION +$informeActividades->SEM_4_CAPACITACION ;
                    $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES +$informeActividades->SEM_2_REUNIONES +$informeActividades->SEM_3_REUNIONES +$informeActividades->SEM_4_REUNIONES ;
                    $informeActividades->TOTAL_SUPERVISIONES = $informeActividades->SEM_1_SUPERVISIONES +$informeActividades->SEM_2_SUPERVISIONES +$informeActividades->SEM_3_SUPERVISIONES +$informeActividades->SEM_4_SUPERVISIONES ;

//                    $informeActividades->REUNIONES_EQUIPO_TECNICO = (ReporteDesempenoMonitoresModel::reunion( $monitor->ID_PERSONA, $periodo->FECHA_MIN_PERIODO,$periodo->FECHA_MAX_PERIODO, 4));

                    $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION ;
                    $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES ;
                    $objInforme->ttlSupervisiones += $informeActividades->TOTAL_SUPERVISIONES ;
                    $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlSupervisiones;


                    array_push($objInforme->filas, $informeActividades);

            }//fin foreach            
        }
        
        $this->datos['informes'] = $objInforme;
        return $objInforme;
    }
   
     public function lista_seleccion_monitores(){
		$datos = AgentesModel::monitores_en_coordinadores( $this->datos['id_Coordinador'] );
		echo $this->formularios->Lista_Desplegable( 
			$datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', 
			$this->datos['id_lista'], '', ' ', 'cargar_monitores();', 
			' select-chosen  ', ' width: 100%; ', 
			false, 'todos', 'monitor-formulario'
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

        $monitores = ReporteDesempenoMonitoresModel::monitores(
                                            $this->datos['coordinador-formulario'], $this->datos['monitor-formulario'],
                                            $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreMonitor = PersonasSistemaModel::datos($this->datos['monitor-formulario']);
        if ($nombreMonitor == null) {
            $nombreMonitor = 'Todos';
        }else{
            $nombreMonitor=$nombreMonitor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $monitores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeDesempenoMonitores::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeDesempenoMonitores::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
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

        $monitores = ReporteDesempenoMonitoresModel::monitores(
                                            $this->datos['coordinador-formulario'], $this->datos['monitor-formulario'],
                                            $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreMonitor = PersonasSistemaModel::datos($this->datos['monitor-formulario']);
        if ($nombreMonitor == null) {
            $nombreMonitor = 'Todos';
        }else{
            $nombreMonitor=$nombreMonitor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $monitores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeDesempenoMonitores::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeDesempenoMonitores::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
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
        $objInforme->ttlSupervisiones = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();

        
        if(!empty($monitores)){
            foreach ($monitores as $monitor){            

                    $informeActividades = NULL;
                    $informeActividades->NOMBRE_MONITOR = $monitor->NOMBRE_REAL_PERSONA;
                    $nuevaFecha = null;                
                    $fecha_inicial = $periodo->FECHA_MIN_PERIODO;     
                    $fecha_final = $periodo->FECHA_MAX_PERIODO;

                    /*
                     * SMANAS DE ACTIVIDADES                 * 
                     */
                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                            $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA,  $fecha_inicial, $nuevaFecha, 1));                        
                            $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                                                
                            $informeActividades->SEM_1_SUPERVISIONES = ($reportes = ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                        
                            $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));
                            $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_2_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                                                
                            $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));
                            $informeActividades->SEM_3_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));
                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            //ultima semana                         
                            $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha))/60/60/24);
                            $nuevaFecha = strtotime('+'.$dias_restantes-1 . ' day', strtotime($fecha_inicial));  
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                         
                            $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoMonitoresModel::participacion( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                        
                            $informeActividades->SEM_4_SUPERVISIONES = (ReporteDesempenoMonitoresModel::supervision( $monitor->ID_PERSONA, $fecha_inicial,$nuevaFecha, 3));

                            $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION +$informeActividades->SEM_2_CAPACITACION +$informeActividades->SEM_3_CAPACITACION +$informeActividades->SEM_4_CAPACITACION ;
                            $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES +$informeActividades->SEM_2_REUNIONES +$informeActividades->SEM_3_REUNIONES +$informeActividades->SEM_4_REUNIONES ;
                            $informeActividades->TOTAL_SUPERVISIONES = $informeActividades->SEM_1_SUPERVISIONES +$informeActividades->SEM_2_SUPERVISIONES +$informeActividades->SEM_3_SUPERVISIONES +$informeActividades->SEM_4_SUPERVISIONES ;

                            $informeActividades->REUNIONES_EQUIPO_TECNICO = (ReporteDesempenoMonitoresModel::reunion( $monitor->ID_PERSONA, $periodo->FECHA_MIN_PERIODO,$periodo->FECHA_MAX_PERIODO, 4));

                            $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION ;
                            $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES ;
                            $objInforme->ttlSupervisiones += $informeActividades->TOTAL_SUPERVISIONES ;
                            $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones + $objInforme->ttlSupervisiones;


                            array_push($objInforme->filas, $informeActividades);

            }//fin foreach            
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->datos['informes'] = $objInforme;
        
        return $objInforme;

    }
}

