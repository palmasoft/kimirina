<?php
/*
Es una pequeña clase de configuración con un funcionamiento muy sencillo,
implementa el patron singleton para mantener una única instancia y poder acceder
a sus valores desde cualquier sitio.
 */
class Parametros
{
    protected $db;
    protected $db_sistema;
	
    public static $instance;

    public function __construct() {
        $this->db = SPDO::singleton();
    }

    public function consulta($query) {
        $consulta = $this->db->prepare($query);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS);
    }
    
    function modificarRegistros($query) {
         $consulta = $this->db->prepare($query);
        
			$consulta->execute();                  
        	return $consulta->rowCount();         	
	
		return '0';
    }
	
	public function valor($param){
		$sql = "select VALOR from parametros where PARAMETRO = '".$param."' limit 0, 1";
		$resultado = $this->consulta($sql);
		return $resultado[0]->VALOR;
		
	}
	
	public function nombre($param){
		$sql = "select NOMBRE_PARAMETRO from parametros where PARAMETRO = '".$param."' limit 0, 1";
		$resultado = $this->consulta($sql);
		return $resultado[0]->NOMBRE_PARAMETRO;
	}    
	
	public function descripcion($param){
		$sql = "select 	DESCRIPCION from parametros where PARAMETRO = '".$param."' limit 0, 1";
		$resultado = $this->consulta($sql);
		return $resultado[0]->DESCRIPCION;
	}
    
    public function set($parametro,$valor){
		$sql = "update parametros set VALOR = '".$valor."' where PARAMETRO='".$parametro."'";
		$resultado = $this->modificarRegistros($sql);		
		return $resultado;
	}
	
	public function compararValores($param, $valor){
		$vParam = $this->valor($param);
		if($vParam == $valor){
			return true;		
		}			
		return false;
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


$params = Parametros::singleton();

?>