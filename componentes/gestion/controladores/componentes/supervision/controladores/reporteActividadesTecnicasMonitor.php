<?php

class reporteActividadesTecnicasMonitorControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_vista_actividades_tecnicas_monitores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
               
        $this->vista->mostrar("coordinadores/reporteActividadesTecnicasMonitores", $this->datos);
    }
    
    public function cargar_vista_actividades_tecnicas_monitores_filtro() {
        
        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-contactos'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-contactos']);
        }
        
        $monitores = reporteActividadesMonitorModel::monitores(
                                     $this->datos['coordinador-formulario'],$this->datos['monitor-formulario'],
                                     $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        
        $actividades = reporteActividadesMonitorModel::actividades();
        
        $objInforme = array();
        
        if(!empty($monitores)) {
            foreach ($monitores as $monitor) {
                $objInformeNombre = NULL;
                $objInformeNombre->detalle = array();
                $objInformeNombre->NOMBRE_MONITOR = $monitor->NOMBRE_REAL_PERSONA;       

                if (!empty($actividades)) {
                    foreach ($actividades as $actividad) {
                        $objInformeActividad = NULL;
                        $objInformeActividad->NUMERO_ACTIVIDADES = 0;
                        $objInformeActividad->NOMBRE = $actividad->NOMBRE_ACTIVIDAD;
                        $objInformeActividad->NUMERO_ACTIVIDADES += reporteActividadesMonitorModel::cantidad_actividades($monitor->ID_PERSONA, $actividad->ID_ACTIVIDAD, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        array_push($objInformeNombre->detalle, $objInformeActividad);
                    }
                }
                
                array_push($objInforme, $objInformeNombre);
            }
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
            
        $this->vista->mostrar("coordinadores/reporteActividadesTecnicasMonitores", $this->datos);
    }
    
    public function lista_seleccion_monitores() {
		$datos = AgentesModel::promotores_en_monitores( $this->datos['id_Coordinador'] );//cambiar por coordinadores	
		echo $this->formularios->Lista_Desplegable( 
			$datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', 
			$this->datos['id_lista'], '', ' ', 'cargar_monitores();', 
			' select-chosen  ', ' width: 100%; ', 
			false, 'todos', 'monitor-formulario'
		);
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

        $monitores = reporteActividadesMonitorModel::monitores(
                                     $this->datos['coordinador-formulario'],$this->datos['monitor-formulario'],
                                     $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        
        $actividades = reporteActividadesMonitorModel::actividades();
        
        $nombreMonitor = PersonasSistemaModel::datos($this->datos['monitor-formulario']);
        if ($nombreMonitor == null) {
            $nombreMonitor = 'Todos';
        }else{
            $nombreMonitor=$nombreMonitor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $monitores, $idProvincia, $idCanton, $actividades
        );
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['RUTA'] = InformeActividadesTecnicasMonitor::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $monitores, $provincia = NULL, $canton = NULL, $actividades) {

        $objInforme = array();
        
        if(!empty($monitores)) {
            foreach ($monitores as $monitor) {
                $objInformeNombre = NULL;
                $objInformeNombre->detalle = array();
                $objInformeNombre->NOMBRE_MONITOR = $monitor->NOMBRE_REAL_PERSONA;       

                if (!empty($actividades)) {
                    foreach ($actividades as $actividad) {
                        $objInformeActividad = NULL;
                        $objInformeActividad->NUMERO_ACTIVIDADES = 0;
                        $objInformeActividad->NOMBRE = $actividad->NOMBRE_ACTIVIDAD;
                        $objInformeActividad->NUMERO_ACTIVIDADES += reporteActividadesMonitorModel::cantidad_actividades($monitor->ID_PERSONA, $actividad->ID_ACTIVIDAD, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        array_push($objInformeNombre->detalle, $objInformeActividad);
                    }
                }
                
                array_push($objInforme, $objInformeNombre);
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->datos['informes'] = $objInforme;
        
        return $objInforme;

    }
}