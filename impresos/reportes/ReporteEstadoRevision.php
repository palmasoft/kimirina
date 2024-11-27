<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReporteEstadoRevision
 *
 * @author Software
 */
class ReporteEstadoRevision {

    //put your code here
    public static $RUTA = '';
    public static $generador;

    static public function generar_promotores($subreceptor, $periodo, $nombreGenerador, $totales = NULL, $datos = NULL) {
        self::$generador = new GeneradorPDF();
        $ruta = 'archivos' . DS . 'reportes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'revision_registros' . DS . 'promotores' . DS;
        $nombre = 'estado_revision_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);

        self::$generador->SetMargins(10, 25, 10);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);
        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte de la Revision.';
        $urldownload = str_replace(DS, '/', URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'Reporte', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, 'ESTADO DE LA REVISION DE LAS HOJAS DE REGISTRO SEMANAL DE ALCANCES', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Ln(2);

        $estylo = self::estilos();
        $tablaTotales = self::html_tabla_totales($totales);
        self::$generador->writeHTML($estylo . $tablaTotales);

        $tablaRegistrosTapa = '<div>
            <table align="center" cellspacing="0" cellpadding="1" border="1" style="text-align: center;"  >            
                <tr style="font-size: 7px;"  class="label-neutral" >
                    <td width="12%" >Seguimiento</td>
                    <td width="5%" >Pob</td>
                    <td width="15%" >Ubicacion</td>
                    <td width="15%" >Fechas</td>
                    <td width="20%" >Promotor</td>
                    <td width="10%" >Estado</td>
                    <td width="13%">Responsable</td>    
                    <td width="10%" >Tipo Revision</td>                    
                </tr>';
        $tablaRegistrosPie = '</table></div>';

        $filas = 0;
        $filasTotales = count($datos);
        $tablaRegistros = '';
        $estados = array();
        foreach ($datos as $registroSemanal) {
            $NOMBRE_RESPONSABLE = $registroSemanal->NOMBRE_DIGITADOR;
            if (!isset($estados[$registroSemanal->ESTADO_REVISION]))
                $estados[$registroSemanal->ESTADO_REVISION] = 0;
            $estados[$registroSemanal->ESTADO_REVISION] ++;

            switch ($registroSemanal->ESTADO_REVISION) {
                case 'REVISADO':
                    $NOMBRE_RESPONSABLE = $registroSemanal->NOMBRE_MONITOR;
                    break;
                case 'REVISION':
                    $NOMBRE_RESPONSABLE = $registroSemanal->NOMBRE_MONITOR;
                    break;
                case 'APROBADO':
                    $NOMBRE_RESPONSABLE = $registroSemanal->NOMBRE_COORDINADOR;
                    break;
                case 'NO APROBADO':
                    $NOMBRE_RESPONSABLE = $registroSemanal->NOMBRE_COORDINADOR;
                    break;
            }
            $tablaRegistros .= '
                <tr style="font-size: 6px;" >                                        
                    <td>' . $registroSemanal->NUM_REGISTROSEMANAL . '</td>
                    <td>' . $registroSemanal->TIPO_FORMATO_REGISTROSEMANAL . '</td>
                    <td>' . $registroSemanal->NOMBRE_PROVINCIA . '-' . $registroSemanal->NOMBRE_CANTON . '</td>
                    <td>' . $registroSemanal->SEMANA_DEL . ' / ' . $registroSemanal->SEMANA_HASTA . '</td>
                    <td>' . strtoupper($registroSemanal->NOMBRE_REAL_PERSONA) . '</td>
                    <td class="' . strtolower($registroSemanal->ESTADO_REVISION) . '" >' . $registroSemanal->ESTADO_REVISION . '</td>
                    <td>' . $NOMBRE_RESPONSABLE . '</td>
                    <td>' . $registroSemanal->TIPO_REVISION . '</td>
                </tr>';
            $filas++;
            if ($filas >= 38) {
                self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
                self::$generador->AddPage();
                self::$generador->SetFont('helvetica', 'B', 8);
                self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
                self::$generador->Ln(2);
                $tablaRegistros = '';
                $filas = 0;
            }
        }
        self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B', true, 'C', 0, '', 0, false, 'M', 'B');
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0, true, 'C', 0, '', 0, false, 'T', 'M');


