<?php


class InformeInsumosEntregadosAnimadores {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }
    
    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'insumos_entregados_animadores' . DS;
        $nombre = 'informe_mensual_insumos_entregados_animadores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe mensual insumos entregados animadores.', 
                'INSUMOS MENSUALES ENTREGADOS ANIMADORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'insumos_entregados_animadores' . DS;
        $nombre = 'informe_trimestral_insumos_entregados_animadores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe trimestral insumos entregados animadores.', 
                'INSUMOS TRIMESTRALES ENTREGADOS ANIMADORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }

    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'insumos_entregados_animadores' . DS;
        $nombre = 'informe_insumos_entregados_animadores_' . uniqid() . '.pdf';
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
        self::$generador->Cell(0, 7, 'ANEXO 7.6.6', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);     
        self::$generador->Cell(0, 10, $titulo_informe, 0, true, 'C', 0, '', 0, false, 'M', 'M');       
        self::$generador->SetFont('helvetica', 'B', 8); 
        self::$generador->Cell(0, 7, 'PERIODO /MES : ' . $CODIGOS . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'PROMOTOR: ' . $nombreAnimador . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
//        
        
        self::$generador->Ln(2);
        $HTML = self::producir_html($datosInforme, $periodo, $nombreAnimador, $nombreGenerador, $tiposPobSubreceptor);
        self::$generador->writeHTML($HTML);        
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }

    static function generar_periodo_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'insumos_entregados_animadores' . DS;
        $nombre = 'informe_mensual_insumos_entregados_animadores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
            
        self::generar_xls(
                'INFORME NSUMOS MENSUALES ENTREGADOS ANIMADORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'insumos_entregados_animadores' . DS;
        $nombre = 'informe_trimestral_insumos_entregados_animadores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME INSUMOS TRIMESTRALES ENTREGADOS ANIMADORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador, $tiposPobSubreceptor);
        
        
        return self::$RUTA;
    }
    
    public static function generar_xls($titulo, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor ){
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
                ->setCellValue('G'.$fila.'', 'ANEXO 7.6.6' )
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
                    ->setCellValue('A6', 'Tipo de Poblacion Vulnerable')
                    ->setCellValue('B6', 'No. DE IMPRESOS ENTREGADOS')
                    ->setCellValue('C6', 'No. DE CONDONES ENTREGADOS')
                    ->setCellValue('D6', 'No. DE LUBRICANTES ENTREGADOS');
        

        $fila = 7;
        $countRow = 0;
        
        if (isset($datosInforme)) { 
               foreach ($tiposPobSubreceptor as $key => $value) {
                   if($value->CODIGO_TIPOPOBLACION=="TS"){
                       
                       
                       $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$fila.'', 'TS')
                                ->setCellValue('B'.$fila.'', $datosInforme->TS_IMPRESOS)
                                ->setCellValue('C'.$fila.'', $datosInforme->TS_CONDONES)
                                ->setCellValue('D'.$fila.'', $datosInforme->TS_LUBRICANTES);
                        $fila++;
                    }
                    if($value->CODIGO_TIPOPOBLACION=="TRANS"){
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$fila.'', 'TRANS')
                                ->setCellValue('B'.$fila.'', $datosInforme->TRANS_IMPRESOS)
                                ->setCellValue('C'.$fila.'', $datosInforme->TRANS_CONDONES)
                                ->setCellValue('D'.$fila.'', $datosInforme->TRANS_LUBRICANTES);
                        $fila++;
                    }
                    if($value->CODIGO_TIPOPOBLACION=="HSH"){
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$fila.'', 'HSH')
                                ->setCellValue('B'.$fila.'', $datosInforme->HSH_IMPRESOS)
                                ->setCellValue('C'.$fila.'', $datosInforme->HSH_CONDONES)
                                ->setCellValue('D'.$fila.'', $datosInforme->HSH_LUBRICANTES);
                        $fila++;
                    }
               }
        }

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', 'TOTAL' )
                    ->setCellValue('B'.$fila.'', $datosInforme->totalFolleteria)
                    ->setCellValue('C'.$fila.'', $datosInforme->totalCondones)
                    ->setCellValue('D'.$fila.'', $datosInforme->totalLubricantes);



        $objPHPExcel->getActiveSheet()->setTitle('Insumos Entregados por ' . $nombreAnimador );
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save( $ruta . $nombre );
        
        self::$RUTA = $ruta . $nombre;
        return self::$RUTA;

    }
    
    public static function producir_html($datosInforme = null, $periodo = '', $nombreAnimador = '', $nombreGenerador = '', $tiposPobSubreceptor) {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td style="text-align: center">Tipo de Poblacion Vulnerable</td>
                <td style="text-align: center">No. DE IMPRESOS ENTREGADOS</td>
                <td style="text-align: center">No. DE CONDONES ENTREGADOS</td>
                <td style="text-align: center">No. DE LUBRICANTES ENTREGADOS</td>
                
            </tr>
            ';
        if (isset($datosInforme)) { 
               foreach ($tiposPobSubreceptor as $key => $value) {   
            
            if($value->CODIGO_TIPOPOBLACION=="TS"){
            $html.='
                <tr>
                <td style="text-align: center">
                   TS
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TS_IMPRESOS.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TS_CONDONES.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TS_LUBRICANTES.'
                </td>
            </tr>';
            }
            if($value->CODIGO_TIPOPOBLACION=="TRANS"){
            $html .= '
            <tr>
                <td style="text-align: center">
                    TRANS
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TRANS_IMPRESOS.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TRANS_CONDONES.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->TRANS_LUBRICANTES.'
                </td>
                
            </tr>';
            }
            if($value->CODIGO_TIPOPOBLACION=="HSH"){
            $html .= '
            <tr>
                <td style="text-align: center">
                    HSH
                </td>
                <td style="text-align: center">
                   '.$datosInforme->HSH_IMPRESOS.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->HSH_CONDONES.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->HSH_LUBRICANTES.'
                </td>
            </tr>';
            }
               }
            }
            $html .= '<tr>
                <td style="font-weight: bolder; text-align: center">
                    TOTAL
                </td>
                <td style="text-align: center">
                   '.$datosInforme->totalFolleteria.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->totalCondones.'
                </td>
                <td style="text-align: center">
                   '.$datosInforme->totalLubricantes.'
                </td>
            </tr>';
        $html .= '</table>';


        return $html;
    }

}