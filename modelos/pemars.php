<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pemars
 *
 * @author Software
 */
class PemarsModel extends ModelBase {

    //put your code here

    public static $sqlBase = "
        SELECT
    tipo_poblacion.CODIGO_TIPOPOBLACION
    , tipo_poblacion.NOMBRE_TIPOPOBLACION
    , tipo_poblacion.ALIAS_TIPOPOBLACION
    , tipo_poblacion.OBSERVACIONES_TIPOPOBLACION
    , tipo_poblacion.MOSTRAR_WEB
    , provincias.ID_PROVINCIA
    , provincias.CODIGO_PROVINCIA
    , provincias.NOMBRE_PROVINCIA
    , provincias.OBSERVACIONES_PROVINCIA
    , cantones.CODIGO_CANTON
    , cantones.NOMBRE_CANTON
    , cantones.OBSERVACIONES_CANTON
    , pemar.*
FROM
    pemar
    LEFT JOIN tipo_poblacion 
        ON (pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
    LEFT JOIN cantones 
        ON (pemar.ID_CANTON = cantones.ID_CANTON)
    LEFT JOIN provincias 
        ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA) ";

    public static function todos() {
        $query = self::$sqlBase . " where pemar.ACTIVO='SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_pemar_por_codigoUnicoPersona($CODIGO_UNICO_PERSONA) {
        $query = self::$sqlBase . " WHERE pemar.CODIGO_UNICO_PERSONA = '" . $CODIGO_UNICO_PERSONA . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datos_pemar_por_ciPoblacion($CI_POBLACION) {
        $query = self::$sqlBase . " WHERE pemar.CI_POBLACION = '" . $CI_POBLACION . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datos_pemar($ID_PEMAR) {
        $query = self::$sqlBase . " WHERE pemar.ID_POBLACION = " . $ID_PEMAR;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static $sqlTipos = "
        SELECT 	tipo_poblacion.*
       FROM tipo_poblacion ";

    public static function todos_tipos() {
        $query = self::$sqlTipos . "   ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function guardar_navegacion_web(
    $ID_PEMAR, $SESSION_ID, $CODIGO_PEMAR, $URL_ANTERIOR, $URL_ACTUAL, $DOMINIO_WEB, $TITULO_PAGINA, $FECHA_VISITA, $DIRECCION_IP
    ) {
        $query = " 
        insert into navegacion_web ( 
            ID_PEMAR, SESSION_ID, DIRECCION_IP,  CODIGO_PEMAR,  
            URL_ANTERIOR, URL_ACTUAL,  DOMINIO_WEB, 
            TITULO_PAGINA, FECHA_VISITA 
	) values (
            '" . $ID_PEMAR . "', '" . $SESSION_ID . "', '" . $DIRECCION_IP . "', '" . $CODIGO_PEMAR . "', 
            '" . $URL_ANTERIOR . "', '" . $URL_ACTUAL . "', '" . $DOMINIO_WEB . "', 
            '" . $TITULO_PAGINA . "', '" . $FECHA_VISITA . "'
	)   ";
        return self::crear_ultimo_id($query);
    }

    public static function validar_codigo($CODIGO_GENERADO) {
        $query = "select ID_POBLACION from pemar where CODIGO_UNICO_PERSONA = '" . $CODIGO_GENERADO . "'  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_POBLACION;
        }
        return 0;
    }

    public static function validar_cedula($CEDULA) {
        $query = "select ID_POBLACION from pemar where CI_POBLACION = '" . $CEDULA . "'  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_POBLACION;
        }
        return 0;
    }

    public static function validar_cedula_codigo($CEDULA, $CODIGO_GENERADO) {

        $query = "select ID_POBLACION from pemar where CODIGO_UNICO_PERSONA = '" . $CODIGO_GENERADO . "' AND  CI_POBLACION = '" . $CEDULA . "'  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_POBLACION;
        }
        return 0;
    }

    public static function guardar_pemar(
    $ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, $SEXO, $NOMBRE_POBLACION1, $APELLIDO_POBLACION1, $NOMBRE_POBLACION2, $APELLIDO_POBLACION2, $ID_CANTON) {
        $query = "
            insert into pemar ( 
                ID_TIPOPOBLACION, CODIGO_UNICO_PERSONA, MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION,  
                SEXO,
                NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION, ID_CANTON
            )values (
            " . $ID_TIPOPOBLACION . ", '" . $CODIGO_UNICO_PERSONA . "', '" . $MES_NACIMIENTO_POBLACION . "', '" . $ANO_NACIMIENTO_POBLACION . "',
            '" . $SEXO . "', 
            '" . $NOMBRE_POBLACION1 . "', '" . $APELLIDO_POBLACION1 . "', '" . $NOMBRE_POBLACION2 . "', '" . $APELLIDO_POBLACION2 . "', " . $ID_CANTON . "
            ); ";
        return self::crear_ultimo_id($query);
    }