        self::$generador->AddPage();
        self::$generador->Write(0, 'ESTADISTICAS DE LA REVISION.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $angIni = 0;
        $angFin = 0;
        $yTexto = 10;
        $n = 0;
        foreach ($estados as $indice => $cantidad) {
            $porcStat = ($cantidad) / $filasTotales;
            $angSector = intval(360 * ( $porcStat ));
            $angIni = $angFin;
            $angFin = round($angIni + $angSector);

            self::$generador->SetFillColor(rand(0, 75), rand(75, 150), rand(150, 255));
            self::$generador->PieSector($xc, $yc, $r, $angIni, $angFin, 'FD', false, 0, 2);
            self::$generador->SetTextColor(255, 255, 255);
            self::$generador->setX(0);
            self::$generador->setY($yc + 50 + ($yTexto * $n));
            self::$generador->Cell(
                    0, $yTexto, '' . $indice . ' [' . ($porcStat * 100) . '%]', 1, 1, 'C', 1, '', 0, false, 'T', 'C');
            $n++;
        }


        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }

    static public function generar_animadores($subreceptor, $periodo, $nombreGenerador, $totales = NULL, $datos = NULL) {

        self::$generador = new GeneradorPDF();
        $ruta = 'archivos' . DS . 'reportes' . DS . 
                $subreceptor->SIGLAS_SUBRECEPTOR . DS . 
                'revision_registros' . DS . 'animadores' . DS;
        $nombre = 'estado_revision_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);

        self::$generador->SetMargins(10, 25, 10);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);
        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte de la Revision.';
        $urldownload = str_replace(DS, '/', URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'Reporte', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, 'ESTADO DE LA REVISION DE RECIBOS DE CONTACTO POR ANIMADOR', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Ln(2);

        
        $estylo = self::estilos();
        $tablaTotales = self::html_tabla_totales($totales);
        self::$generador->writeHTML($estylo . $tablaTotales);

        $tablaRegistrosTapa = '<div>
            <table align="center" cellspacing="0" cellpadding="1" border="1" style="text-align: center;"  >            
                <tr style="font-size: 7px;"  class="label-neutral" >
                    <td width="7%" >Recibo</td>
                    <td width="7%" >Fecha</td>
                    <td width="5%" >Pob</td>
                    <td width="10%" >CODIGO</td>
                    <td width="15%" >NOMBRE</td>                    
                    <td width="8%" >CEDULA</td>
                    <td width="14%" >Animador</td>
                    <td width="10%" >Estado</td>
                    <td width="14%" >Responsable</td>    
                    <td width="10%" >Tipo Revision</td>                    
                </tr>';
        $tablaRegistrosPie = '</table></div>';

        $filas = 0;
        $filasTotales = count($datos);
        $tablaRegistros = '';
        $estados = array();
        foreach ($datos as $reciboAnimador) {

            $NOMBRE_RESPONSABLE = $reciboAnimador->NOMBRE_DIGITADOR;
            if (!isset($estados[$reciboAnimador->ESTADO_REVISION])) {
                $estados[$reciboAnimador->ESTADO_REVISION] = 0;
            }
            $estados[$reciboAnimador->ESTADO_REVISION] ++;

            switch ($reciboAnimador->ESTADO_REVISION) {
                case 'REVISADO':
                    $NOMBRE_RESPONSABLE = $reciboAnimador->NOMBRE_MONITOR;
                    break;
                case 'REVISION':
                    $NOMBRE_RESPONSABLE = $reciboAnimador->NOMBRE_MONITOR;
                    break;
                case 'APROBADO':
                    $NOMBRE_RESPONSABLE = $reciboAnimador->NOMBRE_COORDINADOR;
                    break;
                case 'NO APROBADO':
                    $NOMBRE_RESPONSABLE = $reciboAnimador->NOMBRE_COORDINADOR;
                    break;
            }
            $tablaRegistros .= '
                <tr style="font-size: 6px;" >                                        
                    <td>' . $reciboAnimador->NO_RECIBO_CONTACTOANIMADOR . '</td>
                    <td>' . $reciboAnimador->ANO_CONTACTOANIMADOR . '-' . $reciboAnimador->MES_CONTACTOANIMADOR . '-' . $reciboAnimador->DIA_CONTACTOANIMADOR . ' ' . $reciboAnimador->HORA_CONTACTOANIMADOR . '</td>
                    <td>' . $reciboAnimador->TIPO_FORMATO_CONTACTOANIMADOR . '</td>
                    <td>' . $reciboAnimador->CODIGO_UNICO_PERSONA . '</td>
                    <td>'.$reciboAnimador->PRIMER_NOMBRE_PEMAR.' '.$reciboAnimador->SEGUNDO_NOMBRE_PEMAR.' '.$reciboAnimador->PRIMER_APELLIDO_PEMAR.' '.$reciboAnimador->SEGUNDO_APELLIDO_PEMAR.'</td>
                    <td>' . $reciboAnimador->CEDULA_PEMAR . '</td>
                    <td>' . strtoupper($reciboAnimador->NOMBRE_REAL_PERSONA) . '</td>
                    <td class="' . strtolower($reciboAnimador->ESTADO_REVISION) . '" >' . $reciboAnimador->ESTADO_REVISION . '</td>
                    <td>' . $NOMBRE_RESPONSABLE . '</td>
                    <td>' . $reciboAnimador->TIPO_REVISION . '</td>
                </tr>';
            $filas++;
            if ($filas >= 32) {
                self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
                self::$generador->AddPage();
                self::$generador->SetFont('helvetica', 'B', 8);
                self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
                self::$generador->Ln(2);
                $tablaRegistros = '';
                $filas = 0;
            }
        }
        self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B', true, 'C', 0, '', 0, false, 'M', 'B');
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0, true, 'C', 0, '', 0, false, 'T', 'M');

