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
    $this->Cell(80);
    
    // Salto de línea
    $this->Ln(0);
	
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(160,2,'AMIRA OPTICS SOCIEDAD ANONIMA CERRADA',0,1,'C');
    $this->Ln(8);
    $this->Cell(280,10,'REPORTE DE CLIENTES REGISTRADOS',1,0,'C');
    // Salto de línea
    $this->Ln(12);

    $this->Cell(8,10,'ID',1,0,'C',0);
	$this->Cell(20,10,'Nombre',1,0,'C',0);
	$this->Cell(20,10,'Apellido',1,0,'C',0);
    $this->Cell(37,10,'Correo',1,0,'C',0);
    $this->Cell(22,10,'Contrasena',1,0,'C',0);
    $this->Cell(18,10,'DNI',1,0,'C',0);
    $this->Cell(18,10,'Esfera LD',1,0,'C',0);
    $this->Cell(21,10,'Cilindro LD',1,0,'C',0);
    $this->Cell(14,10,'Eje LD',1,0,'C',0);
    $this->Cell(18,10,'Esfera LI',1,0,'C',0);
    $this->Cell(21,10,'Cilindro LI',1,0,'C',0);
    $this->Cell(14,10,'Eje LI',1,0,'C',0);
    $this->Cell(30,10,'Dist. Interpupilar',1,0,'C',0);
    $this->Cell(19,10,'ID_Cliente',1,1,'C',0);

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
$consulta = "SELECT * 
FROM cliente tabla1 
LEFT JOIN medidas tabla2 on (tabla1.id = tabla2.id_cliente)";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',7);

while ($row=$resultado->fetch_assoc()) {
	$pdf->Cell(8,10,$row['id'],1,0,'C',0);
	$pdf->Cell(20,10,$row['nombres'],1,0,'C',0);
	$pdf->Cell(20,10,$row['apellidos'],1,0,'C',0);
    $pdf->Cell(37,10,$row['correo'],1,0,'C',0);
    $pdf->Cell(22,10,$row['contraseña'],1,0,'C',0);
    $pdf->Cell(18,10,$row['dni'],1,0,'C',0);
    $pdf->Cell(18,10,$row['ld_esfera'],1,0,'C',0);
    $pdf->Cell(21,10,$row['ld_cilindro'],1,0,'C',0);    
    $pdf->Cell(14,10,$row['ld_eje'],1,0,'C',0);
    $pdf->Cell(18,10,$row['li_esfera'],1,0,'C',0);
    $pdf->Cell(21,10,$row['li_cilindro'],1,0,'C',0);
    $pdf->Cell(14,10,$row['li_eje'],1,0,'C',0);
    $pdf->Cell(30,10,$row['DistanciaInterpupilar'],1,0,'C',0);
    $pdf->Cell(19,10,$row['id_cliente'],1,1,'C',0);

} 


	$pdf->Output();
?>