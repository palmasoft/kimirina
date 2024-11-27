<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PersonasSistemaModel extends ModelBase {

    public static $sqlBase = "
            SELECT
                 cantones.NOMBRE_CANTON
                , cantones.OBSERVACIONES_CANTON    
                , provincias.ID_PROVINCIA  
                , provincias.NOMBRE_PROVINCIA
                , provincias.OBSERVACIONES_PROVINCIA    
                , usuarios.NICK
                , tipo_usuario.ID_ROL
                , tipo_usuario.CODIGO_ROL
                , tipo_usuario.NOMBRE_ROL
                , tipo_poblacion.ID_TIPOPOBLACION
                , tipo_poblacion.CODIGO_TIPOPOBLACION
                , tipo_poblacion.NOMBRE_TIPOPOBLACION
                , tipo_poblacion.ALIAS_TIPOPOBLACION
                , p1.NOMBRE_REAL_PERSONA AS NOMBRE_JEFE
                , p1.TELEFONO_PERSONA AS TELEFONO_JEFE
                , p1.CORREO_PERSONA AS CORREO_JEFE
                , subreceptores.CODIGO_SUBRECEPTOR
                , subreceptores.NOMBRE_SUBRECEPTOR
                , subreceptores.SIGLAS_SUBRECEPTOR
                , personas_sistema.*
            FROM
                personas_sistema
                LEFT JOIN tipo_poblacion 
                    ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) 
                LEFT JOIN usuarios
                    ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
                LEFT JOIN tipo_usuario 
                    ON (tipo_usuario.ID_ROL = personas_sistema.ID_ROL_TIPOUSUARIO) 
                LEFT JOIN personas_sistema AS p1
		            ON (personas_sistema.PERTENECE_A_ID = p1.ID_PERSONA) 
                LEFT JOIN cantones 
                    ON (personas_sistema.CANTON_PERSONA = cantones.ID_CANTON)
                LEFT JOIN provincias 
                    ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
                LEFT JOIN subreceptores 
                   ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
        ";
       
    public static $filtroActivo = " personas_sistema.ACTIVO = 'SI' ";
    public static $filtroSR = " AND personas_sistema.ID_SUBRECEPTOR = ";

    public static function todos() {
        $query = self::$sqlBase . " WHERE " . self::$filtroActivo . "  ";
        if (SubreceptoresModel::tiene_restricciones()) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }        
