<?php

class desempenoAnimadoresControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_desempeno_animadores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Animadores'] = AgentesModel::animadores();
         
        $this->vista->mostrar("animadores/desempenoMensuaAnimadores", $this->datos);
    }
    
    public function lista_seleccion_animadores() {
		$datos = AgentesModel::animadores_en_monitores($this->datos['id_Animador']);		
		echo $this->formularios->Lista_Desplegable( 
			$datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', 
			$this->datos['id_lista'], '', ' ', 'cargar_animadores();', 
			' select-chosen  ', ' width: 100%; ', 
			false, 'todos', 'animador-formulario'
		);
	}
        
    public function cargar_vista_desempeno_animadores_filtro(){
        
        $objInforme = NULL;
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();
        
        $periodo = PeriodosModel::activo();
        
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
        
        $animadores = ReporteDesempenoAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        if(!empty($animadores)){
            foreach ($animadores as $animador){

                    $informeActividades = NULL;
                    $informeActividades->NOMBRE_ANIMADOR = $animador->NOMBRE_REAL_PERSONA;
                    $nuevaFecha = null;                
                    $fecha_inicial = $periodo->FECHA_MIN_PERIODO;     
                    $fecha_final = $periodo->FECHA_MAX_PERIODO;

                    /*
                     * SEMANAS DE ACTIVIDADES                
                     */

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                            $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA,  $fecha_inicial, $nuevaFecha, 1));                        
                            $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                                                

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                        
                            $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));
                            $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                                                
                            $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            //ultima semana                         
                            $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha))/60/60/24);
                            $nuevaFecha = strtotime('+'.$dias_restantes-1 . ' day', strtotime($fecha_inicial));  
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                         
                            $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                        


                            $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION +$informeActividades->SEM_2_CAPACITACION +$informeActividades->SEM_3_CAPACITACION +$informeActividades->SEM_4_CAPACITACION ;
                            $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES +$informeActividades->SEM_2_REUNIONES +$informeActividades->SEM_3_REUNIONES +$informeActividades->SEM_4_REUNIONES ;


                            $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION ;
                            $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES ;

                            $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones;


                            array_push($objInforme->filas, $informeActividades);
             }//fin foreach 
        }
        $this->datos['informes'] = $objInforme;     
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Animador'] = $this->datos['animador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario']; 
       
        
        $this->vista->mostrar("animadores/desempenoMensuaAnimadores", $this->datos);
        
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

        $animadores = ReporteDesempenoAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreAnimador = PersonasSistemaModel::datos($this->datos['animador-formulario']);
        if ($nombreAnimador == null) {
            $nombreAnimador = 'Todos';
        }else{
            $nombreAnimador=$nombreAnimador->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $animadores, $idProvincia, $idCanton
        );
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->datos['RUTA'] = InformeDesempenoAnimadores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );

        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $animadores, $provincia = NULL, $canton = NULL) {
        
        $objInforme = NULL;
        $objInforme->ttlActividades = 0;
        $objInforme->ttlReuniones = 0;
        $objInforme->ttlTotal = 0;
        $objInforme->filas = array();
        
                
        
        if(!empty($animadores)){
            foreach ($animadores as $animador){

                    $informeActividades = NULL;
                    $informeActividades->NOMBRE_ANIMADOR = $animador->NOMBRE_REAL_PERSONA;
                    $nuevaFecha = null;                
                    $fecha_inicial = $periodo->FECHA_MIN_PERIODO;     
                    $fecha_final = $periodo->FECHA_MAX_PERIODO;

                    /*
                     * SEMANAS DE ACTIVIDADES                
                     */

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                            $informeActividades->SEM_1_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA,  $fecha_inicial, $nuevaFecha, 1));                        
                            $informeActividades->SEM_1_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                                                

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                        
                            $informeActividades->SEM_2_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));
                            $informeActividades->SEM_2_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            $nuevaFecha = strtotime('+6 day', strtotime($fecha_inicial));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                                                
                            $informeActividades->SEM_3_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_3_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));

                            $fecha_inicial = strtotime('+1 day', strtotime($nuevaFecha));
                            $fecha_inicial = date('Y-m-d', $fecha_inicial);

                            //ultima semana                         
                            $dias_restantes = intval((strtotime($fecha_final) - strtotime($nuevaFecha))/60/60/24);
                            $nuevaFecha = strtotime('+'.$dias_restantes-1 . ' day', strtotime($fecha_inicial));  
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);                         
                            $informeActividades->SEM_4_CAPACITACION = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 1));                        
                            $informeActividades->SEM_4_REUNIONES = (ReporteDesempenoAnimadoresModel::todos_semana( $animador->ID_PERSONA, $fecha_inicial,$nuevaFecha, 2));                        


                            $informeActividades->TOTAL_CAPACITACION = $informeActividades->SEM_1_CAPACITACION +$informeActividades->SEM_2_CAPACITACION +$informeActividades->SEM_3_CAPACITACION +$informeActividades->SEM_4_CAPACITACION ;
                            $informeActividades->TOTAL_REUNIONES = $informeActividades->SEM_1_REUNIONES +$informeActividades->SEM_2_REUNIONES +$informeActividades->SEM_3_REUNIONES +$informeActividades->SEM_4_REUNIONES ;


                            $objInforme->ttlActividades += $informeActividades->TOTAL_CAPACITACION ;
                            $objInforme->ttlReuniones += $informeActividades->TOTAL_REUNIONES ;

                            $objInforme->ttlTotal += $objInforme->ttlActividades + $objInforme->ttlReuniones;


                            array_push($objInforme->filas, $informeActividades);
             }//fin foreach 
        }


        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animador'] = AgentesModel::animadores();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informes'] = $objInforme;


        return $objInforme;
    }
}
