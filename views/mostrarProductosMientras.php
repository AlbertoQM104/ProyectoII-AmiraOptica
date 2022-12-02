<?php

error_reporting(0);
require '../config/database.php';
require '../model/config.php';
include("conexion.php");

session_start();



$db = new  Database();
$con = $db->conectar();

/* Capturar token */
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : ''; 

$sql = $con->prepare("SELECT codigo, nombre, descripcion, precio_normal, imagen FROM mibase1.productos WHERE idcategoria=4");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


?>
<?php include("../include/estilos.php"); ?>

<?php include("../include/head.php"); ?>

<br>
<h1 style="text-align:center">AUDIFONOS</h1>
<br>

<main>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($resultado as $row) { ?>


                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                        $codigo = $row['codigo'];
                        $imagen2 = $row['imagen'];

                        $imagen = "../admin/assets/img/" . $imagen2;
                        if (!file_exists($imagen)) {
                            $imagen = '../img/img-no-image.jpg';
                        }


                        ?>
                        <img class="card-img " src="<?php echo $imagen; ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
                            <P class="card-text">S/ <?php echo number_format($row['precio_normal'], 2, '.', ' '); ?></P>
                            <div class="d-flex justify-content-between">
                                <!-- <div class="btn-group"> -->
                                    <a href="details.php?codigo=<?php echo $row['codigo']; ?>&token=<?php echo hash_hmac('sha1', $row['codigo'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                                    <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['codigo']; ?>, '<?php echo hash_hmac('sha1', $row['codigo'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                                 <!-- </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</main>
<?php include("../include/footer.php"); ?>