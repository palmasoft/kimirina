<?php

class informeMensualConsejeriaParesModel extends ModelBase {
    
    public static $sqlCantidad="
    SELECT
    SUM(consejeria_pvvs_insumos.CANTIDAD) AS cantidad
    
    FROM
    consejeria_pvvs
    INNER JOIN consejeria_pvvs_insumos 
       ON (consejeria_pvvs.ID_CONSEJERIA_PVVS = consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS)
    INNER JOIN personas_sistema 
        ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
    INNER JOIN insumos 
     ON (consejeria_pvvs_insumos.ID_INSUMO = insumos.ID_INSUMO)
    INNER JOIN cantones 
        ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
    INNER JOIN periodos
        ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )";
    
    public static $sqlpersalcanzadas = "
        SELECT
            COUNT(consejeria_pvvs.ID_CONSEJERIA_PVVS) AS cantidad
        FROM
            consejeria_pvvs
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO ) ";

    public static $sqlConsejerias ="
            SELECT
             personas_sistema.*
            , consejeria_pvvs.*
            FROM
            consejeria_pvvs
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
    ";
    public static $sqlConsejerosFiltrados ="
            SELECT
            consejeria_pvvs.ID_CONSEJERO
            , personas_sistema.ID_PERSONA
            , personas_sistema.NOMBRE_REAL_PERSONA
            FROM
            consejeria_pvvs
            INNER JOIN consejeria_pvvs_insumos 
               ON (consejeria_pvvs.ID_CONSEJERIA_PVVS = consejeria_pvvs_insumos.ID_CONSEJERIA_PVVS)
            INNER JOIN personas_sistema 
                ON (consejeria_pvvs.ID_CONSEJERO = personas_sistema.ID_PERSONA)
            INNER JOIN insumos 
             ON (consejeria_pvvs_insumos.ID_INSUMO = insumos.ID_INSUMO)
            INNER JOIN cantones 
                ON (consejeria_pvvs.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN periodos
                ON (  consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )
    ";
     public static $sqlBaseConsejeros = "
	SELECT DISTINCT
	     personas_sistema.*
	FROM
	    personas_sistema
	    LEFT JOIN tipo_poblacion 
	        ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
	    LEFT JOIN usuarios
		ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
	    LEFT JOIN tipo_usuario 
	        ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
	    LEFT JOIN cantones
	        ON (cantones.ID_CANTON = personas_sistema.CANTON_PERSONA) 
	";
     public static $sqlBaseConsejerosInformes = "
	SELECT DISTINCT
	     personas_sistema.*
	FROM
	    personas_sistema
	    LEFT JOIN tipo_poblacion 
	        ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
	    LEFT JOIN usuarios
		ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
	    LEFT JOIN tipo_usuario 
	        ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO)
            LEFT JOIN consejeria_pvvs 
                    ON (personas_sistema.ID_PERSONA = consejeria_pvvs.ID_CONSEJERO)
            LEFT JOIN cantones
                    ON (cantones.ID_CANTON = consejeria_pvvs.ID_CANTON) 
            LEFT JOIN periodos
                    ON ( consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                    periodos.ACTUAL = 'SI') )";
     
    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND consejeria_pvvs.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroPeriodo = " INNER JOIN periodos
                                                ON ( consejeria_pvvs.FECHA_CONSEJERIA BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
     
    public static function todos() {
        $query = self::$sqlBase."  ".self::$sqlGroup;
        $consulta = self::consulta( $query );
        if( count($consulta) > 0 ) return $consulta;
        return 0;    
    }   
    
    public static function cantidad_condones( $idConsejero, $periodo = "", $provincia = "", $canton = ""){
        
        return self::cantidad_tipo_insumo($idConsejero, '1', $periodo, $provincia, $canton);
        
    }
    public static function cantidad_lubricantes( $idConsejero, $periodo = "", $provincia = "", $canton = ""){
        
        return self::cantidad_tipo_insumo($idConsejero, '2', $periodo, $provincia, $canton);
        
    }
    public static function cantidad_pastilleros( $idConsejero, $periodo = "", $provincia = "", $canton = ""){
        
        return self::cantidad_tipo_insumo($idConsejero, '6', $periodo, $provincia, $canton);
        
    }
 
   
    
    public static function cantidad_tipo_insumo( $idConsejero, $idInsumo, $periodo = "", $provincia = "", $canton = "", $monitor =""){
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " consejeria_pvvs.ID_CANTON = ".$canton." and";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." and";
        }
        
        $filtro .= " consejeria_pvvs.ID_CONSEJERO = ".$idConsejero." and";
        
        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";
        
        $filtro .= " insumos.ID_INSUMO = '".$idInsumo."' and";
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
    	$query = self::$sqlCantidad.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0;   
    }
    
    public static function consejeros( $idConsejero= "", $monitor ="",  $provincia = "", $canton = ""){
        
//        $filtro = "INNER JOIN consejeria_pvvs 
//                    ON (
//                      personas_sistema.ID_PERSONA = consejeria_pvvs.ID_CONSEJERO
//                    ) ".self::$filtroPeriodo."  WHERE ";
        $filtro = " WHERE ";
        $flag = false;
        if( $canton != "" ){
            $filtro .= " consejeria_pvvs.ID_CANTON = ".$canton." and";
            $flag = true;
        }else if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
            $flag = true;
        }       
        
        if( $idConsejero != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$idConsejero." AND";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        
        
        $filtro .= " (tipo_usuario.CODIGO_ROL = 'CONSE' OR tipo_usuario.CODIGO_ROL = 'CONANI') ";
        
        if($flag){
            $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas.self::$filtroEstadoRevision;
            $query = self::$sqlBaseConsejerosInformes.$filtro;
        }else{
            $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas;
            $query = self::$sqlBaseConsejeros.$filtro;
        }
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;  
    }
    
    
    public static function _consejeros( $idConsejero= "", $periodo = "", $provincia = "", $canton = "", $monitor =""){
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " consejeria_pvvs.ID_CANTON = ".$canton." and";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." and";
        }
        
        if($idConsejero != ""){
            $filtro .= " consejeria_pvvs.ID_CONSEJERO = ".$idConsejero." and";    
        }
        
        
        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo." ";
        
    	$query = self::$sqlConsejerosFiltrados.$filtro." GROUP BY consejeria_pvvs.ID_CONSEJERO";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    public static function cantidad_nuevos_promotor($idConsejero, $periodo = "", $provincia = "", $canton = ""){
        return 0;
    }
    
    public static function cantidad_recurrentes_promotor($idConsejero, $periodo = "", $provincia = "", $canton = ""){
        return 0;
    }
    public static function consejerias($idConsejero, $periodo = "", $provincia = "", $canton = ""){       
         
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " consejeria_pvvs.ID_CANTON = ".$canton." and";
        }        
        
        $filtro .= " consejeria_pvvs.ID_CONSEJERO = ".$idConsejero." and";
        
        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";       
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        //echo self::$sqlConsejerias.$filtro;
        $consulta = self::consulta( self::$sqlConsejerias.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }
    }
    
    public static function primer_abordaje_viejo($idPemar, $idPeriodo){
       $query = "SELECT 

	ANO_PERIODO, ID_TIPOPOBLACION,	CODIGO_TIPOPOBLACION,
	ID_POBLACION,	CODIGO_UNICO_PERSONA,	ID_PERIODO_INDICADOR,
	CODIGO_PERIODO_INDICADOR,	ID_PERIODO, 	CODIGO_PERIODO, 
	TIPO_AGENTE,	ID_SUBRECEPTOR,	ID_PERSONA,
	REGISTRO_ABORDAJE,	FECHA_PRIMER_ABORDAJE
        
    FROM(
	(SELECT * FROM primer_abordaje_promotor)  
	UNION 
	(SELECT * FROM primer_abordaje_animador)  
	UNION 
	(SELECT * FROM primer_abordaje_consejero)  
       ) AS FPP
    WHERE ID_POBLACION = ".$idPemar." AND FECHA_PRIMER_ABORDAJE = ( 
	SELECT MIN(FECHA_PRIMER_ABORDAJE) 
	FROM(
		(SELECT * FROM primer_abordaje_promotor)  
		UNION 
		(SELECT * FROM primer_abordaje_animador)  
		UNION 
		(SELECT * FROM primer_abordaje_consejero)  
	) AS FPP
	WHERE ID_POBLACION = ".$idPemar." AND ANO_PERIODO = (SELECT ANO_PERIODO FROM PERIODOS WHERE ID_PERIODO = ".$idPeriodo." )
        )ORDER BY
            ID_TIPOPOBLACION, 
            ID_POBLACION,
            ANO_PERIODO,
            FECHA_PRIMER_ABORDAJE";
        
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    
    public static function primer_abordaje($idPemar, $idPeriodo){
       
//        $PRIMER_ABORDAJE_ANIMADORES = AbordajesAnimadoresModel::primer_abordaje($idPemar, $idPeriodo) ;
//        $PRIMER_ABORDAJE_PROMOTORES = AbordajesPromotoresModel::primer_abordaje($idPemar, $idPeriodo) ;
//        (".$PRIMER_ABORDAJE_PROMOTORES.")  
//	UNION 
//	(".$PRIMER_ABORDAJE_ANIMADORES.")  
//	UNION 
        $query = "SELECT 
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
                  `consejeria_pvvs`.`ID_PEMAR` = `pemar`.`ID_POBLACION`
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
WHERE ID_POBLACION = ".$idPemar." AND ANO_PERIODO = (SELECT ANO_PERIODO FROM PERIODOS WHERE ID_PERIODO = ".$idPeriodo." )
    AND (
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
  `pemar`.`CODIGO_UNICO_PERSONA`";
        
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }

    public static function cantidad_personas_alcazadas( $idConsejero, $tipoPersona, $periodo = "", $provincia = "", $canton = "", $monitor =""){
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " consejeria_pvvs.ID_CANTON = ".$canton." and";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." and";
        }
        
        $filtro .= " consejeria_pvvs.ID_CONSEJERO = ".$idConsejero." and";
        
        $filtro .= " consejeria_pvvs.ESTADO_REVISION= 'APROBADO' and";
        
        $filtro .= " consejeria_pvvs.TIPO_ALCANCE_CONSEJERIA_PVVS = '".$tipoPersona."' and";
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo." ";
        
    	$query = self::$sqlpersalcanzadas.$filtro;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->cantidad;
        }
        return 0;   
    }

}?>