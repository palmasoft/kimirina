<?php
$queryEnc = "
        insert into registro_semanal (
            ID_PROVINCIA, 
            ID_CANTON, 
            TIPO_FORMATO_REGISTROSEMANAL,
            ID_DIGITADOR, 
            ID_PROMOTOR, 
	) values (";

$queryReg = "
        insert into registro_semanal_contacto ( 
                ID_PEMAR, ????
                ID_TIPOPOBLACION, 
                ID_TIPOLUGAR,??? 
                ID_LUGAR, 
                EDAD_CONTACTO, 
                SEXO_CONTACTO, 
                TRABAJO_SEXUAL_CONTACTO, 
                TIPO_ALCANCE_CONTACTO, 
                ID_TEMA_CONTACTO, 
                FECHA_ATENCION_CENTROSERVICIO, 
                HORA_ATENCION_CENTROSERVICIO, 
                ID_CENTROSERVICIO_DERIVA, 
                ID_SERVICIO_SALUD
	) values (";

$encabezados[] = new stdClass();
$registros[][] = new stdClass();  

$SubreceptorAnt="";
$PoblacionAnt="";
$NombreCoorAnt="";
$NombrePromotorAnt="";
$ProvinciaAnt="";
$CantonAnt="";

$NoEnc = -1;
$NoReg = 0;

$tipo = $_FILES['archivo']['type']; 
//$tamano = $_FILES['archivo']['size']; 
$archivotmp = $_FILES['archivo']['tmp_name'];

$respuesta = new stdClass();
$respuesta->mensaje = "";

if( $tipo == 'application/vnd.ms-excel'){

$archivo = "bd.csv";
 
if( move_uploaded_file($archivotmp, $archivo) ){
   $respuesta->estado = true;
} else {
   $respuesta->estado = false;
   $respuesta->mensaje = "El archivo no se pudo subir al servidor, inténtalo mas tarde";
}
if($respuesta->estado){
    
$lineas = file('bd.csv');
    foreach ($lineas as $linea_num => $linea)
    {
       $datos = explode(";",$linea);
       
       $subreceptor = trim($datos[0]);
       $poblacion = trim($datos[1]);
       $nombre_coordinador = trim($datos[2]);
       $nombre_promotor = trim($datos[3]);
       $provincia = trim($datos[4]);
       $canton = trim($datos[5]);
       
       if($subreceptor!=$SubreceptorAnt || $poblacion!=$PoblacionAnt || $nombre_coordinador!=$NombreCoorAnt || 
               $nombre_promotor!=$NombrePromotorAnt || $provincia!=$ProvinciaAnt || $canton!=$CantonAnt){
           
           $NoEnc ++;
           $NoReg = 0;
           $SubreceptorAnt=$subreceptor;
           $PoblacionAnt=$poblacion;
           $NombreCoorAnt=$nombre_coordinador;
           $NombrePromotorAnt=$nombre_promotor;
           $ProvinciaAnt=$provincia;
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
       $dPb = TiposPoblacionModel::poblacionConCodigo($poblacion);
       if( !$dPb ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Poblacion";
          break;
       }
       else{
           $encabezados[$NoEnc]->Poblacion=$dPb;
       }
       
       //$nombre_coordinador = trim($datos[2]);
       $dNc = PersonasSistemaModel::personaID($nombre_coordinador);
       if( !$dNc ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Coordinador(a)/ Supervisor(a) de Equipos Locales o el usuario no esta activo";
          break;
       }else{
           $encabezados[$NoEnc]->Coordinador=$dNc;
       }
       
       //$nombre_promotor = trim($datos[3]);
       $dNp = PersonasSistemaModel::personaID($nombre_promotor);
       if( !$dNp ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre Promotor(a) o el usuario no esta activo";
          break;
       }else{
           $encabezados[$NoEnc]->Promotor=$dNp;
       }
       
       //$provincia = trim($datos[4]);
       $dPv = ProvinciasModel::provinciaPorNombre($provincia);
       if( !$dPv ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Provincia";
          break;
       }else{
           $encabezados[$NoEnc]->Provincia=$dPv;
       }
       
       //$canton = trim($datos[5]);
       $dCt = Cantones::cantonPorNombre($canton, $dPv);
       if( !$dCt ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Cantón/Ciudad. Podria no corresponder a la Provincia";
          break;
       }else{
           $encabezados[$NoEnc]->Canton=$dCt;
       }
       
       //FIN ENCABEZADO
       
       
       $lugar_abordaje = trim($datos[6]);
       $dLa = LugaresIntervencionModel::lugarPorNombre($lugar_abordaje, $dCt);
       if( !$dLa ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Lugar Abordaje. Podria no corresponder al Canton";
          break;
       }
       else{
           $registros[$NoEnc][$NoReg]->Lugar=$dLa;
       }
       
       $nombre_persona = trim($datos[7]);
       if($nombre_persona=="")
               $nombre_persona="NA";
       $registros[$NoEnc][$NoReg]->Nombre_Persona=$nombre_persona;
       
       $otro_nombre_persona = trim($datos[8]);   
       if($otro_nombre_persona=="")
               $otro_nombre_persona="NA";
       $registros[$NoEnc][$NoReg]->Otro_Nombre_Persona=$otro_nombre_persona;
                      
       $cc = trim($datos[9]);   
       if($cc=="")
               $cc="NA";
       $registros[$NoEnc][$NoReg]->Cedula=$cc;
       
       $sexo = trim($datos[10]);   
       if($sexo=="")
               $sexo = TiposPoblacionModel::sexoPoblacion($dPb);
       $registros[$NoEnc][$NoReg]->Sexo=$sexo;
       
       $edad = trim($datos[11]);
       if( !is_int($edad) || $edad==""){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Edad";
          break;
       }else{
           $registros[$NoEnc][$NoReg]->Edad=$edad;
       }
       
       $trabajo_sexual = trim($datos[12]);   
       if($trabajo_sexual=="");
               //$trabajoSexual = TiposPoblacionModel::sexoPoblacion($dPb);
       $registros[$NoEnc][$NoReg]->Trabajo_Sexual=$trabajo_sexual;
       
       $fecha_alcance = trim($datos[13]);
       $registros[$NoEnc][$NoReg]->Fecha_Alcance=$fecha_alcance;
       
       $tipo_alcance = trim($datos[14]);
       $registros[$NoEnc][$NoReg]->Tipo_Alcance=$tipo_alcance;
       
       $informacion = trim($datos[15]);
       $dIf = TemasModel::IDTemas($informacion);
       if( !$dIf ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Informacion";
          break;
       }
       else{
           $registros[$NoEnc][$NoReg]->Informacion=$dIf;
       }
       
       $cantidad = trim($datos[16]);
       if( !is_int($cantidad) || $cantidad==""){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Cantidad";
          break;
       }else{
           $registros[$NoEnc][$NoReg]->Cantidad=$cantidad;
       }
       
       $condones = trim($datos[17]);
       if( !is_int($condones) || $condones==""){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de No. de condones entregados";
          break;
       }else{
           $registros[$NoEnc][$NoReg]->Condones=$condones;
       }
       
       $lubricantes = trim($datos[18]);
       if( !is_int($lubricantes) || $lubricantes==""){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de No. de lubricantes";
          break;
       }else{
           $registros[$NoEnc][$NoReg]->Lubricantes=$lubricantes;
       }
       
       $atendido_servicio_salud = trim($datos[19]);   
       if($atendido_servicio_salud=="")
               $atendido_servicio_salud="NO"; //??
       $registros[$NoEnc][$NoReg]->Atendido_Servicio_Salud=$atendido_servicio_salud;
       
       $fecha_atencion_servicio_salud = trim($datos[20]);
       $registros[$NoEnc][$NoReg]->Fecha_Atencion_Servicio_Salud=$fecha_atencion_servicio_salud;
       
       $centro_servicio_salud = trim($datos[21]);
       if($centro_servicio_salud!=""){
        $dCs = centrosserviciossaludModel::centroPorNombre($centro_servicio_salud);
        if( !$dCs ){
           $respuesta->estado = false;
           $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Nombre de servicio de salud";
           break;
        }else{
            $registros[$NoEnc][$NoReg]->Centro_Servicio_Salud=$centro_servicio_salud;
        }
       }
       
       $provincia_centro_salud = trim($datos[22]);
       $dPcs = ProvinciasModel::provinciaPorNombre($provincia_centro_salud);
       if( !$dPcs ){
          $respuesta->estado = false;
          $respuesta->errormsg .= "No se puede guardar el registro, hay un error en la fila ".($linea_num+1)." en la columna de Provincia del centro de salud";
          break;
       }else{
           $registros[$NoEnc][$NoReg]->Provincia_Centro_Salud=$provincia_centro_salud;
       }
       
       $observaciones = trim($datos[23]);
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
        for($i=0;$i<count($registros);$i++) {
            $query = queryEnc.$value[$i]->Provincia.",".$value[$i]->Canton.",".$value[$i]->Poblacion.","
                .$value[$i]->Promotor.",".$value[$i]->Coordinador.")";
            for($j=0;$j<count($registros[$i]);$j++) {
                //$registros[i][j];
            }
         }
       $respuesta->mensaje = "Todos los registros se guardaron correctamente\n";
    }
}
else {
   $respuesta->mensaje = "La información no se guardo debido a que solo se admiten archivos .csv\n";
}
 echo json_encode($respuesta);

?>