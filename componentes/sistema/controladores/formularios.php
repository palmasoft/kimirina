<?php

class formulariosControlador extends ControllerBase {
   
    function mostrar_formulario_insumos(){        
        $this->vista->mostrar( "insumos/formInsumos", array());
    }
    
    function mostrar_formulario_tipolugares(){        
        $this->vista->mostrar( "tipo_lugares/formTipoLugares", array());
    }
    
    function mostrar_tipo_centro_de_salud(){        
        $this->vista->mostrar( "tipocentrodesalud/formTipoCentroDeSalud", array());
    }
}
