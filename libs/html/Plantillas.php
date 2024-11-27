<?php

class Plantillas extends Base {

    protected $usuario;
    protected $controlador;
    protected $sesion;
    protected $modelo;
    public static $ruta;
    public static $ruta_url_archivos;
    public static $ruta_tmpl_login;
    public static $ruta_tmpl_admin;
    public static $idioma = 'set_locale(LC_ALL,"es_ES@euro","es_ES","esp")';

    public function __construct() {

        self::$config = Config::singleton();
        self::$params = Parametros::singleton();
        self::$ruta_tmpl_login = self::$config->get('plantillas') . self::$config->get('LOGINTEMPLATE');
        try {
            if (isset($_SESSION["SESION_CODIGO_EMPRESA"])) {
                self::$ruta_tmpl_admin = self::$config->get('plantillas') . self::$params->valor('ADMINTEMPLATE');
                self::$ruta_url_archivos = "archivos/" . $_SESSION["SESION_CODIGO_EMPRESA"] . "/";
            }
        } catch (Exception $e) {
            
        }
    }

    public function detalles_usuario() {
        echo '
			<img class="img-left framed" src="' . $this->ruta_url_archivos . 'usuarios/' . $_SESSION["SESION_URL_FOTO"] . '"	alt="Hello ' . $_SESSION["SESION_NOMBRE"] . '" />
    		<h3>Ha ingresado como</h3>
    		<h2><a class="user-button" href="javascript:void(0);">' . $_SESSION["SESION_NICK"] . '&nbsp;<span class="arrow-link-down"></span></a></h2>
    		<ul class="dropdown-username-menu">
    			<li><a href="#">Perfil</a></li>
    			<li><a href="#">Ajustes</a></li>
    			<li><a href="#">Mensajes</a></li>
    			<li><a href="#" onclick="cerrar_sesion();">Cerrar Sesión</a></li>
    		</ul>
    	';
    }

    public function breadcrumbs() {
        $this->controlador = new Controladores();
        $this->sesion = $this->controlador->cargar("sesion", "sistema");
        $this->sesion->breadcrumbs();
    }

    public function html($nombreArchivo) {

        include ($this->config->get('plantillas') . $this->config->get('LOGINTEMPLATE') . '/' . $nombreArchivo . '.php');
    }

    public function encabezado() {
        echo '
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

            <meta name="keywords" content="Palmasoft Limitada">
            <meta name="description" content="sistema de informacion de radio galeon">
            <meta name="author" content="ING. JUAN PABLO LLINAS RAMIREZ">            
            <meta name="viewport" content="width=device-width">

            <title> Pocket Market | SINAP | Powered by PALMASOFT LIMITADA </title>

            <link rel="shortcut icon" href="imagenes/favicon.ico">


            <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
            <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>

            <link rel="stylesheet" type="text/css" href="libs/estilos/jquery.msgbox.css" />
            <script type="text/javascript" src="libs/js/msgbox/jquery.msgbox.js"></script>

            <script type="text/javascript" src="libs/js/window.js" ></script>
            <script type="text/javascript" src="libs/js/funciones.js" ></script>
            <script type="text/javascript" src="libs/js/ajax.js" ></script>  	
            <script type="text/javascript" src="libs/js/ayuda.js" ></script>  			

            <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,500" rel="stylesheet "type="text/css">
            <link rel="stylesheet" href="libs/estilos/normalize.min.css" />			            
            <link rel="stylesheet" type="text/css" href="libs/estilos/reset.css" />
            <link rel="stylesheet" type="text/css" href="libs/estilos/global.css" />

            <script type="text/javascript" src="componentes/sistema/scripts/sesion.js"></script> ';
    }

    public function min_css() {
        echo '
        	<link rel="stylesheet" href="libs/estilos/normalize.min.css" />	
  			<link rel="stylesheet" type="text/css" href="libs/estilos/jquery.msgbox.css" />
  			
	        <link rel="stylesheet" href="libs/estilos/bootstrap.css">			   					
	        <link rel="stylesheet" href="libs/estilos/plugins.css">

	    	<script src="libs/scripts/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        ';
    }

