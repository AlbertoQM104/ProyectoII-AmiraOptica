<?php require_once("./header.php"); ?>

<?php if($_SESSION['usuario']==null){ ?>

<?php } ?>

<?php 

/* require_once("../config/config.php"); */
require_once("../library/conexion.php");

$db = new Conexion;
$con = $db->conecta();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad, imagen FROM producto WHERE id=?");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

?>


<!-- OPCIONES ENTRE CARRITO, DETALLE Y COMPRA -->
    <div class="carritoOpcionesO">
        <div class="carritoOpcion">
            <button id="btnOpcion1" onclick="mostrarPantallaCarrito1()">1. Carrito de compra</button>
        </div>
        <div class="carritoOpcion">
            <button id="btnOpcion2" onclick="mostrarPantallaCarrito2()">2. Entrega</button>
        </div>
        <div class="carritoOpcion">
            <button id="btnOpcion3" onclick="mostrarPantallaCarrito3()">3. Pago</button>
        </div>
    </div>

        <link rel="stylesheet" href="../assets/css-bootstrap/bootstrap.css">
        <link rel="stylesheet" href="../assets/css-bootstrap/bootstrap.min.css">
        

<!-- PANTALLA DE CARRITO 1 COMPRAS -->
<div id="carritoDiv1" class="carritoTotal">

    <!-- Tabla -->
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
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
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];
                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;    
                            
                            $imagen2 = $producto['imagen'];

                            $imagen = "../admin/img/" . $imagen2;
                            if (!file_exists($imagen)) {
                                $imagen = '../img/img-no-image.jpg';
                            }
                            ?>
                        
                    
                    
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><img src="<?php echo $imagen; ?>" alt="" width="100px"></td>
                        <td><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></td>
                        <td>

                            <?php 

                                $msg = 'hola';

                                $consulta = "SELECT stock FROM producto where id = ?";
                                $stockC = $con->prepare($consulta);
                                $stockC -> execute([$_id]);
                                $resultado2 = $stockC->fetchColumn(); //Capturar de cada columna su stock
                                
                                
                            ?>

                            <input type="number" min="1" max="<?php if($resultado2<=10){ echo $resultado2; }else{ echo 10; } ?>" step="1" 
                            value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?> cantidad2" 
                            onchange="actualizarCantidad(this.value, <?php echo $_id; ?>);">                            
                        </td>
                        <td>
                            <div id="subtotal_<?php echo $_id;?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                        </td>
                        <td>
                            <a id="eliminar" class="btn btn-danger btn-sm text-light" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal" style="font-size: 16px;">
                            Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="3" id="total">TOTAL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>
                    </tr>


                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>
</div>


    

<!-- Modal Eliminar -->
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

