<?php

class RegistroSemanalContactosModel extends ModelBase {

    public static $sqlBase = " 
        SELECT 
             pemar.*
           , tipo_poblacion.CODIGO_TIPOPOBLACION
           , tipo_poblacion.NOMBRE_TIPOPOBLACION
           , tipo_poblacion.ALIAS_TIPOPOBLACION
           , tipo_lugares.CODIGO_TIPOLUGAR
           , tipo_lugares.NOMBRE_TIPOLUGAR
           , lugares_intervencion.NOMBRE_LUGAR
           , lugares_intervencion.DIRECCION_LUGAR
           , subreceptores.*
           , personas_sistema.NOMBRE_REAL_PERSONA
           , temas.TITULO_TEMA
           , temas.DESCRIPCION_TEMA
           , centros_servicios_salud.NOMBRE_CENTROSERVICIO
           , tipo_centro_salud.CODIGO_TIPO_CENTROSERVICIO
           , tipo_centro_salud.NOMBRE_TIPO_CENTROSERVICIO
           , servicios_salud.NOMBRE_SERVICIO
           , servicios_salud.CODIGO_SERVICIO
           , registro_semanal.TIPO_FORMATO_REGISTROSEMANAL 
           , registro_semanal.ID_PROMOTOR
           , registro_semanal.NUM_REGISTROSEMANAL
           , registro_semanal_contacto.*,
               (
               SELECT registro_semanal_insumo_entregado.CANTIDAD 
               FROM registro_semanal_insumo_entregado 
               WHERE registro_semanal_insumo_entregado.ID_INSUMO = 1 AND registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO = registro_semanal_contacto.ID_REGISTRO_CONTACTO
               ) AS NUM_CONDONES,
               (
               SELECT registro_semanal_insumo_entregado.CANTIDAD 
               FROM registro_semanal_insumo_entregado 
               WHERE registro_semanal_insumo_entregado.ID_INSUMO = 2 AND registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO = registro_semanal_contacto.ID_REGISTRO_CONTACTO
               ) AS NUM_LUBRICANTES,
               (
               SELECT registro_semanal_insumo_entregado.CANTIDAD 
               FROM registro_semanal_insumo_entregado 
               WHERE registro_semanal_insumo_entregado.ID_INSUMO = 3 AND registro_semanal_insumo_entregado.ID_REGISTRO_CONTACTO = registro_semanal_contacto.ID_REGISTRO_CONTACTO
               ) AS NUM_FOLLETOS
       FROM
           registro_semanal_contacto
           LEFT JOIN pemar 
               ON (registro_semanal_contacto.ID_PEMAR = pemar.ID_POBLACION)
           LEFT JOIN tipo_poblacion 
               ON (registro_semanal_contacto.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION)
           LEFT JOIN tipo_lugares 
               ON (registro_semanal_contacto.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
           LEFT JOIN lugares_intervencion 
               ON (registro_semanal_contacto.ID_LUGAR = lugares_intervencion.ID_LUGAR)
           LEFT JOIN temas 
               ON (registro_semanal_contacto.ID_TEMA_CONTACTO = temas.ID_TEMA)
           LEFT JOIN centros_servicios_salud 
               ON (registro_semanal_contacto.ID_CENTROSERVICIO_DERIVA = centros_servicios_salud.ID_CENTROSERVICIO)
           LEFT JOIN servicios_salud 
               ON (registro_semanal_contacto.ID_SERVICIO_SALUD = servicios_salud.ID_SERVICIO) AND (pemar.ID_TIPOPOBLACION = tipo_poblacion.ID_TIPOPOBLACION) AND (lugares_intervencion.ID_TIPOLUGAR = tipo_lugares.ID_TIPOLUGAR)
           LEFT JOIN tipo_centro_salud 
               ON (centros_servicios_salud.ID_TIPO_CENTROSERVICIO = tipo_centro_salud.ID_TIPO_CENTROSERVICIO)
           LEFT JOIN registro_semanal
                       ON (registro_semanal_contacto.ID_REGISTROSEMANAL = registro_semanal.ID_REGISTROSEMANAL)
           LEFT JOIN personas_sistema 
                       ON (registro_semanal.ID_PROMOTOR = personas_sistema.ID_PERSONA)
           LEFT JOIN subreceptores 
                  ON (personas_sistema.ID_SUBRECEPTOR = subreceptores.ID_SUBRECEPTOR) ";
    
    public static $sqlGroup = "";
    
    public static $filtroActivo = " personas_sistema.ACTIVO = 'SI' ";  
    
    public static $filtroSubreceptor = " personas_sistema.ID_SUBRECEPTOR =   ";
    
    public static $filtroCanton = " registro_semanal.ID_CANTON = ";
    
    public static $filtroProvincia = " registro_semanal.ID_PROVINCIA = ";
    
    public static $filtroPromotor = " registro_semanal.ID_PROMOTOR = ";
        
    public static $filtroEstadoRevision = " registro_semanal.ESTADO_REVISION= 'APROBADO'";       
        
    public static $filtroPeriodo = " periodos.ID_PERIODO = ";

    public static function todos() {
        $query = self::$sqlBase . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0)
            return $consulta;
        return 0;
    }

