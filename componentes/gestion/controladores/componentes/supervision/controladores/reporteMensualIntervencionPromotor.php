<?php

class reporteMensualIntervencionPromotorControlador extends ControllerBase {
    
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_vista_reporte_intervencion_promotor() {
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->datos['Datos'] = reporteMensualIntervencionPromotorModel::todos();

       $this->vista->mostrar("monitores/reporteMensualIntervencionPromotor", $this->datos);
    }
    
    public function busqueda_vista_reporte_intervencion_promotor() {
        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH= 0;
        $objInforme->totalTRANS= 0;
        $objInforme->filas = array();
        
        $tipoLugares = reporteMensualIntervencionPromotorModel::tipolugares(
                     $this->datos['monitor-formulario'],
                     $this->datos['promotor-formulario'] 
        );
        
        $promotores = promotoresActividadModel::promotores_filtrados(
                                $this->datos['monitor-formulario'],$this->datos['promotor-formulario'],
                                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );        
        $periodo = PeriodosModel::activo();

        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
        
        if(!empty($tipoLugares)){
            foreach ($tipoLugares as $tipolugar) {

                $objInformeTipoLugares = NULL;
                $objInformeTipoLugares->NOMBRE_TIPOLUGAR= $tipolugar->NOMBRE_TIPOLUGAR ;
                $objInformeTipoLugares->FRECUENCIA = 0;
                $objInformeTipoLugares->TS = 0; 
                $objInformeTipoLugares->HSH = 0;
                $objInformeTipoLugares->TRANS = 0; 

                if(!empty($promotores)){
                    foreach ($promotores as $promotor){
                       $objInformeTipoLugares->TS += reporteMensualIntervencionPromotorModel::cantidad_tipo_ts($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                       $objInformeTipoLugares->HSH +=reporteMensualIntervencionPromotorModel::cantidad_tipo_hsh($tipolugar->ID_TIPOLUGAR,$promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                       $objInformeTipoLugares->TRANS += reporteMensualIntervencionPromotorModel::cantidad_tipo_trans($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA,  $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                       $objInformeTipoLugares->FRECUENCIA += reporteMensualIntervencionPromotorModel::frecuencia($tipolugar->ID_TIPOLUGAR,$promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    }
                }
            //    $objInformeTipoLugares->FRECUENCIA = reporteMensualIntervencionPromotorModel::frecuencia($tipolugar->ID_TIPOLUGAR, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInformeTipoLugares->TOTAL = $objInformeTipoLugares->TS+$objInformeTipoLugares->HSH+$objInformeTipoLugares->TRANS;

                $objInforme->totalHSH +=$objInformeTipoLugares->HSH;
                $objInforme->totalTS += $objInformeTipoLugares->TS;
                $objInforme->totalTRANS += $objInformeTipoLugares->TRANS;       

                array_push($objInforme->filas, $objInformeTipoLugares);
            }
        }
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

       $this->vista->mostrar("monitores/reporteMensualIntervencionPromotor", $this->datos);
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
        
        $tipoLugares = reporteMensualIntervencionPromotorModel::tipolugares(
                     $this->datos['monitor-formulario'],
                     $this->datos['promotor-formulario'] 
        );
        
        $promotores = promotoresActividadModel::promotores_filtrados(
                                $this->datos['monitor-formulario'],$this->datos['promotor-formulario'],
                                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $promotores, $idProvincia, $idCanton, $tipoLugares
        );
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['RUTA'] = InformeMensualIntervencionPromotor::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe($periodo, $promotores, $provincia = NULL, $canton = NULL, $tipoLugares) {

        
        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH= 0;
        $objInforme->totalTRANS= 0;
        $objInforme->filas = array();
        
        if(!empty($tipoLugares)){
            foreach ($tipoLugares as $tipolugar) {
                $objInformeTipoLugares = NULL;
                $objInformeTipoLugares->NOMBRE_TIPOLUGAR= $tipolugar->NOMBRE_TIPOLUGAR ;

                $objInformeTipoLugares->TS =0; 
                $objInformeTipoLugares->HSH = 0;
                $objInformeTipoLugares->TRANS = 0; 

                if(!empty($promotores)){
                    foreach ($promotores as $promotor){
                       $objInformeTipoLugares->TS += reporteMensualIntervencionPromotorModel::cantidad_tipo_ts($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                       $objInformeTipoLugares->HSH +=reporteMensualIntervencionPromotorModel::cantidad_tipo_hsh($tipolugar->ID_TIPOLUGAR,$promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                       $objInformeTipoLugares->TRANS += reporteMensualIntervencionPromotorModel::cantidad_tipo_trans($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA,  $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);

                    }
                }
                $objInformeTipoLugares->FRECUENCIA = reporteMensualIntervencionPromotorModel::frecuencia($tipolugar->ID_TIPOLUGAR, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $objInformeTipoLugares->TOTAL = $objInformeTipoLugares->TS+$objInformeTipoLugares->HSH+$objInformeTipoLugares->TRANS;

                $objInforme->totalHSH +=$objInformeTipoLugares->HSH;
                $objInforme->totalTS += $objInformeTipoLugares->TS;
                $objInforme->totalTRANS += $objInformeTipoLugares->TRANS;       

                array_push($objInforme->filas, $objInformeTipoLugares);
            }
        }
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->datos['Informes'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        return $objInforme;

    }

}
?>
