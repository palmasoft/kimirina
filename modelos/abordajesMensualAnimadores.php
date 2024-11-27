<?php

class abordajesMensualAnimadoresModel extends ModelBase{
    
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
            ,pemar.*
            
            FROM  recibo_contacto_animador
            LEFT JOIN cantones 
                ON(( recibo_contacto_animador.ID_CIUDAD = cantones.id_canton )) 
            LEFT JOIN provincias 
                ON(( recibo_contacto_animador.id_provincia = provincias.id_provincia )) 
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
     
     public static $sqlBaseReciboContactoDNI = "SELECT
	    DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) AS FECHA_CONTACTO
           
            ,recibo_contacto_animador.*
            ,pemar.*
            
            FROM  recibo_contacto_animador
            LEFT JOIN cantones 
                ON(( recibo_contacto_animador.ID_CIUDAD = cantones.id_canton )) 
            LEFT JOIN provincias 
                ON(( recibo_contacto_animador.id_provincia = provincias.id_provincia )) 
            LEFT JOIN personas_sistema 
                ON (recibo_contacto_animador.ID_PROMOTOR = personas_sistema.ID_PERSONA)
            INNER JOIN pemar 
                ON (recibo_contacto_animador.ID_PEMAR = pemar.ID_POBLACION)
            LEFT JOIN tipo_poblacion 
                ON (pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
            INNER JOIN periodos
			ON ( DATE( CONCAT( ANO_CONTACTOANIMADOR, '-', MES_CONTACTOANIMADOR,'-', DIA_CONTACTOANIMADOR)) BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO
	   )";
     
    public static $filtroSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroEstadoRevision = " AND recibo_contacto_animador.ESTADO_REVISION= 'APROBADO'"; 
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
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
        
        $filtro .= " recibo_contacto_animador.ACTIVO= 'SI' and";      
        
        $filtro .= " ( tipo_usuario.CODIGO_ROL = 'ANIMA'  OR tipo_usuario.CODIGO_ROL = 'PROANI' OR tipo_usuario.CODIGO_ROL = 'CONANI')";       
        
        if($flag){
            $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroEstadoRevision.self::$filtroPersonasActivas;
            if(Usuario::esDNI()){
                $query = self::$sqlBaseAnimadores.self::$filtroAnimador.self::$filtroPeriodoDNI.$filtro;
            }else{
                $query = self::$sqlBaseAnimadores.self::$filtroAnimador.self::$filtroPeriodo.$filtro;
            }
        }else{
            $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ".self::$filtroPersonasActivas;
            $query = self::$sqlBaseAnimadores.self::$filtroAnimador.$filtro;
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
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " recibo_contacto_animador.ID_CIUDAD = ".$canton." and";
        }        
        
        $filtro .= " recibo_contacto_animador.ID_PROMOTOR = ".$animador." and";
        
        $filtro .= " recibo_contacto_animador.ESTADO_REVISION= 'APROBADO' and";       
        
        $filtro .= " recibo_contacto_animador.ACTIVO= 'SI' and";      
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR ;  
       
        if(Usuario::esDNI()){
            $consulta = self::consulta( self::$sqlBaseReciboContactoDNI.$filtro );
        }else{
            $consulta = self::consulta( self::$sqlBaseReciboContacto.$filtro );
        }
        if (count($consulta) > 0) {
            return $consulta;
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