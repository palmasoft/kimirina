<?php
session_name("Admin");
session_start();

class MenusVsUsuariosControlador extends ControllerBase {

    public function menusVsUsuarios(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("MenusVsUsuariosModel.php");
            $menusvsusuariosModel = new MenusVsUsuariosModel();
            $data['menusallu'] = $menusvsusuariosModel->getAllMenusVsUsuarios();            
            $this->view->vista("menusvsusuarios/default.php", $data);
        }
    }
    
    public function crearMenuVsUsuario(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();            
            $this->model->cargar("MenusModel.php");
            $menusModel = new MenusModel();            
            $data['operacion'] = 'crear';
            $data['usuariosreg'] = $usuarioModel->getNombresUsuario();            
            $data['nombresmen'] =  $menusModel->getAllMenus();
            $this->view->vista("menusvsusuarios/formulario.php", $data);
        }
    }
    
    public function nuevoMenuVsUsuario() {
        $this->model->cargar("MenusVsUsuariosModel.php");
        $modulosvsusuariosModel = new MenusVsUsuariosModel();
        $idModulo = $modulosvsusuariosModel->nuevo($_POST["sel_lista_usuarios_registrados"], $_POST["sel_lista_menus_registrados"]);        
        $this->model->cargar("MenusModel.php");
        $menusModel = new MenusModel();                        
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();
        //$data['nombremen'] =  $menusModel->getNombreMenu($_POST["sel_lista_menus_registrados"]);
        //$data['nombreuser'] = $usuarioModel->getNombreUsuario($_POST["sel_lista_modulos_registrados"]);                    
        //echo 'MENU ' . $nombremen['s_titulo'] . '- VS USUARIO ' . $nombreuser['NOMBRE'] . ' FUE CREADO CORRECTAMENTE.';
    }

    public function editarMenuVsUsuario() {
        $this->model->cargar("MenusVsUsuariosModel.php");
        $menusvsusuariosModel = new  MenusVsUsuariosModel();
        $resBD = $menusvsusuariosModel->editar(
			$_POST["hd_id_usuario"], $_POST["hd_id_menu"], 
			$_POST["hd_id_usuario"], $_POST["sel_lista_menus_registrados"] 
		);
		
		if( $resBD ){
			echo 'SE LE HA ASIGNADO EL ACCESO AL MEN&Uacute; ' . $_POST["hd_id_modulo"] . ' DEL MODULO' . $_POST["txt_nombre_modulo"] . ' ACTUALIZADO CORRECTAMENTE.';	
		}else{
			echo 'NO FUE POSIBLE MODIFICAR LA ASIGNACION. <br /> Si el problema persiste consulte con el administrador.';
		}
        
    }
    
    public function confirmarBorrar() {
        $data["idMenudelt"] = $_POST["idMenudel"];
        $this->model->cargar("MenusModel.php");
        $menusModel = new MenusModel();
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();        
        $data["nombremen"]=$menusModel->getNombreMenu($_POST["idMenudel"]);        
        $data["nombreu"]=$usuarioModel->getNombreUsuario($_POST["idUsuariodel"]);
        $this->view->vista("menusvsusuarios/confirmarBorrar.php", $data);
    }  
    
    public function borrarMenuVsUsuarios() {
        $this->model->cargar("MenusVsUsuariosModel.php");
        $menusvsusuariosModel = new MenusVsUsuariosModel();
        $menusvsusuariosModel->borrar($_POST["idUsuariodelt"], $_POST["idMenudelt"] );
        echo "Relación MENU Vs USUARIO borrado correctamente";
    }    
    
    public function getDatosMenuVsUsuarios(){
          if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("MenusModel.php");
            $menuModel = new MenusModel();                        
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();
            $data['operacion'] = 'editar';
            $data['menuedit'] =  $menuModel->getMenu($_POST["idmen"]);
            $data['usuarioedit'] = $usuarioModel->getUsuario($_POST["idu"]);
            $data['usuariosreg'] = $usuarioModel->getNombresUsuario();            
            $data['nombresmen'] =  $menuModel->getNombresMenus();            
            $this->view->vista("menusvsusuarios/formulario.php", $data);
        }      
        
    }
    
 }
?>
