<?php

class indicadoresControlador extends ControllerBase {

    public function antiguo_listados_indicadores_proyecto() {

        $objMarcoDesempenoProyecto = array();
        $Indicadores = IndicadoresModel::todos();
        $PeriodosIndicadores = IndicadoresModel::periodos_indicadores();
        foreach ($Indicadores as $indicador) {
            $objValorIndicador = NULL;
            $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
            $objValorIndicador->META_INDICADOR = empty($indicador->META_INDICADOR) ? 'sin definir' : $indicador->META_INDICADOR;
            $objValorIndicador->VALORES_SEMESTRALES = array();
            foreach ($PeriodosIndicadores as $periodo) {
                $valorPeriodo = IndicadoresModel::valor_periodo_indicador_proyecto($periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                array_push($objValorIndicador->VALORES_SEMESTRALES, $valorPeriodo);
            }
            array_push($objMarcoDesempenoProyecto, $objValorIndicador);
        }
        $this->datos['marcoDesempeno'] = $objMarcoDesempenoProyecto;
        $this->datos['PeriodosIndicadores'] = $PeriodosIndicadores;

        $this->vista->mostrar("metas_indicadores/listados_indicadores_proyecto", $this->datos);
    }

    public function listados_indicadores_proyecto() {


        $objMarcoDesempenoProyecto = array();
        $Indicadores = IndicadoresModel::todos();
        $PeriodosIndicadores = IndicadoresModel::periodos_indicadores();

        foreach ($Indicadores as $indicador) {
            $objValorIndicador = NULL;
            $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
            $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
            $objValorIndicador->META_INDICADOR = empty($indicador->META_INDICADOR) ? 'sin definir' : $indicador->META_INDICADOR;
            $objValorIndicador->VALORES_SEMESTRALES = array();
            foreach ($PeriodosIndicadores as $periodo) {
                if ($indicador->ID_INDICADOR == '10') {
                    $valorPeriodo = IndicadoresModel::numero_sesionesID_navegacion_web($periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                } elseif ($indicador->ID_INDICADOR == '11') {
                    $valorPeriodo = IndicadoresModel::numero_efectivos_navegacion_web($periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                } elseif ($indicador->ID_INDICADOR == '12') {
                    $valorPeriodo = IndicadoresModel::efectivos_eventos_masivos($periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                } else {
                    $valorPeriodo = IndicadoresModel::valor_periodo_indicador_proyecto($periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                }
                array_push($objValorIndicador->VALORES_SEMESTRALES, $valorPeriodo);
            }
            array_push($objMarcoDesempenoProyecto, $objValorIndicador);
        }

        $this->datos['marcoDesempeno'] = $objMarcoDesempenoProyecto;
        $this->datos['PeriodosIndicadores'] = $PeriodosIndicadores;

        $this->vista->mostrar("metas_indicadores/listados_indicadores_proyecto", $this->datos);
    }

    public function listados_indicadores_por_subreceptor() {
        $this->datos_filtro_subreceptores();
        $idSubreceptor = $this->datos['SubReceptor']->ID_SUBRECEPTOR;

        $objMarcoDesempenoProyecto = array();
        $Indicadores = IndicadoresModel::todos_subreceptor($this->datos['SubReceptor']->ID_SUBRECEPTOR);
        $PeriodosIndicadores = IndicadoresModel::periodos_indicadores();
        if (!empty($Indicadores)) {
            foreach ($Indicadores as $indicador) {
                $objValorIndicador = NULL;
                $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
                $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
                $objValorIndicador->META_INDICADOR = empty($indicador->META_INDICADOR) ? 'sin definir' : $indicador->META_INDICADOR;
                $objValorIndicador->VALORES_SEMESTRALES = array();
                foreach ($PeriodosIndicadores as $periodo) {
                    $valorPeriodo = IndicadoresModel::valor_periodo_indicador_subreceptor(
                                    $periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR, $this->datos['SubReceptor']->ID_SUBRECEPTOR
                    );
                    array_push($objValorIndicador->VALORES_SEMESTRALES, $valorPeriodo);
                }
                array_push($objMarcoDesempenoProyecto, $objValorIndicador);
            }
        }

        $this->datos['marcoDesempeno'] = $objMarcoDesempenoProyecto;
        $this->datos['PeriodosIndicadores'] = $PeriodosIndicadores;

        $this->vista->mostrar("metas_indicadores/listados_indicadores_subreceptor", $this->datos);
    }

}
