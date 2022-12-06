<?php require_once("./header.php"); ?>

<?php 

        require_once("../library/conexion.php"); 

        $db = new  Conexion();
        $con = $db->conecta();

        $sql = $con->prepare("SELECT * 
                              FROM pedido                                                        
                              WHERE id_Cliente=?");

        
        $sql->execute([$_SESSION['idCliente']]);
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);


?>

<div class="tituloMisCompras">
    <h1>MIS COMPRAS</h1>
</div>

<div class="conteCompraOnline">


    <!-- <div class="buscarOnli">
        <form action="">
            <label for="buscaComp" class="fa-solid fa-magnifying-glass"></label>
            <input type="search" id="buscaComp" placeholder="Buscar por N° de pedidos">
        </form>
    </div> -->

    <!-- Cada producto comprado -->

    <?php 
    
        try{
    
        foreach($resultado as $row){ 
        
        $i = 1;
        
        
    ?>

    <div class="compOnliProd">

    


        <div class="compOnliEncab">

       
            <h2>Compra online</h2>
            <div class="compOnliEncabFec">
                <label for="">Fecha de la compra</label>
                <input type="date" value="<?php echo $row->fecha ?>" disabled>
            </div>
        </div>

        

        <div class="compOnliNroCompr">
            <h3>Compra N° 00<?php echo $i; $i++;?></h3>            
        </div>

        <div class="compOnliLlega">
            <h3>Llega aproximadamente el 30 de Octubre</h3>
        </div>        

        <div class="compOnliFilaProd">
            <div class="compOnliProdUni">
                <div class="compOnliImag">
                    <img src="../img/lente1.jpg" alt="">
                </div>
                <div class="compOnliDetails">
                    <h2>Estado: <?php echo $row->estado ?></h2>
                    <h3>Despacho: A domicilio </h3>
                    <h4>Entre las 8:00 y 20:00 hrs.</h4>
                </div>
            </div>
            <div class="btnVerDetall">
                <a href="detalleCompra.php?id=<?php echo $row->id ?>">Ver Detalle</a>
            </div>
        </div>

        


    </div>       

    <?php

        
        } /* Termina el for */

    }catch(PDOException $e){
        echo 'Falló el listado de compras: '.$e->getMessage();
        die();
    }finally{
        $db = null;
        $con = null;
        $resultado = null;
        $sql = null;
    }



    ?>

</div>

<?php require_once("./footer.php"); ?>