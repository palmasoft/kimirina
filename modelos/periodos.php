<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PeriodosModel extends ModelBase {

    public static $sqlBase = " SELECT
	periodos_indicadores.*,
	periodos.* 
    FROM
      periodos
        INNER JOIN periodos_indicadores 
            ON (periodos.ID_PERIODO_INDICADOR = periodos_indicadores.ID_PERIODO_INDICADOR) ";

    public static function todos() {
        $query = self::$sqlBase . " ORDER BY ANO_PERIODO ASC, MES_PERIODO ASC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_menores_periodo($periodo) {
        $query = self::$sqlBase . " WHERE  periodos.ID_PERIODO < " . $periodo . "  ORDER BY ANO_PERIODO DESC, MES_PERIODO DESC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_menores_incluido_periodo($periodo) {
        $query = self::$sqlBase . " WHERE periodos.ID_PERIODO <= " . $periodo . "  ORDER BY ANO_PERIODO DESC, MES_PERIODO DESC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_dentro_trimestre($trimestre) {
        $query = self::$sqlBase . " WHERE periodos.TRIM_PERIODO = '" . $trimestre . "'  ORDER BY ANO_PERIODO DESC, MES_PERIODO DESC ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos($idPeriodo) {
        $query = self::$sqlBase . " where periodos.ID_PERIODO = " . $idPeriodo . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datos_por_codigo($codPeriodo) {
        $query = self::$sqlBase . " where periodos.CODIGO_PERIODO = '" . $codPeriodo . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function por_fecha($fecha) {
        $query = self::$sqlBase . " where '" . $fecha . "' BETWEEN FECHA_MIN_PERIODO AND FECHA_MAX_PERIODO ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function actual() {
        $query = self::$sqlBase . " where periodos.ACTUAL = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }

        return 0;
    }

    public static function activo() {

        if (isset($_SESSION["SESION_PERIODO_ACTIVO"])) {
            return $_SESSION["SESION_PERIODO_ACTIVO"];
        }

        $query = self::$sqlBase . " where periodos.ACTUAL = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }

        return 0;
    }
    
    public static function siguiente_actual() {

        $query = self::$sqlBase . " where periodos.ID_PERIODO = ( " .$_SESSION["SESION_PERIODO_ACTUAL"]->ID_PERIODO." + 1) ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }

        return 0;
    }

    public static function cambiar_periodo_activo($ID_PERIODO) {
        if (isset( $_SESSION["SESION_PERIODO_ACTIVO"])) {
            $query = self::$sqlBase . "  WHERE periodos.ID_PERIODO = " . $ID_PERIODO . " ";
            $consulta = self::consulta($query);
            if (count($consulta) > 0) {
                $_SESSION["SESION_PERIODO_ACTIVO"] = $consulta[0];
            }
            return $_SESSION["SESION_PERIODO_ACTIVO"];
        }
        return 0;
    }

    public static function todos_anos() {
        $query = self::$sqlBase . " GROUP BY ANO_PERIODO  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function todos_meses() {
        $query = self::$sqlBase . " GROUP BY  MES_PERIODO  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function activarPeriodo($idPeriodo) {
        $query = " 
        UPDATE periodos
        SET 
          ACTUAL = 'SI'
        WHERE ID_PERIODO = '" . $idPeriodo . "';";

        return self::modificarRegistros($query);
    }

    public static function desactivarPeriodo($idPeriodo) {
        $query = " 
        UPDATE periodos
        SET 
          ACTUAL = 'NO'
        WHERE ID_PERIODO = '" . $idPeriodo . "';";

        return self::modificarRegistros($query);
    }

    public static function codigoPeriodo($idPeriodo) {
        $query = self::$sqlBase . " where periodos.ID_PERIODO = " . $idPeriodo . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->CODIGO_PERIODO;
        }
        return 0;
    }

}

?>