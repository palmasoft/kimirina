<?php

/*
  Es una peque�a clase que hace de motor de plantilla,
  aunque con poquitas funcionalidades. Solo nos permite incluir una plantilla
  y asignarle variables.
 */

class Vistas extends ViewBase {

    var $datos;

    function __construct() {
        parent::__construct();
        $this->config = Config::singleton();
        $this->params = Parametros::singleton();
        $this->formularios = new Formularios();
    }

    public function mostrar($name, $vars = array(), $modulo = '') {
        $this->datos = $vars;

        if ($modulo == '')
            $modulo = isset($_POST['modulo']) ? strtolower($_POST['modulo']) : $modulo;

        $ruta_interna = $modulo . "/vistas/" . $name . ".php";
        $path_base = $this->config->get('componentes') . $ruta_interna;

        //Si no existe el fichero en cuestion, buscamos en las vistas        
        if (!file_exists($path_base)) {
            if ($modulo != '') {
                $path_a_plantilla = $this->config->get('plantillas') . $this->params->valor('ADMINTEMPLATE') . $path_base;
            }

            if (!file_exists($path_a_plantilla)) {
                $path_a_sistema = $this->config->get('componentes') . "sistema/" . $name;
                if (!file_exists($path_a_sistema)) {
                    echo "ERROR CARGANDO EL ARCHIVO DE LA VISTA DE USUARIO." . $path_a_sistema;
                    return false;
                } else {
                    $path_base = $path_a_sistema;
                }
            } else {
                $path_base = $path_a_plantilla;
            }
        }

        //Si hay variables para asignar, las pasamos una a una.
        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $$key = $value;
            }
        }


        //Finalmente, incluimos la plantilla.
        include CARP_BASE . $path_base;
    }

}
