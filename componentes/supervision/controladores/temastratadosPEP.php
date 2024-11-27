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
        
        $Temas = temasTratadosPEPModel::temas(); 
        
        $promotores = temasTratadosPEPModel::promotores(
                        $this->datos['monitor-formulario'], $this->datos['promotor-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );        
        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $Temas, $provincia = NULL, $canton = NULL
        );

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
    
    public function informe_viejo($Temas, $promotores, $periodo){

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
    
    public function generar_datos_informe($periodos, $promotores, $Temas){

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
                        foreach ($periodos as $periodo) {
                            $objInformeTemas->TS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA,"TS" , $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                            $objInformeTemas->HSH += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "HSH", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                            $objInformeTemas->TRANS += temasTratadosPEPModel::temas_tratados_tipo($temas->ID_TEMA, "TRANS", $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        }
                    }
                }

                $objInformeTemas->TOTAL = $objInformeTemas->TS + $objInformeTemas->HSH + $objInformeTemas->TRANS;

                array_push($objInforme->filas, $objInformeTemas);
            }
        }
        $this->datos['Informe'] = $objInforme;
        return $objInforme;
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $Temas, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeTemasTratadosPEP::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeTemasTratadosPEP::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $Temas, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeTemasTratadosPEP::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeTemasTratadosPEP::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        
        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL, $Temas) {

        
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