<!-- PANTALLA DE CARRITO 2 ENTREGA -->
<div id="carritoDiv2" class="carritoEntregaTotal" style="display:none;">

    <!-- DIV IZQUIERDO -->
    <div class="EntregIzquierda">

        <!-- Título -->
        <div class="entregIzEnca">
            <h1>Detalles de la Compra</h1>
        </div>
        <!-- Campos a llenar -->
        <form action="" method="POST">
            <div class="entregIzCampos" id="cuandoDelivery">
                <div class="entregIzCamposPrim">
                    <input type="text" name="firstname" placeholder="Nombres" id="firstName" required>
                    <input type="text" name="firstSurname" placeholder="Apellidos" id="firstSurname" required>
                </div>
                <input type="text" name="primeraDireccion" placeholder="Dirección 1" id="firstDirection" required>
                <input type="text" name="segundaDireccion" placeholder="Dirección 2" id="secondDirection" required>
                <div class="entregIzCamposTerc">
                    <input type="text" name="provinciaG" placeholder="Provincia" id="provinc" required>
                    <input type="text" name="departamentoG" placeholder="Departamento" id="depart" required>
                </div>
                <div class="entregIzCamposCuart">
                    <input type="text" name= "distritoG" placeholder="Distrito" id="distrit" required>
                    <input type="text" name= "celularG" placeholder="Celular" id="celul" minlength="9" maxlength="9" required>                    
                </div>
            </div>

        <!-- Tipo de recojo -->
        
            <div class="entregIzTipoRec">
                <div class="entregIzTipoRecTienda">
                    <input type="radio" name="tipoRecojo" id="tipoRecojo" value="Recojo" onclick="tipoRecojo()"> 
                        <div class="entregIzTipoRecTiendaSub"> 
                            <label for="tipoRecojo" class="lbl1">Recojo en tienda</label>
                            <label for="tipoRecojo" class="lbl2">recojo en tienda</label>                        
                        </div>
                    </input>
                </div>
                <div class="entregIzTipoRecDelivery">
                    <input type="radio" name="tipoRecojo" id="tipoRecojo2" value="Delivery" onclick="tipoDeli()" checked>
                    <div class="entregIzTipoRecDeliverySub">
                        <label for="tipoRecojo2" class="lbl1">Delivery</label>
                        <label for="tipoRecojo2" class="lbl2">72 horas</label>   
                    </div>
                </div>
            </div>
            <div class="entregIzBot">
                <button name="registrarDetallesCompra">Guardar Detalles</button>

                <?php if(isset($_POST['registrarDetallesCompra'])){
                            if($_SESSION['idCliente'] == null) { ?>
                                <script>
                                    alert('Debe iniciar sesión primero antes de ingresar sus detalle de compras');
                                </script>
                <?php }else{ ?>

                    <?php require_once("../controller/controllerDetallesCompra.php"); ?>

                <?php } }?>

            </div>
        </form>
    </div>


    <!-- DIV DERECHO -->
    <div class="EntregDerecha">
        <!-- Encabezado -->
        <div class="entregDerEnca">
            <h1>Resumen</h1>
        </div>


        <!-- Resumen de productos -->
        <div class="entregDerProds">

            <!--  -->
            <?php 

                    if($lista_carrito == null){
                        echo "<b>Lista vacía</b>";
                    }else{

                        foreach($lista_carrito as $producto2){ 

                            $_id2 = $producto2['id'];
                            $nombre2 = $producto2['nombre'];
                            $precio2 = $producto2['precio'];                            
                             
                            
                            $imagen2 = $producto2['imagen'];

                            $imagen = "../admin/img/" . $imagen2;
                            if (!file_exists($imagen)) {
                                $imagen = '../img/img-no-image.jpg';
                            }

                            ?>

                            <div class="entregDerProdUni">
                                <div class="imagenDerPr">
                                    <img src="<?php echo $imagen; ?>" alt="" width="50px">
                                </div>
                                <div class="datosProdResu">
                                    <h3><?php echo $nombre2; ?></h3>
                                    <p><?php echo MONEDA . number_format($precio2, 2, '.', ','); ?></p>
                                </div>
                            </div>
                            <?php } ?>
            
                    

        </div>


        <!-- Cada precio de cada tipo -->
        <div class="entregDerPrec">

        
            
                <div class="carritoTerc">
                    <h2>DELILVERY</h2>
                    <h3>S/<span id="costoDelDelivery2">0.00</span></h3>
                </div>
                <div class="carritoTerc">
                    <h2>IGV</h2>
                    <h3>S/35.00</h3>
                </div>
                
            </div>
            
            <div class="carritoDerechaCuart">
                <h2>TOTAL</h2>
                <p id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                <?php } ?>
            </div>

        </div>

        
        

    </div>
</div>

