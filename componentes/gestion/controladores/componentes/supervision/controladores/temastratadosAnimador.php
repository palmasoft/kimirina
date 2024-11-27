<?php

class temastratadosAnimadorControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_temas_tratados_Animador() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("animadores/temasTratadosAnimador", $this->datos);
    }

    public function busqueda_temas_tratados_Animador() {

        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH = 0;
        $objInforme->totalTRANS = 0;
        $objInforme->filas = array();
        
        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        $Temas = temasTratadosAnimadorModel::temas(); 
        
        $animadores = temasTratadosAnimadorModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'],
                        $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        if(!empty($Temas)){
            foreach ($Temas as $temas) {

                $objInformeTemas = NULL;
                $objInformeTemas->TITULO_TEMA = $temas->TITULO_TEMA;
                $objInformeTemas->TS = 0;
                $objInformeTemas->HSH = 0;
                $objInformeTemas->TRANS = 0;

                if(!empty($animadores)){
                    foreach ($animadores as $animador){

                        $objInformeTemas->TS += temasTratadosAnimadorModel::todos_ts($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->HSH += temasTratadosAnimadorModel::todos_hsh($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->TRANS += temasTratadosAnimadorModel::todos_trans($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }

                $objInformeTemas->TOTAL = $objInformeTemas->TS + $objInformeTemas->HSH + $objInformeTemas->TRANS;

                array_push($objInforme->filas, $objInformeTemas);
            }
        }
        $this->datos['Informe'] = $objInforme;

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Animador'] = $this->datos['animador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->vista->mostrar("animadores/temasTratadosAnimador", $this->datos);
    }
        public function lista_seleccion_animadores() {
        $datos = AgentesModel::animadores_en_monitores($this->datos['id_Animador']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', $this->datos['id_lista'], '', ' ', 'cargar_animadores();', ' select-chosen  ', ' width: 100%; ', false, 'todos', 'animador-formulario'
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

        $Temas = temasTratadosAnimadorModel::temas(); 
        
        $animadores = temasTratadosAnimadorModel::animadores(
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
                $periodo, $animadores, $idProvincia, $idCanton, $Temas
        );
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->datos['RUTA'] = InformeTemasTratadosAnimadores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );

        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $animadores, $provincia = NULL, $canton = NULL, $Temas) {
        
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

                if(!empty($animadores)){
                    foreach ($animadores as $animador){

                        $objInformeTemas->TS += temasTratadosAnimadorModel::todos_ts($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->HSH += temasTratadosAnimadorModel::todos_hsh($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        $objInformeTemas->TRANS += temasTratadosAnimadorModel::todos_trans($temas->ID_TEMA, $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }

                $objInformeTemas->TOTAL = $objInformeTemas->TS + $objInformeTemas->HSH + $objInformeTemas->TRANS;

                array_push($objInforme->filas, $objInformeTemas);
            }
        }


        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animador'] = AgentesModel::animadores();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informes'] = $objInforme;


        return $objInforme;
    }
}


?>