//        echo $query;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static $sqlPersona = "
		SELECT
                    personas_sistema.*
                    , tipo_usuario.CODIGO_ROL
                    , tipo_usuario.NOMBRE_ROL
                FROM
                    personas_sistema
                    INNER JOIN tipo_usuario 
                        ON (personas_sistema.ID_ROL_TIPOUSUARIO = tipo_usuario.ID_ROL)
	";

    public static function personas_en_idTipoPersona($ID_ROL_TIPOUSUARIO) {
        $query = self::$sqlBase . " WHERE " . self::$filtroActivo . " AND personas_sistema.ID_ROL_TIPOUSUARIO = " . $ID_ROL_TIPOUSUARIO . " ";
        if (SubreceptoresModel::tiene_restricciones() && !UsuariosModel::esGestor() ) {
            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
        }    
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function insertar($tipoUsuario, $tipoPoblacion, $canton, $nombreReal, $nombreOtro, $identificacion, $telefono, $correo, $direccion, $fechaNacimiento, $observaciones, $perteneceA, $subreceptor) {
        $query = "
                insert into personas_sistema (
                     ID_ROL_TIPOUSUARIO,
                     ID_TIPOPOBLACION,
                     CANTON_PERSONA,
                     NOMBRE_REAL_PERSONA,
                     NOMBRE_OTRO_PERSONA,
                     IDENTIFICACION_PERSONA,
                     TELEFONO_PERSONA,
                     CORREO_PERSONA,
                     DIRECCION_PERSONA,
                     FECHA_BIRTH_PERSONA,
                     OBSERVACIONES_PERSONA,
                     PERTENECE_A_ID,
                     ID_SUBRECEPTOR)
                     values (" . $tipoUsuario . ", " . ($tipoPoblacion == "" ? "NULL" : $tipoPoblacion) . ", " . $canton . ",'" . $nombreReal . "', '" . $nombreOtro . "',  '" .
                $identificacion . "','" . $telefono . "','" . $correo . "','" . $direccion . "','" . $fechaNacimiento . "', '" .
                $observaciones . "', " . ($perteneceA == "" ? "NULL" : $perteneceA ) . ", " . ($subreceptor == "" ? "NULL" : $subreceptor) . ")";

        return self::crear_ultimo_id($query);
    }

    public static function asociar_usuario_persona($idUsuario, $idPersona) {
        $query = "
                UPDATE personas_sistema 
                SET ID_USUARIO = $idUsuario
                WHERE personas_sistema.ID_PERSONA = " . $idPersona;

        return self::modificarRegistros($query);
    }

    public static function updateUsuario($id, $tipoUsuario, $nombreReal, $correo, $perteneceA, $subreceptor) {
        $query = ' 
                update personas_sistema 
                        set 
                        ID_ROL_TIPOUSUARIO =  ' . $tipoUsuario . ' , 
                        NOMBRE_REAL_PERSONA = " ' . htmlspecialchars($nombreReal) . ' ",                        
                        CORREO_PERSONA =  "' . $correo . '",
                        PERTENECE_A_ID =' . $perteneceA . ',
                        ID_SUBRECEPTOR = ' . $subreceptor . ',
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP
                where ID_USUARIO= ' . $id . '';
        return self::modificarRegistros($query);
    }

    public static function update($id, $tipoUsuario, $tipoPoblacion, $canton, $nombreReal, $nombreOtro, $identificacion, $telefono, $correo, $direccion, $fechaNacimiento, $observaciones, $perteneceA, $subreceptor) {
        $query = " 
                update personas_sistema 
                        set
                        ID_ROL_TIPOUSUARIO = " . $tipoUsuario . " , 
                        ID_TIPOPOBLACION = " . ($tipoPoblacion == "" ? "NULL" : $tipoPoblacion) . " , 
                        CANTON_PERSONA = " . $canton . " , 
                        NOMBRE_REAL_PERSONA = '" . $nombreReal . "' ,                        
                        NOMBRE_OTRO_PERSONA = '" . $nombreOtro . "',
                        IDENTIFICACION_PERSONA = '" . $identificacion . "',
                        TELEFONO_PERSONA ='" . $telefono . "',
                        CORREO_PERSONA ='" . $correo . "',
                        DIRECCION_PERSONA ='" . $direccion . "',
                        FECHA_BIRTH_PERSONA ='" . $fechaNacimiento . "',
                        OBSERVACIONES_PERSONA ='" . $observaciones . "',
                        PERTENECE_A_ID =" . ($perteneceA == "" ? "NULL" : $perteneceA ) . ",
                        ID_SUBRECEPTOR = " . ($subreceptor == "" ? "NULL" : $subreceptor) . ",
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP 
                where ID_PERSONA = " . $id . " ";
        return self::modificarRegistros($query);
    }

    public static function update_perfil($id, $nombreReal, $nombreOtro, $identificacion, $telefono, $correo, $direccion, $fechaNacimiento, $observaciones) {
        $query = " 
                update personas_sistema 
                        set
                        NOMBRE_REAL_PERSONA = '" . $nombreReal . "' ,                        
                        NOMBRE_OTRO_PERSONA = '" . $nombreOtro . "',
                        IDENTIFICACION_PERSONA = '" . $identificacion . "',
                        TELEFONO_PERSONA ='" . $telefono . "',
                        CORREO_PERSONA ='" . $correo . "',
                        DIRECCION_PERSONA ='" . $direccion . "',
                        FECHA_BIRTH_PERSONA ='" . $fechaNacimiento . "',
                        OBSERVACIONES_PERSONA ='" . $observaciones . "',
                        FECHA_MODIFICACION = CURRENT_TIMESTAMP 
                where ID_PERSONA = " . $id . " ";
        return self::modificarRegistros($query);
    }

    public static function eliminar($id) {
        $query = " update personas_sistema set ACTIVO = 'NO' , FECHA_ELIMINACION = CURRENT_TIMESTAMP where ID_PERSONA = " . $id . "  ";
        return self::modificarRegistros($query);
    }

    public static function datos($id) {
        $query = self::$sqlBase . " where personas_sistema.ID_PERSONA = '" . $id . "' AND personas_sistema.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function datosUser($id) {
        $query = self::$sqlBase . " where personas_sistema.ID_USUARIO = '" . $id . "' AND personas_sistema.ACTIVO = 'SI' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }

    public static function personaID($nombre) {
        $query = "SELECT ID_PERSONA FROM personas_sistema WHERE NOMBRE_REAL_PERSONA = '" . $nombre . "' AND  ACTIVO = 'SI'";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0]->ID_PERSONA;
        }
        return 0;
    }

}
