<?php

class reporteMensualSubreceptorControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
        //$this->control_de_subreceptor();
    }

    function datos_calculos_reporte_mensual() {
        $periodo = $this->datos['Periodo'];
        $subreceptor = $this->datos['SubReceptor'];

        $objMarcoDesempenoProyecto = array();
        $indicadores = IndicadoresModel::todos_subreceptor($subreceptor->ID_SUBRECEPTOR);
        if (!empty($indicadores)) {
            foreach ($indicadores as $indicador) {

                $objValorIndicador = NULL;
                $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
                $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
                $objValorIndicador->META_INDICADOR = ReporteMensualSubreceptorModel::meta_periodo_indicador_subreceptor(
                                $periodo->ID_PERIODO, $indicador->ID_INDICADOR, $subreceptor->ID_SUBRECEPTOR
                );
                $repotado = ReporteMensualSubreceptorModel::reporte_periodo_indicador_subreceptor(
                                $periodo->ID_PERIODO, $indicador->ID_INDICADOR, $subreceptor->ID_SUBRECEPTOR
                );
                $objValorIndicador->ACUM_REPORTADO = 0;
                $objValorIndicador->VALOR_REPORTADO = 0;
                if (count($repotado) > 0) {
                    $objValorIndicador->ACUM_REPORTADO = empty($repotado->ACUM_INDICADOR_SUBRECEPTOR) ? 0 : intval($repotado->ACUM_INDICADOR_SUBRECEPTOR);
                    $objValorIndicador->VALOR_REPORTADO = empty($repotado->VALOR_INDICADOR_SUBRECEPTOR) ? 0 : intval($repotado->VALOR_INDICADOR_SUBRECEPTOR);
                }
                $objValorIndicador->ACUM_INDICADOR = ReporteMensualSubreceptorModel::calcular_acumulado_indicador($periodo->ID_PERIODO, $indicador->ID_INDICADOR, $subreceptor->ID_SUBRECEPTOR);
                $objValorIndicador->VALOR_INDICADOR = ReporteMensualSubreceptorModel::calcular_valor_indicador($periodo->ID_PERIODO, $indicador->ID_INDICADOR, $subreceptor->ID_SUBRECEPTOR);

                array_push($objMarcoDesempenoProyecto, $objValorIndicador);
            }
        }
        $this->estado_reporte_mensual($this->datos['Periodo'], $this->datos['SubReceptor']);
        $this->datos['marcoDesempeno'] = $objMarcoDesempenoProyecto;
        return $objMarcoDesempenoProyecto;
    }

    public function mostrar_informe_mensual() {
        $this->datos_calculos_reporte_mensual();
        $this->vista->mostrar("reporte_mensual/informe_monitor", $this->datos);
    }

    public function actualizar_datos_reporte() {
        $periodo = $this->datos['Periodo'];
        $idPeriodo = $periodo->ID_PERIODO;
        $subreceptor = $this->datos['SubReceptor'];
        $idSubreceptor = $subreceptor->ID_SUBRECEPTOR;
        $this->estado_reporte_mensual($periodo, $subreceptor);

        $objMarcoDesempenoProyecto = array();
        $indicadores = IndicadoresModel::todos_subreceptor($subreceptor->ID_SUBRECEPTOR);
        foreach ($indicadores as $indicador) {
            $objValorIndicador = NULL;
            $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
            $objValorIndicador->META_INDICADOR = ReporteMensualSubreceptorModel::meta_periodo_indicador_subreceptor($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);
            $objValorIndicador->ACUM_INDICADOR = ReporteMensualSubreceptorModel::calcular_acumulado_indicador($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);
            $objValorIndicador->VALOR_INDICADOR = ReporteMensualSubreceptorModel::calcular_valor_indicador($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);
            if ($this->datos['estaPreAprobadoPeriodo']) {
                ReporteMensualSubreceptorModel::actualizar_pre_aprobar_reporte_subreceptor(
                        $idSubreceptor, $objValorIndicador->ID_INDICADOR, $idPeriodo, $objValorIndicador->META_INDICADOR, $objValorIndicador->ACUM_INDICADOR, $objValorIndicador->VALOR_INDICADOR
                );
            } else {
                ReporteMensualSubreceptorModel::pre_aprobar_reporte_subreceptor(
                        $idSubreceptor, $objValorIndicador->ID_INDICADOR, $idPeriodo, $objValorIndicador->META_INDICADOR, $objValorIndicador->ACUM_INDICADOR, $objValorIndicador->VALOR_INDICADOR
                );
            }
        }
    }

    public function pre_aprobar_informe_mensual() {
        $this->actualizar_datos_reporte();
        if ($this->datos['estaPreAprobadoPeriodo']) {
            ReporteMensualSubreceptorModel::actualiza_pre_aprobar_periodo_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        } else {
            ReporteMensualSubreceptorModel::pre_aprobar_periodo_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        }
        $indicadores = IndicadoresModel::todos_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR);
        $datosReporte = $this->generar_datos_reporte($this->datos['SubReceptor'], $this->datos['Periodo'], $indicadores);
        $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
                        $this->datos['SubReceptor'], $datosReporte, $this->datos['Periodo'], $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, 'no está aprobado', 'no está aceptado'
        );
        ReporteMensualSubreceptorModel::actualiza_ruta_reporte(
                $this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO, $this->datos['RUTA']
        );
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function mostrar_informe_mensual_coordinador() {
        $this->datos_calculos_reporte_mensual();
        $this->vista->mostrar("reporte_mensual/informe_coordinador", $this->datos);
    }

    public function aprobar_informe_mensual() {
        $this->estado_reporte_mensual($this->datos['Periodo'], $this->datos['SubReceptor']);
        if ($this->datos['estaAprobadoPeriodo']) {
            $this->actualizar_datos_reporte();
        }
        ReporteMensualSubreceptorModel::actualiza_aprobar_periodo_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        ReporteMensualSubreceptorModel::actualiza_aprobar_reporte_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);

        $estadoReporte = ReporteMensualSubreceptorModel::datos_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        $preAprueba = PersonasSistemaModel::datos($estadoReporte->ID_PREAPRUEBA);

        $indicadores = IndicadoresModel::todos_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR);
        $datosReporte = $this->generar_datos_reporte($this->datos['SubReceptor'], $this->datos['Periodo'], $indicadores);
        $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
                        $this->datos['SubReceptor'], $datosReporte, $this->datos['Periodo'], $preAprueba->NOMBRE_REAL_PERSONA, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, 'no está aceptado'
        );
        ReporteMensualSubreceptorModel::actualiza_ruta_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO, $this->datos['RUTA']);
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function mostrar_informe_mensual_gestor() {
        $this->datos_calculos_reporte_mensual();
        $this->vista->mostrar("reporte_mensual/informe_gestor", $this->datos);
    }

    public function aceptar_informe_mensual() {
        
        $insumos = self::calcular_insumos($this->datos['Periodo']->ID_PERIODO, $this->datos['SubReceptor']->ID_SUBRECEPTOR);        
        foreach ($insumos as $insumo) {            
            $cantidad_anterior=0;
            $consumo_insumos_existente = ConsumoInsumosModel::datos_por_parametros( $this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO, $insumo->ID_INSUMO);
            if($consumo_insumos_existente){
                $cantidad_anterior = $consumo_insumos_existente->CANTIDAD_CONSUMO_INSUMO;
                ConsumoInsumosModel::update($consumo_insumos_existente->ID_CONSUMO_INSUMO, $this->datos['SubReceptor']->ID_SUBRECEPTOR, 
                        $this->datos['Periodo']->ID_PERIODO, $insumo->ID_INSUMO, $insumo->CANTIDAD_INSUMO);
                
                InsumosModel::updateStock($insumo->ID_INSUMO, $cantidad_anterior);
                InsumosModel::updateStockResta($insumo->ID_INSUMO, $insumo->CANTIDAD_INSUMO);
                
            }else{
                ConsumoInsumosModel::insertar($this->datos['SubReceptor']->ID_SUBRECEPTOR, 
                        $this->datos['Periodo']->ID_PERIODO, $insumo->ID_INSUMO, $insumo->CANTIDAD_INSUMO);
                
                InsumosModel::updateStockResta($insumo->ID_INSUMO, $insumo->CANTIDAD_INSUMO);
            }
        }
                
        ReporteMensualSubreceptorModel::actualiza_aceptar_periodo_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        ReporteMensualSubreceptorModel::actualiza_aceptar_reporte_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);

        
        
        $estadoReporte = ReporteMensualSubreceptorModel::datos_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO);
        $preAprueba = PersonasSistemaModel::datos($estadoReporte->ID_PREAPRUEBA);
        $aprueba = PersonasSistemaModel::datos($estadoReporte->ID_APRUEBA);
        $indicadores = IndicadoresModel::todos_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR);
        $datosReporte = $this->generar_datos_reporte($this->datos['SubReceptor'], $this->datos['Periodo'], $indicadores);
        $this->datos['RUTA'] = ReporteMensualSubreceptor::generar(
                $this->datos['SubReceptor'], $datosReporte, $this->datos['Periodo'], $preAprueba->NOMBRE_REAL_PERSONA, $aprueba->NOMBRE_REAL_PERSONA, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );
        ReporteMensualSubreceptorModel::actualiza_ruta_reporte($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['Periodo']->ID_PERIODO, $this->datos['RUTA']);
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');

    }

    
    
    
    
    
    public function mostrar_ultimo_reporte_generado() {
        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
        $this->datos['periodo'] = $periodo;
        $this->datos_filtro_subreceptores();
        $objReporteMensual = InformesMensualesModel::estado_por_periodo($this->datos['SubReceptor']->ID_SUBRECEPTOR, $this->datos['periodo']->ID_PERIODO);
        $this->datos['RUTA'] = '';
        if (!empty($objReporteMensual)) {
            $this->datos['RUTA'] = $objReporteMensual->URL_REPORTE_SUBRECEPTOR;
        }
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_reporte($subreceptor, $periodo, $indicadores) {

        $objMarcoDesempenoProyecto = array();
        $idSubreceptor = $subreceptor->ID_SUBRECEPTOR;
        $idPeriodo = $periodo->ID_PERIODO;
        foreach ($indicadores as $indicador) {

            $objValorIndicador = NULL;
            $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
            $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
            $objValorIndicador->META_INDICADOR = ReporteMensualSubreceptorModel::meta_periodo_indicador_subreceptor($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);

            $repotado = ReporteMensualSubreceptorModel::reporte_periodo_indicador_subreceptor($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);

            $objValorIndicador->ACUM_REPORTADO = 0;
            $objValorIndicador->VALOR_REPORTADO = 0;
            if (count($repotado) > 0) {
                $objValorIndicador->ACUM_REPORTADO = empty($repotado->ACUM_INDICADOR_SUBRECEPTOR) ? 0 : intval($repotado->ACUM_INDICADOR_SUBRECEPTOR);
                $objValorIndicador->VALOR_REPORTADO = empty($repotado->VALOR_INDICADOR_SUBRECEPTOR) ? 0 : intval($repotado->VALOR_INDICADOR_SUBRECEPTOR);
            }


            $objValorIndicador->ACUM_INDICADOR = ReporteMensualSubreceptorModel::calcular_acumulado_indicador($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);
            $objValorIndicador->VALOR_INDICADOR = ReporteMensualSubreceptorModel::calcular_valor_indicador($idPeriodo, $indicador->ID_INDICADOR, $idSubreceptor);

            array_push($objMarcoDesempenoProyecto, $objValorIndicador);
        }

        return $objMarcoDesempenoProyecto;
    }

    public function estado_reporte_mensual($periodo, $subreceptor) {

        $this->datos['estaPreAprobadoPeriodo'] = false;
        if (!empty(InformesMensualesModel::estado_por_periodo($subreceptor->ID_SUBRECEPTOR, $periodo->ID_PERIODO)->ID_PREAPRUEBA)) {
            $this->datos['estaPreAprobadoPeriodo'] = true;
        }

        $this->datos['estaAprobadoPeriodo'] = false;
        if (!empty(InformesMensualesModel::estado_por_periodo($subreceptor->ID_SUBRECEPTOR, $periodo->ID_PERIODO)->ID_APRUEBA)) {
            $this->datos['estaAprobadoPeriodo'] = true;
        }

        $this->datos['estaAceptadoPeriodo'] = false;
        if (!empty(InformesMensualesModel::estado_por_periodo($subreceptor->ID_SUBRECEPTOR, $periodo->ID_PERIODO)->ID_ACEPTADO)) {
            $this->datos['estaAceptadoPeriodo'] = true;
        }
    }
    
    public function calcular_insumos($idPeriodo, $idSubreceptor){
        
        $objInsumos = array();
        $insumos = InsumosModel::todos();
        foreach ($insumos as $insumo) {
            
            $objValorInsumo = NULL;
            $objValorInsumo->ID_INSUMO = $insumo->ID_INSUMO;
            $objValorInsumo->CANTIDAD_INSUMO = 0;
            
            $objValorInsumo->CANTIDAD_INSUMO += 
                    IndicadoresModel::calcula_todos_promotores_insumos($idPeriodo, $idSubreceptor, $objValorInsumo->ID_INSUMO) + 
                    IndicadoresModel::calcula_todos_animadores_insumos($idPeriodo, $idSubreceptor, $objValorInsumo->ID_INSUMO) + 
                    IndicadoresModel::calcula_PVVS_consejeros_insumos($idPeriodo, $idSubreceptor, $objValorInsumo->ID_INSUMO) +
                    IndicadoresModel::calcula_todos_actividades_promocion_insumos($idPeriodo, $idSubreceptor, $objValorInsumo->ID_INSUMO) + 
                    IndicadoresModel::calcula_todos_eventos_masivos_insumos($idPeriodo, $idSubreceptor, $objValorInsumo->ID_INSUMO);
//            InsumosModel::updateStockResta($insumo->ID_INSUMO, $insumo_cantidad);
            array_push($objInsumos, $objValorInsumo);
        }
        
        return $objInsumos;
    }

}
