<?php

class importarDatosAbordajesControlador extends ControllerBase {
    

    function importar_datos_promotor() {
        
        $encabezados[] = new stdClass();
        $registros[][] = new stdClass();  

        $SubreceptorAnt="";
        $PoblacionAnt="";
        $NombrePromotorAnt="";
        $CantonAnt="";

        $NoEnc = -1;
        $NoReg = 0;
                
        $tipo = $this->enviados['archivo']['type']; 
        //$tamano = $_FILES['archivo']['size']; 
        $archivotmp = $this->enviados['archivo']['tmp_name'];

        $respuesta = new stdClass();
        $respuesta->mensaje = "";
        
        /*if (is_uploaded_file(        $archivotmp = $this->enviados['archivo']['tmp_name'])) {
            echo "File ". $this->enviados['archivo']['name'] ." uploaded successfully.\n";
            echo "Displaying contents\n";
            readfile($this->enviados['archivo']['tmp_name']);
         }*/
        
        if( $tipo == 'application/vnd.ms-excel'){

            $archivo = CARP_BASE.'archivos/importar/bd.csv';

            if( move_uploaded_file($archivotmp, $archivo) ){
               $respuesta->estado = true;
            } else {
               $respuesta->estado = false;
               echo $respuesta->mensaje = "El archivo no se pudo subir al servidor, inténtalo mas tarde";
            }

            if($respuesta->estado){
                
                $lineas = file($archivo);
                
                foreach ($lineas as $linea_num => $linea)
                {
                   
                   if($linea_num==0)
                       continue;
                   
                   $datos = explode(";",utf8_encode($linea));
                   
                
                   if(count($datos) < 25 ){
                       echo "El archivo no tiene la cantidad de datos necesarios para inciar la importacion";
                       exit();
                   }
                   
                   foreach ($datos as $key => $value) {
                       $datos[$key]=$this->sanear_string($datos[$key]);
                   }
                   
                   $subreceptor = trim($datos[0]);
                   $poblacion = trim($datos[1]);
                   $nombre_promotor = trim($datos[2]);
                   $canton = trim($datos[3]);

                   
                   if(strcasecmp($subreceptor,$SubreceptorAnt)!=0 || strcasecmp($poblacion,$PoblacionAnt)!=0 ||
                           strcasecmp($nombre_promotor,$NombrePromotorAnt)!=0 || strcasecmp($canton,$CantonAnt)!=0){

                       $NoEnc ++;
                       $NoReg = 0;
                       $SubreceptorAnt=$subreceptor;
                       $PoblacionAnt=$poblacion;
                       $NombrePromotorAnt=$nombre_promotor;
                       $CantonAnt=$canton;
                   }


                   //$subreceptor = trim($datos[0]);
                   $dSr = SubreceptoresModel::id_subreceptor($subreceptor);
                   
                   if( !$dSr ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Subreceptores";
                      break;
                   }else{
                       $encabezados[$NoEnc]->Subreceptor=$dSr;
                   }

                   //$poblacion = trim($datos[1]);
                   $poblacion;
                   $dPb = TiposPoblacionModel::idPoblacionConCodigo($poblacion);
                   if( !$dPb ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Poblacion";
                      break;
                   }
                   else{
                       $encabezados[$NoEnc]->Poblacion=TiposPoblacionModel::codigoPoblacionConCodigo($poblacion);;
                       $encabezados[$NoEnc]->Tipo_Poblacion=$dPb;
                   }

                   /*$nombre_coordinador = trim($datos[2]);
                   $nombre_coordinador = "Janet Diaz"; //Avisar
                   $dNc = PersonasSistemaModel::personaID($nombre_coordinador);
                   //Aca devuelve un objeto stdClass
                   if( !$dNc ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Coordinador(a)/ Supervisor(a) de Equipos Locales o el usuario no esta activo";
                      break;
                   }else{
                       $encabezados[$NoEnc]->Coordinador=$dNc;
                   }*/

                   //$nombre_promotor = trim($datos[3]);
                   //$nombre_promotor = "Gloria Estrella Villacres Zambrano"; //Avisar
                   $dNp = PersonasSistemaModel::personaID($nombre_promotor);
                   if( !$dNp ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Promotor(a) o el usuario no esta activo";
                      break;
                   }else{
                       $encabezados[$NoEnc]->Promotor=$dNp;
                   }

                   /*$provincia = trim($datos[4]);
                   $dPv = ProvinciasModel::provinciaPorNombre($provincia);
                   if( !$dPv ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Provincia";
                      break;
                   }else{
                       $encabezados[$NoEnc]->Provincia=$dPv;
                   }*/

                   //$canton = trim($datos[5]);
                   $dCt = CantonesModel::cantonPorNombre($canton);
                   if( !$dCt ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Cantón/Ciudad.";
                      break;
                   }else{
                       $encabezados[$NoEnc]->Canton=$dCt;
                   }

                   //FIN ENCABEZADO
                   

                   $tipo_lugar_abordaje = trim($datos[4]);
                   $dTl = TiposLugaresModel::tipoLugarPorNombre($tipo_lugar_abordaje);
                   if( !$dTl ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Tipo Lugar de Abordaje";
                      break;
                   }
                   else{
                       $registros[$NoEnc][$NoReg]->Tipo_Lugar=$dTl;
                   }
                   
                   //ESTE FALTA
                   $lugar_abordaje = trim($datos[5]);
                   $dLa = LugaresIntervencionModel::lugar_nombre_tipolugar_canton($dTl, $dCt, $lugar_abordaje);
                   if( !$dLa ){
                       $dLa = LugaresIntervencionModel::otroLugar_nombre_tipolugar_canton($dTl, $dCt);
                       $registros[$NoEnc][$NoReg]->Lugar=$dLa;
                      /*$respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Lugar de Abordaje";
                      break;*/
                   }
                   else{
                       $registros[$NoEnc][$NoReg]->Lugar=$dLa;
                   }
                   
                   
                   $nombre_persona = trim($datos[6]);
                   if(preg_match("|^[a-zA-ZÑñ]+(\s*[a-zA-ZÑñ]*)*[a-zA-ZÑñ]+$|",$nombre_persona)){
                       $array_nombre_persona = explode(" ", $nombre_persona);
                       if(count($array_nombre_persona)==4 || count($array_nombre_persona)==3 || count($array_nombre_persona)==2)
                           $registros[$NoEnc][$NoReg]->Nombre_Persona=$array_nombre_persona;
                       else{
                           $respuesta->estado = false;
                           $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Persona. El nombre no posee los datos necesarios para construir el codigo";
                           break;
                       }
                           
                   }else{
                       $respuesta->estado = false;
                       $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Persona";
                       break;
                   }

                   $otro_nombre_persona = trim($datos[7]);   
                   if($otro_nombre_persona==""){
                           $otro_nombre_persona="NA";
                            $registros[$NoEnc][$NoReg]->Otro_Nombre_Persona=$otro_nombre_persona;
                   }else{
                       $registros[$NoEnc][$NoReg]->Otro_Nombre_Persona=$otro_nombre_persona;
                   }
                   

                   $cc = trim($datos[8]);   
                   if($cc=="")
                           $cc="NA";
                   $registros[$NoEnc][$NoReg]->Cedula=$cc;
                   
                   $tel = trim($datos[9]);   
                   if($tel==""){
                           $tel="NA";
                           $registros[$NoEnc][$NoReg]->Telefono=$tel;
                    }
                   else{
                       $registros[$NoEnc][$NoReg]->Telefono=$tel;
                   }
                   
                   
                   $sexo = trim($datos[10]);   
                   $dSx = TiposPoblacionModel::sexoPoblacion($dPb);
                   if( !$dSx ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Provincia";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Sexo=$dSx;//????
                   }
                   
                  $edad = trim($datos[11]);
                   if( !is_numeric($edad) || $edad=="" || $edad<0){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Edad";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Edad=$edad;
                   }

                   $trabajo_sexual = strtoupper(trim($datos[12]));   
                   if($trabajo_sexual==""){
                           $trabajoSexual = TiposPoblacionModel::poblacionTrabajoSexual($dPb);
                           if($trabajoSexual=="TS")
                               $trabajoSexual="SI";
                           else
                               $trabajoSexual="NO";
                           
                           $registros[$NoEnc][$NoReg]->Trabajo_Sexual=$trabajo_sexual;
                   }else if($trabajo_sexual=="SI" || $trabajo_sexual=="NO")
                       $registros[$NoEnc][$NoReg]->Trabajo_Sexual=$trabajo_sexual;
                   else{
                       $respuesta->estado = false;
                       $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna Realiza Trabajo Sexual";
                       break;
                   }

                   $fecha_alcance = explode("/",trim($datos[13]));
                   if(!checkdate((int)$fecha_alcance[1], $fecha_alcance[0], $fecha_alcance[2]) ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Fecha de Alcance";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Fecha_Alcance=  trim($datos[13]);
                   }
                   
                   $hora_alcance = trim($datos[14]);
                   if(preg_match("#([0-1]*[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $hora_alcance))
                           $registros[$NoEnc][$NoReg]->Hora_Alcance=$hora_alcance;
                   else{
                       $respuesta->estado = false;
                       $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Hora Realizacion Alcance";
                       break;
                   }

                   $tipo_alcance = strtoupper(trim($datos[15]));
                   if($tipo_alcance=="N")
                       $registros[$NoEnc][$NoReg]->Tipo_Alcance="NUEVO";
                   else if($tipo_alcance=="R")
                       $registros[$NoEnc][$NoReg]->Tipo_Alcance="RECURRENTE";
                   else{
                       $respuesta->estado = false;
                       $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Tipo Alcance";
                       break;
                   }
                   $informacion = trim($datos[16]);
                   //$informacion = "Servicios de salud";
                   $dTm = TemasModel::temaConNombre($informacion);
                   if( !$dTm ){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Tema";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Informacion=$dTm;
                   }

                   $cantidad = trim($datos[17]);                   
                   if( !is_numeric($cantidad) || $cantidad=="" || $cantidad<0){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Cantidad";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Cantidad=$cantidad;
                   }
                   
                   $condones = trim($datos[18]);
                   if( !is_numeric($condones) || $condones=="" || $condones<0){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de No. de condones entregados";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Condones=$condones;
                   }

                   $lubricantes = trim($datos[19]);
                   if( !is_numeric($lubricantes) || $lubricantes=="" || $lubricantes<0){
                      $respuesta->estado = false;
                      $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de No. de lubricantes";
                      break;
                   }else{
                       $registros[$NoEnc][$NoReg]->Lubricantes=$lubricantes;
                   }

                   $atendido_servicio_salud = strtoupper(trim($datos[20])); 
                   if($atendido_servicio_salud==""){
                           $atendido_servicio_salud="NO";
                           $registros[$NoEnc][$NoReg]->Atendido_Servicio_Salud=$atendido_servicio_salud;
                   }else if($atendido_servicio_salud=="SI" || $atendido_servicio_salud=="NO"){
                           $registros[$NoEnc][$NoReg]->Atendido_Servicio_Salud=$atendido_servicio_salud;
                   }else{
                       $respuesta->estado = false;
                       $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Atendido Servicio de Salud";
                       break;
                   }
                   if($atendido_servicio_salud=="SI"){
                        $fecha_atencion_servicio_salud = explode("/",trim($datos[21]));
                        if(!checkdate($fecha_atencion_servicio_salud[1], $fecha_atencion_servicio_salud[0], $fecha_atencion_servicio_salud[2]) ){
                           $respuesta->estado = false;
                           $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Fecha de Atencion del Servicio de Salud";
                           break;
                        }else{
                            $registros[$NoEnc][$NoReg]->Fecha_Atencion_Servicio_Salud=  trim($datos[21]);
                        }

                        $hora_atencion = trim($datos[22]);
                        if(preg_match("#([0-1]*[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $hora_atencion))
                                $registros[$NoEnc][$NoReg]->Hora_Atencion_Servicio_Salud=$hora_atencion;
                        else{
                            $respuesta->estado = false;
                            $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Hora de Atencion";
                            break;
                        }


                        $centro_servicio_salud = trim($datos[23]);

                        if($centro_servicio_salud!=""){
                         $dCs = centrosserviciossaludModel::centroPorNombre($centro_servicio_salud);
                         if( !$dCs ){
                            $respuesta->estado = false;
                            $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre de servicio de salud";
                            break;
                         }else{
                             $registros[$NoEnc][$NoReg]->Centro_Servicio_Salud=$dCs;
                         }
                        }
                   }else{
                       $registros[$NoEnc][$NoReg]->Fecha_Atencion_Servicio_Salud=  trim($datos[21]);
                       $registros[$NoEnc][$NoReg]->Hora_Atencion_Servicio_Salud=trim($datos[22]);
                       $registros[$NoEnc][$NoReg]->Centro_Servicio_Salud=trim($datos[23]);
                   }
                   $observaciones = trim($datos[24]);
                   $registros[$NoEnc][$NoReg]->Observaciones=$observaciones;

                   $NoReg ++;
                   
                }
            //Después verificamos si no hubo algún error al leer y guardar la información, si es así el mensaje indicara que todo ocurrió correctamente, también colocamos el else de la primer condición sobre el tipo de archivo en la cual ponemos el mensaje de error correspondiente. Al final se imprime la variable respuesta como json.
            }
                if($respuesta->estado == true){
                    //Aqui hacemos los inserts
                    /*foreach ($encabezados as $key => $value) {
                        $query = queryEnc.$value[$key]->Provincia.",".$value[$key]->Canton.",".$value[$key]->Poblacion.","
                            .$value[$key]->Promotor.",".$value[$key]->Coordinador.")";
                    }*/
                    
                    $id_condones = InsumosModel::idInsumo("CONDONES");
                    $id_lubricantes = InsumosModel::idInsumo("LUBRICANTES");
                    $id_folleteria = InsumosModel::idInsumo("FOLLETERIA");
                    
                    for($i=0;$i<count($encabezados);$i++) {
                        $fecha_menor_comparar=implode('', array_reverse(explode('/', $registros[$i][0]->Fecha_Alcance)));
                        $fecha_mayor_comparar=implode('', array_reverse(explode('/', $registros[$i][0]->Fecha_Alcance)));
                        
                        for($j=0;$j<count($registros[$i]);$j++) {
                            $fecha_comparar = implode('', array_reverse(explode('/', $registros[$i][$j]->Fecha_Alcance)));
                            
                            if($fecha_comparar<=$fecha_menor_comparar){
                                $fecha_menor=$registros[$i][$j]->Fecha_Alcance;
                                $fecha_menor_comparar=$fecha_comparar;
                            }
                            if($fecha_comparar>=$fecha_mayor_comparar){
                                $fecha_mayor=$registros[$i][$j]->Fecha_Alcance;
                                $fecha_mayor_comparar=$fecha_comparar;
                            }
                        }
                        
                        $fecha_mayor = explode("/", $fecha_mayor);
                        $fecha_menor = explode("/", $fecha_menor);
                        $semana_del = $fecha_menor[2]."-".$fecha_menor[1]."-".$fecha_menor[0];
                        $semana_hasta = $fecha_mayor[2]."-".$fecha_mayor[1]."-".$fecha_mayor[0];
                        
                        $periodo_registro_semanal = explode("/",$registros[$i][0]->Fecha_Alcance);
                        $provincia = CantonesModel::idProvinciaDelCanton($encabezados[$i]->Canton);
                        
                        
                        $query = "(".$provincia.",".$encabezados[$i]->Canton.",".$encabezados[$i]->Poblacion.","
                                        .$periodo_registro_semanal[2].$periodo_registro_semanal[1].",".$semana_del.","
                                        .$semana_hasta.",".$_SESSION['SESION_USUARIO']->ID_PERSONA.",".$encabezados[$i]->Promotor.",'')";
                        
                        $id_encabezado = RegistroSemanalModel::insertar($provincia, $encabezados[$i]->Canton, $encabezados[$i]->Poblacion, $periodo_registro_semanal[2].$periodo_registro_semanal[1], $semana_del, $semana_hasta, $encabezados[$i]->Promotor, 'nada');
                        
                        

                        for($j=0;$j<count($registros[$i]);$j++) {
                            
                            
                            $fecha_abordaje = explode("/",$registros[$i][$j]->Fecha_Alcance);
                            $fecha = new DateTime($fecha_abordaje[2].'-'.$fecha_abordaje[1].'-'.$fecha_abordaje[0]);
                            $fecha->sub(new DateInterval('P'.($registros[$i][$j]->Edad*12).'M'));
                            $fecha_nacimiento = explode("-", $fecha->format('Y-m-d'));
                            
                            if($registros[$i][$j]->Fecha_Atencion_Servicio_Salud!="")
                                $fecha_atencion = explode("/",$registros[$i][$j]->Fecha_Atencion_Servicio_Salud);
                            
                            else
                                $fecha_atencion = "";
                            
                            if(count($registros[$i][$j]->Nombre_Persona)==4){
                                    //echo "codigo de 4";
                                    $nombre_persona1 = $registros[$i][$j]->Nombre_Persona[2];
                                    $nombre_persona2 = $registros[$i][$j]->Nombre_Persona[3];
                                    $apellido_persona1 = $registros[$i][$j]->Nombre_Persona[0];
                                    $apellido_persona2 = $registros[$i][$j]->Nombre_Persona[1];
                                    $codigo_unico_persona = substr(strtoupper($nombre_persona1),0,2).substr(strtoupper($nombre_persona2),0,2).substr(strtoupper($apellido_persona1),0,2).substr(strtoupper($apellido_persona2),0,2).$fecha_nacimiento[1].substr($fecha_nacimiento[0],-2);
                            }
                            else
                                if(count($registros[$i][$j]->Nombre_Persona)==3){
                                    //echo "codigo de 3";
                                    $nombre_persona1 = $registros[$i][$j]->Nombre_Persona[2];
                                    $nombre_persona2 = "";
                                    $apellido_persona1 = $registros[$i][$j]->Nombre_Persona[0];
                                    $apellido_persona2 = $registros[$i][$j]->Nombre_Persona[1];
                                    $codigo_unico_persona = substr(strtoupper($nombre_persona1),0,2)."00".substr(strtoupper($apellido_persona1),0,2).substr(strtoupper($apellido_persona2),0,2).$fecha_nacimiento[1].substr($fecha_nacimiento[0],-2);
                                }
                                else
                                    if(count($registros[$i][$j]->Nombre_Persona)==2){
                                        //echo "codigo de 2";
                                        $nombre_persona1 = $registros[$i][$j]->Nombre_Persona[1];
                                        $nombre_persona2 = "";
                                        $apellido_persona1 = $registros[$i][$j]->Nombre_Persona[0];
                                        $apellido_persona2 = "";
                                        $codigo_unico_persona = substr(strtoupper($nombre_persona1),0,2)."00".substr(strtoupper($apellido_persona1),0,2)."00".$fecha_nacimiento[1].substr($fecha_nacimiento[0],-2);
                                    }
                            
                            //$ID_SERVICIO_SALUD = "";
                            
                            if(!PemarsModel::validar_codigo($codigo_unico_persona))
                                $id_pemar = PemarsModel::guardar_pemar($encabezados[$i]->Tipo_Poblacion, $codigo_unico_persona, $fecha_nacimiento[1], $fecha_nacimiento[0], $registros[$i][$j]->Sexo, $nombre_persona1, $apellido_persona1, $nombre_persona2, $apellido_persona2, $encabezados[$i]->Canton);
                            else
                                $id_pemar = PemarsModel::validar_codigo($codigo_unico_persona);
                            
                            if($fecha_atencion!="")
                                $id_registro_semanal_contacto = RegistroSemanalContactosModel::insertarPromotores($id_encabezado, $fecha_abordaje[2].'-'.$fecha_abordaje[1].'-'.$fecha_abordaje[0], $registros[$i][$j]->Hora_Alcance.':00', $id_pemar, $encabezados[$i]->Tipo_Poblacion, $registros[$i][$j]->Tipo_Lugar, $registros[$i][$j]->Lugar, $registros[$i][$j]->Edad, $registros[$i][$j]->Sexo, $registros[$i][$j]->Trabajo_Sexual, $registros[$i][$j]->Tipo_Alcance, $registros[$i][$j]->Informacion, $fecha_atencion[2].'-'.$fecha_atencion[1].'-'.$fecha_atencion[0], $registros[$i][$j]->Hora_Atencion_Servicio_Salud.':00', $registros[$i][$j]->Centro_Servicio_Salud);
                            
                            else
                                $id_registro_semanal_contacto = RegistroSemanalContactosModel::insertarPromotores($id_encabezado, $fecha_abordaje[2].'-'.$fecha_abordaje[1].'-'.$fecha_abordaje[0], $registros[$i][$j]->Hora_Alcance.':00', $id_pemar, $encabezados[$i]->Tipo_Poblacion, $registros[$i][$j]->Tipo_Lugar, $registros[$i][$j]->Lugar, $registros[$i][$j]->Edad, $registros[$i][$j]->Sexo, $registros[$i][$j]->Trabajo_Sexual, $registros[$i][$j]->Tipo_Alcance, $registros[$i][$j]->Informacion, '' , '', '');
                            RegistroSemanalInsumosModel::insertar($id_registro_semanal_contacto, $id_condones, $registros[$i][$j]->Condones);
                            RegistroSemanalInsumosModel::insertar($id_registro_semanal_contacto, $id_lubricantes, $registros[$i][$j]->Lubricantes);
                            RegistroSemanalInsumosModel::insertar($id_registro_semanal_contacto, $id_folleteria, $registros[$i][$j]->Cantidad);
                             
                        }
                     }
                   $respuesta->mensaje = "Todos los registros se guardaron correctamente\n";
                   unlink(CARP_BASE.'archivos/importar/bd.csv');
                }
                else{
                    echo $respuesta->errormsg;
                }
            }
            else {
               $respuesta->mensaje = "La información no se guardo debido a que solo se admiten archivos .csv\n";
        }
         echo $respuesta->mensaje;
    }
    
    
    function mostrar_form_importar_promotores(){
        
        $this->vista->mostrar("importaDatos/promotores", $this->datos);
        
    }  
    
    function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array( 'ç', 'Ç'),
            array( 'c', 'C',),
            $string
        );


        return $string;
    }
    
}

?>