<?php
/*
Es una peque�a clase de configuraci�n con un funcionamiento muy sencillo,
implementa el patron singleton para mantener una �nica instancia y poder acceder
a sus valores desde cualquier sitio.
 */
class Config
{
    public  $vars;
    public static $instance;

    private function __construct()
    {
        $this->vars = array();     
    }

    //Con set vamos guardando nuestras variables.
    public function set($name,$value){        
        if(!isset($this->vars[$name])){
            $this->vars[$name] = $value;
        }
    }

    //Con get('nombre_de_la_variable') recuperamos un valor.
    public function get($name){
        if(isset($this->vars[$name]))
        {
            return $this->vars[$name];
        }
    }

    public function update($name,$value)
    {

            return $this->vars[$name]=$value;
    }

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    
}
$config = Config::singleton();        
