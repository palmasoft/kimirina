<?php
class Modelos extends ModelBase
{
    
   
    public function cargar($name)
    {
    	
		$ruta_interna = $name.".php";
		$path_base = $this->config->get('modelos').$ruta_interna;
		
		//Si no existe el fichero en cuestion, buscamos en las vistas        
		if ( !file_exists($path_base) )
		{           
			//$path_a_sistema = $this->config->get('componentes')."sistema/". $name;    			
			//if (!file_exists($path_a_sistema))
			//{
				echo "ERROR CARGANDO EL ARCHIVO DEL MODELO DE DATOS.";				    
				return false;
			//}else{
			//	$path_base = $path_a_sistema;
			//}
		}
		
		//Finalmente, incluimos el archivo donde esta definida la clase MODELO.
		include_once($path_base);		
		$nameModelo = $name.'Model';
		return new $nameModelo();
	}



   
    public function cargar_desde_modulo($name, $modulo = '')
    {
    	
		if( $modulo == '' )	$modulo = isset( $_POST['modulo'] ) ? strtolower($_POST['modulo']) : $modulo;
		
		$ruta_interna = $modulo."/modelos/".$name.".php";
		$path_base = $this->config->get('componentes').$ruta_interna;
		
		//Si no existe el fichero en cuestion, buscamos en las vistas        
		if ( !file_exists($path_base) )
		{           	
			if($modulo != ''){ 
				$path_a_plantilla = $this->config->get('plantillas').$this->params->valor('ADMINTEMPLATE').$path_base;
			}	        
			
			if (!file_exists($path_a_plantilla))
			{
				$path_a_sistema = $this->config->get('componentes')."sistema/". $name;    			
				if (!file_exists($path_a_sistema))
				{
					echo "ERROR CARGANDO EL ARCHIVO DEL MODELO DE DATOS.";				    
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
		$nameModelo = $name.'Model';
		return new $nameModelo();
	}
}

?>