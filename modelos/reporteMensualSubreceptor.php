<?php

class ReporteMensualSubreceptorModel extends ModelBase {

    public static function datos_reporte($idSubreceptor, $idPeriodo) {
        $query = "SELECT subreceptores_informes_mensuales.* FROM subreceptores_informes_mensuales 
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function actualiza_ruta_reporte($idSubreceptor, $idPeriodo, $ruta) {

        $ruta = str_replace(DS, '/', $ruta);

        $query = "update subreceptores_informes_mensuales set URL_REPORTE_SUBRECEPTOR = '" . $ruta . "' 
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

    public static function pre_aprobar_periodo_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "insert into subreceptores_informes_mensuales ( ID_SUBRECEPTOR, ID_PERIODO, ID_PREAPRUEBA ) 
        values ( " . $idSubreceptor . ", " . $idPeriodo . ", " . $_SESSION['SESION_USUARIO']->ID_PERSONA . ") ";
        return self::crear_ultimo_id($query);
    }

    public static function actualiza_pre_aprobar_periodo_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "update subreceptores_informes_mensuales set ID_PREAPRUEBA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , FECHA_PREAPRUEBA =  CURRENT_TIMESTAMP 	
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

    public static function actualiza_aprobar_periodo_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "update subreceptores_informes_mensuales set ID_APRUEBA = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , FECHA_APRUEBA =  CURRENT_TIMESTAMP 	
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

    public static function actualiza_aprobar_reporte_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "update subreceptores_metas_valores set ID_APROBACION = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , FECHA_APROBACION =  CURRENT_TIMESTAMP 	
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

    public static function pre_aprobar_reporte_subreceptor($idSubreceptor, $ID_INDICADOR, $idPeriodo, $META_INDICADOR, $ACUM_INDICADOR, $VALOR_INDICADOR) {
       $query = "insert into subreceptores_metas_valores 
	(ID_SUBRECEPTOR, ID_INDICADOR, ID_PERIODO, META_INDICADOR_SUBRECEPTOR, 
	ACUM_INDICADOR_SUBRECEPTOR, VALOR_INDICADOR_SUBRECEPTOR,ID_PREAPROBACION)
	values
	( " . $idSubreceptor . ", " . $ID_INDICADOR . ", " . $idPeriodo . ", '" . $META_INDICADOR . "', '" . $ACUM_INDICADOR . "', '" . $VALOR_INDICADOR . "'," . $_SESSION['SESION_USUARIO']->ID_PERSONA . ") ";
        return self::crear_ultimo_id($query);
    }

    public static function actualizar_pre_aprobar_reporte_subreceptor($idSubreceptor, $ID_INDICADOR, $idPeriodo, $META_INDICADOR, $ACUM_INDICADOR, $VALOR_INDICADOR) {
        $query = "delete from subreceptores_metas_valores where 
            ID_SUBRECEPTOR = " . $idSubreceptor . " and 
	ID_INDICADOR = " . $ID_INDICADOR . " and 
	ID_PERIODO = " . $idPeriodo . "  ";
        self::modificarRegistros($query);

        $query = "insert into subreceptores_metas_valores 
	(ID_SUBRECEPTOR, ID_INDICADOR, ID_PERIODO, META_INDICADOR_SUBRECEPTOR, 
	ACUM_INDICADOR_SUBRECEPTOR, VALOR_INDICADOR_SUBRECEPTOR,ID_PREAPROBACION)
	values
	( " . $idSubreceptor . ", " . $ID_INDICADOR . ", " . $idPeriodo . ", '" . $META_INDICADOR . "', '" . $ACUM_INDICADOR . "', '" . $VALOR_INDICADOR . "'," . $_SESSION['SESION_USUARIO']->ID_PERSONA . ") ";
        return self::crear_ultimo_id($query);
    }

    public static function meta_periodo_indicador_subreceptor($PERIODO, $INDICADOR, $SUBRECEPTOR) {
        $query = "SELECT periodos_indicadores.ID_PERIODO_INDICADOR,     subreceptores_metas.META_SUBRECEPTOR
            FROM    subreceptores_metas
                LEFT JOIN periodos_indicadores 
                    ON (subreceptores_metas.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)    
            WHERE subreceptores_metas.ID_INDICADOR = " . $INDICADOR . " AND subreceptores_metas.ID_SUBRECEPTOR = " . $SUBRECEPTOR . " AND 
                    subreceptores_metas.ID_PERIODO_INDICADOR = 
                    (SELECT periodos.ID_PERIODO_INDICADOR FROM periodos WHERE periodos.ID_PERIODO = " . $PERIODO . " )
             group by periodos_indicadores.ID_PERIODO_INDICADOR,     subreceptores_metas.META_SUBRECEPTOR  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->META_SUBRECEPTOR;
        }
        return 0;
    }

