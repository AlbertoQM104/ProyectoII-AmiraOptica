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
    $this->SetFont('Arial','B',13);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,2,'AMIRA OPTICS SOCIEDAD ANONIMA CERRADA',0,1,'C');
    $this->Ln(8);
    $this->Cell(190,10,'REPORTE DETALLE DE PEDIDOS',1,0,'C');
    // Salto de línea
    $this->Ln(12);

    $this->Cell(30,10,'ID_Pedido',1,0,'C',0);
	$this->Cell(35,10,'ID_Producto',1,0,'C',0);
	$this->Cell(95,10,'Nombre',1,0,'C',0);
    $this->Cell(30,10,'Cantidad',1,1,'C',0);
  
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
$consulta = "SELECT * FROM detalle_pedido";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);

while ($row=$resultado->fetch_assoc()) {
	$pdf->Cell(30,10,$row['id_pedido'],1,0,'C',0);
	$pdf->Cell(35,10,$row['id_producto'],1,0,'C',0);
	$pdf->Cell(95,10,$row['nombre'],1,0,'C',0);
    $pdf->Cell(30,10,$row['cantidad'],1,1,'C',0);

} 


	$pdf->Output();
?>