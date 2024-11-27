<?php

class InformeConsejeriaPares {

    //put your code here
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }

    public static function generar($subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreConsejero = '', $nombreGenerador = '') {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'consejeros' . DS . 'pares' . DS;
        $nombre = 'informe_mensual_consejeria_pares_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::cargar_generador();


        self::$generador->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);

        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Informe de consejeros pares.';
        $urldownload = str_replace(DS, '/', URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'ANEXO 7.3', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, 'INFORME MENSUAL DE CONSEJERIA DE PARES', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia . '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton . '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'CONSEJERO: ' . $nombreConsejero . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
//        

        self::$generador->Ln(2);

//        if (!empty($datosInforme)) {
            $HTML = self::producir_html($datosInforme, $periodo, $nombreConsejero, $nombreGenerador);
            self::$generador->writeHTML($HTML);
//        }
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B', true, 'C', 0, '', 0, false, 'M', 'B');
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0, true, 'C', 0, '', 0, false, 'T', 'M');

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
    
    public static function generar_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreConsejero = '', $nombreGenerador = '' ){


        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'consejeros' . DS . 'abordajes' . DS;
        $nombre = 'informe_abordajes_consejeros_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);  

        /*$array_cod = array();
        foreach ($periodo as $periodo_actual) {
            array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
        }
        asort( $array_cod );
        $CODIGOS = implode(' - ', $array_cod);*/

        $objPHPExcel = new GeneradorEXCEL();

        $fila = 1;        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$fila.'', '')
                ->setCellValue('B'.$fila.'', '')
                ->setCellValue('C'.$fila.'', '' )
                ->setCellValue('D'.$fila.'', '')
                ->setCellValue('E'.$fila.'', '')
                ->setCellValue('F'.$fila.'', '' )
                ->setCellValue('G'.$fila.'', 'ANEXO 7.3' )
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
                ->setCellValue('G'.$fila.'', 'INFORME MENSUAL DE CONSEJERIA DE PARES PARA EL PERIODO '.$periodo->CODIGO_PERIODO )
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
                ->setCellValue('I'.$fila.'', 'CONSEJERO:' )
                ->setCellValue('J'.$fila.'', $nombreConsejero)
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');
            

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A6', 'Nombre  del/a consejero/a')
                    ->setCellValue('B6', 'Nro. de Personas Nuevas Alcanzadas')
                    ->setCellValue('C6', 'Nro. de Personas Recurrentes Alcanzadas')
                    ->setCellValue('D6', 'Cantidad Preservativos')
                    ->setCellValue('E6', 'Cantidad Lubricantes')
                    ->setCellValue('F6', 'Cantidad Pastilleros');
        $fila = 7;
        $countRow = 0;
        foreach ($datosInforme as $informe) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', $informe->NOMBRE_CONSEJERO)
                    ->setCellValue('B'.$fila.'', $informe->NUEVOS )
                    ->setCellValue('C'.$fila.'', $informe->RECURRENTES )
                    ->setCellValue('D'.$fila.'', $informe->CONDONES)
                    ->setCellValue('E'.$fila.'', $informe->LUBRICANTES)
                    ->setCellValue('F'.$fila.'', $informe->PASTILLEROS );
            $fila++;
        }       

        $objPHPExcel->getActiveSheet()->setTitle('Consejerias a Pares del Consejero ' . $nombreConsejero );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombreConsejero = '', $nombreGenerador = '') {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="text-align: center; width: 100%; margin: auto" >';
        $html .= '
            <tr>
                <th></th>
                <th colspan="2">Nro. Personas Alcanzadas</th>
                <th colspan="3"></th>
                
            </tr>
            <tr>
                <th>Nombre  del/a consejero/a</th>
                <th>N</th>
                <th>R</th>
                <th>Cantidad Preservativos</th>
                <th>Cantidad Lubricantes</th>
                <th>Cantidad Pastilleros</th>
            </tr>
            ';

        if (!empty($datosInforme)) {
            foreach ($datosInforme as $informe) :
                $html .='<tr>
                            <td  style="font-weight:bolder; font-size: 150%;">' . ($informe->NOMBRE_CONSEJERO) . '</td>
                            <td>' . ($informe->NUEVOS) . '</td>
                            <td>' . ($informe->RECURRENTES) . '</td>
                            <td>' . ($informe->CONDONES) . '</td>
                            <td>' . ($informe->LUBRICANTES) . '</td>
                            <td>' . ($informe->PASTILLEROS) . '</td>
                     </tr>';
            endforeach;
        }
//        $html .= '
//            <tr>
//                <td colspan="2" style=" font-weight: bolder; font-size: 125%;">SUBTOTAL</td>
//                <td >' . $datosInforme->totalNuevosTS . '</td>
//                <td >' . $datosInforme->totalRecuTS . '</td>
//                <td >' . $datosInforme->totalNuevosHSH . '</td>
//                <td >' . $datosInforme->totalRecuHSH . '</td>
//                <td >' . $datosInforme->totalNuevosTRANS . '</td>
//                <td >' . $datosInforme->totalRecuTRANS . '</td>
//                <td >' . ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS) . '</td>
//                <td >' . ($datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS) . '</td>
//                <td rowspan="2"  style=" font-weight: bolder; font-size: 150%;" >' . ($datosInforme->totalEFECTIVOS ) . '</td>
//            </tr>';

//        $html .= '
//            <tr>
//                <td colspan="2" style=" font-weight: bolder; font-size: 125%;">TOTAL</td>
//                <td colspan="2"  style=" font-weight: bolder; font-size: 150%;">' . ($datosInforme->totalNuevosTS + $datosInforme->totalRecuTS) . '</td>
//                <td colspan="2"  style=" font-weight: bolder; font-size: 150%;">' . ($datosInforme->totalNuevosHSH + $datosInforme->totalRecuHSH) . '</td>
//                <td colspan="2"  style=" font-weight: bolder; font-size: 150%;" >' . ($datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTRANS) . '</td>
//                <td colspan="2"  style=" font-weight: bolder; font-size: 150%;">' . ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS) . '</td>                    
//            </tr>';
        $html .= '</table>';


        return $html;
    }

}
