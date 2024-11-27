<?php

class EventosReferidosEfectivos extends ModelBase {
    
    public static $sqlBase = "
        SELECT
            eventos_masivos.*, personas_sistema.*, subreceptores.*
            , lugares_intervencion.* , cantones.*, provincias.*
            , tipo_lugares.* , tipo_usuario.*
            , digitador.`NOMBRE_REAL_PERSONA` AS NOMBRE_DIGITADOR
            , modifica.`NOMBRE_REAL_PERSONA` AS NOMBRE_MODIFICA
            , elimina.`NOMBRE_REAL_PERSONA` AS NOMBRE_ELIMINA
            , eventos_masivos.FECHA_CREACION AS FECHA_CREACION_EVENTO_MASIVO
            , eventos_masivos.FECHA_MODIFICACION AS FECHA_MODIFICACION_EVENTO_MASIVO
            , eventos_masivos.FECHA_ELIMINACION AS FECHA_ELIMINACION_EVENTO_MASIVO
            , (SELECT CANTIDAD_INSUMO FROM eventos_masivos_insumos WHERE eventos_masivos_insumos.ID_EVENTO_MASIVO = eventos_masivos.ID_EVENTO_MASIVO 
                AND eventos_masivos_insumos.ID_INSUMO = 1 ) as NUM_CONDONES
            , (SELECT CANTIDAD_INSUMO FROM eventos_masivos_insumos WHERE eventos_masivos_insumos.ID_EVENTO_MASIVO = eventos_masivos.ID_EVENTO_MASIVO 
                AND eventos_masivos_insumos.ID_INSUMO = 2 ) as NUM_LUBRICANTES
            , (SELECT CANTIDAD_INSUMO FROM eventos_masivos_insumos WHERE eventos_masivos_insumos.ID_EVENTO_MASIVO = eventos_masivos.ID_EVENTO_MASIVO 
                AND eventos_masivos_insumos.ID_INSUMO = 3 ) as NUM_FOLLETOS
        FROM
            eventos_masivos
            INNER JOIN lugares_intervencion 
                ON (eventos_masivos.ID_LUGAR_EVENTO_MASIVO = lugares_intervencion.ID_LUGAR)
            INNER JOIN personas_sistema 
                ON (eventos_masivos.ID_RESPONSABLE_EVENTO_MASIVO = personas_sistema.ID_PERSONA)
            INNER JOIN cantones 
                ON (lugares_intervencion.ID_CANTON = cantones.ID_CANTON)
            INNER JOIN tipo_lugares 
                ON (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
            INNER JOIN provincias 
                ON (cantones.ID_PROVINCIA = provincias.ID_PROVINCIA)
            INNER JOIN subreceptores 
                ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR)
            INNER JOIN tipo_usuario 
                ON (personas_sistema.ID_ROL_TIPOUSUARIO = tipo_usuario.ID_ROL)
            LEFT JOIN personas_sistema AS digitador
                ON (eventos_masivos.ID_DIGITA = digitador.ID_PERSONA)
            LEFT JOIN personas_sistema AS modifica
                ON (eventos_masivos.ID_MODIFICA = modifica.ID_PERSONA)
            LEFT JOIN personas_sistema AS elimina
                ON (eventos_masivos.ID_ELIMINACION = elimina.ID_PERSONA)
        ";
    //public static $sqlGroup = " GROUP  BY registro_semanal.id_registrosemanal ORDER BY registro_semanal.FECHA_CREACION DESC ";
    public static $filtroPeriodo = " INNER JOIN periodos ON ( eventos_masivos.FECHA_EVENTO_MASIVO  <= periodos.FECHA_MAX_PERIODO AND periodos.ACTUAL = 'SI' ) ";
    public static $filtroActivo = " eventos_masivos.ACTIVO = 'SI' ";
    public static $filtroSR = " AND personas_sistema.ID_SUBRECEPTOR = ";

