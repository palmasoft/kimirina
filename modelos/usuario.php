<?php

class Usuario extends ModelBase {

    public static function esDNI() {
        $res = false;
        if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == 11) {
            $res = true;
        }
        return $res;
    }
    
    
    public static function puedeVerTodo() {
        $res = false;
        if ($_SESSION['SESION_USUARIO']->ID_ROL == 1 OR $_SESSION['SESION_USUARIO']->ID_ROL == 2 OR $_SESSION['SESION_USUARIO']->ID_ROL == 3) {
            $res = true;
        }
        if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == 0) {
            $res = true;
        }
        return $res;
    }


    public static function tiene_restricciones() {
        $res = true;
        if ($_SESSION['SESION_USUARIO']->ID_ROL == 1 OR $_SESSION['SESION_USUARIO']->ID_ROL == 2 OR $_SESSION['SESION_USUARIO']->ID_ROL == 3) {
            if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == 0) {
                $res = false;
            }
        }
        return $res;
    }

    public static function noTieneRestricciones() {
        return !Usuario::tiene_restricciones();
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
    }

}
