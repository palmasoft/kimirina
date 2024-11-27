<?php

class informacionControlador extends ControllerBase {
	
	
	function mostrar_informacion_sistema(){
		
		$this->vista->mostrar("informacion", $this->datos, "sistema");
		echo "--cargo--";
		
	}	
	
	
}
	
?>