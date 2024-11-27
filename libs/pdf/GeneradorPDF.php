<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneradorPDF
 *
 * @author Software
 */
class GeneradorPDF extends TCPDF {
    
    public $SUBRECEPTOR;
    public $titulo_documento = 'Documento';
    public $url_logo = 'imagenes/logo.jpg'; 
    public $tipo_logo = 'JPG'; 
    public $direccion_descarga = 'http://simon.kimirina.org/'; 
    public $pie_documento = 'documento generador por SIMON.';
    public $url_logo_proyecto = 'imagenes/logo.jpg';
    
    public function __construct() {
        parent::__construct();
        $this->SetCreator('SIMON - Kimirina Corporation');
        $this->SetAuthor('Ing. Juan Pablo Llinas Ramirez');
        $this->SetTitle('Documento Generado por SIMON');
        $this->SetSubject('Documento Generado por SIMON');
        $this->SetKeywords('documento, simon, pdf, generado');
    }

//Page header
    public function Header() {
        
        $this->SetY(0); 
        $this->SetX(0);
        $image_file = $this->url_logo;
        $this->Image($image_file, 0, 0, '', 20, $this->tipo_logo, '', 'T', false, 300, '', false, false, 0, false, false, false);
 //if ($this->getAliasNumPage() == 1 ) {
                
        $this->SetY(2); 
        $this->SetX(175);
        $style = array(
            'border' => 1,
            'vpadding' => 1,
            'hpadding' => 1,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false
        );
        $this->write2DBarcode($this->direccion_descarga, 'QRCODE,H', '', '', 50, 50, $style);
        //}

        $this->SetY(5);         
        $this->SetFont('helvetica', '', 6);
        $this->Cell(0, 7, $this->SUBRECEPTOR->NOMBRE_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(0, 7, $this->SUBRECEPTOR->SIGLAS_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 5);
        $this->Cell(0, 5, $this->SUBRECEPTOR->DIRECCION_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 5, $this->SUBRECEPTOR->TELEFONO_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 7, $this->SUBRECEPTOR->SITIOWEB_SUBRECEPTOR, 0, true, 'C', 0, '', 0, false, 'M', 'M');                    
               
        $this->SetFont('helvetica', 'B', 12);    
        $this->Cell(0, 0, $this->titulo_documento, 0, true, 'C', 0, '', 0, false, 'M', 'M');
       
       
    }

// Page footer
    public function Footer() {
        
        $params = Parametros::singleton();
        
        // Position at 15 mm from bottom
        $this->SetY(-15);

        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Title
        $this->Cell(0, 0, $params->valor('NOMBREPROYECTO') , 0, true, 'C', 0, '', 0, false, 'M', 'M');// Page number   
        //$this->SetY(-10);
        $this->Cell(90, 10, ''.date('D M j, Y-m-d H:i:s T ') .'', 0, false, 'L', 0, '', 0, false, 'T', 'M');        
        $this->Cell(0, 10, ''. $_SESSION['SESION_USUARIO']->NICK .'-'.$_SESSION['SESION_USUARIO']->NOMBRE_REAL_PERSONA." |   ", 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        //$this->SetY(-10);
        $this->Cell(0, 10, '     Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
                
        $image_file = 'archivos'.DS.$params->valor('LOGOINFORMES');
        $this->Image($image_file, '', '', '', 10, '', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
        
    }

}
