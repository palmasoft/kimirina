<?php

class metasSubreceptoresControlador extends ControllerBase {

    function datos_indicadores_metas_subreceptores() {

        $idSubreceptor = empty($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR) ? 1 : $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR;
        if (isset($this->datos['idSubreceptor'])) {
            $idSubreceptor = $this->datos['idSubreceptor'];
        }
        $subreceptor = SubreceptoresModel::datos_subreceptor($idSubreceptor);

        $objMarcoDesempenoProyecto = array();
        $Indicadores = IndicadoresModel::todos_subreceptores();
        $PeriodosIndicadores = IndicadoresModel::periodos_indicadores();
        foreach ($Indicadores as $indicador) {
            $objValorIndicador = NULL;
            $objValorIndicador->ID_INDICADOR = intval($indicador->ID_INDICADOR);
            $objValorIndicador->NOMBRE_INDICADOR = $indicador->NOMBRE_INDICADOR;
            $objValorIndicador->META_INDICADOR = empty($indicador->META_INDICADOR) ? 'sin definir' : $indicador->META_INDICADOR;
            $objValorIndicador->VALORES_SEMESTRALES = array();
            foreach ($PeriodosIndicadores as $periodo) {
                $valorPeriodo = NULL;
                $valorPeriodo->META_SUBRECEPTOR = 0;
                $valorPeriodo->ID_PERIODO_INDICADOR = $periodo->ID_PERIODO_INDICADOR;
                $valorPeriodo->ID_INDICADOR = $indicador->ID_INDICADOR;
                $valorPeriodo->ID_SUBRECEPTOR = $subreceptor->ID_SUBRECEPTOR;
                $resMeta = MetasSubreceptoresModel::valor_meta($subreceptor->ID_SUBRECEPTOR, $periodo->ID_PERIODO_INDICADOR, $indicador->ID_INDICADOR);
                if (!is_int($resMeta)) {
                    $valorPeriodo = $resMeta;
                }

                array_push($objValorIndicador->VALORES_SEMESTRALES, $valorPeriodo);
            }
            array_push($objMarcoDesempenoProyecto, $objValorIndicador);
        }

        $this->datos['SubReceptores'] = SubreceptoresModel::todos();
        $this->datos['Subreceptor'] = $subreceptor;
        $this->datos['marcoDesempeno'] = $objMarcoDesempenoProyecto;
        $this->datos['PeriodosIndicadores'] = $PeriodosIndicadores;
    }

    public function mostrar_form_meta_por_subreceptor() {
        
        $this->datos_indicadores_metas_subreceptores();
              
        $this->vista->mostrar("metas_subreceptores/metas_por_subreceptor", $this->datos);
    }

    public function listado_metas_subreceptor() {
        $this->datos['metaSubreceptores'] = MetasSubreceptoresModel::todos();
        $this->datos['subreceptores'] = SubreceptoresModel::todos();

        $this->vista->mostrar("metas_subreceptores/listado_metas_subreceptores", $this->datos);
    }

    public function mostrar_form_metas_subreceptor() {

        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['periodos'] = PeriodosIndicadoresModel::todos();
        $this->datos['indicadores'] = IndicadoresModel::todos();

        $this->vista->mostrar("metas_subreceptores/form_metas_subreceptores", $this->datos);
    }

    public function guardar_metas_subreceptor() {

        foreach ($this->datos['valor_meta_subreceptor'] as $indicador => $MetaPeriodo) {
            foreach ($MetaPeriodo as $periodo => $Meta) {
                $id = MetasSubreceptoresModel::insertar(
                                $this->datos['subreceptor-id'], $periodo, $indicador, $Meta
                );
                if ($id == 0) {
                    $id = MetasSubreceptoresModel::actualizar_meta(
                                    $this->datos['subreceptor-id'], $periodo, $indicador, $Meta
                    );
                }
            }
        }


        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Metas del Subreceptor Guardadas Exitosamente"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function guardar_nueva_meta_subreceptor() {
        $id = MetasSubreceptoresModel::insertar(
                        $this->datos['subreceptor'], $this->datos['periodos'], $this->datos['indicador'], $this->datos['Meta_subreceptor']
        );

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Exitoso"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function editar_form_meta_subreceptor() {

        $this->datos['datosSubreceptores'] = MetasSubreceptoresModel::datos_meta_subreceptor($this->datos['id_meta_subreceptor']);

        $this->datos['subreceptores'] = SubreceptoresModel::todos();
        $this->datos['periodos'] = PeriodosIndicadoresModel::todos();
        $this->datos['indicadores'] = IndicadoresModel::todos();

        $this->vista->mostrar("metas_subreceptores/form_metas_subreceptores", $this->datos);
    }

    public function update_meta_subreceptor() {

        $id = MetasSubreceptoresModel::update(
                        $this->datos['registro-id'], $this->datos['subreceptor'], $this->datos['periodos'], $this->datos['indicador'], $this->datos['Meta_subreceptor']
        );

        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Registro Exitoso"}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    public function eliminar_meta_subreceptor() {
        $id = MetasSubreceptoresModel::eliminar(
                        $this->datos['id_meta_subreceptor']
        );
        if ($id > 0) {
            echo '{ "resultado":"EXITO", "mensaje":" Se ha eliminado correctamente el Registro de SIMON."}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

}