    public function min_js() {
        echo '		        	        
	        <script src="libs/scripts/jquery/jquery-1.9.0.js"></script>
                <script src="libs/scripts/jquery/jquery-migrate-1.1.1.min.js"></script>			

                
	        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	        <script src="libs/scripts/bootstrap/bootstrap.min.js"></script>
	        

    		<script type="text/javascript" src="libs/scripts/window.js" ></script>
    		<script type="text/javascript" src="libs/scripts/tablas.js" ></script> 
    		<script type="text/javascript" src="libs/scripts/funciones.js" ></script>
    		<script type="text/javascript" src="libs/scripts/ajax.js" ></script>  
    		<script type="text/javascript" src="libs/scripts/ayuda.js" ></script>  
                <script src="libs/scripts/msgbox/jquery.msgbox.js"></script>		
                <script src="libs/scripts/formularios.js"></script>
	        <script src="libs/scripts/plugins.js"></script>                
                <script type="text/javascript" src="libs/scripts/listas.js" ></script>  
                
                <script src="libs/scripts/jquery/jquery-ui-1.10.4.custom.min.js"></script>
        ';

        $dirScript = "componentes" . DS . "sistema" . DS . "funciones" . DS;
        $pathScript = "componentes/sistema/funciones/";
        $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirScript, 'js');
        if (!is_null($archivos)) {
            foreach ($archivos as $key => $value) {
                echo ' <script type="text/javascript" src="' . $pathScript . $value . '"></script> ';
            }
        }

        echo "
            <!--Start of Zopim Live Chat Script-->
            <script type=\"text/javascript\">
            window.\$zopim||(function(d,s){var z=\$zopim=function(c){z._.push(c)},\$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];\$.async=!0;\$.setAttribute('charset','utf-8');
            \$.src='//v2.zopim.com/?2LN80sG1Ycy2ny3QOJcrwlC3PKvNCw11';z.t=+new Date;\$.
            type='text/javascript';e.parentNode.insertBefore(\$,e)})(document,'script');
            </script>
            <!--End of Zopim Live Chat Script-->
        ";
    }

    public function estilos_scripts_modulos() {
        $this->cargar_estilos_modulos();
        $this->cargar_scripts_modulos();
    }

    public function ruta() {

        echo $this->ruta_tmpl_login;
    }

    public function ruta_admin() {

        echo $this->ruta_tmpl_admin;
    }

    public function ruta_archivos() {

        echo $this->ruta_url_archivos;
    }

    public function cargar_scripts_modulos($value = '') {
        foreach ($_SESSION['SESION_MODULOS_ACTIVOS'] as $key => $value) {
            $dirScript = "componentes" . DS . $value->NOMBRE_MODULO . DS . "funciones" . DS;
            $pathScript = "componentes/" . $value->NOMBRE_MODULO . "/funciones/";
            $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirScript, 'js');
            if (!is_null($archivos))
                foreach ($archivos as $key => $value) {
                    echo ' <script type="text/javascript" src="' . $pathScript . $value . '"></script> ';
                }
        }
    }

    public function cargar_estilos_modulos($value = '') {

        foreach ($_SESSION['SESION_MODULOS_ACTIVOS'] as $key => $modulo) {
            $dirEstilo = "componentes" . DS . $modulo->NOMBRE_MODULO . DS . "estilos" . DS;
            $pathEstilo = "componentes/" . $modulo->NOMBRE_MODULO . "/estilos/";
            $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirEstilo, 'css');
            if (!is_null($archivos))
                foreach ($archivos as $key => $value) {
                    echo '<link rel="stylesheet" type="text/css" href="' . $pathEstilo . $value . '" /> ';
                }
        }
    }

    public function saca_dominio_url($url) {
        $url = explode('/', str_replace('www.', '', str_replace('http://', '', $url)));
        return $url[0];
    }

}
