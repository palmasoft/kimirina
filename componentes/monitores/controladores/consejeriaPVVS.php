<?php

class consejeriaPVVSControlador extends ControllerBase {

    function __construct() {
        parent::__construct();
        $this->datos_filtro_subreceptores();
    }

    function mostrar_todas_consejeria_PVVS() {
        $this->datos['TodasConsejerias'] = ConsejeriaPvvsModel::todos_pendientesRevisionRevisado();
        $this->vista->mostrar("consejeria_pvvs/listadoConsejeria", $this->datos);
    }

    function datos_carga_formulario() {
        $this->datos['periodoActual'] = PeriodosModel::activo();
        $this->datos['CentrosSalud'] = CentrosSaludModel::todos();
        $this->datos['TiposLugares'] = TiposLugaresModel::todos();
        $this->datos['Promotores'] = AgentesModel::consejeros();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['lugaresConsejeria'] = LugaresConsejeriaModel::todos();
        $this->datos['esquemasArv'] = EsquemasArvModel::todos();
        $this->datos['maximoCondones'] = TiposPoblacionModel::datos(4)->MAXIMO_CONDONES;

        if (isset($this->datos['idConsejeria'])) {
            $objConsejeria = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['idConsejeria']);
            $objConsejeria->SOPORTES = ConsejeriaPvvsSoportesModel::archivos_en_el_registro($this->datos['idConsejeria']);
            $objConsejeria->INSUMOS->CONDONES = ConsejeriaPvvsModel::condones_entregados($this->datos['idConsejeria']);
            $objConsejeria->INSUMOS->LUBRICANTES = ConsejeriaPvvsModel::lubricantes_entregados($this->datos['idConsejeria']);
            $objConsejeria->INSUMOS->PASTILLEROS = ConsejeriaPvvsModel::pastilleros_entregados($this->datos['idConsejeria']);
            $objConsejeria->INSUMOS->MATERIAL_IEC = ConsejeriaPvvsModel::material_iec_entregados($this->datos['idConsejeria']);
            $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia($objConsejeria->ID_PROVINCIA);

            $this->datos['datosConsejeria'] = $objConsejeria;
        }
    }

    function mostrar_datos_consejeria_PVVS() {
        $this->datos_carga_formulario();
        $this->vista->mostrar("consejeria_pvvs/VerConsejeriaPVVS", $this->datos);
    }

    function mostrar_formulario_consejeria_PVVS() {
        $this->datos_carga_formulario();
        $this->vista->mostrar("consejeria_pvvs/ConsejeriaPVVS", $this->datos);
    }

    function agregar_consejeria_pvvs() {

//        print_r($this->datos);

        $this->msnResultado = "";
        $codigoUsuario = $this->datos['codigo-pemar'];
        $idPemar = PemarsModel::validar_codigo($codigoUsuario);
        if (!$idPemar) {
            $idPemar = PemarsModel::insertar_con_sexo(
                    '4', $codigoUsuario, $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], 
                    $this->datos['dosPrimerNombre'], $this->datos['dosPrimerApellido'], 
                    $this->datos['dosSegundoNombre'], $this->datos['dosSegundoApellido'], 
                    $this->datos['cedulaUsuario'], $this->datos['telefono'], $this->datos['correo'], 
                    $this->datos['sexo'], $this->datos['lugarResidencia']
            );
        }
        $cedVerificada = 'NO';
        if (isset($this->datos['chk-cedula-verificada'])) {
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                $cedVerificada = 'SI';
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['dosPrimerNombre'], $this->datos['dosSegundoNombre'], 
                        $this->datos['dosPrimerApellido'], $this->datos['dosSegundoApellido'], 
                        $this->datos['cedulaUsuario'], $this->datos['telefono']
                );
            }
        }

        $idConsejeriaPvvs = ConsejeriaPvvsModel::insertar(
                $this->datos['lugarResidencia'], $this->datos['fechaRealizacion'], $idPemar, $this->datos['horaInicio'], $this->datos['horaFinal'], 
                $this->datos['dosPrimerNombre'], $this->datos['dosSegundoNombre'], $this->datos['dosPrimerApellido'], $this->datos['dosSegundoApellido'], 
                $this->datos['cedulaUsuario'], $this->datos['telefono'], $cedVerificada, $this->datos['sexo'], $this->datos['edadUsuario'], $this->datos['arv'], $this->datos['idEsquema'], "", $this->datos['idLugar'], $this->datos['observaciones'], $this->datos['referencia'], $this->datos['idConsejero'], $this->datos['idEstablecimiento'], $this->datos['tipo-alcance-contacto']
        );

        $ObjRegistro = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($idConsejeriaPvvs);

        if ($idConsejeriaPvvs > 0) {

            ConsejeriaPvvsModel::guardar_cantidad_condones($idConsejeriaPvvs, $this->datos['nroCondones']);
            ConsejeriaPvvsModel::guardar_cantidad_lubricantes($idConsejeriaPvvs, $this->datos['nroLubricantes']);
            ConsejeriaPvvsModel::guardar_cantidad_pastilleros($idConsejeriaPvvs, $this->datos['pastilleros']);
            ConsejeriaPvvsModel::guardar_cantidad_material_iec($idConsejeriaPvvs, $this->datos['materialIEC']);

            if (count($this->enviados) > 0) {
                $this->msnResultado .= "<h4>Soportes de la Consejeria PVVS.</h4>";
                $dirArchivo = 'soportes' . DS . 'consejeria' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                        $this->datos['idConsejero'] . DS . $ObjRegistro->NUM_CONSEJERIA . DS;
                foreach ($this->enviados as $archivo) {
                    $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                    if ($resp === TRUE) {
                        $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                        ConsejeriaPvvsSoportesModel::insertar_soporte(
                                $ObjRegistro->ID_CONSEJERIA_PVVS, str_replace(
                                        DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                                ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                        );
                    } else {
                        $this->msnResultado .= $resp;
                    }
                }
            }
            echo '{ "resultado":"EXITO", "mensaje":"Consejeria a PVVS Guardada Exitosamente y se le ha asignado el numero de seguimiento #'.$ObjRegistro->NUM_CONSEJERIA.' ' . $this->msnResultado . '" }';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema. ' . $this->msnResultado . ' "}';
        }
    }

    function editar_form_consejeria_pvvs() {
        $this->datos_carga_formulario();
        $this->vista->mostrar("consejeria_pvvs/ConsejeriaPVVS", $this->datos);
    }

    function actualizar_datos_consejeria() {

        $cambio = 0;
        $this->msnResultado = '';
        $codigoUsuario = $this->datos['codigo-pemar'];
        $idPemar = PemarsModel::validar_codigo($codigoUsuario);
        if (!$idPemar) {
            $idPemar = PemarsModel::insertar_con_sexo(
                            4, $codigoUsuario, $this->datos['mes-nacimiento'], $this->datos['ano-nacimiento'], $this->datos['dosPrimerNombre'], $this->datos['dosPrimerApellido'], $this->datos['dosSegundoNombre'], $this->datos['dosSegundoApellido'], $this->datos['cedulaUsuario'], $this->datos['telefono'], $this->datos['correo'], 'MASCULINO', $this->datos['lugarResidencia']
            );
        }
        $cedVerificada = 'NO';
        if (isset($this->datos['chk-cedula-verificada'])) {
            if ($this->datos['chk-cedula-verificada'] == "SI") {
                $cedVerificada = 'SI';
                PemarsModel::actualizar_informacion_personal(
                        $idPemar, $this->datos['dosPrimerNombre'], $this->datos['dosSegundoNombre'], $this->datos['dosPrimerApellido'], $this->datos['dosSegundoApellido'], "", $this->datos['cedulaUsuario'], $this->datos['telefono']
                );
            }
        }
        $cambio = ConsejeriaPvvsModel::update(
                        $this->datos['registro-id'], $this->datos['lugarResidencia'], $this->datos['fechaRealizacion'], $idPemar, $this->datos['horaInicio'], $this->datos['horaFinal'], $this->datos['dosPrimerNombre'], $this->datos['dosSegundoNombre'], $this->datos['dosPrimerApellido'], $this->datos['dosSegundoApellido'], $this->datos['cedulaUsuario'], $this->datos['telefono'], $cedVerificada, $this->datos['sexo'], $this->datos['edadUsuario'], $this->datos['arv'], $this->datos['idEsquema'], "", $this->datos['idLugar'], $this->datos['observaciones'], $this->datos['referencia'], $this->datos['idConsejero'], $this->datos['idEstablecimiento'], $this->datos['tipo-alcance-contacto']
        );
        $ObjRegistro = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id']);

        if ($cambio > 0) {
            $cambio += ConsejeriaPvvsModel::cambiar_cantidad_condones($this->datos['registro-id'], $this->datos['nroCondones']);
            $cambio += ConsejeriaPvvsModel::cambiar_cantidad_lubricantes($this->datos['registro-id'], $this->datos['nroLubricantes']);
            $cambio += ConsejeriaPvvsModel::cambiar_cantidad_pastilleros($this->datos['registro-id'], $this->datos['pastilleros']);
            $cambio += ConsejeriaPvvsModel::cambiar_cantidad_material_iec($this->datos['registro-id'], $this->datos['materialIEC']);
        }


        $soporte = null;
        if (isset($this->datos['archivo-asociado'])) {
            $soporte = $this->datos['archivo-asociado'];
        }
        ConsejeriaPvvsSoportesModel::eliminar_soportes_excepto($ObjRegistro->ID_CONSEJERIA_PVVS, $soporte);

        if (count($this->enviados) > 0) {
            $this->msnResultado .= "<h4>Soportes de la Consejeria PVVS.</h4>";
            $dirArchivo = 'soportes' . DS . 'consejeria' . DS . $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR . DS .
                    $this->datos['idConsejero'] . DS . $ObjRegistro->NUM_CONSEJERIA . DS;          
            
            foreach ($this->enviados as $archivo) {
                $resp = Archivos::mover_archivo_recibido($archivo, $dirArchivo);
                if ($resp === TRUE) {
                    $this->msnResultado .= "Se ha cargado correctamente el archivo " . $archivo ['name'] . ".<br />";
                    ConsejeriaPvvsSoportesModel::insertar_soporte(
                            $ObjRegistro->ID_CONSEJERIA_PVVS, str_replace(
                                    DS, '/', $dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name'])
                            ), pathinfo($dirArchivo . Archivos::limpiarCaracteresEspeciales($archivo['name']), PATHINFO_EXTENSION)
                    );
                } else {
                    $this->msnResultado .= $resp;
                }
            }
        }

        if ($cambio) {
            return 1;
        }
        return 0;
    }

    function editar_consejeria_pvvs() {
        $cambio = $this->actualizar_datos_consejeria();
          $ObjRegistro = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id']);
         $ObjRegistro->NUM_CONSEJERIA;
        if ($cambio > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro de <strong>CONSEJERIA A PVVS</strong> con numero de seguimiento #'. $ObjRegistro->NUM_CONSEJERIA.' Actualizado Exitosamente. ' . $this->msnResultado . ' "}';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. Verifica que has realizado algun cambio en el registro e intentelo nuevamente. si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function eliminar_consejeria_pvvs() {
        $idConsejeriaPvvs = ConsejeriaPvvsModel::eliminar($this->datos['idConsejeria']);
        $ObjRegistro = ConsejeriaPvvsModel::mostrar_datos_consejeria_pvvs($this->datos['registro-id']);
//        $ObjRegistro->NUM_CONSEJERIA;
        if ($idConsejeriaPvvs > 0) {
            echo '{"resultado":"EXITO", "mensaje":"Registro de <strong>CONSEJERIA A PVVS</strong> con numero de seguimiento #'. $ObjRegistro->NUM_CONSEJERIA.' Exitosamente" }';
        } else {
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido eliminar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }

    function lista_seleccion_establecimiento() {

        $CentrosSaludResto = centrosserviciossaludModel::todos();
        $dtsCanton->ID_CANTON= ""; 
        $dtsCanton->ID_PROVINCIA = "";
        if (isset($this->datos['id_canton']) and ! empty($this->datos['id_canton'])) {
            $dtsCanton = UbicacionesModel::canton($this->datos['id_canton']);
            $CentrosSaludCanton = centrosserviciossaludModel::todos_filtro_canton($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
            $CentrosSaludProvincia = centrosserviciossaludModel::todos_filtro_provincia($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
            $CentrosSaludResto = centrosserviciossaludModel::todos_filtro_no_canton_no_provincia($dtsCanton->ID_CANTON, $dtsCanton->ID_PROVINCIA);
        }
        
        echo '<select id="'.$this->datos['id_lista'].'" name="'.$this->datos['id_lista'].'" class="select-chosen span12" >'
            .'<option value="" data-nombre=""  selected="true" >Seleccione uno</option>';
        
        if(count($CentrosSaludCanton)){
            echo '<optgroup label="CANTON: '.$dtsCanton->NOMBRE_CANTON.'">';
            foreach ($CentrosSaludCanton as $centro) {        
                echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
                echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
                echo '</option>';
            }
            echo '</optgroup>';
        }
        if(count($CentrosSaludProvincia)){
        echo '<optgroup label="PROVINCIA: '.$dtsCanton->NOMBRE_PROVINCIA.'">';
        foreach ($CentrosSaludProvincia as $centro) {        
            echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
            echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
            echo '</option>';
        }
        echo '</optgroup>';
        }
        if(count($CentrosSaludResto)){
        echo '<optgroup label="RESTO DE ECUADOR">';
        foreach ($CentrosSaludResto as $centro) {        
            echo '<option value="' . $centro->ID_CENTROSERVICIO . '"  data-nombre="' . ($centro->NOMBRE_CENTROSERVICIO) . '"  >';
            echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]");
            echo '</option>';
        }
        echo '</optgroup>';
        }
        
        echo '</select>';


    }

}
