<?php require_once("./header.php"); ?>

<?php 

require_once '../library/conexion.php';


/* Capturar token */
$id = isset($_GET['id']) ? $_GET['id'] : '';

if($id == ''){
    echo 'Error al procesar la petición';
    exit;
}else{
    
    $db = new  Conexion();
    $con = $db->conecta();

    $sql = $con->prepare("SELECT * 
                          from detalle_pedido tabla1
                          INNER JOIN pedido tabla2 on (tabla1.id_pedido = tabla2.id)
                          INNER JOIN producto tabla3 on (tabla1.id_producto = tabla3.id)
                          /* INNER JOIN cliente tabla3 on (tabla2.id_Cliente = tabla3.id)
                          INNER JOIN detalle_pago tabla4 on (tabla3.id = tabla4.id_cliente)
                          INNER JOIN metodo_pago tabla5 on (tabla4.id_metodoPago = tabla5.id) */
                          WHERE tabla1.id_pedido = ?");


    $sql->execute([$id]);
    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

}

?>

<div class="tituloMisCompras">
    <h1>MIS COMPRAS</h1>
</div>

<div class="totalDetalleCompr">

    <div class="btnVolverDeta">
        <a href="./compraOnline.php" style="font-size: 20px;">Volver a mis compras</a>
    </div>

    <div class="detalleTituloEnca">
        <h2>Detalle de la Compra</h2>
    </div>

    <!-- Especificación del producto -->

   

    <?php 
    
    $conteo = 1;
    $subtotalT = 0;
    
    foreach($resultado as $row){ 
        
        
        
    ?>

    <div class="compOnliProd">

    
        

        <div class="compOnliEncab">

       
            <h2>Compra online</h2>
            <!-- <div class="compOnliEncabFec">
                <label for="">Fecha de la compra</label>
                <input type="date">
            </div> -->
        </div>

        

        <div class="detalleCompraOnline1">
            <h3>Producto N° 000<?php echo $conteo; $conteo++;?></h3>  
            <!-- <h3>Detalle del pago</h3>   -->        
        </div>

        <!-- <div class="detalleCompraOnline2">
            <h3>Despacho del Delivery: Llega el 30 de Octubre</h3>
            <h3>Medio de pago: Tarjeta de <?php echo $row->nombre_pago ?></h3>
        </div>   -->      

        <div class="compOnliFilaProd">
            <div class="compOnliProdUni">
                <div class="compOnliImag">
                    <img src="../admin/img/<?php echo $row->imagen; ?>" alt="">
                </div>
                <div class="compOnliDetails">
                    <h2><?php echo $row->nombre; ?></h2>
                    <h3>S/. <?php echo number_format($row->precio, 2) ?></h3>
                    <!-- <h4>GUCCI</h4> -->
                    <h5><?php echo $row->cantidad ?> Unidad</h5>
                </div>
            </div>    
            <div class="detalleCompraTarj">
                <!-- <div class="detalleCompraTarj1">                
                    <label for="" class="fa-solid fa-credit-card"></label>
                    <h3>*************321</h3>
                </div> -->
                <!-- <div class="detalleCompraTarj1">
                    <label for="" class="fa-regular fa-credit-card"></label>
                    <h4>Cuotas: 2</h4>
                </div>     -->
            </div>        
        </div>

        

    </div>   

    
    
    <?php

        $subtotalT += $row->precio;


        } //Fin del FOREACH
        
        $IGVTEMPORAL = $subtotalT * 0.18;
        $totalTempo = $IGVTEMPORAL + $subtotalT;
        
        ?>

    

    <div class="ResumenDetalleCompra">
        <h2>SUBTOTAL: S/. <?php echo number_format($subtotalT, 2) ?></h2>
        <h2>IGV: S/. <?php echo number_format($IGVTEMPORAL, 2) ?></h2>
        <h2>TOTAL: S/. <?php echo number_format($totalTempo, 2) ?></h2>
    </div>

    <!-- Final estado -->
    <!-- <div class="tituloEstadoFinal">
        <h3>Despacho a domicilio: Calle las palmas 385 Lince Lima</h3>
    </div> -->

    <?php 

        try{
    
        $sqlEstado = $con -> prepare("SELECT estado 
                                      FROM pedido                                      
                                      WHERE pedido.id = ?");
        $sqlEstado -> execute([$id]);
        $reslutado22 = $sqlEstado->fetchColumn();

        $sqlEnvio = $con -> prepare("SELECT metodoEnvio FROM pedido WHERE pedido.id=?");
        $sqlEnvio -> execute([$id]);
        $elMetodoDeEnvio = $sqlEnvio->fetchColumn();

        

        if($elMetodoDeEnvio == "Delivery"){
    
    ?>

                    <?php    
                        if($reslutado22 == "RECIBIDO"){   
                    ?>

                        <div class="estadoCompraF">
                            <img src="../img/Delivery-1.jpg" alt="">
                        </div>

                    <?php
                    
                        }else if($reslutado22 == "PREPARANDO"){
                    
                    ?>

                        <div class="estadoCompraF">
                            <img src="../img/Delivery-2.jpg" alt="">
                        </div>


                    <?php }else if($reslutado22 == "EN RUTA"){ ?>

                        <div class="estadoCompraF">
                            <img src="../img/Delivery-3.jpg" alt="">
                        </div>

                    <?php }else if($reslutado22 == "ENTREGADO"){ ?>

                        <div class="estadoCompraF">
                            <img src="../img/Delivery-4.jpg" alt="">
                        </div>

                    <?php }else{ ?>

                        <div class="estadoCompraF">
                            NO EXISTE COMPRA
                        </div>

                    <?php } ?>

            <?php }else if($elMetodoDeEnvio == "Recojo"){ ?>

                <?php    
                        if($reslutado22 == "RECIBIDO"){   
                    ?>

                        <div class="estadoCompraF">
                            <img src="../img/Recojo-1.jpg" alt="">
                        </div>

                    <?php
                    
                        }else if($reslutado22 == "PREPARANDO"){
                    
                    ?>

                        <div class="estadoCompraF">
                            <img src="../img/Recojo-2.jpg" alt="">
                        </div>


                    <?php }else if($reslutado22 == "LISTO PARA RECOJO"){ ?>

                        <div class="estadoCompraF">
                            <img src="../img/Recojo-3.jpg" alt="">
                        </div>

                    <?php }else if($reslutado22 == "ENTREGADO"){ ?>

                        <div class="estadoCompraF">
                            <img src="../img/Recojo-4.jpg" alt="">
                        </div>

                    <?php }else{ ?>

                        <div class="estadoCompraF">
                            NO EXISTE COMPRA
                        </div>

                    <?php } ?>

            <?php } 
            
                    }catch(PDOException $e){
                        echo 'Falló al mostrar estado de compra: ' . $e->getMessage();
                    }finally{
                        $sqlEstado = null;
                        $sqlEnvio = null;
                    }
                        ?>


</div>

<?php require_once("./footer.php"); ?>