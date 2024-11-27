<?php

class reporteUbucacionParesContactadosModel extends ModelBase {

    static $sqlbase = "
        SELECT
                COUNT(registro_semanal_contacto.ID_PEMAR) AS NUMERO
	
        FROM
             registro_semanal_contacto
             INNER JOIN pemar 
                   ON (registro_semanal_contacto.ID_PEMAR = pemar.ID_POBLACION)            
            ";
    
    public static function numero_pemar_edad($edadMin, $edadMax, $tipoPoblacion, $canton) {
        $query = self::$sqlbase."
            INNER JOIN registro_semanal 
                ON (
                  registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL
                )
            INNER JOIN personas_sistema 
                ON (
                  registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA
                )
            INNER JOIN periodos
                ON ( registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                periodos.ACTUAL = 'SI') )
            WHERE 
                CAST( DATEDIFF( CURDATE() , DATE(CONCAT(pemar.ANO_NACIMIENTO_POBLACION, '-',pemar.MES_NACIMIENTO_POBLACION,'-01') ) )/365 AS SIGNED)
                BETWEEN '".$edadMin."' AND '".$edadMax."'
                  AND registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoPoblacion."' AND registro_semanal.ESTADO_REVISION = 'APROBADO'
                  AND personas_sistema.ID_SUBRECEPTOR = ".$_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR." 
                      AND registro_semanal.ID_CANTON = ".$canton;
        
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0]->NUMERO;
        return 0;
    }
    
    public static function numero_pemar_edad_dni($edadMin, $edadMax, $tipoPoblacion, $canton, $periodo) {
        $query = self::$sqlbase."
            INNER JOIN registro_semanal 
                ON (
                  registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL
                )
            INNER JOIN personas_sistema 
                ON (
                  registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA
                )
            INNER JOIN periodos
                ON ( registro_semanal_contacto.FECHA_CONTACTO BETWEEN periodos.FECHA_MIN_PERIODO AND periodos.FECHA_MAX_PERIODO AND(
                periodos.ID_PERIODO = '".$periodo."') )
            WHERE 
                CAST( DATEDIFF( CURDATE() , DATE(CONCAT(pemar.ANO_NACIMIENTO_POBLACION, '-',pemar.MES_NACIMIENTO_POBLACION,'-01') ) )/365 AS SIGNED)
                BETWEEN '".$edadMin."' AND '".$edadMax."'
                  AND registro_semanal.TIPO_FORMATO_REGISTROSEMANAL = '".$tipoPoblacion."' AND registro_semanal.ESTADO_REVISION = 'APROBADO'
                  AND personas_sistema.ID_SUBRECEPTOR = ".$_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR." 
                      AND registro_semanal.ID_CANTON = ".$canton;
        
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0]->NUMERO;
        return 0;
    }
    
    Public static function provinciaFiltro($monitor="", $promotor="", $provincia="", $canton="") {

        if($provincia!=""){
            return UbicacionesModel::provincia($provincia);
        }else        
        if(($monitor!="")&&($promotor=!"")){
            return UbicacionesModel::todas_provincias_filtro($promotor, $monitor);
        }else    
        if(($promotor=!"")){
             return UbicacionesModel::todas_provincias_filtro($promotor);
        }else{
            return UbicacionesModel::todas_provincias();
    }
    }
    
    public static function provinciaFiltroNuevo($monitor="", $promotor="", $provincia="", $canton="") {

            return UbicacionesModel::provincias_filtradas($monitor, $promotor, $provincia, $canton);
    
    }
}