        self::$generador->AddPage();
        self::$generador->Write(0, 'ESTADISTICAS DE LA REVISION.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $angIni = 0;
        $angFin = 0;
        $yTexto = 10;
        $n = 0;
        foreach ($estados as $indice => $cantidad) {
            $porcStat = ($cantidad) / $filasTotales;
            $angSector = intval(360 * ( $porcStat ));
            $angIni = $angFin;
            $angFin = round($angIni + $angSector);

            self::$generador->SetFillColor(rand(0, 75), rand(75, 150), rand(150, 255));
            self::$generador->PieSector($xc, $yc, $r, $angIni, $angFin, 'FD', false, 0, 2);
            self::$generador->SetTextColor(255, 255, 255);
            self::$generador->setX(0);
            self::$generador->setY($yc + 50 + ($yTexto * $n));
            self::$generador->Cell(
                    0, $yTexto, '' . $indice . ' [' . ($porcStat * 100) . '%]', 1, 1, 'C', 1, '', 0, false, 'T', 'C');
            $n++;
        }

        
        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;
        
        return self::$RUTA;
    }
   
    static public function generar_consejeros($subreceptor, $periodo, $nombreGenerador, $totales = NULL, $datos = NULL) {
        self::$generador = new GeneradorPDF();
        $ruta = 'archivos' . DS . 'reportes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'revision_registros' . DS . 'consejeros' . DS;
        $nombre = 'estado_revision_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);

        self::$generador->SetMargins(10, 25, 10);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);
        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte de la Revision.';
        $urldownload = str_replace(DS, '/', URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'Reporte', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, 'ESTADO DE LA REVISION DE CONSEJERIAS A PVVS', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Ln(2);

        $estylo = self::estilos();
        $tablaTotales = self::html_tabla_totales($totales);
        self::$generador->writeHTML($estylo . $tablaTotales);

        $tablaRegistrosTapa = '<div>
            <table align="center" cellspacing="0" cellpadding="1" border="1" style="text-align: center;"  >            
                <tr style="font-size: 7px;"  class="label-neutral" >
                    <td width="12%" >Seguimiento</td>
                    <td width="8%" >Fecha</td>
                    <td width="7%" >inicio</td>
                    <td width="7%" >fin</td>
                    <td width="10%" >CODIGO</td>                 
                    <td width="8%" >CEDULA</td>
                    <td width="14%" >Consejero</td>
                    <td width="10%" >Estado</td>
                    <td width="14%" >Responsable</td>    
                    <td width="10%" >Tipo Revision</td>                    
                </tr>';
        $tablaRegistrosPie = '</table></div>';

        $filas = 0;
        $filasTotales = count($datos);
        $tablaRegistros = '';
        $estados = array();
        foreach ($datos as $consejeriaPvvs) {
            $NOMBRE_RESPONSABLE = $consejeriaPvvs->NOMBRE_DIGITADOR;
            if (!isset($estados[$consejeriaPvvs->ESTADO_REVISION])) {
                $estados[$consejeriaPvvs->ESTADO_REVISION] = 0;
            }
            $estados[$consejeriaPvvs->ESTADO_REVISION] ++;

            switch ($consejeriaPvvs->ESTADO_REVISION) {
                case 'REVISADO':
                    $NOMBRE_RESPONSABLE = $consejeriaPvvs->NOMBRE_MONITOR;
                    break;
                case 'REVISION':
                    $NOMBRE_RESPONSABLE = $consejeriaPvvs->NOMBRE_MONITOR;
                    break;
                case 'APROBADO':
                    $NOMBRE_RESPONSABLE = $consejeriaPvvs->NOMBRE_COORDINADOR;
                    break;
                case 'NO APROBADO':
                    $NOMBRE_RESPONSABLE = $consejeriaPvvs->NOMBRE_COORDINADOR;
                    break;
            }
            $tablaRegistros .= '
                <tr style="font-size: 6px;" >                                        
                    <td>' . $consejeriaPvvs->NUM_CONSEJERIA . '</td>
                    <td>' . $consejeriaPvvs->FECHA_CONSEJERIA . '</td>
                    <td>' . $consejeriaPvvs->HORA_INICIO . '</td>
                    <td>' . $consejeriaPvvs->HORA_FIN . '</td>
                    <td>' . $consejeriaPvvs->CODIGO_UNICO_PERSONA . '</td>                    
                    <td>' . $consejeriaPvvs->CEDULA_PEMAR . '</td>
                    <td>' . strtoupper($consejeriaPvvs->NOMBRE_REAL_PERSONA) . '</td>
                    <td class="' . strtolower($consejeriaPvvs->ESTADO_REVISION) . '" >' . $consejeriaPvvs->ESTADO_REVISION . '</td>
                    <td>' . $NOMBRE_RESPONSABLE . '</td>
                    <td>' . $consejeriaPvvs->TIPO_REVISION . '</td>
                </tr>';
            $filas++;
            if ($filas >= 32) {
                self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
                self::$generador->AddPage();
                self::$generador->SetFont('helvetica', 'B', 8);
                self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
                self::$generador->Ln(2);
                $tablaRegistros = '';
                $filas = 0;
            }
        }
        self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B', true, 'C', 0, '', 0, false, 'M', 'B');
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0, true, 'C', 0, '', 0, false, 'T', 'M');


