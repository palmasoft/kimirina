<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AbordajesModel extends ModelBase {

    public static $sqlBase = "
        select
            *
        from abordajes_year_actual
    ";

    public static function todos() {
        $query = self::$sqlBase . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function validos_actuales($CODIGO) {
        $query = self::$sqlBase . " WHERE abordajes_year_actual.CODIGO_UNICO_PERSONA = '" . $CODIGO . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static $sqlPorAno = "select * from abordajes_por_ano ";
    public static function abordajes_por_ano($codPemar, $ano) {
        $query = self::$sqlPorAno . " WHERE  abordajes_por_ano.CODIGO_UNICO_PERSONA = '" . $codPemar . "' and abordajes_por_ano.ANO_PERIODO = '" . $ano . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static $sqlPorMes = "select * from abordajes_por_mes ";
    public static function abordajes_por_mes($codPemar, $periodo) {
        $query = self::$sqlPorMes . " WHERE abordajes_por_mes.CODIGO_UNICO_PERSONA = '" . $codPemar . "' AND abordajes_por_mes.ID_PERIODO = " . $periodo->ID_PERIODO;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    
    public static $sqlPorAnoSR = "select * from abordajes_por_ano_subreceptor ";
    public static function abordajes_por_ano_por_subreceptor($codPemar, $ano) {
        $query = self::$sqlPorAnoSR . " WHERE  abordajes_por_ano_subreceptor.CODIGO_UNICO_PERSONA = '" . $codPemar . "' "                          
                . "AND abordajes_por_ano_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND abordajes_por_ano_subreceptor.ANO_PERIODO = '" . $ano . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static $sqlPorMesSR = "select * from abordajes_por_mes_subreceptor ";
    public static function abordajes_por_mes_por_subreceptor($codPemar, $periodo) {
        $query = self::$sqlPorMesSR . " WHERE abordajes_por_mes_subreceptor.CODIGO_UNICO_PERSONA = '" . $codPemar . "' "                
                . "AND abordajes_por_mes_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND abordajes_por_mes_subreceptor.ID_PERIODO = " . $periodo->ID_PERIODO;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    
    public static function recurrencia_por_promotor($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_promotor WHERE primer_abordaje_promotor.ID_POBLACION = '" . $idPemar . "' "
                . "AND primer_abordaje_promotor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                . "AND YEAR(primer_abordaje_promotor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."') ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    public static function recurrencia_por_animador($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_animador WHERE primer_abordaje_animador.ID_POBLACION = '" . $idPemar . "' "
                . "AND primer_abordaje_animador.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."')  "
                . "AND YEAR(primer_abordaje_animador.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    public static function recurrencia_por_consejero($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_consejero WHERE primer_abordaje_consejero.ID_POBLACION = '" . $idPemar . "' "
                . "AND primer_abordaje_consejero.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                . "AND YEAR(primer_abordaje_consejero.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_promotor_subreceptor($idPemar, $dia, $hora) {        
         $query =  "SELECT * FROM primer_abordaje_promotor_subreceptor WHERE primer_abordaje_promotor_subreceptor.ID_POBLACION = '" . $idPemar . "' "
                . "AND primer_abordaje_promotor_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_promotor_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                 . "AND YEAR(primer_abordaje_promotor_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."') ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_animador_subreceptor($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_animador_subreceptor WHERE primer_abordaje_animador_subreceptor.ID_POBLACION = '" . $idPemar . "' "                
                . "AND primer_abordaje_animador_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_animador_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."')  "
                . "AND YEAR(primer_abordaje_animador_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_consejero_subreceptor($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_consejero_subreceptor WHERE primer_abordaje_consejero_subreceptor.ID_POBLACION = '" . $idPemar . "' "         
                . "AND primer_abordaje_consejero_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_consejero_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                . "AND YEAR(primer_abordaje_consejero_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_promotor_subreceptor_periodo($idPemar, $dia, $hora) {        
         $query =  "SELECT * FROM primer_abordaje_promotor_mes_subreceptor WHERE primer_abordaje_promotor_mes_subreceptor.ID_POBLACION = '" . $idPemar . "' "
                . "AND primer_abordaje_promotor_mes_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_promotor_mes_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                 . "AND YEAR(primer_abordaje_promotor_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."') "
                 . "AND MONTH(primer_abordaje_promotor_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = MONTH('".$dia." ".$hora."') ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_animador_subreceptor_periodo($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_animador_mes_subreceptor WHERE primer_abordaje_animador_mes_subreceptor.ID_POBLACION = '" . $idPemar . "' "                
                . "AND primer_abordaje_animador_mes_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_animador_mes_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."')  "
                . "AND YEAR(primer_abordaje_animador_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  "
                . "AND MONTH(primer_abordaje_animador_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = MONTH('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
    
    public static function recurrencia_por_consejero_subreceptor_periodo($idPemar, $dia, $hora) {
        $query =  "SELECT * FROM primer_abordaje_consejero_mes_subreceptor WHERE primer_abordaje_consejero_mes_subreceptor.ID_POBLACION = '" . $idPemar . "' "         
                . "AND primer_abordaje_consejero_mes_subreceptor.ID_SUBRECEPTOR = " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " "
                . "AND primer_abordaje_consejero_mes_subreceptor.`FECHA_PRIMER_ABORDAJE` < DATE('".$dia." ".$hora."') "
                . "AND YEAR(primer_abordaje_consejero_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = YEAR('".$dia." ".$hora."')  "
                . "AND MONTH(primer_abordaje_consejero_mes_subreceptor.`FECHA_PRIMER_ABORDAJE`) = MONTH('".$dia." ".$hora."')  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return 'RECURRENTE';
        }
        return 'NUEVO';
    }
        
}
?>