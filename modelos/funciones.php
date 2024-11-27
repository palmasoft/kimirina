<?php

class FuncionesModel extends ModelBase {

    public static function todos_modulos() {
        $query = 'SELECT * FROM modulos_sistema WHERE ESTADO="ACTIVO" ORDER BY ORDEN ASC ';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_modulos_del_usuario($id_usuario) {
        $query = " 
            SELECT modulos_sistema.* FROM permisos_usuario 
            LEFT JOIN funciones_sistema ON ( permisos_usuario.ID_MENU = funciones_sistema.ID_MENU )
            LEFT JOIN  modulos_sistema ON ( funciones_sistema.ID_MODULO = modulos_sistema.ID_MODULO )
            WHERE  permisos_usuario.ID_USUARIO = " . $id_usuario . "  GROUP BY modulos_sistema.ID_MODULO ORDER BY modulos_sistema.ORDEN 
                ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function funciones_del_modulo($ID_MODULO) {
        $query = 'SELECT * FROM funciones_sistema WHERE ID_MODULO = ' . $ID_MODULO . ' ORDER BY ID_MODULO ASC,  ORDEN ASC  ';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todos_menus_modulo($ID_MODULO) {
        $MENUS = array();
        $menus_padres_modulo = self::menus_padres_del_modulo($ID_MODULO);
        foreach ($menus_padres_modulo as $menu) {
            $menu->SUBMENU = self::submenus_menu($menu);
            array_push($MENUS, $menu);
        }
        return $MENUS;
    }

    public static function todos_submenus_menu($menu) {
        $SUBMENUS = array();
        $menuHijos = self::menus_hijos_menu($menu->ID_MENU);
        if (count($menuHijos) > 0) {
            foreach ($menuHijos as $subMenu) {
                $subMenu->SUBMENU = self::submenus_menu($subMenu);
                array_push($SUBMENUS, $subMenu);
            }
        }
        return $SUBMENUS;
    }

    public static function todas_funciones() {
        $query = 'SELECT * FROM funciones_sistema ORDER BY ID_MODULO ASC, ORDEN ASC  ';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function todas_funciones_usuario($id_usuario) {
        $query = 'SELECT funciones_sistema.* FROM permisos_usuario 
LEFT JOIN funciones_sistema ON ( permisos_usuario.ID_MENU = funciones_sistema.ID_MENU )
WHERE  permisos_usuario.ID_USUARIO = ' . $id_usuario . ' GROUP BY funciones_sistema.ID_MENU ORDER BY funciones_sistema.ORDEN ASC';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function getModulo($id) {
        $query = 'SELECT * FROM modulos_sistema WHERE ID_MODULO = "' . $id . '"';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function getNombreModulo($id) {
        $query = 'SELECT NOMBRE_MODULO, TITULO_MODULO FROM modulos_sistema WHERE ID_MODULO="' . $id . '"';
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function nuevo($nombre, $titulo, $accion, $fotofondo, $fotoalt) {
        //$config = Config::singleton();
        $query = "INSERT INTO modulos_sistema ( ID_MODULO ,NOMBRE_MODULO, TITULO_MODULO, ACCION_MODULO, IMAGEN_PRINCIPAL_MODULO, IMAGEN_ALTERNATIVA_MODULO ) VALUES(NULL, '"
                . $nombre . "', '" . $titulo . "','" . $accion . "' ,'" . $fotofondo . "', '" . $fotoalt . "')";
        return self::crear_ultimo_id($query);
    }

    public static function editar($id, $nombre, $titulo, $accion, $fotofondo, $fotoalt) {
        //$config = Config::singleton(); 
        $query = "UPDATE modulos_sistema SET  NOMBRE_MODULO = '" . $nombre . "', TITULO_MODULO = '" . $titulo . "', ACCION_MODULO = '" . $accion . "', IMAGEN_PRINCIPAL_MODULO = '" . $fotofondo . "', IMAGEN_ALTERNATIVA_MODULO = '" . $fotoalt . "' WHERE ID_MODULO = " . $id . " LIMIT 1";
        return self::modificarRegistros($query);
    }

    public static function borrar($id) {
        $query = "DELETE FROM modulos_sistema WHERE ID_MODULO = " . $id;
        self::modificarRegistros($query);
    }

    public static function funciones_usuario($idUsuario) {
        $vModulosFunciones = array();
        $modulos = self::todos_modulos_del_usuario($idUsuario);
        foreach ($modulos as $modulo) {
            $modulo->MENUS = self::menus_modulo_usuario($modulo, $idUsuario);
            array_push($vModulosFunciones, $modulo);
        }
        return $vModulosFunciones;
    }

    public static function funciones_superusuario() {
        $vModulosFunciones = array();
        $modulos = self::todos_modulos();
        foreach ($modulos as $modulo) {
            $modulo->MENUS = self::menus_modulo($modulo);
            array_push($vModulosFunciones, $modulo);
        }
        return $vModulosFunciones;
    }

    public static function menus_modulo_usuario($modulo, $usuario) {
        $MENUS = array();
        $menus_padres_modulo = self::menus_padres_del_usuario($modulo->ID_MODULO, $usuario);
        //print_r($menus_padres_modulo);
        foreach ($menus_padres_modulo as $menu) {
            $menu->SUBMENU = self::submenus_menu_usuario($menu, $usuario);
            array_push($MENUS, $menu);
        }
        return $MENUS;
    }

    public static function menus_modulo($modulo) {
        $MENUS = array();
        $menus_padres_modulo = self::menus_padres_del_modulo($modulo->ID_MODULO);
        foreach ($menus_padres_modulo as $menu) {
            $menu->SUBMENU = self::submenus_menu($menu);
            array_push($MENUS, $menu);
        }
        return $MENUS;
    }

    public static function menus_usuario($modulo, $usuario) {
        $MENUS = array();
        $menus_padres_modulo = self::menus_padres_del_modulo($modulo->ID_MODULO);
        foreach ($menus_padres_modulo as $menu) {
            $menu->SUBMENU = self::submenus_menu($menu, $usuario);
            array_push($MENUS, $menu);
        }
        return $MENUS;
    }

    public static function submenus_menu_usuario($menu, $usuario) {
        $SUBMENUS = array();
        $menuHijos = self::menus_hijos_menu_usuario($menu->ID_MENU, $usuario);
        if (count($menuHijos) > 0) {
            foreach ($menuHijos as $subMenu) {
                $subMenu->SUBMENU = self::submenus_menu_usuario($subMenu, $usuario);
                array_push($SUBMENUS, $subMenu);
            }
        }
        return $SUBMENUS;
    }

    public static function submenus_menu($menu) {
        $SUBMENUS = array();
        $menuHijos = self::menus_hijos_menu($menu->ID_MENU);
        if (count($menuHijos) > 0) {
            foreach ($menuHijos as $subMenu) {
                $subMenu->SUBMENU = self::submenus_menu($subMenu);
                array_push($SUBMENUS, $subMenu);
            }
        }
        return $SUBMENUS;
    }

    public static function menus_padres_del_usuario($id_modulo, $id_usuario) {
        $query = "
            SELECT funciones_sistema.* 
            FROM permisos_usuario 
            LEFT JOIN funciones_sistema ON ( permisos_usuario.ID_MENU = funciones_sistema.ID_MENU )
            WHERE  funciones_sistema.ID_MENU_PADRE = 0 AND funciones_sistema.ID_MODULO = '$id_modulo' "
                . "AND  permisos_usuario.ID_USUARIO = '$id_usuario' "
                . "GROUP BY funciones_sistema.ID_MENU ORDER BY funciones_sistema.ORDEN ASC ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function menus_padres_del_modulo($ID_MODULO) {
        $query = "
            SELECT
                funciones_sistema.*
            FROM
                funciones_sistema
                INNER JOIN modulos_sistema 
                    ON (funciones_sistema.ID_MODULO = modulos_sistema.ID_MODULO
                        AND modulos_sistema.ID_MODULO = " . $ID_MODULO . " ) 
            WHERE funciones_sistema.ID_MENU_PADRE = 0 ORDER BY funciones_sistema.ORDEN ASC  ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function menus_hijos_menu($ID_MENU) {
        $query = "
            SELECT
                funciones_sistema.*
            FROM
                funciones_sistema
                INNER JOIN modulos_sistema 
                    ON (funciones_sistema.ID_MODULO = modulos_sistema.ID_MODULO) 
            WHERE funciones_sistema.ID_MENU_PADRE = " . $ID_MENU . " "
                . "ORDER BY funciones_sistema.ORDEN ASC  ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function menus_hijos_menu_usuario($ID_MENU, $USUARIO) {
        $query = "
            SELECT
                funciones_sistema.*
            FROM
                funciones_sistema
                INNER JOIN modulos_sistema 
                    ON (funciones_sistema.ID_MODULO = modulos_sistema.ID_MODULO) 
                INNER JOIN permisos_usuario 
                    ON ( funciones_sistema.ID_MENU = permisos_usuario.`ID_MENU`)
            WHERE funciones_sistema.ID_MENU_PADRE = " . $ID_MENU . " "
                . "AND  permisos_usuario.ID_USUARIO = '".$USUARIO."' "
                . "ORDER BY funciones_sistema.ORDEN ASC  ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function menus_del_modulo() {
        $query = "
            SELECT
                funciones_sistema.*
            FROM
                funciones_sistema
                INNER JOIN modulos_sistema 
                    ON (funciones_sistema.ID_MODULO = modulos_sistema.ID_MODULO
                        AND modulos_sistema.ID_MODULO = 1) ORDER BY funciones_sistema.ORDEN ASC ";
        $consulta = self::consulta($query);
        return $consulta;
    }

    public static function modulos_del_usuario($id) {
        $query = '
            select ID_MODULO 
            from tbl_usuariosmodulos 
            where ID_USUARIO = "' . $id . '" ';
        $consulta = self::consulta($query);
        return $consulta;
    }

}

?>