        self::$generador->AddPage();
        self::$generador->Write(0, 'ESTADISTICAS DE LA REVISION.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $angIni = 0;
        $angFin = 0;
        $yTexto = 10;
        $n = 0;
        foreach ($estados as $indice => $cantidad) {
            $porcStat = ($cantidad) / $filasTotales;
            $angSector = intval(360 * ( $porcStat ));
            $angIni = $angFin;
            $angFin = round($angIni + $angSector);

            self::$generador->SetFillColor(rand(0, 75), rand(75, 150), rand(150, 255));
            self::$generador->PieSector($xc, $yc, $r, $angIni, $angFin, 'FD', false, 0, 2);
            self::$generador->SetTextColor(255, 255, 255);
            self::$generador->setX(0);
            self::$generador->setY($yc + 50 + ($yTexto * $n));
            self::$generador->Cell(
                    0, $yTexto, '' . $indice . ' [' . ($porcStat * 100) . '%]', 1, 1, 'C', 1, '', 0, false, 'T', 'C');
            $n++;
        }


        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
   
  
    static public function generar_atencion_salud($subreceptor, $periodo, $nombreGenerador, $totales = NULL, $datos = NULL) {
        self::$generador = new GeneradorPDF();
        $ruta = 'archivos' . DS . 'reportes' . DS . $subreceptor->SIGLAS_SUBRECEPTOR . DS . 'revision_registros' . DS . 'atencion_salud' . DS;
        $nombre = 'estado_revision_' . uniqid() . '.pdf';
        Archivos::probar_crear_directorio($ruta);

        self::$generador->SetMargins(10, 25, 10);
        self::$generador->SetHeaderMargin(0);
        self::$generador->SetFooterMargin(PDF_MARGIN_FOOTER);
        self::$generador->SUBRECEPTOR = $subreceptor;
        self::$generador->titulo_documento = 'Reporte de la Revision.';
        $urldownload = str_replace(DS, '/', URL_PUBLICA . $ruta . $nombre);
        self::$generador->direccion_descarga = $urldownload;
        self::$generador->AddPage();
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'Reporte', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 12);
        self::$generador->Cell(0, 10, 'ESTADO DE LA REVISION DE LOS REGISTROS DE ATENCION EN SALUD', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->SetFont('helvetica', 'B', 8);
        self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        self::$generador->Ln(2);

        $estylo = self::estilos();
        $tablaTotales = self::html_tabla_totales($totales);
        self::$generador->writeHTML($estylo . $tablaTotales);

        $tablaRegistrosTapa = '<div>
            <table align="center" cellspacing="0" cellpadding="1" border="1" style="text-align: center;"  >            
                <tr style="font-size: 7px;"  class="label-neutral" >
                    <td width="8%" >Fecha</td>
                    <td width="12%" >Centro de Salud</td>
                    <td width="5%" >TIPO</td> 
                    <td width="10%" >CODIGO</td>                 
                    <td width="10%" >CEDULA</td>
                    <td width="15%" >NOMBRE</td>
                    <td width="10%" >Servicio</td>
                    <td width="10%" >Estado</td>
                    <td width="10%" >Responsable</td>    
                    <td width="10%" >Tipo Revision</td>                    
                </tr>';
        $tablaRegistrosPie = '</table></div>';

        $filas = 0;
        $filasTotales = count($datos);
        $tablaRegistros = '';
        $estados = array();
        foreach ($datos as $atencionSalud) {
            $NOMBRE_RESPONSABLE = $atencionSalud->NOMBRE_DIGITADOR;
            if (!isset($estados[$atencionSalud->ESTADO_REVISION])) {
                $estados[$atencionSalud->ESTADO_REVISION] = 0;
            }
            $estados[$atencionSalud->ESTADO_REVISION] ++;

            switch ($atencionSalud->ESTADO_REVISION) {
                case 'REVISADO':
                    $NOMBRE_RESPONSABLE = $atencionSalud->NOMBRE_MONITOR;
                    break;
                case 'REVISION':
                    $NOMBRE_RESPONSABLE = $atencionSalud->NOMBRE_MONITOR;
                    break;
                case 'APROBADO':
                    $NOMBRE_RESPONSABLE = $atencionSalud->NOMBRE_COORDINADOR;
                    break;
                case 'NO APROBADO':
                    $NOMBRE_RESPONSABLE = $atencionSalud->NOMBRE_COORDINADOR;
                    break;
            }
            $tablaRegistros .= '
                <tr style="font-size: 6px;" >                                        
                    <td>' . $atencionSalud->FECHA_ATENCION . '</td>
                    <td style="font-size: 80%;" >' . $atencionSalud->NOMBRE_CENTROSERVICIO . '</td>
                    <td valign="middle" >' . $atencionSalud->TIPO_FORMATO_ATENCION . '</td>
                    <td>' . $atencionSalud->CODIGO_UNICO_PERSONA . '</td>
                    <td>' . $atencionSalud->CEDULA_PEMAR . '</td>
                    <td>'.$atencionSalud->PRIMER_NOMBRE_PEMAR.' '.$atencionSalud->SEGUNDO_NOMBRE_PEMAR.' '.$atencionSalud->PRIMER_APELLIDO_PEMAR.' '.$atencionSalud->SEGUNDO_APELLIDO_PEMAR.'</td>                    
                    <td>' . $atencionSalud->NOMBRE_SERVICIO . '</td>
                    <td class="' . strtolower($atencionSalud->ESTADO_REVISION) . '" >' . $atencionSalud->ESTADO_REVISION . '</td>
                    <td>' . $NOMBRE_RESPONSABLE . '</td>
                    <td>' . $atencionSalud->TIPO_REVISION . '</td>
                </tr>';
            $filas++;
            if ($filas >= 32) {
                self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
                self::$generador->AddPage();
                self::$generador->SetFont('helvetica', 'B', 8);
                self::$generador->Cell(0, 7, 'PERIODO/MES: ' . $periodo->CODIGO_PERIODO . '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
                self::$generador->Ln(2);
                $tablaRegistros = '';
                $filas = 0;
            }
        }
        self::$generador->writeHTML($estylo . $tablaRegistrosTapa . $tablaRegistros . $tablaRegistrosPie);
        self::$generador->SetFont('', '', 7);
        self::$generador->Cell(60, 60, '' . $nombreGenerador . '', 'B', true, 'C', 0, '', 0, false, 'M', 'B');
        self::$generador->SetFont('', 'B', 9);
        self::$generador->Cell(60, 5, 'FIRMA DEL RESPONSABLE', 0, true, 'C', 0, '', 0, false, 'T', 'M');


        self::$generador->AddPage();
        self::$generador->Write(0, 'ESTADISTICAS DE LA REVISION.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $angIni = 0;
        $angFin = 0;
        $yTexto = 10;
        $n = 0;
        foreach ($estados as $indice => $cantidad) {
            $porcStat = ($cantidad) / $filasTotales;
            $angSector = intval(360 * ( $porcStat ));
            $angIni = $angFin;
            $angFin = round($angIni + $angSector);

            self::$generador->SetFillColor(rand(0, 75), rand(75, 150), rand(150, 255));
            self::$generador->PieSector($xc, $yc, $r, $angIni, $angFin, 'FD', false, 0, 2);
            self::$generador->SetTextColor(255, 255, 255);
            self::$generador->setX(0);
            self::$generador->setY($yc + 50 + ($yTexto * $n));
            self::$generador->Cell(
                    0, $yTexto, '' . $indice . ' [' . ($porcStat * 100) . '%]', 1, 1, 'C', 1, '', 0, false, 'T', 'C');
            $n++;
        }


        self::$generador->Output($ruta . $nombre, 'F');
        self::$RUTA = $ruta . $nombre;

        return self::$RUTA;
    }
   
    
    
    
    
    
    
    
    static public function html_tabla_totales($totales) {
        $tablaTotales = '
            <div>
                <table cellspacing="2" cellpadding="2" border="1" style="text-align:center" >
                <thead>
                    <tr>
                        <td colspan="4" >NUMERO TOTAL EN ESTADO... </td>
                    </tr>
                    <tr>
                        <td class=" label-info" >PENDIENTE</td>
                        <td class=" label-warning" >EN REVISION</td>
                        <td class=" label-important" >REVISADO</td>
                        <td class=" label-success" >APROBADOS</td> 
                    </tr>
                    </thead>
                        <tr>
                            <td>' . $totales->TOTAL_PENDIENTES . '</td>
                            <td >' . $totales->TOTAL_ENREVISION . '</td>
                            <td >' . $totales->TOTAL_REVISADOS . '</td>
                            <td >' . $totales->TOTAL_APROBADOS . '</td>
                        </tr>
                    </table>
            </div>';
        return $tablaTotales;
    }

    static public function estilos() {
        $tablaTotales = '
            <style>
                .label-important, .revisado {
                    background-color: #fc4c4c;
                    font-size: 100%;
                }                
                .label-warning, .revision {
                    background-color: #fcbc4c;
                }
                .label-success, .aprobado {
                    background-color: #b1cc16;
                }                
                .label-info, .pendiente {
                    background-color: #4cb9fc;
                }                
                .label-inverse {
                   background-color: #555;
                }
                .label-neutral {
                    background-color: #e9e9e9;
                }                
            </style>';
        return $tablaTotales;
    }

}
