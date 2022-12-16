<?php 

require("../library/conexion.php");

$db = new  Conexion();
$con = $db->conecta();

/* Capturar token */
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : ''; 

$sql = $con->prepare("SELECT id, nombre, Descripcion, precio, id_categoria, imagen FROM producto WHERE id_categoria=2");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="contenedorProductosTotal">


    <!-- <div class="contenedorFiltros">
        <div class="contenedorFiltrosInterno">
            <div class="filtroSuperior">
                <div class="superiorDatos1">
                    <h4>Filtrar Por</h4>
                </div>            
                <div class="superiorDatos2">
                    <h4>Limpiar Todo</h4>
                </div>     
            </div>
            <div class="filtroGenero">
                <h3>Género</h3>
                <label for="hombre"><input type="checkbox" id="hombre" value="hombre">Hombre</label>
                <label for="mujer"><input type="checkbox" id="mujer" value="mujer">Mujer</label>
                <label for="nina"><input type="checkbox" id="nina" value="nina">Niña</label>
                <label for="nino"><input type="checkbox" id="nino" value="nino">Niño</label>
                <label for="unisex"><input type="checkbox" id="unisex" value="unisex">Unisex</label>
                <label for="unisexNinos"><input type="checkbox" id="unisexNinos" value="unisexNinos">Unisex/Niños</label>
            </div>
            <div class="filtroColor">
            <h3>Color de montura</h3>
                <label for="azul"><input type="checkbox" id="azul" value="azul">Azul</label>
                <label for="dorado"><input type="checkbox" id="dorado" value="dorado">Dorado</label>
                <label for="negro"><input type="checkbox" id="negro" value="negro">Negro</label>
                <label for="plateado"><input type="checkbox" id="plateado" value="plateado">Plateado</label>
                <label for="transparente"><input type="checkbox" id="transparente" value="transparente">Transparente</label>
                <label for="havana"><input type="checkbox" id="havana" value="havana">Havana</label>
                <label for="rosa"><input type="checkbox" id="rosa" value="rosa">Rosa</label>
                <label for="violeta"><input type="checkbox" id="violeta" value="violeta">Violeta</label>
                <label for="rojo"><input type="checkbox" id="rojo" value="rojo">Rojo</label>
            </div>
        </div>
    </div> -->

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
                        <h4><?php echo $row['nombre'] ?></h4>
                        <p>Bosco 015623423</p>
                        <h5>S/. <?php echo $row['precio'] ?></h5>
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