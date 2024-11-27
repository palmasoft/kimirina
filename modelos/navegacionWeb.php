<?php

class NavegacionWebModel extends ModelBase {

    public static $sqlBase = "                
        SELECT 
            navegacion_web.*,
            pemar.ID_POBLACION 
          FROM
            navegacion_web 
            LEFT JOIN pemar 
              ON (
                navegacion_web.ID_PEMAR = pemar.ID_POBLACION
              )  
          
	";

    public static function todo() {
        $query = self::$sqlBase . " GROUP BY navegacion_web.CODIGO_PEMAR,  navegacion_web.SESSION_ID ORDER BY navegacion_web.FECHA_SYSTEMA DESC LIMIT 10000";
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

}
