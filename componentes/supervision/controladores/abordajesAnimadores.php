<?php

class abordajesAnimadoresControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_abordajes_animadores() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("animadores/abordajesAnimadores", $this->datos);
    }

    public function busqueda_vista_abordajes_animadores() {

        $animadores = abordajesMensualAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Animador'] = $this->datos['animador-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $animadores, $provincia = NULL, $canton = NULL
        );

        $this->vista->mostrar("animadores/abordajesAnimadores", $this->datos);
        
    }
    
    public function generar_datos_informe($periodos, $animadores){
        $objInforme = NULL;
        $objInforme->filas = array();

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {
                foreach ($periodos as $periodo) {
                    $recibos = abordajesMensualAnimadoresModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    if (!empty($recibos)) {
                        foreach ($recibos as $recibo) {    
                            
                            if(Usuario::esDNI()){
                                $recurrencias = AbordajesAnimadoresModel::recurrencias_validas_por_pemar_dni(
                                            $recibo->ANO_CONTACTOANIMADOR, $animador->ID_SUBRECEPTOR, $recibo->ID_PEMAR, $periodo->ID_PERIODO
                                );
                            }else{
                                $recurrencias = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                            $recibo->ANO_CONTACTOANIMADOR, $animador->ID_SUBRECEPTOR, $recibo->ID_PEMAR, $periodo->ID_PERIODO
                                );
                                
                            }
                            
                            $recibo->NUEVO=NULL;
                            $recibo->RECURRENTE=NULL;
                            $recibo->REFERIDOS_EFECTIVO=NULL;
                            
                            $recibo->NUEVO='NO';
                            $recibo->RECURRENTE='NO';
                            $recibo->REFERIDOS_EFECTIVO='NO';
                            
                            if (self::esNuevo($recibo, $periodo->ID_PERIODO)) {
                                $recibo->NUEVO='SI';
                            } else {
                                if( !empty($recurrencias) ){
                                    foreach ($recurrencias as $recurrencia) {
                                        if ($recurrencia->ID_CONTACTOANIMADOR == $recibo->ID_CONTACTOANIMADOR) {
                                            $recibo->RECURRENTE='SI';
                                        }
                                    }
                                }
                            }
                            
                            if (self::esReferidoEfectivo($recibo, $periodo->ANO_PERIODO)) {
                                $recibo->REFERIDOS_EFECTIVO='SI';
                            }
                            
                            
                            array_push($objInforme->filas, $recibo);
                        }
                    }
                }
            }
        }
        $this->datos['Informe'] = $objInforme;
        return $objInforme;;

    }
    
    public function esReferidoEfectivo($registro, $ano_periodo) {
        $fechaAtencion = animadoresActividadModel::fecha_min_atencion($registro->ID_PEMAR, $ano_periodo);
        if (!empty($fechaAtencion)) {
            if ($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR == $fechaAtencion->ID_SUBRECEPTOR) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function esNuevo($registro, $periodo) {
        $primer_abordaje = AbordajesAnimadoresModel::primer_abordaje($registro->ID_PEMAR, $periodo);

        if (!empty($primer_abordaje)) {
            if ($registro->ID_CONTACTOANIMADOR == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function accion_generar_pdf() {

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

        $animadores = abordajesMensualAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreAnimador = PersonasSistemaModel::datos($this->datos['animador-formulario']);
        
        if ($nombreAnimador == null) {
            $nombreAnimador = 'Todos';
        }else{
            $nombreAnimador=$nombreAnimador->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $animadores, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeAbordajeAnimadores::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAbordajeAnimadores::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();
        
        $this->vista->mostrar("visores/vistaPDF", $this->datos, 'sistema');
    }

    public function accion_generar_xls() {

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

        $animadores = abordajesMensualAnimadoresModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );
        
        $nombreAnimador = PersonasSistemaModel::datos($this->datos['animador-formulario']);
        
        if ($nombreAnimador == null) {
            $nombreAnimador = 'Todos';
        }else{
            $nombreAnimador=$nombreAnimador->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $datosInforme = $this->generar_datos_informe(
                $this->datos['Periodos'], $animadores, $idProvincia, $idCanton
        );

        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeAbordajeAnimadores::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAbordajeAnimadores::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        
        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
    }






    public function generar_datos_informe_viejo($periodo, $animadores, $provincia = NULL, $canton = NULL) {

        $objInforme = NULL;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {
                $recibos = abordajesMensualAnimadoresModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $provincia, $canton);
                if (!empty($recibos)) {
                    foreach ($recibos as $recibo) {                               
                        array_push($objInforme->filas, $recibo);
                    }
                }
            }
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Informe'] = $objInforme;
        
        return $objInforme;

    }
}
