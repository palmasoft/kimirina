<?php

class usuariosControlador extends ControllerBase {

    public function usuarios() {
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();
            $data['usuarios'] = $usuarioModel->getAllUsuarios();
            $this->view->vista("usuarios/default.php", $data, "usuarios");
        }
    }
    
    public function crearUsuario(){
        if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("UsuarioModel.php");
            $usuarioModel = new UsuarioModel();
            $data['rutaPlantilla'] = $this->plantilla->ruta();
			$data['operacion'] = 'crear';
            $this->view->vista("usuarios/formulario.php", $data, "usuarios");
        }
    }
  
    
    public function getDatosUsuario(){
          if (!isset($_SESSION['idUsuario'])) {
            $this->view->vista("administrador/login.php");
        } else {
            $this->model->cargar("UsuarioModel.php");
            
            $data['rutaPlantilla'] = $this->plantilla->ruta();
            
            $usuarioModel = new UsuarioModel();
            $data['operacion'] = 'editar';
            $data['usuarioedit'] = $usuarioModel->getUsuario($_POST["idu"]);
            $this->view->vista("usuarios/formulario.php", $data, "usuarios");
        }      
        
    }
    
    
    public function confirmarBorrar() {
        $data["idUsuariodelt"] = $_POST["idUsuariodel"];
        $this->model->cargar("UsuarioModel.php");
        $UsuarioModel = new UsuarioModel();
        $data["nickUsuario"] = $UsuarioModel->getNickUsuario($_POST["idUsuariodel"]);
        $this->view->vista("usuarios/confirmarBorrar.php", $data, "usuarios");
    }    
    
    
    public function nuevoUsuario() {
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();
        $idUsuario = $usuarioModel->nuevo($_POST["txt_nombre_usuario"], $_POST["txt_nick_usuario"], $_POST["txt_clave_usuario"], $_POST["txt_correo_usuario"], $_POST["txt_phone_usuario"], $_POST["txt_foto_usuario"], $_POST["sel_lista_estado_usuario"]);
        echo 'USUARIO ' . $_POST["txt_nick_usuario"] . '- PARA EL TRABAJADOR  ' . $_POST["txt_nombre_usuario"] . ' FUE CREADO CORRECTAMENTE.';
    }

    
    public function editarUsuario() {
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();
        $usuarioModel->editar(
			$_POST["hd_nick_usuario"], $_POST["txt_nombre_usuario"], $_POST["txt_nick_usuario"], 
			$_POST["txt_clave_usuario"], $_POST["txt_correo_usuario"], $_POST["txt_phone_usuario"], 
			$_POST["txt_foto_usuario"], $_POST["sel_lista_estado_usuario"]);
        echo 'USUARIO ' . $_POST["txt_nick_usuario"] . '- PARA EL TRABAJADOR  ' . 
			 $_POST["txt_nombre_usuario"] . ' ACTUALIZADO CORRECTAMENTE.';
    }    
    public function borrarUsuario() {
        $this->model->cargar("UsuarioModel.php");
        $usuarioModel = new UsuarioModel();
        $usuarioModel->borrar($_POST["idUsuariodel"]);
        echo "usuario borrado correctamente";
    }    
    
    
 }
 