    public static function reporte_periodo_indicador_subreceptor($PERIODO, $INDICADOR, $SUBRECEPTOR) {
        $query = "
           SELECT 
            subreceptores_metas_valores.* 
           FROM 
            subreceptores_metas_valores     
           WHERE subreceptores_metas_valores.ID_INDICADOR = " . $INDICADOR . " 
                AND subreceptores_metas_valores.ID_SUBRECEPTOR = " . $SUBRECEPTOR . " AND 
	subreceptores_metas_valores.ID_PERIODO = " . $PERIODO . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function calcular_acumulado_indicador($PERIODO, $INDICADOR, $SUBRECEPTOR) {

        $Periodos = PeriodosModel::todos_menores_periodo($PERIODO);
        $acumulador = 0;
        if ($Periodos != 0) {
            foreach ($Periodos as $periodo) {
                $acumulador += self::calcular_valor_indicador($periodo->ID_PERIODO, $INDICADOR, $SUBRECEPTOR);
            }
        }
        return $acumulador;
    }

    public static function calcular_valor_indicador($PERIODO, $INDICADOR, $SUBRECEPTOR) {

        switch ($INDICADOR) {
            case 1:
                return IndicadoresModel::calcula_HSH_promotores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 2:
                return IndicadoresModel::calcula_TS_promotores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 3:
                return IndicadoresModel::calcula_TRANS_promotores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 4:
                return IndicadoresModel::calcula_HSH_animadores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 5:
                return IndicadoresModel::calcula_TS_animadores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 6:
                return IndicadoresModel::calcula_TRANS_animadores($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 7:
                return IndicadoresModel::calcula_HSH_serviciosalud($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 8:
                return IndicadoresModel::calcula_TS_serviciosalud($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 9:
                return IndicadoresModel::calcula_TRANS_serviciosalud($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;
            case 10:
                return IndicadoresModel::calcula_respuesta_mensaje_virtual($PERIODO, $SUBRECEPTOR);
                break;
            case 11:
                return IndicadoresModel::calcula_salud_mensaje_virtual($PERIODO, $SUBRECEPTOR);
                break;
            case 12:
                return IndicadoresModel::calcula_salud_evento_masivo($PERIODO, $SUBRECEPTOR);
                break;
            case 13:
                return IndicadoresModel::calcula_PVVS_consejeros($PERIODO, $SUBRECEPTOR); //consolidadoMensualDerivadosModel::cantidad_tipo_alcance( 'HSH', 'NUEVO');
                break;

            default:
                break;
        }
    }

    public static function actualiza_aceptar_periodo_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "update subreceptores_informes_mensuales set ID_ACEPTADO = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , FECHA_ACEPTADO =  CURRENT_TIMESTAMP 	
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

    public static function actualiza_aceptar_reporte_subreceptor($idSubreceptor, $idPeriodo) {
        $query = "update subreceptores_metas_valores set ID_ACEPTACION = " . $_SESSION['SESION_USUARIO']->ID_PERSONA . " , FECHA_ACEPTACION =  CURRENT_TIMESTAMP 	
        where ID_SUBRECEPTOR = " . $idSubreceptor . " AND ID_PERIODO = " . $idPeriodo . "  ";
        return self::modificarRegistros($query);
    }

}
