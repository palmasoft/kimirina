<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class IndicadoresModel extends ModelBase {

    public static $sqlBase = "
        select indicadores.* from indicadores 
        ";

    public static function todos() {
        $query = self::$sqlBase . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_subreceptores() {
        $query = self::$sqlBase . " WHERE indicadores.TIPO_INDICADOR = 'SUBRECEPTORES' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_subreceptor( $ID_SUBRECEPTOR) {
        $query = " 
            SELECT
                indicadores.*
                , subreceptores_metas.*
                , periodos_indicadores.*
                , periodos.*
            FROM
                subreceptores_metas
                INNER JOIN indicadores 
                    ON (subreceptores_metas.ID_INDICADOR = indicadores.ID_INDICADOR)
                INNER JOIN periodos_indicadores 
                    ON (subreceptores_metas.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)
                INNER JOIN periodos 
                    ON (periodos.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)
            WHERE (subreceptores_metas.ID_SUBRECEPTOR = ".$ID_SUBRECEPTOR."
                AND subreceptores_metas.META_SUBRECEPTOR <> 0 )
            GROUP BY indicadores.ID_INDICADOR  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_subreceptor_periodo($ID_PERIODO, $ID_SUBRECEPTOR) {
        $query = " 
            SELECT
                indicadores.*
                , subreceptores_metas.*
                , periodos_indicadores.*
                , periodos.*
            FROM
                subreceptores_metas
                INNER JOIN indicadores 
                    ON (subreceptores_metas.ID_INDICADOR = indicadores.ID_INDICADOR)
                INNER JOIN periodos_indicadores 
                    ON (subreceptores_metas.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)
                INNER JOIN periodos 
                    ON (periodos.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)
            WHERE (subreceptores_metas.ID_SUBRECEPTOR = ".$ID_SUBRECEPTOR."
                AND subreceptores_metas.META_SUBRECEPTOR <> 0
                AND periodos.ID_PERIODO = ".$ID_PERIODO." );";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($ID_INDICADOR) {
        $query = self::$sqlBase . " where indicadores.ID_INDICADOR = " . $ID_INDICADOR . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function periodos_indicadores() {
        $query = " select * from periodos_indicadores  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function meta_periodo_indicador_proyecto($PERIODO, $INDICADOR) {
         $query = "SELECT indicadores_metas.VALOR_META_INDICADOR
            FROM indicadores_metas
            WHERE ID_PERIODO_INDICADOR = " . $PERIODO . " AND ID_INDICADOR = " . $INDICADOR . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function valor_periodo_indicador_proyecto($PERIODO, $INDICADOR) {
         $query = "SELECT marco_desempeno_subreceptores.*,  SUM( marco_desempeno_subreceptores.VALOR_INDICADOR_SUBRECEPTOR )AS VALOR_SEMESTRE 
            FROM marco_desempeno_subreceptores 
            WHERE ID_PERIODO_INDICADOR = " . $PERIODO . " AND ID_INDICADOR = " . $INDICADOR . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function valor_periodo_indicador_subreceptor($PERIODO, $INDICADOR, $SUBRECEPTOR) {
        $query = "SELECT marco_desempeno_subreceptores.*,  SUM( marco_desempeno_subreceptores.VALOR_INDICADOR_SUBRECEPTOR )AS VALOR_SEMESTRE 
            FROM marco_desempeno_subreceptores 
            WHERE ID_PERIODO_INDICADOR = " . $PERIODO . " AND ID_INDICADOR = " . $INDICADOR . " AND ID_SUBRECEPTOR = " . $SUBRECEPTOR . "
        ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function valor_periodo_indicador_todos_subreceptortes($PERIODO, $INDICADOR) {
        $query = "SELECT *,  SUM( marco_desempeno_subreceptores.VALOR_INDICADOR_SUBRECEPTOR )AS VALOR_SEMESTRE 
            FROM marco_desempeno_subreceptores 
            WHERE ID_PERIODO_INDICADOR = " . $PERIODO . " AND ID_INDICADOR = " . $INDICADOR;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function valor_periodo_indicador_todos_subreceptortes_por_periodo($PERIODO, $INDICADOR) {
        $query = "SELECT SUM( marco_desempeno_subreceptores.VALOR_INDICADOR_SUBRECEPTOR )AS VALOR_SEMESTRE 
            FROM marco_desempeno_subreceptores 
            WHERE ID_PERIODO = " . $PERIODO . " AND ID_INDICADOR = " . $INDICADOR;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->VALOR_SEMESTRE;
        }
        return 0;
    }

    
    
    
    
    public static function calcula_HSH_promotores($PERIODO, $SUBRECEPTOR) {
        $query = " SELECT 

	COUNT(ID_POBLACION) AS CANT
        
        FROM(
            (SELECT * FROM primer_abordaje_promotor)  
        ) AS FPP
        INNER JOIN registro_semanal_contacto 
            ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
        INNER JOIN registro_semanal
            ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";

        $filtro = " where ";
        $filtro .= " CODIGO_TIPOPOBLACION  = 'HSH' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_TS_promotores($PERIODO, $SUBRECEPTOR) {
        $query = " SELECT 

	COUNT(ID_POBLACION) AS CANT
        
        FROM(
            (SELECT * FROM primer_abordaje_promotor)  
        ) AS FPP
        INNER JOIN registro_semanal_contacto 
            ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
        INNER JOIN registro_semanal
            ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";

        $filtro = ' where ';
        $filtro .= " CODIGO_TIPOPOBLACION  = 'TS' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;


        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_TRANS_promotores($PERIODO, $SUBRECEPTOR) {
        $query = " SELECT 

	COUNT(ID_POBLACION) AS CANT
        
        FROM(
            (SELECT * FROM primer_abordaje_promotor)  
        ) AS FPP
        INNER JOIN registro_semanal_contacto 
            ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
        INNER JOIN registro_semanal
            ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";


        $filtro = ' where ';
        $filtro .= " CODIGO_TIPOPOBLACION  = 'TRANS' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;


        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_todos_promotores_insumos($PERIODO, $SUBRECEPTOR, $INSUMO) {
        $query = " SELECT 
                    SUM( registro_semanal_insumo_entregado.CANTIDAD ) AS CANT
                  FROM
                    registro_semanal_contacto 
                    INNER JOIN registro_semanal 
                      ON (
                        registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL
                      ) 
                    INNER JOIN registro_semanal_insumo_entregado 
                      ON (
                        registro_semanal_contacto.ID_REGISTRO_CONTACTO = registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO
                      )
                      INNER JOIN personas_sistema 
                      ON (
                        registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA
                      )
                      LEFT JOIN `periodos`
                         ON ((`registro_semanal_contacto`.`FECHA_CONTACTO` BETWEEN `periodos`.`FECHA_MIN_PERIODO`
                              AND `periodos`.`FECHA_MAX_PERIODO`)AND periodos.`ACTUAL`='SI')
                      LEFT JOIN `periodos_indicadores`
                        ON ((`periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`))";

        $filtro = " where ";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_INSUMO = " . $INSUMO . " and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_HSH_animadores($PERIODO, $SUBRECEPTOR) {

        $cantidad = 0;

        $query = "SELECT 
                        * 
                    FROM(
                        (SELECT * FROM primer_abordaje_animador)  
                       ) AS FPP
                     INNER JOIN recibo_contacto_animador
                        ON(recibo_contacto_animador.ID_CONTACTOANIMADOR = FPP.REGISTRO_ABORDAJE)";

        $filtro = ' where ';
        $filtro .= " CODIGO_TIPOPOBLACION = 'HSH' and";
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query.$filtro;
        $consulta = self::consulta($query . $filtro);
        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                $recurrencia = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                $registro->ANO_CONTACTOANIMADOR, $SUBRECEPTOR, $registro->ID_PEMAR
                );

                if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "HSH") {
                    if (AbordajesAnimadoresModel::esNuevo($registro, $PERIODO)) {
                        $cantidad++;
                    } else {
                        foreach ($recurrencia as $key => $value) {
                            if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                $cantidad++;
                            }
                        }
                    }
                }
            }

            return $cantidad;
        }
        return 0;
    }

    public static function calcula_TS_animadores($PERIODO, $SUBRECEPTOR) {
        $cantidad = 0;

        $query = "SELECT 
                        * 
                    FROM(
                        (SELECT * FROM primer_abordaje_animador)  
                       ) AS FPP
                     INNER JOIN recibo_contacto_animador
                        ON(recibo_contacto_animador.ID_CONTACTOANIMADOR = FPP.REGISTRO_ABORDAJE)";

        $filtro = ' where ';
        $filtro .= " CODIGO_TIPOPOBLACION = 'TS' and";
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query.$filtro;
        $consulta = self::consulta($query . $filtro);
        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                $recurrencia = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                $registro->ANO_CONTACTOANIMADOR, $SUBRECEPTOR, $registro->ID_PEMAR
                );

                if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TS") {
                    if (AbordajesAnimadoresModel::esNuevo($registro, $PERIODO)) {
                        $cantidad++;
                    } else {
                        foreach ($recurrencia as $key => $value) {
                            if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                $cantidad++;
                            }
                        }
                    }
                }
            }

            return $cantidad;
        }
        return 0;
    }

    public static function calcula_TRANS_animadores($PERIODO, $SUBRECEPTOR) {
        $cantidad = 0;

        $query = "SELECT 
                        * 
                    FROM(
                        (SELECT * FROM primer_abordaje_animador)  
                       ) AS FPP
                     INNER JOIN recibo_contacto_animador
                        ON(recibo_contacto_animador.ID_CONTACTOANIMADOR = FPP.REGISTRO_ABORDAJE)";

        $filtro = ' where ';
        $filtro .= " CODIGO_TIPOPOBLACION = 'TRANS' and";
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query.$filtro;
        $consulta = self::consulta($query . $filtro);
        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                $recurrencia = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                $registro->ANO_CONTACTOANIMADOR, $SUBRECEPTOR, $registro->ID_PEMAR
                );

                if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TRANS") {
                    if (AbordajesAnimadoresModel::esNuevo($registro, $PERIODO)) {
                        $cantidad++;
                    } else {
                        foreach ($recurrencia as $key => $value) {
                            if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                $cantidad++;
                            }
                        }
                    }
                }
            }

            return $cantidad;
        }
        return 0;
    }

    public static function calcula_todos_animadores_insumos($PERIODO, $SUBRECEPTOR, $INSUMO) {
        $query = " SELECT 
                    SUM(
                      recibo_contacto_insumo_entregado.CANTIDAD
                    ) AS CANT 
                  FROM
                    recibo_contacto_animador 
                    INNER JOIN recibo_contacto_insumo_entregado 
                      ON (
                        recibo_contacto_animador.ID_CONTACTOANIMADOR = recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR
                      ) 
                    INNER JOIN personas_sistema 
                      ON (
                        recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA
                      ) 
                    LEFT JOIN `periodos` 
                      ON (
                        (
                          CONCAT(
                            recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                            '-',
                            recibo_contacto_animador.MES_CONTACTOANIMADOR,
                            '-',
                            recibo_contacto_animador.DIA_CONTACTOANIMADOR
                          ) BETWEEN `periodos`.`FECHA_MIN_PERIODO` 
                          AND `periodos`.`FECHA_MAX_PERIODO`
                         AND periodos.`ACTUAL`='SI'
                      ) 
                    LEFT JOIN `periodos_indicadores` 
                      ON (
                        (
                          `periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`
                        )
                      )";

        $filtro = " where ";
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_INSUMO = " . $INSUMO . " and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_HSH_serviciosalud($PERIODO, $SUBRECEPTOR) {

        $cantidadEfectivos = 0;

        $query = " SELECT 
                    *
                    FROM(
                        (SELECT * FROM primer_abordaje_promotor)  
                    ) AS FPP
                    INNER JOIN registro_semanal_contacto 
                        ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
                    INNER JOIN registro_semanal
                        ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";

        $filtro = " where ";
        $filtro .= " CODIGO_TIPOPOBLACION  = 'HSH' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query.$filtro;
        $consulta = self::consulta($query . $filtro);

        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {
                    if (AbordajesPromotoresModel::esDerivadoEfectivo($registro, $registro->ANO_PERIODO)) {
                        $cantidadEfectivos++;
                    }
                }
            }
            return $cantidadEfectivos;
        }
        return 0;
    }

    public static function calcula_TS_serviciosalud($PERIODO, $SUBRECEPTOR) {
        $cantidadEfectivos = 0;

        $query = " SELECT 
                    *
                    FROM(
                        (SELECT * FROM primer_abordaje_promotor)  
                    ) AS FPP
                    INNER JOIN registro_semanal_contacto 
                        ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
                    INNER JOIN registro_semanal
                        ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";

        $filtro = " where ";
        $filtro .= " CODIGO_TIPOPOBLACION  = 'TS' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;


        $consulta = self::consulta($query . $filtro);

        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                    if (AbordajesPromotoresModel::esDerivadoEfectivo($registro, $registro->ANO_PERIODO)) {
                        $cantidadEfectivos++;
                    }
                }
            }
            return $cantidadEfectivos;
        }
        return 0;
    }

    public static function calcula_TRANS_serviciosalud($PERIODO, $SUBRECEPTOR) {
        $cantidadEfectivos = 0;

        $query = " SELECT 
                    *
                    FROM(
                        (SELECT * FROM primer_abordaje_promotor)  
                    ) AS FPP
                    INNER JOIN registro_semanal_contacto 
                        ON (registro_semanal_contacto.ID_REGISTRO_CONTACTO = FPP.REGISTRO_ABORDAJE) 
                    INNER JOIN registro_semanal
                        ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)";

        $filtro = " where ";
        $filtro .= " CODIGO_TIPOPOBLACION  = 'TRANS' and";
        $filtro .= " registro_semanal.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);

        if (!empty($consulta)) {
            foreach ($consulta as $registro) {
                if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
//                    print_r($registro);
                    if (AbordajesPromotoresModel::esDerivadoEfectivo($registro, $registro->ANO_PERIODO)) {
                        $cantidadEfectivos++;
                    }
                }
            }
            return $cantidadEfectivos;
        }
        return 0;
    }

    public static function calcula_PVVS_consejeros($PERIODO, $SUBRECEPTOR) {
        $query = "  SELECT 
                        COUNT(ID_POBLACION) AS CANT
                        FROM(
                            (SELECT * FROM primer_abordaje_consejero)  
                           ) AS FPP
                         INNER JOIN consejeria_pvvs
                            ON(consejeria_pvvs.ID_CONSEJERIA_PVVS = FPP.REGISTRO_ABORDAJE) ";

        $filtro = " where ";
        $filtro .= " consejeria_pvvs.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_PVVS_consejeros_insumos($PERIODO, $SUBRECEPTOR, $INSUMO) {
        $query = "  SELECT 
                        SUM(
                          consejeria_pvvs_insumos.CANTIDAD
                        ) AS CANT 
                      FROM
                        consejeria_pvvs 
                        INNER JOIN consejeria_pvvs_insumos 
                          ON (
                            consejeria_pvvs.ID_CONSEJERIA_PVVS = consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS
                          )
                          INNER JOIN personas_sistema 
                          ON (
                            consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA
                          ) 
                        LEFT JOIN `periodos` 
                          ON (
                            (
                              consejeria_pvvs.`FECHA_CONSEJERIA` BETWEEN `periodos`.`FECHA_MIN_PERIODO` 
                              AND `periodos`.`FECHA_MAX_PERIODO`
                            ) AND periodos.`ACTUAL`='SI'
                          ) 
                        LEFT JOIN `periodos_indicadores` 
                          ON (
                            (
                              `periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`
                            )
                          )";

        $filtro = " where ";
        $filtro .= " consejeria_pvvs.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_INSUMO = " . $INSUMO . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_respuesta_mensaje_virtual($PERIODO, $SUBRECEPTOR) {
        $query = " SELECT
                COUNT(consejeria_pvvs.ID_PEMAR) AS CANT
            FROM
                consejeria_pvvs
                INNER JOIN pemar 
                    ON (consejeria_pvvs.ID_PEMAR = pemar.ID_POBLACION)
                INNER JOIN personas_sistema 
                    ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
                INNER JOIN periodos
                    ON (  consejeria_pvvs.FECHA_CONSEJERIA
		BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO ) ";

        $filtro = ' where ';
        $filtro .= " consejeria_pvvs.ESTADO_REVISION = 'APROBADO' and ";
        $filtro .= " personas_sistema.ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " periodos.ID_PERIODO = " . $PERIODO;


        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

    public static function calcula_salud_mensaje_virtual($PERIODO, $SUBRECEPTOR) {

        return 0;
    }

    public static function calcula_salud_evento_masivo($PERIODO, $SUBRECEPTOR) {

        return 0;
    }

    public static function efectivos_eventos_masivos($PERIODO, $INDICADOR) {
        $query = ""
                . "SELECT 
                    SUM(
                      eventos_masivos.NUM_EFECTIVOS_EVENTO_MASIVO
                    ) AS VALOR_SEMESTRE,
                    (SELECT 
                        indicadores_metas.VALOR_META_INDICADOR
                      FROM
                        indicadores_metas 
                      WHERE indicadores_metas.ID_INDICADOR = " . $INDICADOR . " 
                        AND indicadores_metas.ID_PERIODO_INDICADOR = " . $PERIODO . ") AS META_SEMESTRE 
                  FROM
                    eventos_masivos 
                    INNER JOIN periodos 
                      ON (
                        eventos_masivos.FECHA_EVENTO_MASIVO BETWEEN periodos.FECHA_MIN_PERIODO 
                        AND periodos.FECHA_MAX_PERIODO 
                        AND periodos.ID_PERIODO_INDICADOR = " . $PERIODO . "
                      )"
                . "";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function numero_codigos_navegacion_web($PERIODO, $INDICADOR) {
        $query = ""
                . "SELECT
                    count( distinct
                      navegacion_web.CODIGO_PEMAR
                    ) AS VALOR_SEMESTRE,
                    (SELECT 
                      indicadores_metas.VALOR_META_INDICADOR
                    FROM
                      indicadores_metas 
                    WHERE indicadores_metas.ID_INDICADOR = " . $INDICADOR . "
                      AND indicadores_metas.ID_PERIODO_INDICADOR = " . $PERIODO . ") AS META_SEMESTRE 
                  FROM
                    navegacion_web 
                    INNER JOIN periodos 
                      ON (
                        navegacion_web.FECHA_SYSTEMA BETWEEN periodos.FECHA_MIN_PERIODO 
                        AND periodos.FECHA_MAX_PERIODO 
                        AND periodos.ID_PERIODO_INDICADOR = " . $PERIODO . "
                      )

                   WHERE navegacion_web.CODIGO_PEMAR IS NOT NULL AND navegacion_web.CODIGO_PEMAR <> '' "
                . "";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function numero_sesionesID_navegacion_web($PERIODO, $INDICADOR) {
        $query = ""
                . "SELECT
                    count( distinct
                      navegacion_web.SESSION_ID
                    ) AS VALOR_SEMESTRE,
                    (SELECT 
                      indicadores_metas.VALOR_META_INDICADOR
                    FROM
                      indicadores_metas 
                    WHERE indicadores_metas.ID_INDICADOR = " . $INDICADOR . "
                      AND indicadores_metas.ID_PERIODO_INDICADOR = " . $PERIODO . ") AS META_SEMESTRE 
                  FROM
                    navegacion_web 
                    INNER JOIN periodos 
                      ON (
                        navegacion_web.FECHA_SYSTEMA BETWEEN periodos.FECHA_MIN_PERIODO 
                        AND periodos.FECHA_MAX_PERIODO 
                        AND periodos.ID_PERIODO_INDICADOR = " . $PERIODO . "
                      )

                   WHERE navegacion_web.SESSION_ID IS NOT NULL AND navegacion_web.SESSION_ID <> '' "
                . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function numero_efectivos_navegacion_web($PERIODO, $INDICADOR) {
        $query = ""
                . "SELECT 
                    COUNT(atencion_salud.ID_PEMAR) AS VALOR_SEMESTRE,
                    (SELECT 
                      indicadores_metas.VALOR_META_INDICADOR 
                    FROM
                      indicadores_metas 
                    WHERE indicadores_metas.ID_INDICADOR = " . $INDICADOR . "
                      AND indicadores_metas.ID_PERIODO_INDICADOR = " . $PERIODO . ") AS META_SEMESTRE 
                  FROM
                    atencion_salud 
                    INNER JOIN 
                      (SELECT DISTINCT 
                        navegacion_web.ID_PEMAR 
                      FROM
                        navegacion_web 
                        INNER JOIN periodos 
                          ON (
                            navegacion_web.FECHA_SYSTEMA BETWEEN periodos.FECHA_MIN_PERIODO 
                            AND periodos.FECHA_MAX_PERIODO 
                            AND periodos.ID_PERIODO_INDICADOR = " . $PERIODO . "
                          ) 
                      WHERE navegacion_web.ID_PEMAR IS NOT NULL 
                        AND navegacion_web.ID_PEMAR <> '') navegacion 
                      ON navegacion.ID_PEMAR = atencion_salud.ID_PEMAR "
                . "";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
    
    public static function calcula_todos_actividades_promocion_insumos($PERIODO, $SUBRECEPTOR, $INSUMO) {
        $query = "SELECT 
                    SUM(
                      actividades_promocion_insumos.CANTIDAD_INSUMO
                    ) AS CANT 
                  FROM
                    actividades_promocion 
                    INNER JOIN actividades_promocion_insumos 
                      ON (
                        actividades_promocion.ID_ACTIVIDAD_PROMOCION = actividades_promocion_insumos.ID_ACTIVIDAD_PROMOCION
                      ) 
                    INNER JOIN personas_sistema 
                      ON (
                        actividades_promocion.ID_RESPONSABLE_ACTIVIDAD_PROMOCION = personas_sistema.ID_PERSONA
                      ) 
                    LEFT JOIN `periodos` 
                      ON (
                        (
                          `actividades_promocion`.`FECHA_ACTIVIDAD_PROMOCION` BETWEEN `periodos`.`FECHA_MIN_PERIODO` 
                          AND `periodos`.`FECHA_MAX_PERIODO`
                        ) 
                        AND periodos.`ACTUAL` = 'SI'
                      ) 
                    LEFT JOIN `periodos_indicadores` 
                      ON (
                        (
                          `periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`
                        )
                      )";

        $filtro = " where ";
        $filtro .= " ID_INSUMO = " . $INSUMO . " and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }
    
    public static function calcula_todos_eventos_masivos_insumos($PERIODO, $SUBRECEPTOR, $INSUMO) {
        $query = "SELECT 
                    SUM(
                      eventos_masivos_insumos.CANTIDAD_INSUMO
                    ) AS CANT 
                  FROM
                    eventos_masivos 
                    INNER JOIN eventos_masivos_insumos 
                      ON (
                        eventos_masivos.ID_EVENTO_MASIVO = eventos_masivos_insumos.ID_EVENTO_MASIVO
                      ) 
                    INNER JOIN personas_sistema 
                      ON (
                        eventos_masivos.ID_RESPONSABLE_EVENTO_MASIVO = personas_sistema.ID_PERSONA
                      ) 
                    LEFT JOIN `periodos` 
                      ON (
                        (
                          `eventos_masivos`.`FECHA_EVENTO_MASIVO` BETWEEN `periodos`.`FECHA_MIN_PERIODO` 
                          AND `periodos`.`FECHA_MAX_PERIODO`
                        ) 
                        AND periodos.`ACTUAL` = 'SI'
                      ) 
                    LEFT JOIN `periodos_indicadores` 
                      ON (
                        (
                          `periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`
                        )
                      )";

        $filtro = " where ";
        $filtro .= " ID_INSUMO = " . $INSUMO . " and ";
        $filtro .= " ID_SUBRECEPTOR = " . $SUBRECEPTOR . " and ";
        $filtro .= " ID_PERIODO = " . $PERIODO;

//        echo $query . $filtro;
        $consulta = self::consulta($query . $filtro);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }
    
    
    
    

    public static function insertar_indicadores_reportados_proyecto(
    $ID_INDICADOR, $ID_PERIODO, $META_INDICADOR_REPORTADO, $ACUM_INDICADOR_REPORTADO, $VALOR_INDICADOR_REPORTADO, $PORC_INDICADOR_REPORTADO
    ) {

        $query = "INSERT INTO indicadores_reportados_proyecto
            (ID_INDICADOR, ID_PERIODO, META_INDICADOR_REPORTADO, ACUM_INDICADOR_REPORTADO,
             VALOR_INDICADOR_REPORTADO, PORC_INDICADOR_REPORTADO)
                VALUES ('$ID_INDICADOR',
                        '$ID_PERIODO',
                        '$META_INDICADOR_REPORTADO',
                        '$ACUM_INDICADOR_REPORTADO',
                        '$VALOR_INDICADOR_REPORTADO',
                        '$PORC_INDICADOR_REPORTADO'); ";
        return self::crear_ultimo_id($query);
    }

    public static function actualiza_indicadores_reportados_proyecto(
    $ID_INDICADOR_REPORTADO, $META_INDICADOR_REPORTADO, $ACUM_INDICADOR_REPORTADO, $VALOR_INDICADOR_REPORTADO, $PORC_INDICADOR_REPORTADO
    ) {

        $query = " 
        UPDATE indicadores_reportados_proyecto
        SET 
          META_INDICADOR_REPORTADO = '" . $META_INDICADOR_REPORTADO . "',
          ACUM_INDICADOR_REPORTADO = '" . $ACUM_INDICADOR_REPORTADO . "',
          VALOR_INDICADOR_REPORTADO = '" . $VALOR_INDICADOR_REPORTADO . "',
          PORC_INDICADOR_REPORTADO = '" . $PORC_INDICADOR_REPORTADO . "',
          FECHA_MODIFICACION = CURRENT_TIMESTAMP
        WHERE ID_INDICADOR_REPORTADO = '" . $ID_INDICADOR_REPORTADO . "';";

        return self::modificarRegistros($query);
    }

    public static function datos_indicadores_reportados_proyecto_por_periodo_indicador($ID_PERIODO, $INDICADOR) {
        $query = " SELECT
                        ID_INDICADOR_REPORTADO
                    FROM
                        indicadores_reportados_proyecto
                    WHERE
                        ID_INDICADOR = " . $INDICADOR . " AND ID_PERIODO = " . $ID_PERIODO;

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_INDICADOR_REPORTADO;
        }
        return false;
    }

    public static function calcular_acumulado_indicador($PERIODO, $INDICADOR) {

        $Periodos = PeriodosModel::todos_menores_periodo($PERIODO);
        $acumulador = 0;
        if ($Periodos != 0) {
            foreach ($Periodos as $periodo) {
                $acumulador += self::calcular_valor_indicador($periodo->ID_PERIODO, $INDICADOR);
            }
        }
        return $acumulador;
    }

    public static function calcular_valor_indicador($PERIODO, $INDICADOR) {
        $query = " SELECT 
                        VALOR_INDICADOR_REPORTADO AS CANT
                   FROM 
                        indicadores_reportados_proyecto
                   WHERE
                        ID_INDICADOR = " . $INDICADOR . " and ID_PERIODO = " . $PERIODO;

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;
    }

}
