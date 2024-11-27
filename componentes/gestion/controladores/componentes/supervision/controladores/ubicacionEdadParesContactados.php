<?php

class ubicacionEdadParesContactadosControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_ubicacion_edad_pares_contactados() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->vista->mostrar("monitores/ubicacionEdadParesContactados", $this->datos);
    }
    public function busqueda_vista_ubicacion_edad_pares_contactados() {

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

         $provincias = reporteUbucacionParesContactadosModel::provinciaFiltroNuevo($this->datos['monitor-formulario'],
                                                         $this->datos['promotor-formulario'], 
                                                         $this->datos['provincia-chosen'],
                                                         $this->datos['sel-lista-cantones']
                                                         );
         
        $informe = array();
        $informe_total = array();
        $objInformeTotal=NULL;
        $objInformeTotal->TS_TOTAL_1014=0;
        $objInformeTotal->TS_TOTAL_1519=0;
        $objInformeTotal->TS_TOTAL_2024=0;
        $objInformeTotal->TS_TOTAL_2549=0;
        $objInformeTotal->TS_TOTAL_5059=0;
        $objInformeTotal->TS_TOTAL_60=0;

        $objInformeTotal->HSH_TOTAL_1014=0;
        $objInformeTotal->HSH_TOTAL_1519=0;
        $objInformeTotal->HSH_TOTAL_2024=0;
        $objInformeTotal->HSH_TOTAL_2549=0;
        $objInformeTotal->HSH_TOTAL_5059=0;
        $objInformeTotal->HSH_TOTAL_60 =0;

        $objInformeTotal->TRANS_TOTAL_1014 =0;
        $objInformeTotal->TRANS_TOTAL_1519 =0;
        $objInformeTotal->TRANS_TOTAL_2024 =0;
        $objInformeTotal->TRANS_TOTAL_2549 =0;
        $objInformeTotal->TRANS_TOTAL_5059 =0;
        $objInformeTotal->TRANS_TOTAL_60=0;

        $objInformeTotal->GRAN_TOTAL_TS=0;
        $objInformeTotal->GRAN_TOTAL_HSH=0;
        $objInformeTotal->GRAN_TOTAL_TRANS=0;
        
        if(!empty($provincias)){
            foreach ($provincias as $provincia){

                $cantones = UbicacionesModel::cantones_en_la_provincia($provincia->ID_PROVINCIA);
                if(!empty($cantones)){
                    foreach($cantones as $canton){
                        $informeActividades = NULL;
                        $informeActividades->CANTON = $canton->NOMBRE_CANTON;   
                        $informeActividades->PROVINCIA = $provincia->NOMBRE_PROVINCIA;
                        /* 
                         * HSH
                         */
                        $informeActividades->HSH_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "HSH", $canton->ID_CANTON);
                        $informeActividades->HSH_TOTAL = $informeActividades->HSH_1014 + $informeActividades->HSH_1519 +$informeActividades->HSH_2024
                                                        +$informeActividades->HSH_2549+$informeActividades->HSH_5059+$informeActividades->HSH_60;
                        /* 
                         * TRANS
                         */
                        $informeActividades->TRANS_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "TRANS", $canton->ID_CANTON);
                        $informeActividades->TRANS_TOTAL = $informeActividades->TRANS_1014 + $informeActividades->TRANS_1519 +$informeActividades->TRANS_2024
                                                        +$informeActividades->TRANS_2549+$informeActividades->TRANS_5059+$informeActividades->TRANS_60;
                        /* 
                         * TS
                         */
                        $informeActividades->TS_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "TS", $canton->ID_CANTON);
                        $informeActividades->TS_TOTAL = $informeActividades->TS_1014 + $informeActividades->TS_1519 +$informeActividades->TS_2024
                                                        +$informeActividades->TS_2549+$informeActividades->TS_5059+$informeActividades->TS_60;
                        
                         $informeActividades->TS_TOTAL_1014 += $informeActividades->TS_1014;
                         $informeActividades->TS_TOTAL_1519 += $informeActividades->TS_1519;
                         $informeActividades->TS_TOTAL_2024 += $informeActividades->TS_2024;
                         $informeActividades->TS_TOTAL_2549 += $informeActividades->TS_2549;
                         $informeActividades->TS_TOTAL_5059 += $informeActividades->TS_5059;
                         $informeActividades->TS_TOTAL_60 += $informeActividades->TS_60;
                         
                         $informeActividades->HSH_TOTAL_1014 += $informeActividades->HSH_1014;
                         $informeActividades->HSH_TOTAL_1519 += $informeActividades->HSH_1519;
                         $informeActividades->HSH_TOTAL_2024 += $informeActividades->HSH_2024;
                         $informeActividades->HSH_TOTAL_2549 += $informeActividades->HSH_2549;
                         $informeActividades->HSH_TOTAL_5059 += $informeActividades->HSH_5059;
                         $informeActividades->HSH_TOTAL_60 += $informeActividades->HSH_60;
                         
                         $informeActividades->TRANS_TOTAL_1014 += $informeActividades->TRANS_1014;
                         $informeActividades->TRANS_TOTAL_1519 += $informeActividades->TRANS_1519;
                         $informeActividades->TRANS_TOTAL_2024 += $informeActividades->TRANS_2024;
                         $informeActividades->TRANS_TOTAL_2549 += $informeActividades->TRANS_2549;
                         $informeActividades->TRANS_TOTAL_5059 += $informeActividades->TRANS_5059;
                         $informeActividades->TRANS_TOTAL_60 += $informeActividades->TRANS_60;
                         
                         $informeActividades->GRAN_TOTAL_TS += $informeActividades->TS_TOTAL;
                         $informeActividades->GRAN_TOTAL_HSH += $informeActividades->HSH_TOTAL;
                         $informeActividades->GRAN_TOTAL_TRANS += $informeActividades->TRANS_TOTAL;
                         
                        
                        array_push($informe, $informeActividades);
                        
                    }
                }
            }
        }
        
        foreach ($informe as $value) {
        $objInformeTotal->TS_TOTAL_1014+=$value->TS_TOTAL_1014;
        $objInformeTotal->TS_TOTAL_1519+=$value->TS_TOTAL_1519;
        $objInformeTotal->TS_TOTAL_2024+=$value->TS_TOTAL_2024;
        $objInformeTotal->TS_TOTAL_2549+=$value->TS_TOTAL_2549;
        $objInformeTotal->TS_TOTAL_5059+=$value->TS_TOTAL_5059;
        $objInformeTotal->TS_TOTAL_60+=$value->TS_TOTAL_60;

        $objInformeTotal->HSH_TOTAL_1014+=$value->HSH_TOTAL_1014;
        $objInformeTotal->HSH_TOTAL_1519+=$value->HSH_TOTAL_1519;
        $objInformeTotal->HSH_TOTAL_2024+=$value->HSH_TOTAL_2024;
        $objInformeTotal->HSH_TOTAL_2549+=$value->HSH_TOTAL_2549;
        $objInformeTotal->HSH_TOTAL_5059+=$value->HSH_TOTAL_5059;
        $objInformeTotal->HSH_TOTAL_60+=$value->HSH_TOTAL_60;

        $objInformeTotal->TRANS_TOTAL_1014+=$value->TRANS_TOTAL_1014;
        $objInformeTotal->TRANS_TOTAL_1519+=$value->TRANS_TOTAL_1519;
        $objInformeTotal->TRANS_TOTAL_2024+=$value->TRANS_TOTAL_2024;
        $objInformeTotal->TRANS_TOTAL_2549+=$value->TRANS_TOTAL_2549;
        $objInformeTotal->TRANS_TOTAL_5059+=$value->TRANS_TOTAL_5059;
        $objInformeTotal->TRANS_TOTAL_60+=$value->TRANS_TOTAL_60;

        $objInformeTotal->GRAN_TOTAL_TS+=$value->GRAN_TOTAL_TS;
        $objInformeTotal->GRAN_TOTAL_HSH+=$value->GRAN_TOTAL_HSH;
        $objInformeTotal->GRAN_TOTAL_TRANS+=$value->GRAN_TOTAL_TRANS;
        }
        
        array_push($informe_total, $objInformeTotal);
        $this->datos['informes'] = $informe;
        $this->datos['informe_total'] = $informe_total;
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->vista->mostrar("monitores/ubicacionEdadParesContactados", $this->datos);
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
        
        $provincias = reporteUbucacionParesContactadosModel::provinciaFiltroNuevo($this->datos['monitor-formulario'],
                                                         $this->datos['promotor-formulario'], 
                                                         $this->datos['provincia-chosen'],
                                                         $this->datos['sel-lista-cantones']
                                                         );
        
        
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }

        $datosInforme = $this->generar_datos_informe(
                $periodo, $provincias, $idProvincia, $idCanton
        );
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['RUTA'] = InformeUbicacionParesContactados::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe($periodo, $provincias, $provincia = NULL, $canton = NULL) {

        
        $informe = array();
        $informe_total = array();
        $objInformeTotal=NULL;
        $objInformeTotal->TS_TOTAL_1014=0;
        $objInformeTotal->TS_TOTAL_1519=0;
        $objInformeTotal->TS_TOTAL_2024=0;
        $objInformeTotal->TS_TOTAL_2549=0;
        $objInformeTotal->TS_TOTAL_5059=0;
        $objInformeTotal->TS_TOTAL_60=0;

        $objInformeTotal->HSH_TOTAL_1014=0;
        $objInformeTotal->HSH_TOTAL_1519=0;
        $objInformeTotal->HSH_TOTAL_2024=0;
        $objInformeTotal->HSH_TOTAL_2549=0;
        $objInformeTotal->HSH_TOTAL_5059=0;
        $objInformeTotal->HSH_TOTAL_60 =0;

        $objInformeTotal->TRANS_TOTAL_1014 =0;
        $objInformeTotal->TRANS_TOTAL_1519 =0;
        $objInformeTotal->TRANS_TOTAL_2024 =0;
        $objInformeTotal->TRANS_TOTAL_2549 =0;
        $objInformeTotal->TRANS_TOTAL_5059 =0;
        $objInformeTotal->TRANS_TOTAL_60=0;

        $objInformeTotal->GRAN_TOTAL_TS=0;
        $objInformeTotal->GRAN_TOTAL_HSH=0;
        $objInformeTotal->GRAN_TOTAL_TRANS=0;
        
        if(!empty($provincias)){
            foreach ($provincias as $provincia){

                $cantones = UbicacionesModel::cantones_en_la_provincia($provincia->ID_PROVINCIA);
                if(!empty($cantones)){
                    foreach($cantones as $canton){
                        $objInforme = NULL;
                        $objInforme->CANTON = $canton->NOMBRE_CANTON;   
                        $objInforme->PROVINCIA = $provincia->NOMBRE_PROVINCIA;
                        /* 
                         * HSH
                         */
                        $objInforme->HSH_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "HSH", $canton->ID_CANTON);
                        $objInforme->HSH_TOTAL = $objInforme->HSH_1014 + $objInforme->HSH_1519 +$objInforme->HSH_2024
                                                        +$objInforme->HSH_2549+$objInforme->HSH_5059+$objInforme->HSH_60;
                        /* 
                         * TRANS
                         */
                        $objInforme->TRANS_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "TRANS", $canton->ID_CANTON);
                        $objInforme->TRANS_TOTAL = $objInforme->TRANS_1014 + $objInforme->TRANS_1519 +$objInforme->TRANS_2024
                                                        +$objInforme->TRANS_2549+$objInforme->TRANS_5059+$objInforme->TRANS_60;
                        /* 
                         * TS
                         */
                        $objInforme->TS_1014 = reporteUbucacionParesContactadosModel::numero_pemar_edad(10, 14, "TS", $canton->ID_CANTON);
                        $objInforme->TS_1519 = reporteUbucacionParesContactadosModel::numero_pemar_edad(15, 19, "TS", $canton->ID_CANTON);
                        $objInforme->TS_2024 = reporteUbucacionParesContactadosModel::numero_pemar_edad(20, 24, "TS", $canton->ID_CANTON);
                        $objInforme->TS_2549 = reporteUbucacionParesContactadosModel::numero_pemar_edad(25, 49, "TS", $canton->ID_CANTON);
                        $objInforme->TS_5059 = reporteUbucacionParesContactadosModel::numero_pemar_edad(50, 59, "TS", $canton->ID_CANTON);
                        $objInforme->TS_60 = reporteUbucacionParesContactadosModel::numero_pemar_edad(60, 120, "TS", $canton->ID_CANTON);
                        $objInforme->TS_TOTAL = $objInforme->TS_1014 + $objInforme->TS_1519 +$objInforme->TS_2024
                                                        +$objInforme->TS_2549+$objInforme->TS_5059+$objInforme->TS_60;
                        
                         $objInforme->TS_TOTAL_1014 += $objInforme->TS_1014;
                         $objInforme->TS_TOTAL_1519 += $objInforme->TS_1519;
                         $objInforme->TS_TOTAL_2024 += $objInforme->TS_2024;
                         $objInforme->TS_TOTAL_2549 += $objInforme->TS_2549;
                         $objInforme->TS_TOTAL_5059 += $objInforme->TS_5059;
                         $objInforme->TS_TOTAL_60 += $objInforme->TS_60;
                         
                         $objInforme->HSH_TOTAL_1014 += $objInforme->HSH_1014;
                         $objInforme->HSH_TOTAL_1519 += $objInforme->HSH_1519;
                         $objInforme->HSH_TOTAL_2024 += $objInforme->HSH_2024;
                         $objInforme->HSH_TOTAL_2549 += $objInforme->HSH_2549;
                         $objInforme->HSH_TOTAL_5059 += $objInforme->HSH_5059;
                         $objInforme->HSH_TOTAL_60 += $objInforme->HSH_60;
                         
                         $objInforme->TRANS_TOTAL_1014 += $objInforme->TRANS_1014;
                         $objInforme->TRANS_TOTAL_1519 += $objInforme->TRANS_1519;
                         $objInforme->TRANS_TOTAL_2024 += $objInforme->TRANS_2024;
                         $objInforme->TRANS_TOTAL_2549 += $objInforme->TRANS_2549;
                         $objInforme->TRANS_TOTAL_5059 += $objInforme->TRANS_5059;
                         $objInforme->TRANS_TOTAL_60 += $objInforme->TRANS_60;
                         
                         $objInforme->GRAN_TOTAL_TS += $objInforme->TS_TOTAL;
                         $objInforme->GRAN_TOTAL_HSH += $objInforme->HSH_TOTAL;
                         $objInforme->GRAN_TOTAL_TRANS += $objInforme->TRANS_TOTAL;

                        array_push($informe, $objInforme);
                        
                    }
                }
            }
        }
        
        foreach ($informe as $value) {
        $objInformeTotal->TS_TOTAL_1014+=$value->TS_TOTAL_1014;
        $objInformeTotal->TS_TOTAL_1519+=$value->TS_TOTAL_1519;
        $objInformeTotal->TS_TOTAL_2024+=$value->TS_TOTAL_2024;
        $objInformeTotal->TS_TOTAL_2549+=$value->TS_TOTAL_2549;
        $objInformeTotal->TS_TOTAL_5059+=$value->TS_TOTAL_5059;
        $objInformeTotal->TS_TOTAL_60+=$value->TS_TOTAL_60;

        $objInformeTotal->HSH_TOTAL_1014+=$value->HSH_TOTAL_1014;
        $objInformeTotal->HSH_TOTAL_1519+=$value->HSH_TOTAL_1519;
        $objInformeTotal->HSH_TOTAL_2024+=$value->HSH_TOTAL_2024;
        $objInformeTotal->HSH_TOTAL_2549+=$value->HSH_TOTAL_2549;
        $objInformeTotal->HSH_TOTAL_5059+=$value->HSH_TOTAL_5059;
        $objInformeTotal->HSH_TOTAL_60+=$value->HSH_TOTAL_60;

        $objInformeTotal->TRANS_TOTAL_1014+=$value->TRANS_TOTAL_1014;
        $objInformeTotal->TRANS_TOTAL_1519+=$value->TRANS_TOTAL_1519;
        $objInformeTotal->TRANS_TOTAL_2024+=$value->TRANS_TOTAL_2024;
        $objInformeTotal->TRANS_TOTAL_2549+=$value->TRANS_TOTAL_2549;
        $objInformeTotal->TRANS_TOTAL_5059+=$value->TRANS_TOTAL_5059;
        $objInformeTotal->TRANS_TOTAL_60+=$value->TRANS_TOTAL_60;

        $objInformeTotal->GRAN_TOTAL_TS+=$value->GRAN_TOTAL_TS;
        $objInformeTotal->GRAN_TOTAL_HSH+=$value->GRAN_TOTAL_HSH;
        $objInformeTotal->GRAN_TOTAL_TRANS+=$value->GRAN_TOTAL_TRANS;
        }
        
        array_push($informe_total, $objInformeTotal);
        $this->datos['informes'] = $informe;
        $this->datos['informe_total'] = $informe_total;
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $objDatosInforme = NULL;
        $objDatosInforme->informe = array();
//        $objDatosInforme->informetotal = array();
        $objDatosInforme->informe = $informe;
        $objDatosInforme->informetotal = $informe_total;
        
        return $objDatosInforme;

    }
}
?>