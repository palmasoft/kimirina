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
        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        $promotores = abordajesMensualPromotoresModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                $registros = abordajesMensualPromotoresModel::registros_semanales($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
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

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = $objInforme;

        $this->vista->mostrar("monitores/abordajesPromotores", $this->datos);
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

        $promotores = abordajesMensualPromotoresModel::promotores(
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
        
        $this->datos['RUTA'] = InformeAbordajePromotores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $promotores, $provincia = NULL, $canton = NULL) {

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