<!-- PANTALLA DE CARRITO 3 PAGO -->
<div id="carritoDiv3" class="carritoPagoTotal">

    <!-- DIV IZQUIERDO -->
    <div class="carritoPagoIzquierda">
        <!-- Título -->
        <div class="entregIzEnca">
            <h1>Método de Pago</h1>
        </div>

        <!-- DIV para pago con tarjeta de crédito  -->
        <form action="" method="POST">
            <div class="pagoTarjetaCredito">
                <div class="creditoEncab">                                      
                    <div class="creditoEncabDeta">
                    <input type="radio" name="radioTipoPago" id="radioCredito" value="1" checked>  
                        <label for="radioCredito">Tarjeta de crédito</label>
                        <p>Ingresar información de la tarjeta</p>
                    </div>
                    <div class="creditoEncabDeta2">
                        <input type="radio" name="radioTipoPago" id="radioCredito2" value="2">
                        <label for="radioCredito2">Tarjeta de débito</label>
                    </div>
                </div>

                <div class="creditoIntermed">
                    <div class="creditoIntermed1">
                        <input type="text" name="nroCredito" minlength="16" maxlength="16" placeholder="0000 0000 0000 0000"><label for="nroCredito"></label>
                        <div class="fechaMesAnio">
                            <input type="number" min="1" max="12" placeholder="MM" name="capturaMesT">
                            <input type="number" min="13" max="33" placeholder="YY" name="capturaAnioT">
                        </div>
                        <input type="text" name="nroCV" minlength="3" maxlength="3" placeholder="CVV"> <label for="nroCV"></label>
                    </div>
                </div>

                <div class="creditoIntermedFinal">
                    <input type="text" name="duenoTarjet" placeholder="Nombre del titular" required>
                </div>

            </div>

            <!-- DEBITO -->
            <!-- <div class="pagoTarjetaDebito">
                <div class="debitoEncab">
                    <input type="radio" name="radioTipoPago" id="radioDebito">
                    <label for="radioDebito">Tarjeta de débito</label>
                </div>

                <div class="debitoIntermedio">
                    <input type="text" maxlength="16" placeholder="0000 0000 0000 0000">
                    <input type="date">
                    <input type="text" maxlength="3" placeholder="CVV" id="CVV2"> <label for="CVV2"></label>
                </div>

                <div class="debitoFinal">
                    <input type="text" name="duenoDebit" placeholder="Nombre del titular">
                </div>
            </div> -->

            <!-- Botón de pagar ahora -->
            <div class="btnPagarN">
                <button name="registrarTarjetaT">Pagar ahora</button>
            </div>

            <?php if(isset($_POST['registrarTarjetaT'])){
                            if($_SESSION['idCliente'] == null) { ?>
                                <script>
                                    alert('Debe iniciar sesión primero antes de ingresar sus datos de tarjeta');
                                </script>
                <?php }else{ ?>

                    <?php require_once("../controller/controllerTarjeta.php"); ?>

                <?php } }?>

            <?php ?>

        </form>
    </div>


    <!-- DIV DERECHO -->
    <div class="EntregDerecha">
        <!-- Encabezado -->
        <div class="entregDerEnca">
            <h1>Resumen</h1>
        </div>


        <!-- Resumen de productos -->
        <div class="entregDerProds">

        <?php 

            if($lista_carrito == null){
                echo "<b>Lista vacía</b>";
            }else{
            
            
                foreach($lista_carrito as $producto3){ 
                            $_id3 = $producto3['id'];
                            $nombre3 = $producto3['nombre'];
                            $precio3 = $producto3['precio'];
                            $cantidad3 = $producto3['cantidad'];
                            $subtotal3 = $cantidad * $precio;
                             
                            
                            $imagen2 = $producto3['imagen'];

                            $imagen = "../admin/img/" . $imagen2;
                            if (!file_exists($imagen)) {
                                $imagen = '../img/img-no-image.jpg';
                            }
            ?>

                <div class="entregDerProdUni">
                    <div class="imagenDerPr">
                        <img src="<?php echo $imagen; ?>" alt="" width="50px">
                    </div>
                    <div class="datosProdResu">
                        <h3><?php echo $nombre3; ?></h3>
                        <p><?php echo MONEDA . number_format($precio3, 2, '.', ','); ?></p>
                    </div>
                </div>

                <?php } ?>

        </div>


        <!-- Cada precio de cada tipo -->
        <div class="entregDerPrec">

                <div class="carritoTerc">
                    <h2>DELILVERY</h2>
                    <h3>S/<span id="costoDelDelivery3">0.00</span></h3>
                </div>
                <div class="carritoTerc">
                    <h2>IGV</h2>
                    <h3>S/35.00</h3>
                </div>
            </div>
            <div class="carritoDerechaCuart">
                <h2>TOTAL</h2>
                <p id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                <?php } ?>
            </div>

        </div>
        

    </div>

</div>
<!-- database is correct -->
<!-- CONEXION IS CORRECT -->

<?php require_once("./footer.php"); ?>