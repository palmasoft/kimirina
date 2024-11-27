<?php

class InformeAnimadoresActividad {

    //put your code here
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'en_actividad' . DS;
        $nombre = 'informe_mensual_animadores_actividad_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe consolidado mensual de promotores.', 
                'CONSOLIDADO MENSUAL DE DERIVADOS EFECTIVOS PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'en_actividad' . DS;
        $nombre = 'informe_trimestral_animadores_actividad_' . uniqid() . '.pdf';
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
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '') {

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
        self::$generador->Cell(0, 7, 'PERIODO /MES : ' . $CODIGOS . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'ANIMADOR: ' . $nombreAnimador . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
//        
        
        self::$generador->Ln(2);
        if (!empty($datosInforme)) {
            $HTML = self::producir_html($datosInforme, $periodo, $nombreAnimador, $nombreGenerador);
            self::$generador->writeHTML($HTML);        
        }
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
    
    static function generar_periodo_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'en_actividad' . DS;
        $nombre = 'informe_mensual_animadores_actividad_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME CONSOLIDADO MENSUAL DE DERIVADOS EFECTIVOS PROMOTORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'en_actividad' . DS;
        $nombre = 'informe_trimestral_animadores_actividad_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME CONSOLIDADO TRIMESTRAL DE DERIVADOS EFECTIVOS PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    public static function generar_xls($titulo, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ){
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
                ->setCellValue('G'.$fila.'', 'ANEXO 7.6.7' )
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
                ->setCellValue('I'.$fila.'', 'ANIMADOR:' )
                ->setCellValue('J'.$fila.'', $nombreAnimador)
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');
            

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A6', '#')
                    ->setCellValue('B6', 'Nombre(s) y Apellido(s)')
                    ->setCellValue('C6', 'Nuevo TS')
                    ->setCellValue('D6', 'Recurrente TS')
                    ->setCellValue('E6', 'Nuevo HSH')
                    ->setCellValue('F6', 'Recurrente HSH')
                    ->setCellValue('G6', 'Nuevo TRANS')
                    ->setCellValue('H6', 'Recurrente TRANS')
                    ->setCellValue('I6', 'TOTAL NUEVOS')
                    ->setCellValue('J6', 'TOTAL RECURRENTES')
                    ->setCellValue('K6', 'No. Pares Contactos Referidos Efectivos');

        $fila = 7;
        $countRow = 0;
        foreach ($datosInforme->filas as $informe) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', ($countRow += 1))
                    ->setCellValue('B'.$fila.'', $informe->NOMBRE_ANIMADOR )
                    ->setCellValue('C'.$fila.'', $informe->NUEVOS_TS )
                    ->setCellValue('D'.$fila.'', $informe->RECURRENTES_TS)
                    ->setCellValue('E'.$fila.'', $informe->NUEVOS_HSH)
                    ->setCellValue('F'.$fila.'', $informe->RECURRENTES_HSH )
                    ->setCellValue('G'.$fila.'', $informe->NUEVOS_TRANS )
                    ->setCellValue('H'.$fila.'', $informe->RECURRENTES_TRANS)
                    ->setCellValue('I'.$fila.'', $informe->TOTAL_NUEVOS)
                    ->setCellValue('J'.$fila.'', $informe->TOTAL_RECURRENTES)
                    ->setCellValue('K'.$fila.'', $informe->TOTAL_EFECTIVOS);
            $fila++;
        }              

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', '' )
                    ->setCellValue('B'.$fila.'', 'SUBTOTAL' )
                    ->setCellValue('C'.$fila.'', $datosInforme->totalNuevosTS )
                    ->setCellValue('D'.$fila.'', $datosInforme->totalRecuTS)
                    ->setCellValue('E'.$fila.'', $datosInforme->totalNuevosHSH )
                    ->setCellValue('F'.$fila.'', $datosInforme->totalRecuHSH)
                    ->setCellValue('G'.$fila.'', $datosInforme->totalNuevosTRANS )
                    ->setCellValue('H'.$fila.'', $datosInforme->totalRecuTRANS)
                    ->setCellValue('I'.$fila.'', $datosInforme->totalNuevosTS+$datosInforme->totalNuevosHSH+$datosInforme->totalNuevosTRANS)
                    ->setCellValue('J'.$fila.'', $datosInforme->totalRecuTS+$datosInforme->totalRecuHSH+$datosInforme->totalRecuTRANS)
                    ->setCellValue('K'.$fila.'', '');
        
        $fila++;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', '' )
                    ->setCellValue('B'.$fila.'', 'TOTAL' )
                    ->setCellValue('C'.$fila.'', $datosInforme->totalNuevosTS+$datosInforme->totalRecuTS )
                    ->setCellValue('E'.$fila.'', $datosInforme->totalNuevosHSH+$datosInforme->totalRecuHSH)
                    ->setCellValue('G'.$fila.'', $datosInforme->totalNuevosTRANS+$datosInforme->totalRecuTRANS )
                    ->setCellValue('I'.$fila.'', $datosInforme->totalNuevosTS+$datosInforme->totalNuevosHSH+$datosInforme->totalNuevosTRANS+$datosInforme->totalRecuTS+$datosInforme->totalRecuHSH+$datosInforme->totalRecuTRANS)
                    ->setCellValue('K'.$fila.'', $datosInforme->totalEFECTIVOS );


        $objPHPExcel->getActiveSheet()->setTitle('Actividades del animador ' . $nombreAnimador );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombreAnimador = '', $nombreGenerador = '') {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td colspan="2">#</td> 
                <td colspan="2">TS</td>
                <td colspan="2">HSH</td>
                <td colspan="2">TRANS</td>
                <td colspan="2">TOTAL</td>
                <td></td>
            </tr>
            <tr>
                <td>#</td>
                <td>Nombre(s) y Apellido(s)</td>
                <td>N</td>
                <td>R</td>
                <td>N</td>
                <td>R</td>
                <td>N</td>
                <td>R</td>
                <td>N</td>
                <td>R</td>
                <td>No. Pares Contactos Referidos Efectivos</td>
            </tr>
            ';
        if (!empty($datosInforme)) {
            foreach ($datosInforme->filas as $informe) {
                $html .= '
                <tr>
                    <td style="text-align:center">' . ($countRow += 1) . '</td>
                    <td style="text-align:center">' . ($informe->NOMBRE_ANIMADOR) . '</td>
                    <td style="text-align:center">' . ($informe->NUEVOS_TS) . '</td>
                    <td style="text-align:center">' . ($informe->RECURRENTES_TS) . '</td>
                    <td style="text-align:center">' . ($informe->NUEVOS_HSH) . '</td>
                    <td style="text-align:center">' . ($informe->RECURRENTES_HSH) . '</td>
                    <td style="text-align:center">' . ($informe->NUEVOS_TRANS) . '</td>
                    <td style="text-align:center">' . ($informe->RECURRENTES_TRANS) . '</td>
                    <td style="text-align:center; font-weight:bolder">' . ($informe->TOTAL_NUEVOS) . '</td>
                    <td style="text-align:center; font-weight:bolder">' . ($informe->TOTAL_RECURRENTES) . '</td>
                    <td style="text-align:center; font-weight:bolder">' . ($informe->TOTAL_EFECTIVOS) . '</td>
                </tr>';
            }
        }

        $html .= '
            <tr>
                <td></td>
                <td style="text-align:center; font-weight:bolder">SUBTOTAL</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalNuevosTS.'</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalRecuTS.'</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalNuevosHSH.'</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalRecuHSH.'</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalNuevosTRANS.'</td>
                <td style="text-align:center; font-weight:bolder">'.$datosInforme->totalRecuTRANS.'</td>
                <td style="text-align:center; font-weight:bolder">'.($datosInforme->totalNuevosTS+$datosInforme->totalNuevosHSH+$datosInforme->totalNuevosTRANS).'</td>
                <td style="text-align:center; font-weight:bolder">'.($datosInforme->totalRecuTS+$datosInforme->totalRecuHSH+$datosInforme->totalRecuTRANS).'</td>
                <td rowspan="2" style="font-weight:bolder; font-size:150%; text-align:center;">'.$datosInforme->totalEFECTIVOS.'</td>
            </tr>            
            <tr>
                <td></td>
                <td style="text-align:center;font-weight:bolder"><b>TOTAL</b></td>
                <td colspan="2" style="text-align:center; font-weight:bolder">'.($datosInforme->totalNuevosTS+$datosInforme->totalRecuTS).'</td>
                <td colspan="2" style="text-align:center; font-weight:bolder">'.($datosInforme->totalNuevosHSH+$datosInforme->totalRecuHSH).'</td>
                <td colspan="2" style="text-align:center; font-weight:bolder">'.($datosInforme->totalNuevosTRANS+$datosInforme->totalRecuTRANS).'</td>
                <td colspan="2" style="text-align:center; font-weight:bolder">'.($datosInforme->totalNuevosTS+$datosInforme->totalNuevosHSH+$datosInforme->totalNuevosTRANS+$datosInforme->totalRecuTS+$datosInforme->totalRecuHSH+$datosInforme->totalRecuTRANS).'</td>
            </tr>';
        
        $html .= '
            </table>';

        return $html;
    }

}
