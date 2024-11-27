<?php

class informeConsejeriaParesControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_vista_informe_consejeria_pares() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Consejeros'] = AgentesModel::consejeros();

        $this->vista->mostrar("monitores/informeMensualConsejeriaPares", $this->datos);
    }
    
    public function cargar_vista_informe_consejeria_pares_filtro() {
        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-contactos'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-contactos']);
        }
        
        $consejeros = informeMensualConsejeriaParesModel::consejeros(
                $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],
                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
       
                
        $objInforme = array();                                        

        if(!empty($consejeros)){ 
            foreach($consejeros as $consejero){
                $objInformeconsejero = NULL;
                
                $consejerias = informeMensualConsejeriaParesModel::consejerias( $consejero->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'] );
                $nuevos = 0;
                $recurrentes = 0;
                
                $objInformeconsejero->NOMBRE_CONSEJERO = $consejero->NOMBRE_REAL_PERSONA;                
                
                $objInformeconsejero->CONDONES = 0;
                $objInformeconsejero->LUBRICANTES = 0;
                $objInformeconsejero->PASTILLEROS = 0;
                
                if(!empty($consejerias)){
                    foreach ($consejerias as $consejeria){
                        //se compara si la consejeria actual es igual a la nueva, entonces N +1 
                        // si no, es recurrente R + 1
                        
                        if(self::esNuevo($consejeria,$periodo->ID_PERIODO)){
                            $nuevos++;
                        }else{
                                $recurrentes++;
                        }
                    }
                    
                    $objInformeconsejero->CONDONES = informeMensualConsejeriaParesModel::cantidad_condones($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInformeconsejero->LUBRICANTES = informeMensualConsejeriaParesModel::cantidad_lubricantes($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInformeconsejero->PASTILLEROS = informeMensualConsejeriaParesModel::cantidad_pastilleros($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                }
                $objInformeconsejero->NUEVOS = $nuevos;
                $objInformeconsejero->RECURRENTES = $recurrentes;
                
                array_push($objInforme, $objInformeconsejero);
            }
        }
        $this->datos['Informe'] = $objInforme;
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Consejeros'] = AgentesModel::consejeros(); 
        
        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Consejero'] = $this->datos['consejero-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->vista->mostrar("monitores/informeMensualConsejeriaPares", $this->datos);
    }
    
    public function esNuevo($consejeria, $periodo){
        $primer_abordaje = informeMensualConsejeriaParesModel::primer_abordaje($consejeria->ID_PEMAR, $periodo);
        
        if(!empty($primer_abordaje)){
            if($primer_abordaje->TIPO_AGENTE != 'CONSEJERO'){
                return false;
            }
            if ($consejeria->ID_CONSEJERIA_PVVS == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }      
    }
    
    
    public function accion_generar_pdf() {

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }
        $idProvincia = '';
        $nombreProvincia = 'todas';
        if ($this->datos['provincia-chosen'] != "") {
            $provincia = UbicacionesModel::provincia($this->datos['provincia-chosen']);
            $idProvincia = $provincia->ID_PROVINCIA;
            $nombreProvincia = $provincia->NOMBRE_PROVINCIA;
        }

        $idCanton = '';
        $nombreCanton = 'todos';
        if ($this->datos['sel-lista-cantones'] != "") {
            $canton = UbicacionesModel::canton($this->datos['sel-lista-cantones']);
            $idProvincia = $canton->ID_CANTON;
            $nombreCanton = $canton->NOMBRE_CANTON;
        }

        $consejeros = informeMensualConsejeriaParesModel::consejeros(
                $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],
                $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreConsejero = PersonasSistemaModel::datos($this->datos['consejero-formulario']);
        if ($nombreConsejero == null) {
            $nombreConsejero = 'Todos';
        }else{
            $nombreConsejero=$nombreConsejero->NOMBRE_REAL_PERSONA;
        }
        

        $datosInforme = $this->generar_datos_informe(
                $periodo, $consejeros, $idProvincia, $idCanton
        );
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->datos['RUTA'] = InformeAnimadoresActividad::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreConsejero, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );

        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function generar_datos_informe($periodo, $animadores, $provincia = NULL, $canton = NULL) {
        $objInforme = array();                                        

        if(!empty($consejeros)){ 
            foreach($consejeros as $consejero){
                $objInformeconsejero = NULL;
                
                $consejerias = informeMensualConsejeriaParesModel::consejerias( $consejero->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'] );
                $nuevos = 0;
                $recurrentes = 0;
                
                $objInformeconsejero->NOMBRE_CONSEJERO = $consejero->NOMBRE_REAL_PERSONA;                
                
                $objInformeconsejero->CONDONES = 0;
                $objInformeconsejero->LUBRICANTES = 0;
                $objInformeconsejero->PASTILLEROS = 0;
                
                if(!empty($consejerias)){
                    foreach ($consejerias as $consejeria){
                        //se compara si la consejeria actual es igual a la nueva, entonces N +1 
                        // si no, es recurrente R + 1
                        if(self::esNuevo($consejeria,$periodo->ID_PERIODO)){
                            $nuevos++;
                        }else{
                            $recurrentes++;
                        }
                    }
                    
                    $objInformeconsejero->CONDONES = informeMensualConsejeriaParesModel::cantidad_condones($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInformeconsejero->LUBRICANTES = informeMensualConsejeriaParesModel::cantidad_lubricantes($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    $objInformeconsejero->PASTILLEROS = informeMensualConsejeriaParesModel::cantidad_pastilleros($consejero->ID_PERSONA, $periodo->ID_PERIODO , $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                }
                $objInformeconsejero->NUEVOS = $nuevos;
                $objInformeconsejero->RECURRENTES = $recurrentes;
                
                array_push($objInforme, $objInformeconsejero);
            }
        }


        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Consejero'] = AgentesModel::consejeros();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;


        return $objInforme;
    }
    
    public function lista_seleccion_consejeros(){
        $datos = AgentesModel::consejeros_en_monitores( $this->datos['id_Monitor'] );		
		echo $this->formularios->Lista_Desplegable( 
			$datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', 
			$this->datos['id_lista'], '', ' ', 'cargar_consejeros();', 
			' select-chosen  ', ' width: 100%; ', 
			false, 'todos', 'consejero-formulario'
		);
    }
}