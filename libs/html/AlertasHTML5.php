<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
abstract class AlertasHTML5 {
    
    public static $warning = '<div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-warning-sign"></i> Atención</strong> %s
            </div>';        
    public static $success = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-info-sign"></i> Muy Bien!</strong> %s
            </div>';        
    public static $info = '<div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-info-sign"></i> Información</strong> %s
            </div>';        
        
    public static $error = '<div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-warning-sign"></i>Error!</strong> %s
            </div>';        
                
    public static function exito($mensaje) {
        return sprintf( self::$success, $mensaje );
        
    }
    public static function advertencia($mensaje) {
        return sprintf( self::$warning,  $mensaje );
        
    }
    public static function informacion($mensaje) {        
        return sprintf( self::$info, $mensaje );
        
    }
    public static function error($mensaje) {
        return sprintf( self::$error, $mensaje );
        
    }

}
