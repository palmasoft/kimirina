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
        
        $monitores = reporteActividadesMonitorModel::monitores(
                                     $this->datos['coordinador-formulario'],$this->datos['monitor-formulario'],
                                     $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        
        $actividades = reporteActividadesMonitorModel::actividades();
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Coordinadores'] = AgentesModel::coordinador();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Coordinador'] = $this->datos['coordinador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->datos['informes'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $monitores, $actividades, $provincia = NULL, $canton = NULL
        );

        $this->vista->mostrar("coordinadores/reporteActividadesTecnicasMonitores", $this->datos);
        
    }
    
    public function informe_viejo($periodo, $monitores, $actividades){


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
        return $objInforme;
//        $this->vista->mostrar("coordinadores/reporteActividadesTecnicasMonitores", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $monitores, $actividades){
        
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
                        foreach ($periodos as $periodo) {
                            $objInformeActividad->NUMERO_ACTIVIDADES += reporteActividadesMonitorModel::cantidad_actividades($monitor->ID_PERSONA, $actividad->ID_ACTIVIDAD, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        }
                        array_push($objInformeNombre->detalle, $objInformeActividad);
                    }
                }
                
                array_push($objInforme, $objInformeNombre);
            }
        }
                
        $this->datos['informes'] = $objInforme;
        return $objInforme;
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $monitores, $actividades, $idProvincia, $idCanton, $actividades
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeActividadesTecnicasMonitor::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeActividadesTecnicasMonitor::generar_trimestre(
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $monitores, $actividades, $idProvincia, $idCanton, $actividades
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeActividadesTecnicasMonitor::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeActividadesTecnicasMonitor::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreMonitor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        
        }

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }

    public function generar_datos_informe_viejo($periodo, $monitores, $provincia = NULL, $canton = NULL, $actividades) {

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