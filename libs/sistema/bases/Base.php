<?php
/**
 * Clase base para la carga de todas las clases de lalibreria class
 *
 * @package Bases
 * @author  Juan Pablo Llinas Ramirez
 */
abstract class Base {

    protected static $db;
    protected static $config;
    protected static $params;
    protected static $pdf;
    protected $plantilla;
    protected $vista;
    protected $errores;
    protected $modelo;
    protected $controlador;
    protected $datos = array();
    protected $enviados = array();
    protected $fechas;
    protected $correos;
    protected $formularios;
    protected $spdo;
    protected $spdo_base;

    function __construct() {
        self::$config = Config::singleton();
        self::$db = SPDO::singleton();
        self::$params = Parametros::singleton();
    }

}
