<?php
class Controladores extends ControllerBase
{
	
	function __construct()
	{
		parent::__construct();
	}
	    
   
    public function cargar($name, $modulo = '')
    {
    	
		if( $modulo == '' )	$modulo = isset( $_POST['modulo'] ) ? strtolower($_POST['modulo']) : $modulo;
		
		$ruta_interna = $modulo."/controladores/".$name.".php";
		$datos['ruta_interna'] = $ruta_interna;
		$path_base = $this->config->get('componentes').$ruta_interna;
		$datos['dir_base'] = $path_base;
		
		//Si no existe el fichero en cuestion, buscamos en las vistas        
		if ( !file_exists($path_base) )
		{
			$path_a_plantilla = "";           	
			if($modulo != ''){ 
				$path_a_plantilla = $this->config->get('plantillas').$this->params->valor('ADMINTEMPLATE').$path_base;
			}	        
			
			if (!file_exists($path_a_plantilla))
			{
				$path_a_sistema = $this->config->get('componentes')."sistema/". $name;    			
				if (!file_exists($path_a_sistema))
				{
					$this->vista->mostrar("404", $datos, "sistema");				    
					return false;
				}else{
					$path_base = $path_a_sistema;
				}
			
			}else{
				$path_base = $path_a_plantilla;
			}
		}
		
		//Finalmente, incluimos el archivo donde esta definida la clase MODELO.
		include_once($path_base);		
		$nameControler = $name.'Controlador';
		return new $nameControler();
	}
}

?>