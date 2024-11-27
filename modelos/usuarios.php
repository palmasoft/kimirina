<?php

class UsuariosModel extends ModelBase {

    public static $sqlBase = "
                SELECT
                    tipo_poblacion.*
                    , tipo_usuario.*
                    , personas_sistema.*
                    , subreceptores.*
                    , usuarios.*
                    , (AES_DECRYPT( usuarios.PASSWORD, 'sinap_kimirina')) AS CLAVE_DECODIFICADA
                FROM
                    usuarios
                    LEFT JOIN personas_sistema
                        ON (personas_sistema.ID_USUARIO = usuarios.ID_USUARIO)
                    LEFT JOIN tipo_usuario 
                        ON (personas_sistema.ID_ROL_TIPOUSUARIO = tipo_usuario.ID_ROL)
                    LEFT JOIN subreceptores 
                        ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
                    LEFT JOIN tipo_poblacion 
                        ON (personas_sistema.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
    ";

    public static function todos() {
        $query = self::$sqlBase;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function permisos($id_usuario) {
        $query = 'SELECT
    funciones_sistema.TITULO_MENU,
    permisos_usuario.*
    FROM
    permisos_usuario
    LEFT JOIN funciones_sistema 
        ON (permisos_usuario.ID_MENU = funciones_sistema.ID_MENU)
        WHERE permisos_usuario.ID_USUARIO = ' . $id_usuario . ' GROUP BY funciones_sistema.ID_MENU ORDER BY funciones_sistema.ORDEN ASC';
        $consulta = self::consulta($query);

        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function esUsuario($nick, $pass) {
        $query = self::$sqlBase . " WHERE ( usuarios.PASSWORD = AES_ENCRYPT('" . $pass . "','" . self::$config->get("passEncript") . "') 
                   AND usuarios.NICK = '" . $nick . "' AND usuarios.ESTADO = 'ACTIVO' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function esUsuarioCedula($cedula) {
        $query = self::$sqlBase . " WHERE ( usuarios.PASSWORD = AES_ENCRYPT('" . $pass . "','" . self::$config->get("passEncript") . "') 
                   AND usuarios.NICK = '" . $nick . "' AND usuarios.ESTADO = 'ACTIVO' )";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }

    public static function validar_datos_usuario($nick, $pass) {

        $query = " select * from usuarios WHERE NICK = '" . $nick . "' ";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            $query = "select * from usuarios  WHERE NICK = '" . $nick . "'  AND ESTADO = 'ACTIVO' ";
            $consulta = self::consulta($query);
            if (count($consulta) > 0) {
                $query = "select * FROM usuarios WHERE ( PASSWORD = AES_ENCRYPT( '" . $pass . "', '" . self::$config->get("passEncript") . "' ) 
                            AND NICK = '" . $nick . "'); ";
                $consulta = self::consulta($query);
                if (count($consulta) > 0) {
                    return "CORRECTO";
                } else {
                    return "ERROR_CLAVE";
                }
            } else {
                return "ERROR_NOMBRE_INACTIVO";
            }
        } else {
            return "ERROR_NOMBRE";
        }
    }

    public static function datos_del_usuario($idUsuario) {
        $query = self::$sqlBase . " WHERE usuarios.ID_USUARIO = " . $idUsuario . " ";
        $consulta = self::consulta($query);
        return $consulta[0];
    }

    public static function actualizar_fechavisita($idUsuario) {
        $query = "
            UPDATE usuarios SET usuarios.ULTIMA_VISITA = SYSDATE()  
            WHERE usuarios.ID_USUARIO = " . $idUsuario . " ; ";
        return self::modificarRegistros($query);
    }

    public static function actualizar_ultima_ip($idUsuario) {
        $query = "
            UPDATE usuarios  SET  usuarios.ULTIMA_DIRECCION_IP = '" . self::ipUsuario() . "' 
            WHERE usuarios.ID_USUARIO = " . $idUsuario . " ;";
        return self::modificarRegistros($query);
    }

    public static function registrar_entrada($idUsuario, $idPersona = NULL) {
        $query = " 
        INSERT INTO usuarios_log ( SESION_USUARIOLOG, TIPO_USUARIOLOG,  USUARIO_USUARIOLOG, PERSONA_USUARIOLOG, IP_USUARIOLOG ) 
        VALUES  (  '" . session_id() . "', 'ENTRADA', " . $idUsuario . "," . $idPersona . ", '" . self::ipUsuario() . "'  )";
        return self::modificarRegistros($query);
    }
    public static function registrar_salida($idUsuario, $idPersona = NULL) {
        $query = " 
        INSERT INTO usuarios_log ( SESION_USUARIOLOG, TIPO_USUARIOLOG,  USUARIO_USUARIOLOG, PERSONA_USUARIOLOG,  IP_USUARIOLOG ) 
        VALUES  (  '" . session_id() . "',  'SALIDA', " . $idUsuario . ", " . $idPersona . ", '" . self::ipUsuario() . "'  )";
        return self::modificarRegistros($query);
    }

    public static function ipUsuario() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }

    public static function nuevoSinFoto($NICK, $PASSWORD, $EMAIL) {
        $config = Config::singleton();
        $query = "            
            INSERT INTO usuarios
            (NICK,
             PASSWORD,
             EMAIL )
                VALUES (
                        '$NICK',
                        AES_ENCRYPT('" . $PASSWORD . "','" . $config->get("passEncript") . "'),
                        '$EMAIL' )";
        return self::crear_ultimo_id($query);
    }

    public static function editarSinFoto($ID_USUARIO, $NICK, $PASSWORD, $EMAIL) {
        $config = Config::singleton();
        $query = "
            UPDATE usuarios
            SET 
              NICK = '$NICK',
              PASSWORD = AES_ENCRYPT('" . $PASSWORD . "','" . $config->get("passEncript") . "'),
              EMAIL = '$EMAIL'
            WHERE ID_USUARIO = $ID_USUARIO  ";
        return self::modificarRegistros($query);
    }

    public static function insertarPermisos($ID_USUARIO, $ID_MENU) {
        $query = "            
            INSERT INTO permisos_usuario
            ( ID_USUARIO,
             ID_MENU)
                VALUES (
                $ID_USUARIO,
                        $ID_MENU)";

        return self::crear_ultimo_id($query);
    }

    public static function eliminarPermisos($ID_USUARIO) {
        $query = "DELETE
                FROM permisos_usuario
                WHERE ID_USUARIO = '$ID_USUARIO'";
        return self::modificarRegistros($query);
    }

    function listado() {
        //realizamos la consulta de todos los items
        return self::consulta('SELECT * FROM usuarios');
    }

    function getNombreUsuario($id) {
        $query = 'SELECT NOMBRE FROM usuarios WHERE ID_USUARIO="' . $id . '"';
        $consulta = self::consulta($query);
        return $consulta[0]->NOMBRE;
    }

    function getNickUsuario($id) {
        $query = 'SELECT NICK FROM usuarios WHERE ID_USUARIO="' . $id . '"';
        $consulta = self::consulta($query);
        return $consulta[0]->NICK;
    }

    function obtenerContrasenaNick($nick) {
        $config = Config::singleton();
        $query = "
			SELECT AES_DECRYPT( 
			(SELECT usuarios.PASSWORD FROM usuarios WHERE NICK = '" . $nick . "' ),
			 '" . $config->get("passEncript") . "' 
			) AS decoded";
        $consulta = self::consulta($query);
        return $consulta[0]->decoded;
    }

    function obtenerContrasenaId($id) {
        $config = Config::singleton();
        $query = "
			SELECT AES_DECRYPT( 
			(SELECT usuarios.PASSWORD FROM usuarios WHERE ID_USUARIO = '" . $id . "' ),
			 '" . $config->get("passEncript") . "' 
			) AS decoded";
        $consulta = self::consulta($query);
        return $consulta[0]->decoded;
    }

    function getUsuarioTodoModulos() {
        $query = 'SELECT *
                  FROM usuariosmodulos LEFT JOIN tbl_modulos
                  ON  usuariosmodulos.pk_fk_k_idm = tbl_modulos.pk_k_id 
				  ORDER BY tbl_modulos.pk_k_id';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getUsuarioModulos($id) {
        $query = 'SELECT *
                  FROM usuariosmodulos LEFT JOIN tbl_modulos
                  ON usuariosmodulos.pk_fk_k_idu =' . $id . ' AND usuariosmodulos.pk_fk_k_idm = tbl_modulos.pk_k_id WHERE usuariosmodulos.pk_fk_k_idu =' . $id . ' ORDER BY tbl_modulos.pk_k_id';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getUsuarioMenSup($id) {
        $query = 'SELECT *
                  FROM usuariosmenus LEFT JOIN tbl_menus
                  ON usuariosmenus.pk_fk_k_idu =' . $id . ' AND usuariosmenus.pk_fk_k_idmen = tbl_menus.pk_k_id WHERE usuariosmenus.pk_fk_k_idu =' . $id . ' AND ISNULL(tbl_menus.k_idpadre)';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getUsuarioTodoMenuSup() {
        $query = 'SELECT * FROM tbl_menus WHERE ISNULL(k_idpadre) ORDER BY tbl_menus.pk_k_id ASC ';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getUsuarioAllMenParent($id) {
        $query = 'SELECT *
                  FROM usuariosmenus LEFT JOIN tbl_menus
                  ON usuariosmenus.pk_fk_k_idu =' . $id . ' AND usuariosmenus.pk_fk_k_idmen = tbl_menus.pk_k_id 
				  WHERE usuariosmenus.pk_fk_k_idu =' . $id . ' AND tbl_menus.s_accionmenu IS NOT NULL 
				  ORDER BY tbl_menus.pk_k_id ASC';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getAllUsuarios() {
        $query = 'SELECT * FROM usuarios';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getUsuarioAllSubMen($id) {
        $query = 'SELECT *
                  FROM usuariosmenus LEFT JOIN tbl_menus
                  ON usuariosmenus.pk_fk_k_idu =' . $id . ' AND usuariosmenus.pk_fk_k_idmen = tbl_menus.pk_k_id 
				  WHERE usuariosmenus.pk_fk_k_idu =' . $id . ' AND tbl_menus.k_idpadre IS NOT NULL 
				  ORDER BY tbl_menus.pk_k_id ASC';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function getNombresUsuario() {
        $query = 'SELECT ID_USUARIO, NOMBRE FROM usuarios';
        $consulta = self::consulta($query);
        return $consulta;
    }

    function nuevo($nombre, $nick, $pass, $email, $tel, $foto, $estado) {
        $config = Config::singleton();
        $query = "INSERT INTO usuarios ( ID_USUARIO ,NOMBRE, NICK, PASSWORD, EMAIL, TELEFONO, URL_FOTO, ESTADO ) VALUES(NULL, '"
                . $nombre . "', '" . $nick . "', AES_ENCRYPT('" . $pass . "','" . $config->get("passEncript") . "'), '" . $email . "', '" . $tel . "', '" . $foto . "', '" . $estado . "' )";
        return self::$crear_ultimo_id($query);
    }

    function editar($id, $nombre, $nick, $pass, $email, $tel, $foto, $estado) {
        $config = Config::singleton();
        $query = "UPDATE usuarios  SET  NOMBRE = '"
                . $nombre . "', NICK = '" . $nick . "', PASSWORD = (AES_ENCRYPT('" . $pass . "','" . $config->get("passEncript") . "')), EMAIL = '" . $email . "', TELEFONO = '" . $tel . "', URL_FOTO = '" . $foto . "', ESTADO = '" . $estado . "' WHERE ID_USUARIO = " . $id . " LIMIT 1";
        return self::$modificarRegistros($query);
    }

    function borrar($id) {
        $query = "DELETE FROM usuarios WHERE ID_USUARIO = " . $id;
        self::$modificarRegistros($query);
    }

    function desactivar($id) {
        $query = "update usuarios set ESTADO = 'INACTIVO' where ID_USUARIO = $id";
        return self::modificarRegistros($query);
    }

    function activar($id) {
        $query = "update usuarios set ESTADO = 'ACTIVO' where ID_USUARIO = $id";
        return self::modificarRegistros($query);
    }

    public static function tiene_restricciones() {
        return ($_SESSION['SESION_USUARIO']->ID_ROL == 1 OR $_SESSION['SESION_USUARIO']->ID_ROL == 2 OR $_SESSION['SESION_USUARIO']->ID_ROL == 3 ) ? false : true;
    }

    public static function noTieneRestricciones() {
        return ($_SESSION['SESION_USUARIO']->ID_ROL == 1 OR $_SESSION['SESION_USUARIO']->ID_ROL == 2 OR $_SESSION['SESION_USUARIO']->ID_ROL == 3 ) ? TRUE : FALSE;
    }

    public static function esGestor() {
        if ($_SESSION['SESION_USUARIO']->ID_ROL == 5) {
            return true;
        }
        return false;
    }

    public static function cambiar_subreceptor_usuario($Subreceptor) {
        $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR = $Subreceptor->ID_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->CODIGO_SUBRECEPTOR = $Subreceptor->CODIGO_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->NOMBRE_SUBRECEPTOR = $Subreceptor->NOMBRE_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR = $Subreceptor->SIGLAS_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->EDAD_MINIMA = $Subreceptor->EDAD_MINIMA;
        $_SESSION['SESION_USUARIO']->EDAD_MAXIMA = $Subreceptor->EDAD_MAXIMA;
        $_SESSION['SESION_USUARIO']->ID_GESTOR = $Subreceptor->ID_GESTOR;
        $_SESSION['SESION_USUARIO']->LATITUD_SUBRECEPTOR = $Subreceptor->LATITUD_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->LONGITUD_SUBRECEPTOR = $Subreceptor->LONGITUD_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->PROVINCIA_SUBRECEPTOR = $Subreceptor->PROVINCIA_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->CANTON_SUBRECEPTOR = $Subreceptor->CANTON_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->DIRECCION_SUBRECEPTOR = $Subreceptor->DIRECCION_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->TELEFONO_SUBRECEPTOR = $Subreceptor->TELEFONO_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->CONTACTO_SUBRECEPTOR = $Subreceptor->CONTACTO_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->SITIOWEB_SUBRECEPTOR = $Subreceptor->SITIOWEB_SUBRECEPTOR;
        $_SESSION['SESION_USUARIO']->LOGO_SUBRECEPTOR = $Subreceptor->LOGO_SUBRECEPTOR;

        return $Subreceptor;
    }

}
