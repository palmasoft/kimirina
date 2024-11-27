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
        
        $tipoLugares = reporteMensualIntervencionPromotorModel::tipolugares(
                     $this->datos['monitor-formulario'],
                     $this->datos['promotor-formulario'] 
        );
        
        $promotores = promotoresActividadModel::promotores_filtrados(
                                $this->datos['monitor-formulario'],$this->datos['promotor-formulario'],
                                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );        
        
        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $tipoLugares, $provincia = NULL, $canton = NULL
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

       $this->vista->mostrar("monitores/reporteMensualIntervencionPromotor", $this->datos);

    }
    
    public function informe_antiguo($tipoLugares, $promotores, $periodo){
        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH= 0;
        $objInforme->totalTRANS= 0;
        $objInforme->filas = array();
        
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
    
    public function generar_datos_informe($periodos, $promotores, $tipoLugares){
        $objInforme = NULL;
        $objInforme->totalTS = 0;
        $objInforme->totalHSH= 0;
        $objInforme->totalTRANS= 0;
        $objInforme->filas = array();
        
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
                        foreach ($periodos as $periodo) {
                            $objInformeTipoLugares->TS += reporteMensualIntervencionPromotorModel::cantidad_tipo_ts($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                            $objInformeTipoLugares->HSH +=reporteMensualIntervencionPromotorModel::cantidad_tipo_hsh($tipolugar->ID_TIPOLUGAR,$promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                            $objInformeTipoLugares->TRANS += reporteMensualIntervencionPromotorModel::cantidad_tipo_trans($tipolugar->ID_TIPOLUGAR, $promotor->ID_PERSONA,  $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                            $objInformeTipoLugares->FRECUENCIA += reporteMensualIntervencionPromotorModel::frecuencia($tipolugar->ID_TIPOLUGAR,$promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                        }
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $tipoLugares, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeMensualIntervencionPromotor::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeMensualIntervencionPromotor::generar_trimestre(
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
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $tipoLugares, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeMensualIntervencionPromotor::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeMensualIntervencionPromotor::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            default:
                break;
        }

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL, $tipoLugares) {

        
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
