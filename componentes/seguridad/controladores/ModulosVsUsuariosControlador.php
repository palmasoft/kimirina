<?php
session_name("Admin");
session_start();

class ModulosVsUsuariosControlador extends ControllerBase {

    public function modulosVsUsuarios(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("ModulosVsUsuariosModel.php");
            $modulosvsusuariosModel = new ModulosVsUsuariosModel();
            $data['modulosall'] = $modulosvsusuariosModel->getAllModulosVsUsuarios();            
            $this->view->vista("modulosvsusuarios/default.php", $data);
        }
    }
    
    public function crearModuloVsUsuarios(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();            
            $this->model->cargar("ModulosModel.php");
            $modulosModel = new ModulosModel();            
            $data['operacion'] = 'crear';
            $data['usuariosreg'] = $usuarioModel->getAllUsuarios();            
            $data['nombresmod'] =  $modulosModel->getAllModulos();
            $this->view->vista("modulosvsusuarios/formulario.php", $data);
        }
    }
    
    public function nuevoModuloVsUsuario() {
        $this->model->cargar("ModulosVsUsuariosModel.php");
        $modulosvsusuariosModel = new ModulosVsUsuariosModel();        
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();                        
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();
        $data['nombremod'] =  $modulosModel->getNombreModulo($_POST["sel_lista_modulos_registrados"]);
        $data['nombreuser'] = $usuarioModel->getNombreUsuario($_POST["sel_lista_modulos_registrados"]);                    
        $idModulo = $modulosvsusuariosModel->nuevo($_POST["sel_lista_usuarios_registrados"], $_POST["sel_lista_modulos_registrados"]);
        echo 'MÓDULO ' . $nombremod['s_titulo'] . '- VS USUARIO ' . $nombreuser['NOMBRE'] . ' FUE CREADO CORRECTAMENTE.';
    }

    public function editarModuloVsUsuario() {
        $this->model->cargar("ModulosVsUsuariosModel.php");
        $modulosvsusuariosModel = new ModulosVsUsuariosModel();
        $this->model->cargar("UsuarioModel.php");
        $usuariosModel = new UsuarioModel();
        $modulosvsusuariosModel = new ModulosVsUsuariosModel();        
        $nmbmod = $modulosvsusuariosModel->getNombreModulo($_POST["hd_id_modulo"]);        
        $nmbusr =  $usuariosModel->getNombreUsuario($_POST["hd_id_usuario"]);
        $modulosvsusuariosModel->editar($_POST["hd_id_usuario"], $_POST["hd_id_modulo"], $_POST["sel_lista_usuarios_registrados"], $_POST["sel_lista_modulos_registrados"] );
        echo 'MODULO [' . $_POST["hd_id_modulo"] . ']-  VS USUARIO ID ['. $_POST["hd_id_usuario"].']';
        /*echo 'MODULO [' . $_POST["hd_id_modulo"] . ']- CON TÍTULO  [' . $nmbmod['s_titulo'] . '] ACTUALIZADO CORRECTAMENTE
        VS USUARIO ID ['. $_POST["hd_id_usuario"] .']- CON NOMBRE ['.$nmbusr['NOMBRE'].']';*/
    }
    
    public function confirmarBorrar() {
        $data["idModulodelt"] = $_POST["idModulodel"];
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();        
        $data["nombremod"]=$modulosModel->getNombreModulo($_POST["idModulodel"]);        
        $data["nombreu"]=$usuarioModel->getNombreUsuario($_POST["idUsuariodel"]);
        $this->view->vista("modulosvsusuarios/confirmarBorrar.php", $data);
    }  
    
    public function borrarModulosVsUsuarios() {
        $this->model->cargar("ModulosVsUsuariosModel.php");
        $modulosvsusuariosModel = new ModulosVsUsuariosModel();
        $modulosvsusuariosModel->borrar($_POST["idModulodelt"], $_POST["idUsuariodelt"]);
        echo "Relación MODULO Vs USUARIO borrado correctamente";
    }    
    
    public function getDatosModuloVsUsuarios(){
          if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("ModulosModel.php");
            $modulosModel = new ModulosModel();                        
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();
            $data['operacion'] = 'editar';
            $data['moduloedit'] = $modulosModel->getModulo($_POST["idmod"]);
            $data['usuarioedit'] = $usuarioModel->getUsuario($_POST["idu"]);
            $data['usuariosreg'] = $usuarioModel->getAllUsuarios();            
            $data['nombresmod'] =  $modulosModel->getAllModulos();
            $this->view->vista("modulosvsusuarios/formulario.php", $data);
        }      
        
    }
    
 }
?>
