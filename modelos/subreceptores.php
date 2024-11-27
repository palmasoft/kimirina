<?php

class SubreceptoresModel extends ModelBase {

    static $sqlBaseSubreceptor = '
            SELECT
                  cantones.CODIGO_CANTON
                , cantones.NOMBRE_CANTON
                , provincias.ID_PROVINCIA
                , provincias.NOMBRE_PROVINCIA
                , subreceptores.*
                , personas_sistema.NOMBRE_REAL_PERSONA AS NOMBRE_GESTOR
            FROM
                subreceptores
                LEFT JOIN cantones 
                    ON (subreceptores.CANTON_SUBRECEPTOR = cantones.ID_CANTON)
                LEFT JOIN provincias 
                    ON (subreceptores.PROVINCIA_SUBRECEPTOR = provincias.ID_PROVINCIA) AND (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
                LEFT JOIN personas_sistema 
                    ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)  AND (subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA ) 
    ';

    public static function muestraPVVS() {
        $PVVS = false;
        $tiposPobSub = SubreceptoresModel::tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPobSub)) {
            foreach ($tiposPobSub AS $tPob) {
                if ($tPob->ID_TIPOPOBLACION == 4) {
                    $PVVS = true;
                }
            }
        }
        return $PVVS;
    }

    public static function muestraHSHTSTRANS() {
        $HSHTSTRANS = false;
        $tiposPobSub = SubreceptoresModel::tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPobSub)) {
            foreach ($tiposPobSub AS $tPob) {
                if ($tPob->ID_TIPOPOBLACION == 1 OR $tPob->ID_TIPOPOBLACION == 2 OR $tPob->ID_TIPOPOBLACION == 3) {
                    $HSHTSTRANS = true;
                }
            }
        }
        return $HSHTSTRANS;
    }

    public static function muestraTRANS() {
        $TRANS = false;
        $tiposPobSub = SubreceptoresModel::tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPobSub)) {
            foreach ($tiposPobSub AS $tPob) {
                if ($tPob->ID_TIPOPOBLACION == 3) {
                    $TRANS = true;
                }
            }
        }
        return $TRANS;
    }

    public static function muestraTS() {
        $TS = false;
        $tiposPobSub = SubreceptoresModel::tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPobSub)) {
            foreach ($tiposPobSub AS $tPob) {
                if ($tPob->ID_TIPOPOBLACION == 2) {
                    $TS = true;
                }
            }
        }
        return $TS;
    }

    public static function muestraHSH() {
        $HSH = false;
        $tiposPobSub = SubreceptoresModel::tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPobSub)) {
            foreach ($tiposPobSub AS $tPob) {
                if ($tPob->ID_TIPOPOBLACION == 1) {
                    $HSH = true;
                }
            }
        }
        return $HSH;
    }

    public static function tiene_restricciones() {
        $res = true;
        if ($_SESSION['SESION_USUARIO']->ID_ROL == 1 OR $_SESSION['SESION_USUARIO']->ID_ROL == 2 OR $_SESSION['SESION_USUARIO']->ID_ROL == 3) {
            $res = false;
        }
        if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == 0) {
            $res = false;
        }
        return $res;
    }

    public static function todos() {
        $query = self::$sqlBaseSubreceptor." ORDER BY subreceptores.SIGLAS_SUBRECEPTOR ASC  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            array_push($consulta, self::subreceptor_todos()  );
            return $consulta;
        }
        return 0;
    }

    public static function todos_gestor() {
        $query = "SELECT subreceptores.* 
            , personas_sistema.NOMBRE_REAL_PERSONA as NOMBRE_GESTOR
                FROM subreceptores
                LEFT JOIN personas_sistema 
                ON (subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA)";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            array_push($consulta, self::subreceptor_todos()  );
            return $consulta;
        }
        return 0;
    }

    public static function todos_del_gestor($idGestor) {
        $query = "SELECT subreceptores.* 
            , personas_sistema.NOMBRE_REAL_PERSONA as NOMBRE_GESTOR
                FROM subreceptores
                LEFT JOIN personas_sistema 
                ON (subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA)
                WHERE subreceptores.ID_GESTOR = " . $idGestor . " ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            array_push($consulta, self::subreceptor_todos()  );
            return $consulta;
        }
        return 0;
    }

    public static function todos_con_provincia() {
        $query = "SELECT
                    provincias.NOMBRE_PROVINCIA
                    , subreceptores.NOMBRE_SUBRECEPTOR
                    , subreceptores.CODIGO_SUBRECEPTOR
                    , subreceptores.SIGLAS_SUBRECEPTOR
                    ,subreceptores_provincias.*
                    FROM
                    subreceptores_provincias
                    INNER JOIN subreceptores 
                        ON (subreceptores_provincias.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
                    INNER JOIN provincias 
                        ON (subreceptores_provincias.ID_PROVINCIA = provincias.ID_PROVINCIA);";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_subreceptor($idSubreceptor) {        
        if( $idSubreceptor == 0 ){
            return SubreceptoresModel::subreceptor_todos();
        }
        $query = self::$sqlBaseSubreceptor . " WHERE  subreceptores.ID_SUBRECEPTOR = " . $idSubreceptor . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datos($id) {        
        if( $id == 0 ){
            return SubreceptoresModel::subreceptor_todos();
        }        
        $query = self::$sqlBaseSubreceptor . " WHERE subreceptores.ID_SUBRECEPTOR = " . $id . "  ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function id_subreceptor($Subreceptor) {        
        $query = "SELECT ID_SUBRECEPTOR FROM subreceptores WHERE SIGLAS_SUBRECEPTOR = '" . $Subreceptor . "'; ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_SUBRECEPTOR;
        }
        return 0;
    }

    public static function datos_subreceptorProvincia($idProvinciaSubrecptor) {
        $query = "SELECT *
                FROM subreceptores_provincias WHERE ID_PROVINCIA_SUBRECEPTOR = " . $idProvinciaSubrecptor . "; ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function en_el_canton($idCanton) {
        $query = self::$sqlBaseSubreceptor . "                     
                    WHERE cantones.ID_CANTON = " . $idCanton . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function en_la_provincia($idProvincia) {
        $query = self::$sqlBaseSubreceptor . "                     
                    WHERE provincias.ID_PROVINCIA = " . $idProvincia . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function subreceptores_asociados_a_la_provincia($idProvincia) {
        $query = self::$sqlBaseSubreceptor . " 
                    INNER JOIN  subreceptores_provincias
                        ON ( subreceptores_provincias.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR )
                    INNER JOIN provincias as prov2 
                        ON (subreceptores_provincias.ID_PROVINCIA = prov2.ID_PROVINCIA) 
                    WHERE prov2.ID_PROVINCIA = " . $idProvincia . " ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function subreceptorProvincia($idSubreceptor, $idProvincia) {
        $query = "
            INSERT INTO subreceptores_provincias
            (
             ID_SUBRECEPTOR,
             ID_PROVINCIA)
            VALUES (
                    $idSubreceptor,
                    $idProvincia);
                    ";

        return self::crear_ultimo_id($query);
    }

    public static function insertar_lugares($idSubreceptor, $idtipo) {
        $query = "INSERT INTO subreceptores_tipo_poblacion
            (ID_SUBRECEPTOR,
             ID_TIPOPOBLACION)
            VALUES ($idSubreceptor,
                   $idtipo)";

        return self::crear_ultimo_id($query);
    }

    public static function borrar_tipo_poblacion($id) {
        $query = "DELETE 
                    FROM subreceptores_tipo_poblacion
                    WHERE ID_SUBRECEPTOR= $id";
        return self::modificarRegistros($query);
    }

    public static function updateProvincia($idsubpro, $idSubreceptor, $idProvincia) {
        $query = "
            UPDATE subreceptores_provincias
            SET 
              ID_SUBRECEPTOR = $idSubreceptor,
              ID_PROVINCIA = $idProvincia
            WHERE ID_PROVINCIA_SUBRECEPTOR = $idsubpro";

        return self::crear_ultimo_id($query);
    }

    public static function update($id, 
            $CODIGO_SUBRECEPTOR, $SIGLAS_SUBRECEPTOR, $NOMBRE_SUBRECEPTOR, $EDAD_MINIMA, $EDAD_MAXIMA, $MAX_CONDONES_ENTREGA, $GESTOR,
            $PROVINCIA_SUBRECEPTOR,$CANTON_SUBRECEPTOR,$DIRECCION_SUBRECEPTOR,
            $TELEFONO_SUBRECEPTOR,$CONTACTO_SUBRECEPTOR,
            $SITIOWEB_SUBRECEPTOR,$LOGO_SUBRECEPTOR,
            $LATITUD_SUBRECEPTOR,$LONGITUD_SUBRECEPTOR
            ) {
        if ($EDAD_MAXIMA == "") {
            $EDAD_MAXIMA = "NULL";
        }
        if ($EDAD_MINIMA == "") {
            $EDAD_MINIMA = "NULL";
        }
        $query = " UPDATE subreceptores
                    SET 
                      CODIGO_SUBRECEPTOR = $CODIGO_SUBRECEPTOR,
                      NOMBRE_SUBRECEPTOR = '" . $NOMBRE_SUBRECEPTOR . "',
                      SIGLAS_SUBRECEPTOR = '" . $SIGLAS_SUBRECEPTOR . "',
                      EDAD_MINIMA = $EDAD_MINIMA ,
                      EDAD_MAXIMA = $EDAD_MAXIMA ,
                      MAX_CONDONES_ENTREGA = $MAX_CONDONES_ENTREGA ,
                      ID_GESTOR = $GESTOR ,
                      LATITUD_SUBRECEPTOR = '" . $LATITUD_SUBRECEPTOR . "',
                      LONGITUD_SUBRECEPTOR = '" . $LONGITUD_SUBRECEPTOR . "',
                      PROVINCIA_SUBRECEPTOR = '" . $PROVINCIA_SUBRECEPTOR . "',
                      CANTON_SUBRECEPTOR = '" . $CANTON_SUBRECEPTOR . "',
                      DIRECCION_SUBRECEPTOR = '" . $DIRECCION_SUBRECEPTOR . "',
                      TELEFONO_SUBRECEPTOR = '" . $TELEFONO_SUBRECEPTOR . "',
                      CONTACTO_SUBRECEPTOR = '" . $CONTACTO_SUBRECEPTOR . "',
                      SITIOWEB_SUBRECEPTOR = '" . $SITIOWEB_SUBRECEPTOR . "',
                      LOGO_SUBRECEPTOR = '" . $LOGO_SUBRECEPTOR . "', 
                      FECHA_MODIFICACION = CURRENT_TIMESTAMP
                    WHERE ID_SUBRECEPTOR = $id";

        return self::modificarRegistros($query);
    }

    public static function datos_gestor($id) {
        $query = "SELECT
    personas_sistema.*
    , gestor_subreceptores.*
    , subreceptores.*
    FROM
    gestor_subreceptores
    LEFT JOIN personas_sistema 
        ON (gestor_subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA)
    LEFT JOIN subreceptores 
        ON (gestor_subreceptores.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
    WHERE subreceptores.ID_SUBRECEPTOR = " . $id . "  ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function insertar($ID_GESTOR, $SUBRECEPTOR) {
        $query = "  INSERT INTO gestor_subreceptores
            (
             ID_GESTOR,
             ID_SUBRECEPTOR,
             FECHA_CREACION)
                VALUES ($ID_GESTOR,
                        $SUBRECEPTOR, 
                        CURRENT_TIMESTAMP)";
        return self::crear_ultimo_id($query);
    }

    public static function tipos_poblacion($id) {
        $query = "SELECT
                    tipo_poblacion.*
                FROM
                    subreceptores
                    LEFT JOIN subreceptores_tipo_poblacion 
                        ON (subreceptores.ID_SUBRECEPTOR = subreceptores_tipo_poblacion.ID_SUBRECEPTOR)
                    LEFT JOIN tipo_poblacion 
                        ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
                    WHERE subreceptores_tipo_poblacion.ID_SUBRECEPTOR = '" . $id . "'";

        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function tipos_poblacion_asociados($id) {
        $query = "SELECT
                    tipo_poblacion.*
                FROM
                    subreceptores
                    LEFT JOIN subreceptores_tipo_poblacion 
                        ON (subreceptores.ID_SUBRECEPTOR = subreceptores_tipo_poblacion.ID_SUBRECEPTOR)
                    LEFT JOIN tipo_poblacion 
                        ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
                    WHERE subreceptores_tipo_poblacion.ID_SUBRECEPTOR = '" . $id . "'";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function tipos_poblacion_todos() {
        $query = "SELECT tipo_poblacion.*,
            subreceptores.*
                FROM
                    subreceptores
                    LEFT JOIN subreceptores_tipo_poblacion 
                    ON (subreceptores.ID_SUBRECEPTOR = subreceptores_tipo_poblacion.ID_SUBRECEPTOR)
                    LEFT JOIN tipo_poblacion  
                    ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) ";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function id_tipos_poblacion($id) {
        $query = "SELECT
                    tipo_poblacion.*
                FROM
                    subreceptores
                    LEFT JOIN subreceptores_tipo_poblacion 
                        ON (subreceptores.ID_SUBRECEPTOR = subreceptores_tipo_poblacion.ID_SUBRECEPTOR)
                    LEFT JOIN tipo_poblacion 
                        ON (subreceptores_tipo_poblacion.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
                    WHERE subreceptores_tipo_poblacion.ID_SUBRECEPTOR = '" . $id . "'";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function subreceptor_todos() {
        $subReceptor = NULL;
        $subReceptor->ID_SUBRECEPTOR = 0;
        $subReceptor->SIGLAS_SUBRECEPTOR = 'TODOS';
        $subReceptor->NOMBRE_SUBRECEPTOR = 'Todos los Subreceptores';
        $subReceptor->CODIGO_SUBRECEPTOR = 'TODOS';
        $subReceptor->NOMBRE_GESTOR = '';
        $subReceptor->EDAD_MINIMA = 0;
        $subReceptor->EDAD_MAXIMA = 0;
        $subReceptor->ID_GESTOR = 0;
        $subReceptor->LATITUD_SUBRECEPTOR = 0;
        $subReceptor->LONGITUD_SUBRECEPTOR = 0;
        $subReceptor->PROVINCIA_SUBRECEPTOR = 0;
        $subReceptor->CANTON_SUBRECEPTOR = 0;
        $subReceptor->DIRECCION_SUBRECEPTOR = 0;
        $subReceptor->TELEFONO_SUBRECEPTOR = 0;
        $subReceptor->CONTACTO_SUBRECEPTOR = 0;
        $subReceptor->SITIOWEB_SUBRECEPTOR = 0;
        $subReceptor->LOGO_SUBRECEPTOR = 'archivos/logos/logo_kimirina_azul.png';
        return $subReceptor;
    }

}
