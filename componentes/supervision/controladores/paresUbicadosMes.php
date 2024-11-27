<?php

class paresUbicadosMesControlador extends ControllerBase {

    
    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    
    public function cargar_totales_pares_ubicados_mes() {

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Datos'] = paresUbicadosMesModel::todos();

        $this->vista->mostrar("monitores/paresUbicadosMes", $this->datos);
    }

    public function busqueda_totales_pares_ubicados_mes() {
        
        $promotores = AgentesModel::promotores_filtro_parametros(
                $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']
                );
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];
        
        $this->datos['Informe'] = self::generar_datos_informe(
                        $this->datos['Periodos'], $promotores, $provincia = NULL, $canton = NULL
        );
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

        $this->vista->mostrar("monitores/paresUbicadosMes", $this->datos);
        
    }
    
    public function informe_antiguo($promotores, $periodo){
        
        $objInforme = NULL;
        $tsFlag = false;
        $objInforme->NUEVOS_HSH = 0;
        $objInforme->RECURRENTES_HSH = 0;
        $objInforme->CANTIDAD_HSH_TS = 0;

        $objInforme->NUEVOS_TS = 0;
        $objInforme->RECURRENTES_TS = 0;
        $objInforme->CANTIDAD_TS_TS = 0;

        $objInforme->NUEVOS_TRANS = 0;
        $objInforme->RECURRENTES_TRANS = 0;
        $objInforme->CANTIDAD_TRANS_TS = 0;

        $objInforme->NUEVOS_HSH_REFERIDOS = 0;
        $objInforme->RECURRENTES_HSH_REFERIDOS = 0;
        $objInforme->CANTIDAD_HSH_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TS_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TRANS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TRANS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TRANS_TS_REFERIDOS = 0;

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {

                $registros = paresUbicadosMesModel::registros_semanales_promotores($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                if (!empty($registros)) {
                    foreach ($registros as $registro) {

                        $recurrencia = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                        );
                        $tsFlag = false;
                        
                        if ($registro->TRABAJO_SEXUAL_CONTACTO == 'SI') {
                            $tsFlag = true;
                        }
                        
                        /* HSH */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {
                            
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_HSH++;
                                ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
                                
                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_HSH_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                }
                                
                            } else {//es recurrente
                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_HSH++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_HSH_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }




                        /* TS  */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_TS++;
                                ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
                                
                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_TS_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                }
                            } else {

                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_TS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_TS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }




                        /* TRANS */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_TRANS++;
                                ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
                                
                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_TRANS_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                }
                            } else {
                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_TRANS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_TRANS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $objInforme->TOTAL_HSH = $objInforme->NUEVOS_HSH + $objInforme->RECURRENTES_HSH;
        $objInforme->CANTIDAD_HSH_NOTS = $objInforme->TOTAL_HSH - $objInforme->CANTIDAD_HSH_TS;

        $objInforme->TOTAL_TS = $objInforme->NUEVOS_TS + $objInforme->RECURRENTES_TS;
        $objInforme->CANTIDAD_TS_NOTS = $objInforme->TOTAL_TS - $objInforme->CANTIDAD_TS_TS;

        $objInforme->TOTAL_TRANS = $objInforme->NUEVOS_TRANS + $objInforme->RECURRENTES_TRANS;
        $objInforme->CANTIDAD_TRANS_NOTS = $objInforme->TOTAL_TRANS - $objInforme->CANTIDAD_TRANS_TS;

        $objInforme->TOTAL_HSH_REFERIDOS = $objInforme->NUEVOS_HSH_REFERIDOS + $objInforme->RECURRENTES_HSH_REFERIDOS;
        $objInforme->CANTIDAD_HSH_NOTS_REFERIDOS = $objInforme->TOTAL_HSH_REFERIDOS - $objInforme->CANTIDAD_HSH_TS_REFERIDOS;

        $objInforme->TOTAL_TS_REFERIDOS = $objInforme->NUEVOS_TS_REFERIDOS + $objInforme->RECURRENTES_TS_REFERIDOS;
        $objInforme->CANTIDAD_TS_NOTS_REFERIDOS = $objInforme->TOTAL_TS_REFERIDOS - $objInforme->CANTIDAD_TS_TS_REFERIDOS;

        $objInforme->TOTAL_TRANS_REFERIDOS = $objInforme->NUEVOS_TRANS_REFERIDOS + $objInforme->RECURRENTES_TRANS_REFERIDOS;
        $objInforme->CANTIDAD_TRANS_NOTS_REFERIDOS = $objInforme->TOTAL_TRANS_REFERIDOS - $objInforme->CANTIDAD_TRANS_TS_REFERIDOS;

        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Promotores'] = AgentesModel::promotores();
        $this->datos['Monitores'] = AgentesModel::monitor();

        $this->datos['Provincia'] = $this->datos['provincia-chosen'];
        $this->datos['Canton'] = $this->datos['sel-lista-cantones'];
        $this->datos['Promotor'] = $this->datos['promotor-formulario'];
        $this->datos['Monitor'] = $this->datos['monitor-formulario'];

        $this->vista->mostrar("monitores/paresUbicadosMes", $this->datos);
    }
    
    public function generar_datos_informe($periodos, $promotores){
        
        $objInforme = NULL;
        $tsFlag = false;
        $objInforme->NUEVOS_HSH = 0;
        $objInforme->RECURRENTES_HSH = 0;
        $objInforme->CANTIDAD_HSH_TS = 0;

        $objInforme->NUEVOS_TS = 0;
        $objInforme->RECURRENTES_TS = 0;
        $objInforme->CANTIDAD_TS_TS = 0;

        $objInforme->NUEVOS_TRANS = 0;
        $objInforme->RECURRENTES_TRANS = 0;
        $objInforme->CANTIDAD_TRANS_TS = 0;

        $objInforme->NUEVOS_HSH_REFERIDOS = 0;
        $objInforme->RECURRENTES_HSH_REFERIDOS = 0;
        $objInforme->CANTIDAD_HSH_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TS_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TRANS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TRANS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TRANS_TS_REFERIDOS = 0;

        $i = 0;
        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {
                foreach ($periodos as $periodo) {
                    $registros = paresUbicadosMesModel::registros_semanales_promotores($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                    
                    if (!empty($registros)) {
                        foreach ($registros as $registro) {

                            if(Usuario::esDNI()){
                                $recurrencias = AbordajesPromotoresModel::recurrencias_por_periodo_pemar_dni(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );
                            }else{
                                $recurrencias[0] = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR, $periodo->ID_PERIODO
                                );

                            }


                            $tsFlag = false;
                            if ($registro->TRABAJO_SEXUAL_CONTACTO == 'SI') {
                                $tsFlag = true;
                            }

                            /* HSH */
                            if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {

                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $objInforme->NUEVOS_HSH++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';

                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->NUEVOS_HSH_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                    }

                                } else {//es recurrente
                                    foreach ($recurrencias as $recurrencia) {
                                        if( !empty($recurrencia) ){                                            
                                            if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                                $objInforme->RECURRENTES_HSH++;
                                                ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
                                                 if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                                    $objInforme->RECURRENTES_HSH_REFERIDOS++;
                                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                                }
                                            }
                                        }
                                    }
//                                    if(Usuario::esDNI()){
//                                        $objInforme->RECURRENTES_HSH += count($recurrencias);
//                                        ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
//                                    }else{
//                                        if ($recurrencias[0]->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
//                                            $objInforme->RECURRENTES_HSH++;
//                                            ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
//                                        }
//                                    }
                                }
                            }




                            /* TS  */
                            if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $objInforme->NUEVOS_TS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';

                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->NUEVOS_TS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                    }

                                } else {

                                    foreach ($recurrencias as $recurrencia) {
                                        if( !empty($recurrencia) ){
                                            if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {                                                
                                                $objInforme->RECURRENTES_TS++;
                                                ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
                                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                                    $objInforme->RECURRENTES_TS_REFERIDOS++;
                                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                                    
                                                }                                            
                                            }
                                        }
                                    }
                                    
