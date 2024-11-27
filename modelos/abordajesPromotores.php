<?php

class AbordajesPromotoresModel extends ModelBase {




    public static function primera_recurrencia_por_periodo_pemar_subreceptor( $fecha, $idSubreceptor, $idPemar,  $idPeriodo) {
      $registro = 0;
      $PRIEMR_ABORDAJE = self::primer_abordaje($idPemar, $idPeriodo) ;
      if( !empty($PRIEMR_ABORDAJE) ){
        $registro = $PRIEMR_ABORDAJE->REGISTRO_ABORDAJE;
      }

      $query = "SELECT
                    registro_semanal_contacto.*
                   FROM ((registro_semanal_contacto
                       JOIN registro_semanal
                         ON ((registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)))
                      JOIN personas_sistema
                        ON ((registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)))
                   WHERE ((registro_semanal_contacto.ID_PEMAR = " . $idPemar . ")                  
                          AND (registro_semanal.ACTIVO = 'SI')
                          AND (YEAR(registro_semanal_contacto.FECHA_CONTACTO) = YEAR('" . $fecha . "'))
                          AND (MONTH(registro_semanal_contacto.FECHA_CONTACTO) = MONTH('" . $fecha. "'))
                          AND (personas_sistema.ID_SUBRECEPTOR = " . $idSubreceptor . ")
                          AND (registro_semanal_contacto.ID_REGISTRO_CONTACTO <> ".$registro.")
                          )
                   ORDER BY registro_semanal_contacto.FECHA_CONTACTO, registro_semanal_contacto.HORA_CONTACTO
                   LIMIT 0,1";


        $consulta = self::consulta($query);

        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;

    }



    public static function recurrencias_por_periodo_pemar_dni( $fecha, $idSubreceptor, $idPemar, $idPeriodo) {
      
        $registro = 0;
      $PRIEMR_ABORDAJE = self::primer_abordaje($idPemar, $idPeriodo) ;
      if( !empty($PRIEMR_ABORDAJE) ){
        $registro = $PRIEMR_ABORDAJE->REGISTRO_ABORDAJE;
      }


       $query = "SELECT
                    registro_semanal_contacto.*
                   FROM ((registro_semanal_contacto
                       JOIN registro_semanal
                         ON ((registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)))
                      JOIN personas_sistema
                        ON ((registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)))
                   WHERE ((registro_semanal_contacto.ID_PEMAR = " . $idPemar . ")                  
                          AND (registro_semanal.ACTIVO = 'SI')
                          AND (YEAR(registro_semanal_contacto.FECHA_CONTACTO) = YEAR('" . $fecha . "'))
                          AND (MONTH(registro_semanal_contacto.FECHA_CONTACTO) = MONTH('" . $fecha. "') )
                          AND (personas_sistema.ID_SUBRECEPTOR = " . $idSubreceptor . ")
                          AND (registro_semanal_contacto.ID_REGISTRO_CONTACTO <>  ".$registro."
                          ))
                   ORDER BY registro_semanal_contacto.FECHA_CONTACTO, registro_semanal_contacto.HORA_CONTACTO
                   ";
       
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }





    public static function primer_abordaje($idPemar, $idPeriodo) {
        $query = "SELECT
  periodos.ANO_PERIODO                           AS ANO_PERIODO,
  tipo_poblacion.ID_TIPOPOBLACION                AS ID_TIPOPOBLACION,
  tipo_poblacion.CODIGO_TIPOPOBLACION            AS CODIGO_TIPOPOBLACION,
  pemar.ID_POBLACION                             AS ID_POBLACION,
  pemar.CODIGO_UNICO_PERSONA                     AS CODIGO_UNICO_PERSONA,
  periodos_indicadores.ID_PERIODO_INDICADOR      AS ID_PERIODO_INDICADOR,
  periodos_indicadores.CODIGO_PERIODO_INDICADOR  AS CODIGO_PERIODO_INDICADOR,
  periodos.ID_PERIODO                            AS ID_PERIODO,
  periodos.CODIGO_PERIODO                        AS CODIGO_PERIODO,
  'PROMOTOR'                                         AS TIPO_AGENTE,
  personas_sistema.ID_SUBRECEPTOR                AS ID_SUBRECEPTOR,
  personas_sistema.ID_PERSONA                    AS ID_PERSONA,
  registro_semanal_contacto.ID_REGISTRO_CONTACTO AS REGISTRO_ABORDAJE,
  MIN(TIMESTAMP(registro_semanal_contacto.FECHA_CONTACTO,registro_semanal_contacto.HORA_CONTACTO)) AS FECHA_PRIMER_ABORDAJE
FROM ((((((pemar
        LEFT JOIN registro_semanal_contacto
          ON ((registro_semanal_contacto.ID_PEMAR = pemar.ID_POBLACION)))
       LEFT JOIN registro_semanal
         ON ((registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL AND registro_semanal.ACTIVO = 'SI' )))
      LEFT JOIN personas_sistema
        ON ((registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)))
     LEFT JOIN periodos
       ON ((registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO
            AND periodos.FECHA_MAX_PERIODO)))
    LEFT JOIN periodos_indicadores
      ON ((periodos.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR)))
   LEFT JOIN tipo_poblacion
     ON ((pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)))
WHERE 
 (pemar.ID_POBLACION = " . $idPemar . " AND periodos.ID_PERIODO =  " . $idPeriodo . " ) 
 AND (registro_semanal.ACTIVO = 'SI') 
 AND (TIMESTAMP(registro_semanal_contacto.FECHA_CONTACTO,registro_semanal_contacto.HORA_CONTACTO) = (SELECT
                                                                                                                MIN(TIMESTAMP(registro_semanal_contacto.FECHA_CONTACTO,registro_semanal_contacto.HORA_CONTACTO))
                                                                                                              FROM registro_semanal_contacto
                                                                                                              WHERE ((registro_semanal_contacto.ID_PEMAR = pemar.ID_POBLACION)
                                                                                                                     AND (YEAR(registro_semanal_contacto.FECHA_CONTACTO) = periodos.ANO_PERIODO))))
GROUP BY periodos.ANO_PERIODO,tipo_poblacion.ID_TIPOPOBLACION,tipo_poblacion.CODIGO_TIPOPOBLACION,pemar.ID_POBLACION,pemar.CODIGO_UNICO_PERSONA,periodos_indicadores.ID_PERIODO_INDICADOR,periodos_indicadores.CODIGO_PERIODO_INDICADOR,periodos.ID_PERIODO,periodos.CODIGO_PERIODO,'PROMOTOR'
ORDER BY tipo_poblacion.ID_TIPOPOBLACION,pemar.ID_POBLACION,periodos.ANO_PERIODO
                
                 ";

             

        $consulta = self::consulta($query);
       
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    
    
    public function esDerivadoEfectivo($registro, $ano_periodo) {
        $fechaAtencion = consolidadoMensualDerivadosModel::fecha_min_atencion($registro->ID_PEMAR, $ano_periodo);
        if (!empty($fechaAtencion)) {
//            if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
            if ($registro->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}