<?php

class abordajesAnimadoresControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_abordajes_animadores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("animadores/abordajesAnimadores", $this->datos);
    }

    public function busqueda_vista_abordajes_animadores() {
        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        $animadores = abordajesMensualAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {
                $recibos = abordajesMensualAnimadoresModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($recibos)) {
                    foreach ($recibos as $recibo) {                               
                        array_push($objInforme->filas, $recibo);
                    }
                }
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Animador'] = $this->datos['animador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = $objInforme;

        $this->vista->mostrar("animadores/abordajesAnimadores", $this->datos);
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

        $animadores = abordajesMensualAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
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
        
        $this->datos['RUTA'] = InformeAbordajeAnimadores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $animadores, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {
                $recibos = abordajesMensualAnimadoresModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $provincia, $canton);
                if (!empty($recibos)) {
                    foreach ($recibos as $recibo) {                               
                        array_push($objInforme->filas, $recibo);
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
