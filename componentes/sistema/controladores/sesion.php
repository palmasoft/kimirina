<?php

class sesionControlador extends ControllerBase {

    public function validar_usuario() {
        $usuario = UsuariosModel::esUsuario($this->datos['login-user'], $this->datos['login-password']);
        if ($usuario) {
            $this->iniciar_sesion($usuario);
            $msg = 'CORRECTO';
             UsuariosModel::registrar_entrada($_SESSION["SESION_USUARIO"]->ID_USUARIO, $_SESSION["SESION_USUARIO"]->ID_PERSONA);
        } else {
            $msg = UsuariosModel::validar_datos_usuario($this->datos['login-user'], $this->datos['login-password']);
        }
        echo $msg;
    }

    public function reinciar_usuario() {
        $usuario = UsuariosModel::esUsuario($_SESSION["SESION_USUARIO"]->NICK, $_SESSION["SESION_USUARIO"]->CLAVE_DECODIFICADA);
        if ($usuario) {
            $this->iniciar_sesion($usuario);
            $msg = 'RECARGADO';
        } else {
            $msg = UsuariosModel::validar_datos_usuario($_SESSION["SESION_USUARIO"]->NICK, $_SESSION["SESION_USUARIO"]->CLAVE_DECODIFICADA);
        }
        echo $msg;
    }

    public function error_sesion() {

        $data['pass'] = ($_POST['login-password']);
        $data['nick'] = ($_POST['login-user']);
        $data['error'] = ($_POST['login-error']);

        switch ($data['error']) {
            case 'ERROR_NOMBRE':
            case 'ERROR_CLAVE':
                $this->vista->mostrar("sesion/login_error", $data);
                break;

            default:
                $this->vista->mostrar("sesion/login_error", $data);
                break;
        }
    }

    public function iniciar_sesion($usuario = null) {
        
        if (is_null($usuario)) {
            $usuario = UsuariosModel::esUsuario($this->datos['login-user'], $this->datos['login-password']);
        }

        $userId = $usuario->ID_USUARIO;
        /* if ($usuario->CODIGO_ROL == 'SUPERU') {
          $userId = '00000000000';
          } */

        $_SESSION['FUNCION_ACTIVA'] = './';
        $_SESSION["SESION_SINAP"] = session_id();
        $_SESSION["SESION_INICIO_SESION"] = date('Y-m-d H:i:s');
        $_SESSION["SESION_IP_SESION"] = UsuariosModel::ipUsuario();
        
        $_SESSION["SESION_USUARIO"] = $usuario;        
        $_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO = 'SI';
        $_SESSION["SESION_PERIODO_ACTIVO"] = PeriodosModel::actual();
        $_SESSION["SESION_PERIODO_ACTUAL"] = PeriodosModel::actual();


        UsuariosModel::actualizar_fechavisita($userId);
        UsuariosModel::actualizar_ultima_ip($userId);

        //print_r( $_SESSION["SESION_USUARIO"] );

        $_SESSION["SESION_MODULOS_ACTIVOS"] = FuncionesModel::todos_modulos();
        $_SESSION["SESSION_FUNCIONES_USUARIO"] = FuncionesModel::funciones_usuario($userId);

        //print_r($_SESSION["SESSION_FUNCIONES_USUARIO"]);

        if ($_SESSION["SESION_USUARIO"]->ID_USUARIO == 0) {
            $_SESSION["SESION_MODULOS_ACTIVOS"] = FuncionesModel::todos_modulos();
            $_SESSION["SESSION_FUNCIONES_USUARIO"] = FuncionesModel::funciones_superusuario();
        }

        if ($_SESSION["SESION_USUARIO"]->ID_SUBRECEPTOR == 0) {
            Usuario::cambiar_subreceptor_usuario( SubreceptoresModel::subreceptor_todos());
        }
        
       
    }

    public function cerrar_sesion() {
        
        
        UsuariosModel::registrar_salida($_SESSION["SESION_USUARIO"]->ID_USUARIO, $_SESSION["SESION_USUARIO"]->ID_PERSONA);
            
        $_SESSION = array();
        session_unset();
        session_destroy();
    }

    public function breadcrumbs() {
        echo '<ul id="breadcrumbs"><li><a href="./" title="Home"><span id="bc-home"></span></a></li>';

        foreach ($_SESSION['ruta'] as $pagina => $valor) {
            echo '<li><a href="#" onclick="' . $valor . '" title="' . $pagina . '">' . $pagina . '</a></li>';
        }
        echo '
			</ul>
		';
    }

    public function getTodosMenusHijos($v_menu_padre) {
        $menus = $this->modelo->cargar("menus");
        $v_menu_padre->MENUS_HIJOS = $menus->getMenusHijos($v_menu_padre->ID_MENU);
        if (count($v_menu_padre->MENUS_HIJOS) > 0) {
            foreach ($v_menu_padre->MENUS_HIJOS as $keyMENUHIJO => $valueMENUHIJO) {
                $valueMENUHIJO = $this->getTodosMenusHijos($valueMENUHIJO);
                $v_menu_padre->MENUS_HIJOS[$keyMENUHIJO] = $valueMENUHIJO;
            }
        }
        return $v_menu_padre;
    }

    public function datos_session() {
        if (isset($_SESSION['idUsuario'])) {
            $idUsuario = $_SESSION['idUsuario'];
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();
            $data['usuario'] = $usuarioModel->getUsuario($idUsuario);

            $this->view->vista("../plantillas/" . $params->valor('TEMPLATE') . "/session.php", $data);
        }
    }

    public function actualizar_usuario() {
        $usuario = UsuariosModel::esUsuario($this->datos['modal-account-username'], $this->datos['modal-account-pass']);
        if ($usuario) {
            $cambioUser = UsuariosModel::editarSinFoto(
                            $_SESSION['SESION_USUARIO']->ID_USUARIO, $this->datos['modal-account-username'], $this->datos['modal-account-newpass'], $this->datos['modal-account-email']
            );
            $cambioPerfil = PersonasSistemaModel::update_perfil(
                            $_SESSION['SESION_USUARIO']->ID_PERSONA, $this->datos['modal-profile-name'], $this->datos['modal-profile-name-otro'], $this->datos['identificacion'], $this->datos['telefono'], $this->datos['correo'], $this->datos['direccion'], $this->datos['modal-profile-birthdate'], $this->datos['modal-profile-bio']
            );

            if ($cambioPerfil + $cambioUser == 2) {
                $this->cerrar_sesion();
                echo '{ "resultado":"EXITO", "mensaje":" Cambio....debe ingresar nuevamente."}';
            } else {
                echo '{"resultado":"ERROR", "mensaje":"No se ha podido cambiar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
            }
        } else {

            if (empty($this->datos['modal-account-pass'])) {
                $cambioPerfil = PersonasSistemaModel::update_perfil(
                                $_SESSION['SESION_USUARIO']->ID_PERSONA, $this->datos['modal-profile-name'], $this->datos['modal-profile-name-otro'], $this->datos['identificacion'], $this->datos['telefono'], $this->datos['correo'], $this->datos['direccion'], $this->datos['modal-profile-birthdate'], $this->datos['modal-profile-bio']
                );

                if ($cambioPerfil == 1) {
                    $this->cerrar_sesion();
                    echo '{ "resultado":"EXITO", "mensaje":" Cambio....debe ingresar nuevamente."}';
                } else {
                    echo '{"resultado":"ERROR", "mensaje":"No se ha podido cambiar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
                }
            } else {
                echo '{"resultado":"ERROR", "mensaje":"La contraseña digitada no conincida con la Actual."}';
            }
        }
    }

}
