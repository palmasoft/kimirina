<?php


class InformeParesUbicadosPromotor {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'pares' . DS;
        $nombre = 'informe_mensual_ubicados_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe mensual de pares ubicados por promotores.', 
                'PARES UBICADOS MENSUALMENTE PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'pares' . DS;
        $nombre = 'informe_trimestral_pares_ubicados_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe trimestral de pares ubicados por promotores.', 
                'PARES UBICADOS TRIMESTRALMENTE PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor) {

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
        self::$generador->Cell(0, 7, 'ANEXO 7.6.2', 0, true, 'C', 0, '', 0, false, 'M', 'M');
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
        $HTML = self::producir_html($datosInforme, $periodo, $nombrePromotor, $nombreGenerador, $tiposPobSubreceptor);
        self::$generador->writeHTML($HTML);        
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
    
    static function generar_periodo_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'pares' . DS;
        $nombre = 'informe_mensual_ubicados_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
            
        self::generar_xls(
                'INFORME PARES UBICADOS MENSUALMENTE PROMOTORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'pares' . DS;
        $nombre = 'informe_trimestral_pares_ubicados_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME PARES UBICADOS TRIMESTRALMENTE PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    public static function generar_xls($titulo, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor){
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
                ->setCellValue('G'.$fila.'', 'ANEXO 7.6.2' )
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
                    ->setCellValue('A6', 'Pares')
                    ->setCellValue('B6', 'Total Nuevos Mensuales')
                    ->setCellValue('C6', 'Total Recurrentes Mensuales')
                    ->setCellValue('D6', 'Total Nuevos/Recurrentes Mensuales')
                    ->setCellValue('E6', 'No. que SI Realiza Trabajo Sexual')
                    ->setCellValue('F6', 'No. que NO Realiza Trabajo Sexual');

        $fila = 7;
        $countRow = 0;
        
        foreach ($tiposPobSubreceptor as $key => $value) {
            if($value->CODIGO_TIPOPOBLACION=="HSH"){
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados HSH')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_HSH )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_HSH )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_HSH)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_HSH_TS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_HSH_NOTS );
                $fila++;
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados HSH REFERIDOS')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_HSH_REFERIDOS )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_HSH_REFERIDOS )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_HSH_REFERIDOS)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_HSH_TS_REFERIDOS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_HSH_NOTS_REFERIDOS );

            }
            if($value->CODIGO_TIPOPOBLACION=="TS"){
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados TS')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_TS )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_TS )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_TS)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_TS_TS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_TS_NOTS );
                $fila++;
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados TS REFERIDOS')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_TS_REFERIDOS )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_TS_REFERIDOS )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_TS_REFERIDOS)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_TS_TS_REFERIDOS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_TS_NOTS_REFERIDOS );

            }
            if($value->CODIGO_TIPOPOBLACION=="TRANS"){
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados TRANS')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_TRANS )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_TRANS )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_TRANS)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_TRANS_TS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_TRANS_NOTS );
                $fila++;
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$fila.'', 'Nº de pares contactados TRANS REFERIDOS')
                        ->setCellValue('B'.$fila.'', $datosInforme->NUEVOS_TRANS_REFERIDOS )
                        ->setCellValue('C'.$fila.'', $datosInforme->RECURRENTES_TRANS_REFERIDOS )
                        ->setCellValue('D'.$fila.'', $datosInforme->TOTAL_TRANS_REFERIDOS)
                        ->setCellValue('E'.$fila.'', $datosInforme->CANTIDAD_TRANS_TS_REFERIDOS)
                        ->setCellValue('F'.$fila.'', $datosInforme->CANTIDAD_TRANS_NOTS_REFERIDOS );
            }
            $fila++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Pares Ubicados por el Promotor ' . $nombrePromotor );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombrePromotor = '', $nombreGenerador = '', $tiposPobSubreceptor) {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td></td>
                <td colspan="3">Total Mensual</td>
                <td colspan="2">No.Que Realiza Trabajo Sexual</td>
            </tr>
            <tr>
                <td>Pares</td>
                <td>N</td>
                <td>R</td>
                <td>Total</td>
                <td>SI</td>
                <td>NO</td>
            </tr>';
                 foreach ($tiposPobSubreceptor as $key => $value) {
            if($value->CODIGO_TIPOPOBLACION=="HSH"){
                $html.='
                <tr>
                <td>
                    Nº de pares contactados HSH
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_HSH . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_HSH . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_HSH . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_HSH_TS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_HSH_NOTS . '
                </td>
            </tr>
            <tr>
                <td>
                    Nº de pares contactados HSH REFERIDOS
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_HSH_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_HSH_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_HSH_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_HSH_TS_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_HSH_NOTS_REFERIDOS . '
                </td>
            </tr>
            ';
            }
            if($value->CODIGO_TIPOPOBLACION=="TS"){
                $html.='
                <tr>
                <td>
                    Nº de pares contactados TS
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_TS . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_TS . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_TS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TS_TS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TS_NOTS . '
                </td>
            </tr>
			<tr>
                <td>
                    Nº de pares contactados TS REFERIDOS
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_TS_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_TS_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_TS_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TS_TS_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TS_NOTS_REFERIDOS . '
                </td>
            </tr>';
            }
            if($value->CODIGO_TIPOPOBLACION=="TRANS"){
                $html.='
                    <tr>
                <td>
                    Nº de pares contactados TRANS
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_TRANS . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_TRANS . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_TRANS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TRANS_TS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TRANS_NOTS . '
                </td>
                
            </tr>
            <tr>
                <td>
                    Nº de pares contactados TRANS REFERIDOS
                </td>
                <td>
                   ' . $datosInforme->NUEVOS_TRANS_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->RECURRENTES_TRANS_REFERIDOS . '
                </td>
                <td>
                   ' . $datosInforme->TOTAL_TRANS_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TRANS_TS_REFERIDOS . '
                </td>
                <td>
                    ' . $datosInforme->CANTIDAD_TRANS_NOTS_REFERIDOS . '
                </td>       
            </tr>';
            }
        
        }
        $html .= '</table>';


        return $html;
    }

}