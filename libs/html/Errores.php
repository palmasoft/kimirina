<?php


class Errores extends ControllerBase {
	
	public $rutaArchivo;
	public $nombreArchivo;
	
	public $nombreModelo;
	public $nombreAccion;
	public $nombreControlador;
	public $nombreVista;
	public $nombreModulo;
	
	public function error101() {
		$datos = array();	
		
		//$params = Parametros::singleton();
		if ( isset($_SESSION['idUsuario']) ){
            //$this->view->vista( "inicio/cargaInicial.php", array(), $_POST['modulo']);
        }else{
			$datos['nombreControlador'] = $this->nombreControlador;
			$datos['rutaArchivo'] = $this->rutaArchivo;			
			$this->view->vista( "errores/101.php", $datos, 'sistema');
		}		
    }

    public function error102() {
    	$datos = array();							
		//$params = Parametros::singleton();		
		if ( isset($_SESSION['idUsuario']) ){
            //$this->view->vista( "inicio/cargaInicial.php", array(), $_POST['modulo']);
        }else{
			$datos['nombreControlador'] = $this->nombreControlador;			
			$datos['nombreAccion'] = $this->nombreAccion;			
			$this->view->vista( "errores/102.php", $datos, 'sistema');
		}						
    }
    
    public function error103() {
		$datos = array();			
		//$params = Parametros::singleton();
		if ( isset($_SESSION['idUsuario']) ){
            //$this->view->vista( "inicio/cargaInicial.php", array(), $_POST['modulo']);
        }else{
			$datos['nombreModulo'] = $this->nombreModulo;			
			$datos['nombreVista'] = $this->nombreVista;			
			$this->view->vista( "errores/103.php", $datos, 'sistema');
		}		
    }
    
     public function error104() {
		$datos = array();			
		//$params = Parametros::singleton();
		if ( isset($_SESSION['idUsuario']) ){
            //$this->view->vista( "inicio/cargaInicial.php", array(), $_POST['modulo']);
        }else{
			$datos['nombreModulo'] = $this->nombreModulo;			
			$datos['nombreModelo'] = $this->nombreModelo;			
			$this->view->vista( "errores/104.php", $datos, 'sistema');
		}		
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public  $vars;
    public static $instance;    
    
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    
}

?>