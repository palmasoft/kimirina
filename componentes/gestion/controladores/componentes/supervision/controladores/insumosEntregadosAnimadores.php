<?php

class insumosEntregadosAnimadoresControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_insumos_entregados_animadores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->datos['Datos'] = insumosentregadoAnimadoresModel::todos();
        
        $this->vista->mostrar("animadores/insumosEntregadosAnimadores", $this->datos);
    }
    
    public function busqueda_insumos_entregados_animadores() {

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-contactos'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-contactos']);
        }
        $objInforme = NULL;

        //IMPRESOS
        $objInforme->TS_IMPRESOS = 0;
        $objInforme->HSH_IMPRESOS = 0;
        $objInforme->TRANS_IMPRESOS = 0;
        //CONDONES
        $objInforme->TS_CONDONES = 0;
        $objInforme->HSH_CONDONES = 0;
        $objInforme->TRANS_CONDONES = 0;
        //LUBRICANTES
        $objInforme->TS_LUBRICANTES = 0;
        $objInforme->HSH_LUBRICANTES = 0;
        $objInforme->TRANS_LUBRICANTES = 0;
        $objInforme->totalCondones = 0;
        $objInforme->totalFolleteria = 0;
        $objInforme->totalLubricantes = 0;
        
        $animadores = insumosentregadoAnimadoresModel::animadores(
                $this->datos['monitor-formulario'], $this->datos['animador-formulario'],
                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        if(!empty($animadores)){
            foreach ($animadores as $animador){

                //IMPRESOS
                $objInforme->TS_IMPRESOS += insumosentregadoAnimadoresModel::cantidad_folletos_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);            
                $objInforme->HSH_IMPRESOS +=insumosentregadoAnimadoresModel::cantidad_folletos_HSH($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_IMPRESOS += insumosentregadoAnimadoresModel::cantidad_folletos_TRANS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //CONDONES
                $objInforme->TS_CONDONES += insumosentregadoAnimadoresModel::cantidad_condones_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_CONDONES +=insumosentregadoAnimadoresModel::cantidad_condones_HSH($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_CONDONES += insumosentregadoAnimadoresModel::cantidad_condones_TRANS($animador->ID_PERSONA,$periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);


                //LUBRICANTES
                $objInforme->TS_LUBRICANTES += insumosentregadoAnimadoresModel::cantidad_lubricantes_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_LUBRICANTES +=insumosentregadoAnimadoresModel::cantidad_lubricantes_HSH( $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_LUBRICANTES += insumosentregadoAnimadoresModel::cantidad_lubricantes_TRANS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

            
            }
        }
        $objInforme->totalCondones += $objInforme->TS_CONDONES + $objInforme->HSH_CONDONES + $objInforme->TRANS_CONDONES;
        $objInforme->totalFolleteria += $objInforme->TS_IMPRESOS + $objInforme->HSH_IMPRESOS + $objInforme->TRANS_IMPRESOS;
        $objInforme->totalLubricantes += $objInforme->TS_LUBRICANTES + $objInforme->HSH_LUBRICANTES + $objInforme->TRANS_LUBRICANTES;
            
        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Animador'] = $this->datos['animador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->vista->mostrar("animadores/insumosEntregadosAnimadores", $this->datos);
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

        $animadores = insumosentregadoAnimadoresModel::animadores(
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
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->datos['RUTA'] = InformeInsumosEntregadosAnimadores::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
        );

        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $animadores, $provincia = NULL, $canton = NULL) {
        
        $objInforme = NULL;

        //IMPRESOS
        $objInforme->TS_IMPRESOS = 0;
        $objInforme->HSH_IMPRESOS = 0;
        $objInforme->TRANS_IMPRESOS = 0;
        //CONDONES
        $objInforme->TS_CONDONES = 0;
        $objInforme->HSH_CONDONES = 0;
        $objInforme->TRANS_CONDONES = 0;
        //LUBRICANTES
        $objInforme->TS_LUBRICANTES = 0;
        $objInforme->HSH_LUBRICANTES = 0;
        $objInforme->TRANS_LUBRICANTES = 0;
        $objInforme->totalCondones = 0;
        $objInforme->totalFolleteria = 0;
        $objInforme->totalLubricantes = 0;
        
        
        if(!empty($animadores)){
            foreach ($animadores as $animador){

                //IMPRESOS
                $objInforme->TS_IMPRESOS += insumosentregadoAnimadoresModel::cantidad_folletos_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);            
                $objInforme->HSH_IMPRESOS +=insumosentregadoAnimadoresModel::cantidad_folletos_HSH($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_IMPRESOS += insumosentregadoAnimadoresModel::cantidad_folletos_TRANS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //CONDONES
                $objInforme->TS_CONDONES += insumosentregadoAnimadoresModel::cantidad_condones_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_CONDONES +=insumosentregadoAnimadoresModel::cantidad_condones_HSH($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_CONDONES += insumosentregadoAnimadoresModel::cantidad_condones_TRANS($animador->ID_PERSONA,$periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);


                //LUBRICANTES
                $objInforme->TS_LUBRICANTES += insumosentregadoAnimadoresModel::cantidad_lubricantes_TS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_LUBRICANTES +=insumosentregadoAnimadoresModel::cantidad_lubricantes_HSH( $animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_LUBRICANTES += insumosentregadoAnimadoresModel::cantidad_lubricantes_TRANS($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

            
            }
        }
        $objInforme->totalCondones += $objInforme->TS_CONDONES + $objInforme->HSH_CONDONES + $objInforme->TRANS_CONDONES;
        $objInforme->totalFolleteria += $objInforme->TS_IMPRESOS + $objInforme->HSH_IMPRESOS + $objInforme->TRANS_IMPRESOS;
        $objInforme->totalLubricantes += $objInforme->TS_LUBRICANTES + $objInforme->HSH_LUBRICANTES + $objInforme->TRANS_LUBRICANTES;


        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animador'] = AgentesModel::animadores();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);


        return $objInforme;
    }
}

?>
