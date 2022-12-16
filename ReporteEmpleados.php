<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    
// Cabecera de página
function Header()
{
    $this->Image('img/logo.png',3,3,42);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    
    // Salto de línea
    $this->Ln(0);
	
    // Arial bold 15
    $this->SetFont('Arial','B',13);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->Cell(70,2,'AMIRA OPTICS SOCIEDAD ANONIMA CERRADA',0,1,'C');
    $this->Ln(8);
    $this->Cell(274,10,'REPORTE DE EMPLEADOS',1,0,'C',);
    // Salto de línea
    $this->Ln(12);

    $this->Cell(10,10,'ID',1,0,'C',0);
	$this->Cell(30,10,'Nombres',1,0,'C',0);
	$this->Cell(30,10,'Apellidos',1,0,'C',0);
    $this->Cell(45,10,'Correo',1,0,'C',0);
    $this->Cell(34,10,'Contrasena',1,0,'C',0);
    $this->Cell(20,10,'DNI',1,0,'C',0);
    $this->Cell(25,10,'Celular',1,0,'C',0);
    $this->Cell(55,10,'Direccion',1,0,'C',0);
    $this->Cell(25,10,'Rol',1,1,'C',0);
}


// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',9);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
}
}

require ("cn.php");
$consulta = "SELECT * FROM usuario";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);




while ($row=$resultado->fetch_assoc()) {
	$pdf->Cell(10,10,$row['id'],1,0,'C',0);
	$pdf->Cell(30,10,$row['nombres'],1,0,'C',0);
	$pdf->Cell(30,10,$row['apellidos'],1,0,'C',0);
    $pdf->Cell(45,10,$row['correo'],1,0,'C',0);
    $pdf->Cell(34,10,$row['contraseña'],1,0,'C',0);
    $pdf->Cell(20,10,$row['dni'],1,0,'C',0);
    $pdf->Cell(25,10,$row['celular'],1,0,'C',0);    
    $pdf->Cell(55,10,$row['direccion'],1,0,'C',0);  
    $pdf->Cell(25,10,$row['rol'],1,1,'C',0);  

} 


	$pdf->Output();
?>