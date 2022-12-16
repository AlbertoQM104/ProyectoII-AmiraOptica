<?php require_once("./header.php"); ?>

<?php 


require '../library/conexion.php';

$db = new  Conexion();
$con = $db->conecta();

/* Capturar token */
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

$idCateogria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la petición';
    exit;
}else{

     $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){   

        $sql = $con->prepare("SELECT count(id) FROM producto WHERE id=?");     
        $sql -> execute([$id]);
        if($sql->fetchColumn() > 0){
            $sql = $con->prepare("SELECT nombre, Descripcion, precio, imagen, id_categoria FROM producto WHERE id=? LIMIT 1");                 
            $sql -> execute([$id]);
            $row = $sql -> fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['Descripcion'];
            $precio = $row['precio'];
            $tipoCategoriaLente = $row['id_categoria'];

            $imagen2 = $row['imagen'];

            $imagen = "../admin/img/" . $imagen2;   
            if (!file_exists($imagen)) {
                $imagen = '../img/img-no-image.jpg';
            }   
        }
        
     } else {
        echo 'Error al procesar la petición';
        exit;
    } 
}

$sql = $con->prepare("SELECT id, nombre, Descripcion, precio, imagen FROM producto WHERE id_categoria=? LIMIT 3");
$sql->execute([$idCateogria]);
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="detalle1">
    <div class="zonaImagen">
        <div class="imagenGrande">
            <img src="<?php echo $imagen; ?>" alt="">
        </div>
        <div class="imagenesPequenas">
            <!-- <img src="../img/lenteIndex4.jpeg" alt="">
            <img src="../img/lenteIndex4.jpeg" alt="">
            <img src="../img/lenteIndex4.jpeg" alt=""> -->
        </div> 
    </div>
    <div class="zonaDetalles">
        <div class="zonaEnca">
            <!-- <h1>OAKLEY LA127126</h1> -->
            <h1><?php echo $nombre; ?></h1>
            <div class="estrellasCal">
                <span class="fa fa-star" onmouseover="calificar(this)" id="1estrella"></span>
                <span class="fa fa-star" onmouseover="calificar(this)" id="2estrella"></span>
                <span class="fa fa-star" onmouseover="calificar(this)" id="3estrella"></span>
                <span class="fa fa-star" onmouseover="calificar(this)" id="4estrella"></span>
                <span class="fa fa-star" onmouseover="calificar(this)" id="5estrella"></span>
                <h4>5 reviews</h4>
            </div>            
        </div>
        <div class="zonaPrecio">
            <!-- <h1>S/. 232</h1> -->
            <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>
        </div>
        <div class="zonaMonturas">
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque itaque cupiditate sunt est vitae maxime ab voluptates quos blanditiis et? Dolorem tempore commodi fuga rem numquam aut, doloribus minima repellendus?</p> -->
            <p><?php echo $descripcion; ?></p>
            <div class="zonaMontBot">

            <?php if($tipoCategoriaLente!=2){ ?>


                <a href="./ingresarGraduacion.php" class="btnMon btnMonturas1">Agregar medición de ojos</a>


            <?php }?>

                

            

            


                <!-- <button href="./carritoCompra.php" class="btnMon btnMonturas2">Sólo Monturas</button> -->
            </div>            
        </div>
        <div class="zonaBotones">
            <button class="zonaBotonesBtn1" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
        </div>
    </div>
    
</div>



<div class="productosSimilares">


    
    <h1>Productos Similares</h1>

    

    <div class="productosSimilaresMuestras">
        
        <?php foreach ($resultado as $row) { ?>

            <?php
                        $codigo = $row['id'];
                        $imagen2 = $row['imagen'];

                        $imagen = "../admin/img/" . $imagen2;
                        if (!file_exists($imagen)) {
                            $imagen = '../img/img-no-image.jpg';
                        }


                        ?>

            <div class="similar1">
                <img src="<?php echo $imagen ?>" alt="">
                <div class="similar1Detail">
                    <h4><?php echo $row['nombre']; ?></h4>
                    <div class="calificationsDetailStars">                
                        <span class="fa fa-star" onmouseover="calificar(this)" id="1estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="2estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="3estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="4estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="5estrella"></span>
                    </div>
                    <h3>S/. <?php echo $row['precio']; ?></h3>
                </div>
            </div>
        
        <?php } ?>

    </div>
    <hr class="lineaSimilaresAbajo">
</div>

<!-- <div class="zonaValoracion">
    <h1>Valoración</h1>
    <div class="zonaValoracionComentarios"> -->

        <?php for($i=0; $i<2; $i++){ ?>
<!-- 
        <div class="comentarioValora">

            <div class="comentarioUsuario">
                <i class="fa-solid fa-user"></i>
                <div class="UsuarioDetalles">
                    <h2>JUAN AGUILAR</h2>
                    <h3>Oct 24, 2022</h3>
                    <div class="calificationsDetailStarsdelUsuario">                
                        <span class="fa fa-star" onmouseover="calificar(this)" id="1estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="2estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="3estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="4estrella"></span>
                        <span class="fa fa-star" onmouseover="calificar(this)" id="5estrella"></span>
                    </div>
                </div>
            </div>

            <div class="comentarioMensaje">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem debitis aspernatur iste alias excepturi tempore nam nulla facilis neque ex. Iure eaque sapiente error illum maxime ad vero alias doloremque!
                Corporis neque assumenda esse. Eveniet soluta possimus sed autem officiis sapiente enim mollitia, numquam qui commodi in suscipit consectetur laborum dolorum error? Quidem, dolore magnam cumque necessitatibus praesentium atque tenetur!
                Ad, est sunt! Magni, quaerat accusantium saepe, recusandae, ipsam rem sint quibusdam ducimus debitis nam earum? Id, sequi qui. Quod provident nam eos aspernatur similique eveniet reprehenderit perspiciatis cum sit!
            </div>



        </div> -->

<!--         <?php } ?>

    </div>
</div> -->

<?php require_once("./footer.php"); ?>