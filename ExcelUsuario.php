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
$filename = "ReporteClientesRegistrados_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=14>AMIRA OPTICS SOCIEDAD ANONIMA CERRADA</th>';
echo '<tr>';
echo '<th colspan=14>Reporte de Clientes Registrados</th>';
echo '</tr>';


$dbamira = ("SELECT * 
FROM cliente tabla1 
LEFT JOIN medidas tabla2 on (tabla1.id = tabla2.id_cliente)");
$DataAmira = mysqli_query($con, $dbamira);

?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #ff8000;">
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Correo</th>
    <th>Contraseña</th>
    <th>DNI</th>
    <th>Esfera LD</th>
    <th>Cilindro LD</th>
    <th>Eje LD</th>
    <th>Esfera LI</th>
    <th>Cilindro LI</th>
    <th>Eje LI</th>
    <th>Dist. Interpupilar</th>
    <th>ID_Cliente</th>
    </tr>
</thead>
<?php
$i =1;
    while ($atr = mysqli_fetch_array($DataAmira)) { ?>
    <tbody>
        <tr>
            
            <td><?php echo $atr['id']; ?></td>
            <td><?php echo $atr['nombres']; ?></td>
            <td><?php echo $atr['apellidos'] ; ?></td>
            <td><?php echo $atr['correo']; ?></td>
            <td><?php echo $atr['contraseña']; ?></td>
            <td><?php echo $atr['dni']; ?></td>
            <td><?php echo $atr['ld_esfera']; ?></td>
            <td><?php echo $atr['ld_cilindro']; ?></td>
            <td><?php echo $atr['ld_eje']; ?></td>
            <td><?php echo $atr['li_esfera']; ?></td>
            <td><?php echo $atr['li_cilindro']; ?></td>
            <td><?php echo $atr['li_eje']; ?></td>
            <td><?php echo $atr['DistanciaInterpupilar']; ?></td>
            <td><?php echo $atr['id_cliente']; ?></td>
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>
