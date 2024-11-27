<?php
session_name("Admin");
session_start();

class MenusControlador extends ControllerBase {

    public function menus() {
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("MenusModel.php");
            $menusModel = new MenusModel();
            $data['menusall'] = $menusModel->getAllMenus();
            $this->view->vista("menus/default.php", $data);
        }
    }
    
    public function crearMenu(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("MenusModel.php");
            $menusModel = new MenusModel();            
            $data['operacion'] = 'crear';
            $data['nombres'] = $menusModel->getNombresMenus();
            $data['nombresmod'] =  $menusModel->getModulosMenu(); 
            $this->view->vista("menus/formulario.php", $data);
        }
    }
    
    public function nuevoMenu() {
        
		$this->model->cargar("MenusModel.php");
        $menuModel = new MenusModel();
        $idMenu = $menuModel->nuevo(
			$_POST["txt_nombre_menu"], ( $_POST["txt_titulo_menu"] ), $_POST["txt_accionscript_menu"], 
        	$_POST["txt_accionmenu_menu"], $_POST["sel_lista_menus_propietarios"], 
			$_POST["sel_lista_modulos_registrados"], $_POST["txt_foto_menu"], $_POST["lista_opciones_separado"]);
		
		if( $idMenu > 0 ){
			echo 'MENU ' . $_POST["txt_nombre_menu"] . '- CON TÍTULO  ' . 
				$_POST["txt_titulo_menu"] . ' FUE CREADO CORRECTAMENTE.';
		}
		else{
			echo 'MENU ' . $_POST["txt_nombre_menu"] . '- CON TÍTULO  ' . 
				$_POST["txt_titulo_menu"] . 'NO FUE CREADO CORRECTAMENTE.\r\n'.
				'SI EL PROBLEMA PERSISTE CONSULTE CON EL ADMINSITRADOR DEL SISITEMA.';
		}
		
        
    }

    public function editarMenu() {
        $this->model->cargar("MenusModel.php");
        $menuModel = new MenusModel();
        $menuModel->editar(
			$_POST["hd_id_menu"], $_POST["txt_nombre_menu"],( $_POST["txt_titulo_menu"] ), 
			$_POST["txt_accionscript_menu"], $_POST["txt_accionmenu_menu"], $_POST["sel_lista_menus_propietarios"], 
			$_POST["sel_lista_modulos_registrados"], $_POST["txt_foto_menu"], $_POST["lista_opciones_separado"]);
        echo 'MENU CON TÍTULO  ' . $_POST["txt_titulo_menu"] . ' ACTUALIZADO CORRECTAMENTE.';
    }
    
    public function confirmarBorrar() {
        $data["idMenudelt"] = $_POST["idMenudel"];
        $this->model->cargar("MenusModel.php");
        $menuModel = new MenusModel();
        $data["menu"]=$menuModel->getNombreMenu($_POST["idMenudel"]);
        $this->view->vista("menus/confirmarBorrar.php", $data);
    }  
    
    public function borrarMenu() {
        $this->model->cargar("MenusModel.php");
        $menuModel = new MenusModel();
        $menuModel->borrar($_POST["idMenudelt"]);
        echo "MENU borrado correctamente";
    }    
    
    public function getDatosMenu(){
          if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("MenusModel.php");
            $menuModel = new MenusModel();
            $data['operacion'] = 'editar';
            $data['menuparent'] = $menuModel->getPadreMenu($_POST["idm"]);
            $data['nombres'] = $menuModel->getNombresMenus();
            $data['nombresmod'] =  $menuModel->getModulosMenu(); 
            $data['menuedit'] = $menuModel->getMenu($_POST["idm"]);
            $this->view->vista("menus/formulario.php", $data);
        }      
        
    }
    
 }
?>
