<?php

class AbordajesAnimadoresModel extends ModelBase {

    public static function recurrencias_validas_por_pemar($ano_contacto, $idSubreceptor, $idPemar, $idPeriodo) {
      $registro = 0;
      $PRIEMR_ABORDAJE = self::primer_abordaje($idPemar, $idPeriodo) ;
      if( !empty($PRIEMR_ABORDAJE) ){
        $registro = $PRIEMR_ABORDAJE->REGISTRO_ABORDAJE;
      }


        
        $query = "SELECT
                    recibo_contacto_animador.*
                   FROM (recibo_contacto_animador
                        JOIN personas_sistema
                          ON ((recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA)))
                    WHERE ((recibo_contacto_animador.ID_PEMAR = " . $idPemar . " )
                           AND (recibo_contacto_animador.ACTIVO = 'SI')
                           AND (recibo_contacto_animador.ANO_CONTACTOANIMADOR = " . $ano_contacto . ")
                           AND (personas_sistema.ID_SUBRECEPTOR = " . $idSubreceptor . ")
                           AND (recibo_contacto_animador.ID_CONTACTOANIMADOR <> ".$registro." )
                           )
   ORDER BY recibo_contacto_animador.ANO_CONTACTOANIMADOR,recibo_contacto_animador.MES_CONTACTOANIMADOR,recibo_contacto_animador.DIA_CONTACTOANIMADOR,recibo_contacto_animador.HORA_CONTACTOANIMADOR
   LIMIT 0,12";
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function recurrencias_validas_por_pemar_dni($ano_contacto, $idSubreceptor, $idPemar, $idPeriodo) {
        
       $registro = 0;
      $PRIEMR_ABORDAJE = self::primer_abordaje($idPemar, $idPeriodo) ;
      if( !empty($PRIEMR_ABORDAJE) ){
        $registro = $PRIEMR_ABORDAJE->REGISTRO_ABORDAJE;
      }


        
        $query = "SELECT
                    recibo_contacto_animador.*
                   FROM (recibo_contacto_animador
                    JOIN personas_sistema
                      ON ((recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA)))
                    WHERE ((recibo_contacto_animador.ID_PEMAR = " . $idPemar . " )
                           AND (recibo_contacto_animador.ACTIVO = 'SI')
                           AND (recibo_contacto_animador.ANO_CONTACTOANIMADOR = " . $ano_contacto . ")
                           AND (personas_sistema.ID_SUBRECEPTOR = " . $idSubreceptor . ")
                           AND (recibo_contacto_animador.ID_CONTACTOANIMADOR <> ".$registro."
                           ))
   ORDER BY recibo_contacto_animador.ANO_CONTACTOANIMADOR,recibo_contacto_animador.MES_CONTACTOANIMADOR,recibo_contacto_animador.DIA_CONTACTOANIMADOR,recibo_contacto_animador.HORA_CONTACTOANIMADOR
   ";
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function primer_abordaje_viejo($idPemar, $idPeriodo) {
        $query = "SELECT
    primer_abordaje_promotor.*
FROM
    primer_abordaje_promotor
    INNER JOIN periodos
        ON (periodos.ANO_PERIODO = primer_abordaje_promotor.ANO_PERIODO)
WHERE (primer_abordaje_promotor.ID_POBLACION = " . $idPemar . " AND periodos.ID_PERIODO =  " . $idPeriodo . " ) ;
 ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    
    public static function primer_abordaje($idPemar, $idPeriodo) {
        $query = "
        SELECT 
              periodos.ANO_PERIODO AS ANO_PERIODO,
              tipo_poblacion.ID_TIPOPOBLACION AS ID_TIPOPOBLACION,
              tipo_poblacion.CODIGO_TIPOPOBLACION AS CODIGO_TIPOPOBLACION,
              pemar.ID_POBLACION AS ID_POBLACION,
              pemar.CODIGO_UNICO_PERSONA AS CODIGO_UNICO_PERSONA,
              periodos_indicadores.ID_PERIODO_INDICADOR AS ID_PERIODO_INDICADOR,
              periodos_indicadores.CODIGO_PERIODO_INDICADOR AS CODIGO_PERIODO_INDICADOR,
              periodos.ID_PERIODO AS ID_PERIODO,
              periodos.CODIGO_PERIODO AS CODIGO_PERIODO,
              'ANIMADOR' AS TIPO_AGENTE,
              personas_sistema.ID_SUBRECEPTOR AS ID_SUBRECEPTOR,
              personas_sistema.ID_PERSONA AS ID_PERSONA,
              recibo_contacto_animador.ID_CONTACTOANIMADOR AS REGISTRO_ABORDAJE,
              MIN(
                TIMESTAMP(
                  CONCAT(
                    recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                    '-',
                    recibo_contacto_animador.MES_CONTACTOANIMADOR,
                    '-',
                    recibo_contacto_animador.DIA_CONTACTOANIMADOR
                  ),
                  recibo_contacto_animador.HORA_ATENCION_CONTACTOANIMADOR
                )
              ) AS FECHA_PRIMER_ABORDAJE 
            FROM
              (
                (
                  (
                    (
                      (
                        pemar 
                        LEFT JOIN recibo_contacto_animador 
                          ON (
                            (
                              recibo_contacto_animador.ID_PEMAR = pemar.ID_POBLACION 
                            )
                          )
                      ) 
                      LEFT JOIN personas_sistema 
                        ON (
                          (
                            recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA
                          )
                        )
                    ) 
                    LEFT JOIN periodos 
                      ON (
                        (
                          TIMESTAMP(
                            CONCAT(
                              recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                              '-',
                              recibo_contacto_animador.MES_CONTACTOANIMADOR,
                              '-',
                              recibo_contacto_animador.DIA_CONTACTOANIMADOR
                            ),
                            recibo_contacto_animador.HORA_ATENCION_CONTACTOANIMADOR
                          ) BETWEEN periodos.FECHA_MIN_PERIODO 
                          AND periodos.FECHA_MAX_PERIODO
                        )
                      )
                  ) 
                  LEFT JOIN periodos_indicadores 
                    ON (
                      (
                        periodos.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR
                      )
                    )
                ) 
                LEFT JOIN tipo_poblacion 
                  ON (
                    (
                      pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION
                    )
                  )
              ) 
            WHERE ID_POBLACION = ".$idPemar." AND ANO_PERIODO = (SELECT ANO_PERIODO FROM periodos WHERE ID_PERIODO = ".$idPeriodo." )
                AND (recibo_contacto_animador.ACTIVO = 'SI')
                AND(
                TIMESTAMP(
                  CONCAT(
                    recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                    '-',
                    recibo_contacto_animador.MES_CONTACTOANIMADOR,
                    '-',
                    recibo_contacto_animador.DIA_CONTACTOANIMADOR
                  ),
                  recibo_contacto_animador.HORA_ATENCION_CONTACTOANIMADOR
                ) = 
                (SELECT 
                  MIN(
                    TIMESTAMP(
                      CONCAT(
                        recibo_contacto_animador.ANO_CONTACTOANIMADOR,
                        '-',
                        recibo_contacto_animador.MES_CONTACTOANIMADOR,
                        '-',
                        recibo_contacto_animador.DIA_CONTACTOANIMADOR
                      ),
                      recibo_contacto_animador.HORA_ATENCION_CONTACTOANIMADOR
                    )
                  ) 
                FROM
                  recibo_contacto_animador 
                WHERE (
                    (
                      recibo_contacto_animador.ID_PEMAR = pemar.ID_POBLACION
                    ) 
                    AND (
                      recibo_contacto_animador.ANO_CONTACTOANIMADOR = periodos.ANO_PERIODO
                    )
                  ))
              ) 
            GROUP BY periodos.ANO_PERIODO,
              tipo_poblacion.ID_TIPOPOBLACION,
              tipo_poblacion.CODIGO_TIPOPOBLACION,
              pemar.ID_POBLACION,
              pemar.CODIGO_UNICO_PERSONA,
              periodos_indicadores.ID_PERIODO_INDICADOR,
              periodos_indicadores.CODIGO_PERIODO_INDICADOR,
              periodos.ID_PERIODO,
              periodos.CODIGO_PERIODO,
              'ANIMADOR' 
            ORDER BY tipo_poblacion.ID_TIPOPOBLACION,
              pemar.CODIGO_UNICO_PERSONA ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public function esNuevo($registro, $periodo) {
        $primer_abordaje = self::primer_abordaje($registro->ID_PEMAR, $periodo);

        if (!empty($primer_abordaje)) {
            if ($registro->ID_CONTACTOANIMADOR == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
