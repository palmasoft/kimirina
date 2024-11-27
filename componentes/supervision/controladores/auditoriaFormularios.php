<?php

class auditoriaFormulariosControlador extends ControllerBase {
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function correcciones_registro_semanal_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('REGISTRO SEMANAL CONTACTO', $this->datos['idRegistroSemanal']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

    public function correcciones_recibo_animador_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('RECIBO ANIMADOR', $this->datos['idReciboAnimador']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

    public function correcciones_consejeria_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('CONSEJERIA PVVS', $this->datos['idConsejeria']);

        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }

    public function correcciones_atencion_salud_aprobado() {
        $this->datos['correcciones'] = auditoriaFormulariosModel::correcciones('ATENCION EN SALUD', $this->datos['id_atencion_salud']);
//        echo $this->datos['correcciones'];
        $this->vista->mostrar("registrosAprobados/Correcciones", $this->datos);
    }
}