    public static function datos( $idEventoMasivo ) {        
        $query = self::$sqlBase . " WHERE " . self::$filtroActivo . " AND eventos_masivos.ID_EVENTO_MASIVO = ".$idEventoMasivo."  ";
//        if ( Usuario::tiene_restricciones() && !UsuariosModel::esGestor() ) {
//            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
//        }
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta[0];
        }
        return 0;
    }
    
    public static function todos() {        
        $query = self::$sqlBase . " " . self::$filtroPeriodo . " WHERE " . self::$filtroActivo . "  ";
//        if ( Usuario::tiene_restricciones() && !UsuariosModel::esGestor() ) {
//            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
//        }
       
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }
    
    public static function todos_gestion() {        
        $query = self::$sqlBase . " " . self::$filtroPeriodo;
//        if ( Usuario::tiene_restricciones() && !UsuariosModel::esGestor() ) {
//            $query .= self::$filtroSR . " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " ";
//        }
       
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    static public function insertar(
            $FECHA_EVENTO_MASIVO,  $ID_LUGAR_EVENTO_MASIVO,  $ID_RESPONSABLE_EVENTO_MASIVO,
            $NUM_EFECTIVOS_EVENTO_MASIVO,  $MOTIVO_EVENTO_MASIVO, $EMPRESA_ORGANIZA_ACTIVIDAD) {
        $query = "INSERT INTO eventos_masivos (
            FECHA_EVENTO_MASIVO,  ID_LUGAR_EVENTO_MASIVO,  ID_RESPONSABLE_EVENTO_MASIVO,
            NUM_EFECTIVOS_EVENTO_MASIVO,  MOTIVO_EVENTO_MASIVO, EMPRESA_ORGANIZA_ACTIVIDAD, ID_DIGITA ) 
            VALUES (
            '" . $FECHA_EVENTO_MASIVO. "', '" . $ID_LUGAR_EVENTO_MASIVO. "', '" . $ID_RESPONSABLE_EVENTO_MASIVO. "',
            '" . $NUM_EFECTIVOS_EVENTO_MASIVO. "',  '" . $MOTIVO_EVENTO_MASIVO. "', '" . $EMPRESA_ORGANIZA_ACTIVIDAD. "',
            " . $_SESSION['SESION_USUARIO']->ID_PERSONA . "
        )";
        return self::crear_ultimo_id($query);
    }

    static public function actualizar(
        $ID_EVENTO_MASIVO, $FECHA_EVENTO_MASIVO,  $ID_LUGAR_EVENTO_MASIVO,  $ID_RESPONSABLE_EVENTO_MASIVO,
        $NUM_EFECTIVOS_EVENTO_MASIVO,  $MOTIVO_EVENTO_MASIVO, $EMPRESA_ORGANIZA_ACTIVIDAD) {
        $query = "
            UPDATE eventos_masivos SET
              FECHA_EVENTO_MASIVO = '" . $FECHA_EVENTO_MASIVO. "',
              ID_LUGAR_EVENTO_MASIVO = '" . $ID_LUGAR_EVENTO_MASIVO. "',
              ID_RESPONSABLE_EVENTO_MASIVO = '" . $ID_RESPONSABLE_EVENTO_MASIVO. "',
              NUM_EFECTIVOS_EVENTO_MASIVO = '" . $NUM_EFECTIVOS_EVENTO_MASIVO. "',
              MOTIVO_EVENTO_MASIVO = '" . $MOTIVO_EVENTO_MASIVO. "',
              EMPRESA_ORGANIZA_ACTIVIDAD = '" . $EMPRESA_ORGANIZA_ACTIVIDAD. "',
              FECHA_MODIFICACION = CURRENT_TIMESTAMP,
              ID_MODIFICA = '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "'
            WHERE ID_EVENTO_MASIVO = '" . $ID_EVENTO_MASIVO. "' ;";
        return self::modificarRegistros($query);        
    }

    static public function eliminar($idEvento) {
        $query = " UPDATE eventos_masivos SET ACTIVO = 'NO', FECHA_ELIMINACION = CURRENT_TIMESTAMP, "
                . "ID_ELIMINACION = '" . $_SESSION['SESION_USUARIO']->ID_PERSONA . "'  WHERE ID_EVENTO_MASIVO =  " . $idEvento . "; ";
        return self::modificarRegistros($query);
    }
    
    static public function agregar_condones( $ID_EVENTO_MASIVO, $CANTIDAD_INSUMO ) {
        return EventosReferidosEfectivosInsumos::insertar($ID_EVENTO_MASIVO, 1, $CANTIDAD_INSUMO);
    }
    static public function agregar_lubricantes( $ID_EVENTO_MASIVO, $CANTIDAD_INSUMO ) {
        return EventosReferidosEfectivosInsumos::insertar($ID_EVENTO_MASIVO, 2, $CANTIDAD_INSUMO);
    }
    static public function agregar_folletos( $ID_EVENTO_MASIVO, $CANTIDAD_INSUMO ) {
        return EventosReferidosEfectivosInsumos::insertar($ID_EVENTO_MASIVO, 3, $CANTIDAD_INSUMO);
    }

}