<?php
require_once('fpdf/fpdf.php');
require_once ("cn.php");



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
    $this->Cell(70,2,'AMIRA OPTICS SOCIEDAD ANONIMA CERRADA',0,1,'C');
    $this->Ln(8);
    $this->Cell(172,10,'PRODUCTOS',1,0,'C',0);
    // Salto de línea
    $this->Ln(12);

    
    
    
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


//F
function imagen($array){
    $this->Image("admin/img/".$array);
}

}


    

/* ----------------- CANTIDAD DE PRODUCTOS POR ID ----------------------- */
$consulta = "SELECT * FROM producto";
$consultaOfta = "SELECT * FROM producto WHERE id_categoria = '1'";
$consultaSol = "SELECT * FROM producto WHERE id_categoria = '2'";
$consultaConta = "SELECT * FROM producto WHERE id_categoria = '3'";

/* ---------------------------------------------------------------------------- */

/* ------------------ SUMA DE PRODUCTOS POR CATEGORÍA -------------------------------- */

$consultaOfta2 = "SELECT SUM(stock) as suma1 FROM producto WHERE id_categoria = '1'";
$consultaSol2 = "SELECT SUM(stock) as suma2 FROM producto WHERE id_categoria = '2'";
$consultaConta2 = "SELECT SUM(stock) as suma3 FROM producto WHERE id_categoria = '3'";

/* ----------------------------------------------------------------------------------------- */

/* ------------------ SUMA DE PRODUCTOS X PRECIO POR CATEGORÍA -------------------------------- */

$consultaOfta3 = "SELECT SUM(precio*stock) as multi1 FROM producto WHERE id_categoria = '1'";
$consultaSol3 = "SELECT SUM(precio*stock) as multi2 FROM producto WHERE id_categoria = '2'";
$consultaConta3 = "SELECT SUM(precio*stock) as multi3 FROM producto WHERE id_categoria = '3'";

/* ----------------------------------------------------------------------------------------- */


$resultado = mysqli_query($conexion, $consulta);

//Contar productos por categoría
if($resultadoOfta = $conexion->query($consultaOfta)){
    $row_cnt = $resultadoOfta->num_rows;
}

if($resultadoSol = $conexion->query($consultaSol)){
    $row_cnt2 = $resultadoSol->num_rows;
}

if($resultadoConta= $conexion->query($consultaConta)){
    $row_cnt3 = $resultadoConta->num_rows;
}

//Sumar productos por categoría
$resultadoOfta2 = mysqli_query($conexion, $consultaOfta2);
$resultadoSol2 = mysqli_query($conexion, $consultaSol2);
$resultadoConta2 = mysqli_query($conexion, $consultaConta2);

$data1=mysqli_fetch_array($resultadoOfta2);
$data2=mysqli_fetch_array($resultadoSol2);
$data3=mysqli_fetch_array($resultadoConta2);

$ofta = $data1['suma1'];
$sol = $data2['suma2'];
$conta = $data3['suma3'];

/* --------------------------------------------------- */

/* ----------------------- SUMA PRODUCTO STOCK X PRECIO ------------------------- */

$resultadoOfta3 = mysqli_query($conexion, $consultaOfta3);
$resultadoSol3 = mysqli_query($conexion, $consultaSol3);
$resultadoConta3 = mysqli_query($conexion, $consultaConta3);

$data11=mysqli_fetch_array($resultadoOfta3);
$data22=mysqli_fetch_array($resultadoSol3);
$data33=mysqli_fetch_array($resultadoConta3);

$ofta2 = $data11['multi1'];
$sol2 = $data22['multi2'];
$conta2 = $data33['multi3'];

/* ----------------------------------------------------------------------------------- */

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(233, 229, 235);

    
    $pdf->Cell(172,10,'CANTIDAD DE PRODUCTOS POR CATEGORIA: ',1,1,'C',1);
    $pdf->Cell(57.3,10,'Lentes Oftalmologicos: '.$row_cnt." unid.",1,0,'C',0);
    $pdf->Cell(57.3,10,'Lentes de Sol: '.$row_cnt2." unid.",1,0,'C',0);
    $pdf->Cell(57.4,10,'Lentes de Contacto: '.$row_cnt3." unid.",1,1,'C',0);

    $pdf->Ln(6);

    $pdf->Cell(172,10,'CANTIDAD DE STOCK POR CATEGORIA: ',1,1,'C',1);
    $pdf->Cell(57.3,10,'Lentes Oftalmologicos: '.$ofta." unid.",1,0,'C',0);
    $pdf->Cell(57.3,10,'Lentes de Sol: '.$sol." unid.",1,0,'C',0);
    $pdf->Cell(57.4,10,'Lentes de Contacto: '.$conta." unid.",1,1,'C',0);

    $pdf->Ln(6);

    $pdf->Cell(172,10,'CANTIDAD DE STOCK X PRECIO POR CATEGORIA: ',1,1,'C',1);
    $pdf->Cell(57.3,10,'Lentes Oftalmologicos: S/.'.$ofta2,1,0,'C',0);
    $pdf->Cell(57.3,10,'Lentes de Sol: S/.'.$sol2,1,0,'C',0);
    $pdf->Cell(57.4,10,'Lentes de Contacto: S/.'.$conta2,1,1,'C',0);
    
    
    $pdf->Ln(12);

    $pdf->Cell(8,10,'ID',1,0,'C',1);
	$pdf->Cell(85,10,'Nombre producto',1,0,'C',1);
	//$this->Cell(45,10,'Descripcion',1,0,'C',0);
    $pdf->Cell(19,10,'Precio S/.',1,0,'C',1);
    $pdf->Cell(14,10,'Stock',1,0,'C',1);
    $pdf->Cell(16,10,'ID_Cat',1,0,'C',1);
    $pdf->Cell(30,10,'Imagen',1,1,'C',1);

while ($row=$resultado->fetch_assoc()) {
	$pdf->Cell(8,10,$row['id'],1,0,'C',0);
	$pdf->Cell(85,10,$row['nombre'],1,0,'L',0);
	//$pdf->MultiCell(45,4,$row['Descripcion'],1,'C',false);    
    $pdf->Cell(19,10,$row['precio'],1,0,'C',0);
    $pdf->Cell(14,10,$row['stock'],1,0,'C',0);
    $pdf->Cell(16,10,$row['id_categoria'],1,0,'C',0);    
    $pdf->Cell(30,10,$pdf->Image('admin/img/'.$row['imagen'],$pdf->GetX()+10,$pdf->GetY()+2,8),1,1,'C',0 );
} 


	$pdf->Output();
?>