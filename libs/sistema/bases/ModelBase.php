<?php

abstract class ModelBase extends Base  {
	
	public function __construct()
	{
   		parent::__construct();			
	}	
		
    public function iniciarTransaccion(){
        // First of all, let's begin a transaction
        self::$db->beginTransaction();
    }
    
    public function aceptarTransaccion(){
        // First of all, let's begin a transaction
        self::$db->commit();
    }
    
    public function cancelarTransaccion(){
        // First of all, let's begin a transaction
        self::$db->rollBack();
    }
    
    
    public function prepararConsulta($query){
    	$consulta = null;		
    	try {
		   $consulta = self::$db->prepare($query);
		   if (!$consulta) {
			    echo "\nInformacion del Error :\n";
			    print_r( self::$db->errorInfo() );
		   }
		} catch (PDOException $e) {
		   echo "Error de Base de Datos: " . $e->getMessage() . "\r\n";
		}	        
		return $consulta;
		
		
	} 

    public function consulta($query) {
        $consulta = self::prepararConsulta($query);
        if( $consulta != null ){        	
          try {
                $consulta->execute();                    
      		} catch (Exception $e) {
      		   echo "Error Consultando: " . $e->getMessage() . "\r\n";
      		} catch (PDOException $e) {
      		   echo "Error de Base de Datos: " . $e->getMessage() . "\r\n";
      		}	  
          return $consulta->fetchAll(PDO::FETCH_CLASS);
        } 
        // and now we're done; close it
        //self::$db = null;
		  return '0'; 
    }
    
    public function crear_ultimo_id($query) {
        $consulta = self::prepararConsulta($query);
        if( $consulta != null ){
            $consulta->execute();                  
            return self::$db->lastInsertId();	
        }
        // and now we're done; close it
        self::$db = null;
        return '0';
    }

 public function modificarRegistros($query) {
        $consulta = self::prepararConsulta($query);
        if( $consulta != null ){
			$consulta->execute();                  
        	return $consulta->rowCount();         	
		}
        // and now we're done; close it
        self::$db = null;
		return '0';
    }

	

}

?>