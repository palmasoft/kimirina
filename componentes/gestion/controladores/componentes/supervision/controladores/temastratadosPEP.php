<?php

class temastratadosPEPControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_temas_tratados_PEP() {
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->vista->mostrar("monitores/temasTratadosPEP", $this->datos);
    }

    public function busqueda_temas_tratados_PEP() {

        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH = 0;
        $objInforme->totalTRANS = 0;
        $objInforme->filas = array();
        
        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        
        $Temas = temasTratadosPEPModel::temas(); 
        
        $promotores = temasTratadosPEPModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        if(!empty($Temas)){
            foreach ($Temas as $temas) {

                $objInformeTemas = NULL;
                $objInformeTemas->TITULO_TEMA = $temas->TITULO_TEMA;
                $objInformeTemas->TS = 0;
                $objInformeTemas->HSH = 0;
                $objInformeTemas->TRANS = 0;

                if(!empty($promotores)){
                    foreach ($promotores as $promotor){                    
                        $objInformeTemas->TS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA,"TS" , $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->HSH += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "HSH", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->TRANS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "TRANS", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }

                $objInformeTemas->TOTAL = $objInformeTemas->TS + $objInformeTemas->HSH + $objInformeTemas->TRANS;

                array_push($objInforme->filas, $objInformeTemas);
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

        $this->vista->mostrar("monitores/temasTratadosPEP", $this->datos);
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
        
        $Temas = temasTratadosPEPModel::temas(); 
        
        $promotores = temasTratadosPEPModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $promotores, $idProvincia, $idCanton, $Temas
        );
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['RUTA'] = InformeTemasTratadosPEP::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe($periodo, $promotores, $provincia = NULL, $canton = NULL, $Temas) {

        
        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH = 0;
        $objInforme->totalTRANS = 0;
        $objInforme->filas = array();

        if(!empty($Temas)){
            foreach ($Temas as $temas) {

                $objInformeTemas = NULL;
                $objInformeTemas->TITULO_TEMA = $temas->TITULO_TEMA;
                $objInformeTemas->TS = 0;
                $objInformeTemas->HSH = 0;
                $objInformeTemas->TRANS = 0;

                if(!empty($promotores)){
                    foreach ($promotores as $promotor){                    
                        $objInformeTemas->TS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA,"TS" , $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->HSH += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "HSH", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->TRANS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "TRANS", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }

                $objInformeTemas->TOTAL = $objInformeTemas->TS + $objInformeTemas->HSH + $objInformeTemas->TRANS;

                array_push($objInforme->filas, $objInformeTemas);
            }
        }
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->datos['Informes'] = $objInforme;
        
        return $objInforme;

    }
}

?>