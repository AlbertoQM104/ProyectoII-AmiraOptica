
<?php 


require("../library/conexion.php");

$db = new  Conexion();
$con = $db->conecta();

/* Capturar token */
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : ''; 

$sql = $con->prepare("SELECT id, nombre, Descripcion, precio, id_categoria, imagen FROM producto WHERE id_categoria=3");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="contenedorProductosTotal">


    <div class="contenedorProductos">

        <div class="contenedorSuperior">
            <div class="seleccionador">
                <label>Ordenar por: <select name="select" id="select1">
                    <option value="1">Más vendido</option>
                    <option value="2">Mejor valorado</option>
                    <option value="3">Más barato</option>
                    <option value="3">Más caro</option>
                </select></label>
            </div>            
        </div>

        <div class="totalProductos">

            <?php foreach ($resultado as $row) { ?>

                <?php
                        $codigo = $row['id'];
                        $imagen2 = $row['imagen'];

                        $imagen = "../admin/img/" . $imagen2;
                        if (!file_exists($imagen)) {
                            $imagen = '../img/img-no-image.jpg';
                        }


                        ?>

                <div class="cuerpoCarta">
                    <div class="imagenCarta">
                        <a href="detalleProducto.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>&categoria=<?php echo $row['id_categoria'] ?>">
                            <img src="<?php echo $imagen; ?>" alt="">
                        </a>
                    </div>
                    <div class="datosCarta">
                        <h4><?php $row['nombre'] ?></h4>
                        <p>Bosco 015623423</p>
                        <h5>S/. <?php echo $row['precio']; ?></h5>
                    </div>
                    <div class="botonCarta">
                        <button class="botonCartaO" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">
                        Agregar al carrito
                        </button>
                    </div>
                </div>

            <?php } ?>

        </div>

    </div>




</div>