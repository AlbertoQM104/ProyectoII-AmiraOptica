<?php


require '../config/database.php';
require '../model/config.php';
include("conexion.php");

error_reporting(0);


$db = new  Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

/* print_r($_SESSION); */

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT codigo, nombre, precio_normal, $cantidad AS cantidad FROM mibase1.productos WHERE codigo=?");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}




?>
<?php include("../include/estilos.php"); ?>

<?php include("../include/head.php"); ?>

<br>
<h1 style="text-align:center">AUDIFONOS</h1>
<br>

<main>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo '<tr><td colspan="5" class="text-center"><b>Lista vacía</b></td></tr>';
                    }else{ 
                        
                        $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id = $producto['codigo'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio_normal'];
                            $cantidad = $producto['cantidad'];
                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;                        
                        ?>
                    
                    
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></td>
                        <td>
                            <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" 
                            onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)">
                        </td>
                        <td>
                            <div id="subtotal_<?php echo $_id;?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                        </td>
                        <td>
                            <a id="eliminar" class="btn btn-danger btn-sm text-light" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>
                    </tr>


                </tbody>
            <?php } ?>
            </table>
        </div>

        <?php if($lista_carrito != null){ ?>
        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <a href="../model/pago.php" class="btn btn-primary btn-lg">Realizar pago</a>
            </div>
        </div>
        <?php } ?>
        
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger"  onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php include("../include/footer.php"); ?>

