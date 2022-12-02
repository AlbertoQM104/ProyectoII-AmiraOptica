<?php require_once("./header.php"); ?>

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

    <div class="compOnliProd">

    


        <div class="compOnliEncab">

       
            <h2>Compra online</h2>
            <div class="compOnliEncabFec">
                <label for="">Fecha de la compra</label>
                <input type="date">
            </div>
        </div>

        

        <div class="detalleCompraOnline1">
            <h3>Compra N° 0001</h3>  
            <h3>Detalle del pago</h3>          
        </div>

        <div class="detalleCompraOnline2">
            <h3>Despacho del Delivery: Llega el 30 de Octubre</h3>
            <h3>Medio de pago: Tarjeta de débito Visa</h3>
        </div>        

        <div class="compOnliFilaProd">
            <div class="compOnliProdUni">
                <div class="compOnliImag">
                    <img src="../img/lente1.jpg" alt="">
                </div>
                <div class="compOnliDetails">
                    <h2>Lentes Oftalmológicos</h2>
                    <h3>S/.300.00</h3>
                    <h4>GUCCI</h4>
                    <h5>1 Unidad</h5>
                </div>
            </div>    
            <div class="detalleCompraTarj">
                <div class="detalleCompraTarj1">                
                    <label for="" class="fa-solid fa-credit-card"></label>
                    <h3>*************321</h3>
                </div>
                <div class="detalleCompraTarj1">
                    <label for="" class="fa-regular fa-credit-card"></label>
                    <h4>Cuotas: 2</h4>
                </div>    
            </div>        
        </div>

    </div>       

    <!-- Final estado -->
    <div class="tituloEstadoFinal">
        <h3>Despacho a domicilio: Calle las palmas 385 Lince Lima</h3>
    </div>

    <div class="estadoCompraF">
        <img src="" alt=""> AQUÍ VA LA IMAGEN DE ESTADO
    </div>


</div>

<?php require_once("./footer.php"); ?>