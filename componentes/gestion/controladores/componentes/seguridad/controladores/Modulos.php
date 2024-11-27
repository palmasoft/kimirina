<?php
session_name("Admin");
session_start();

class ModulosControlador extends ControllerBase {

    public function modulos() {
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("ModulosModel.php");
            $modulosModel = new ModulosModel();
            $data['modulosall'] = $modulosModel->getAllModulos();
            $this->view->vista("modulos/default.php", $data);
        }
    }
    
    public function crearModulo(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("ModulosModel.php");
            $modulosModel = new ModulosModel();
            $data['operacion'] = 'crear';             
            $this->view->vista("modulos/formulario.php", $data);
        }
    }
    
    public function nuevoModulo() {
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();
        $idModulo = $modulosModel->nuevo($_POST["txt_nombre_modulo"], $_POST["txt_titulo_modulo"], $_POST["txt_accion_modulo"], 
        $_POST["txt_imgfondo_modulo"], $_POST["txt_imgfoco_modulo"]);
        echo 'MÓDULO ' . $_POST["txt_nombre_modulo"] . '- CON TÍTULO  ' . $_POST["txt_titulo_modulo"] . ' FUE CREADO CORRECTAMENTE.';
    }

    public function editarModulo() {
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();
        $modulosModel->editar($_POST["hd_id_modulo"], $_POST["txt_nombre_modulo"], $_POST["txt_titulo_modulo"], $_POST["txt_accion_modulo"], 
        $_POST["txt_imgfondo_modulo"], $_POST["txt_imgfoco_modulo"]);
        echo 'MODULO ' . $_POST["hd_id_modulo"] . '- CON TÍTULO  ' . $_POST["txt_nombre_modulo"] . ' ACTUALIZADO CORRECTAMENTE.';
    }
    
    public function confirmarBorrar() {
        $data["idModulodelt"] = $_POST["idModulodel"];
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();
        $data["nombre"]=$modulosModel->getNombreModulo($_POST["idModulodel"]);
        $this->view->vista("modulos/confirmarBorrar.php", $data);
    }  
    
    public function borrarModulo() {
        $this->model->cargar("ModulosModel.php");
        $modulosModel = new ModulosModel();
        $modulosModel->borrar($_POST["idModulodelt"]);
        echo "MODULO borrado correctamente";
    }    
    
    public function getDatosModulo(){
          if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("ModulosModel.php");
            $modulosModel = new ModulosModel();
            $data['operacion'] = 'editar';
            //$modulosModel = new ModulosModel();
            $data['nombresmod'] =  $modulosModel->getAllModulos(); 
            $data['moduloedit'] = $modulosModel->getModulo($_POST["idmod"]);
            $this->view->vista("modulos/formulario.php", $data);
        }      
        
    }
    
 }
?>
