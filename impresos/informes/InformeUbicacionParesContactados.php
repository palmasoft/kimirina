<?php


class InformeUbicacionParesContactados {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'ubicacion_pares_contactados' . DS;
        $nombre = 'informe_mensual_ubicacion_pares_contactados_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe mensual ubicacion pares contactados promotores.', 
                'UBICACION PARES CONTACTADOS MENSUALMENTE PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'ubicacion_pares_contactados' . DS;
        $nombre = 'informe_trimestral_ubicacion_pares_contactados_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe trimestral ubicacion pares contactados promotores.', 
                'UBICACION PARES CONTACTADOS TRIMESTRALMENTE PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '') {
        
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
        self::$generador->Cell(0, 7, 'ANEXO 7.6.3', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);   
        self::$generador->Cell(0, 10, $titulo_informe, 0, true, 'C', 0, '', 0, false, 'M', 'M');       
        self::$generador->SetFont('helvetica', 'B', 8); 
        self::$generador->Cell(0, 7, 'PERIODO /MES : ' . $CODIGOS . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
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
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'ubicacion_pares_contactados' . DS;
        $nombre = 'informe_mensual_ubicacion_pares_contactados_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
            
        self::generar_xls(
                'INFORME UBICACION PARES CONTACTADOS MENSUALMENTE PROMOTORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'ubicacion_pares_contactados' . DS;
        $nombre = 'informe_trimestral_ubicacion_pares_contactados_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME UBICACION PARES CONTACTADOS TRIMESTRALMENTE PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    public static function generar_xls($titulo, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = ''){
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
                ->setCellValue('G'.$fila.'', 'ANEXO 7.6.3' )
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
                    ->setCellValue('A6', 'Provincia')
                    ->setCellValue('B6', 'Canton')
                    ->setCellValue('C6', 'PMR')
                    ->setCellValue('D6', '10-14')
                    ->setCellValue('E6', '15-19')
                    ->setCellValue('F6', '20-24')
                    ->setCellValue('G6', '25-49')
                    ->setCellValue('H6', '50-59')
                    ->setCellValue('I6', ' >60')
                    ->setCellValue('J6', 'Total');
    
        $fila = 7;
        $countRow = 0;
        
        foreach ($datosInforme->informe as $informe){
            if ($informe->TS_TOTAL > 0 || $informe->HSH_TOTAL > 0 || $informe->TRANS_TOTAL > 0) {
                
                $mostrarHSH = FALSE;
                if ($informe->HSH_TOTAL > 0) {
                    $mostrarHSH = true;
                }
                $mostrarTRANS = FALSE;
                if ($informe->TRANS_TOTAL > 0) {
                    $mostrarTRANS = true;
                }
                $mostrarTS = FALSE;
                if ($informe->TS_TOTAL > 0) {
                    $mostrarTS = true;
                }
                
                if ($mostrarHSH) { 
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->PROVINCIA)
                            ->setCellValue('B'.$fila.'', $informe->CANTON)
                            ->setCellValue('C'.$fila.'', 'HSH')
                            ->setCellValue('D'.$fila.'', $informe->HSH_1014)
                            ->setCellValue('E'.$fila.'', $informe->HSH_1519)
                            ->setCellValue('F'.$fila.'', $informe->HSH_2024)
                            ->setCellValue('G'.$fila.'', $informe->HSH_2549)
                            ->setCellValue('H'.$fila.'', $informe->HSH_5059)
                            ->setCellValue('I'.$fila.'', $informe->HSH_60)
                            ->setCellValue('J'.$fila.'', $informe->HSH_TOTAL);
                    
                    $fila++;
                }
                if ($mostrarTRANS) { 
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->PROVINCIA)
                            ->setCellValue('B'.$fila.'', $informe->CANTON)
                            ->setCellValue('C'.$fila.'', 'TRANS')
                            ->setCellValue('D'.$fila.'', $informe->TRANS_1014)
                            ->setCellValue('E'.$fila.'', $informe->TRANS_1519)
                            ->setCellValue('F'.$fila.'', $informe->TRANS_2024)
                            ->setCellValue('G'.$fila.'', $informe->TRANS_2549)
                            ->setCellValue('H'.$fila.'', $informe->TRANS_5059)
                            ->setCellValue('I'.$fila.'', $informe->TRANS_60)
                            ->setCellValue('J'.$fila.'', $informe->TRANS_TOTAL);
                    
                    $fila++;
                }
                if ($mostrarTS) { 
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$fila.'', $informe->PROVINCIA)
                            ->setCellValue('B'.$fila.'', $informe->CANTON)
                            ->setCellValue('C'.$fila.'', 'TS')
                            ->setCellValue('D'.$fila.'', $informe->TS_1014)
                            ->setCellValue('E'.$fila.'', $informe->TS_1519)
                            ->setCellValue('F'.$fila.'', $informe->TS_2024)
                            ->setCellValue('G'.$fila.'', $informe->TS_2549)
                            ->setCellValue('H'.$fila.'', $informe->TS_5059)
                            ->setCellValue('I'.$fila.'', $informe->TS_60)
                            ->setCellValue('J'.$fila.'', $informe->TS_TOTAL);
                    
                    $fila++;
                }
            }
        }
        
        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', '' )
                    ->setCellValue('C'.$fila.'', 'HSH')
                    ->setCellValue('D'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_1014)
                    ->setCellValue('E'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_1519)
                    ->setCellValue('F'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_2024)
                    ->setCellValue('G'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_2549)
                    ->setCellValue('H'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_5059)
                    ->setCellValue('I'.$fila.'', $datosInforme->informetotal[0]->HSH_TOTAL_60)
                    ->setCellValue('J'.$fila.'', $datosInforme->informetotal[0]->GRAN_TOTAL_HSH);
        
        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', 'TOTAL' )
                    ->setCellValue('C'.$fila.'', 'TRANS')
                    ->setCellValue('D'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_1014)
                    ->setCellValue('E'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_1519)
                    ->setCellValue('F'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_2024)
                    ->setCellValue('G'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_2549)
                    ->setCellValue('H'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_5059)
                    ->setCellValue('I'.$fila.'', $datosInforme->informetotal[0]->TRANS_TOTAL_60)
                    ->setCellValue('J'.$fila.'', $datosInforme->informetotal[0]->GRAN_TOTAL_TRANS);
        
        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', '' )
                    ->setCellValue('C'.$fila.'', 'TS')
                    ->setCellValue('D'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_1014)
                    ->setCellValue('E'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_1519)
                    ->setCellValue('F'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_2024)
                    ->setCellValue('G'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_2549)
                    ->setCellValue('H'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_5059)
                    ->setCellValue('I'.$fila.'', $datosInforme->informetotal[0]->TS_TOTAL_60)
                    ->setCellValue('J'.$fila.'', $datosInforme->informetotal[0]->GRAN_TOTAL_TS);

        $objPHPExcel->getActiveSheet()->setTitle('Ubicacion de Pares Contactados por el Promotor ' . $nombrePromotor );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombrePromotor = '', $nombreGenerador = '') {
        
//        print_r($datosInforme[0]);
        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td colspan="2"></td>
                <td colspan="8">Grupo Etareo</td>
            </tr>
              
            <tr>
                <td>Provincia</td>
                <td>Canton</td>
                <td>PMR</td>
                <td>10-14</td>
                <td>15-19</td>
                <td>20-24</td>
                <td>25-49</td>
                <td>50-59</td>
                <td> >60</td>
                <td>Total</td>
            </tr>
            ';
        foreach ($datosInforme->informe as $informe){
            $nFilas = 0;
            //print_r($informe);
                    if ($informe->TS_TOTAL > 0 || $informe->HSH_TOTAL > 0 || $informe->TRANS_TOTAL > 0) {

                        $mostrarHSH = FALSE;
                        if ($informe->HSH_TOTAL > 0) {
                            $mostrarHSH = true;
                        }
                        $mostrarTRANS = FALSE;
                        if ($informe->TRANS_TOTAL > 0) {
                            $mostrarTRANS = true;
                        }
                        $mostrarTS = FALSE;
                        if ($informe->TS_TOTAL > 0) {
                            $mostrarTS = true;
                        }
                   $html .= '
                        <tr>
                            <td >
                                '.($informe->PROVINCIA).'
                            </td>
                            <td >
                                '.($informe->CANTON).'
                            </td>
                            <td>
                                <table>
                                    ';
                   if ($mostrarHSH) { 
                       $html.='
                                        <tr>
                                            <td>HSH</td>
                                        </tr>';
                   }

                   if ($mostrarTRANS) { 
                       $html.='
                   
                                        <tr>
                                            <td>TRANS</td>
                                        </tr>';
                   }
                   
                   if ($mostrarTS) {
                       $html.='
                                        <tr>
                                            <td>TS</td>
                                        </tr>';
                    }
                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                    if($mostrarHSH) {
                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_1014).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_1014).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_1014).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                                    if ($mostrarHSH) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_1519).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_1519).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_1519).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                                     if ($mostrarHSH) {
                                         $html.='
                                        <tr>
                                            <td>'.($informe->HSH_2024).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_2024).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_2024).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>

                            </td>
                            <td>

                                <table>';
                                    if ($mostrarHSH) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_2549).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_2549).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_2549).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                                    if ($mostrarHSH) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_5059).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_5059).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_5059).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                                    if ($mostrarHSH) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_60).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_60).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_60).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                            <td>
                                <table>';
                                    if ($mostrarHSH) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->HSH_TOTAL).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTRANS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TRANS_TOTAL).'</td>
                                        </tr>';
                                    }
                                    if ($mostrarTS) {
                                        $html.='
                                        <tr>
                                            <td>'.($informe->TS_TOTAL).'</td>
                                        </tr>';
                                    }
                                    $html.='
                                </table>
                            </td>
                        </tr>';                      
                        
                    }
        }
        
        $html .= '<tr>
                <td rowspan="3" colspan="2" style="text-align: center; font-weight: bolder">TOTAL</td>
                <td style="text-align: center; font-weight: bolder">HSH</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_1014.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_1519.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_2024.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_2549.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_5059.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->HSH_TOTAL_60.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->GRAN_TOTAL_HSH.'</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bolder">TRANS</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_1014.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_1519.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_2024.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_2549.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_5059.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TRANS_TOTAL_60.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->GRAN_TOTAL_TRANS.'</td>
            </tr>
            
            <tr>
                <td style="text-align: center; font-weight: bolder">TS</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_1014.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_1519.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_2024.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_2549.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_5059.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->TS_TOTAL_60.'</td>
                <td style="text-align: center; font-weight: bolder">'.$datosInforme->informetotal[0]->GRAN_TOTAL_TS.'</td>
            </tr>';
        
        $html .= '</table>';


        return $html;
    }

}