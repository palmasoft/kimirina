<?php
/*
SPDO es una clase que extiende de PDO, su �nica ventaja es que nos permite
aplicar el patron Singleton para mantener una �nica instancia de PDO.
*/
class SPDO extends PDO
{
    private static $instance = null;

    public static function recargar(){
        self::$instance = new self();
    }

    public function __construct()
    {
        $config = Config::singleton();
		
		try {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 '
                , PDO::ATTR_PERSISTENT => true
            ); 
			parent::__construct( 
				'' . $config->get('dbtype') . ':dbname='. $config->get('dbname') .';host=' . $config->get('dbhost'). '', 
				$config->get('dbuser'), $config->get('dbpass') , $options
			);
            //self::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
		}
		catch(PDOException $e){
			echo '<script>alert( "HA OCURRIDO UN ERROR AL INTENTAR CONECTARSE CON EL MOTOR DE DATOS EN '.$config->get('dbtype') . ':dbname='. $config->get('dbname') .';host=' . $config->get('dbhost').';user:'.$config->get('dbuser').' \n\r'.$e->getMessage().'");</script>' ;
		}
		
    }

    public static function singleton()
    {
        if( self::$instance == null )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>