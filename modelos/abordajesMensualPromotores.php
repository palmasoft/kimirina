<?php

class abordajesMensualPromotoresModel extends ModelBase{
    
    public static $sqlBase = "SELECT
                    periodos.CODIGO_PERIODO,
                    periodos.FECHA_MIN_PERIODO,
                    periodos.FECHA_MAX_PERIODO,
                    personas_sistema.NOMBRE_REAL_PERSONA,
                    registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                    registro_semanal_contacto.TIPO_ALCANCE_CONTACTO ,
                    COUNT( registro_semanal_contacto.TIPO_ALCANCE_CONTACTO ) AS CANT
                    FROM
                    registro_semanal_contacto
                    LEFT JOIN registro_semanal 
                        ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
                    LEFT JOIN personas_sistema 
                        ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                    INNER JOIN periodos
                        ON (  registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO ) " ;
                        
    public static $sqlGroupby = " GROUP BY 
                        	periodos.CODIGO_PERIODO,
                        	periodos.FECHA_MIN_PERIODO,
                        	periodos.FECHA_MAX_PERIODO,
                        	personas_sistema.NOMBRE_REAL_PERSONA,
                        	registro_semanal.TIPO_FORMATO_REGISTROSEMANAL,
                        	registro_semanal_contacto.TIPO_ALCANCE_CONTACTO ";
    public static $sqlBasePromotores = "
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
	    ";
    public static $sqlRegistroSemanal = " 
       SELECT         
        registro_semanal.*,
        registro_semanal_contacto.*,
        pemar.*
        FROM   registro_semanal 
                LEFT JOIN cantones 
                            ON(( registro_semanal.id_canton = cantones.id_canton )) 
                LEFT JOIN provincias 
                           ON(( registro_semanal.id_provincia = provincias.id_provincia )) 
                LEFT JOIN registro_semanal_contacto 
                       ON(( registro_semanal_contacto.id_registrosemanal = registro_semanal.id_registrosemanal )) 
                LEFT JOIN pemar 
                       ON(( pemar.ID_POBLACION = registro_semanal_contacto.ID_PEMAR ))
                INNER JOIN personas_sistema 
                        ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                INNER JOIN periodos
			ON (  registro_semanal.`SEMANA_DEL` >= periodos.FECHA_MIN_PERIODO 
			AND registro_semanal.`SEMANA_HASTA` <= periodos.FECHA_MAX_PERIODO 
			)";

    public static $filtroPersonasSubreceptor = "  AND  personas_sistema.ID_SUBRECEPTOR =   ";
    public static $filtroAtencionSubreceptor = "  AND  atencion_salud.ID_SUBRECEPTOR =   ";
    public static $filtroPersonasActivas = " AND personas_sistema.ACTIVO = 'SI' ";  
    public static $filtroEstadoRevision = " AND registro_semanal.ESTADO_REVISION= 'APROBADO'";  
    public static $filtroRegistroPromotor = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                                                periodos.ACTUAL = 'SI') )";
    public static $filtroRegistroPromotorDNI = " LEFT JOIN registro_semanal
                                                ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
                                                INNER JOIN periodos
                                                ON ( registro_semanal.SEMANA_DEL BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO  )";
    
    
    public static function todos(){
    	$query = self::$sqlBase.self::$sqlGroupby;
        $consulta = self::consulta( $query );
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;   
    }
    
     public static function promotores( $monitor ="", $promotor="",  $provincia = "", $canton = ""){
         
        $flag = false;
        $filtro = " WHERE registro_semanal.ACTIVO = 'SI' AND ";
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and ";
            $flag = true;
        }else if( $provincia != "" ){
            $filtro .= " registro_semanal.ID_PROVINCIA = ".$provincia." and ";
            $flag = true;
        } 

        if( $promotor != "" ){
            $filtro .= " personas_sistema.ID_PERSONA = ".$promotor." AND ";
        }
        if( $monitor != "" ){
            $filtro .= " personas_sistema.PERTENECE_A_ID = ".$monitor." AND ";
        }


        $filtro .= " (tipo_usuario.CODIGO_ROL = 'PROMO' OR tipo_usuario.CODIGO_ROL = 'PROANI' ) ";  
       
        $filtro .= self::$filtroPersonasSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . "   ";

        if(Usuario::esDNI()){
            $query = self::$sqlBasePromotores. self::$filtroRegistroPromotorDNI .$filtro;
        }else{
            $query = self::$sqlBasePromotores. self::$filtroRegistroPromotor .$filtro;
        }
        
        $consulta = self::consulta($query);
        
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function registros_semanales($promotor, $periodo = "", $provincia = "", $canton = ""){       
       
        $filtro = ' where ';
        if( $provincia != "" ){
            $filtro .= " cantones.ID_PROVINCIA = ".$provincia." and";
        }
        if( $canton != "" ){
            $filtro .= " registro_semanal.ID_CANTON = ".$canton." and";
        }        
        
        $filtro .= " registro_semanal.ID_PROMOTOR = ".$promotor." and";
        
        //$filtro .= " registro_semanal.ESTADO_REVISION= 'APROBADO' and";       
        
        $filtro .= " periodos.ID_PERIODO = ".$periodo." ";
        
        
        
//        echo self::$sqlRegistroSemanal.$filtro;
        $consulta = self::consulta( self::$sqlRegistroSemanal.$filtro );
        if (count($consulta) > 0) {
            return $consulta;
        }
    }

     public static function registros_semanales_promotores($promotor, $periodo = "", $provincia = "", $canton = ""){      
       
       return RegistroSemanalContactosModel::todos_registros_semanales_promotores($promotor, $periodo, $provincia, $canton);
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