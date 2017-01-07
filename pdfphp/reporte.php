<?php

//include("conexion.php");	
require('fpdf/fpdf.php'); //Agregamos la librería


     //Creamos clase PDF que herada de FPDF
	class PDF extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			// Logo
			$this->Image('images/logo.png',10,8,33);
			// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Movernos a la derecha
			$this->Cell(80);
			// Título
			$this->Cell(30,10,'BIENVENIDOS A AUTOMOTORES CLUB',0,0,'C');
			// Salto de línea
			$this->Ln(20);
			$this->Text(80,50,utf8_decode('"CORDIAL SALUDO"'),0,'C', 0);
	        $this->SetFont('Arial','',10);
	        $this->Text(120,73,utf8_decode('Asunto: Datos de registro como proveedores'),0,'C', 0);
	
	        $this->Ln(70);
		}
		
		//$stid = oci_parse($conn, "SELECT * FROM  AC_PROVEEDOR");
        //oci_execute($stid);





		// Pie de página
		function Footer()
		{
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}
	}
	
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	
 
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(190,5,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.');
 
 $pdf->Ln(50);
	
	$pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255); 
    
$pdf->SetXY(20, 205);
    $pdf->Cell(70, 15, 'ELABORO:', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 230);
    $pdf->Cell(70, 5, '______________________', 0, 0, 'C', 1);     
    
	$pdf->SetXY(145, 205);
    $pdf->Cell(10, 15, 'Vo. Bo.', 0, 0, 'C', 1);
	
	$pdf->SetXY(145, 230);
    $pdf->Cell(10, 5, '_______________________________________', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 235);
    $pdf->Cell(70, 5, 'Nombre del Encargado', 0, 0, 'C', 1);     
	
	$pdf->SetXY(110, 235);
    $pdf->Cell(80, 5, 'Firma Representante de la Empresa', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 240);
    $pdf->Cell(70, 5, 'Empresa Automotores Club', 0, 0, 'C', 1);  
	
	
    
	$pdf->Ln(40);


	$pdf->Output('registro.pdf', 'D');
?>