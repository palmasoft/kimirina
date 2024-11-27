<?php


class InformeConsolidadoPromotores {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'consolidado' . DS;
        $nombre = 'informe_mensual_consolidado_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe consolidado mensual de promotores.', 
                'CONSOLIDADO MENSUAL DE DERIVADOS EFECTIVOS PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'consolidado' . DS;
        $nombre = 'informe_trimestral_consolidado_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe consolidado trimestral de promotores.', 
                'CONSOLIDADO TRIMESTRAL DE DERIVADOS EFECTIVOS PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '') {
        
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
        self::$generador->Cell(0, 7, 'ANEXO 7.3', 0, true, 'C', 0, '', 0, false, 'M', 'M');
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

    public static function generar_periodo_xls(  $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ){


        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'consolidado' . DS;
        $nombre = 'informe_mensual_consolidado_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);  

        $array_cod = array();
        foreach ($periodo as $periodo_actual) {
            array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
        }
        asort( $array_cod );
        $CODIGOS = implode(' - ', $array_cod);

        self::generar_xls(
                'CONSOLIDADO MENSUAL DE DERIVADOS EFECTIVOS PROMOTORES PARA EL PERIODO ',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;

    }

    public static function generar_trimestre_xls(  $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ){


        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'consolidado' . DS;
        $nombre = 'informe_trimestral_consolidado_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);  

        $array_cod = array();
        foreach ($periodo as $periodo_actual) {
            array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
        }
        asort( $array_cod );
        $CODIGOS = implode(' - ', $array_cod);

        self::generar_xls(
                'CONSOLIDADO TRIMESTRAL DE DERIVADOS EFECTIVOS PROMOTORES PARA LOS PERIODOS ',
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
                    ->setCellValue('A6', '#')
                    ->setCellValue('B6', 'Nombre/Apellidos')
                    ->setCellValue('C6', 'TS NUEVOS')
                    ->setCellValue('D6', 'TS RECURRENTES')
                    ->setCellValue('E6', 'HSH NUEVOS')
                    ->setCellValue('F6', 'HSH RECURRENTES')
                    ->setCellValue('G6', 'TRANS NUEVOS')
                    ->setCellValue('H6', 'TRANS RECURRENTES')
                    ->setCellValue('I6', 'TOTAL NUEVOS')
                    ->setCellValue('J6', 'TOTAL RECURRENTES');


        $fila = 7;
        $countRow = 0;
        foreach ($datosInforme->filas as $informe) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', ($countRow += 1))
                    ->setCellValue('B'.$fila.'', $informe->NOMBRE_PROMOTOR )
                    ->setCellValue('C'.$fila.'', $informe->NUEVOS_TS )
                    ->setCellValue('D'.$fila.'', $informe->RECURRENTES_TS)
                    ->setCellValue('E'.$fila.'', $informe->NUEVOS_HSH)
                    ->setCellValue('F'.$fila.'', $informe->RECURRENTES_HSH )
                    ->setCellValue('G'.$fila.'', $informe->NUEVOS_TRANS )
                    ->setCellValue('H'.$fila.'', $informe->RECURRENTES_TRANS)
                    ->setCellValue('I'.$fila.'', $informe->TOTAL_NUEVOS)
                    ->setCellValue('J'.$fila.'', $informe->TOTAL_RECURRENTES);
            $fila++;
        }       

        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$fila.'', 'SUBTOTAL')
                    ->setCellValue('C'.$fila.'', $datosInforme->totalNuevosTS)
                    ->setCellValue('D'.$fila.'', $datosInforme->totalRecuTS)
                    ->setCellValue('E'.$fila.'', $datosInforme->totalNuevosHSH)
                    ->setCellValue('F'.$fila.'', $datosInforme->totalRecuHSH)
                    ->setCellValue('G'.$fila.'', $datosInforme->totalNuevosTRANS)
                    ->setCellValue('H'.$fila.'', $datosInforme->totalRecuTRANS)
                    ->setCellValue('I'.$fila.'', ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS))
                    ->setCellValue('J'.$fila.'', ($datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS));

        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$fila.'', 'TOTAL')
                    ->setCellValue('C'.$fila.'', ($datosInforme->totalNuevosTS + $datosInforme->totalRecuTS))
                    ->setCellValue('E'.$fila.'', ($datosInforme->totalNuevosHSH + $datosInforme->totalRecuHSH))
                    ->setCellValue('G'.$fila.'', ($datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTRANS))
                    ->setCellValue('I'.$fila.'', ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS));

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
                <td rowspan="2" style="width: 50px; text-align: center">#</td>
                <td rowspan="2" style="width: 100px; text-align: center">Nombre/Apellidos</td>
                <td colspan="2" style="text-align: center">TS</td>
                <td colspan="2" style="text-align: center">HSH</td>
                <td colspan="2" style="text-align: center">TRANS</td>
                <td colspan="2" style="text-align: center">TOTAL</td>
            </tr>
            <tr>
                <th style="text-align: center">N</th>
                <th style="text-align: center">R</th>
                <th style="text-align: center">N</th>
                <th style="text-align: center">R</th>
                <th style="text-align: center">N</th>
                <th style="text-align: center">R</th>
                <th style="text-align: center">N</th>
                <th style="text-align: center">R</th>
            </tr>
            ';
        foreach ($datosInforme->filas as $informe) {
            $html.='
                <tr>
                    <td>' . ($countRow += 1) . '</td>
                    <td>' . $informe->NOMBRE_PROMOTOR . '</td>
                    <td>' . $informe->NUEVOS_TS . '</td>
                    <td>' . $informe->RECURRENTES_TS . '</td>
                    <td>' . $informe->NUEVOS_HSH . '</td>
                    <td>' . $informe->RECURRENTES_HSH . '</td>
                    <td>' . $informe->NUEVOS_TRANS . '</td>
                    <td>' . $informe->RECURRENTES_TRANS . '</td>
                    <td>' . $informe->TOTAL_NUEVOS . '</td>
                    <td>' . $informe->TOTAL_RECURRENTES . '</td>
                </tr>';
        }

        $html .='
            <tr>
                    <td colspan="2" style="text-align: center; font-weight: bolder;  font-size: larger" >SUBTOTAL</td>
                    <td>' . $datosInforme->totalNuevosTS . '</td>
                    <td>' . $datosInforme->totalRecuTS . '</td>
                    <td>' . $datosInforme->totalNuevosHSH . '</td>
                    <td>' . $datosInforme->totalRecuHSH . '</td>
                    <td>' . $datosInforme->totalNuevosTRANS . '</td>
                    <td>' . $datosInforme->totalRecuTRANS . '</td>
                    <td>' . ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS) . '</td>
                    <td>' . ($datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS) . '</td>
                </tr>';

        $html .='
            <tr>
                    <td colspan="2" style="text-align: center; font-weight: bolder;  font-size: larger" >TOTAL</td>
                    <td colspan="2" >' . ($datosInforme->totalNuevosTS + $datosInforme->totalRecuTS) . '</td>
                    <td colspan="2" >' . ($datosInforme->totalNuevosHSH + $datosInforme->totalRecuHSH) . '</td>
                    <td colspan="2" >' . ($datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTRANS) . '</td>
                    <td colspan="2" >' . ($datosInforme->totalNuevosTS + $datosInforme->totalNuevosHSH + $datosInforme->totalNuevosTRANS + $datosInforme->totalRecuTS + $datosInforme->totalRecuHSH + $datosInforme->totalRecuTRANS) . '</td>
                </tr>';
        $html .= '</table>';


        return $html;
    }

}