<?php


class ReporteMensualSubreceptor {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }

    public static function generar($subreceptor, $datosReporte = null, $periodo = '', $estado , $nombreGenerador = '') {
        
        $ruta = 'archivos' . DS . 'reportes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'reporte_mensual' . DS . $estado . DS;
        $nombre = 'reporte_mensual_'.$estado . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::cargar_generador();

        self::$generador->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);

        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte Mensual.';
        $urldownload = str_replace(DS, '/',URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);        
        //self::$generador->Cell(0, 7, 'ANEXO 7.6.5', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);        
        self::$generador->Cell(0, 10, 'REPORTE MENSUAL '.$subreceptor->SIGLAS_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);        
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
//        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//        self::$generador->Cell(0, 0, 'MONITOR: ' . $nombreMonitor . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
//        
        
        self::$generador->Ln(2);
        $HTML = self::producir_html($datosReporte, $periodo, $subreceptor, $nombreGenerador);
        self::$generador->writeHTML($HTML);        
        if($estado=="pre_aprobacion"){
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL MONITOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              
        }elseif ($estado=="aprobacion") {
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL MONITOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL COORDINADOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($estado=="aceptado") {
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL MONITOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL COORDINADOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');
            self::$generador->SetFont('', '', 7);
            self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
            self::$generador->SetFont('', 'B', 9);
            self::$generador->Cell(60, 5, 'FIRMA DEL GESTOR', 0,  true, 'C', 0, '', 0, false, 'T', 'M');
        }

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }

    public static function producir_html($datosReporte = null, $periodo = '', $subreceptor = '', $nombreGenerador = '') {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td colspan="3" ><h4>PERIODO/MES: '.($periodo->CODIGO_PERIODO ).'</h4></td>
                
                <th colspan="2">Reportado</th>               
            </tr>
            
            <tr>
                <th></th>
                <th>Indicador</th>
                <th>META SEM</th>
                <th>ACUM</th>
                <th>VALOR</th>
            </tr>
            ';
        //$countRow = 0;
        if (isset($datosReporte)) {  
            foreach ($datosReporte as $reporte){
                $html.='
                    <tr>
                        <td>'.$reporte->ID_INDICADOR.'</td>
                        <td>'.$reporte->NOMBRE_INDICADOR.'</td>
                        <td>'.$reporte->META_INDICADOR.'</td>
                        <td>'.$reporte->ACUM_REPORTADO.'</td>
                        <th style="font-size: 110%;text-align: center;">'.$reporte->VALOR_REPORTADO.'</th>
                    </tr>
                    ';
            }
        }
        $html .= '</table>';


        return $html;
    }

}