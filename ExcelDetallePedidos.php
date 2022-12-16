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
$filename = "ReporteDetallePedidos_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=4>AMIRA OPTICS SOCIEDAD ANONIMA CERRADA</th>';
echo '<tr>';
echo '<th colspan=4>Reporte Detalles de Pedidos</th>';
echo '</tr>';


$dbamira = ("SELECT * FROM detalle_pedido");
$DataAmira = mysqli_query($con, $dbamira);

?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #ff8000;">
    <th>ID_Pedido</th>
    <th>ID_Producto</th>
    <th>Nombre</th>
    <th>Cantidad</th>
    </tr>
</thead>
<?php
$i =1;
    while ($atr = mysqli_fetch_array($DataAmira)) { ?>
    <tbody>
        <tr>
            
            <td><?php echo $atr['id_pedido']; ?></td>
            <td><?php echo $atr['id_producto']; ?></td>
            <td><?php echo $atr['nombre'] ; ?></td>
            <td><?php echo $atr['cantidad']; ?></td>
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>
