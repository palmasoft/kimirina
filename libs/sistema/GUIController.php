<?php

/*
  El FrontController es el que recibe todas las peticiones,
  incluye algunos ficheros, busca el controlador y llama a la acci�n que corresponde.
 */

class GUIController {

    static function main() {        
        
        session_start(); 
        if (!isset($_SESSION["SESION_SINAP"])) {
           session_regenerate_id(TRUE);           
        }       
        session_name("SINAP");


        //Configuracion y Parametros        
        require 'libs/sistema/configuracion/Config.php'; //de configuracion
        require 'configuracion.php'; //de configuracion

        require 'libs/sistema/configuracion/SPDO.php'; //Controlador de Cosultas a la BD | PDO con singleton 
        require 'libs/sistema/configuracion/Parametros.php'; //de Parametros
        //Controladores Basicos       
        require 'libs/sistema/bases/Base.php'; //Clase controlador base      
        require 'libs/sistema/bases/ControllerBase.php'; //Clase controlador base
        require 'libs/sistema/bases/ModelBase.php'; //Clase modelo base
        require 'libs/sistema/bases/ViewBase.php'; //Clase modelo base        
        require 'libs/sistema/bases/Errores.php'; //adminsitra los errores del sistema

        require 'libs/sistema/Controladores.php'; //Mini motor de Drivers
        require 'libs/sistema/Vistas.php'; //Mini motor de plantillas
        require 'libs/sistema/Modelos.php'; //Mini motor de Mdelos	   
        //
        require 'modelos/usuario.php'; //Modelo Publico del USUARIO	   
        //Controladores GUI		
        require 'libs/html/Plantillas.php'; //adminsitra las vista para los errores dle sistema
        //Controladores UTILIDADES
        require 'libs/utilidades/SistemaArchivos.php'; //adminsitra las vista para los errores dle sistema



        if (!isset($_SESSION["SESION_SINAP"])) {
            $dir_plantilla = $config->get('plantillas') . $params->valor('ADMINTEMPLATE') . 'login.php';
        } else {            
            $dir_plantilla = $config->get('plantillas') . $params->valor('ADMINTEMPLATE') . 'admin.php';
            //session_destroy();	
        }



        if (is_file($dir_plantilla)) {
            $plantilla = new plantillas();
            include $dir_plantilla;
        } else {
            Errores::error101();
            return false;
        }
    }

    static function ejecutar_accion() {

        session_start();
        session_name("SINAP");

        //Controladores UTILIDADES
        require 'libs/utilidades/SistemaArchivos.php'; //adminsitra las vista para los errores dle sistema
        //
        //
        //
        //Configuracion y Parametros        
        require 'libs/sistema/configuracion/Config.php'; //de configuracion  
        require 'configuracion.php'; //de configuracion      
        require 'libs/sistema/configuracion/SPDO.php'; //Controlador de Cosultas a la BD | PDO con singleton 
        require 'libs/sistema/configuracion/Parametros.php'; //de Parametros
        //Controladores Basicos       
        require 'libs/sistema/bases/Base.php'; //Clase controlador base      

        require 'libs/sistema/bases/ControllerBase.php'; //Clase controlador base
        require 'libs/sistema/bases/ModelBase.php'; //Clase modelo base
        require 'libs/sistema/bases/ViewBase.php'; //Clase modelo base        
        require 'libs/sistema/bases/Errores.php'; //adminsitra los errores del sistema


        require 'libs/sistema/Controladores.php'; //Mini motor de Drivers
        require 'libs/sistema/Vistas.php'; //Mini motor de plantillas


        require 'libs/sistema/Modelos.php'; //Mini motor de Mdelos
        $dirEstilo = "modelos" . DS;
        $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirEstilo, 'php');
        if (!is_null($archivos)) {
            foreach ($archivos as $key => $value) {
                require $dirEstilo . $value;
            }
        }       
        
        
        
        
        
        
        

        //Controladores GUI		
        require 'libs/html/Plantillas.php'; //adminsitra las vista para los errores dle sistema
        require 'libs/html/Formularios.php'; //adminsitra las vista para los errores dle sistema
        require 'libs/html/AlertasHTML5.php'; //adminsitra las vista para los errores dle sistema

        require 'libs/pdf/tcpdf/tcpdf.php'; //GENERADOR DE PDF
        require 'libs/pdf/html2pdf/html2fpdf.php'; //adminsitra los pdf
        require 'libs/pdf/GeneradorPDF.php'; //generador generico para el proyecto 
        require 'libs/excel/Classes/PHPExcel.php'; //GENERADOR DE EXCEL
        require 'libs/excel/GeneradorExcel.php'; //generador generico para el proyecto       
        
        $dirEstilo = "impresos" . DS ."informes" . DS;
        $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirEstilo, 'php');
        if (!is_null($archivos)) {
            foreach ($archivos as $key => $value) {
                require $dirEstilo . $value;
            }
        }        
        $dirEstilo = "impresos" . DS ."reportes" . DS;
        $archivos = Archivos::listar_archivos_directorio(CARP_BASE . $dirEstilo, 'php');
        if (!is_null($archivos)) {
            foreach ($archivos as $key => $value) {
                require $dirEstilo . $value;
            }
        }
        
        //Con el objetivo de no repetir nombre de clases, nuestros controladores
        //terminaran todos en Controller. Por ej, la clase controladora Items, ser� ItemsController
        //Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
        if (!empty($_POST['controlador'])) {
            $nombreControlador = $_POST['controlador'];
        } elseif (!empty($_GET['controlador']))
            $nombreControlador = $_GET['controlador'];
        else
            $nombreControlador = "sistema";




        //Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
        if (!empty($_POST['modulo'])) {
            $nombreModulo = strtolower($_POST['modulo']);
        } elseif (!empty($_GET['modulo'])) {
            $nombreModulo = strtolower($_GET['modulo']);
        } else {
            $nombreModulo = "sistema";
        }


        //Lo mismo sucede con las acciones, si no hay accion, tomamos index como accion
        if (!empty($_POST['accion'])) {
            $nombreAccion = $_POST['accion'];
        } elseif (!empty($_GET['accion']))
            $nombreAccion = $_GET['accion'];
        else {
            $nombreAccion = "Inicio";
        }

        //Incluimos el fichero que contiene nuestra clase controladora solicitada
        $controllerPath = $config->get('componentes') . $nombreModulo . '/controladores/' . $nombreControlador . '.php';
        if (is_file($controllerPath)) {
            require $controllerPath;
        } else {
            //$errores = new Errores();
            //$errores->nombreControlador = $nombreControlador;
            //$errores->rutaArchivo = $controllerPath;
            //$errores->error101();				
            return false;
        }



        //Si no existe la clase que buscamos y su accion, tiramos un error 404
        /*
          if (is_callable(array($nombreControlador, $nombreAccion)) == false) {
          echo $controllerPath ;
          $errores = new Errores();
          $errores->nombreControlador = $nombreControlador;
          $errores->nombreAccion = $nombreAccion;
          $errores->error102();
          return false;

          }
         */


        $nombreControlador.= 'Controlador';
        $controller = new $nombreControlador();
        $controller->$nombreAccion();


    }

}
