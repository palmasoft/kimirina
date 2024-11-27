<?php


class InformePromotoresActividad {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'actividad' . DS;
        $nombre = 'informe_mensual_actividad_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe mensual actividad promotores.', 
                'ACTIVIDAD MENSUAL PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'actividad' . DS;
        $nombre = 'informe_trimestra_actividad_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe trimestral actividad promotores.', 
                'ACTIVIDAD TRIMESTRAL PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '') {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'actividad' . DS;
        $nombre = 'informe_actividad_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::cargar_generador();

        self::$generador->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);

        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = $titulo;
        $urldownload = str_replace(DS, '/',URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);        
        self::$generador->Cell(0, 7, 'ANEXO 7.6.7', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);        
        self::$generador->Cell(0, 10, $titulo_informe, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);        
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $CODIGOS . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'PROMOTOR: ' . $nombrePromotor . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
//        
        
        self::$generador->Ln(2);
        $HTML = self::producir_html($datosInforme, $periodo, $nombrePromotor, $nombreGenerador);
        self::$generador->writeHTML($HTML);        
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
    
    static function generar_periodo_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'actividad' . DS;
        $nombre = 'informe_mensual_actividad_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
            
        self::generar_xls(
                'INFORME ACTIVIDAD MENSUAL PROMOTORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'actividad' . DS;
        $nombre = 'informe_trimestra_actividad_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME ACTIVIDAD TRIMESTRAL PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    public static function generar_xls($titulo, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ){
        Archivos::probar_crear_directorio($ruta);  
        $objPHPExcel = new GeneradorEXCEL();

        $fila = 1;        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$fila.'', '')
                ->setCellValue('B'.$fila.'', '')
                ->setCellValue('C'.$fila.'', '' )
                ->setCellValue('D'.$fila.'', '')
                ->setCellValue('E'.$fila.'', '')
                ->setCellValue('F'.$fila.'', '' )
                ->setCellValue('G'.$fila.'', 'ANEXO 7.4' )
                ->setCellValue('H'.$fila.'', '' )
                ->setCellValue('I'.$fila.'', '' )
                ->setCellValue('J'.$fila.'', '')
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');

        $fila = 2;        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$fila.'', '')
                ->setCellValue('B'.$fila.'', '')
                ->setCellValue('C'.$fila.'', '' )
                ->setCellValue('D'.$fila.'', '')
                ->setCellValue('E'.$fila.'', '')
                ->setCellValue('F'.$fila.'', '' )
                ->setCellValue('G'.$fila.'', $titulo.$CODIGOS )
                ->setCellValue('H'.$fila.'', '' )
                ->setCellValue('I'.$fila.'', '' )
                ->setCellValue('J'.$fila.'', '')
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');

        $fila = 4;        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$fila.'', '')
                ->setCellValue('B'.$fila.'', '')
                ->setCellValue('C'.$fila.'', 'PROVINCIA:' )
                ->setCellValue('D'.$fila.'', $nombreProvincia)
                ->setCellValue('E'.$fila.'', '')
                ->setCellValue('F'.$fila.'', 'CANTON:' )
                ->setCellValue('G'.$fila.'', $nombreCanton )
                ->setCellValue('H'.$fila.'', '' )
                ->setCellValue('I'.$fila.'', 'PROMOTOR:' )
                ->setCellValue('J'.$fila.'', $nombrePromotor)
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');
            

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A6', 'Nombre/Apellidos')
                    ->setCellValue('B6', 'PMR')
                    ->setCellValue('C6', 'Unidad de Salud con la que Trabaja')
                    ->setCellValue('D6', 'Nro. Pares Contactados')
                    ->setCellValue('E6', 'Nro. Pares Referidos Efectivos');

        $fila = 7;
        $countRow = 0; 
        
        foreach ($datosInforme->filas as $informe) {
            
            if(!empty($informe->CENTRO_SERVICIO_TS)){
                foreach ($informe->CENTRO_SERVICIO_TS as $centrosalud){
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'TS' )
                            ->setCellValue('C'.$fila.'', $centrosalud->NOMBRE_CENTROSERVICIO .' - '. $centrosalud->NUMERO_EFECTIVOS)
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_TS )
                            ->setCellValue('E'.$fila.'', $centrosalud->NUMERO_EFECTIVOS);
                    $fila++;
                 }
            }else{
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'TS' )
                            ->setCellValue('C'.$fila.'', 'Ninguno')
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_TS )
                            ->setCellValue('E'.$fila.'', '0');
                $fila++;
            }

            if(!empty($informe->CENTRO_SERVICIO_HSH)){
                foreach ($informe->CENTRO_SERVICIO_HSH as $centrosalud){
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'HSH' )
                            ->setCellValue('C'.$fila.'', $centrosalud->NOMBRE_CENTROSERVICIO .' - '. $centrosalud->NUMERO_EFECTIVOS)
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_HSH )
                            ->setCellValue('E'.$fila.'', $centrosalud->NUMERO_EFECTIVOS);
                    $fila++;
                 }
            }else{
               $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'HSH' )
                            ->setCellValue('C'.$fila.'', 'Ninguno')
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_HSH )
                            ->setCellValue('E'.$fila.'', '0');
               $fila++;
            }

            if(!empty($informe->CENTRO_SERVICIO_TRANS)){
                foreach ($informe->CENTRO_SERVICIO_TRANS as $centrosalud){
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'TRANS' )
                            ->setCellValue('C'.$fila.'', $centrosalud->NOMBRE_CENTROSERVICIO .' - '. $centrosalud->NUMERO_EFECTIVOS)
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_TRANS )
                            ->setCellValue('E'.$fila.'', $centrosalud->NUMERO_EFECTIVOS);
                    $fila++;
                 }
            }else{
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->NOMBRE_PROMOTOR )
                            ->setCellValue('B'.$fila.'', 'TRANS' )
                            ->setCellValue('C'.$fila.'', 'Ninguno')
                            ->setCellValue('D'.$fila.'', $informe->PARES_CONTACTADOS_TRANS )
                            ->setCellValue('E'.$fila.'', '0');
                $fila++;
            }

        }

        $objPHPExcel->getActiveSheet()->setTitle('Alcances del Promotor ' . $nombrePromotor );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombrePromotor = '', $nombreGenerador = '') {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td style="width: 100px">Nombre/Apellidos</td>
                <td>PMR</td>
                <td>Unidad de Salud con la que Trabaja </td>
                <td>Nro. Pares Contactados</td>
                <td>Nro. Pares Referidos Efectivos</td>
            </tr>
            ';

        foreach ($datosInforme->filas as $informe) :

            $html .= '<tr>
                        <td rowspan="3">' . ($informe->NOMBRE_PROMOTOR) . '</td>
                        <td>TS</td>
                        <td>';
                             
                              if(!empty($informe->CENTRO_SERVICIO_TS)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TS as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "Ninguno";
                              }
                               
                      $html .='
                        </td>
                        <td>
                            '.($informe->PARES_CONTACTADOS_TS).'
                        </td>
                        <td>';
                            
                              if(!empty($informe->CENTRO_SERVICIO_TS)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TS as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "0";
                              }
                               
                        $html .='   
                        </td>
                    </tr>

                      <tr>
                          <td>
                              HSH
                          </td>
                        <td>';
                            
                              if(!empty($informe->CENTRO_SERVICIO_HSH)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_HSH as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_REFERIDOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "Ninguno";
                              }
                               
                       $html .= '
                        </td>
                        <td>
                            '.($informe->PARES_CONTACTADOS_HSH).'
                        </td>
                        <td>';
                             
                              if(!empty($informe->CENTRO_SERVICIO_HSH)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_HSH as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "0";
                              }
                               
                            $html .='
                        </td>
                      </tr>
                       
                      <tr>
                          <td>
                              TRANS
                          </td>
                        <td>';
                             
                              if(!empty($informe->CENTRO_SERVICIO_TRANS)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TRANS as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "Ninguno";
                              }
                               
                           $html .='
                        </td>
                        <td>
                            '.($informe->PARES_CONTACTADOS_TRANS).'
                        </td>
                        <td>';
                             
                              if(!empty($informe->CENTRO_SERVICIO_TRANS)){
                                  $html .= "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TRANS as $centrosalud){
                                        
                                         $html .= "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   $html .= "</table>";
                              }else{
                                  $html .= "0";
                              }
                               
                           $html .='
                        </td>
                       
                      </tr>';
        endforeach;

        $html .= '</table>';


        return $html;
    }

}