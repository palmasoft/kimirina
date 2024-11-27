<?php

class formulariosAprobadosControlador extends ControllerBase {
    
    function ver_lista_fomularios_aprobados_registro_semanal(){
        $this->datos['formularios'] = RegistroSemanalModel::todos_aprobado();
        
        $this->vista->mostrar("registrosAprobados/listadoRegistosSemanales", $this->datos);
    }
    function ver_lista_fomularios_aprobados_registro_animadores(){
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_aprobado();
        
        $this->vista->mostrar("registrosAprobados/listadoRegistrosAnimadores", $this->datos);
    }
    function ver_lista_fomularios_aprobados_consejerias_pvvs(){
        $this->datos['TodasConsejerias'] =  ConsejeriaPvvsModel::todos_aprobado();
        
        $this->vista->mostrar("registrosAprobados/listadoConsejeriasPvvs", $this->datos);
    }
}
