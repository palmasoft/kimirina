<?php

class InformesMensualesModel extends ModelBase {

    public static $sqlBase = " select * from subreceptores_informes_mensuales  ";
    
    public static function todos(){
        
        $query = self::$sqlBase."  ";
        
        $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
    }    
    
      
    public static function estado_periodo_actual( $ID_SUBRECEPTOR ){                
        $query = self::$sqlBase." WHERE subreceptores_informes_mensuales.ID_PERIODO = ".PeriodosModel::activo()->ID_PERIODO." "
                . " AND subreceptores_informes_mensuales.ID_SUBRECEPTOR = ".$ID_SUBRECEPTOR."  ";        
        $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
    }    
    
    public static function estado_por_periodo( $ID_SUBRECEPTOR, $ID_PERIODO ){                
        $query = self::$sqlBase." WHERE subreceptores_informes_mensuales.ID_PERIODO = ".$ID_PERIODO." "
                . " AND subreceptores_informes_mensuales.ID_SUBRECEPTOR = ".$ID_SUBRECEPTOR."  ";        
        $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta[0];
            }
            return 0; 
    }

}

