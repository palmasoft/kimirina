<?php

class gestoresSubreceptoresModel extends ModelBase {

    public static function todos() {
        $query = "SELECT
    personas_sistema.ID_PERSONA
    , personas_sistema.ID_ROL_TIPOUSUARIO
    , personas_sistema.NOMBRE_REAL_PERSONA
    , gestor_subreceptores.ID_SUBRECEPTOR_GESTOR
    , gestor_subreceptores.ID_SUBRECEPTOR
    , subreceptores.SIGLAS_SUBRECEPTOR
FROM
    gestor_subreceptores
    LEFT JOIN personas_sistema 
        ON (gestor_subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA)
    LEFT JOIN subreceptores 
        ON (gestor_subreceptores.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
        WHERE gestor_subreceptores.ACTIVO = 'SI'         
";
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }
    
     public static function datos($id) {
        $query = "SELECT
    personas_sistema.ID_PERSONA
    , personas_sistema.ID_ROL_TIPOUSUARIO
    , personas_sistema.NOMBRE_REAL_PERSONA
    , gestor_subreceptores.*
    , subreceptores.SIGLAS_SUBRECEPTOR
FROM
    gestor_subreceptores
    LEFT JOIN personas_sistema 
        ON (gestor_subreceptores.ID_GESTOR = personas_sistema.ID_PERSONA)
    LEFT JOIN subreceptores 
        ON (gestor_subreceptores.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
   WHERE gestor_subreceptores.ID_SUBRECEPTOR_GESTOR = $id";

        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta[0];
        return 0;
    }
    
    public static function insertar($ID_GESTOR, $SUBRECEPTOR) {
       $query = "  INSERT INTO gestor_subreceptores
            (
             ID_GESTOR,
             ID_SUBRECEPTOR,
             FECHA_CREACION)
                VALUES ($ID_GESTOR,
                        $SUBRECEPTOR, 
                        CURRENT_TIMESTAMP)";
        return self::crear_ultimo_id($query);
    }
    
    public static function eliminar($ID) {
       $query = "  UPDATE gestor_subreceptores
               SET ACTIVO = 'NO' 
               WHERE ID_SUBRECEPTOR_GESTOR = $ID";
        return self::modificarRegistros($query);
    }
      
    
     public static function update($id, $ID_GESTOR, $SUBRECEPTOR) {
       $query = " UPDATE gestor_subreceptores set
               ID_GESTOR = $ID_GESTOR,
                ID_SUBRECEPTOR = $SUBRECEPTOR,
                 FECHA_MODIFICACION = CURRENT_TIMESTAMP
                    where ID_SUBRECEPTOR_GESTOR=$id";
        return self::modificarRegistros($query);
    }
    
    
}

?>