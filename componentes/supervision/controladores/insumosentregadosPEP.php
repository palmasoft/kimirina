<?php

class insumosentregadosPEPControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_insumos_entregados_PEP() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("monitores/insumosEntregadosPEP", $this->datos);
    }

    public function busqueda_insumos_entregados_PEP() {

        $promotores = insumosentregadoPEPModel::promotores(
                $this->datos['monitor-formulario'], $this->datos['promotor-formulario'],
                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        ); 
        
        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $provincia = NULL, $canton = NULL
        );
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->vista->mostrar("monitores/insumosEntregadosPEP", $this->datos);
        
    }
    
    public function informe_antiguo(){
        
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


        $promotores = insumosentregadoPEPModel::promotores(
                $this->datos['monitor-formulario'], $this->datos['promotor-formulario'],
                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        ); 
        if(!empty($promotores)){
            foreach ($promotores as $promotor) {

                //IMPRESOS
                $objInforme->TS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //CONDONES
                $objInforme->TS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_CONDONES += insumosentregadoPEPModel::cantidad_condones_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //LUBRICANTES
                $objInforme->TS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

           
             }
        }
            $objInforme->totalCondones += $objInforme->TS_CONDONES + $objInforme->HSH_CONDONES + $objInforme->TRANS_CONDONES;
            $objInforme->totalFolleteria += $objInforme->TS_IMPRESOS + $objInforme->HSH_IMPRESOS + $objInforme->TRANS_IMPRESOS;
            $objInforme->totalLubricantes += $objInforme->TS_LUBRICANTES + $objInforme->HSH_LUBRICANTES + $objInforme->TRANS_LUBRICANTES;
            
        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->vista->mostrar("monitores/insumosEntregadosPEP", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $promotores){
        
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

        if(!empty($promotores)){
            foreach ($promotores as $promotor) {

                foreach ($periodos as $periodo) {
                    //IMPRESOS
                    $objInforme->TS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->HSH_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->TRANS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                    //CONDONES
                    $objInforme->TS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->HSH_CONDONES += insumosentregadoPEPModel::cantidad_condones_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->TRANS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                    //LUBRICANTES
                    $objInforme->TS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->HSH_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInforme->TRANS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                }
            }     
        }
        
        $objInforme->totalCondones += $objInforme->TS_CONDONES + $objInforme->HSH_CONDONES + $objInforme->TRANS_CONDONES;
        $objInforme->totalFolleteria += $objInforme->TS_IMPRESOS + $objInforme->HSH_IMPRESOS + $objInforme->TRANS_IMPRESOS;
        $objInforme->totalLubricantes += $objInforme->TS_LUBRICANTES + $objInforme->HSH_LUBRICANTES + $objInforme->TRANS_LUBRICANTES;
            
        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
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
                
        $promotores = insumosentregadoPEPModel::promotores(
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
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeInsumosEntregadosPEP::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeInsumosEntregadosPEP::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            default:
                break;
        }
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
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
                
        $promotores = insumosentregadoPEPModel::promotores(
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
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeInsumosEntregadosPEP::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeInsumosEntregadosPEP::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            default:
                break;
        }
        
        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL) {

        
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


        
        if(!empty($promotores)){
            foreach ($promotores as $promotor) {

                //IMPRESOS
                $objInforme->TS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_IMPRESOS += insumosentregadoPEPModel::cantidad_folletos_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //CONDONES
                $objInforme->TS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_CONDONES += insumosentregadoPEPModel::cantidad_condones_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_CONDONES += insumosentregadoPEPModel::cantidad_condones_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                //LUBRICANTES
                $objInforme->TS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->HSH_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_HSH($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInforme->TRANS_LUBRICANTES += insumosentregadoPEPModel::cantidad_lubricantes_TRANS($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

           
             }
        }
        
        $objInforme->totalCondones += $objInforme->TS_CONDONES + $objInforme->HSH_CONDONES + $objInforme->TRANS_CONDONES;
        $objInforme->totalFolleteria += $objInforme->TS_IMPRESOS + $objInforme->HSH_IMPRESOS + $objInforme->TRANS_IMPRESOS;
        $objInforme->totalLubricantes += $objInforme->TS_LUBRICANTES + $objInforme->HSH_LUBRICANTES + $objInforme->TRANS_LUBRICANTES;
         
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->datos['Informes'] = $objInforme;
        
        return $objInforme;

    }
}

?>
