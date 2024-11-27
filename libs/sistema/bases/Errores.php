<?php

class Errores
{
    public static $codigo = '0000';

    public function valorError() {
        return self::$codigo;
    }

    public static function error101(){
    	self::$codigo = '101';
    	echo "ERROR " . self::$codigo ;
    }
}

?>