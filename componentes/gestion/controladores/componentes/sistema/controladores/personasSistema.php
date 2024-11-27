<?php

class personasSistemaControlador extends ControllerBase {
 
    public function lista_seleccion_personas() {
        $datos = PersonasSistemaModel::personas_en_idTipoPersona($this->datos['id_tipoPersona']);		
	echo $this->formularios->Lista_Desplegable( 
            $datos, array( 'NOMBRE_REAL_PERSONA', 'IDENTIFICACION_PERSONA'), 'ID_PERSONA', 
            $this->datos['id_lista'], '', ' ', '', 
            ' select-chosen', ' ', 
            false, 'seleccione una', 'personas-formulario'
	);
    }
}
?>
