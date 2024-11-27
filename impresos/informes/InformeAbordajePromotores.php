<?php


class InformeAbordajePromotores {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }

    static function generar_periodo( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'abordajes' . DS;
        $nombre = 'informe_trimestral_abordajes_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::generar(
                'Informe mensual abordajes de promotores.', 
                'ABORDAJES MENSUAL DE PROMOTORES',
                $periodo[0]->CODIGO_PERIODO, $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    static function generar_trimestre( $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ) {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'abordajes' . DS;
        $nombre = 'informe_mensual_abordajes_promotores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        
            $array_cod = array();
            foreach ($periodo as $periodo_actual) {
                array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
            }
            asort( $array_cod );
            $CODIGOS = implode(' - ', $array_cod);
        
        self::generar(
                'Informe trimestral abordajes de promotores.',
                'ABORDAJES TRIMESTRALES DE PROMOTORES',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;
    }
    
    public static function generar($titulo, $titulo_informe, $CODIGOS, $ruta, $nombre, $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '') {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'abordajes' . DS;
        $nombre = 'informe_abordajes_promotores_' . uniqid() . '.pdf';
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
        self::$generador->Cell(0, 7, 'ANEXO 7.x', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, $titulo_informe, 0, true, 'C', 0, '', 0, false, 'M', 'M');       
        self::$generador->SetFont('helvetica', 'B', 8); 
        self::$generador->Cell(0, 7, 'PERIODO /MES : ' . $CODIGOS . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'PROMOTOR: ' . $nombrePromotor . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
        
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


        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'abordajes' . DS;
        $nombre = 'informe_mensual_abordajes_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);  

        $array_cod = array();
        foreach ($periodo as $periodo_actual) {
            array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
        }
        asort( $array_cod );
        $CODIGOS = implode(' - ', $array_cod);

        self::generar_xls(
                'INFORME DE ALCANCES POR PROMOTORES PARA EL PERIODO ',
                $CODIGOS,  $ruta, $nombre,
                $subreceptor, $datosInforme, $periodo, $nombreProvincia, $nombreCanton, $nombrePromotor, $nombreGenerador);
        
        
        return self::$RUTA;

    }

    public static function generar_trimestre_xls(  $subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombrePromotor = '', $nombreGenerador = '' ){


        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'promotores' . DS . 'abordajes' . DS;
        $nombre = 'informe_trimestral_abordajes_promotores_' . uniqid() . '.xls';
        Archivos::probar_crear_directorio($ruta);  

        $array_cod = array();
        foreach ($periodo as $periodo_actual) {
            array_push($array_cod, $periodo_actual->CODIGO_PERIODO);
        }
        asort( $array_cod );
        $CODIGOS = implode(' - ', $array_cod);

        self::generar_xls(
                'INFORME DE ALCANCES POR PROMOTORES PARA LOS PERIODOS ',
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
                ->setCellValue('G'.$fila.'', 'ANEXO 7.x' )
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
                    ->setCellValue('B6', 'Codigo')
                    ->setCellValue('C6', 'Primer Nombre')
                    ->setCellValue('D6', 'Segundo Nombre')
                    ->setCellValue('E6', 'Primer Apellido')
                    ->setCellValue('F6', 'Segundo Apellido')
                    ->setCellValue('G6', 'Año Nacimiento')
                    ->setCellValue('H6', 'Mes Nacimiento')
                    ->setCellValue('I6', 'Fecha Alcance')
                    ->setCellValue('J6', 'Hora Alcance')
                    ->setCellValue('K6', 'Promotor')
                    ->setCellValue('L6', 'Nuevo')
                    ->setCellValue('M6', 'Recurrente')
                    ->setCellValue('N6', 'Derivado Efectivo')
                    ->setCellValue('O6', 'Verificado')
                    ->setCellValue('P6', 'Hoja de Alcances');
        $fila = 7;
        $countRow = 0;
        foreach ($datosInforme->filas as $informe) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$fila.'', ($countRow += 1))
                    ->setCellValue('B'.$fila.'', $informe->CODIGO_UNICO_PERSONA )
                    ->setCellValue('C'.$fila.'', $informe->PRIMER_NOMBRE_PEMAR )
                    ->setCellValue('D'.$fila.'', $informe->SEGUNDO_NOMBRE_PEMAR)
                    ->setCellValue('E'.$fila.'', $informe->PRIMER_APELLIDO_PEMAR)
                    ->setCellValue('F'.$fila.'', $informe->SEGUNDO_APELLIDO_PEMAR )
                    ->setCellValue('G'.$fila.'', $informe->ANO_NACIMIENTO_POBLACION )
                    ->setCellValue('H'.$fila.'', $informe->MES_NACIMIENTO_POBLACION)
                    ->setCellValue('I'.$fila.'', $informe->FECHA_CONTACTO)
                    ->setCellValue('J'.$fila.'', $informe->HORA_CONTACTO)
                    ->setCellValue('K'.$fila.'', $informe->NOMBRE_PROMOTOR)
                    ->setCellValue('L'.$fila.'', $informe->NUEVO)
                    ->setCellValue('M'.$fila.'', $informe->RECURRENTE)
                    ->setCellValue('N'.$fila.'', $informe->REFERIDOS_EFECTIVO)
                    ->setCellValue('O'.$fila.'', $informe->VERIFICADO_PEMAR)
                    ->setCellValue('P'.$fila.'', $informe->NUM_REGISTROSEMANAL);
            $fila++;
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
                <td>#</td>
                <td>Codigo</td>
                <td>Primer Nombre</td>
                <td>Segundo Nombre</td>
                <td>Primer Apellido</td>
                <td>Segundo Apellido</td>
                <td>Año Nacimiento</td>
                <td>Mes Nacimiento</td>
                <td>Fecha Abordaje</td>
                <td>Hora Abordaje</td>
                <td>Verificado</td>
                <td>Seguimiento</td>
            </tr>
            ';
        foreach ($datosInforme->filas as $informe) {
            $html.='
                <tr>
                    <td>' . ($countRow += 1) . '</td>
                    <td>' . $informe->CODIGO_UNICO_PERSONA . '</td>
                    <td>' . $informe->NOMBRE_UNO_POBLACION . '</td>
                    <td>' . $informe->NOMBRE_DOS_POBLACION . '</td>
                    <td>' . $informe->APELLIDO_UNO_POBLACION . '</td>
                    <td>' . $informe->APELLIDO_DOS_POBLACION . '</td>
                    <td>' . $informe->ANO_NACIMIENTO_POBLACION . '</td>
                    <td>' . $informe->MES_NACIMIENTO_POBLACION . '</td>
                    <td>' . $informe->FECHA_CONTACTO . '</td>
                    <td>' . $informe->HORA_CONTACTO . '</td>
                    <td>' . $informe->VERIFICADO_PEMAR . '</td>
                    <td>' . $informe->NUM_REGISTROSEMANAL . '</td>
                </tr>';
        }
        $html .= '</table>';


        return $html;
    }

}