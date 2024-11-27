<?php
	class Correos extends PHPMailer{
		
		public function __construct()
	    {
	    	
			$params = Parametros::singleton();
		
	        $this->Host = 'localhost';
	        $this->From = "".$params->valor('CORREOEMPRESA')."";
			$this->FromName = "".$params->valor('NOMBREEMPRESA')."";
	    	$this->AltBody = "".$params->valor('ESLOGANEMPRESA')."";
	    	
	    }
	
		function agregarDestinos($str){			
			$cc = explode(';', $str);
			foreach($cc as $ccMail ){
				$dtsCC = explode(',', $ccMail );
				$this->AddAddress($dtsCC[1],$dtsCC[0]);	
			}
			
		}
	
		function agregarCC($strCC){			
			$cc = explode(';', $strCC);
			foreach($cc as $ccMail ){
				$dtsCC = explode(',', $ccMail );
				$this->AddCC($dtsCC[1],$dtsCC[0]);	
			}
			
		}
	
		function agregarCCO($str){			
			$cc = explode(';', $str);
			foreach($cc as $ccMail ){
				$dtsCC = explode(',', $ccMail );
				$this->AddBCC($dtsCC[1],$dtsCC[0]);	
			}			
		}	
		
		function agregarReenvio($str){			
			$cc = explode(';', $str);
			foreach($cc as $ccMail ){
				$dtsCC = explode(',', $ccMail );
				$this->AddReplyTo($dtsCC[1],$dtsCC[0]);	
			}			
		}
	
	}
?>