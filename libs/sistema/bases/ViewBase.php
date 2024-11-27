<?php

abstract class ViewBase extends Base {

    function __construct() {
        $this->config = Config::singleton();
        $this->params = Parametros::singleton();

        $this->modelo = new Modelos();

        $this->plantilla = new Plantillas();
        $this->formularios = new Formularios();
    }

}