    public static function contactos_en_el_registro($ID_REGISTROSEMANAL) {
        $query = self::$sqlBase . " WHERE registro_semanal_contacto.ID_REGISTROSEMANAL = " . $ID_REGISTROSEMANAL . "  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_codPemar($codPemar) {
        $query = self::$sqlBase . " WHERE  pemar.CODIGO_UNICO_PERSONA = '" . $codPemar . "'  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function datos_por_cedPemar($cedPemar) {
        $query = self::$sqlBase . " WHERE  pemar.CI_POBLACION = '" . $cedPemar . "'  " . self::$sqlGroup;
        $consulta = self::consulta($query);
        if (count($consulta) > 0) {
            return $consulta;
        }
        return 0;
    }

    public static function insertar(
    $ID_REGISTROSEMANAL, $FECHA_CONTACTO, $HORA_CONTACTO, $ID_PEMAR, $ID_TIPOPOBLACION, $ID_TIPOLUGAR, $ID_LUGAR, 
            $PRIMER_NOMBRE_PEMAR, $SEGUNDO_NOMBRE_PEMAR, $PRIMER_APELLIDO_PEMAR, $SEGUNDO_APELLIDO_PEMAR, $OTRO_NOMBRE_PEMAR, 
            $CEDULA_PEMAR, $VERIFICADO_PEMAR, $TELEFONO_PEMAR, $EDAD_CONTACTO, $SEXO_CONTACTO, $TRABAJO_SEXUAL_CONTACTO, $TIPO_ALCANCE_CONTACTO, $TIPO_RECURRENCIA_CONTACTO, $ID_TEMA_CONTACTO, $FECHA_ATENCION_CENTROSERVICIO, $HORA_ATENCION_CENTROSERVICIO, $ID_CENTROSERVICIO_DERIVA, $ID_SERVICIO_SALUD, $OBSERVACIONES_CONTACTO
    ) {

        $query = "INSERT INTO registro_semanal_contacto (
                    ID_REGISTROSEMANAL,
                    FECHA_CONTACTO,
                    HORA_CONTACTO,
                    ID_PEMAR,
                    ID_TIPOPOBLACION,
                    ID_TIPOLUGAR,
                    ID_LUGAR,
                    PRIMER_NOMBRE_PEMAR,
                    SEGUNDO_NOMBRE_PEMAR,
                    PRIMER_APELLIDO_PEMAR,
                    SEGUNDO_APELLIDO_PEMAR,
                    OTRO_NOMBRE_PEMAR,
                    CEDULA_PEMAR,
                    VERIFICADO_PEMAR,
                    TELEFONO_PEMAR,
                    EDAD_CONTACTO,
                    SEXO_CONTACTO,
                    TRABAJO_SEXUAL_CONTACTO,
                    TIPO_ALCANCE_CONTACTO,
                    TIPO_RECURRENCIA_CONTACTO,
                    ID_TEMA_CONTACTO,
                    FECHA_ATENCION_CENTROSERVICIO,
                    HORA_ATENCION_CENTROSERVICIO,
                    ID_CENTROSERVICIO_DERIVA,
                    ID_SERVICIO_SALUD,
                    OBSERVACIONES_CONTACTO
                  ) VALUES (    
                       " . $ID_REGISTROSEMANAL . ", 
                      '" . $FECHA_CONTACTO . "', 
                      '" . $HORA_CONTACTO . "', 
                      '" . $ID_PEMAR . "', 
                      '" . $ID_TIPOPOBLACION . "',
                      '" . $ID_TIPOLUGAR . "', 
                      '" . $ID_LUGAR . "',
                      '" . $PRIMER_NOMBRE_PEMAR . "',
                      '" . $SEGUNDO_NOMBRE_PEMAR . "',
                      '" . $PRIMER_APELLIDO_PEMAR . "',
                      '" . $SEGUNDO_APELLIDO_PEMAR . "',
                      '" . $OTRO_NOMBRE_PEMAR . "',
                      '" . $CEDULA_PEMAR . "',
                      '" . $VERIFICADO_PEMAR . "',
                      '" . $TELEFONO_PEMAR . "',
                      '" . $EDAD_CONTACTO . "', 
                      '" . $SEXO_CONTACTO . "', 
                      '" . $TRABAJO_SEXUAL_CONTACTO . "',
                      '" . $TIPO_ALCANCE_CONTACTO . "', 
                      '" . $TIPO_RECURRENCIA_CONTACTO . "', 
                      '" . $ID_TEMA_CONTACTO . "',
                      '" . $FECHA_ATENCION_CENTROSERVICIO . "', 
                      '" . $HORA_ATENCION_CENTROSERVICIO . "', 
                      " . ($ID_CENTROSERVICIO_DERIVA == '' ? 'NULL' : $ID_CENTROSERVICIO_DERIVA ) . ",
                      " . ($ID_SERVICIO_SALUD == '' ? 'NULL' : $ID_SERVICIO_SALUD ) . ",
                      '" . $OBSERVACIONES_CONTACTO . "' )";
        return self::crear_ultimo_id($query);
    }

    public function eliminar_contactos_del_registro($ID_RGISTROSEMANAL) {
        $query = "delete from registro_semanal_contacto where ID_REGISTROSEMANAL = " . $ID_RGISTROSEMANAL . " ; ";
        return self::modificarRegistros($query);
    }

    public static function insertarPromotores($ID_RGISTROSEMANAL, $FECHA_CONTACTO, $HORA_CONTACTO, $ID_PEMAR, $ID_TIPOPOBLACION, $ID_TIPOLUGAR, $ID_LUGAR, $EDAD_CONTACTO, $SEXO_CONTACTO, $TRABAJO_SEXUAL_CONTACTO, $TIPO_ALCANCE_CONTACTO, $ID_TEMA_CONTACTO, $FECHA_ATENCION_CENTROSERVICIO, $HORA_ATENCION_CENTROSERVICIO, $ID_CENTROSERVICIO_DERIVA) {

        $query = "
        insert into registro_semanal_contacto (
                ID_REGISTROSEMANAL, 
                FECHA_CONTACTO, 
                HORA_CONTACTO, 
                ID_PEMAR, 
                ID_TIPOPOBLACION, 
                ID_TIPOLUGAR, 
                ID_LUGAR, 
                EDAD_CONTACTO, 
                SEXO_CONTACTO, 
                TRABAJO_SEXUAL_CONTACTO, 
                TIPO_ALCANCE_CONTACTO, 
                ID_TEMA_CONTACTO, 
                FECHA_ATENCION_CENTROSERVICIO, 
                HORA_ATENCION_CENTROSERVICIO, 
                ID_CENTROSERVICIO_DERIVA
	) values (
            " . $ID_RGISTROSEMANAL . ", 
            '" . $FECHA_CONTACTO . "', 
            '" . $HORA_CONTACTO . "', 
            '" . $ID_PEMAR . "', 
            '" . $ID_TIPOPOBLACION . "',
            '" . $ID_TIPOLUGAR . "', 
            '" . $ID_LUGAR . "',
            '" . $EDAD_CONTACTO . "', 
            '" . $SEXO_CONTACTO . "', 
            '" . $TRABAJO_SEXUAL_CONTACTO . "',
            '" . $TIPO_ALCANCE_CONTACTO . "', 
            '" . $ID_TEMA_CONTACTO . "',
            '" . $FECHA_ATENCION_CENTROSERVICIO . "', 
            '" . $HORA_ATENCION_CENTROSERVICIO . "', 
            " . ($ID_CENTROSERVICIO_DERIVA == '' ? 'NULL' : $ID_CENTROSERVICIO_DERIVA ) . "
        )";
        return self::crear_ultimo_id($query);
    }
    
    public static function registros_semanales_promotores($promotor, $periodo, $provincia, $canton){       
             
        $filtro = "INNER JOIN periodos
      ON (  registro_semanal.SEMANA_DEL >= periodos.FECHA_MIN_PERIODO 
      AND registro_semanal.SEMANA_HASTA <= periodos.FECHA_MAX_PERIODO ) 
                        WHERE registro_semanal.ACTIVO = 'SI' AND ";
        
        if( $canton != "" ){
            $filtro .= self::$filtroCanton.$canton." and";
        }else if( $provincia != "" ){
            $filtro .= self::$filtroProvincia.$provincia." and";
        }
        
        $filtro .= self::$filtroPromotor.$promotor." and ".self::$filtroEstadoRevision.
                " and ".self::$filtroPeriodo.$periodo;
        
        $consulta = self::consulta( self::$sqlBase.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta;
        }
    }



    public static function todos_registros_semanales_promotores($promotor, $periodo, $provincia, $canton){       
             
        $filtro = "INNER JOIN periodos
      ON (  registro_semanal.SEMANA_DEL >= periodos.FECHA_MIN_PERIODO 
      AND registro_semanal.SEMANA_HASTA <= periodos.FECHA_MAX_PERIODO ) 
                        WHERE registro_semanal.ACTIVO = 'SI' AND ";
        
        if( $canton != "" ){
            $filtro .= self::$filtroCanton.$canton." and";
        }else if( $provincia != "" ){
            $filtro .= self::$filtroProvincia.$provincia." and";
        }
        
        
        $filtro .= self::$filtroSubreceptor. " " . $_SESSION['SESION_USUARIO']->ID_SUBRECEPTOR . " AND  ";
        
        $filtro .= self::$filtroPromotor.$promotor." and ".self::$filtroPeriodo.$periodo;
        
        //echo self::$sqlBase.$filtro."***********";
        $consulta = self::consulta( self::$sqlBase.$filtro );
        
        if (count($consulta) > 0) {
            return $consulta;
        }
    }

}
