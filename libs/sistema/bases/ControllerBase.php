<?php

abstract class ControllerBase extends Base {

    var $msnResultado = '';
    function __construct() {
        parent::__construct();


        $this->vista = new Vistas();
        $this->modelo = new Modelos();
        $this->plantilla = new Plantillas();
        $this->formularios = new Formularios();

        $this->pdf = new TCPDF();
        $this->spdo = SPDO::singleton();

        if (count($_POST)) {
            foreach ($_POST as $key => $value) {
                $this->datos[$key] = $value;
            }
        }
        $this->datos['SubReceptor'] = NULL;
        $this->datos['Periodo'] = NULL;

        if (count($_FILES)) {
            foreach ($_FILES as $key => $value) {
                $this->enviados[$key] = $value;
            }
        }
    }

    public function datos_filtro_subreceptores() {

        if (isset($this->datos['semuestra-form-control'])) {            
            if ($this->datos['semuestra-form-control'] == 'SI') {
                $_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO = 'SI';
            } else {
                $_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO = 'NO';
            }
        }

        $this->datos['Periodo'] = PeriodosModel::activo();
        if (isset($this->datos['periodo-form-control'])) {
            $this->datos['Periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo-form-control']);
            PeriodosModel::cambiar_periodo_activo($this->datos['Periodo']->ID_PERIODO);
        }


        $this->datos['Periodos'][0] = PeriodosModel::activo();
        if (isset($this->datos['periodo-informe'])) {
            if ($this->datos['periodo-informe'] == 0 && Usuario::esDNI()) {
                $this->datos['Periodos'] = PeriodosModel::todos_dentro_trimestre(PeriodosModel::datos($this->datos['Periodos'][0]->ID_PERIODO)->TRIM_PERIODO);
                $this->datos['Periodo'] = "TRIMESTRE";
            } else {
                $this->datos['Periodos'][0] = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
                $this->datos['Periodo'] = PeriodosModel::datos_por_codigo($this->datos['periodo-informe']);
            }
        }



        $idSubreceptor = empty($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR) ? 0 : $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR;
        $this->datos['SubReceptor'] = SubreceptoresModel::datos_subreceptor($idSubreceptor);
        if ($idSubreceptor == 0) {
            $this->datos['SubReceptor'] = SubreceptoresModel::subreceptor_todos();
        }
        if (isset($this->datos['subreceptor-form-control'])) {
            $this->datos['SubReceptor'] = SubreceptoresModel::datos_subreceptor($this->datos['subreceptor-form-control']);
            if ($this->datos['subreceptor-form-control'] == 0 and $this->datos['SubReceptor']->ID_SUBRECEPTOR == 0) {
                $this->datos['SubReceptor'] = SubreceptoresModel::subreceptor_todos();
            }
            $this->datos['SubReceptor'] = UsuariosModel::cambiar_subreceptor_usuario($this->datos['SubReceptor']);
        }

        $this->datos['SubReceptores'] = array($this->datos['SubReceptor']);
        if (!UsuariosModel::tiene_restricciones()) {
            $this->datos['SubReceptores'] = SubreceptoresModel::todos();
        } else if (Usuario::esGestor()) {
            $this->datos['SubReceptores'] = SubreceptoresModel::todos_del_gestor($_SESSION['SESION_USUARIO']->ID_PERSONA);
        }

        $this->datos['tieneRestricciones'] = true;
        if (!UsuariosModel::tiene_restricciones()) {
            $this->datos['tieneRestricciones'] = false;
        } else if (Usuario::esGestor()) {
            $this->datos['tieneRestricciones'] = false;
        }

        $this->datos['PVVS'] = SubreceptoresModel::muestraPVVS();
        $this->datos['HSHTSTRANS'] = SubreceptoresModel::muestraHSHTSTRANS();
        if (!SubreceptoresModel::tiene_restricciones()) {
            $this->datos['PVVS'] = true;
            $this->datos['HSHTSTRANS'] = true;
        }


        $this->datos['mostrarHSH'] = false;
        $this->datos['mostrarTS'] = false;
        $this->datos['mostrarTRANS'] = false;
        $this->datos['mostrarPVVS'] = false;
        $tiposPoblacion = SubreceptoresModel::id_tipos_poblacion($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR);
        if (!empty($tiposPoblacion)) {
            foreach ($tiposPoblacion as $tipo) {
                switch ($tipo->ID_TIPOPOBLACION) {
                    case 1: $this->datos['mostrarHSH'] = true;
                        break;
                    case 2: $this->datos['mostrarTS'] = true;
                        break;
                    case 3: $this->datos['mostrarTRANS'] = true;
                        break;
                    case 4: $this->datos['mostrarPVVS'] = true;
                        break;
                    default:
                        break;
                }
            }
        }
        if (Usuario::noTieneRestricciones()) {
            $this->datos['mostrarHSH'] = true;
            $this->datos['mostrarTS'] = true;
            $this->datos['mostrarTRANS'] = true;
            $this->datos['mostrarPVVS'] = true;
        }
    }

    public function control_de_subreceptor() {
        if (isset($_SESSION['SESION_USUARIO'])) {
            if (empty($_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR)) {
                echo '<script>alert("Debes tener asociado un subreceptor para poder realizar esta operación.<br/>'
                . ' En la <strong>parte superior izquierda</strong> debes tener la opcion de <strong>cambiar el subreceptor</strong> asociado haciendo clic sobre el icono <strong><i class=\"glyphicon-restart\"></i></strong>.'
                . '<br/> <em>Si no te aparece esta opcion, debes contactar al administrador del sistema</em>.");</script>';
                $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR = 0;
            }
        }
    }

    public function cargar($name, $modulo = '') {
        if ($modulo == '') {
            $modulo = isset($_POST['modulo']) ? strtolower($_POST['modulo']) : $modulo;
        }

        $ruta_interna = $modulo . "/controladores/" . $name . ".php";
        $datos['ruta_interna'] = $ruta_interna;
        $path_base = self::$config->get('componentes') . $ruta_interna;
        $datos['dir_base'] = $path_base;
        //Si no existe el fichero en cuestion, buscamos en las vistas        
        if (!file_exists($path_base)) {
            $path_a_plantilla = "";
            if ($modulo != '') {
                $path_a_plantilla = self::$config->get('plantillas') . self::$params->valor('ADMINTEMPLATE') . $path_base;
            }
            if (!file_exists($path_a_plantilla)) {
                $path_a_sistema = self::$config->get('componentes') . "sistema/" . $name;
                if (!file_exists($path_a_sistema)) {
                    $this->vista->mostrar("404", $datos, "sistema");
                    return false;
                } else {
                    $path_base = $path_a_sistema;
                }
            } else {
                $path_base = $path_a_plantilla;
            }
        }

        //Finalmente, incluimos el archivo donde esta definida la clase MODELO.
        include_once($path_base);
        $nameControler = $name . 'Controlador';
        return new $nameControler();
    }

}
