<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
</head>
<body>
    
<?php
include('config.php');
date_default_timezone_set("America/Bogota");
$fecha = date("d/m/Y");

header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "ReportePedidos_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=6>AMIRA OPTICS SOCIEDAD ANONIMA CERRADA</th>';
echo '<tr>';
echo '<th colspan=6>Reporte de Pedidos</th>';
echo '</tr>';


$dbamira = ("SELECT * FROM pedido");
$DataAmira = mysqli_query($con, $dbamira);

?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #ff8000;">
    <th>ID</th>
    <th>Fecha</th>
    <th>Total</th>
    <th>Estado</th>
    <th>Metodo de Envio</th>
    <th>ID_Cliente</th>
    </tr>
</thead>
<?php
$i =1;
    while ($atr = mysqli_fetch_array($DataAmira)) { ?>
    <tbody>
        <tr>
            
            <td><?php echo $atr['id']; ?></td>
            <td><?php echo $atr['fecha']; ?></td>
            <td><?php echo $atr['total'] ; ?></td>
            <td><?php echo $atr['estado']; ?></td>
            <td><?php echo $atr['metodoEnvio']; ?></td>
            <td><?php echo $atr['id_Cliente']; ?></td>
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>
