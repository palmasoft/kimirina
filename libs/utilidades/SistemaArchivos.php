<?php

class Archivos {

    public static function mover_archivo_recibido($archivo, $rutaCarpeta, $nombreArchivo = '') {


        $dondeGuardar = CARP_BASE . "archivos" . DS . $rutaCarpeta;
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (($archivo["type"] != "application/exe") && ($archivo["size"] < 8000000)) {
                $file = ( empty($nombreArchivo) ? Archivos::limpiarCaracteresEspeciales($archivo['name']) : $nombreArchivo );
                self::probar_crear_directorio($dondeGuardar);
                if ($file && move_uploaded_file($archivo ['tmp_name'], $dondeGuardar . $file)) {
                    return TRUE;
                }else{
                     return  "<h5>Error Cargando el archivo " . $archivo ['name'] . ".</h5>";
                }
            } else {
                return "<h3>El archivo " . $archivo ['name'] . " excede el tamaño permitido.</h3><h5>Tamaño del Archivo: ".($archivo["size"]/1).";</h5s>";
            }
        } else {            
            return  "<h3>Error Procesando el archivo " . $archivo ['name'] . ".</h3>";
        }
    }

    public static function probar_crear_directorio($ruta) {
        $ok = TRUE;
        $carpetas = explode(DS, $ruta);
        $rActual = "";
        foreach ($carpetas as $carpeta) {
            $rActual .= $carpeta . DS;
            if (!is_dir($rActual)) {
                if( mkdir($rActual, 0777) ){
                    $ok = FALSE;
                }
            }
        }
        return $ok;
    }

    public static function listar_directorios_ruta($rutaDir) {

        $listado = array();
        if (is_dir($rutaDir)) {
            if ($dh = opendir($rutaDir)) {
                while (($file = readdir($dh)) !== false) {
                    $listado[] = $ruta . $file;
                    if (is_dir($ruta . $file) && $file != "." && $file != "..") {
                        $listado = array_merge($listado, $this->listar_directorios_ruta($ruta . $file . "/"));
                    } else {
                        
                    }
                }
                closedir($dh);
            }
        } else {
            return null;
        }
        return $listado;
    }

    public static function listar_archivos_directorio($rutaDir, $ext = null) {

        $listado = array();
        if (is_dir($rutaDir)) {

            if ($dh = opendir($rutaDir)) {
                while (($file = readdir($dh)) !== false) {
                    if (!is_dir($rutaDir . $file) && $file != "." && $file != "..") {
                        if (is_null($ext)) {
                            $listado[] = $file;
                        } else {
                            $partesFile = pathinfo($file);
                            if ($partesFile['extension'] == $ext) {
                                $listado[] = $file;
                            }
                        }
                    }
                }
                closedir($dh);
            }
        } else {
            return null;
        }
        return $listado;
    }

    static public function limpiarCaracteresEspeciales($string) {
        $string = str_replace(' ', '-', $string);
        $string = htmlentities($string);
        $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
        return $string;
    }

}
