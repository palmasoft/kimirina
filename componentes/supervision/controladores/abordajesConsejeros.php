<?php

class abordajesConsejerosControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_abordajes_consejeros() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitores'] = AgentesModel::monitor();
        $this->datos['Consejeros'] = AgentesModel::consejeros();

        $this->vista->mostrar("monitores/abordajesConsejeros", $this->datos);
    }

    public function busqueda_vista_abordajes_consejeros() {
        $objInforme = NULL;
        $objInforme->filas = array();

//        $periodo = PeriodosModel::activo();
//        if (isset($this->datos['periodo-informe'])) {
//            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
//        }
        
        $periodo = $this->datos['Periodos'][0];
        $consejeros = abordajesMensualConsejerosModel::consejeros(
                        $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],  $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        if (!empty($consejeros)) {
            foreach ($consejeros as $consejero) {
                $consejerias = abordajesMensualConsejerosModel::consejerias($consejero->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($consejerias)) {
                    foreach ($consejerias as $consejeria) {  
                        
                        $consejeria->NUEVO=NULL;
                        $consejeria->RECURRENTE=NULL;

                        $consejeria->NUEVO='NO';
                        $consejeria->RECURRENTE='NO';
                        if (self::esNuevo($consejeria, $periodo->ID_PERIODO)) {
                            $consejeria->NUEVO='SI';
                        } else {
                            $consejeria->RECURRENTE='SI';
                        }
                        
                        
                        array_push($objInforme->filas, $consejeria);
                    }
                }
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Consejeros'] = AgentesModel::consejeros();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Consejero'] = $this->datos['consejero-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = $objInforme;

        $this->vista->mostrar("monitores/abordajesConsejeros", $this->datos);
    }
    
    public function esNuevo($consejeria, $periodo) {
        $primer_abordaje = AbordajesConsejerosModel::primer_abordaje($consejeria->ID_PEMAR, $periodo);
        if (!empty($primer_abordaje)) {           
            if ($consejeria->ID_CONSEJERIA_PVVS == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function accion_generar_pdf() {

//       $periodo = PeriodosModel::activo();
//        if (isset($this->datos['periodo-informe'])) {
//            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
//        }
        $periodo = $this->datos['Periodos'][0];
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

        $consejeros = abordajesMensualConsejerosModel::consejeros(
                        $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],  $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
//        $consejeros = AgentesModel::consejeros(
//                        $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],  $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
//        );

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
        
        $this->datos['RUTA'] = InformeAbordajeConsejeros::generar(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreConsejero, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function accion_generar_xls() {

        $periodo = $this->datos['Periodos'][0];
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

        $consejeros = abordajesMensualConsejerosModel::consejeros(
                        $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],  $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
//        $consejeros = AgentesModel::consejeros(
//                        $this->datos['consejero-formulario'], $this->datos['monitor-formulario'],  $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
//        );

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
        
        $this->datos['RUTA'] = InformeAbordajeConsejeros::generar_xls(
                $subreceptor, $datosInforme, $periodo, 
                $nombreProvincia, $nombreCanton, 
                $nombreConsejero, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
        );


        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }


    public function generar_datos_informe($periodo, $consejeros, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        if (!empty($consejeros)) {
            foreach ($consejeros as $consejero) {
                $consejerias = abordajesMensualConsejerosModel::consejerias($consejero->ID_PERSONA, $periodo->ID_PERIODO, $provincia, $canton);
                if (!empty($consejerias)) {
                    foreach ($consejerias as $consejeria) {                               
                        array_push($objInforme->filas, $consejeria);
                    }
                }
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Consejeros'] = AgentesModel::consejeros();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;
        
        return $objInforme;

    }
}
