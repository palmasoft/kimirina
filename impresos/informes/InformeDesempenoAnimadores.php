<?php


class InformeDesempenoAnimadores {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }

    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'desempeno' . DS;
        $nombre = 'informe_mensual_desempeno_animadores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe desempeño mensual de animadores.',
                'DESEMPEÑO MENSUAL ANIMADORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'desempeno' . DS;
        $nombre = 'informe_trimestral_desempeno_animadores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe desempeño trimestral de animadores.', 
                'DESEMPEÑO TRIMESTRAL ANIMADORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '') {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'desempeno' . DS;
        $nombre = 'informe_desempeno_animadores_' . uniqid() . '.pdf';
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
        self::$generador->Cell(0, 7, 'ANEXO 7.4', 0, true, 'C', 0, '', 0, false, 'M', 'M');
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
        $HTML = self::producir_html($datosInforme, $periodo, $nombreAnimador, $nombreGenerador);
        self::$generador->writeHTML($HTML);        
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }

    static function generar_periodo_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'desempeno' . DS;
        $nombre = 'informe_mensual_desempeno_animadores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
        $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME DESEMPEÑO MENSUAL ANIMADORES',
                $CODIGOS, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombreAnimador, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre_xls( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreAnimador = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'animadores' . DS . 'desempeno' . DS;
        $nombre = 'informe_trimestral_desempeno_animadores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar_xls(
                'INFORME DESEMPEÑO TRIMESTRAL ANIMADORES',
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
                ->setCellValue('I'.$fila.'', 'ANIMADOR:' )
                ->setCellValue('J'.$fila.'', $nombreAnimador)
                ->setCellValue('K'.$fila.'', '')
                ->setCellValue('L'.$fila.'', '');
            

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A6', '#')
                    ->setCellValue('B6', 'Nombre(s) y Apellido(s)')
                    ->setCellValue('C6', 'Participacion en actividades de capacitacion 1 semana')
                    ->setCellValue('D6', 'Participacion en actividades de capacitacion 2 semana')
                    ->setCellValue('E6', 'Participacion en actividades de capacitacion 3 semana')
                    ->setCellValue('F6', 'Participacion en actividades de capacitacion 4 semana')
                    ->setCellValue('G6', 'Participacion en actividades de capacitacion Total')
                    ->setCellValue('H6', 'Participación en reuniones técnicas 1 semana')
                    ->setCellValue('I6', 'Participación en reuniones técnicas 2 semana')
                    ->setCellValue('J6', 'Participación en reuniones técnicas 3 semana')
                    ->setCellValue('K6', 'Participación en reuniones técnicas 4 semana')
                    ->setCellValue('L6', 'Participación en reuniones técnicas Total');

        $fila = 7;
        $countRow = 0;
        foreach ($datosInforme->filas as $informe) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', ($countRow += 1))
                    ->setCellValue('B'.$fila.'', $informe->NOMBRE_ANIMADOR )
                    ->setCellValue('C'.$fila.'', $informe->SEM_1_CAPACITACION )
                    ->setCellValue('D'.$fila.'', $informe->SEM_2_CAPACITACION)
                    ->setCellValue('E'.$fila.'', $informe->SEM_3_CAPACITACION)
                    ->setCellValue('F'.$fila.'', $informe->SEM_4_CAPACITACION )
                    ->setCellValue('G'.$fila.'', $informe->TOTAL_CAPACITACION )
                    ->setCellValue('H'.$fila.'', $informe->SEM_1_REUNIONES)
                    ->setCellValue('I'.$fila.'', $informe->SEM_2_REUNIONES)
                    ->setCellValue('J'.$fila.'', $informe->SEM_3_REUNIONES)
                    ->setCellValue('K'.$fila.'', $informe->SEM_4_REUNIONES)
                    ->setCellValue('L'.$fila.'', $informe->TOTAL_REUNIONES);
            $fila++;
        }       
 
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$fila.'', 'TOTAL' )
                    ->setCellValue('G'.$fila.'', $datosInforme->ttlActividades)
                    ->setCellValue('L'.$fila.'', $datosInforme->ttlReuniones);
        
        $objPHPExcel->getActiveSheet()->setTitle('Desempeño del Animador ' . $nombreAnimador );
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
                    <td rowspan="2">#</td>
                    <td rowspan="2" style="width: 100px" >Nombre(s) y Apellido(s)</td>
                    <td colspan="5">Participacion en actividades de capacitacion</td>
                    <td colspan="5">Participación en reuniones técnicas</td>       
                </tr>
                
                <tr>                  
                    <td>1 sem</td>
                    <td>2 sem</td>
                    <td>3 sem</td>
                    <td>4 sem</td>
                    <td>Total</td>
                    
                    <td>1 sem</td>
                    <td>2 sem</td>
                    <td>3 sem</td>
                    <td>4 sem</td>
                    <td>Total</td>
                </tr>
            ';

        foreach ($datosInforme->filas as $informe):
            
            $html .=
            '<tr>
                        <td>'.($countRow += 1) .'</td>
                        <td>'.($informe->NOMBRE_ANIMADOR).'</td>
                            
                        <td>
                            '.$informe->SEM_1_CAPACITACION.'
                        </td>
                        <td>
                            '.$informe->SEM_2_CAPACITACION.'
                        </td>
                        <td>
                            '.$informe->SEM_3_CAPACITACION.'
                        </td>
                        <td>
                            '.$informe->SEM_4_CAPACITACION.'
                        </td>
                        <td>
                            '.$informe->TOTAL_CAPACITACION.'
                        </td>
                        <td>
                            '.$informe->SEM_1_REUNIONES.'
                        </td>
                        <td>
                            '.$informe->SEM_2_REUNIONES.'
                        </td>
                        <td>
                            '.$informe->SEM_3_REUNIONES.'
                        </td>
                        <td>
                            '.$informe->SEM_4_REUNIONES.'
                        </td>
                        <td>
                            '.$informe->TOTAL_REUNIONES.'
                        </td>
                    </tr>';
        endforeach;
        
        $html .= '<tr>
                <td colspan="2" style="text-align: center; font-weight: bolder;  font-size: larger" >TOTAL</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>'.$datosInforme->ttlActividades.'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>'.$datosInforme->ttlReuniones.'</td>
            </tr>';
        $html .= '</table>';


        return $html;
    }

}