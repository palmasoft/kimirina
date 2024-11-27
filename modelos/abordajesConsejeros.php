<?php

class AbordajesConsejerosModel extends ModelBase {

    public static function primera_recurrencia_por_periodo_pemar_subreceptor( $fecha, $idSubreceptor, $idPemar) {

      $registro = 0;
      $PRIEMR_ABORDAJE = self::primer_abordaje($idPemar, $idPeriodo) ;
      if( !empty($PRIEMR_ABORDAJE) ){
        $registro = $PRIEMR_ABORDAJE->REGISTRO_ABORDAJE;
      }

       $query = "SELECT
            consejeria_pvvs.*
           FROM consejeria_pvvs
              JOIN personas_sistema
                ON ((consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)))
           WHERE ((consejeria_pvvs.ID_PEMAR = " . $idPemar . ")                  
                  AND (consejeria_pvvs.ACTIVO = 'SI')
                  AND (YEAR(consejeria_pvvs.FECHA_CONSEJERIA) = YEAR('" . $fecha . "'))
                  AND (MONTH(consejeria_pvvs.FECHA_CONSEJERIA) = MONTH('" . $fecha. "') )
                  AND (personas_sistema.ID_SUBRECEPTOR = " . $idSubreceptor . ")
                  AND (consejeria_pvvs.ID_REGISTRO_PVVS <> " . $registro . " )
                  )
           ORDER BY consejeria_pvvs.FECHA_CONSEJERIA
           LIMIT 0,1";
       $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function primer_abordaje($idPemar, $idPeriodo) {
        $query = "
        SELECT 
    `periodos`.`ANO_PERIODO` AS `ANO_PERIODO`,
    `tipo_poblacion`.`ID_TIPOPOBLACION` AS `ID_TIPOPOBLACION`,
    `tipo_poblacion`.`CODIGO_TIPOPOBLACION` AS `CODIGO_TIPOPOBLACION`,
    `pemar`.`ID_POBLACION` AS `ID_POBLACION`,
    `pemar`.`CODIGO_UNICO_PERSONA` AS `CODIGO_UNICO_PERSONA`,
    `periodos_indicadores`.`ID_PERIODO_INDICADOR` AS `ID_PERIODO_INDICADOR`,
    `periodos_indicadores`.`CODIGO_PERIODO_INDICADOR` AS `CODIGO_PERIODO_INDICADOR`,
    `periodos`.`ID_PERIODO` AS `ID_PERIODO`,
    `periodos`.`CODIGO_PERIODO` AS `CODIGO_PERIODO`,
    'CONSEJERO' AS `TIPO_AGENTE`,
    `personas_sistema`.`ID_SUBRECEPTOR` AS `ID_SUBRECEPTOR`,
    `personas_sistema`.`ID_PERSONA` AS `ID_PERSONA`,
    `consejeria_pvvs`.`ID_CONSEJERIA_PVVS` AS `REGISTRO_ABORDAJE`,
    MIN(
      TIMESTAMP(
        `consejeria_pvvs`.`FECHA_CONSEJERIA`,
        `consejeria_pvvs`.`HORA_INICIO`
      )
    ) AS `FECHA_PRIMER_ABORDAJE` 
  FROM
    (
      (
        (
          (
            (
              `pemar` 
              LEFT JOIN `consejeria_pvvs` 
                ON (
                  (
                    `consejeria_pvvs`.`ID_PEMAR` = `pemar`.`ID_POBLACION` AND consejeria_pvvs.ACTIVO = 'SI'
                  )
                )
            ) 
            LEFT JOIN `personas_sistema` 
              ON (
                (
                  `consejeria_pvvs`.`ID_CONSEJERO` = `personas_sistema`.`ID_PERSONA`
                )
              )
          ) 
          LEFT JOIN `periodos` 
            ON (
              (
                TIMESTAMP(
                  `consejeria_pvvs`.`FECHA_CONSEJERIA`,
                  `consejeria_pvvs`.`HORA_INICIO`
                ) BETWEEN `periodos`.`FECHA_MIN_PERIODO` 
                AND `periodos`.`FECHA_MAX_PERIODO`
              )
            )
        ) 
        LEFT JOIN `periodos_indicadores` 
          ON (
            (
              `periodos`.`ID_PERIODO_INDICADOR` = `periodos_indicadores`.`ID_PERIODO_INDICADOR`
            )
          )
      ) 
      LEFT JOIN `tipo_poblacion` 
        ON (
          (
            `pemar`.`ID_TIPOPOBLACION` = `tipo_poblacion`.`ID_TIPOPOBLACION`
          )
        )
    ) 
  WHERE 
    (`pemar`.`ID_POBLACION` = " . $idPemar . " AND periodos.`ID_PERIODO` =  " . $idPeriodo . " ) 
    AND ( consejeria_pvvs.ACTIVO = 'SI' )
    AND
      (
      TIMESTAMP(
        `consejeria_pvvs`.`FECHA_CONSEJERIA`,
        `consejeria_pvvs`.`HORA_INICIO`
      ) = 
      (SELECT 
        MIN(
          TIMESTAMP(
            `consejeria_pvvs`.`FECHA_CONSEJERIA`,
            `consejeria_pvvs`.`HORA_INICIO`
          )
        ) 
      FROM
        `consejeria_pvvs` 
      WHERE (
          (
            `consejeria_pvvs`.`ID_PEMAR` = `pemar`.`ID_POBLACION` 
          ) 
          AND ( consejeria_pvvs.ACTIVO = 'SI' )
          AND (
            YEAR(
              `consejeria_pvvs`.`FECHA_CONSEJERIA`
            ) = `periodos`.`ANO_PERIODO`
          )
        ))
    ) 
  GROUP BY `periodos`.`ANO_PERIODO`,
    `tipo_poblacion`.`ID_TIPOPOBLACION`,
    `tipo_poblacion`.`CODIGO_TIPOPOBLACION`,
    `pemar`.`ID_POBLACION`,
    `pemar`.`CODIGO_UNICO_PERSONA`,
    `periodos_indicadores`.`ID_PERIODO_INDICADOR`,
    `periodos_indicadores`.`CODIGO_PERIODO_INDICADOR`,
    `periodos`.`ID_PERIODO`,
    `periodos`.`CODIGO_PERIODO`,
    'CONSEJERO PVVS' 
  ORDER BY `tipo_poblacion`.`ID_TIPOPOBLACION`,
    `pemar`.`CODIGO_UNICO_PERSONA` ; ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

}