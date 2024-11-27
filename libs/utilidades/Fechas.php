<?php
	class Fechas {
		
		function diasEntreFechas($date1, $date2)
		{
		    if (!is_integer($date1)) $date1 = strtotime($date1);
		    if (!is_integer($date2)) $date2 = strtotime($date2);
		    
		    $dias = abs($date1 - $date2) / 60 / 60 / 24;
		   	return $dias;
		}
		
		
		function sumardias($fecha, $dias)
	  {	
            
  			if ( preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha)) {
            list($dia, $mes, $ano) = split("/", $fecha);
        }
        
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha)) {
            list($ano, $mes, $dia) = split("-", $fecha);
        }
        
  			$nueva = mktime(0, 0, 0, $mes, $dia, $ano) + $dias * 24 * 60 * 60;
	        $nuevafecha = date("Y-m-d", $nueva);
	        return $nuevafecha;
	
	    }
	
	    function dias_mes($Month, $Year)
	    {
	        //Si la extensi�n que mencion� est� instalada, usamos esa.
	        if (is_callable("cal_days_in_month")) {
	            return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
	        } else {
	            //Lo hacemos a mi manera.
	            return date("d", mktime(0, 0, 0, $Month + 1, 0, $Year));
	        }
	    }
        
        function convertirFecha2Texto($inputDate, $dateFormat=1) {
            //eval($idioma);
            
            switch ($dateFormat) {
               case 1:
                    return date('F d, Y h:i:s A', strtotime($inputDate));
               break;
        
               case 2:
                    return date('F d, Y G:i:s', strtotime($inputDate));
               break;
        
               case 3:
                    return date('M d, Y h:i:s A', strtotime($inputDate));
               break;
        
               case 4:
                    return date('M d, Y G:i:s', strtotime($inputDate));
               break;
            }
        }
			
		
		    
	
	}
?>