//                                    if(Usuario::esDNI()){
//                                        $objInforme->RECURRENTES_TS_REFERIDOS += count($recurrencias);
//                                        ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
//                                    }else{
//                                        if ($recurrencias[0]->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
//                                            $objInforme->RECURRENTES_TS++;
//                                            ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
//                                        }
//                                    }
                                }
                            }




                            /* TRANS */
                            if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
                                if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                    $objInforme->NUEVOS_TRANS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';

                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->NUEVOS_TRANS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                    }
                                } else {
                                    foreach ($recurrencias as $recurrencia) {
                                        if( !empty($recurrencia) ){
                                            if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                                $objInforme->RECURRENTES_TRANS++;
                                                ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
                                                 if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                                    $objInforme->RECURRENTES_TRANS_REFERIDOS++;
                                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                                }
                                            }
                                        }
                                    }
//                                    if(Usuario::esDNI()){
//                                        $objInforme->RECURRENTES_TRANS += count($recurrencias);
//                                        ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
//                                    }else{
//                                        if ($recurrencias[0]->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
//                                            $objInforme->RECURRENTES_TRANS++;
//                                            ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
//                                        }
//                                    }
                                   
                                }
                            }
                        }
                    }
                }
            }
        }
        $objInforme->TOTAL_HSH = $objInforme->NUEVOS_HSH + $objInforme->RECURRENTES_HSH;
        $objInforme->CANTIDAD_HSH_NOTS = $objInforme->TOTAL_HSH - $objInforme->CANTIDAD_HSH_TS;

        $objInforme->TOTAL_TS = $objInforme->NUEVOS_TS + $objInforme->RECURRENTES_TS;
        $objInforme->CANTIDAD_TS_NOTS = $objInforme->TOTAL_TS - $objInforme->CANTIDAD_TS_TS;

        $objInforme->TOTAL_TRANS = $objInforme->NUEVOS_TRANS + $objInforme->RECURRENTES_TRANS;
        $objInforme->CANTIDAD_TRANS_NOTS = $objInforme->TOTAL_TRANS - $objInforme->CANTIDAD_TRANS_TS;

        $objInforme->TOTAL_HSH_REFERIDOS = $objInforme->NUEVOS_HSH_REFERIDOS + $objInforme->RECURRENTES_HSH_REFERIDOS;
        $objInforme->CANTIDAD_HSH_NOTS_REFERIDOS = $objInforme->TOTAL_HSH_REFERIDOS - $objInforme->CANTIDAD_HSH_TS_REFERIDOS;

        $objInforme->TOTAL_TS_REFERIDOS = $objInforme->NUEVOS_TS_REFERIDOS + $objInforme->RECURRENTES_TS_REFERIDOS;
        $objInforme->CANTIDAD_TS_NOTS_REFERIDOS = $objInforme->TOTAL_TS_REFERIDOS - $objInforme->CANTIDAD_TS_TS_REFERIDOS;

        $objInforme->TOTAL_TRANS_REFERIDOS = $objInforme->NUEVOS_TRANS_REFERIDOS + $objInforme->RECURRENTES_TRANS_REFERIDOS;
        $objInforme->CANTIDAD_TRANS_NOTS_REFERIDOS = $objInforme->TOTAL_TRANS_REFERIDOS - $objInforme->CANTIDAD_TRANS_TS_REFERIDOS;

        $this->datos['Informe'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        return $objInforme;
    }

    public function esNuevo($registro, $periodo) {
        $primer_abordaje = AbordajesPromotoresModel::primer_abordaje($registro->ID_PEMAR, $periodo);
        if (!empty($primer_abordaje)) {
            if ($registro->ID_REGISTRO_CONTACTO == $primer_abordaje->REGISTRO_ABORDAJE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function esDerivadoEfectivo($registro, $ano_periodo) {
        $fechaAtencion = consolidadoMensualDerivadosModel::fecha_min_atencion($registro->ID_PEMAR, $ano_periodo);
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
        
        $promotores = AgentesModel::promotores_filtro_parametros(
                $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $idProvincia, $idCanton
                );
        
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

       
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeParesUbicadosPromotor::generar_periodo(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeParesUbicadosPromotor::generar_trimestre(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            default:
                break;
        }

        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
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
        
        $promotores = AgentesModel::promotores_filtro_parametros(
                $this->datos['monitor-formulario'], $this->datos['promotor-formulario'], $idProvincia, $idCanton
                );
        
        $nombrePromotor = PersonasSistemaModel::datos($this->datos['promotor-formulario']);
        if ($nombrePromotor == null) {
            $nombrePromotor = 'Todos';
        }else{
            $nombrePromotor=$nombrePromotor->NOMBRE_REAL_PERSONA;
        }
        
        $subreceptor = SubreceptoresModel::datos_subreceptor($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        $tiposPobSubreceptor = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);

       
        $datosInforme = $this->generar_datos_informe(
            $this->datos['Periodos'], $promotores, $idProvincia, $idCanton
        );
        
        switch (count($this->datos['Periodos'])) {
            case 1:
                $this->datos['RUTA'] = InformeParesUbicadosPromotor::generar_periodo_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            case 3:
                $this->datos['RUTA'] = InformeParesUbicadosPromotor::generar_trimestre_xls(
                                $subreceptor, $datosInforme, $this->datos['Periodos'], $nombreProvincia, $nombreCanton, $nombrePromotor, $_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA, $tiposPobSubreceptor
                );
                break;

            default:
                break;
        }

        $this->vista->mostrar("visores/vistaXLS", $this->datos, 'sistema');
        
    }
    
    public function generar_datos_informe_viejo($periodo, $promotores, $provincia = NULL, $canton = NULL) {

        
        $objInforme = NULL;
        $tsFlag = false;
        $objInforme->NUEVOS_HSH = 0;
        $objInforme->RECURRENTES_HSH = 0;
        $objInforme->CANTIDAD_HSH_TS = 0;

        $objInforme->NUEVOS_TS = 0;
        $objInforme->RECURRENTES_TS = 0;
        $objInforme->CANTIDAD_TS_TS = 0;

        $objInforme->NUEVOS_TRANS = 0;
        $objInforme->RECURRENTES_TRANS = 0;
        $objInforme->CANTIDAD_TRANS_TS = 0;

        $objInforme->NUEVOS_HSH_REFERIDOS = 0;
        $objInforme->RECURRENTES_HSH_REFERIDOS = 0;
        $objInforme->CANTIDAD_HSH_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TS_TS_REFERIDOS = 0;

        $objInforme->NUEVOS_TRANS_REFERIDOS = 0;
        $objInforme->RECURRENTES_TRANS_REFERIDOS = 0;
        $objInforme->CANTIDAD_TRANS_TS_REFERIDOS = 0;

        if (!empty($promotores)) {
            foreach ($promotores as $promotor) {



                //echo $promotor->NOMBRE_REAL_PERSONA."+++";
                $registros = paresUbicadosMesModel::registros_semanales_promotores($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones']);
                //$registros = consolidadoMensualDerivadosModel::registros_semanales($promotor->ID_PERSONA, $periodo->ID_PERIODO, $this->datos['provincia-chosen'], $this->datos['sel-lista-cantones'] );
                if (!empty($registros)) {
                    foreach ($registros as $registro) {

                        $recurrencia = AbordajesPromotoresModel::primera_recurrencia_por_periodo_pemar_subreceptor(
                                        $registro->FECHA_CONTACTO, $promotor->ID_SUBRECEPTOR, $registro->ID_PEMAR
                        );
                        $tsFlag = false;
                        
                        if ($registro->TRABAJO_SEXUAL_CONTACTO == 'SI') {
                            $tsFlag = true;
                        }

                        //echo "***".$registro->NOMBRE_REAL_PERSONA."***";
                        
                        /* HSH */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "HSH") {
                            
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_HSH++;
                                ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';

                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_HSH_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                }
                            } else {//es recurrente
                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_HSH++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_HSH_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_HSH_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }




                        /* TS  */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_TS++;
                                ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
                                
                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_TS_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                }
                            } else {

                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_TS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TS_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_TS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TS_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }




                        /* TRANS */
                        if ($registro->TIPO_FORMATO_REGISTROSEMANAL == "TRANS") {
                            if (self::esNuevo($registro, $periodo->ID_PERIODO)) {
                                $objInforme->NUEVOS_TRANS++;
                                ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
                                
                                if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                    $objInforme->NUEVOS_TRANS_REFERIDOS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                }
                            } else {
                                if ($recurrencia->ID_REGISTRO_CONTACTO == $registro->ID_REGISTRO_CONTACTO) {
                                    $objInforme->RECURRENTES_TRANS++;
                                    ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS++ : '';
                                    
                                    if (self::esDerivadoEfectivo($registro, $periodo->ANO_PERIODO)) {
                                        $objInforme->RECURRENTES_TRANS_REFERIDOS++;
                                        ($tsFlag) ? $objInforme->CANTIDAD_TRANS_TS_REFERIDOS++ : '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $objInforme->TOTAL_HSH = $objInforme->NUEVOS_HSH + $objInforme->RECURRENTES_HSH;
        $objInforme->CANTIDAD_HSH_NOTS = $objInforme->TOTAL_HSH - $objInforme->CANTIDAD_HSH_TS;

        $objInforme->TOTAL_TS = $objInforme->NUEVOS_TS + $objInforme->RECURRENTES_TS;
        $objInforme->CANTIDAD_TS_NOTS = $objInforme->TOTAL_TS - $objInforme->CANTIDAD_TS_TS;

        $objInforme->TOTAL_TRANS = $objInforme->NUEVOS_TRANS + $objInforme->RECURRENTES_TRANS;
        $objInforme->CANTIDAD_TRANS_NOTS = $objInforme->TOTAL_TRANS - $objInforme->CANTIDAD_TRANS_TS;

        $objInforme->TOTAL_HSH_REFERIDOS = $objInforme->NUEVOS_HSH_REFERIDOS + $objInforme->RECURRENTES_HSH_REFERIDOS;
        $objInforme->CANTIDAD_HSH_NOTS_REFERIDOS = $objInforme->TOTAL_HSH_REFERIDOS - $objInforme->CANTIDAD_HSH_TS_REFERIDOS;

        $objInforme->TOTAL_TS_REFERIDOS = $objInforme->NUEVOS_TS_REFERIDOS + $objInforme->RECURRENTES_TS_REFERIDOS;
        $objInforme->CANTIDAD_TS_NOTS_REFERIDOS = $objInforme->TOTAL_TS_REFERIDOS - $objInforme->CANTIDAD_TS_TS_REFERIDOS;

        $objInforme->TOTAL_TRANS_REFERIDOS = $objInforme->NUEVOS_TRANS_REFERIDOS + $objInforme->RECURRENTES_TRANS_REFERIDOS;
        $objInforme->CANTIDAD_TRANS_NOTS_REFERIDOS = $objInforme->TOTAL_TRANS_REFERIDOS - $objInforme->CANTIDAD_TRANS_TS_REFERIDOS;
        
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['Monitor'] = AgentesModel::monitor();
        $this->datos['Promotores'] = AgentesModel::promotores();
        
        $this->datos['Informes'] = $objInforme;
        $this->datos['tiposPobSubreceptor'] = SubreceptoresModel::tipos_poblacion_asociados($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        
        return $objInforme;

    }

}