    public static function insertar_con_sexo(
            $ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, 
            $NOMBRE_UNO_POBLACION, $APELLIDO_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_DOS_POBLACION, 
            $CI_POBLACION, $NUMERO_TELEFONO_POBLACION, $CORREO_POBLACION, $SEXO, $ID_CANTON) {
        $query = " INSERT INTO pemar
            (ID_TIPOPOBLACION, CODIGO_UNICO_PERSONA,   MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION,
             NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION,
             CI_POBLACION, NUMERO_TELEFONO_POBLACION, CORREO_POBLACION, SEXO,ID_CANTON)
                VALUES ($ID_TIPOPOBLACION,
                        '$CODIGO_UNICO_PERSONA',
                        '$MES_NACIMIENTO_POBLACION',
                        '$ANO_NACIMIENTO_POBLACION',
                        '$NOMBRE_UNO_POBLACION',
                        '$APELLIDO_UNO_POBLACION',
                        '$NOMBRE_DOS_POBLACION',
                        '$APELLIDO_DOS_POBLACION',
                        " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
                        '$NUMERO_TELEFONO_POBLACION',
                        '$CORREO_POBLACION',
                        '$SEXO',
                        $ID_CANTON); ";
        return self::crear_ultimo_id($query);
    }

    public static function insertar_con_sexo_sin_correo(
            $ID_TIPOPOBLACION, $ID_CANTON, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, $SEXO, 
            $NOMBRE_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_UNO_POBLACION, $APELLIDO_DOS_POBLACION, 
            $OTRO_NOMBRE_POBLACION = "", $CI_POBLACION, $NUMERO_TELEFONO_POBLACION) {

        $query = " INSERT INTO pemar
            ( ID_TIPOPOBLACION, ID_CANTON, CODIGO_UNICO_PERSONA, MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION, SEXO, 
NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION,  OTRO_NOMBRE_POBLACION,  
CI_POBLACION,  NUMERO_TELEFONO_POBLACION )
                VALUES ($ID_TIPOPOBLACION,
                        $ID_CANTON,
                        '" . $CODIGO_UNICO_PERSONA . "',
                        '" . $MES_NACIMIENTO_POBLACION . "',
                        '" . $ANO_NACIMIENTO_POBLACION . "',
                        '" . $SEXO . "',
                        '" . $NOMBRE_UNO_POBLACION . "',
                        '" . $APELLIDO_UNO_POBLACION . "',
                        '" . $NOMBRE_DOS_POBLACION . "',
                        '" . $APELLIDO_DOS_POBLACION . "',
                        '" . $OTRO_NOMBRE_POBLACION . "',
                        " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
                        '" . $NUMERO_TELEFONO_POBLACION . "' ); ";
        return self::crear_ultimo_id($query);
    }

    public static function insertar_nuevo($ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, $NOMBRE_UNO_POBLACION, $APELLIDO_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_DOS_POBLACION, $CI_POBLACION, $NUMERO_TELEFONO_POBLACION, $CORREO_POBLACION, $SEXO, $ID_CANTON) {
        $query = " INSERT INTO pemar
            (ID_TIPOPOBLACION, CODIGO_UNICO_PERSONA,   MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION,
             NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION,
             CI_POBLACION, NUMERO_TELEFONO_POBLACION, CORREO_POBLACION, SEXO,ID_CANTON)
                VALUES ($ID_TIPOPOBLACION,
                        '$CODIGO_UNICO_PERSONA',
                        '$MES_NACIMIENTO_POBLACION',
                        '$ANO_NACIMIENTO_POBLACION',
                        '$NOMBRE_UNO_POBLACION',
                        '$APELLIDO_UNO_POBLACION',
                        '$NOMBRE_DOS_POBLACION',
                        '$APELLIDO_DOS_POBLACION',
                        " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
                        '$NUMERO_TELEFONO_POBLACION',
                        '$CORREO_POBLACION',
                        '$SEXO',
                        '$ID_CANTON'); ";
        return self::crear_ultimo_id($query);
    }

    public static function insertar_sin_sexo(
            $ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, 
            $NOMBRE_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_UNO_POBLACION, $APELLIDO_DOS_POBLACION, 
            $CI_POBLACION, $NUMERO_TELEFONO_POBLACION
    ) {

        $query = " INSERT INTO pemar
            (ID_TIPOPOBLACION, CODIGO_UNICO_PERSONA,   MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION,
             NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION,
             CI_POBLACION, NUMERO_TELEFONO_POBLACION)
                VALUES ('$ID_TIPOPOBLACION',
                        '$CODIGO_UNICO_PERSONA',
                        '$MES_NACIMIENTO_POBLACION',
                        '$ANO_NACIMIENTO_POBLACION',
                        '$NOMBRE_UNO_POBLACION',
                        '$APELLIDO_UNO_POBLACION',
                        '$NOMBRE_DOS_POBLACION',
                        '$APELLIDO_DOS_POBLACION',
                        " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
                        '$NUMERO_TELEFONO_POBLACION')";
        return self::crear_ultimo_id($query);
    }

