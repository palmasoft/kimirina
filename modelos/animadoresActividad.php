<?php

class animadoresActividadModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    insumos.ID_INSUMO,
                    insumos.NOMBRE_INSUMO,
                    recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR ,
                    SUM(`recibo_contacto_insumo_entregado`.`CANTIDAD`) AS CANT
                    FROM
                    recibo_contacto_animador
                    LEFT JOIN recibo_contacto_insumo_entregado 
                    ON (recibo_contacto_animador.ID_CONTACTOANIMADOR = recibo_contacto_insumo_entregado.ID_CONTACTOANIMADOR)
                    LEFT JOIN personas_sistema 
                        ON (recibo_contacto_animador.ID_PROMOTOR= personas_sistema.ID_PERSONA)
                    LEFT JOIN insumos 
                    ON ( recibo_contacto_insumo_entregado.ID_INSUMO= insumos.ID_INSUMO )
                    INNER JOIN periodos
                        ON ( CONCAT(recibo_contacto_animador.ANO_CONTACTOANIMADOR, '-',
					recibo_contacto_animador.MES_CONTACTOANIMADOR, '-',
					recibo_contacto_animador.DIA_CONTACTOANIMADOR)
                         BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )" ;
                        
    public static $sqlGroupby = " GROUP BY
                           periodos.CODIGO_PERIODO,
                            periodos.FECHA_MIN_PERIODO,
                            periodos.FECHA_MAX_PERIODO,
                            insumos.ID_INSUMO,
                            insumos.NOMBRE_INSUMO,
                            recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR  ";

    
     public static $sqlBaseAnimadores = "
	SELECT DISTINCT personas_sistema.*
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
     
     public static $sqlBaseReciboContacto = "SELECT
	    DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) AS FECHA_CONTACTO
           
            ,recibo_contacto_animador.*
            
            FROM  recibo_contacto_animador
           LEFT JOIN personas_sistema 
                ON (recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA)
           INNER JOIN pemar 
                ON (recibo_contacto_animador.ID_PEMAR = pemar.ID_POBLACION)
            LEFT JOIN tipo_poblacion 
                ON (pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
          INNER JOIN periodos
			ON ( DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			periodos.ACTUAL = 'SI')
	   )"; 
     public static $sqlBaseDerivados = " 
         SELECT
             MIN(atencion_salud.FECHA_ATENCION) AS FECHA_ATENCION
            , atencion_salud.*
        FROM
            atencion_salud
         ";
     
    public static $filtroSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroEstadoRevision = " AND recibo_contacto_animador.ESTADO_REVISION= 'APROBADO'"; 
    public static $filtroAnimador = "INNER JOIN recibo_contacto_animador 
                    ON (personas_sistema.ID_PERSONA = recibo_contacto_animador.ID_PROMOTOR)";
    public static $filtroPeriodo = "INNER JOIN periodos
			ON ( DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
			periodos.ACTUAL = 'SI'))" ;
    public static $filtroPeriodoDNI = "INNER JOIN periodos
			ON ( DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO )" ;
             
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    
    public static function fecha_min_atencion($pemar, $ano_periodo){
        $filtro = ' WHERE atencion_salud.ID_PEMAR = '. $pemar.
                ' AND YEAR(atencion_salud.FECHA_ATENCION) = '.$ano_periodo.
            ' GROUP BY FECHA_ATENCION ASC';
        
        $consulta = self::consulta( self::$sqlBaseDerivados.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    
    public static function cantidad_tipo_alcance($tipoFormato, $tipoAlcance, $animador="", $monitor="", $periodo = "", $provincia = "", $canton =""){
        
        $filtro = ' where ';
        
        $filtro .= " recibo_contacto_animador.TIPO_FORMATO_CONTACTOANIMADOR = '".$tipoFormato."' and";
        
        $filtro .= " recibo_contacto_animador.TIPO_ALCANCE_RECIBO_CONTACTO_ANIMADOR = '".$tipoAlcance."' and";
        
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION= 'APROBADO' and";
        
       if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CANTON = ".$canton." and";
        }
        if( $monitor != ""){
            $filtro .= " recibo_contacto_animador.ID_MONITOR = ".$monitor." and";
        }
        if( $animador != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        }
        
        $filtro .= " periodos.CODIGO_PERIODO = ".$periodo;
        
    	$query = self::$sqlBase.$filtro.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0]->CANT;
        }
        return 0;   
    }
    
    public static function animadores( $monitor ="", $animador="",  $provincia = "", $canton = ""){
        
        $flag = false;
        $filtro = " WHERE ";
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD= ".$canton." and";
            $flag = true;
        }else if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
            $flag = true;
        }
        if( $animador != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$animador." AND";
        }elseif ( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND";
        }
        
        $filtro .= " ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";       
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        if($flag){
            if(Usuario::esDNI()){
                $query = self::$sqlBaseAnimadores.self::$filtroAnimador.self::$filtroPeriodoDNI.$filtro;
            }else{
                $query = self::$sqlBaseAnimadores.self::$filtroAnimador.self::$filtroPeriodo.$filtro;
            }
        }else{
            $query = self::$sqlBaseAnimadores.$filtro;
        }
//        echo $query;
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
    public static function recibo_contacto($animador, $periodo = "", $provincia = "", $canton = ""){       
        
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " recibo_contacto_animador.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
        }        
        
        $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION= 'APROBADO' and";       
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
       
//        echo self::$sqlBaseReciboContacto.$filtro;
        $consulta = self::consulta( self::$sqlBaseReciboContacto.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        } 
    }
    public static function primer_abordaje($idPemar, $idPeriodo){
       $query = "SELECT 

	ANO_PERIODO, ID_TIPOPOBLACION,	CODIGO_TIPOPOBLACION,
	ID_POBLACION,	CODIGO_UNICO_PERSONA,	ID_PERIODO_INDICADOR,
	CODIGO_PERIODO_INDICADOR,	ID_PERIODO, 	CODIGO_PERIODO, 
	TIPO_AGENTE,	ID_SUBRECEPTOR,	ID_PERSONA,
	REGISTRO_ABORDAJE,	FECHA_PRIMER_ABORDAJE
        
    FROM(
	(SELECT * FROM primer_abordaje_animador)  
       ) AS FPP
    WHERE ID_POBLACION = ".$idPemar." AND FECHA_PRIMER_ABORDAJE = ( 
	SELECT MIN(FECHA_PRIMER_ABORDAJE) 
	FROM(
	   (SELECT * FROM primer_abordaje_animador)   
	) AS FPP
	WHERE ID_POBLACION = ".$idPemar." AND ANO_PERIODO = (SELECT ANO_PERIODO FROM periodos WHERE ID_PERIODO = ".$idPeriodo." )
        )ORDER BY
            ID_TIPOPOBLACION, 
            ID_POBLACION,
            ANO_PERIODO,
            FECHA_PRIMER_ABORDAJE";
        
//        echo $query;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
    }
    public static function datos($ID_ROL){
    	$query = self::$sqlBase." WHERE ACTIVO='Si' AND ID_ROL='$ID_ROL' ";
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;   
    }
}

?>