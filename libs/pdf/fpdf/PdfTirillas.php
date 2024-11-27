<?php

class PdfTirillas extends FPDF
{

var $usuario = '';
	
//Cabecera de página
function Header()
{
    //Logo
    $this->Image('archivos/viajeros/logos/logo.gif',10,10,21);
    $this->SetFont('Arial','B',13);
	$this->Cell( 0, 5,'VIAJEROS LIMITADA',0,1,'R');
    $this->SetFont('Arial','B',9);
	$this->Cell( 0, 3,'N.I.T. 987.123.332-8',0,1,'R');
	    //Arial italic 8
    $this->SetFont('Arial','I',6);
    //Número de página
    $this->Cell(0,2,'Fecha de Pago '.date('Y-m-d H:i:s'),0,1,'R');
	$this->Cell(0,2,'Recibido por '.strtoupper($this->usuario),0,1,'R');
}

//Pie de página
function Footer()
{
}

}

?>