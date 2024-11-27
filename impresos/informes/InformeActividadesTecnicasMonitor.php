<?php


class InformeActividadesTecnicasMonitor {

    
    public static $RUTA = '';
    public static $generador;

    public static function cargar_generador() {
        if (!isset(self::$generador)) {
            self::$generador = new GeneradorPDF();
        }
        return self::$generador;
    }

    public static function generar($subreceptor, $datosInforme = null, $periodo = '', $nombreProvincia = '', $nombreCanton = '', $nombreMonitor = '', $nombreGenerador = '') {
        $ruta = 'archivos' . DS . 'informes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'monitores' . DS . 'actividades_tecnicas' . DS;
        $nombre = 'informe_actividades_tecnicas_monitores_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);
        self::cargar_generador();

        self::$generador->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);

        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte Mensual Actividades Tecnicas Monitor/a.';
        $urldownload = str_replace(DS, '/',URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);        
        self::$generador->Cell(0, 7, 'ANEXO 7.6.5', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);        
        self::$generador->Cell(0, 10, 'REPORTE MENSUAL ACTIVIDADES TECNICAS MONITORES', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);        
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('', 'B', 7);        
        self::$generador->Cell(50, 0, 'PROVINCIA: ' . $nombreProvincia. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(50, 0, 'CANTON: ' . $nombreCanton. '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Cell(0, 0, 'MONITOR: ' . $nombreMonitor . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');        
//        
        
        self::$generador->Ln(2);
        $HTML = self::producir_html($datosInforme, $periodo, $nombreMonitor, $nombreGenerador);
        self::$generador->writeHTML($HTML);        
        
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B',  true, 'C', 0, '', 0, false, 'M', 'B');               
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0,  true, 'C', 0, '', 0, false, 'T', 'M');              

        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }

    public static function producir_html($datosInforme = null, $periodo = '', $nombreMonitor = '', $nombreGenerador = '') {

        $countRow = 0;
        $html = '';
        $html .= '<table cellspacing="0" cellpadding="1" border="1" style="width: 90%; margin: auto">';
        $html .= '
            <tr>
                <td>Nombre Monitor</td>
                <td>Tipo de actividad </td>
                <td>Total de Actividades</td>                
            </tr>
            ';
        //$countRow = 0;
        if (isset($datosInforme)) {  
            foreach ($datosInforme as $informe){
                $html.='
                    <tr>
                            <td>
                                '.$informe->NOMBRE_MONITOR.'
                            </td>
                            <td>';
                            foreach ($informe->detalle as $informeMonitor){
                                $html.='   
                                    
                                    <table>
                                        <tr>
                                            <td>'.($informeMonitor->NOMBRE).'</td>
                                        </tr>
                                    </table>';
                            }
                            $html.='</td>
                                <td>';
                            foreach ($informe->detalle as $informeMonitor){
                                $html.='   
                                    <table>
                                        <tr>          
                                            <td>'.($informeMonitor->NUMERO_ACTIVIDADES).'</td>                       
                                        </tr>
                                    </table>';
                            }
                $html.='</td>
                    </tr>';
            }
        }
        $html .= '</table>';


        return $html;
    }

}