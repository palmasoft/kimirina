<?php

class listadoRegistrosControlador extends ControllerBase {
    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }
    
    function ver_lista_registro_semanal_gestion(){
        $this->datos['formularios'] = RegistroSemanalModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoRegistosSemanales", $this->datos);
    }
    function ver_lista_registro_animadores_gestion(){
        $this->datos['ContactoAnimador'] = ReciboContactoAnimadorModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoRegistrosAnimadores", $this->datos);
    }
    function ver_lista_consejerias_pvvs_gestion(){
        $this->datos['TodasConsejerias'] =  ConsejeriaPvvsModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoConsejeriasPvvs", $this->datos);
    }
    function ver_lista_registros_atenciones_salud_gestion(){
        $this->datos['AtencionSalud'] =  registroAtencionSaludModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoRegistroAtencionSalud", $this->datos);
    }
    function ver_lista_registros_promocion_entrega_insumos_gestion(){
        $this->datos['EntregaInsumos'] =  RegistroActividadPromocionEntregaInsumosModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoRegistroPromocionInsumos", $this->datos);
    }
    function ver_lista_actividades_monitor_gestion(){
        $this->datos['ActividadesMonitor'] =  ActividadesMonitorModel::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoActividadesMonitor", $this->datos);
    }
    function ver_lista_registro_eventos_masivos_gestion(){
        $this->datos['EventosMasivos'] =  EventosReferidosEfectivos::todos_gestion();
        
        $this->vista->mostrar("listadosRegistros/listadoRegistroEventosMasivos", $this->datos);
    }
    
    
    function datos_subreceptor_periodo() {        
        
        $array['periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo-form-control'] );
        $array['subreceptor'] =SubreceptoresModel::datos($this->datos['subreceptor-form-control'] );        
        
        echo json_encode($array);
    }
    
}
