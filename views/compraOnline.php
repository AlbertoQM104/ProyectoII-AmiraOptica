<?php require_once("./header.php"); ?>

<div class="tituloMisCompras">
    <h1>MIS COMPRAS</h1>
</div>

<div class="conteCompraOnline">


    <div class="buscarOnli">
        <form action="">
            <label for="buscaComp" class="fa-solid fa-magnifying-glass"></label>
            <input type="search" id="buscaComp" placeholder="Buscar por N° de pedidos">
        </form>
    </div>

    <!-- Cada producto comprado -->

    <?php for($i=0; $i<2; $i++){ ?>

    <div class="compOnliProd">

    


        <div class="compOnliEncab">

       
            <h2>Compra online</h2>
            <div class="compOnliEncabFec">
                <label for="">Fecha de la compra</label>
                <input type="date">
            </div>
        </div>

        

        <div class="compOnliNroCompr">
            <h3>Compra N° 0001</h3>            
        </div>

        <div class="compOnliLlega">
            <h3>Llega el 30 de Octubre</h3>
        </div>        

        <div class="compOnliFilaProd">
            <div class="compOnliProdUni">
                <div class="compOnliImag">
                    <img src="../img/lente1.jpg" alt="">
                </div>
                <div class="compOnliDetails">
                    <h2>Estado: Compra aprobada</h2>
                    <h3>Despacho a domicilio: </h3>
                    <h4>Entre las 8:00 y 20:00 hrs.</h4>
                </div>
            </div>
            <div class="btnVerDetall">
                <a href="./detalleCompra.php">Ver Detalle</a>
            </div>
        </div>

        


    </div>       

    <?php } ?>

</div>

<?php require_once("./footer.php"); ?>