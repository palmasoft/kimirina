<?php

class animadoresActividadControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    public function cargar_vista_animadores_actividad() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animadores'] = AgentesModel::animadores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->vista->mostrar("animadores/animadoresActividad", $this->datos);
    }

    public function busqueda_vista_animadores_actividad() {

        $animadores = animadoresActividadModel::animadores(
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


        $this->datos['Informes'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $animadores, $provincia = NULL, $canton = NULL
        );
        $this->vista->mostrar("animadores/animadoresActividad", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $animadores){
        $objInforme = NULL;
        $objInforme->totalNuevosTS = 0;
        $objInforme->totalRecuTS = 0;
        $objInforme->totalNuevosHSH = 0;
        $objInforme->totalRecuHSH = 0;
        $objInforme->totalNuevosTRANS = 0;
        $objInforme->totalRecuTRANS = 0;
        $objInforme->totalEFECTIVOS = 0;
        $objInforme->filas = array();

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {

                $objInformeAnimador = NULL;
                $nuevos_HSH = 0;
                $recurrentes_HSH = 0;
                $nuevos_TS = 0;
                $recurrentes_TS = 0;
                $nuevos_TRANS = 0;
                $recurrentes_TRANS = 0;
                $contadorEfectivos = 0;
                foreach ($periodos as $periodo) {
                    $registros = animadoresActividadModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    if (!empty($registros)) {
                        foreach ($registros as $registro) {
//                            print_r($registro);
                            if(Usuario::esDNI()){
                                $recurrencias = AbordajesAnimadoresModel::recurrencias_validas_por_pemar_dni(
                                            $registro->ANO_CONTACTOANIMADOR, $animador->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );
                            }else{
                                $recurrencias = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                            $registro->ANO_CONTACTOANIMADOR, $animador->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );
                                
                            }

                            if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "HSH") {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_HSH++;
                                } else {
                                    foreach ($recurrencias as $recurrencia) {
                                        if ($recurrencia->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                            $recurrentes_HSH++;
                                        }
                                    }
                                }
                            }
                            if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TS") {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TS++;
                                } else {
                                    foreach ($recurrencias as $recurrencia) {
                                        if ($recurrencia->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                            $recurrentes_TS++;
                                        }
                                    }
                                }
                            }
                            if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TRANS") {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $nuevos_TRANS++;
                                } else {
                                    foreach ($recurrencias as $recurrencia) {
                                        if ($recurrencia->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                            $recurrentes_TRANS++;
                                        }
                                    }
                                }
                            }
                            //Contactos referidos efectivos
                            if (self::esReferidoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                $contadorEfectivos++;
                            }
                        }
                    }
                }

                $objInformeAnimador->NOMBRE_ANIMADOR = $animador->NOMBRE_REAL_PERSONA;
                $objInformeAnimador->NUEVOS_TS = $nuevos_TS;
                $objInformeAnimador->RECURRENTES_TS = $recurrentes_TS;
                $objInformeAnimador->NUEVOS_HSH = $nuevos_HSH;
                $objInformeAnimador->RECURRENTES_HSH = $recurrentes_HSH;
                $objInformeAnimador->NUEVOS_TRANS = $nuevos_TRANS;
                $objInformeAnimador->RECURRENTES_TRANS = $recurrentes_TRANS;

                $objInformeAnimador->TOTAL_NUEVOS = $objInformeAnimador->NUEVOS_TS + $objInformeAnimador->NUEVOS_HSH + $objInformeAnimador->NUEVOS_TRANS;
                $objInformeAnimador->TOTAL_RECURRENTES = $objInformeAnimador->RECURRENTES_TS + $objInformeAnimador->RECURRENTES_HSH + $objInformeAnimador->RECURRENTES_TRANS;
                $objInformeAnimador->TOTAL_EFECTIVOS = $contadorEfectivos;

                $objInformeAnimador->TOTAL = $objInformeAnimador->TOTAL_NUEVOS + $objInformeAnimador->TOTAL_RECURRENTES;

                array_push($objInforme->filas, $objInformeAnimador);

                $objInforme->totalNuevosTS += $objInformeAnimador->NUEVOS_TS;
                $objInforme->totalNuevosHSH +=$objInformeAnimador->NUEVOS_HSH;
                $objInforme->totalNuevosTRANS += $objInformeAnimador->NUEVOS_TRANS;

                $objInforme->totalRecuTS +=$objInformeAnimador->RECURRENTES_TS;
                $objInforme->totalRecuHSH += $objInformeAnimador->RECURRENTES_HSH;
                $objInforme->totalRecuTRANS += $objInformeAnimador->RECURRENTES_TRANS;
                
                $objInforme->totalEFECTIVOS += $objInformeAnimador->TOTAL_EFECTIVOS;
            }
        }

        $this->datos['Informes'] = $objInforme;
        return $objInforme;
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

        $animadores = animadoresActividadModel::animadores(
                 $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $idProvincia, $idCanton
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
                $this->datos['RUTA'] = InformeAnimadoresActividad::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAnimadoresActividad::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            default:
                break;
        }
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animador'] = AgentesModel::animadores();
        $this->datos['Monitor'] = AgentesModel::monitor();
        
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

        $animadores = animadoresActividadModel::animadores(
                 $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $idProvincia, $idCanton
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
                $this->datos['RUTA'] = InformeAnimadoresActividad::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombreAnimador, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeAnimadoresActividad::generar_trimestre_xls(
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
        $objInforme->totalNuevosTS = 0;
        $objInforme->totalRecuTS = 0;
        $objInforme->totalNuevosHSH = 0;
        $objInforme->totalRecuHSH = 0;
        $objInforme->totalNuevosTRANS = 0;
        $objInforme->totalRecuTRANS = 0;
        $objInforme->totalEFECTIVOS = 0;
        $objInforme->filas = array();

        $periodo = PeriodosModel::activo();

        if (isset($this->datos['periodo-informe'])) {
            $periodo = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
        }

        $animadores = animadoresActividadModel::animadores(
                        $this->datos['monitor-formulario'], $this->datos['animador-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
        );

        if (!empty($animadores)) {
            foreach ($animadores as $animador) {

                $objInformeAnimador = NULL;
                $registros = animadoresActividadModel::recibo_contacto($animador->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                $nuevos_HSH = 0;
                $recurrentes_HSH = 0;
                $nuevos_TS = 0;
                $recurrentes_TS = 0;
                $nuevos_TRANS = 0;
                $recurrentes_TRANS = 0;
                $contadorEfectivos = 0;

                if (!empty($registros)) {
                    foreach ($registros as $registro) {

                        $recurrencia = AbordajesAnimadoresModel::recurrencias_validas_por_pemar(
                                        $registro->ANO_CONTACTOANIMADOR, $animador->ID_SUBRECEPTOR, $registro->ID_PEMAR
                        );

                        if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "HSH") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $nuevos_HSH++;
                            } else {
                                foreach ($recurrencia as $key => $value) {
                                    if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                        $recurrentes_HSH++;
                                    }
                                }
                            }
                        }
                        if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $nuevos_TS++;
                            } else {
                                foreach ($recurrencia as $key => $value) {
                                    if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                        $recurrentes_TS++;
                                    }
                                }
                            }
                        }
                        if ($registro->TIPO_FORMATO_CONTACTOANIMADOR == "TRANS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $nuevos_TRANS++;
                            } else {
                                foreach ($recurrencia as $key => $value) {
                                    if ($value->ID_CONTACTOANIMADOR == $registro->ID_CONTACTOANIMADOR) {
                                        $recurrentes_TRANS++;
                                    }
                                }
                            }
                        }
                        //Contactos referidos efectivos
                        if (self::esReferidoEfectivo($registro, $periodo->ANO_PERIODO)) {
                            $contadorEfectivos++;
                        }
                    }
                }


                $objInformeAnimador->NOMBRE_ANIMADOR = $animador->NOMBRE_REAL_PERSONA;
                $objInformeAnimador->NUEVOS_TS = $nuevos_TS;
                $objInformeAnimador->RECURRENTES_TS = $recurrentes_TS;
                $objInformeAnimador->NUEVOS_HSH = $nuevos_HSH;
                $objInformeAnimador->RECURRENTES_HSH = $recurrentes_HSH;
                $objInformeAnimador->NUEVOS_TRANS = $nuevos_TRANS;
                $objInformeAnimador->RECURRENTES_TRANS = $recurrentes_TRANS;

                $objInformeAnimador->TOTAL_NUEVOS = $objInformeAnimador->NUEVOS_TS + $objInformeAnimador->NUEVOS_HSH + $objInformeAnimador->NUEVOS_TRANS;
                $objInformeAnimador->TOTAL_RECURRENTES = $objInformeAnimador->RECURRENTES_TS + $objInformeAnimador->RECURRENTES_HSH + $objInformeAnimador->RECURRENTES_TRANS;
                $objInformeAnimador->TOTAL_EFECTIVOS = $contadorEfectivos;

                $objInformeAnimador->TOTAL = $objInformeAnimador->TOTAL_NUEVOS + $objInformeAnimador->TOTAL_RECURRENTES;

                array_push($objInforme->filas, $objInformeAnimador);

                $objInforme->totalNuevosTS += $objInformeAnimador->NUEVOS_TS;
                $objInforme->totalNuevosHSH +=$objInformeAnimador->NUEVOS_HSH;
                $objInforme->totalNuevosTRANS += $objInformeAnimador->NUEVOS_TRANS;

                $objInforme->totalRecuTS +=$objInformeAnimador->RECURRENTES_TS;
                $objInforme->totalRecuHSH += $objInformeAnimador->RECURRENTES_HSH;
                $objInforme->totalRecuTRANS += $objInformeAnimador->RECURRENTES_TRANS;
                
                $objInforme->totalEFECTIVOS += $objInformeAnimador->TOTAL_EFECTIVOS;
            }
        }


        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Animador'] = AgentesModel::animadores();
        $this->datos['Monitor'] = AgentesModel::monitor();

        $this->datos['Informes'] = $objInforme;


        return $objInforme;
    }

    public function lista_seleccion_animadores() {
        $datos = AgentesModel::animadores_en_monitores($this->datos['id_Animador']);
        echo $this->formularios->Lista_Desplegable(
                $datos, 'NOMBRE_REAL_PERSONA', 'ID_PERSONA', $this->datos['id_lista'], '', ' ', 'cargar_animadores();', ' select-chosen  ', ' width: 100%; ', false, 'todos', 'animador-formulario'
        );
    }

}