    public static function insertar(
            $ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, 
            $NOMBRE_UNO_POBLACION, $APELLIDO_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_DOS_POBLACION, 
            $OTRO_NOMBRE_POBLACION, $CI_POBLACION, $NUMERO_TELEFONO_POBLACION, $CORREO_POBLACION, $SEXO, $ID_CANTON
            ) {

        $query = "INSERT INTO pemar
            (ID_TIPOPOBLACION, CODIGO_UNICO_PERSONA,   MES_NACIMIENTO_POBLACION, ANO_NACIMIENTO_POBLACION,
             NOMBRE_UNO_POBLACION, APELLIDO_UNO_POBLACION, NOMBRE_DOS_POBLACION, APELLIDO_DOS_POBLACION, OTRO_NOMBRE_POBLACION,
             CI_POBLACION, NUMERO_TELEFONO_POBLACION, CORREO_POBLACION, SEXO,ID_CANTON)
                VALUES ('$ID_TIPOPOBLACION',
                        '$CODIGO_UNICO_PERSONA',
                        '$MES_NACIMIENTO_POBLACION',
                        '$ANO_NACIMIENTO_POBLACION',
                        '$NOMBRE_UNO_POBLACION',
                        '$APELLIDO_UNO_POBLACION',
                        '$NOMBRE_DOS_POBLACION',
                        '$APELLIDO_DOS_POBLACION',
                        '$OTRO_NOMBRE_POBLACION',
                        " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
                        '$NUMERO_TELEFONO_POBLACION',
                        '$CORREO_POBLACION',
                        '$SEXO',
                        '$ID_CANTON'); ";
        return self::crear_ultimo_id($query);
    }

    public static function update($ID_RGISTRO, $ID_TIPOPOBLACION, $CODIGO_UNICO_PERSONA, $MES_NACIMIENTO_POBLACION, $ANO_NACIMIENTO_POBLACION, $NOMBRE_UNO_POBLACION, $APELLIDO_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_DOS_POBLACION, $OTRO_NOMBRE_POBLACION, $CI_POBLACION, $NUMERO_TELEFONO_POBLACION, $CORREO_POBLACION, $SEXO, $ID_CANTON) {

        $query = " 
        UPDATE pemar
        SET 
          ID_TIPOPOBLACION = '" . $ID_TIPOPOBLACION . "',
          CODIGO_UNICO_PERSONA = '" . $CODIGO_UNICO_PERSONA . "',
          MES_NACIMIENTO_POBLACION = '" . $MES_NACIMIENTO_POBLACION . "',
          ANO_NACIMIENTO_POBLACION = '" . $ANO_NACIMIENTO_POBLACION . "',
          NOMBRE_UNO_POBLACION = '" . $NOMBRE_UNO_POBLACION . "',
          APELLIDO_UNO_POBLACION = '" . $APELLIDO_UNO_POBLACION . "',
          NOMBRE_DOS_POBLACION = '" . $NOMBRE_DOS_POBLACION . "',
          APELLIDO_DOS_POBLACION = '" . $APELLIDO_DOS_POBLACION . "',
          OTRO_NOMBRE_POBLACION = '" . $OTRO_NOMBRE_POBLACION . "',
          CI_POBLACION = " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
          NUMERO_TELEFONO_POBLACION = '" . $NUMERO_TELEFONO_POBLACION . "',
          CORREO_POBLACION = '" . $CORREO_POBLACION . "',
          SEXO = '" . $SEXO . "',
          ID_CANTON = '" . $ID_CANTON . "',
          FECHA_MODIFICACION = CURRENT_TIMESTAMP
        WHERE ID_POBLACION = '" . $ID_RGISTRO . "';";

        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = " UPDATE pemar set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_POBLACION='" . $id . "'";
        return self::modificarRegistros($query);
    }

    public static function actualizar_informacion_personal(
            $ID_PEMAR, $NOMBRE_UNO_POBLACION, $NOMBRE_DOS_POBLACION, $APELLIDO_UNO_POBLACION, $APELLIDO_DOS_POBLACION, 
            $OTRO_NOMBRE_POBLACION, $CI_POBLACION, $NUMERO_TELEFONO_POBLACION
    ) {
        $query = " 
        UPDATE pemar  SET 
          NOMBRE_UNO_POBLACION = '" . $NOMBRE_UNO_POBLACION . "',
          APELLIDO_UNO_POBLACION = '" . $APELLIDO_UNO_POBLACION . "',
          NOMBRE_DOS_POBLACION = '" . $NOMBRE_DOS_POBLACION . "',
          APELLIDO_DOS_POBLACION = '" . $APELLIDO_DOS_POBLACION . "',
          OTRO_NOMBRE_POBLACION = '" . $OTRO_NOMBRE_POBLACION . "',
          CI_POBLACION = " . ($CI_POBLACION == "" ? "NULL" : "'" . $CI_POBLACION . "'") . ",
          NUMERO_TELEFONO_POBLACION = '" . $NUMERO_TELEFONO_POBLACION . "'          
        WHERE ID_POBLACION = " . $ID_PEMAR . " ;";
        return self::modificarRegistros($query);
    }

}
