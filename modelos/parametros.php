<?php

class parametrosModel extends ModelBase {    

    public static function todos(){
            $query = "SELECT * FROM parametros";
            $consulta = self::consulta( $query );
            if (count($consulta) > 0) {
                return $consulta;
            }
            return 0; 
    }
}