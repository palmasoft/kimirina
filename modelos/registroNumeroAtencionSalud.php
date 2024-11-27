<?php

class registroNumeroAtencionSaludModel extends ModelBase {

    static $sqlbase = "
        SELECT
            numero_atenciones_salud.ID_ATENCION_SALUD
            , numero_atenciones_salud.MES_ATENCIONES_SALUD
            , numero_atenciones_salud.ANO_ATENCIONES_SALUD
            , numero_atenciones_salud.ID_CENTRO_SALUD
            , numero_atenciones_salud.ID_SERVICIO_SALUD
            , numero_atenciones_salud.NUMERO_PEMAR
            , numero_atenciones_salud.OBSERVACIONES
            , numero_atenciones_salud.URL_DOC_ATENCION
            , servicios_salud.ID_SERVICIO
            , servicios_salud.NOMBRE_SERVICIO
            , centros_servicios_salud.ID_CENTROSERVICIO
            , centros_servicios_salud.NOMBRE_CENTROSERVICIO
        FROM
            numero_atenciones_salud
            LEFT JOIN centros_servicios_salud 
                ON (numero_atenciones_salud.ID_CENTRO_SALUD = centros_servicios_salud.ID_CENTROSERVICIO)
            LEFT JOIN servicios_salud 
                ON (numero_atenciones_salud.ID_SERVICIO_SALUD = servicios_salud.ID_SERVICIO)
        ";

    public static function todos() {
        $query = self::$sqlbase . " WHERE numero_atenciones_salud.ACTIVO = 'SI'";

        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function insertar($ano, $mes, $centroSalud, $servicioSalud, $numeroPemar, $observaciones, $url_doc_soporte) {

        $query = "insert INTO numero_atenciones_salud
            (
             ANO_ATENCIONES_SALUD,
             MES_ATENCIONES_SALUD,
             ID_CENTRO_SALUD,
             ID_SERVICIO_SALUD,
             NUMERO_PEMAR,
             OBSERVACIONES,
             FECHA_CREACION,
             URL_DOC_ATENCION
             )
             VALUES (
                    '" . $ano . "',
                    '" . $mes . "',
                    '" . $centroSalud . "',
                    '" . $servicioSalud . "',
                    '" . $numeroPemar . "',
                    '" . $observaciones . "',
                    CURRENT_TIMESTAMP,
                    '".$url_doc_soporte."')";

        return self::modificarRegistros($query);
    }

    public static function datos($id) {
        $query = self::$sqlbase . " where numero_atenciones_salud.ID_ATENCION_SALUD = '" . $id . "'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function update($id, $ano, $mes, $centroSalud, $servicioSalud, $numeroPemar, $observaciones) {
        $query = "
            update numero_atenciones_salud
            set
            ANO_ATENCIONES_SALUD = '" . $ano . "' ,
            MES_ATENCIONES_SALUD = '" . $mes . "' ,
            ID_CENTRO_SALUD = '" . $centroSalud . "' ,
            ID_SERVICIO_SALUD = '" . $servicioSalud . "' ,
            NUMERO_PEMAR = '" . $numeroPemar . "',
            OBSERVACIONES ='" . $observaciones . "',
            FECHA_MODIFICACION = CURRENT_TIMESTAMP
            where ID_ATENCION_SALUD='" . $id . "'";

        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = " update numero_atenciones_salud set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_ATENCION_SALUD='" . $id . "'";
        return self::modificarRegistros($query);
    }

}

?>